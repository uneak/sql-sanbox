<?php

    $array = ["default"];


    function editArray(array &$arrayAModifier): void {
        $arrayAModifier[] = 'test';
    }


    editArray($array);

    var_dump($array);