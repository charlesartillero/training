<?php

namespace App\Test\Quiz;


use Exception;

class Quiz
{

    protected QuestionCollections $questions;


    function __construct()
    {
        $this->questions = new QuestionCollections();
    }

    public function addQuestion(Question $question): void
    {
        $this->questions->add($question);
    }

    public function questions(): QuestionCollections
    {
        return $this->questions;
    }

    public function nextQuestion(): Question|bool
    {
        return $this->questions->next();
    }

    /**
     * @throws Exception
     */
    public function grade(): float|int
    {

        if (!$this->complete()) {
            throw new Exception("All questions should be answer before grading");
        }

        return  $this->countTheCorrectAnswer() / count($this->questions) * 100;
    }

    public function countTheCorrectAnswer() : int {
        return count($this->questions->correctAnswer());
    }

    public function complete() : bool{

        return $this->questions->count() === count($this->questions->answered());

    }

}
