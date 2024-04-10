<?
namespace servises;

class Connect{

    public static function connect(){
        $db = mysqli_connect (
            '127.0.0.1:3306', 
            'root',
            '', 
            'db'
        );
        return $db;
    }
}