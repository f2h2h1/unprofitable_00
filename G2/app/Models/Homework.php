<?php

namespace GPojectPHP\Models;

/**
 * Homework
 */
class Homework
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $examid;

    /**
     * @var int
     */
    private $studentid;

    /**
     * @var string
     */
    private $path;

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
     * Set name.
     *
     * @param string $name
     *
     * @return Homework
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set examid.
     *
     * @param int $examid
     *
     * @return Homework
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
     * @return Homework
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
     * Set path.
     *
     * @param string $path
     *
     * @return Homework
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set createtime.
     *
     * @param int $createtime
     *
     * @return Homework
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
