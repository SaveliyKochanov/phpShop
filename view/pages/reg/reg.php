<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="./view/global.css" />
		<link rel="stylesheet" href="./view/partials/header.css">
    	<link rel="stylesheet" href="./view/partials/footer.css">

		<link rel="stylesheet" href="./view/pages/reg/reg.css" />
		<link rel="stylesheet" href="./view/pages/reg/media.css" />
		<title>reg</title>
	</head>
	<body>
		<? include './view/partials/header.php'?>
		<main class="main">
			<div class="container">
				<div class="main__form-wrapper">
          <h1 class="main__header">Регистрация</h1>
          <form class="main__registration-form" action="/registration" method="post">
            <label for="email">Введите логин или адрес электронной почты</label>
            <input class="registration-form__input" type="email" name="email" />
            <label for="password">Введите пароль</label>
            <input class="registration-form__input" type="password" name="password" />
            <button class="registration--button button" type="submit">Зарегестрироваться
            </button>
          </form>
        </div>
      </div>
		</main>
	</body>
</html>
