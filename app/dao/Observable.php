<?php
declare(strict_types=1);
namespace app\dao;
interface Observable {
    public function attach($observer);
    public function detach($observer);
    public function notify();
}