<?php
declare(strict_types=1);
namespace app\entitiesTools ;

interface IArrayCollection {
	
	public function addObject($object);
	public function addArrayObject($object);
	public function removeObject($object);
	public function contains($object):bool;
	public function clear();
	public function isEmpty($object):bool;
	
	
}







?>