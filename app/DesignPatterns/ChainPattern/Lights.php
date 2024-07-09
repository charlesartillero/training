<?php

namespace App\DesignPatterns\ChainPattern;
use App\DesignPatterns\ChainPattern\HomeStatus;
use App\DesignPatterns\ChainPattern\HomeChecker;

class Lights extends HomeChecker {
    public function check(HomeStatus $home)
    {
        if (! $home->lights())
        {
            throw new \Exception("Lights not yet off");
        }

        return $this->next($home);
    }
}
