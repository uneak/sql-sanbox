<?php

    namespace App\Controllers;

    use App\Models\UserManager;

    class LoginController
    {
        private $twig;

        public function __construct($twig)
        {
            $this->twig = $twig;
        }

        public function index() : string
        {
            $users = (new UserManager())->findAll();

            if (isset($_POST["user"])) {
                header("Location: /?user={$_POST["user"]}");
                exit;
            }

            return $this->twig->render('login.html.twig', ['users' => $users]);
        }

    }