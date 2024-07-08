<?php

namespace App\DesignPatterns\SpecificationPattern\Specifications;


use App\DesignPatterns\SpecificationPattern\ItemInterface;

class PriceSpecification implements Specification
{
    function __construct(private float $minPrice, private float $maxPrice){}

    public function isSatisfiedBy(ItemInterface $item): bool {
        if ($item->getPrice() >= $this->minPrice && $item->getPrice() <= $this->maxPrice) {
            return true;
        }

        return false;
    }
}
