<?php
declare(strict_types=1);
namespace app\entitiesTools ;

class ArrayCollection implements IArrayCollection,\Iterator,\Countable{
  
	private $array=null;
	private $position=0; // pour l'iterator

	public function __construct(){
		$this->array = array ();
	
	}

	/**
	 * @return array|null
	 */
	public function getArray()
	{
		return $this->array;
	}

	/**
	 * @param array|null $array
	 */
	public function setArray($array)
	{
		$this->array = $array;
	}


  public function addObject($object)
    {
        // TODO: Implement addObject() method.// if: vérifie si objet existe pas et si y'a pas un doublons
		if ($object!=null && !$this->contains($object)){
			$this->array[] = $object;
		}
    }

	// on met un tableau d'objet dans une collection
    public function addArrayObject($array)
    {
        // TODO: Implement addArrayObject() method.
		if ($array!=null){
			for($i=0;$i<count($array);$i++){
				if(!$this->contains($array[$i]))
				$this->array[] = $array[$i];
			}
		}
    }

	public function addArrayObject2($array)
	{
		// TODO: Implement addArrayObject() method.
		if ($array!=null){
			for($i=0;$i<count($array);$i++){
				$this->addObject($array[$i]);
			}
		}
	}



	public function addArrayCollection($obj){
		if ($obj != null && $obj instanceof \entitiesTools\ArrayCollection){  // verifie si objet est de la classe arraycollection
			$array= $this->getArray() ;  // on importe le tableau dans un tableau provisoire
			foreach ($array as $value){
				if( !$this->contains($value) )
				$this->array = $value;
			}
		}

	}

    //condition arraycollection doit implémenter l'interface
	public function addArrayCollection2($obj){
		if ($obj != null && $obj instanceof \entitiesTools\ArrayCollection){

			foreach ($obj as $value){
				if( !$this->contains($value) )
				$this->array = $value;
			}
		}

	}

    public function removeObject($object)
    {
        // TODO: Implement removeObject() method.
		if ($object!=null && !$this->contains($object)){
			foreach ($this->array as $key=>$value){
				if($value===$object)
					unset($this->array[$key]); // supprimer la cellule mais il faut réaffecter les keys de mon tableau
					$this->array = array_values($this->array);
			}
		}
    }

    public function contains($object):bool
    {
        // TODO: Implement contains() method.
		if ($object!=null){
			foreach($this->array as $value){
				if($value === $object)
					return true;
			}
		}
		return false;
    }

    public function clear()
    {
        // TODO: Implement clear() method.
		$this->array = array();
    }

    public function isEmpty($object):bool
    {
        // TODO: Implement isEmpty() method.
		if(count($this->array) == 0 )
			return true;
		else
			return false;
    }

    public function sort()
    {
        // TODO: Implement sort() method.
		if( !$this->isEmpty($this->array)){
			$nameclass=get_class($this->array[0]);
			usort($this->array,array($nameclass,"fctCompare"));
		}
    }

    public function current()
    {
        // TODO: Implement current() method.
		return $this->array[$this->position];
    }

    public function next()
    {
        // TODO: Implement next() method.
		$this->position++;
    }

    public function key()
    {
        // TODO: Implement key() method.
		return $this->position;
    }

    public function valid()
    {
        // TODO: Implement valid() method.
		return isset($this->array[$this->position]);
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
		$this->position=0;
    }

    public function count():int
    {
        // TODO: Implement count() method.
		return count($this->array);
    }


}



?>