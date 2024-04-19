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
            $this->CreateBaseProducts();
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
            ImageURL VARCHAR(255),
            FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)
        )");
        self::$connect->query("CREATE TABLE IF NOT EXISTS ProductVariants (
            VariantID INT AUTO_INCREMENT PRIMARY KEY,
            ProductID INT,
            Size VARCHAR(255),
            Price DECIMAL(10, 2) NOT NULL,
            Stock INT NOT NULL,
            FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
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
            VariantID INT NOT NULL,
            Quantity INT NOT NULL DEFAULT 1,
            FOREIGN KEY (UserID) REFERENCES Users(UserID),
            FOREIGN KEY (VariantID) REFERENCES ProductVariants(VariantID)
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
        if(mysqli_num_rows(self::$connect->query("SELECT * FROM Products")) === 0){
            self::$connect->query("INSERT INTO Products (CategoryID, ProductBrand, ProductName, Description, ImageURL) VALUES
            (1, 'NIKE', 'Мужская футболка', 'Описание мужской футболки', './images/tshortM.webp'),
            (1, 'Adidas', 'Мужские джинсы', 'Описание мужских джинсов', './images/jeansM.webp'),
            (1, 'Tom Ford', 'Женская футболка', 'Описание женской футболки', './images/probka.webp'),
            (2, 'NIKE', 'Женское платье', 'Описание женского платья', './images/gown.webp'),
            (2, 'Adidas', 'Женский свитер', 'Описание женского свитера', './images/handcuffs.webp')");

        self::$connect->query("INSERT INTO Products (CategoryID, ProductBrand, ProductName, Description, ImageURL) VALUES
        (1, 'Nike', 'Кроссовки Air Max', 'Удобные кроссовки для бега', './images/check.png'),
        (1, 'Adidas', 'Спортивные штаны', 'Штаны для тренировок и повседневной носки', './images/exit.png'),
        (1, 'Calvin Klein', 'Джинсы Slim Fit', 'Джинсы современного кроя', './images/home.png'),
        (1, 'Balenciaga', 'Куртка Oversize', 'Модная куртка оверсайз для прохладной погоды', './images/main_slider-image.png')
        ");
            self::CreateBaseVariants();
        }
        
        

    }
    private function CreateBaseVariants(){
        
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (1, 'S', 499.99, 90)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (1, 'M', 499.99, 85)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (1, 'L', 499.99, 80)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (1, 'XL', 499.99, 75)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (2, 'L', 999.99, 45)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (2, 'XL', 999.99, 40)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (2, 'XXL', 999.99, 35)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (3, 'S', 777.77, 72)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (3, 'M', 777.77, 68)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (3, 'L', 777.77, 64)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (4, 'M', 1299.99, 65)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (4, 'L', 1299.99, 60)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (4, 'XL', 1299.99, 55)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (5, 'S', 799.99, 75)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (5, 'M', 799.99, 70)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (5, 'XL', 799.99, 65)");
        self::$connect->query("INSERT INTO ProductVariants (ProductID, Size, Price, Stock) VALUES (5, 'XXL', 799.99, 60)");


    }
    

    
}