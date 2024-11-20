<?php

    require __DIR__ . '/../vendor/autoload.php';


    use App\Test\Montre;
    use App\Test\Truc;
    use App\Test\DeletableInterface;


    $montre = new Montre();
    $truc = new Truc(1,2,3,4,5);


    /**
     * @throws \Exception
     */
    function delete(DeletableInterface $deletable) {
        $deletable->delete();
        echo "l'objet a bien été effacé <br/>";
    }


    delete($montre);
    delete($truc);

    echo $montre->heure;
    echo "<br/>";
    echo $truc->premierChiffre;



//    echo "Instance of Montre ? :" . ($truc instanceof \App\Test\DeletableInterface ? "oui" : "non");

//    var_dump($truc);



