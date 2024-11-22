<?php

    namespace App\Controllers;

    use App\Models\RoomManager;
    use App\Models\UserManager;
    use Symfony\Component\HttpFoundation\Request;

    class HomeController
    {
        private $twig;

        public function __construct($twig)
        {
            $this->twig = $twig;
        }

        public function index() : string
        {

            $request = Request::createFromGlobals();
            $userID = $request->query->get('user', null);

            if ($userID === null) {
                header("Location: /login");
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