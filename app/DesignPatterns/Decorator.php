<?php

interface CarService {
    public function getCost();
}

class TireRepairService implements CarService {

    protected $cost = 100;

    function __construct(CarService $service)
    {
        $this->cost += $service->getCost();
    }

    public function getCost() {
        return $this->cost;
    }
}

class ChangeOil implements CarService {
    protected $cost = 50;

    function __construct(CarService $service)
    {
        $this->cost += $service->getCost();
    }

    public function getCost()
    {
        return $this->cost;
    }
}


class BasicInspection  implements CarService {

    protected $cost = 30;

    public function getCost()
    {
        return $this->cost;
    }
}

$carService = new TireRepairService(new ChangeOil(new BasicInspection()));

echo $carService->getCost();
