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
function handleUpload($inputName, $model=null){
    try{
        if(request()->hasFile($inputName)){
            if($model && File::exists(public_path($model->{$inputName}))) {
                File::delete(public_path($model->{$inputName}));
            }

            $file = request()->file($inputName);
            $fileName = rand().$file->getClientOriginalName();
            $file->move(public_path('/uploads'), $fileName);

            $filePath = "/uploads/".$fileName;

            return $filePath;
        }
    }catch(\Exception $e){
        throw $e;
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
