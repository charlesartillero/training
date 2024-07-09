<?php

namespace App\DesignPatterns\ChainPattern;
use App\DesignPatterns\ChainPattern\HomeStatus;

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

        return true;

    }

    public function getSuccessor()
    {
        return $this->successor;
    }


}
