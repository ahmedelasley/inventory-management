<?php



    if (!function_exists('getSetting')) {
        function getSetting($key, $default = null)
        {
            $setting = \App\Models\Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        }
    }




    if (!function_exists('showAlert')) {
        function showAlert($component, $type, $message) {
            return $component->alert('success', $message, [
                'position' => 'top-start',
                'timer' => 4000,
                'toast' => true,
                'timerProgressBar' => true,
            ]);
        }
    }


