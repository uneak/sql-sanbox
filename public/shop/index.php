<?php
    require __DIR__ . '/../../vendor/autoload.php';

    use App\Reservation\UserManager;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    $loader = new FilesystemLoader(dirname(__DIR__, 2) . '/templates');
    $twig = new Environment($loader);

    $users = (new UserManager())->findAll();

    if (isset($_POST["user"])) {
        header("Location: home.php?user={$_POST["user"]}");
        exit;
    }

    echo $twig->render('index.html.twig', ['users' => $users]);
?>