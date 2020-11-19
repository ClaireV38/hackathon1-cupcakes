<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
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
        return $this->twig->render('Home/index.html.twig');
    }
}
