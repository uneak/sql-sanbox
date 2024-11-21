<?php

    namespace App\Controllers;

    use App\Models\UserManager;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    class LoginController
    {
        public function index() : string
        {
            $loader = new FilesystemLoader(dirname(__DIR__, 2) . '/src/Views');
            $twig = new Environment($loader);


            if (isset($_POST["user"])) {
                header("Location: /?user={$_POST["user"]}");
                exit;
            }

            $userManager = new UserManager();
            return $twig->render('login.html.twig', ['users' => $userManager->findAll()]);
        }
    }