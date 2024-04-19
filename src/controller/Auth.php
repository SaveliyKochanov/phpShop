<?

namespace controller;

use servises\Connect;

class Auth{

    public function registration($data){
        $Email = $data['email'];
        $password = $data['password'];
        try{
            if($Email != "" && $password != ""){
                Connect::$connect->query("INSERT INTO `Users` (`Email`, `Password`, `Role`) VALUES ('$Email', '$password', '10')");
            }
        }
        finally{
            $newData = [
                'email' => $Email,
                'password' => $password,
            ];
            $this->login($newData);
        }
    }
    public function login($data){
        $Email = $data['email'];
        $password = $data['password'];
        $result = Connect::$connect->query("SELECT * FROM `Users` WHERE `Email` = '$Email'");
        if(mysqli_num_rows($result) == 1){
            $result = mysqli_fetch_assoc($result);
            if($password == $result['Password']){
                session_start();
                $_SESSION['UserID'] = $result['UserID'];
                $_SESSION['role'] = $result['Role'];
            }
        }
        header("Location: /");
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
