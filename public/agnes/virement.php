<?php

require __DIR__ . '/../../vendor/autoload.php';

use App\design_pattern_paiement_bank\PaymentSystem\Bank;
use App\design_pattern_paiement_bank\PaymentManager;
use App\design_pattern_paiement_bank\PaymentSystem\Type\VirementBancaireType;

$paymentManager = PaymentManager::getInstance(100);
$fabric = new VirementBancaireType($paymentManager->getAmountToPayment());
$paymentManager ->setFabric($fabric);
$transaction = $fabric->paymentMethod();
$transaction->setAmount($paymentManager->getAmountToPayment());
$paymentManager->setTransaction($transaction);
$bank = new Bank(200);
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
        <form id="form_choice_payment" action="" method="post">
            <label>Mode de paiement :</label>
            <select id="payment_mode" name="modePayment">
                <option value=""> </option>
                <option value='CB'>Carte Bancaire</option>
                <option value='PAYPAL'>Paypal</option>
                <option value='VIREMENT' selected="selected">Virement Bancaire</option>
            </select>
            <button type="submit">Valider</button>       
        </form>
        <div id="output"></div>

HTML;

include"./html/formulaire_virement.html";

echo <<<HTML
</div>
<script src="./js/app.js"></script>
</body>
</html>

HTML;

//*Récupère le formulaire pour le virement
// if ($paymentManager->getTransaction() !=null) {
        if (htmlspecialchars($_POST['iban']??'') and !empty($_POST['iban'])) {
            
            $paymentManager->getTransaction()->setIBAN(htmlspecialchars($_POST['iban']));
            

            // echo '<pre>';
            // var_dump($paymentManager);
            // echo '</pre>';

            //*On procède au paiement
            if ($transaction->processPaiement($bank)) {
                echo ' <span style="color:green;">Le paiement a été accepté</span>';
                // header('location:paiement_pattern_exo2.php'); 
            }else {
                echo ' <span style="color:red;">Le paiement a été refusé</span>';
            }
            
        }
    // }