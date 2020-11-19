<?php


namespace App\Controller;


use App\Model\UserManager;

class InquisitorController extends AbstractController
{

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
        if (isset($_SESSION['user']))
            header("Location: /");

        $matricul = $password = "";
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST))
        {
            $matricul = trim($_POST['matricul_number']);
            $password = trim($_POST['password']);
            if (empty($matricul))
                $errors['matricul'] = "Required";
            if (empty($password))
                $errors['password'] = "Required";
            if (empty($errors)) {
                // log user in DB
                $inquisitorManager = new InquisitorManager();
                $inquisitor = $InquisitorManager->selectInquisitorByMatricul($matricul);
                if (!$inquisitor)
                    $errors['matricul'] = "Inquisitor not found";
                else {
                    if (!password_verify($password, $inquisitor['password']))
                        $errors['password'] = "Bad credentials";
                    else {
                        $_SESSION['inquisitor'] = [
                            'matricul' => $inquisitor['matricul'],
                        ];
                        header("Location: /");
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
}