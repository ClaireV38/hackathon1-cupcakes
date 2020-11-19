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
    public function signIn()
    {
        if (isset($_SESSION['user']))
            header("Location: /");

        $email = $password = "";
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST))
        {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            if (empty($email))
                $errors['email'] = "Required";
            if (empty($password))
                $errors['password'] = "Required";
            if (empty($errors)) {
                // log user in DB
                $userManager = new UserManager();
                $user = $userManager->selectUserByEmail($email);
                if (!$user)
                    $errors['email'] = "User not found";
                else {
                    if (!password_verify($password, $user['password']))
                        $errors['password'] = "Bad credentials";
                    else {
                        $_SESSION['user'] = [
                            'email' => $user['email'],
                        ];
                        header("Location: /");
                    }
                }
            }
        }

        return $this->twig->render("Inquisitor/signIn.html.twig", [
            'errors' => $errors,
            'data' => [
                'email' => $email,
            ]
        ]);
    }
}