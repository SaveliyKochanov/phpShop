<?
namespace controller;

use mysqli;
use servises\Connect;

class Cart{

    public function UpdateQuantity($data){
        $operation = $data['operation'] == "+" ? 1 : -1;
        $VariantID = $data['VariantID'];
        $Quantity = $data['Quantity'] + $operation;
        if($Quantity != 0){
            Connect::$connect->query("UPDATE CartItems SET Quantity = $Quantity WHERE VariantID = $VariantID");
        }
        header('Location: /cart');
    }

    public function DeletePosition($data){
        $VariantID = $data['VariantID'];
        Connect::$connect->query("DELETE FROM CartItems WHERE VariantID = $VariantID");
        header('Location: /cart');
    }

    public function addToCart($data){
        if(!isset($_SESSION['UserID'])) header('Location: /');
        $UserID = $_SESSION['UserID'];
        $ProductID = $data['ProductID'];
        $size = $data['size'];
        $ProductVariant = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM ProductVariants WHERE ProductID = '$ProductID' AND Size = '$size'"));
        $VariantID = $ProductVariant['VariantID'];
        $CartItemsCount = mysqli_num_rows(Connect::$connect->query("SELECT * FROM CartItems WHERE UserID = $UserID AND VariantID = $VariantID"));
        if($CartItemsCount == 0){
            Connect::$connect->query("INSERT INTO CartItems(UserID, VariantID, Quantity) VALUES ($UserID, $VariantID, 1)");
        }
        header("Location: /product?ProductID=$ProductID");
    }
    
    public function CreateOrder($data){
        $UserID = $_SESSION['UserID'];
        print_r($data);
        $DeliveryPrice = $data['DeliveryPrice'];
        $TotalPrice = $data['TotalPrice'];
        $UserCart = mysqli_fetch_all(Connect::$connect->query("SELECT * FROM CartItems WHERE UserID = $UserID"), MYSQLI_ASSOC);
        Connect::$connect->query("INSERT INTO `Orders`(`UserID`, `OrderDate`, `Status`, `DeliveryPrice`, `TotalPrice`) VALUES ('$UserID', NOW(),'Completed','$DeliveryPrice', '$TotalPrice')");
        $UserOrders = mysqli_fetch_all(Connect::$connect->query("SELECT * FROM Orders WHERE UserID = $UserID"), MYSQLI_ASSOC);
        $LastUserOrderID = $UserOrders[count($UserOrders)-1]['OrderID'];
        foreach($UserCart as $item){
            $CartItemID = $item['CartItemID'];
            $VariantID = $item['VariantID'];
            $Quantity = $item['Quantity'];
            $ProductVariant = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM ProductVariants WHERE VariantID = $VariantID"));
            $ProductId = $ProductVariant['ProductID'];
            $Product = mysqli_fetch_assoc(Connect::$connect->query("SELECT * FROM Products WHERE ProductID = $ProductId"));
            $Product = array_merge($ProductVariant, $Product);
            $price = $Product['Price'] * $item['Quantity'];
            
            Connect::$connect->query("INSERT INTO `OrderDetails`(`OrderID`, `VariantID`, `Quantity`, `Price`) VALUES ('$LastUserOrderID','$VariantID','$Quantity','$price')");
            Connect::$connect->query("DELETE FROM CartItems WHERE CartItemID = $CartItemID");
        }
        
        header('Location: /cart');
    }

}