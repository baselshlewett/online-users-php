<?php

namespace Models;

class Model 
{
    private $data = [];
    
    protected $table = "";

    public function load(): void
    {
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/db/" . $this->table . '.json');
        $this->setData(json_decode($file));
    }

    public function save(): bool
    {
        return file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/db/" . $this->table . '.json', json_encode($this->data, JSON_PRETTY_PRINT));
    }

    public function find(string $field, string $value): mixed
    {
        if (empty($this->data)) {
            return null;
        }

        $filteredUsers = array_filter($this->data, function($arr) use ($field, $value) {
            if ($arr->$field === $value) {
                return $arr;
            }   
        });

        return !empty($filteredUsers) ? array_shift($filteredUsers) : null;
    }

    public function fill(object $data): void
    {
        if ($this->find('email', $data->email)) {
            foreach ($this->data as $user) {
                if ($user->email === $data->email) {
                    $user = $data;
                }
            }
        } else {
            $this->data[] = $data;
        }
    }

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function getData(): mixed
    {
        return $this->data;
    }
}