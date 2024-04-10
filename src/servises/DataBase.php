<?
namespace servises;

class Connect{


    public static $connect;
    

    public function __construct()
    {
        if(self::$connect == null){
            
            self::$connect = mysqli_connect (
                '127.0.0.1:3306', 
                'root',
                '', 
                'db'
            );


            self::$connect->query("CREATE TABLE IF NOT EXISTS `Users` (
                `Id` INT PRIMARY KEY AUTO_INCREMENT,
                `Login` VARCHAR(255) NOT NULL UNIQUE,
                `Password` TEXT NOT NULL
            )");
            
            
        }
        
    }

    
}