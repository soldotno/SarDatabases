Plain Database module for ZF2
==============================
A ZF2 module to make connecting to databases a breeze

Currently only includes support for MongoDB, but more will be added eventually

== 

###More info

http://blog.robbestad.com

### How to use

In your composer.json, add the following line

    "svenanders/sardatabases": "dev-master"

Add the following line to your **application.config.php**:

    'modules' => array(
        'SarDatabases',
    ),
  

In your code, include the class:

    use SarDatabases;

and then in your functions, use it like this:

    $dbConn = new Databases\SarMongo("environment", "database", "collection");
    $cursor = $dbConn->find(array("key" => "value"));

Supports:

    ->find
    ->insert
    ->update
    ->delete

Tests: 

execute **phpunit vendor/svenanders/sardatabases/tests/** from the root of your project to run the tests

==
License:

Sven Anders Robbestad (C) 2014

<img src="http://i.creativecommons.org/l/by/3.0/88x31.png" alt="CC BY">

