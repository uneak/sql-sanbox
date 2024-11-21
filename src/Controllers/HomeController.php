<?php

    namespace App\Controllers;

    use App\Models\RoomManager;
    use App\Models\UserManager;

    class HomeController
    {
        private $twig;

        public function __construct($twig)
        {
            $this->twig = $twig;
        }

        public function index() : string
        {

            if (!isset($_GET["user"])) {
                header("Location: ?url=login");
                exit;
            }

            $userManager = new UserManager();
            $user = $userManager->findById($_GET["user"]);

            $roomManager = new RoomManager();
            $rooms = $roomManager->findAll();

            return $this->twig->render('home.html.twig', [
                'user' => $user,
                'rooms' => $rooms,
                'roomManager' => $roomManager,
            ]);
        }

    }