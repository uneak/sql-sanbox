<?php

    namespace App\Controllers;

    use App\Models\UserManager;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    class LoginController
    {

        private Environment $twig;

        public function __construct(Environment $twig) {
            $this->twig = $twig;
        }

        public function index() : string
        {
            if (isset($_POST["user"])) {
                header("Location: /?user={$_POST["user"]}");
                exit;
            }

            $userManager = new UserManager();
            return $this->twig->render('login.html.twig', ['users' => $userManager->findAll()]);
        }
    }