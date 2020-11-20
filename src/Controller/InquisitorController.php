<?php

namespace App\Controller;

use App\Model\BountyManager;
use App\Model\InquisitorManager;
use App\Model\WitchManager;

class InquisitorController extends AbstractController
{
    /**
     * Display all witches
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function bounty(): string
    {
        $matricul = intval($_SESSION['inquisitor']['registrationNumber']);

        $witchManager = new WitchManager();

        $id = $votes = $flameCount = "";
        if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['btn-burnMe'])) {
            $id = intval($_POST['witchId']);

            $voteManager = new BountyManager();
            $votes = $voteManager->hasVoted($matricul, $id);

            $flameCounts = $witchManager->selectFlameCount($id);
            $flameCount = intval($flameCounts['flame_count']);

            $witchManager->updateCredibilityWhenFlamecountIsFull();

            $witches['id']['flame_count'] = $flameCount;

            header("Location: /Inquisitor/bounty/");
        }

        $witches = $witchManager->selectAllByLastUpdated();

        return $this->twig->render('Inquisitor/bounty.html.twig', ['witches' => $witches, "votes" => $votes, 'flameCount' => $flameCount]);
    }

    /**
     * Display signInform
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function signIn(): string
    {
        if (isset($_SESSION['inquisitor'])) {
            header("Location: /");
        }

        $matricul = $password = "";
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST)) {
            $matricul = intval(trim($_POST['matricul_number']));
            $password = trim($_POST['password']);
            if (empty($matricul)) {
                $errors['matricul'] = "Required";
            }
            if (empty($password)) {
                $errors['password'] = "Required";
            }
            if (empty($errors)) {
                // log user in DB
                $inquisitorManager = new InquisitorManager();
                $inquisitor = $inquisitorManager->selectInquisitorByMatricul($matricul);
                if (!$inquisitor) {
                    $errors['matricul'] = "Inquisitor not found";
                } else {
                    if (!password_verify($password, $inquisitor['password'])) {
                        $errors['password'] = "Bad credentials";
                    } else {
                        $_SESSION['inquisitor'] = [
                            'registrationNumber' => $inquisitor['registrationNumber'],
                        ];
                        header("Location:/inquisitor/bounty");
                    }
                }
            }
        }
        return $this->twig->render("Inquisitor/signIn.html.twig", [
            'errors' => $errors,
            'data' => [
                'matricul' => $matricul,
                'password' => $password
                ]
        ]);
    }


    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function signUp(): string
    {
        if (!empty($_SESSION)) {
            header('Location: /');
        }

        $inquisitor = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST)) {
            $inquisitor['name'] = trim($_POST['name']);
            $inquisitor['registrationNumber'] = intval(trim($_POST['registrationNumber']));
            $inquisitor['password'] = trim($_POST['password']);
            $inquisitor['passwordRepeat'] = trim($_POST['passwordRepeat']);

            if (empty($inquisitor['name'])) {
                $errors['name'] = 'Required';
            }
            if (empty($inquisitor['registrationNumber'])) {
                $errors['registrationNumber'] = 'Required';
            } elseif (strlen(strval($inquisitor['registrationNumber'])) !== 8) {
                $errors['registrationNumber'] = 'Registration number must contains 8 figures';
            }
            if (empty($inquisitor['password'])) {
                $errors['password'] = 'Required';
            }
            if (empty($inquisitor['passwordRepeat'])) {
                $errors['passwordRepeat'] = 'Required';
            } elseif ($inquisitor['passwordRepeat'] !== $inquisitor['password']) {
                $errors['passwordRepeat'] = 'Passwords must match';
            }

            if (empty($errors)) {
                $inquisitorManager = new InquisitorManager();
                try {
                    $inquisitorManager->addInquisitor($inquisitor);
                    $inquisitorManager->selectInquisitorByMatricul($inquisitor['registrationNumber']);
                    $_SESSION['inquisitor'] = [
                        'registrationNumber' => $inquisitor['registrationNumber'],
                    ];
                    header('Location:/inquisitor/bounty');
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

    public function logout()
    {
        session_destroy();
        header("Location: /");
    }
}
