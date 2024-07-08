<?php

namespace App\DesignPatterns\SpecificationPattern;

use App\DesignPatterns\SpecificationPattern\Specifications\Specification;

class Item implements ItemInterface
{
    public function __construct(private readonly float $price, private readonly string $category) {}

    public function getPrice(): float {
        return $this->price;
    }

    public function getCategory(): string {
        return $this->category;
    }
}
