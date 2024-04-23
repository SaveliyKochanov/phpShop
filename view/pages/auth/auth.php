<?
	if(isset($_SESSION['UserID'])) header('Location: /profile')
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="./view/global.css" />
		<link rel="stylesheet" href="./view/partials/header.css">
    	<link rel="stylesheet" href="./view/partials/footer.css">

		<link rel="stylesheet" href="./view/pages/auth/auth.css" />
		<link rel="stylesheet" href="./view/pages/auth/media.css" />
		<title>auth</title>
	</head>
	<body>
	<? include './view/partials/header.php'?>
		
		<main class="main">
			<div class="container">
				<div class="main__form-wrapper">
					<h1 class="main__header">Авторизация</h1>
					<form class="main__registration-form" action="/login" method="post">
							<label for="email">Введите логин или адрес электронной почты</label>
							<input class="registration-form__input" type="email" name="email"/>
							<label for="password">Введите пароль</label>
							<input class="registration-form__input" type="password" name="password"/>
							<div class="registration__form-buttons">
								<button class="authorization--button button" type="submit">Продолжить
								</button>
								<a class="registration--button button" href='/reg'>Регистрация
								</a>
							</div>
					</form>
				</div>
			</div>
		</main>
	</body>
</html>
