<?php


namespace App\Helpers;


use App\Helpers\Contracts\PersonPropertiesContract;

class UserProperties implements  PersonPropertiesContract
{
    public static function getPersonInfo() :string
    {
        return 'I am User';
    }
    public static function getPersonPrivileges() :?array
    {
        $privileges = ['no privileges'];
        return $privileges;
    }
}
