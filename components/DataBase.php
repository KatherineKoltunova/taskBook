<?php

class DataBase
{
    public static function getConnect()
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS);
        return $db;
    }

}