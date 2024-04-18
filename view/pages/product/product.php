<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="./view/global.css" />
		<link rel="stylesheet" href="./view/partials/header.css">
    	<link rel="stylesheet" href="./view/partials/footer.css">
		<link rel="stylesheet" href="./view/pages/product/product.css" />
		<link rel="stylesheet" href="./view/pages/product/media.css" />
		<title>Product</title>
	</head>
	<body>
	<? include './view/partials/header.php'?>


	<main class="main">
   <div class="container">
    <div class="main__content">
     <div class="main__slider">
      <ul class="main__slider-list">
       <li class="main__slider-item">
        <img
         class="main__slider-image"
         src="images/main__slider-image.png"
         alt=""
        />
       </li>
       <li class="main__slider-item">
        <img
         class="main__slider-image"
         src="images/main__slider-image.png"
         alt=""
        />
       </li>
      </ul>
     </div>
     <form class="main__description">
      <p class="description-name">
       Черное худи
      </p>
      <p class="description-price">1200</p>
      <p class="description-size">Выберите размер</p>
      <fieldset class="choose-size">
       <div class="size-selector">
        <input
         type="radio"
         id="size-xs"
         name="size"
         value="xs"
         class="size-selector__radio"
        />
        <label for="size-xs" class="size-selector__label">XS</label>

        <input
         type="radio"
         id="size-s"
         name="size"
         value="s"
         class="size-selector__radio"
        />
        <label for="size-s" class="size-selector__label">S</label>

        <input
         type="radio"
         id="size-m"
         name="size"
         value="m"
         class="size-selector__radio"
        />
        <label for="size-m" class="size-selector__label">M</label>

        <input
         type="radio"
         id="size-l"
         name="size"
         value="l"
         class="size-selector__radio"
        />
        <label for="size-l" class="size-selector__label">L</label>

        <input
         type="radio"
         id="size-xl"
         name="size"
         value="xl"
         class="size-selector__radio"
        />
        <label for="size-xl" class="size-selector__label">XL</label>
       </div>
      </fieldset>
      <button class="add-to-cart--button button">
       Добавить в корзину
      </button>
      <p class="description-text">
       какая-то заебательская кофта какая-то заебательская кофта какая-то
       заебательская кофта какая-то заебательская кофта какая-то
       заебательская кофта какая-то заебательская кофта какая-то
       заебательская кофта какая-то заебательская кофта какая-то
       заебательская кофта какая-то заебательская кофта какая-то
       заебательская кофта какая-то заебательская кофта какая-то
       заебательская кофта
      </p>
     </form>
    </div>
   </div>
  </main>

		<? include './view/partials/footer.php'?>
	</body>
</html>
