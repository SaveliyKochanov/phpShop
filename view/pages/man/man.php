<?

use servises\Connect;
$data = Connect::$connect->query("SELECT * FROM Products WHERE CategoryID = 1");
$products = mysqli_fetch_all($data, MYSQLI_ASSOC);
$productsCount = count($products);

$AllProducts = mysqli_fetch_all(Connect::$connect->query("SELECT Products.ProductID, Products.ProductName, Products.ProductBrand, Products.Description, Products.ImageURL, ProductVariants.Size, ProductVariants.Price, ProductVariants.Stock
FROM Products
JOIN ProductVariants ON Products.ProductID = ProductVariants.ProductID
WHERE Products.CategoryID = 1
ORDER BY Products.ProductName, ProductVariants.Size;
"), MYSQLI_ASSOC);


$MinMaxPrice = mysqli_fetch_all(Connect::$connect->query("SELECT 
MIN(Price) AS CheapestPrice,
MAX(Price) AS MostExpensivePrice
FROM ProductVariants
JOIN Products ON ProductVariants.ProductID = Products.ProductID
WHERE Products.CategoryID = 1;
"))[0];
$cards = mysqli_fetch_all(Connect::$connect->query("SELECT DISTINCT ImageURL FROM Products WHERE CategoryID = 1"), MYSQLI_ASSOC);

if (isset($_GET['filter'])) {
	$MinPrice = $_GET['price-min'] ?? '';
	$MaxPrice = $_GET['price-max'] ?? '';
	$selectedBrands = $_GET['brand'] ?? [];
	$selectedSizes = $_GET['size'] ?? [];
	

	$queryParts = [];
$params = [];
$queryTypes = '';

// Добавляем фильтр по минимальной и максимальной цене
if (!empty($MinPrice)) {
    $queryParts[] = "ProductVariants.Price >= ?";
    $params[] = $MinPrice;
    $queryTypes .= 'd'; // тип double для цены
}
if (!empty($MaxPrice)) {
    $queryParts[] = "ProductVariants.Price <= ?";
    $params[] = $MaxPrice;
    $queryTypes .= 'd'; // тип double для цены
}

// Добавляем фильтр по брендам
if (!empty($selectedBrands)) {
    $brandPlaceholders = implode(',', array_fill(0, count($selectedBrands), '?'));
    $queryParts[] = "Products.ProductBrand IN ($brandPlaceholders)";
    $params = array_merge($params, $selectedBrands);
    $queryTypes .= str_repeat('s', count($selectedBrands)); // тип string для брендов
}

// Добавляем фильтр по размерам
if (!empty($selectedSizes)) {
    $sizePlaceholders = implode(',', array_fill(0, count($selectedSizes), '?'));
    $queryParts[] = "ProductVariants.Size IN ($sizePlaceholders)";
    $params = array_merge($params, $selectedSizes);
    $queryTypes .= str_repeat('s', count($selectedSizes)); // тип string для размеров
}

// Формируем окончательный запрос
$query = "SELECT DISTINCT Products.ProductID, Products.ProductName, Products.ProductBrand, Products.Description, Products.ImageURL
          FROM Products
          JOIN ProductVariants ON Products.ProductID = ProductVariants.ProductID
          WHERE Products.CategoryID = 1";
          
if (!empty($queryParts)) {
    $query .= " AND " . implode(' AND ', $queryParts);
}


$stmt = Connect::$connect->prepare($query);
if (!empty($params)) {
    $stmt->bind_param($queryTypes, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$filteredProducts = $result->fetch_all(MYSQLI_ASSOC);
$cards = $filteredProducts;
}



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
							<form action="<?$_GET['rout']?>" method="get">
							
							<button type="submit" name="filter" value="1">Фильтровать</button>
								<li class="dropdown-menu__item">
									
									<p class="dropdown-menu__item-header">Цена</p>
									<label class="dropdown-menu__input-label" for="">от</label>
									<input class="dropdown-menu__input" type="number" id="price-min" name="price-min" value="<?= floor($MinMaxPrice[0])?>">
									<label class="dropdown-menu__input-label" for="">до</label>
									<input class="dropdown-menu__input" type="number" id="price-max" name="price-max" value="<?= round($MinMaxPrice[1])?>">
								</li>
								<li class="dropdown-menu__item">
									<p class="dropdown-menu__item-header brands">Бренд</p>
									<ul class="dropdown-menu__item-content">
										<?
											
												$brands = Connect::$connect->query("SELECT DISTINCT ProductBrand FROM Products WHERE CategoryID = 1 ORDER BY ProductBrand");
												foreach($brands as $brand):
										?>
										<li class="dropdown-menu__item-option">
											<input type="checkbox" id="<?=$brand["ProductBrand"]?>" name="brand[]" value="<?=$brand["ProductBrand"]?>" <?=!empty($_GET["brand"]) && in_array($brand["ProductBrand"], $_GET["brand"]) ? 'checked' : ''?>>
											<label for="<?=$brand["ProductBrand"]?>"><?=$brand["ProductBrand"]?></label>
										</li> 
										<?endforeach;?>
									</ul>
								</li>
								<li class="dropdown-menu__item">
									<p class="dropdown-menu__item-header size">Размер</p>
									<ul class="dropdown-menu__item-content">
										<?
											$sizies = Connect::$connect->query("SELECT DISTINCT ProductVariants.Size 
											FROM ProductVariants
											JOIN Products ON ProductVariants.ProductID = Products.ProductID
											WHERE Products.CategoryID = 1
											ORDER BY ProductVariants.Size");
											foreach($sizies as $size):
										?>
										<li class="dropdown-menu__item-option">
										<input type="checkbox" id="<?=$size["Size"]?>" name="size[]" value="<?=$size["Size"]?>" <?=!empty($_GET["size"]) && in_array($size["Size"], $_GET["size"]) ? 'checked' : ''?>>

											<label for="<?=$size["Size"]?>"><?=$size["Size"]?></label>
										</li> 
										<?endforeach;?>
									</ul>
								</li>
								<li class="dropdown-menu__item">
									
								</li>
							</form>

								<li class="dropdown-menu__item">
								<form action="<?=$_GET['rout']?>" method="get">
									<button>Очистить</button>
								</form>
								</li>
							</ul>

						</nav>
					</div>
				</div>
				<div class="cards">
					<ul class="cards__list">
						<?
							foreach($cards as $productik):
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
