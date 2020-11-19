<?php

namespace App\Controller;

class CitizenController extends AbstractController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $img = $_POST['photo'] ?? "";
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $fileName = md5(uniqid("" . rand() . time(), true)) . '.png';
            $file = ROOTPATH . '/public/upload/' . $fileName;
            $success = file_put_contents($file, $data);
            var_dump($success);
        }
        return $this->twig->render('Citizen/index.html.twig');
    }
}
