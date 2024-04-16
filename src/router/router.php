<?
use utils\myController\Router;
use controller\Auth;
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


//post
Router::myPost('/registration', Auth::class, 'registration');
Router::myPost('/login', Auth::class, 'login');
Router::myPost('/logout', Auth::class, 'logout');
Router::myPost('/deleteProduct', Products::class, 'DeleteProduct');
Router::myPost('/addProduct', Products::class, 'AddProduct');



Router::Start();