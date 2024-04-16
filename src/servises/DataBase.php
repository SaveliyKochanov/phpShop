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
            $this->CheckCategories();
            //$this->CreateBaseProducts();
        }
        
    }
    private function CreateTables(){
        self::$connect->query("CREATE TABLE IF NOT EXISTS Users (
            UserID INT AUTO_INCREMENT PRIMARY KEY,
            Email VARCHAR(255) NOT NULL UNIQUE,
            Password VARCHAR(255) NOT NULL,
            Role INT NOT NULL
        )");
        self::$connect->query("CREATE TABLE IF NOT EXISTS Categories (
            CategoryID INT AUTO_INCREMENT PRIMARY KEY,
            CategoryName VARCHAR(255) NOT NULL,
            Description TEXT
        )");        
        self::$connect->query("CREATE TABLE IF NOT EXISTS Products (
            ProductID INT AUTO_INCREMENT PRIMARY KEY,
            CategoryID INT,
            ProductBrand VARCHAR(255) NOT NULL,
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

    private function CheckCategories() {
        $categories = self::$connect->query("SELECT * FROM Categories");
        $MenCategory = false;
        $WomenCategory = false;
    
        while ($category = mysqli_fetch_assoc($categories)) {
            if (!($category['CategoryName'] === 'Мужчины')) {
                $MenCategory = true;
            }
            if (!($category['CategoryName'] === 'Женщины')) {
                $WomenCategory = true;
            }
        }

        if (!$MenCategory) {
            self::$connect->query("INSERT INTO Categories (CategoryName, Description)
                    VALUES ('Мужская одежда', 'Категория мужской одежды включает в себя футболки, джинсы, куртки и многое другое.')");
        } 
        if (!$WomenCategory) {
            self::$connect->query("INSERT INTO Categories (CategoryName, Description)
            VALUES ('Женская одежда', 'Категория женской одежды включает платья, юбки, блузки и многое другое.')");
        } 
       
    }
    private function CreateBaseProducts(){
        self::$connect->query("INSERT INTO `Products` (`ProductID`, `CategoryID`, `ProductBrand`, `ProductName`, `Description`, `Price`, `Stock`, `ImageURL`) VALUES 
        (NULL, '1', 'NIKE', 'Мужская футболка', 'Описание мужской футболки', 499.99, 100, './images/tshortM.webp'),
        (NULL, '1', 'NIKE', 'Мужские джинсы', 'Описание мужских джинсов', 999.99, 50, './images/jeansM.webp'),
        (NULL, '2', 'NIKE', 'Женская футболка', 'Описание женской футболки', 777.77, 77, './images/probka.webp'),
        (NULL, '2', 'NIKE', 'Женское платье', 'Описание женского платья', 1299.99, 70, './images/gown.webp'),
        (NULL, '2', 'NIKE', 'Женский свитер', 'Описание женского свитера', 799.99, 80, './images/handcuffs.webp');");


    }
    

    
}