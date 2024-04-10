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
Router::myGet('/pizda','pizda');


//post
Router::myPost('/auth', Auth::class, 'registration');



Router::Start();