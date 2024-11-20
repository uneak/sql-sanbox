<?php


namespace App\paiements;

interface ModePaiement {
    public function payer($montant);
}