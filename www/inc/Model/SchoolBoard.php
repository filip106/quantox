<?php

namespace inc\Model;

/**
 * Class SchoolBoard
 * @package inc\Model
 */
abstract class SchoolBoard
{
    /** @var string */
    const CSM_SCHOOL_BOARD = 'CSM';

    /** @var string */
    const CSMB_SCHOOL_BOARD = 'CSMB';

    /**
     * @param string $schoolBoard
     *
     * @return SchoolBoard|null
     *
     * @throws \Exception
     */
    public static function getSchoolBoard($schoolBoard)
    {
        switch ($schoolBoard) {
            case self::CSM_SCHOOL_BOARD:
                return CSMSchoolBoard::getInstance();
            case self::CSMB_SCHOOL_BOARD:
                return CSMBSchoolBoard::getInstance();
            default:
                throw new \Exception('School board not supported');
        }
    }

    /**
     * @return array
     */
    public static function getSupportedSchoolBoardType()
    {
        return [self::CSM_SCHOOL_BOARD, self::CSMB_SCHOOL_BOARD];
    }

    /**
     * @return string
     */
    public abstract function getFormat();

    /**
     * @param Student $student
     *
     * @return bool
     */
    public abstract function didStudentPass(Student $student);
}