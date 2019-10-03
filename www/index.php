<?php

require 'vendor/autoload.php';

use inc\Database\db;


try {
    $db = new db();
    $result = $db->query('SELECT * FROM students')->fetchAll();
    $db->close();

    var_dump($result);
} catch (Exception $e) {
    var_dump($e->getMessage());die;
}

