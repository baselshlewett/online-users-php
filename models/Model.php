<?php

namespace Models;

class Model 
{
    public static $data = [];
    
    protected static $table = "";

    public static function load($filename): void
    {
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/db/" . $filename . '.json');
        self::$data = json_decode($file);
        return;
    }

    public static function update(): void
    {
        return;
    }

    public static function find(string $field, string $value): mixed
    {
        return array_filter(self::$data, function($arr) use ($field, $value) {
            if ($arr->$field === $value) {
                return $arr;
            }   
        });
    }
}