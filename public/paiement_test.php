<?php


    require __DIR__ . '/../vendor/autoload.php';

    use App\paiements\Carteb;
    use App\paiements\Paypal;
    use App\paiements\Virement;
    use App\paiements\Central;


    $carte = new Carteb(22 - 01 - 17, 789456);
    $paypal = new Paypal('terry@gmail.com', 456123);
    $virement = new Virement("FR760005862324", 789456);


    var_dump($carte);
    echo "<br/>";
    echo "<br/>";

    $carte->payer(150);
    echo "<br/>";
    echo "<br/>";
    $paypal->payer(200);
    echo "<br/>";
    echo "<br/>";
    $virement->payer(850);
    echo "<br/>";
    echo "<br/>";

    $paiements = new Central([
        "Cb"       => new Carteb  (22 - 01 - 17, 789456),
        "Paypal"   => new Paypal  ('terry@gmail.com', 456123),
        "Virement" => new Virement ("FR760005862324", 789456)
    ]);


    $paiements->effectuerPaiement("Cb", 500);
    echo "<br/>";
    echo "<br/>";
    $paiements->effectuerPaiement("Paypal", 500);
    echo "<br/>";
    echo "<br/>";
    $paiements->effectuerPaiement("Virement", 500);


