<?php
    require __DIR__ . '/../vendor/autoload.php';

    use App\ECommerce\Exception\InvalidProductException;
    use App\ECommerce\Exception\OutOfStockException;
    use App\ECommerce\Exception\PaymentDeclinedException;
    use App\ECommerce\Exception\PurchaseException;
    use App\ECommerce\PaymentSystem;
    use App\ECommerce\Product;

    /**
     * @throws \App\ECommerce\Exception\InvalidProductException
     * @throws \App\ECommerce\Exception\OutOfStockException
     * @throws \App\ECommerce\Exception\PaymentDeclinedException
     */
    function processPurchase(PaymentSystem $paymentSystem, ?Product $product = null): void
    {
        if ($product === null) {
            throw new InvalidProductException('Product is invalid');
        }

        if (!$product->isAvailable()) {
            throw new OutOfStockException(
                sprintf('Product %s is not available', $product->getName()),
            );
        }

        $product->purchase();

        $paymentSystem->processPayment($product);
    }

    function catchPurchase(PaymentSystem $paymentSystem, ?Product $product = null): void
    {
        try {
            processPurchase($paymentSystem, $product);
            echo "Achat effectué avec succès<br>";

        } catch (OutOfStockException $e) {
            echo "Erreur de stock : " . $e->getMessage() . '<br>';

        } catch (PaymentDeclinedException $e) {
            echo "Erreur de paiement : " . $e->getMessage() . '<br>';

        } catch (InvalidProductException $e) {
            echo "Produit invalide : " . $e->getMessage() . '<br>';

        } catch (PurchaseException $e) {
            echo "Erreur d'achat : " . $e->getMessage() . '<br>';
        }
    }




    $payementSystem = new PaymentSystem(1000);

    $product = new Product('iPhone', 1, 800);
    $productExpensive = new Product('Laptop', 5, 1500);

    catchPurchase($payementSystem, $product);
    catchPurchase($payementSystem, $product);
    catchPurchase($payementSystem, null);
    catchPurchase($payementSystem, $productExpensive);
