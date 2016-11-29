<?php
declare(strict_types=1);
namespace app\entities;


class Student_Lesson
{
	use Hydrate;
	private $certificate = false;			//boolean
	private $comment = null;				//string
	private $hasArrivedLate = false;		//boolean
	private $hasAttend = false;				//boolean
	private $hasLeftEarlier = false;		//boolean
	private $motive = false;				//boolean
	private $testSession = 0;				//int
	private $lesson=null;					//Lesson
	private $student=null;					//Student
	private $scanCertificate=null;			//string , mettre dans un dossier securisé


	public function isCertificate():bool
	{
		return $this->certificate;
	}


	public function setCertificate(bool $certificate)
	{
		$this->certificate = $certificate;
	}


	public function getComment():string
	{
		return $this->comment;
	}


	public function setComment(string $comment)
	{
		$this->comment = $comment;
	}


	public function isHasArrivedLate():bool
	{
		return $this->hasArrivedLate;
	}


	public function setHasArrivedLate(bool $hasArrivedLate)
	{
		$this->hasArrivedLate = $hasArrivedLate;
	}


	public function isHasAttend():bool
	{
		return $this->hasAttend;
	}


	public function setHasAttend(bool $hasAttend)
	{
		$this->hasAttend = $hasAttend;
	}


	public function isHasLeftEarlier():bool
	{
		return $this->hasLeftEarlier;
	}


	public function setHasLeftEarlier(bool $hasLeftEarlier)
	{
		$this->hasLeftEarlier = $hasLeftEarlier;
	}


	public function isMotive():bool
	{
		return $this->motive;
	}


	public function setMotive(bool $motive)
	{
		$this->motive = $motive;
	}


	public function getTestSession():int
	{
		return $this->testSession;
	}


	public function setTestSession(int $testSession)
	{
		$this->testSession = $testSession;
	}


	public function getLesson():Lesson
	{
		return $this->lesson;
	}


	public function setLesson(Lesson $lesson)
	{
		$this->lesson = $lesson;
	}


	public function getStudent():Student
	{
		return $this->student;
	}


	public function setStudent(Student $student)
	{
		$this->student = $student;
	}


	public function getScanCertificate():string
	{
		return $this->scanCertificate;
	}


	public function setScanCertificate(string $scanCertificate)
	{
		$this->scanCertificate = $scanCertificate;
	}




}
?>