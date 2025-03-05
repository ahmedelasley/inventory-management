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

    if (!function_exists('getInitials')) {

        function getInitials($string)
        {
            preg_match_all('/\b\w/u', $string, $matches);
            return strtoupper(implode('', $matches[0]));
        }
    }

    if (!function_exists('admin')) {
        function admin()
        {
            return auth()->guard('admin')->user();
        }
    }
    if (!function_exists('manager')) {
        function manager()
        {
            return auth()->guard('manager')->user();
        }
    }

    if (!function_exists('keeper')) {
        function keeper()
        {
            return auth()->guard('keeper')->user();
        }
    }

    if (!function_exists('supervisor')) {
        function supervisor()
        {
            return auth()->guard('supervisor')->user();
        }
    }

    

