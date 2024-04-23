<?
use utils\myController\Router;
use controller\Auth;
use controller\Cart;
use controller\Creator;
use controller\Products;
use servises\Connect;

new Connect();


Router::myGet('/q','PageCreator');
Router::myPost('/qq',Creator::class,'CreatePage');

//get
Router::myGet('/','home');
Router::myGet('/forms','forms');
Router::myGet('/admin','admin');
Router::myGet('/auth', 'auth');
Router::myGet('/reg', 'reg');
Router::myGet('/catalog', 'catalog');
Router::myGet('/cart', 'cart');
Router::myGet('/product', 'product');
Router::myGet('/profile', 'profile');


//post
Router::myPost('/registration', Auth::class, 'registration');
Router::myPost('/login', Auth::class, 'login');
Router::myPost('/logout', Auth::class, 'logout');
Router::myPost('/deleteProduct', Products::class, 'DeleteProduct');
Router::myPost('/addProduct', Products::class, 'AddProduct');
Router::myPost('/cartUpdateQuantity', Cart::class, 'UpdateQuantity');
Router::myPost('/cartDeletePosition', Cart::class, 'DeletePosition');
Router::myPost('/cartCreateOrder', Cart::class, 'CreateOrder');
Router::myPost('/addToCart', Cart::class, 'addToCart');



Router::Start();