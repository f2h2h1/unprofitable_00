<?php

namespace GpojectPHP\Models;

/**
 * Studymaterials
 */
class Studymaterials
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
    private $teacherid;

    /**
     * @var int
     */
    private $subjectid;

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
     * @return Studymaterials
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
     * Set teacherid.
     *
     * @param int $teacherid
     *
     * @return Studymaterials
     */
    public function setTeacherid($teacherid)
    {
        $this->teacherid = $teacherid;
    
        return $this;
    }

    /**
     * Get teacherid.
     *
     * @return int
     */
    public function getTeacherid()
    {
        return $this->teacherid;
    }

    /**
     * Set subjectid.
     *
     * @param int $subjectid
     *
     * @return Studymaterials
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
     * Set path.
     *
     * @param string $path
     *
     * @return Studymaterials
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
     * @return Studymaterials
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
