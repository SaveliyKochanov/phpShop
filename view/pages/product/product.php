<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="./view/global.css" />
	<link rel="stylesheet" href="./view/partials/header.css">
	<link rel="stylesheet" href="./view/partials/footer.css">
	<link rel="stylesheet" href="./view/partials/fot-hed-media.css">
	<link rel="stylesheet" href="./view/pages/product/product.css" />
	<link rel="stylesheet" href="./view/pages/product/media.css" />
	<title>Product</title>
</head>

<body>
	<? include './view/partials/header.php' ?>


	<main class="main">
		<div class="container">
			<div class="main__content">
				<?

				use servises\Connect;

				if (!isset($_GET['ProductID'])) header('Location: /');
				$ProductId = $_GET['ProductID'];
				$Product = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM Products WHERE ProductID = $ProductId"));
				$ProductVariants = mysqli_fetch_all(Connect::$connect->query("SELECT * FROM ProductVariants WHERE ProductId = $ProductId"), MYSQLI_ASSOC);
				?>
				<div class="main__slider">
					<ul class="main__slider-list">
						<li class="main__slider-item">
							<img class="main__slider-image" src="<?= $Product['ImageURL'] ?>" alt="<?= $Product['ProductName'] ?>" />
						</li>
						<li class="main__slider-item">
							<img class="main__slider-image" src="<?= $Product['ImageURL'] ?>" alt="<?= $Product['ProductName'] ?>" />
						</li>
					</ul>

				</div>
				<form class="main__description" action="/addToCart" method="post">
					<p class="description-name">
						<?= $Product['ProductBrand'] . ' | ' . $Product['ProductName'] ?>
					</p>
					<p class="description-price"><?= $ProductVariants[0]['Price'] ?></p>
					<p class="description-size">Выберите размер</p>
					<fieldset class="choose-size">
						<div class="size-selector">
							<? for ($i = 0; $i < count($ProductVariants); $i++) {
							?>

								<input type="radio" id="size-<?= $ProductVariants[$i]['Size'] ?>" name="size" value="<?= $ProductVariants[$i]['Size'] ?>" class="size-selector__radio" <?= $i == 0 ? 'checked' : '' ?> />
								<label for="size-<?= $ProductVariants[$i]['Size'] ?>" class="size-selector__label"><?= $ProductVariants[$i]['Size'] ?></label>
							<? } ?>

						</div>
					</fieldset>
					<input type="hidden" name="ProductID" value="<?= $ProductId ?>">
					<button class="add-to-cart--button button" type="submit">
						Добавить в корзину
					</button>
					<p class="description-text">
						<?= $Product['Description'] ?>
					</p>
				</form>
			</div>
		</div>
	</main>

	<? include './view/partials/footer.php' ?>
</body>

</html>