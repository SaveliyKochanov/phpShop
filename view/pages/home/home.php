<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="fonts/fonts.css" />
		<link rel="stylesheet" href="./view/global.css" />
		<link rel="stylesheet" href="./view/partials/header.css">
    	<link rel="stylesheet" href="./view/partials/footer.css">
    	<link rel="stylesheet" href="./view/partials/fot-hed-media.css">

		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

		<link rel="stylesheet" href="./view/pages/home/home.css" />
		<link rel="stylesheet" href="./view/pages/home/media.css" />
		<title>Shop</title>
	</head>
	<body>

	<? include './view/partials/header.php'?>
		
		<main class="main">
			<div class="container">
				<div class="main__content">
					<h1 class="main__header">Товары</h1>
					<div class="ticker">
						<div class="ticker__wrapper">
							<div class="ticker__item">Самовывоз из магазинов 500р</div>
							<div class="ticker__item">Самовывоз из магазинов 500р</div>
							<div class="ticker__item">Самовывоз из магазинов 500р</div>
							<div class="ticker__item">Самовывоз из магазинов 500р</div>
						</div>
					</div>
				</div>
				<div class="popular">
					<h2 class="popular__header">Популярные товары</h2>
					<div class="popular__slider">
						<ul class="popular__list" id="slider">
							<li class="popular__list-item">
								<a class="popular__list-link" href="">
									<img
										class="popular__list-image"
										src="./images/popular-icons/card-1.png"
										alt=""
									/>
									<span class="list-item__description">Куртки и ветровки</span>
								</a>
							</li>
							<li class="popular__list-item">
								<a class="popular__list-link" href="">
									<img
										class="popular__list-image"
										src="./images/popular-icons/card-2.png"
										alt=""
									/>
									<span class="list-item__description">Джинсы</span>
								</a>
							</li>
							<li class="popular__list-item">
								<a class="popular__list-link" href="">
									<img
										class="popular__list-image"
										src="./images/popular-icons/card-3.png"
										alt=""
									/>
									<span class="list-item__description">Рубашки</span>
								</a>
							</li>
							<li class="popular__list-item">
								<a class="popular__list-link" href="">
									<img
										class="popular__list-image"
										src="./images/popular-icons/card-4.png"
										alt=""
									/>
									<span class="list-item__description">Что-то там</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="banners">
					<ul class="banners__list">
						<li class="banners__item spring-summer-banner">
							<h2 class="banners__item-header">ВЕСНА'24</h2>
							<div class="banners__item-links">
								<a class="banners__man-link" href="">Для неё</a>
								<a class="banners__woman-link" href="/man">Для него</a>
							</div>
						</li>
						<li class="banners__item jacket-banner">
							<h2 class="banners__item-header">КУРТКИ</h2>
							<div class="banners__item-links">
								<a class="banners__man-link" href="">Для неё</a>
								<a class="banners__woman-link" href="">Для него</a>
							</div>
						</li>
						<li class="banners__item denim-banner">
							<h2 class="banners__item-header">ДЕНИМ</h2>
							<div class="banners__item-links">
								<a class="banners__man-link" href="">Для неё</a>
								<a class="banners__woman-link" href="">Для него</a>
							</div>
						</li>
						<li class="banners__item shoes-banner">
							<h2 class="banners__item-header">КРОССОВКИ</h2>
							<div class="banners__item-links">
								<a class="banners__man-link" href="">Для неё</a>
								<a class="banners__woman-link" href="">Для него</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</main>
		
		<? include './view/partials/footer.php'?>

		<script src="script.js"></script>
	</body>
</html>
