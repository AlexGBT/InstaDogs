<?php


namespace App\Helpers;


use App\Helpers\Contracts\PersonPropertiesContract;

class AdminProperties implements PersonPropertiesContract
{
    public static function getPersonInfo() :string
    {
        return  'I am Admin';
    }
    public static function getPersonPrivileges() :?array
    {
        $privileges= ['Delete all comments', 'Delete all posts', 'Hide all posts'];
        return $privileges;
    }
}
