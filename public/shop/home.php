<?php
    require __DIR__ . '/../../vendor/autoload.php';

    use App\Reservation\RoomManager;
    use App\Reservation\UserManager;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    $userManager = new UserManager();
    $roomManager = new RoomManager();

    $loader = new FilesystemLoader(dirname(__DIR__, 2) . '/templates');
    $twig = new Environment($loader);


	if (!isset($_GET["user"])) {
        header("Location: index.php");
        exit;
	}

	$currentUser = $_GET["user"];
	$user = $userManager->findById($currentUser);


    echo $twig->render('home.html.twig' , [
        'user' => $user,
        'rooms' => $roomManager->findAll(),
        'roomManager' => $roomManager,
    ]);
?>
