<?
use utils\myController\Router;
use controller\Creator;

Router::myGet('/q','PageCreator');
Router::myPost('/qq',Creator::class,'CreatePage');


Router::myGet('/','home');

Router::Start();