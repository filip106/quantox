<?php

namespace inc\Formatter;

use inc\Model\SchoolBoard;
use inc\Model\Student;

/**
 * Class Formatter
 * @package inc\Formatter
 */
abstract class Formatter
{
    /**
     * @param string $format
     *
     * @return Formatter|null
     */
    public static function getFormatter($format)
    {
        if ($format === 'xml') {
            return XmlFormatter::getInstance();
        }

        /** if n ot specified, fallback to json format */
        return JsonFormatter::getInstance();
    }

    /**
     * Return formatted response for provided array
     * @param array $response
     *
     * @return mixed
     */
    public abstract function formatResult($response);

    /**
     * @param Student $student
     * @param string $schoolBoard
     *
     * @return array
     *
     * @throws \Exception
     */
    public function serializeStudentToArray(Student $student, $schoolBoard)
    {
        $studentPass = SchoolBoard::getSchoolBoard($schoolBoard)->didStudentPass($student);
        $response = [
            'id' => $student->getId(),
            'name' => $student->getName(),
            'grades' => array_map(function ($grade) {
                /** @var \inc\Model\StudentGrade $grade */
                return [
                    'id' => $grade->getId(),
                    'grade' => $grade->getGrade()
                ];
            }, $student->getGrades()),
            'average' => $student->getAverageGrades(),
            'result' => $studentPass ? 'pass' : 'fail'
        ];

        return $response;
    }
}