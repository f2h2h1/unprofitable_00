<?php

namespace GpojectPHP\Models;

/**
 * Teacher
 */
class Teacher
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $subjectid;

    /**
     * @var int
     */
    private $classid;

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
     * Set userid.
     *
     * @param int $userid
     *
     * @return Teacher
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    
        return $this;
    }

    /**
     * Get userid.
     *
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Teacher
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
     * Set subjectid.
     *
     * @param int $subjectid
     *
     * @return Teacher
     */
    public function setSubjectid($subjectid)
    {
        $this->subjectid = $subjectid;
    
        return $this;
    }

    /**
     * Get subjectid.
     *
     * @return int
     */
    public function getSubjectid()
    {
        return $this->subjectid;
    }

    /**
     * Set classid.
     *
     * @param int $classid
     *
     * @return Teacher
     */
    public function setClassid($classid)
    {
        $this->classid = $classid;
    
        return $this;
    }

    /**
     * Get classid.
     *
     * @return int
     */
    public function getClassid()
    {
        return $this->classid;
    }

    /**
     * Set createtime.
     *
     * @param int $createtime
     *
     * @return Teacher
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
