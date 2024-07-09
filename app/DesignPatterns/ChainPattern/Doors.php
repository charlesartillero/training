<?php

namespace App\DesignPatterns\ChainPattern;
use App\DesignPatterns\ChainPattern\HomeStatus;
use App\DesignPatterns\ChainPattern\HomeChecker;

class Doors extends HomeChecker {
    public function check(HomeStatus $home)
    {
        if (! $home->doors())
        {
            throw new \Exception("Doors not yet closed");
        }

        return $this->next($home);
    }
}
