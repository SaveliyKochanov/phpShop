<?
namespace utils\myController;

class Router {
    public static $list=[];
    public static function myGet($url,$namePage){
        self::$list[]=[
            'url'=>$url,
            'method'=>$namePage
        ];
    }

    public static function myPost($url,$class,$method){
        self::$list[]=[
            'url'=>$url,
            'class'=>$class,
            'method'=>$method
        ];
    }

    public static function Start(){
        $rout=$_GET['rout'] ??'';
        foreach (self::$list as $item){

            if($item['url'] === '/'.$rout){
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                        $method=$item['method'];
                        $action=new $item['class'];
                        $action->$method($_POST);
                        die();
                }
                else{
                    require_once __DIR__. './../../../view/pages/'. $item['method'] . '/'. $item['method'] . '.php';
                    die();                
                }
            }
            
        }
        require_once __DIR__. './../../../view/pages/404/404.php';
        die();
    }
    
}

    