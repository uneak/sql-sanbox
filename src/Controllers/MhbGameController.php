<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Models\UserManager;




class MhbGameController{
    
    private Environment $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }


    public function index() : string
    {
        $userManager = new UserManager();
    
        if (!isset($_GET["user"])) {
            header("Location: /login");
            exit;
        }

        $try = 5;
        $winValue = random_int(1,100);

        $message = "";

        if (isset($_POST["value"]) && isset($_POST["winValue"]) && isset($_POST["try"])) {
            $winValue = $_POST["winValue"];

            if ($_POST["value"] == $winValue) {
                $message = "Vous avez trouvé le nombre mystère !, c'était bien $winValue";
            } elseif ($_POST["value"] < $winValue) {
                $message = "Le nombre mystère est plus grand";
            } else {
                $message = "Le nombre mystère est plus petit";
            }

            if ($_POST["value"] !== $winValue) {
                $try = $_POST["try"] - 1;
                $message .= " - Il vous reste $try essais";
            }
        }

        $user = $userManager->findById($_GET["user"]); // Recherche de l'utilisateur en base de données

        return $this->twig->render('mhbGame.html.twig', [
            'user' => $user,                   // L'utilisateur actuel
            'message' => $message,
            'winValue' => $winValue,
            'try' => $try
        ]);
    }

    public function guessNumber() : string
    {
        $number = random_int(1,100);
        $result ="";

        if (isset($_POST["number"])) {
            if ($_POST["number"] == $number) {
                $result = "Vous avez trouvé !";
            } elseif ($_POST["number"] < $number){
                $result = "le nombre choisi est trop petit :-( ";
            } else {
                $result = "le nombre choisi est trop grand :-( ";
            }
             
           

        return $this->twig->render('mhbGame.html.twig', [
            'result' => $result,
        ]);                 
    }
    }
    


// <input  type="hidden" value="<?php echo $nombre; 
// $number = random_int(0,100);



}