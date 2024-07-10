<?php

namespace App\Test\Quiz;

class Question
{

    protected $body;
    protected $solution;
    protected $answer;

    function __construct($body, $solution)
    {
        $this->body = $body;
        $this->solution = $solution;
    }

    public function answer($answer): bool
    {
        $this->answer = $answer;

        return $this->correct();
    }

    public function correct(): bool
    {
        return $this->solution === $this->answer;
    }

    public function answered() : bool {
        return isset($this->answer);
    }


}
