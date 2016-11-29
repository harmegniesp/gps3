<?php
declare(strict_types=1);
namespace app\entities;
use app\entitiesTools as T;             // alias du namespace


class Address
{
	use Hydrate;
	private $city = null;		//string
	private $country = null;	//string
	private $id = 0;			//int
	private $street = null;		//string
	private $zipCode = null;	//string
	private $students=null;		//Arraycollection

	public function __construct()
	{
		$this->students = new T\ArrayCollection();
	}

	public function getCity():string
	{
		return $this->city;
	}


	public function setCity(string $city)
	{
		$this->city = $city;
	}


	public function getCountry():string
	{
		return $this->country;
	}


	public function setCountry(string $country)
	{
		$this->country = $country;
	}


	public function getId():int
	{
		return $this->id;
	}


	public function setId(int $id)
	{
		$this->id = $id;
	}


	public function getStreet():string
	{
		return $this->street;
	}


	public function setStreet(string $street)
	{
		$this->street = $street;
	}


	public function getZipCode():string
	{
		return $this->zipCode;
	}


	public function setZipCode(string $zipCode)
	{
		$this->zipCode = $zipCode;
	}


	public function getStudents():T\ArrayCollection
	{
		return $this->students;
	}


	public function setStudents(T\ArrayCollection $students)
	{
		$this->students = $students;
	}


	public static function fct_compare(Address $obj1,Address $obj2):int
	{
		if(strcasecmp($obj1->country,$obj2->country) != 0 )
			return strcasecmp($obj1->country,$obj2->country);
		elseif (strcasecmp($obj1->city,$obj2->city) != 0 )
			return strcasecmp($obj1->city,$obj2->city);
		else
			return strcasecmp($obj1->street,$obj2->street);
	}

	public function __toString():string
	{
		$message=$this->country . ", " . $this->street . ", " . $this->zipCode . " " . $this->city ;
		return $message;
	}
}
?>