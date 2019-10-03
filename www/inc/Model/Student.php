<?php

namespace inc\Model;

/**
 * Class Student
 * @package inc\Model
 */
class Student
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $schoolBoard;

    /** @var array */
    private $grades = [];

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Student
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Student
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSchoolBoard()
    {
        return $this->schoolBoard;
    }

    /**
     * @param string $schoolBoard
     *
     * @return Student
     */
    public function setSchoolBoard($schoolBoard)
    {
        $this->schoolBoard = $schoolBoard;

        return $this;
    }

    /**
     * @return array
     */
    public function getGrades()
    {
        return $this->grades;
    }

    /**
     * @return float
     */
    public function getAverageGrades()
    {
        if (0 === count($this->grades)) {
            return 0;
        }

        return array_sum(array_map(function ($grade) {
                /** @var \inc\Model\StudentGrade $grade */
                return $grade->getGrade();
            }, $this->grades)) / count($this->grades);
    }

    /**
     * @param array $grades
     *
     * @return Student
     */
    public function setGrades($grades)
    {
        $this->grades = $grades;

        return $this;
    }

    public function addGrade($grade)
    {
        $this->grades[] = $grade;

        return $this;
    }
}