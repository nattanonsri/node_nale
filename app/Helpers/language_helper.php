<?php

use CodeIgniter\Config\Services;


if (!function_exists('set_language')) {
    function set_language($lang)
    {
        $validLanguages = ['en', 'th']; // Update with the supported languages in your application

        // Validate the language input
        if (!in_array($lang, $validLanguages, true)) {
            // Handle the error gracefully, e.g., log the invalid language attempt
            return;
        }

        $session = Services::session();

        // Set the session language
        try {
            $session->set('language', $lang);

        } catch (\Exception $e) {
            // Handle the error gracefully, e.g., log the session error
        }
    }
}

if (!function_exists('get_language')) {
    function get_language()
    {
        $session = Services::session();

        try {
            $lang = $session->get('language');
        } catch (\Exception $e) {
            // Handle the error gracefully, e.g., log the session error
            return config('App')->defaultLocale;
        }

        if (empty($lang)) {
            // Handle the empty language value, e.g., log the empty language value
            return config('App')->defaultLocale;
        }

        $validLanguages = ['en', 'th']; // Update with the supported languages in your application

        // Ensure the stored language is valid
        if (!in_array($lang, $validLanguages, true)) {
            // Handle the error gracefully, e.g., log the invalid language stored in the session
            return config('App')->defaultLocale;
        }

        return $lang;
    }
}
