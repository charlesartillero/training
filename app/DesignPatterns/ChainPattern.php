<?php

abstract class HomeChecker {

    protected $successor;

    abstract protected function check(HomeStatus $home);

    public function setSuccessor(HomeChecker $successor)
    {
        $this->successor = $successor;
    }

    public function next(HomeStatus $home) {

        if ($this->successor)
        {
            $this->successor->check($home);
        }

    }

}



class Locks extends HomeChecker {
    public function check(HomeStatus $home)
    {
        if (! $home->locks)
        {
            throw new \Exception("Locks not yet locked");
        }

        $this->next($home);
    }
}

class Lights extends HomeChecker {
    public function check(HomeStatus $home)
    {
        if (! $home->lights)
        {
            throw new \Exception("Lights not yet off");
        }

        $this->next($home);
    }
}

class Doors extends HomeChecker {
    public function check(HomeStatus $home)
    {
        if (! $home->doors)
        {
            throw new \Exception("Doors not yet closed");
        }

        $this->next($home);
    }
}

class HomeStatus {
    public $locks = true;
    public $doors = true;
    public $lights = true;
}

$locks = new Locks();
$doors = new Doors();
$lights = new Lights();


$locks->setSuccessor($lights);
$lights->setSuccessor($doors);


$locks->check(new HomeStatus());
