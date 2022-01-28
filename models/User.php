<?php

namespace Models;

use Models\Model;

class User extends Model
{
    public string $name;

    public string $email;

    public string $user_agent;

    public string $user_ip;

    public string $created_at;

    public string $updated_at;

    public int $visits_count;

    public string $entry_time;

    public int $is_online;

    protected $table = "users";

    function __construct()
    {
        // load database/table on init of class
        // once converted to connect to DB this should be removed and replace with a query function/class
        $this->load();
    }

    public function findAll(string $field, mixed $value): mixed
    {
        if (!$this->getData()) {
            return null;
        }

        return array_filter($this->getData(), function($arr) use ($field, $value) {
            if ($arr->$field === $value) {
                return $arr;
            }   
        });
    }
}