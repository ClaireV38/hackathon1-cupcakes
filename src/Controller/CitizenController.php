<?php

namespace App\Controller;

use App\Model\WitchManager;

class CitizenController extends AbstractController
{

    private $witchManager;

    public function __construct()
    {
        parent:: __construct();
        $this->witchManager = new WitchManager();
    }

    public function index()
    {
        $questions = $this->witchManager->selectAll();
        return $this->twig->render('Citizen/denounce.html.twig', ['questions' => $questions]);
    }
}
