<?php

namespace App\Regex;

class PhoneRegex implements IRegex
{
    public static function getRegex(): string
    {
        return '\+[0-9]+\s[0-9]+\s[0-9]{3}-[0-9]{2}-[0-9]{2}$';
    }

}
