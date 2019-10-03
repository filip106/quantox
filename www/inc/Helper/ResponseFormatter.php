<?php

namespace inc\Helper;

use inc\Model\Student;
use inc\Model\StudentGrade;

/**
 * Class ResponseFormatter
 * @package inc\Helper
 */
class ResponseFormatter
{
    /** @var ResponseFormatter */
    public static $instance;

    private function __construct()
    {
    }

    /**
     * @return ResponseFormatter
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new ResponseFormatter();
        }

        return self::$instance;
    }

    /**
     * Serialize result of query to Student Object
     * @param array $queryResult
     * @param array $mapper
     *
     * @return Student|null
     */
    public function serializeStudentObject($queryResult, $mapper)
    {
        $grades = [];
        $student = new Student();

        $rowsNum = \count($queryResult);
        if (0 === $rowsNum) {
            return null;
        }

        $student->setId($queryResult[0][$mapper['s.id']]);
        $student->setName($queryResult[0][$mapper['s.name']]);
        $student->setSchoolBoard($queryResult[0][$mapper['s.school_board']]);

        if (1 === $rowsNum && null === $queryResult[0][$mapper['sg.id']]) {
            return $student;
        }

        foreach ($queryResult as $item) {
            $grade = new StudentGrade();
            $grade->setId($item[$mapper['sg.id']]);
            $grade->setGrade($item[$mapper['sg.grade']]);
//            $grade->setStudent($student);

            $grades[] = $grade;
        }

        $student->setGrades($grades);

        return $student;
    }
}