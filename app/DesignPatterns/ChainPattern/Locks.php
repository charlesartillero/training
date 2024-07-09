<?php

namespace App\DesignPatterns\ChainPattern;
use App\DesignPatterns\ChainPattern\HomeStatus;
use App\DesignPatterns\ChainPattern\HomeChecker;

class Locks extends HomeChecker {
    public function check(HomeStatus $home)
    {
        if (! $home->locks())
        {
            throw new \Exception("Locks not yet locked");
        }

        return $this->next($home);
    }
}
