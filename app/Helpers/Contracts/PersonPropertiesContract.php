<?php
namespace App\Helpers\Contracts;
Interface PersonPropertiesContract
{
    public static function getPersonInfo() : string ;
    public static function getPersonPrivileges() : ?array;
}
