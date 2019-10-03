<?php

require 'vendor/autoload.php';

use inc\Model\SchoolBoard;
use inc\Model\Student;
use inc\Database\db;

try {
    $db = new db();

    $mapper = [
        's.id' => 'student_id',
        's.name' => 'student_name',
        's.school_board' => 'student_school_board',
        'sg.id' => 'grade_id',
        'sg.grade' => 'student_grade',
    ];
    $sql = sprintf(
        'SELECT %s FROM students s LEFT JOIN student_grades sg ON s.id=sg.student_id WHERE s.id = ?',
        implode(', ', array_map(
            function ($v, $k) {
                return sprintf("%s as %s", $k, $v);
            },
            $mapper,
            array_keys($mapper)
        )));

    $studentId = $_GET['student'];
    $result = $db->query($sql, $studentId)->fetchAll();
    $db->close();

    var_dump($result);
} catch (Exception $e) {
    var_dump($e->getMessage());die;
}

