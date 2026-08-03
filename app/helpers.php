<?php

use App\Models\Setting;

if (! function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        static $settings = null;

        if ($settings === null) {
            $settings = Setting::query()->pluck('value', 'key');
        }

        $value = $settings->get($key);

        if ($value !== null && $value !== '') {
            return $value;
        }

        return config($key, $default);
    }
}
