<?php

namespace App\Controller;

use App\Model\QuestionManager;
use App\Model\AnswerManager;

class CitizenController extends AbstractController
{

    public function __construct()
    {
        parent:: __construct();
    }

    public function denounce()
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST)) {
            $questionNumber = $_POST['question_id'] + 1;
            $questionManager = new QuestionManager();
            $questions = $questionManager->selectOneById($questionNumber);
            $answerManager = new AnswerManager();
            $answers = $answerManager->selectAnswersByQuestionId($questionNumber);
            return $this->twig->render('Citizen/denounce.html.twig', [
                'answers' => $answers,
                'questions' => $questions
            ]);
        } else {
            $questionNumber = 1;
            $questionManager = new QuestionManager();
            $questions = $questionManager->selectOneById($questionNumber);
            $answerManager = new AnswerManager();
            $answers = $answerManager->selectAnswersByQuestionId($questionNumber);
            return $this->twig->render('Citizen/denounce.html.twig', [
                'answers' => $answers,
                'questions' => $questions
            ]);
        }

    }
}
