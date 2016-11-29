<?php
declare(strict_types=1);
namespace app\entities;
use app\entitiesTools as T ;


class Student
{
	use Hydrate;
	private $birthday = null;		//DateTime
	private $email = null;			//String
	private $firstname = null;		//String
	private $id = 0;				//int
	private $lastname = null;		//String
	private $phone = null;			//String
	private $studentLessons=null;	//ArrayCollection
	private $address=null;			//Address
	private $studentCourses=null;	//ArrayCollection
	private $password=null;			//string , attention convertir avant avec HASH('sha-256','  ')


	public function __construct()
	{
		$this->studentCourses = new T\ArrayCollection();
		$this->studentLessons = new T\ArrayCollection();
	}

	public function getPassword():string
	{
		return $this->password;
	}


	public function setPassword(string $password)
	{
		$this->password = $password;
	}



	public function getBirthday():\DateTime
	{
		return $this->birthday;
	}


	public function setBirthday(\DateTime $birthday)
	{
		$this->birthday = $birthday;
	}


	public function getEmail():string
	{
		return $this->email;
	}


	public function setEmail(string $email)
	{
		$this->email = $email;
	}


	public function getFirstname():string
	{
		return $this->firstname;
	}


	public function setFirstname(string $firstname)
	{
		$this->firstname = $firstname;
	}


	public function getId():int
	{
		return $this->id;
	}


	public function setId(int $id)
	{
		$this->id = $id;
	}


	public function getLastname():string
	{
		return $this->lastname;
	}


	public function setLastname(string $lastname)
	{
		$this->lastname = $lastname;
	}


	public function getPhone():string
	{
		return $this->phone;
	}


	public function setPhone(string $phone)
	{
		$this->phone = $phone;
	}


	public function getStudentLessons():T\ArrayCollection
	{
		return $this->studentLessons;
	}


	public function setStudentLessons(T\ArrayCollection $studentLessons)
	{
		$this->studentLessons = $studentLessons;
	}


	public function getAddress():Address
	{
		return $this->address;
	}


	public function setAddress(Adress $address)
	{
		$this->address = $address;
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

		$message = $this->lastname . " " . $this->firstname . ", " . $this->birthday->format(T\Parameters::FORMAT_DATE);
		return $message;
	}


	public static function fct_compare(Student $obj1,Student $obj2):int
	{
		if (strcasecmp($obj1->lastname,$obj2->lastname) != 0 )
			return strcasecmp($obj1->lastname,$obj2->lastname);
		else
			return strcasecmp($obj1->firstname,$obj2->firstname);
	}
	// tester aussi selon le birthday (DateTime)
}
?>