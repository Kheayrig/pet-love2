<?php

class Database extends \mysqli
{
    public function __construct()
    {
        parent::__construct('127.0.0.1', 'root', NULL, 'pet_love');
    }
}