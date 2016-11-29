<?php
declare(strict_types=1);
namespace app\entities;


trait Hydrate{

	public function hydrate($array){
        foreach ($array as $key=>$value){
            $methode = "set".ucfirst($key);
            if (method_exists($this, $methode)){

                $this->$methode($value);
            }
        }
    }	
}
?>