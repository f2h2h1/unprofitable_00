<?php

namespace GPojectPHP\Models;

/**
 * @Entity
 * @Table(name="score")
 */
class Score
{
	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	private $id;

	/**
	 * @Column(type="integer")
	 */
	private $examid;

	/**
	 * @Column(type="integer")
	 */
	private $studentid;

	/**
	 * @Column(type="integer")
	 */
	private $score;

	/**
	 * @Column(type="integer")
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
