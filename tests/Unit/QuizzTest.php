<?php

use App\Test\Quiz\Question;
use App\Test\Quiz\Quiz;


test('it consists of questions', function (){

    // Add new question
    $this->quiz->addQuestion(new Question('What is 2 + 2 ?', 4));

    // Assert the quiz has one question
    $this->assertCount(1, $this->quiz->questions());

});

test('it correctly tracks the number of total questions', function() {


    // Add 2 questions
    $this->quiz->addQuestion(new Question('What is 2 + 2 ?', 4));
    $this->quiz->addQuestion(new Question('What is 1 + 1 ?', 4));

    // Assert asd has 2 questions
    $this->assertCount(2, $this->quiz->questions());

    // Add one more question
    $this->quiz->addQuestion(new Question('What is 3 + 3 ?', 6));

    // Assert asd has total of 3 question
    $this->assertCount(3, $this->quiz->questions());

});


test('it correctly grades a perfect quiz', function (){




    // Add 2 questions
    $this->quiz
        ->addQuestion($question1 = new Question('What is 2 + 2', 4));
    $this->quiz
        ->addQuestion($question2 = new Question('What is 3 + 3', 6));

    // Answers one question right and other's wrong
    $question1->answer(4); // Right
    $question2->answer(1); // Wrong

    // Assert the grade is not 100
    $this->assertNotEquals(100, $this->quiz
        ->grade());

    // Answers all question right
    $question1->answer(4); // Right
    $question2->answer(6); // Right

    // Assert the grade is 100
    $this->assertEquals(100, $this->quiz
        ->grade());
});

test('it correctly grades a failed quiz', function (){

    // Add 2 questions
    $this->quiz->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
    $this->quiz->addQuestion($question2 = new Question('What is 1 + 1 ?', 2));

    // Answers one question right and other's wrong
    $question1->answer(4); // Right
    $question2->answer(0); // Wrong

    // Assert the grade is not 0
    $this->assertNotEquals(0, $this->quiz->grade());

    // Answer's all questions wrong
    $question1->answer(0); // Wrong
    $question2->answer(0); // Wrong

    // Assert the grade is equal 0
    $this->assertEquals(0, $this->quiz->grade());
});

test('it cannot be graded until all questions have been answered', function (){

    // Add 2 questions
    $this->quiz
        ->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
    $this->quiz
        ->addQuestion($question2 = new Question('What is 1 + 1 ?', 2));

    // Answered the question 1 only
    $question1->answer(4);
    $this->quiz
        ->nextQuestion();

    // Expect an exception for asking a grade without finishing the quiz
    $this->expectException(\Exception::class);
    $this->quiz
        ->grade();

    // Answer the question 2 and then expect a grade
    $question1->answer(2);
    $this->assertNotEquals(100, $this->quiz
        ->grade());

});

test('it correctly tracks the next question in the queue', function (){

   
    // Add 3 questions
    $this->quiz
        ->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
    $this->quiz
        ->addQuestion($question2 = new Question('What is 1 + 1 ?', 2));
    $this->quiz
        ->addQuestion($question3 = new Question('What is 3 + 3 ?', 2));

    // Expect the questions number match with the no. of times calling the nextQuestion() method
    $this->assertEquals($question1, $this->quiz
        ->nextQuestion());
    $this->assertEquals($question2, $this->quiz
        ->nextQuestion());
    $this->assertEquals($question3, $this->quiz
        ->nextQuestion());

});

test('it return false if there are no remaining next question', function (){

    // Start the quiz


    // Add 2 questions
    $this->quiz
        ->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
    $this->quiz
        ->addQuestion($question2 = new Question('What is 1 + 1 ?', 2));

    // Assert false for calling 3rd time the nextQuestion() method
    $this->assertEquals($question1, $this->quiz
        ->nextQuestion());
    $this->assertEquals($question2, $this->quiz
        ->nextQuestion());
    $this->assertFalse($this->quiz
        ->nextQuestion());

});

test('it knows if the all questions has been answered', function (){

    // Start the quiz


    // Add 2 questions
    $this->quiz
        ->addQuestion($question1 = new Question('What is 2 + 2 ?', 4));
    $this->quiz
        ->addQuestion($question2 = new Question('What is 1 + 1 ?', 2));

    // Answer the question 1 only
    $question1->answer(4);

    // Assert false for quiz is complete
    $this->assertFalse($this->quiz
        ->complete());

    // Answer one more question
    $question2->answer(2);

    // Assert true for completing the quiz
    $this->assertTrue($this->quiz
        ->complete());

});

