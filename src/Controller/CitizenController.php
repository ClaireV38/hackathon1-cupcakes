<?php

namespace App\Controller;

use App\Model\WitchManager;

class CitizenController extends AbstractController
{

    public function __construct()
    {
        parent:: __construct();
    }

    public function index()
    {
        $witchManager = new WitchManager();
        $questions = $witchManager->selectQuestions();
        $answers = $witchManager->selectAnswers();
        return $this->twig->render('Citizen/denounce.html.twig', [
            'answers' => $answers,
            'questions' => $questions
        ]);
    }
}
