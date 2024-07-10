<?php
namespace App;

class Utility
{
    public static function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
}