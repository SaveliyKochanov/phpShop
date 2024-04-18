<?

use controller\Products;
use servises\Connect;
$data = Connect::$connect->query("SELECT * FROM Products WHERE CategoryID = 1 ORDER BY Price ASC");
$products = mysqli_fetch_all($data, MYSQLI_ASSOC);
$productsCount = count($products);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="./view/global.css" />
		<link rel="stylesheet" href="./view/partials/header.css">
    	<link rel="stylesheet" href="./view/partials/footer.css">
		<link rel="stylesheet" href="./view/pages/man/man.css" />
		<link rel="stylesheet" href="./view/pages/man/media.css" />

		<title>MEN</title>
	</head>
	<body>
		<? include './view/partials/header.php'?>
		<main class="main">
			<div class="container">
				<div class="top-block">
					<div class="top-block__heading">
						<h1 class="top-block__title">ОДЕЖДА И ОБУВЬ ДЛЯ МУЖЧИН</h1>
						<p class="top-block__count"><?= $productsCount?></p>
					</div>
				</div>
				<div class="filters-block">
					<div class="filters-block__filters">
						<button class="filters-block__text">фильтры</button>
						<nav class="dropdown-menu">
							<h3 class="dropdown-menu__header">ФИЛЬТРЫ</h3>
							<ul class="dropdown-menu__list">
								<li class="dropdown-menu__item">
									
									<p class="dropdown-menu__item-header">Цена</p>
									<label class="dropdown-menu__input-label" for="">от</label>
									<input class="dropdown-menu__input" type="number" id="price-min" name="price-min" value="<?= $products[0]["Price"]?>">
									<label class="dropdown-menu__input-label" for="">до</label>
									<input class="dropdown-menu__input" type="number" id="price-max" name="price-max" value="<?= $products[$productsCount-1]["Price"]?>">
								</li>
								<li class="dropdown-menu__item">
									<p class="dropdown-menu__item-header brands">Бренд</p>
									<ul class="dropdown-menu__item-content">
										<?
											$brands = Connect::$connect->query("SELECT DISTINCT ProductBrand FROM Products WHERE CategoryID = 1 ORDER BY ProductBrand");
											
											foreach(mysqli_fetch_all($brands, MYSQLI_ASSOC) as $brand):
												
										?>
										<li class="dropdown-menu__item-option">
											<input type="checkbox" id="<?=$brand["ProductBrand"]?>" name="brand" value="<?=$brand["ProductBrand"]?>">
											<label for="<?=$brand["ProductBrand"]?>"><?=$brand["ProductBrand"]?></label>
										</li> 

										<? endforeach; ?>
									</ul>
								</li>
								<li class="dropdown-menu__item">
									<p class="dropdown-menu__item-header size">Размер</p>
									<ul class="dropdown-menu__item-content">
										<?
											$Sizies = Connect::$connect->query("SELECT DISTINCT Size FROM Products WHERE CategoryID = 1 ORDER BY Size");
											foreach(mysqli_fetch_all($Sizies, MYSQLI_ASSOC) as $size):	
										?>
										<li class="dropdown-menu__item-option">
											<input type="checkbox" id="<?=$size["Size"]?>" name="size" value="<?=$size["Size"]?>">
											<label for="<?=$size["Size"]?>"><?=$size["Size"]?></label>
										</li> 
										<? endforeach; ?>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<div class="cards">
					<ul class="cards__list">
						<?
							$unicImageUrl = Connect::$connect->query("SELECT DISTINCT ImageURL FROM Products WHERE CategoryID = 1");
							foreach(mysqli_fetch_all($unicImageUrl, MYSQLI_ASSOC) as $productik):
							$url = 	$productik["ImageURL"];
							$product = mysqli_fetch_all(Connect::$connect->query("SELECT * FROM Products WHERE ImageURL = '$url'"), MYSQLI_ASSOC)[0];
						?>
						<li class="cards__list-item">
							<a class="cards__list-link" href="">
								<article class="card">
									<img class="card__image" src="<?= $product["ImageURL"]?>" alt="<?= $product["ProductName"]?>">
									<p class="card__name"><?= $product["ProductName"]?></p>
								</article>
							</a>
						</li>
						<? endforeach; ?>
					</ul>
				</div>
			</div>
		</main>
		<? include './view/partials/footer.php'?>
		<script src="./view/pages/man/man.js"></script>
	</body>
</html>
