<?php

namespace inc\Model;

/**
 * Class StudentGrade
 * @package inc\Model
 */
class StudentGrade
{

    /** @var int */
    private $id;

    /** @var Student */
    private $student;

    /** @var float */
    private $grade;

    /** @var string */
    private $subject;

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
     * @return StudentGrade
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param Student $student
     *
     * @return StudentGrade
     */
    public function setStudent($student)
    {
        $this->student = $student;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @param float $grade
     *
     * @return StudentGrade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return StudentGrade
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }
}