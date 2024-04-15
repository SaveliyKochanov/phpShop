<?
use utils\myController\Router;
use controller\Creator;
use controller\Auth;
use servises\Connect;

new Connect();


Router::myGet('/q','PageCreator');
Router::myPost('/qq',Creator::class,'CreatePage');

//get
Router::myGet('/','home');
Router::myGet('/forms','forms');


//post
Router::myPost('/registration', Auth::class, 'registration');
Router::myPost('/login', Auth::class, 'login');
Router::myPost('/logout', Auth::class, 'logout');



Router::Start();