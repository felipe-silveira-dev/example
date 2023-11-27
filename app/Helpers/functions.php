<?php

if (!function_exists('getStatusSupport')) {
    function getStatusSupport(string $status): string
    {
        return match ($status) {
            'open' => 'bg-green-500 text-white',
            'closed' => 'bg-red-500 text-white',
            'pending' => 'bg-yellow-500 text-white',
        };
    }
}
