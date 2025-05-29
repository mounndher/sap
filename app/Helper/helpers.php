<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

if (!function_exists('setSidebarActive')) {
    function setSidebarActive($route)
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (request()->routeIs($r)) {
                    return 'active';
                }
            }
        } else {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
        return '';
    }
}
