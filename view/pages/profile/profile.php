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
							<p class="mail">kochanov.saveliy222@mail.ru</p>
							<button>изменить</button>
						</div>
						<p class="profile-info__password">Пароль</p>
						<div class="profile-field">
							<p>************</p>
							<button>изменить</button>
						</div>
					</div>

					<div class="order-info">
						<h3 class="order-title">ЗАКАЗ №1</h3>
						<div class="order-item">
							<p>Утепленный свитшот с принтом</p>
							<p>размер: M</p>
							<p>количество: <span>12</span></p>
							<p>стоимость:<span>1500</span>Р</p>
						</div>
						<div class="order-item">
							<p>Платье летнее</p>
							<p>размер: <span>M</span></p>
							<p>количество: <span>1</span></p>
							<p>стоимость: <span>3000</span>Р</p>
						</div>
						<div class="order-delivery">
							<p>доставка в г. Красноярск</p>
							<p>доставка: 600 Р</p>
						</div>
						<div class="order-total">
							<span>ИТОГО:4500 Р</p>
						</div>
					</div>
				</section>
			</div>
		</main>
		<? include './view/partials/footer.php'?>

	</body>
</html>
