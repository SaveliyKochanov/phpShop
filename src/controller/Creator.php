<?php

namespace controller;

class Creator {
    // ТУТ НИХУЯ НЕ ТРОГАЙ !!!!!!!
    // ТУТ НИХУЯ НЕ ТРОГАЙ !!!!!!!
    // ТУТ НИХУЯ НЕ ТРОГАЙ !!!!!!!
    // ТУТ НИХУЯ НЕ ТРОГАЙ !!!!!!!
    // ТУТ НИХУЯ НЕ ТРОГАЙ !!!!!!!
	public static function CreatePage($data){
        

        $htmlTemplate = <<<HTML
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="./view/partials/header.css">
            <link rel="stylesheet" href="./view/partials/footer.css">

            <link rel="stylesheet" href="./view/pages/NAMEPAGE/NAMEPAGE.css">
            <title>NAMEPAGE</title>
        </head>
        <body>
        <? include './view/partials/header.php'?>

        <div class="container">

        </div>

        <? include './view/partials/footer.php'?>
        </body>
        </html>
        HTML;


        $filename = $data['filename'];
        $dirPath = str_replace('NAMEPAGE', $filename, "./view/pages/NAMEPAGE/");
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0777, true); 
            $content = str_replace('NAMEPAGE', $filename, $htmlTemplate);
            $filepath = $filename.".php";
            $filepath2 = $filename.".css";
            file_put_contents($dirPath.$filepath, $content);  
            file_put_contents($dirPath.$filepath2, "");  
        }
        header("Location: /q");
    }
}