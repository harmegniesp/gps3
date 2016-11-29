<?php
declare(strict_types=1);
namespace app\dao;
interface Observer {
    public function update($value);
}