<?php

namespace GpojectPHP\Models;

/**
 * Score
 */
class Score
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $examid;

    /**
     * @var int
     */
    private $studentid;

    /**
     * @var int
     */
    private $score;

    /**
     * @var int
     */
    private $createtime;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set examid.
     *
     * @param int $examid
     *
     * @return Score
     */
    public function setExamid($examid)
    {
        $this->examid = $examid;
    
        return $this;
    }

    /**
     * Get examid.
     *
     * @return int
     */
    public function getExamid()
    {
        return $this->examid;
    }

    /**
     * Set studentid.
     *
     * @param int $studentid
     *
     * @return Score
     */
    public function setStudentid($studentid)
    {
        $this->studentid = $studentid;
    
        return $this;
    }

    /**
     * Get studentid.
     *
     * @return int
     */
    public function getStudentid()
    {
        return $this->studentid;
    }

    /**
     * Set score.
     *
     * @param int $score
     *
     * @return Score
     */
    public function setScore($score)
    {
        $this->score = $score;
    
        return $this;
    }

    /**
     * Get score.
     *
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set createtime.
     *
     * @param int $createtime
     *
     * @return Score
     */
    public function setCreatetime($createtime)
    {
        $this->createtime = $createtime;
    
        return $this;
    }

    /**
     * Get createtime.
     *
     * @return int
     */
    public function getCreatetime()
    {
        return $this->createtime;
    }
}
