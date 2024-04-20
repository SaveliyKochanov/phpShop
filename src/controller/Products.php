<?
namespace controller;

use servises\Connect;

class Products{

    public function AddProduct($data){
        print_r($data);
        $productName = $data['productName'];
        $category = $data['category'] == 'Мужское' ? 1 : 2;
        $brand = $data['brand'];
        $size = $data['size'];
        $quantity = $data['quantity'];
        $price = $data['price'];
        $targetFile = null;
        if($_FILES["product-photo"]['size'] != 0){
            $targetFile = $this->UpLoadPhoto(); 
        }
        if(!empty($data['VariantID'])){
            $VariantID = $data['VariantID'];
            $productID = mysqli_fetch_assoc(Connect::$connect->query("SELECT ProductID FROM ProductVariants WHERE VariantID = $VariantID"))["ProductID"];
            if($targetFile != null){
                Connect::$connect->query("UPDATE ProductVariants SET Size = '$size', Price = '$price', Stock = '$quantity' WHERE VariantID = '$VariantID'");
                Connect::$connect->query("UPDATE Products SET ProductName = '$productName', CategoryID = '$category', ProductBrand = '$brand',  ImageURL = '$targetFile' WHERE ProductID = '$productID'");
            }
            else{
                Connect::$connect->query("UPDATE ProductVariants SET Size = '$size', Price = '$price', Stock = '$quantity' WHERE VariantID = '$VariantID'");
                Connect::$connect->query("UPDATE Products SET ProductName = '$productName', CategoryID = '$category', ProductBrand = '$brand' WHERE ProductID = '$productID'");
            }
        }
        else{
            if (!(empty($productName) || empty($category) || empty($brand) || empty($quantity) || empty($price) || empty($size))) {
                if(mysqli_num_rows(Connect::$connect->query("SELECT * FROM Products WHERE ImageURL = '$targetFile'")) == 0){
                    Connect::$connect->query("INSERT INTO Products (ProductName, CategoryID, ProductBrand, ImageURL) VALUES ('$productName', '$category', '$brand', '$targetFile')");
                    $productId = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM Products WHERE ImageURL = '$targetFile'"))['ProductID'];
                    Connect::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES ('$productId', '$size', '$price', '$quantity')");
                }
                else{
                    $productId = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM Products WHERE ImageURL = '$targetFile'"))['ProductID'];
                    Connect::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES ('$productId', '$size', '$price', '$quantity')");
                }
            }
        }
        header("Location: /admin");
    }

    public function DeleteProduct($data){
        $VariantID = $data['VariantID'];
        $productID = mysqli_fetch_assoc(Connect::$connect->query("SELECT ProductID FROM ProductVariants WHERE VariantID = $VariantID"))["ProductID"];
        Connect::$connect->query("DELETE FROM CartItems WHERE VariantID = $VariantID");
        Connect::$connect->query("DELETE FROM ProductVariants WHERE VariantID = $VariantID");
        try{
            Connect::$connect->query("DELETE FROM Products WHERE ProductID = $productID");
        }
        finally{
            header("Location: /admin");
        }
    }

    
    private function UpLoadPhoto(){
        $targetDir = "./images/";
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
        if ($_FILES["product-photo"]["size"] > 50000000) {
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