<?php
    require __DIR__ . '/../../vendor/autoload.php';

    use App\Payment\PaymentMethodFactory;
    use App\Payment\PaymentMethodManager;
    use App\Reservation\UserManager;

    $userManager = new UserManager();
    $paymentMethodFactory = new PaymentMethodFactory();
    $paymentMethodManager = new PaymentMethodManager();

    if (!isset($_GET["user"])) {
        header("Location: index.php");
        exit;
    }

    $user = $userManager->findById($_GET["user"]);

    $isValidated = (isset($_POST["email"]) && isset($_POST["password"]));

    if ($isValidated) {
        $paymentMethodManager->create([
            'label'   => $_POST["label"],
            'type'    => 'paypal',
            'user_id' => $user->getId(),
            'data'    => [
                'email'    => $_POST["email"],
                'password' => $_POST["password"],
            ],
        ]);
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

        <?php if ($isValidated) { ?>
			<div class="alert alert-success" role="alert">
				Votre carte a bien été enregistrée<br/>
				<a href="/shop/profile.php?user=<?php echo $user->getId(); ?>" class="btn btn-primary">Retour</a>
			</div>
        <?php } else { ?>

			<form action="" method="POST">
				<label for="number">Nom :</label>
				<input type="text" id="label" name="label" placeholder="Compte binance" required>
				<br><br>

				<label for="number">Email :</label>
				<input type="text" id="email" name="email" placeholder="test@email.com" required>
				<br><br>

				<label for="number">Password :</label>
				<input type="text" id="password" name="password" placeholder="123" required>
				<br><br>

				<button type="submit" class="btn btn-primary">Envoyer</button>
			</form>

        <?php } ?>
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