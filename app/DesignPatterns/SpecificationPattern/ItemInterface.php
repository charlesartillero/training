<?php

namespace App\DesignPatterns\SpecificationPattern;

interface ItemInterface
{
    public function getPrice(): float;
    public function getCategory(): string;
}
