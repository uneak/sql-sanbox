<?php
    require __DIR__ . '/../../vendor/autoload.php';

    use App\Payment\PaymentMethodFactory;
    use App\Payment\PaymentMethodManager;
    use App\Reservation\UserManager;

    $userManager = new UserManager();
    $paymentMethodManager = new PaymentMethodManager();
    $paymentMethodFactory = new PaymentMethodFactory();

    if (!isset($_GET["user"])) {
        header("Location: index.php");
        exit;
    }

    $user = $userManager->findById($_GET["user"]);
    $userMethodList = $paymentMethodManager->findAll(10, 0, ['user' => $user->getId()]);
    $methodList = $paymentMethodFactory->getPaymentMethods();


	if (isset($_POST["user"]) && isset($_POST["method"])) {
        header("Location: form_".$_POST["method"].".php?user={$_POST["user"]}");
        exit;
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
	<nav class="navbar navbar-expand-lg bg-body-tertiary">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Workhive</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page"
						   href="\shop\home.php?user=<?php echo $user->getId(); ?>">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="\shop\profile.php?user=<?php echo $user->getId(); ?>">Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="\shop">Login</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<h1>Bienvenue <?php echo $user->getFirstName() . " " . $user->getLastName(); ?></h1>
		<p>Une simple page HTML pour commencer</p>
	</div>
</header>
<main>
	<div class="container mt-4">

		<h2>Ajouter un moyen de paiement</h2>

		<form action="/shop/profile.php?user=<?php echo $_GET["user"]; ?>" method="post">
			<select name="method" class="form-select form-select-lg mb-3" aria-label="Large select example">
				<option selected>Method de payment</option>
				<?php
                    foreach ($methodList as $key => $classMethod) {
                        echo "<option value=\"{$key}\">{$key}</li>";
                    }
                ?>
			</select>
			<div class="d-flex gap-3 justify-content-center lead fw-normal">
				<input name="user" type="hidden" value="<?php echo $_GET["user"]; ?>">
				<button type="submit" class="btn btn-primary">Create</button>
			</div>
		</form>


		<h2>Mes moyens de paiement</h2>

		<ul class="list-group">
            <?php
                foreach ($userMethodList as $method) {
                    echo "<li class=\"list-group-item\">{$method->getType()} : {$method->getLabel()}</li>";
                }
            ?>
		</ul>


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