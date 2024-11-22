<?php

    namespace App\Controllers;

    use App\Models\RoomManager;
    use App\Models\UserManager;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    class HomeController
    {
        private Environment $twig;

        public function __construct(Environment $twig) {
            $this->twig = $twig;
        }


        public function index() : string
        {
            $userManager = new UserManager();
            $roomManager = new RoomManager();

            if (!isset($_GET["user"])) {
                header("Location: /login");
                exit;
            }

            $user = $userManager->findById($_GET["user"]); // Recherche de l'utilisateur en base de données

            dump($user);

            return $this->twig->render('home.html.twig', [
                'user' => $user,                   // L'utilisateur actuel
                'rooms' => $roomManager->findAll(), // Liste de toutes les salles/chambres
                'roomManager' => $roomManager,     // Instance du gestionnaire de salles pour usage dans Twig
            ]);
        }
    }