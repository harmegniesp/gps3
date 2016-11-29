<?php
declare(strict_types=1);
namespace app\entities;
use app\entitiesTools as T ;


class School
{
	use Hydrate;
	private $address = null;  		//string
	private $codeSchool = null; 	 //string
	private $id = 0;  				//int
	private $name = null; 			//string
	private $phone = null;			//string
	private $courses=null;			//ArrayCollection , attribut de l'association


	public function __construct()
	{
		$this->courses = new T\ArrayCollection();
	}


	public function getAddress():string
	{
		return $this->address;
	}


	public function setAddress(string $address)
	{
		$this->address = $address;
	}


	public function getCodeSchool():string
	{
		return $this->codeSchool;
	}


	public function setCodeSchool(string $codeSchool)
	{
		$this->codeSchool = $codeSchool;
	}


	public function getId():int
	{
		return $this->id;
	}


	public function setId(int $id)
	{
		$this->id = $id;
	}


	public function getName():string
	{
		return $this->name;
	}


	public function setName(string $name)
	{
		$this->name = $name;
	}


	public function getPhone():string
	{
		return $this->phone;
	}


	public function setPhone(string $phone)
	{
		$this->phone = $phone;
	}


	public function getCourses():T\ArrayCollection
	{
		return $this->courses;
	}


	public function setCourses(T\ArrayCollection $courses)
	{
		$this->courses = $courses;
	}



	public function __toString():string
	{
		$message = $this->name . ", matricule: " . $this->codeSchool ;
		return $message;
	}

	public static function fct_compare(School $obj1,School $obj2):int
	{
		return strcasecmp($obj1->name,$obj2->name);
	}

}
?>