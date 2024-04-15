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

            $this->CreateTables();

            
        }
        
    }

    private function CreateTables(){
        self::$connect->query("CREATE TABLE IF NOT EXISTS Users (
            UserID INT AUTO_INCREMENT PRIMARY KEY,
            Email VARCHAR(255) NOT NULL UNIQUE,
            Password VARCHAR(255) NOT NULL
        )");
        self::$connect->query("CREATE TABLE IF NOT EXISTS Categories (
            CategoryID INT AUTO_INCREMENT PRIMARY KEY,
            CategoryName VARCHAR(255) NOT NULL,
            Description TEXT
        )");
        self::$connect->query("CREATE TABLE IF NOT EXISTS Products (
            ProductID INT AUTO_INCREMENT PRIMARY KEY,
            CategoryID INT,
            ProductName VARCHAR(255) NOT NULL,
            Description TEXT,
            Price DECIMAL(10, 2) NOT NULL,
            Stock INT NOT NULL,
            ImageURL VARCHAR(255),
            FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)
        )");
        self::$connect->query("CREATE TABLE IF NOT EXISTS Orders (
            OrderID INT AUTO_INCREMENT PRIMARY KEY,
            UserID INT,
            OrderDate DATETIME NOT NULL,
            Status VARCHAR(50) NOT NULL,
            TotalPrice DECIMAL(10, 2) NOT NULL,
            FOREIGN KEY (UserID) REFERENCES Users(UserID)
        )");
        self::$connect->query("CREATE TABLE IF NOT EXISTS OrderDetails (
            OrderDetailID INT AUTO_INCREMENT PRIMARY KEY,
            OrderID INT,
            ProductID INT,
            Quantity INT NOT NULL,
            Price DECIMAL(10, 2) NOT NULL,
            FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
            FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
        )");
        self::$connect->query("CREATE TABLE IF NOT EXISTS CartItems (
            CartItemID INT AUTO_INCREMENT PRIMARY KEY,
            UserID INT NOT NULL,
            ProductID INT NOT NULL,
            Quantity INT NOT NULL DEFAULT 1,
            FOREIGN KEY (UserID) REFERENCES Users(UserID),
            FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
        )");
    }

    
}