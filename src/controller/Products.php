<?
namespace controller;
use servises\Connect;

class Products{

    public function AddProduct($data){
        $productName = $data['productName'];
        $category = $data['category'] == 'Мужское' ? 1 : 2;
        $brand = $data['brand'];
        $quantity = $data['quantity'];
        $price = $data['price'];
        $targetFile = null;
        if($_FILES["product-photo"]['size'] != 0){
            $targetFile = $this->UpLoadPhoto(); 
        }
        if(!empty($data['ProductID'])){
            $productID = $data['ProductID'];
            if($targetFile != null){
                Connect::$connect->query("UPDATE Products SET ProductName = '$productName', CategoryID = '$category', ProductBrand = '$brand', Price = '$price', Stock = '$quantity', ImageURL = '$targetFile' WHERE ProductID = '$productID'");
            }
            else{
                Connect::$connect->query("UPDATE Products SET ProductName = '$productName', CategoryID = '$category', ProductBrand = '$brand', Price = '$price', Stock = '$quantity' WHERE ProductID = '$productID'");
            }
        }
        else{
            if (!(empty($productName) || empty($category) || empty($brand) || empty($quantity) || empty($price))) {
                Connect::$connect->query("INSERT INTO Products (ProductName, CategoryID, ProductBrand, Price, Stock, ImageURL) 
                VALUES ('$productName', '$category', '$brand', '$price', '$quantity', '$targetFile')");
            }
        }
        header("Location: /admin");
    }

    public function DeleteProduct($data){
        $productID = $data['ProductID'];
        Connect::$connect->query("DELETE FROM Products WHERE ProductID = $productID");
        header("Location: /admin");
    }

    
    private function UpLoadPhoto(){
        $targetDir = "images/";
        $targetFile = $targetDir . basename($_FILES["product-photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["product-photo"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }

        if (file_exists($targetFile)) {
            return $targetFile;
        }
        if ($_FILES["product-photo"]["size"] > 500000) {
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "webp" && $imageFileType != "svg") {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
        } else {
            move_uploaded_file($_FILES["product-photo"]["tmp_name"], $targetFile);
        }

        return $targetFile;
    }
}