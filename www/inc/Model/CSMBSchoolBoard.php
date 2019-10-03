<?php

namespace inc\Model;


class CSMBSchoolBoard extends SchoolBoard
{
    /** @var CSMBSchoolBoard */
    private static $instance;

    private function __construct()
    {
    }

    /**
     * @return CSMBSchoolBoard
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new CSMBSchoolBoard();
        }

        return self::$instance;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return 'xml';
    }

    /**
     * @param Student $student
     *
     * @return bool
     */
    public function didStudentPass(Student $student)
    {
        $max = reset($student->getGrades());
        $minIndex = 0;

        /** @var StudentGrade $grade */
        foreach ($student->getGrades() as $key => $grade) {
            $max = max($max, $grade->getGrade());
            $minIndex = $student->getGrades()[$minIndex]->getGrade() > $grade->getGrade() ? $key : $minIndex;
        }

        if (\count($student->getGrades()) > 2) {
            $allGrades = $student->getGrades();
            \array_splice($allGrades, $minIndex, 1);
            $student->setGrades($allGrades);
        }

        return $max > 8;
    }
}