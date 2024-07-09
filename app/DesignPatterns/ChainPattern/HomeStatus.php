<?php

namespace App\DesignPatterns\ChainPattern;

class HomeStatus {
    function __construct(
        private bool $locks,
        private bool $doors,
        private bool $lights)
    {

    }

    public function locks(): bool {
        return $this->locks;
    }

    public function doors(): bool {
        return $this->doors;
    }

    public function lights(): bool {
        return $this->lights;
    }
}
