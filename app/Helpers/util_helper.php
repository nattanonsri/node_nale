<?php

// use App\Libraries\JWTService;
// use App\Models\AddressModel;
use App\Models\LogSQLModel;


if (!function_exists('get_client_ip')) {
    function get_client_ip()
    {
        $ipaddress = '';

        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        // Handle comma-separated list of IP addresses
        if (strpos($ipaddress, ',') !== false) {
            $ipList = explode(',', $ipaddress);
            $ipaddress = trim($ipList[0]);
        }

        return esc($ipaddress);
    }
}

if (!function_exists('add_log')) {
    function add_log($user_id, $method, $url, $response, $error = '')
    {
        $logModel = new LogSQLModel();
        $request = service('request');
        $agent = $request->getUserAgent();
        $data = [
            'user_id' => !empty($user_id) ? $user_id : 0,
            'method' => $method ?? '',
            'endpoint' => $url ?? '',
            'response' => json_encode($response),
            'error' => json_encode($error), // Save the error message
            'ip' => get_client_ip() ?? $request->getIPAddress(),
            'browser' => $agent->getBrowser(),
            'os' => $agent->getPlatform(),
            'user_agent' => $agent->getAgentString(),
            'created_at' => CURRENT_DATE,
            'updated_at' => CURRENT_DATE,
        ];

        $logModel->insert($data);
    }
}