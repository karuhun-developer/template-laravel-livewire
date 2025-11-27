<?php

namespace App\Http\Controllers\Api\V1\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Setting;
use App\Traits\WithSaveFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    use WithSaveFile;

    protected string $model = Setting::class;

    public function show(Request $request)
    {
        // If force refresh
        if ($request->has('forceRefresh') && $request?->forceRefresh) {
            Cache::forget('setting:all');
        }

        $ttl = now()->addDay();
        $model = Cache::remember('setting:all', $ttl, function () {
            $setting = Setting::first();

            // Create default setting if not exists
            if (! $setting) {
                $setting = Setting::create([]);
            }

            return $setting;
        });

        return $this->responseWithSuccess($model);
    }

    public function update(Request $request)
    {
        $this->authorize('update'.Setting::class);

        $request->validate([
            'configuration' => 'required|array',
            'configuration.*.key' => 'required|string',
            'configuration.*.value' => 'nullable|string',
        ]);

        $setting = Setting::first();

        // Prepare data
        $data = [];
        foreach ($request->input('configuration') as $item) {
            $data[$item['key']] = $item['value'] ?? null;
        }

        // Create default setting if not exists
        if (! $setting) {
            $setting = Setting::create([
                'data' => $data,
            ]);
        } else {
            $setting->update([
                'data' => $data,
            ]);
        }

        // Clear cache
        Cache::forget('setting:all');

        return $this->responseWithSuccess($setting);
    }

    public function file(Request $request)
    {
        $this->authorize('update'.Setting::class);

        $request->validate([
            'file' => 'required|file|mimes:png,jpg,jpeg,gif,svg,pdf|max:5120',
        ]);

        $path = $this->saveFile(
            file: $request->file('file'),
            path: 'files',
        );

        return $this->responseWithSuccess('storage/'.$path);
    }
}
