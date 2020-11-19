<?php

namespace App\Controller;

use App\Model\WitchManager;

class InquisitorController extends AbstractController
{
    public function bounty()
    {
        $witchIdentified = new WitchManager();
        $witches = $witchIdentified->selectAll();
        return $this->twig->render('Inquisitor/bounty.html.twig', ['witches' => $witches]);
    }
}
