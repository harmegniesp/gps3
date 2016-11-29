<?php
declare(strict_types=1);
namespace app\entities;



class Student_Course
{
	use Hydrate;
	private $comment = null;		//string
	private $grade = null;			//string
	private $hasPassed = false;		//boolean
	private $rating = 0;			//float
	private $student=null;			//Student
	private $course=null;			//Course


	public function getComment():string
	{
		return $this->comment;
	}


	public function setComment($comment):string
	{
		$this->comment = $comment;
	}


	public function getGrade():string
	{
		return $this->grade;
	}


	public function setGrade(string $grade)
	{
		$this->grade = $grade;
	}


	public function isHasPassed():bool
	{
		return $this->hasPassed;
	}


	public function setHasPassed(bool $hasPassed)
	{
		$this->hasPassed = $hasPassed;
	}


	public function getRating():float
	{
		return $this->rating;
	}


	public function setRating(float $rating)
	{
		$this->rating = $rating;
	}


	public function getStudent():Student
	{
		return $this->student;
	}


	public function setStudent(Student $student)
	{
		$this->student = $student;
	}


	public function getCourse():Course
	{
		return $this->course;
	}


	public function setCourse(Course $course)
	{
		$this->course = $course;
	}



}
?>