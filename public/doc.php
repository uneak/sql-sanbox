<?php

    require __DIR__ . '/../vendor/autoload.php';

    use App\Doc\Document;
    use App\Doc\Report;


    $doc = new Report();

    var_dump($doc->generate());

