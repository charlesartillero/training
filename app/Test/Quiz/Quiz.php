<?php

namespace App\Test\Quiz;


class Quiz
{

    protected array $questions;
    protected $questionNumber;

    public function allQuestions(): array
    {
        return $this->questions;
    }

    public function addQuestion(Question $question) {
        $this->questions[] = $question;
    }

    public function questions() : array {
        return $this->questions;
    }

    public function firstQuestion() {
        return $this->questions[0];
    }

    public function nextQuestion() {

        $this->questionNumber++;

        return $this->questions[$this->questionNumber - 1] ?? false;

    }

    public function grade() {

        if (!$this->isComplete()) {
            throw new \Exception("All questions should be answer before grading");
        }


        return  $this->countTheCorrectAnswer() / count($this->questions) * 100;
    }

    protected function countTheCorrectAnswer() {
        return count(array_filter($this->questions, function($question) {
            return $question->correct();
        }));
    }

    public function isComplete() : bool{

        foreach ($this->questions as $question) {
            if (!$question->answered()) {
                return false;
            }
        }

        return true;
    }

}
