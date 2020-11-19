<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 15:38
 * PHP version 7
 */

namespace App\Controller;

use App\Model\InquisitorManager;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{


    /**
     * @var Environment
     */
    protected Environment $twig;

    /**
     * @var array|null
     */
    private $inquisitor = null;

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => !APP_DEV, // @phpstan-ignore-line
                'debug' => APP_DEV,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
        $this->twig->addGlobal('post', $_POST);
        if (isset($_SESSION['inquisitor']['registrationNumber']) && !empty($_SESSION['inquisitor']['registrationNumber'])) {
            $inquisitorManager = new InquisitorManager();
            $inquisitor = $inquisitorManager->selectInquisitorByMatricul($_SESSION['inquisitor']['registrationNumber']);
            $this->inquisitor = $inquisitor;
        }

        $this->twig->addGlobal('app', [
            "session" => $_SESSION,
            "inquisitor" => $this->inquisitor,
        ]);
    }

    protected function getInquisitor(): array
    {
        return $this->inquisitor;
    }
}
