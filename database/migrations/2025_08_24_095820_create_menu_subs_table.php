<?php

use App\Enums\CommonStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_subs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Spatie\Role::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(App\Models\Menu\Menu::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('url');
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->string('active_pattern')->nullable();
            $table->boolean('status')->default(CommonStatusEnum::ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_subs');
    }
};
