<?php

    require __DIR__ . '/../vendor/autoload.php';

    use App\Pokemon\Exception\InvalidAttackException;
    use App\Pokemon\Pokemon\EauPokemon;
    use App\Pokemon\Pokemon\FeuPokemon;
    use App\Pokemon\Pokemon\PlantePokemon;


    function attaquer($attaquant, $victime, $nomAttaque) {
        try {
            $attaquant->attaquer($victime, $nomAttaque);

        } catch (InvalidAttackException $e) {

            $attaquant = $e->attaquant;
            $victime = $e->victime;

            $attaques = $attaquant->getAttaques();
            $defaultAttaque = $attaques[0];

            $attaquant->attaquer($victime, $defaultAttaque->getNom());
        }
    }


    $salameche = new FeuPokemon('Salameche');
    $carapuce = new EauPokemon('Carapuce', 3);
    $bulbizarre = new PlantePokemon('BulBizarre', 1);

    echo $salameche->showInfos();
    echo $carapuce->showInfos();
    echo $bulbizarre->showInfos();


    attaquer($salameche, $carapuce, 'Lance-flamme');
    attaquer($bulbizarre, $carapuce, 'Tranch herbe');
    attaquer($salameche, $carapuce, 'Lance-flamme');
    attaquer($carapuce, $salameche, 'Pistolet à eau');
    attaquer($salameche, $carapuce, 'Lance-flamme');
    attaquer($salameche, $carapuce, 'Lance-flamme');


    echo $salameche->showInfos();
    echo $carapuce->showInfos();
    echo $bulbizarre->showInfos();
