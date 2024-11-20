<?php
    require __DIR__ . '/../../vendor/autoload.php';

    use App\Payment\Payment;
    use App\Payment\PaymentMethodFactory;
    use App\Payment\PaymentMethodManager;
    use App\Reservation\RoomManager;
    use App\Reservation\UserManager;

    $userManager = new UserManager();
    $roomManager = new RoomManager();
    $paymentMethodManager = new PaymentMethodManager();


    if (!isset($_GET["user"])) {
        header("Location: index.php");
        exit;
    }

    if (!isset($_GET["product"])) {
        header("Location: home.php?user={$_GET["user"]}");
        exit;
    }

    $user = $userManager->findById($_GET["user"]);
    $room = $roomManager->findById($_GET["product"]);

	$productPrice = $roomManager->getPriceByRole($room->getId(), $user->getUserRole());

    $userMethodList = $paymentMethodManager->findAll(10, 0, ['user' => $user->getId()]);

    $paymentMethodFactory = new PaymentMethodFactory();


    if (isset($_POST["user"]) && isset($_POST["product"]) && isset($_POST["method"])) {

        $paymentMethod = $paymentMethodManager->findById($_POST["method"]);
        $payment = $paymentMethodFactory->getPaymentMethod($paymentMethod->getType());

		$postUser = $userManager->findById($_POST["user"]);;
		$price = $roomManager->getPriceByRole($_POST["product"], $postUser->getUserRole());

        $payment->pay($price, $paymentMethod->getData());
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Page HTML Classique</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<header>
	<div class="container">
		<h1>Bienvenue <?php echo $user->getFirstName() . " " . $user->getLastName(); ?></h1>
		<p>Une simple page HTML pour commencer</p>
	</div>
</header>
<main>
	<div class="container mt-4">
		<div class="row">

			<?php
				if (count($userMethodList) === 0) {
					echo "<div class=\"alert alert-danger\" role=\"alert\">No payment method available</div>";
				} else {
					?>
					<form action="/shop/product.php?user=<?php echo $_GET["user"]; ?>&product=<?php echo $_GET["product"]; ?>" method="post">
						<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-body-tertiary"
							 style="background-image: url('<?php echo $room->getPhoto(); ?>'); background-size: cover;">
							<div class="col-md-6 p-lg-5 mx-auto my-5">
								<h1 class="display-3 fw-bold"><?php echo $room->getName(); ?></h1>
								<h3 class="fw-normal text-muted mb-3">Price: <?php echo $productPrice; ?> €</h3>
								<select name="method" class="form-select form-select-lg mb-3" aria-label="Large select example">
									<option selected>Method de payment</option>
                                    <?php
                                        foreach ($userMethodList as $key => $method) {
                                            echo "<option value=\"{$method->getId()}\">{$method->getLabel()}</li>";
                                        }
                                    ?>
								</select>
								<div class="d-flex gap-3 justify-content-center lead fw-normal">
									<input name="user" type="hidden" value="<?php echo $_GET["user"]; ?>">
									<input name="product" type="hidden" value="<?php echo $_GET["product"]; ?>">
									<button type="submit" class="btn btn-primary">Buy</button>
								</div>
							</div>
						</div>
					</form>
					<?php
				}
			?>
		</div>
	</div>
</main>

<footer class="text-center mt-4">
	<p>&copy; 2024 Votre Nom</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>
</body>
</html>
