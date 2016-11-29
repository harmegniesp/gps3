<?php
declare(strict_types=1);
namespace app\entities;
use app\entitiesTools as T ;

class Lesson
{
	use Hydrate;
	private $absenceTeacher = false;		//boolean
	private $classroom = null;				//string
	private $date = null;					//DateTime
	private $dateChanged = null;			//DateTime
	private $id = 0;						//int
	private $nbPeriods = 0;					//int
	private $studentLessons=null;			//ArrayCollection


	public function __construct()
	{
		$this->studentLessons = new T\ArrayCollection() ;
	}


	public function isAbsenceTeacher():bool
	{
		return $this->absenceTeacher;
	}


	public function setAbsenceTeacher(bool $absenceTeacher)
	{
		$this->absenceTeacher = $absenceTeacher;
	}


	public function getClassroom():string
	{
		return $this->classroom;
	}


	public function setClassroom(string $classroom)
	{
		$this->classroom = $classroom;
	}


	public function getDate():\DateTime
	{
		return $this->date;
	}


	public function setDate(\DateTime $date)
	{
		$this->date = $date;
	}


	public function getDateChanged():\DateTime
	{
		return $this->dateChanged;
	}


	public function setDateChanged(\DateTime $dateChanged)
	{
		$this->dateChanged = $dateChanged;
	}


	public function getId():int
	{
		return $this->id;
	}


	public function setId(int $id)
	{
		$this->id = $id;
	}


	public function getNbPeriods():int
	{
		return $this->nbPeriods;
	}


	public function setNbPeriods(int $nbPeriods)
	{
		$this->nbPeriods = $nbPeriods;
	}


	public function getStudentLessons():T\ArrayCollection
	{
		return $this->studentLessons;
	}


	public function setStudentLessons(T\ArrayCollection $studentLessons)
	{
		$this->studentLessons = $studentLessons;
	}


	public function __toString():string
	{
		$message = "Leçon: " . $this->date->format(T\Parameters::FORMAT_DATE);
		return $message;
	}

	public static function fct_compare(Lesson $obj1, Lesson $obj2):int
	{
		$interval=$obj1->date->diff($obj2->date);
		$diff=$interval->days;
		// voir classe DateTime::diff  ou utiliser Timestamp pour comparer 2 dates
		if($diff > 0)
			return 1;
		elseif ($diff==0)
			return 0;
		else
			return -1;
	}

}
?>