<?
	use servises\Connect;
	if(isset($_SESSION['UserID'])){
		$UserID = $_SESSION['UserID'];
	}
	else{
		header('Location: /auth');
	}
	$CartItems = mysqli_fetch_all(Connect::$connect->query("SELECT * FROM CartItems WHERE UserID = $UserID ORDER BY 'CategoryID' ASC"), MYSQLI_ASSOC);
	$countCartItems = count($CartItems);
	$countPositions = 0;
	$total = 0;
	$discount = 137;
	$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<link rel="stylesheet" href="./view/global.css" />
		<link rel="stylesheet" href="./view/partials/header.css">
    	<link rel="stylesheet" href="./view/partials/footer.css">
    	<link rel="stylesheet" href="./view/partials/fot-hed-media.css">
		<link rel="stylesheet" href="./view/pages/cart/cart.css" />
		<link rel="stylesheet" href="./view/pages/cart/media.css" />

		<title>Cart</title>
	</head>
	<body>
		<? include './view/partials/header.php'?>
		<main class="main">
			<div class="container">
				<?if($countCartItems != 0){?>
				<div class="main__content">
					<div class="main__shopping-cart">
						<ul class="main__cart-list">
							<?
								foreach($CartItems as $item):
									$VariantID = $item['VariantID'];
									$ProductVariant = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM ProductVariants WHERE VariantID = $VariantID"));
									$ProductId = $ProductVariant['ProductID'];
									$Product = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM Products WHERE ProductID = $ProductId"));
									$Product = array_merge($ProductVariant, $Product);
									$countPositions += $item['Quantity'];
									$total += $Product['Price'] * $item['Quantity'];
							?>
							<li class="main__cart-item">
								<div class="cart-item__image-wrapper">
									<img
										class="cart-item__image"
										src="<?= $Product['ImageURL']?>"
										alt="<?= $Product['ProductBrand'].' | '. $Product['ProductName']?>"
									/>
								</div>
								<div class="cart-item__info">
									<h2 class="shopping-cart__title">
										<?= $Product['ProductBrand'].' | '. $Product['ProductName']?>
									</h2>
									<p class="shopping-cart__price"><?=$Product['Price']?><span>₽</span></p>
									<p class="shopping-cart__size"><?=$Product['Size']?></p>
									<div class="shopping-cart__actions">
										<div class="shopping-cart__quantity-selector">
											<form action="/cartUpdateQuantity" method="post">
												<input type="hidden" name="operation" value="-">
												<input type="hidden" name="VariantID" value="<?=$VariantID?>">
												<input type="hidden" name="Quantity" value="<?=$item['Quantity']?>">
												<button class="quantity-selector__button decrement">
													-
												</button>
											</form>
											<input
												type="text"
												class="quantity-selector__input"
												value="<?=$item['Quantity']?>"
												min="1"
												readonly
											/>
											<form action="/cartUpdateQuantity" method="post">
												<input type="hidden" name="operation" value="+">
												<input type="hidden" name="VariantID" value="<?=$VariantID?>">
												<input type="hidden" name="Quantity" value="<?=$item['Quantity']?>">
												<button class="quantity-selector__button decrement">
													+
												</button>
											</form>
										</div>
										<form action="/cartDeletePosition" method="post">
											<input type="hidden" name="VariantID" value="<?=$VariantID?>">
											<button class="shopping-cart__delete-button">
												<img
													src="./images/cart-icons/delete.svg"
													alt="Удалить товар"
												/>
											</button>
										</form>
									</div>
								</div>
							</li>
							<? endforeach; ?>
						</ul>
					</div>
					<div class="main__summary-details">
						<div class="summary-details__row">
							<span class="summary-details__label city">
								доставка в г. Красноярск
							</span>
						</div>
						<div class="summary-details__row">
							<span class="summary-details__value">27 апреля</span>
							<span class="summary-details__price">от 649 руб.</span>
						</div>
						<div class="summary-details__row">
							<span class="summary-details__label">Всего позиций <?= $countPositions?></span>
							<span class="summary-details__total"><?= $total?> Р</span>
						</div>
						<div class="summary-details__row">
							<span class="summary-details__label">скидка</span>
							<span class="summary-details__discount"><?= $discount?> Р</span>
						</div>
						<div class="summary-details__row summary-details__total-row">
							<span class="summary-details__label">ИТОГО</span>
							<span class="summary-details__total-price"><?= $totalPrice = $total - $discount?> Р</span>
						</div>
						<button class="summary-details__button">
							Сделать заказ
						</button>
					</div>
				</div>
				<?}else{?>
					<img
						class=""
						src="./images/cart-icons/emptyCart.svg"
						alt="emptyCart"
					/>
					<span class="">Ваша корзина пуста! Сначала закинь в неё чё-нибудь!</span>
					<form action="/catalog" method="get">
						<button class="">
								Открыть каталог
						</button>
					</form>
				<?}?>
			</div>
		</main>

		<? include './view/partials/footer.php'?>
		
		<script src="shoppingCart.js"></script>
	</body>
</html>
