<?php
namespace App\Helpers;

class User {
    public static function set_active($path, $active = 'active') {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }
    public static function set_menu($path) {
        return call_user_func_array('Request::is', (array)$path) ? 'btn btn-primary text-light d-block d-sm-inline-block' : 'btn btn-secondary d-block text-dark d-sm-inline-block';
    }
}
