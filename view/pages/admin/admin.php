<?
		use servises\Connect;
	// if($_SESSION['role'] < 49) header("Location: /"); //check user role
	$ProductVariants = mysqli_fetch_all(Connect::$connect->query("SELECT * FROM ProductVariants"), MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="./view/partials/header.css">
    	<link rel="stylesheet" href="./view/partials/footer.css">

		<link rel="stylesheet" href="./view/global.css">
		<link rel="stylesheet" href="./view/pages/admin/admin.css">
		<title>admin</title>
	</head>
	<body>
		<? include './view/partials/header.php'?>
		<main class="main">
			<div class="container">
				<h2 class="main__header">Панель администратора</h2>
				<div class="main-wrapper">
				<div class="main__content">
					<div class="main__panel">
						<table class="panel-table">
							<tr class="table__header-row">
								<td class="photo">
									Фото
								</td>
								<td class="name">
									Название
								</td>
								<td class="category">
									Категория
								</td>
								<td class="brand">
									Бренд
								</td>
								<td class="size">
									Размер
								</td>
								<td class="quantity">
									Кол-во
								</td>
								<td class="price">
									Цена
								</td>
								<td class="price">
									Удаление
								</td>
								<td class="price">
									Изменение
								</td>
							</tr>
						<tbody>
							<?php
							foreach($ProductVariants as $item): 
								$productId = $item['ProductID'];
								$product = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM Products WHERE ProductID = $productId"))
							?>
							
							<tr>
								<td><img src="<?= $product['ImageURL']?>" alt="<?= $product['ImageURL']?>" style="width: 80px; height 80px;"></td>
								<td><?= $product['ProductName']?></td>
								<td><?= $product['CategoryID'] == 1 ? 'Мужское' : 'Женское' ?></td>
								<td><?= $product['ProductBrand']?></td>
								<td><?= $item['Size']?></td>
								<td><?= $item['Price']?></td>
								<td><?= $item['Stock']?></td>
								<td>
								<form action="/deleteProduct" method="POST">
									<input type="hidden" name="VariantID" value="<?= $item['VariantID'] ?>">
									<button type="submit" class="delete-button">Удалить</button>
								</form>
								</td>
								<td><a href="/admin?VariantID=<?=$item['VariantID']?>">Изменить</a></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						</table>
					</div>
					<button class="save-button button">Количество товаров: <?= count($ProductVariants)?></button>
				</div>
				<div class="form-wrapper">
					<?
						$VariantID = isset($_GET['VariantID']) ? $_GET['VariantID'] : '';
						$productCategory = false;
						$productSize = null;
						if($VariantID !== ''){

							$ProductVariant = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM ProductVariants WHERE VariantID = $VariantID"));
							$ProductId = $ProductVariant['ProductID'];
							$product = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM Products WHERE ProductID = $ProductId"));
							$product = array_merge($ProductVariant, $product);


							$productCategory = $product['CategoryID'] == 1 ? 'Мужское' : 'Женское';
							$productSize = $product['Size'];
						}
					?>
					<form class="panel-form" method="post" action="/addProduct" enctype="multipart/form-data">
					<input type="hidden" name="VariantID" value="<?= $_GET['VariantID'] ?? ''?>">
					<label for="brand">Бренд</label>
					<input type="text" id="brand" name="brand" class="product-brand" value="<?= isset($_GET['VariantID']) ?  $product['ProductBrand'] : ''?>" required>

					<label for="name">Название товара</label>
					<input type="text" id="name" name="productName" class="product-name" value="<?= isset($_GET['VariantID']) ?  $product['ProductName'] : ''?>" required>
					
					<label for="category">Категория</label>
					<select id="category" name="category" class="product-category" required>
						<option value="Мужское" <?= $productCategory == 'Мужское' ? 'selected' : '' ?>>Мужское</option>
						<option value="Женское" <?= $productCategory == 'Женское' ? 'selected' : '' ?>>Женское</option>
					</select>

					<label for="size">Размер</label>
					<select id="size" name="size" class="product-size" required>
						<option value="XS" <?= $productSize == 'XS' ? 'selected' : '' ?>>XS</option>
						<option value="S" <?= $productSize == 'S' ? 'selected' : '' ?>>S</option>
						<option value="M" <?= $productSize == 'M' ? 'selected' : '' ?>>M</option>
						<option value="L" <?= $productSize == 'L' ? 'selected' : '' ?>>L</option>
						<option value="XL" <?= $productSize == 'XL' ? 'selected' : '' ?>>XL</option>
						<option value="XXL" <?= $productSize == 'XXL' ? 'selected' : '' ?>>XXL</option>
					</select>
					
					<label for="quantity">Количество</label>
					<input type="number" id="quantity" name="quantity" class="product-quantity" value="<?= isset($_GET['VariantID']) ?  $product['Stock'] : ''?>" required>
					
					<label for="price">Цена</label>
					<input type="text" id="price" name="price" class="product-price" value="<?= isset($_GET['VariantID']) ?  $product['Price'] : ''?>" required>
					
					<input type="file" id="photo-uploaded" name="product-photo">
					
					<button class="form__add-button button" type="submit"><?= isset($_GET['VariantID']) ? 'Сохранить изменения' : 'Добавить товар'?></button>
					</form>
			</div>
		</div>
			</div>
		</main>
	</body>
</html>  