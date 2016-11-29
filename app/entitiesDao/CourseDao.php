<?php
declare(strict_types=1);

namespace app\entitiesDao;


use dao\int;
use entities\Course;

class CourseDao extends Dao
{
    public function insert($object)
    {
        // TODO: Implement insert() method.
    }

    public function delete($object)
    {
        // TODO: Implement delete() method.
    }

    public function update($object)
    {
        // TODO: Implement update() method.
    }

    public function find(int $id)
    {
        // TODO: Implement find() method.
    }

    public function findAll()
    {
        // TODO: Implement findAll() method.
    }

    public function nbRecords()
    {
        // TODO: Implement nbRecords() method.
    }

    public function findWithLimit(int $position, int $group)
    {
        // TODO: Implement findWithLimit() method.
    }

    public function mergeLessons  (\app\entities\Course $object)
    {


    }

    public function mergeDocuments  (\app\entities\Course $object)
    {

    }

    public function mergeStudent_Courses (\app\entities\Course $object)
    {

    }

}

?>