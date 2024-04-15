<?

namespace controller;

use servises\Connect;

class Auth{

    public function registration($data){
       
        $Email = $data['email'];
        $password1 = $data['password1'];
        $password2 = $data['password2'];
        if($password1 == $password2){
            $password = $password1;
            if($Email != "" && $password != ""){
                Connect::$connect->query("INSERT INTO `Users` (`Email`, `Password`) VALUES ('$Email', '$password')");
            }
    
            $newData = [
                'email' => $Email,
                'password' => $password,
                'return_url' => $data['return_url']
            ];
    
            $this->login($newData);
        }
        $return_url = $data['return_url'];
        header("Location: $return_url");
    }
    public function login($data){
        $Email = $data['email'];
        $password = $data['password'];
        $result = Connect::$connect->query("SELECT * FROM `Users` WHERE `Email` = '$Email'");
        if(mysqli_num_rows($result) == 1){
            $result = mysqli_fetch_assoc($result);
            if($password == $result['Password']){
                session_start();
                $_SESSION['email'] = $Email;
            }
        }
        $return_url = $data['return_url'];
        header("Location: $return_url");
    }
    public function logout($data){
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
        $return_url = $data['return_url'];
        header("Location: $return_url");
    }
}
