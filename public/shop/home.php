<?php
    require __DIR__ . '/../../vendor/autoload.php';

    use App\Models\RoomManager;
    use App\Models\UserManager;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;


    // Initialisation des gestionnaires pour les utilisateurs et les chambres
    $userManager = new UserManager(); // Classe pour gérer les utilisateurs
    $roomManager = new RoomManager(); // Classe pour gérer les salles/chambres

    // Initialisation de Twig (le moteur de templates)
    // Définition du répertoire où se trouvent les templates Twig
    $loader = new FilesystemLoader(dirname(__DIR__, 2) . '/templates');
    $twig = new Environment($loader); // Création de l'instance de Twig

    // Vérification que le paramètre 'user' est bien défini dans l'URL
	if (!isset($_GET["user"])) {
        // Redirection vers la page d'accueil si l'utilisateur n'est pas défini
        header("Location: /login");
        exit;
	}

    // Récupération de l'utilisateur courant à partir de l'ID passé dans l'URL
	$currentUser = $_GET["user"];
	$user = $userManager->findById($currentUser); // Recherche de l'utilisateur en base de données

    // Utilisation de Twig pour rendre le template 'home.html.twig'
    // Envoi de données au template : l'utilisateur, les chambres et le RoomManager
    echo $twig->render('home.html.twig', [
        'user' => $user,                   // L'utilisateur actuel
        'rooms' => $roomManager->findAll(), // Liste de toutes les salles/chambres
        'roomManager' => $roomManager,     // Instance du gestionnaire de salles pour usage dans Twig
    ]);
?>
