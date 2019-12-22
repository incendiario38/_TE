<?php

require_once 'config.php';

class DB
{

    protected $connection;

    public function __construct()
    {
        $this->connection = new PDO(DSN, USERNAME, PASSWORD, OPTIONS);
    }
}