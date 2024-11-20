
<?php

require __DIR__ . '/../../vendor/autoload.php';
use App\design_pattern_paiement_bank\PaymentManager;
use App\design_pattern_paiement_bank\PaymentSystem\ENUM\ModePayment;
use App\design_pattern_paiement_bank\PaymentSystem\Transaction\TransactionInterface;
use App\design_pattern_paiement_bank\PaymentSystem\Type\CarteBancaireType;
use App\design_pattern_paiement_bank\PaymentSystem\Type\PaypalType;
use App\design_pattern_paiement_bank\PaymentSystem\Type\VirementBancaireType;


error_log("TEST DE MESSAGE LOG", 0);
$paymentManager = PaymentManager::getInstance(100);

echo <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel='stylesheet' type='text/css' media='screen' href='./css/main.css'>
    
</head>
<body>
    <div id="main">
        <h1 style="text-align:center;">Système de Paiement Bancaire <strong>SPB Canaries test</strong></h1>
        <h3>Je suis {$paymentManager->nom}</h3>
        <h2>Montant du panier : {$paymentManager->getAmountToPayment()}€</h2>
HTML;
// echo'<h1 style="text-align:center;">Système de Paiement Bancaire <strong>SPB Canaries</strong></h1>';


echo <<<HTML
    <form id="form_choice_payment" action="" method="post">

    <label>Mode de paiement :</label>
    <select id="payment_mode" name="modePayment">
        <option value=""> </option>
        <option value='CB'>Carte Bancaire</option>
        <option value='PAYPAL'>Paypal</option>
        <option value='VIREMENT'>Virement Bancaire</option>
    </select>
    <button type="submit">Valider</button>       
</form>
<div id="output"></div>
HTML;

// $fabric;
//* Zone d'affichage des différents mode de paiement
// $transaction; 

if (htmlspecialchars($_POST['modePayment']??'') and !empty($_POST['modePayment'])) {
    // global $fabric;
    // global $transaction;
    // $fabricVar = null;
    // $transactionVar = null;
    error_log("J'ai bien reçue le formulaire", 0);
    switch ($_POST['modePayment']) {
        case ModePayment::CB->value:
            error_log("J'ai bien reçue le formulaire choix : ".$_POST['modePayment'], 0);
            echo "<h3>Paiement par Carte Banquaire</3>";
            $paymentManager->setFabric(new CarteBancaireType($paymentManager->getAmountToPayment()));

            // $fabric = new CarteBancaireType($paymentManager->getAmountToPayment());
            // $transaction = $fabric->paymentMethod();
            // $paymentManager->setFabric($fabric);
            // $paymentManager->setTransaction($transaction);
            // echo "<pre>";
            // var_dump($transaction);
            // echo "<pre>";
            include"./html/formulaire_cb.html";
            
            break;
        case ModePayment::PAYPAL->value:
            echo "<h3>Paiement par PayPal</3>";
            $fabric = new PaypalType($paymentManager->getAmountToPayment());
            $transaction = $fabric->paymentMethod();
            $paymentManager->setFabric($fabric);
            $paymentManager->setTransaction($transaction);
            // echo "<pre>";
            // var_dump($transaction);
            // echo "<pre>";
            include"./html/formulaire_paypal.html";
            break;   
        case ModePayment::VIREMENT->value:
            echo "<h3>Paiement par Virement Banquaire</3>";
            $fabric = new VirementBancaireType($paymentManager->getAmountToPayment());
            $transaction = $fabric->paymentMethod();
            $paymentManager->setFabric($fabric);
            $paymentManager->setTransaction($transaction);
            // echo "<pre>";
            // var_dump($transaction);
            // echo "<pre>";
            include"./html/formulaire_virement.html";
            break;            
        default:
            # code...
            break;
    }
   
}

echo <<<HTML
</div>
<script src="./js/app.js"></script>
</body>
</html>

HTML;

