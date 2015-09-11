<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */

    'fetch' => PDO::FETCH_CLASS,

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'sqlsrv_one'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => storage_path('database.sqlite'),
            'prefix'   => '',
        ],

        'mysql_one' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST_MYSQL'),
            'database'  => env('DB_DATABASE_MYSQL_ONE'),
            'username'  => env('DB_USERNAME_MYSQL'),
            'password'  => env('DB_PASSWORD_MYSQL'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],

        'mysql_two' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST_MYSQL'),
            'database'  => env('DB_DATABASE_MYSQL_TWO'),
            'username'  => env('DB_USERNAME_MYSQL'),
            'password'  => env('DB_PASSWORD_MYSQL'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],

        'sqlsrv_one' => [
            'driver'   => 'sqlsrv',
            'host'     => env('DB_HOST_SRV_ONE'),
            'database' => env('DB_DATABASE_SRV_ONE'),
            'username' => env('DB_USERNAME_SRV_ONE'),
            'password' => env('DB_PASSWORD_SRV_ONE'),
            'charset'  => 'utf8',
            'prefix'   => '',
        ],

        'sqlsrv_two' => [
            'driver'   => 'sqlsrv',
            'host'     => env('DB_HOST_SRV_TWO'),
            'database' => env('DB_DATABASE_SRV_TWO'),
            'username' => env('DB_USERNAME_SRV_TWO'),
            'password' => env('DB_PASSWORD_SRV_TWO'),
            'charset'  => 'utf8',
            'prefix'   => '',
        ],

        'sqlsrv_three' => [
            'driver'   => 'sqlsrv',
            'host'     => env('DB_HOST_SRV_THREE'),
            'database' => env('DB_DATABASE_SRV_THREE'),
            'username' => env('DB_USERNAME_SRV_THREE'),
            'password' => env('DB_PASSWORD_SRV_THREE'),
            'charset'  => 'utf8',
            'prefix'   => '',
        ],

        'sqlsrv_four' => [
            'driver'   => 'sqlsrv',
            'host'     => env('DB_HOST_SRV_FOUR'),
            'database' => env('DB_DATABASE_SRV_FOUR'),
            'username' => env('DB_USERNAME_SRV_FOUR'),
            'password' => env('DB_PASSWORD_SRV_FOUR'),
            'charset'  => 'utf8',
            'prefix'   => '',
        ],


    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'cluster' => false,

        'default' => [
            'host'     => '127.0.0.1',
            'port'     => 6379,
            'database' => 0,
        ],

    ],

];
