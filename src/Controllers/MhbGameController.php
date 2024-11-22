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

        $user = $userManager->findById($_GET["user"]); // Recherche de l'utilisateur en base de données

        return $this->twig->render('mhbGame.html.twig', [
            'user' => $user,                   // L'utilisateur actuel
            
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