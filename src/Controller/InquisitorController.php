<?php

namespace App\Controller;

use App\Model\InquisitorManager;

class InquisitorController extends AbstractController
{
    public function signUp()
    {
        if (!empty($_SESSION)) {
            header('Location: /');
        }

        $inquisitor = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST)) {
            $inquisitor['name'] = trim($_POST['name']);
            $inquisitor['registrationNumber'] = trim($_POST['registrationNumber']);
            $inquisitor['password'] = trim($_POST['password']);

            if (empty($inquisitor['name'])) {
                $errors['name'] = 'Required';
            }
            if (empty($inquisitor['registrationNumber'])) {
                $errors['registrationNumber'] = 'Required';
            } elseif (strlen($inquisitor['registrationNumber']) !== 8) {
                $errors['registrationNumber'] = 'Registration number must contains 8 figures';
            }
            if (empty($inquisitor['password'])) {
                $errors['password'] = 'Required';
            }

            if (empty($errors)) {
                $inquisitorManager = new InquisitorManager();
                try {
                    $inquisitorManager->addInquisitor($inquisitor);
                    header('Location:/inquisitor/signin');
                } catch (\PDOException $e) {
                    $errors['form'] = 'Registration number already used by an inquisitor, please contact the Kingdom';
                }
            }
        }

        return $this->twig->render('Inquisitor/signUp.html.twig', [
            'errors' => $errors,
            'inquisitor' => $inquisitor
        ]);
    }
}
