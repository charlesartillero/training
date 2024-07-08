<?php

namespace App\DesignPatterns\SpecificationPattern\Specifications;


use App\DesignPatterns\SpecificationPattern\ItemInterface;

interface Specification
{
    public function isSatisfiedBy(ItemInterface $item): bool;
}
