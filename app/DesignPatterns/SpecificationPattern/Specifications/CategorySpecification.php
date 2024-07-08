<?php

namespace App\DesignPatterns\SpecificationPattern\Specifications;

use App\DesignPatterns\SpecificationPattern\ItemInterface;

class CategorySpecification implements Specification
{
    function __construct(private string $category)
    {

    }

    public function isSatisfiedBy(ItemInterface $item): bool
    {
        if ($this->category === $item->getCategory()) {
            return true;
        }

        return  false;
    }
}
