<?php
    require __DIR__ . '/../vendor/autoload.php';

    use App\Payment\Exception\InvalidPaymentException;
    use App\Payment\Exception\InvalidPaymentMethodException;
    use App\Payment\Exception\InvalidPaymentOptionsException;
    use App\Payment\Exception\InvalidPaymentUserException;
    use App\Payment\Method\BankTransferPayment;
    use App\Payment\Method\BitcoinPayment;
    use App\Payment\Method\CreditCardPayment;
    use App\Payment\Method\PayPalPayment;
    use App\Payment\Options\BankTransfertOptions;
    use App\Payment\Options\BitcoinOptions;
    use App\Payment\Options\CreditCardOptions;
    use App\Payment\Options\PaypalOptions;
    use App\Payment\Payment;
    use App\Payment\PaymentMethodFactory;
    use App\Payment\UserPaymentOptions;
    use App\Payment\UserPaymentOptionsFactory;
    use App\Payment\User;



    $marc = new User(
        1,
        'Marc',
        'Galoyer',
        null,
        'admin',
        "0690684020",
        "mgaloyer@uneak.fr",
        "123456"
    );

    $marcPaymentOptions = new UserPaymentOptions($marc, [
        'credit_card' => new CreditCardOptions(
            '1234 5678 9012 3456',
            '12/25',
            '123'
        ),
        'paypal'      => new PaypalOptions(
            'drucila@email.com',
            'password'
        ),
    ]);


    $marcPaymentOptions->getPaymentOptions('credit_card');


    $pmf = new PaymentMethodFactory([
        "cb" => new CreditCardPayment(),
    ]);

    $method = $pmf->getPaymentMethod("cb");
    var_dump($method);



    function tryPay(Payment $payment, User $user, string $type, float $amount): void
    {
        try {
            $payment->pay($user, $type, $amount);
        } catch (InvalidPaymentMethodException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/><br/>";
        } catch (InvalidPaymentOptionsException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/><br/>";
        } catch (InvalidPaymentUserException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/><br/>";
        } catch (InvalidPaymentException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/><br/>";
        } catch (InvalidArgumentException $e) {
            echo "Erreur : " . $e->getMessage() . "<br/><br/>";
        } catch (Exception $e) {
            echo "Erreur inattendue : " . $e->getMessage() . "<br/><br/>";
        }
    }

    $marc = new User(
        1,
        'Marc',
        'Galoyer',
        null,
        'admin',
        "0690684020",
        "mgaloyer@uneak.fr",
        "123456"
    );

    $marcPaymentOptions = new UserPaymentOptions($marc);
    $marcPaymentOptions->addPaymentOptions('credit_card', new CreditCardOptions(
        '1234 5678 9012 3456',
        '12/25',
        '123'
    ));

    $marcPaymentOptions->addPaymentOptions('paypal', new PaypalOptions(
        'marc@example.com',
        'password'
    ));
    $marcPaymentOptions->addPaymentOptions('bank_transfer', new BankTransfertOptions(
        'FR7630004000031234567890143',
        'BNPAFRPPXXX'
    ));
    $marcPaymentOptions->addPaymentOptions('bitcoin', new BitcoinOptions(
        '1BoatSLRHtKNngkdXEeobR76b53LETtpyT'
    ));


    $drucila = new User(
        2,
        'Drucila',
        'Larochelle',
        null,
        'member',
        "0690684020",
        "drucila@email.com",
        "123456"
    );

    $drucilaPaymentOptions = new UserPaymentOptions(
        $drucila,
        [
            'credit_card' => new CreditCardOptions(
                '2745 1745 4027 2672',
                '10/26',
                '321'
            ),
            'paypal'      => new PaypalOptions(
                'drucila@email.com',
                'password'
            ),
        ]
    );

    $marieHelene = new User(
        3,
        'Marie-Hélène',
        'Larochelle',
        null,
        'member',
        "0690684020",
        "mh@email.com",
        "123456"
    );

    $userPaymentOptionsFactory = new UserPaymentOptionsFactory([$marcPaymentOptions, $drucilaPaymentOptions]);

    $paymentMethodFactory = new PaymentMethodFactory([
        'credit_card'   => new CreditCardPayment(),
        'paypal'        => new PayPalPayment(),
        'bank_transfer' => new BankTransferPayment(),
        'bitcoin'       => new BitcoinPayment(),
    ]);

    $payment = new Payment($paymentMethodFactory, $userPaymentOptionsFactory);


    tryPay($payment, $marc, 'credit_card', 100.00);
    tryPay($payment, $marc, 'paypal', 75.50);
    tryPay($payment, $marc, 'bank_transfer', 200.00);
    tryPay($payment, $marc, 'bitcoin', 150.00);

    tryPay($payment, $drucila, 'credit_card', 100.00);
    tryPay($payment, $drucila, 'bitcoin', 100.00);

    tryPay($payment, $marieHelene, 'bank_transfer', 100.00);

    tryPay($payment, $marc, 'cheque', 50.00);
