<?
namespace controller;

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

}