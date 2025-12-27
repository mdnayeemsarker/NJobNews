<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Models\Setting;

class SettingRepository implements SettingRepositoryInterface
{
    /**
     * Create or update setting(s)
     *
     * @param array $data
     */
    public function storeOrUpdate(array $data)
    {
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            cache_put($key, $value, 120);
        }
    }

    /**
     * Get setting by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getSetting(string $key, $default = null)
    {
        return cache_remember(
            $key,
            function () use ($key, $default) {
                $setting = Setting::where('key', $key)->first();
                
                return $setting ? $setting->value : $default;
            }
        );
    }
    /**
     * Get setting by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getAllSetting()
    {
        return cache_remember(
            'all_settings',
            function () {
                $settings = Setting::all();
                $result = [];
                foreach ($settings as $setting) {
                    $result[$setting->key] = $setting->value;
                }
                return $result;
            }
        );
    }
}
