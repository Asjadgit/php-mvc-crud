<?php

class Database
{
    public static function connect() // use static because no object needed direct calling
    {
        // PHP Data Objects
        return new PDO(
            "mysql:host=127.0.0.1;port=53306;dbname=php_mvc;charset=utf8", //DSN string means Data Source Name tells PHP i am using 53306 port but default is 3306
                                                   // which database to connect to and how for 
                                                   // postgresql just pgsql and for sqlite just use sqlite
                                                   // instead of mysql
            "asjad", // username default root
            "asjad", //  password for local and default always null
             [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] // without this SQL errors fail silently and with this
                                                           // SQL errors throw exceptions
        );
    }
}

