<?php

    use App\Error\Exception\StringParameterException;

    require __DIR__ . '/../vendor/autoload.php';

    /**
     * @throws \Exception
     */
    function diviser($a, $b): float
    {
        if ($b === 0) {
            throw new \Exception("Division par zéro impossible");
        }

        if (is_string($a) || is_string($b)) {
            throw new StringParameterException("Les paramètres doivent être des entiers", $a . " / " . $b);
        }

        return $a / $b;
    }


    try {

        echo diviser("gary", "drucila") . '<br>';

    } catch (StringParameterException $error) {

        echo "vous avez mis un string" . $error->getMessage() . '<br>';

    } catch (\Exception $error) {

        echo $error->getCode() . ":" . $error->getMessage() . '<br>';

    }