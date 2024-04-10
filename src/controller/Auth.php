<?

namespace controller;
use servises\Connect;

class Auth{

    public function registration($data){
       
        $login = $data['login'];
        $password = $data['password'];
        $return_url = $data['return_url'];
        if($login != "" && $password != ""){
            Connect::$connect->query("INSERT INTO `Users` (`Login`, `Password`) VALUES ('$login', '$password')");
        }


        header("Location: $return_url");
       

    }
    public function login($data){

    }
}
