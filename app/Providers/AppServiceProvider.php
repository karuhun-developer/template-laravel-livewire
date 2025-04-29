<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Laravel IDE Helper
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        // Production force HTTPS`
        if ($this->app->isProduction()) {
            URL::forceHttps();
            $this->app['request']->server->set('HTTPS', true);
        }

        // Gate pulse
        Gate::define('viewPulse', function (User $user) {
            return $user->hasRole('superadmin');
        });

        // Timezone
        Carbon::macro('inApplicationTimezone', function() {
            return $this->tz(config('app.timezone_display'));
        });

        Carbon::macro('inUserTimezone', function() {
            return $this->tz(auth()->user()?->timezone ?? config('app.timezone_display'));
        });
    }
}
