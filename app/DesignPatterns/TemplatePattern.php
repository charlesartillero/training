<?php

abstract class Adobo {

    public function make()
    {
        $this
            ->addSoySauce()
            ->addVinegar()
            ->addWater()
            ->addMainIngredient();
    }

    abstract protected function addMainIngredient();

    protected function addSoySauce(){
        echo "Add Soy Sauce\n";
        return $this;
    }

    protected function addVinegar() {
        echo "Add Vinegar\n";
        return $this;
    }

    protected function addWater() {
        echo "Add Water\n";
        return $this;
    }

}

class AdobongManok extends Adobo {
    public function addMainIngredient(){
        echo "Add Manoc\n";
    }
}

class AdobongPusit extends Adobo {
    public function addMainIngredient(){
        echo "Add Pusit\n";
    }
}

(new AdobongManok())->make();

(new AdobongPusit())->make();

