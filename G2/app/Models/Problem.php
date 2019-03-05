<?php

namespace GPojectPHP\Models;

/**
 * Problem
 */
class Problem
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
    private $type;

    /**
     * @var int
     */
    private $knowledgeid;

    /**
     * @var string
     */
    private $describe;

    /**
     * @var string
     */
    private $answer;

    /**
     * @var int
     */
    private $createtime;

    /**
     * @var int
     */
    private $updatetime;


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
     * @return Problem
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
     * Set type.
     *
     * @param int $type
     *
     * @return Problem
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set knowledgeid.
     *
     * @param int $knowledgeid
     *
     * @return Problem
     */
    public function setKnowledgeid($knowledgeid)
    {
        $this->knowledgeid = $knowledgeid;
    
        return $this;
    }

    /**
     * Get knowledgeid.
     *
     * @return int
     */
    public function getKnowledgeid()
    {
        return $this->knowledgeid;
    }

    /**
     * Set describe.
     *
     * @param string $describe
     *
     * @return Problem
     */
    public function setDescribe($describe)
    {
        $this->describe = $describe;
    
        return $this;
    }

    /**
     * Get describe.
     *
     * @return string
     */
    public function getDescribe()
    {
        return $this->describe;
    }

    /**
     * Set answer.
     *
     * @param string $answer
     *
     * @return Problem
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    
        return $this;
    }

    /**
     * Get answer.
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set createtime.
     *
     * @param int $createtime
     *
     * @return Problem
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

    /**
     * Set updatetime.
     *
     * @param int $updatetime
     *
     * @return Problem
     */
    public function setUpdatetime($updatetime)
    {
        $this->updatetime = $updatetime;
    
        return $this;
    }

    /**
     * Get updatetime.
     *
     * @return int
     */
    public function getUpdatetime()
    {
        return $this->updatetime;
    }
}
