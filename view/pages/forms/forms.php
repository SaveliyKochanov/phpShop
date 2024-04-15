<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./view/partials/header.css">
    <link rel="stylesheet" href="./view/partials/footer.css">

    <link rel="stylesheet" href="./view/pages/forms/forms.css">
    <title>forms</title>
</head>
<body>
<? include './view/partials/header.php'?>

<div class="container">
<?


session_start();
if (isset($_SESSION['email'])) {
    echo "Email пользователя: " . $_SESSION['email'];
} else {
    echo "Пользователь не авторизован.";
}
?>
<form action="/registration" method="post">
    reg
    <input type="text" name="email">
    <input type="text" name="password1">
    <input type="text" name="password2">
    <input type="hidden" name="return_url" value="<?= $_GET['rout'] ?? '/'?>">
    <button>hui</button>
</form>
<form action="/login" method="post">
    vhod
    <input type="text" name="email" id="">
    <input type="text" name="password" id="">
    <input type="hidden" name="return_url" value="<?= $_GET['rout'] ?? '/'?>">
    <button>hui</button>
</form>
<form action="/logout" method="post">
    vihod
    <input type="hidden" name="return_url" value="<?= $_GET['rout'] ?? '/'?>">
    <button>hui</button>
</form>
<div class="products" style="background-color: wheat;">
products
    <table>
        <?php
            use servises\Connect;
            $data = mysqli_fetch_all(Connect::$connect->query("SELECT * FROM Products"), MYSQLI_ASSOC);
            foreach($data as $item){
        ?>
        <tr>
            <td><?= $item['ProductID']?></td>
            <td><?= $item['CategoryID']?></td>
            <td><?= $item['ProductName']?></td>
            <td><?= $item['Description']?></td>
            <td><?= $item['Price']?></td>
            <td><?= $item['Stock']?></td>
            <td ><img src="<?= $item['ImageURL']?>" alt="Product image" style="width: 80px; height 80px;"></td>
        </tr>
        <?php
            }
        ?>
    </table>
</div>
</div>

<? include './view/partials/footer.php'?>
</body>
</html>