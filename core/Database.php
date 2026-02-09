<?php

class Database
{
    public static function connect() // use static because no object needed direct calling
    {
        // PHP Data Objects
        return new PDO(
            "mysql:host=localhost:dbname=php_mvc", //DSN string means Data Source Name tells PHP 
                                                   // which database to connect to and how for 
                                                   // postgresql just pgsql and for sqlite just use sqlite
                                                   // instead of mysql
            "root", // username
            "", //  password for local always ne null
             [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] // without this SQL errors fail silently and with this
                                                           // SQL errors throw exceptions
        );
    }
}

