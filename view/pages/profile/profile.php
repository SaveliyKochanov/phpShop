<?
 use servises\Connect;
 $UserID = $_SESSION['UserID'];
 $UserInfo = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM Users WHERE UserID = $UserID"));
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
		<link rel="stylesheet" href="./view/pages/profile/profile.css" />
		<link rel="stylesheet" href="./view/pages/profile/media.css" />
		<title>profile</title>
	</head>
	<body>
	<? include './view/partials/header.php'?>


		<main class="main">
			<div class="container">
				<section class="profile">
					<h2 class="main__title">ПРОФИЛЬ</h2>
					<div class="profile-info">
						<p class="profile-info__email">Ваша почта</p>
						<div class="profile-field">
							<p class="mail"><?= $UserInfo['Email']?></p>
							<button>изменить</button>
						</div>
						<p class="profile-info__password">Пароль</p>
						<div class="profile-field">
							<p><?=str_repeat('*', strlen($UserInfo['Password']))?></p>
							<button>изменить</button>
						</div>
					</div>
					<?
						$UserOrders = mysqli_fetch_all(Connect::$connect->query("SELECT * FROM Orders WHERE UserID = $UserID"), MYSQLI_ASSOC);
						foreach($UserOrders as $order):
							$orderId = $order['OrderID'];
							$OrderDetails = mysqli_fetch_all(Connect::$connect->query("SELECT * FROM OrderDetails WHERE OrderID = $orderId"), MYSQLI_ASSOC);
					?>
					<div class="order-info">
						<h3 class="order-title">ЗАКАЗ №<?=$orderId?></h3>
							<? 
							foreach($OrderDetails as $detail): 
								$VariantID = $detail['VariantID'];
								$ProductVariant = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM ProductVariants WHERE VariantID = $VariantID"));
								$ProductId = $ProductVariant['ProductID'];
								$Product = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM Products WHERE ProductID = $ProductId"));
								$Product = array_merge($ProductVariant, $Product);
							?>
						<div class="order-item">
							<p><?= $Product['ProductBrand'] . ' | ' . $Product['ProductName']?></p>
							<p>размер: <?=$Product['Size']?></p>
							<p>количество: <span><?=$detail['Quantity']?></span></p>
							<p>стоимость:<span><?=$detail['Price']?></span>Р</p>
						</div>
							<? endforeach; ?>
						<div class="order-delivery">
							<p>доставка в г. Красноярск</p>
							<p>доставка: <?=$order['DeliveryPrice']?> Р</p>
						</div>
						<div class="order-total">
							<span>ИТОГО: <?=$order['TotalPrice']?> Р</p>
						</div>
					</div>
					<? endforeach; ?>
				</section>
			</div>
		</main>
		<? include './view/partials/footer.php'?>

	</body>
</html>
