<?php
    require __DIR__ . '/../vendor/autoload.php';

    use App\Todolist\Liste;

    function showList(Liste $liste): void {
        echo "#### Liste de tâches ####<br/>";
        foreach ($liste->getTaches() as $tache) {
            echo $tache->getTitre() . " - " . ($tache->estCompletee() ? "complétée" : "non complétée") . "<br/>";
        }
        echo "#########################<br/>";
    }

    $liste = new Liste([
        "1" => "Faire le ménage",
        "2" => "Faire la vaiselle",
        "3" => "Sortir la poubelle",
    ]);

    $liste->addTache("4", "Faire les courses");

    $liste->completerTache("2");
    $liste->completerTache("1");
    $liste->decompleterTache("1");

    $liste->toggleTache("3");


    showList($liste);


