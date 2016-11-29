<?php
declare(strict_types=1);
namespace app\entities;
use app\entitiesTools as T ;

class Document
{
	use Hydrate;
	private $format = null;				//string
	private $id = 0;					//int
	private $pathDocument = null;		//string
	private $size = 0;					// int
	private $uploadedDate = null;		//DateTime
	private $comment=null;				//string
	private $name=null;					//string , le nom du fichier du client
	private $nameCreate=null;           //string , un nom de fichier généré et unique


	public function getName():string
	{
		return $this->name;
	}


	public function setName(string $name)
	{
		$this->name = $name;
	}


	public function getNameCreate():string
	{
		return $this->nameCreate;
	}


	public function setNameCreate(string $nameCreate)
	{
		$this->nameCreate = $nameCreate;
	}


	public function getFormat():string
	{
		return $this->format;
	}


	public function setFormat(string $format)
	{
		$this->format = $format;
	}


	public function getId():int
	{
		return $this->id;
	}


	public function setId(int $id)
	{
		$this->id = $id;
	}


	public function getPathDocument():string
	{
		return $this->pathDocument;
	}


	public function setPathDocument(string $pathDocument)
	{
		$this->pathDocument = $pathDocument;
	}


	public function getSize():int
	{
		return $this->size;
	}


	public function setSize(int $size)
	{
		$this->size = $size;
	}


	public function getUploadedDate():\DateTime
	{
		return $this->uploadedDate;
	}


	public function setUploadedDate(\DateTime $uploadedDate)
	{
		$this->uploadedDate = $uploadedDate;
	}


	public function getComment():string
	{
		return $this->comment;
	}


	public function setComment(string $comment)
	{
		$this->comment = $comment;
	}



	public function __toString():string
	{
		$message = $this->pathDocument . ", " . $this->uploadedDate->format(T\Parameters::FORMAT_DATETIME);
		return $message;
	}

	public static function fct_compare(Document $obj1,Document $obj2):int
	{
		$interval=$obj1->uploadedDate->diff($obj2->uploadedDate);
		$diff=$interval->days;
		// voir classe DateTime::diff  ou utiliser Timestamp pour comparer 2 dates
		if($diff > 0)
			return 1;
		elseif ($diff==0)
			return 0;
		else
			return -1;
		// triage par ordre decroissant des dates
		// tenir compte aussi de l'heure pour trier
	}

}
?>