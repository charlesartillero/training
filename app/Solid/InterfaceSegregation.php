<?php

interface Worker {
    public function manage();

}

interface Workable
{
    public function work();
}

interface Sleepable
{
    public function sleep();
}

class AndroidWorker implements Workable, Worker{
    public function work() {
        echo 'Android is working';
    }

    public function manage()
    {
        $this->work();
    }

}

class HumanWorker implements Worker, Workable, Sleepable {
    public function work() {
        echo 'Human is working';
    }
    public function sleep()
    {
        echo 'Human is sleeping';
    }

    public function manage()
    {
        $this->work();
        $this->sleep();
    }
}




class Captain {

    public function manage(Worker $worker)
    {
        $worker->manage();
    }

}

$captain = new Captain();
$androidWorker = new AndroidWorker();
$humanWorker = new HumanWorker();



$captain->manage($androidWorker);

