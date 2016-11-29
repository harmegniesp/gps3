<?php
declare(strict_types=1);
namespace app\entities;
use app\entitiesTools as T ;

class Course
{
	use Hydrate;
	private $codeCourse = null; 	 //string
	private $codeUt = null;			//string
	private $endDate = null;		//DateTime
	private $id = 0;				//int
	private $lessonNumber = 0;		//int
	private $name = null;			//string
	private $nbPeriods = 0;			//int
	private $pathDocument = null;	//string
	private $startDate = null;		//DateTime
	private $timeslot = null;		//string
	private $school=null;			//objet de type Schools
	private $lessons=null;			//ArrayCollection
	private $documents=null;		//ArrayCollection
	private $studentCourses=null;	//ArrayCollection

	public function __construct()
	{
		$this->lessons = new T\ArrayCollection();
		$this->documents = new T\ArrayCollection();
		$this->studentCourses = new T\ArrayCollection();
	}


	public function getCodeCourse():string
	{
		return $this->codeCourse;
	}


	public function setCodeCourse(string $codeCourse)
	{
		$this->codeCourse = $codeCourse;
	}


	public function getCodeUt():string
	{
		return $this->codeUt;
	}


	public function setCodeUt(string $codeUt)
	{
		$this->codeUt = $codeUt;
	}


	public function getEndDate():\DateTime
	{
		return $this->endDate;
	}


	public function setEndDate(\DateTime $endDate)
	{
		$this->endDate = $endDate;
	}


	public function getId():int
	{
		return $this->id;
	}


	public function setId(int $id)
	{
		$this->id = $id;
	}


	public function getLessonNumber():int
	{
		return $this->lessonNumber;
	}


	public function setLessonNumber(int $lessonNumber)
	{
		$this->lessonNumber = $lessonNumber;
	}


	public function getName():string
	{
		return $this->name;
	}


	public function setName(string $name)
	{
		$this->name = $name;
	}


	public function getNbPeriods():int
	{
		return $this->nbPeriods;
	}


	public function setNbPeriods(int $nbPeriods)
	{
		$this->nbPeriods = $nbPeriods;
	}


	public function getPathDocument():string
	{
		return $this->pathDocument;
	}


	public function setPathDocument(string $pathDocument)
	{
		$this->pathDocument = $pathDocument;
	}


	public function getStartDate():\DateTime
	{
		return $this->startDate;
	}


	public function setStartDate(\DateTime $startDate)
	{
		$this->startDate = $startDate;
	}


	public function getTimeslot():string
	{
		return $this->timeslot;
	}


	public function setTimeslot(string $timeslot)
	{
		$this->timeslot = $timeslot;
	}


	public function getSchool():School
	{
		return $this->school;
	}


	public function setSchool(School $school)
	{
		$this->school = $school;
	}


	public function getLessons():T\ArrayCollection
	{
		return $this->lessons;
	}


	public function setLessons(T\ArrayCollection $lessons)
	{
		$this->lessons = $lessons;
	}


	public function getDocuments():T\ArrayCollection
	{
		return $this->documents;
	}


	public function setDocuments(T\ArrayCollection $documents)
	{
		$this->documents = $documents;
	}


	public function getStudentCourses():T\ArrayCollection
	{
		return $this->studentCourses;
	}


	public function setStudentCourses(T\ArrayCollection $studentCourses)
	{
		$this->studentCourses = $studentCourses;
	}

	public function __toString():string
	{
		$message = $this->name . ", code:" . $this->codeCourse . " \n";
		if ($this->startDate != null && $this->endDate != null){
			$message .= ",date début :" . $this->startDate->format(T\Parameters::FORMAT_DATE) ." \n";
			$message .= ",date fin :" . $this->endDate->format(T\Parameters::FORMAT_DATE) ;
		}
		return $message ;
	}

	public static function fct_compare(Course $obj1, Course $obj2):int
	{
		return strcasecmp($obj1->name,$obj2->name);
	}

}
?>