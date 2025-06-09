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

function hasPermission($permission)
{
   // dd($permission);
    return auth()->guard('web')->user()->hasAnyPermission($permission);
}
function isSuperAdmin() {
    return auth()->user()->hasRole('Super Admin');
}

if (!function_exists('statusClass')) {
    function statusClass($status) {
        return match($status) {
            0 => 'invalid',
            1 => 'valid',
            2 => 'in-progress',
            default => '',
        };
    }
}
