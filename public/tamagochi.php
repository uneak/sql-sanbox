<?php
    require __DIR__ . '/../vendor/autoload.php';

    use App\Tamagotchi\Action\BarkAction;
    use App\Tamagotchi\Action\EatAction;
    use App\Tamagotchi\Action\PlayAction;
    use App\Tamagotchi\Action\SwimAction;
    use App\Tamagotchi\CatTamagotchi;
    use App\Tamagotchi\DogTamagotchi;
    use App\Tamagotchi\FishTamagotchi;
    use App\Tamagotchi\TamagotchiGarden;


    echo BarkAction::class . "<pre>";

    $dog = new DogTamagotchi("Dog");
    $cat = new CatTamagotchi("Cat");
    $fish = new FishTamagotchi("Fish");

    $garden = new TamagotchiGarden([$dog, $cat, $fish]);

    $dog->performAction(new BarkAction());

    $garden->performActions([
        new BarkAction(),
        new BarkAction(),
        new SwimAction(),
        new EatAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
        new PlayAction(),
    ]);


    echo "<br/>Deuxieme vague d'actions <br/>";
    $garden->performActions([
        new SwimAction(20),
        new SwimAction(5),
        new SwimAction(),
    ]);

    echo "<br/>";

