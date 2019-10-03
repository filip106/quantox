<?php

namespace inc\Model;

/**
 * Class CSMSchoolBoard
 * @package inc\Model
 */
class CSMSchoolBoard extends SchoolBoard
{
    /** @var CSMSchoolBoard */
    private static $instance;

    private function __construct()
    {
    }

    /**
     * @return CSMSchoolBoard
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new CSMSchoolBoard();
        }

        return self::$instance;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return 'json';
    }

    /**
     * @param Student $student
     *
     * @return bool
     */
    public function didStudentPass(Student $student)
    {
        $total = array_sum(array_map(function ($studentGrade) {
            /** @var StudentGrade $studentGrade */

            return $studentGrade->getGrade();
        }, $student->getGrades()));

        return $total / \count($student->getGrades()) >= 7;
    }
}