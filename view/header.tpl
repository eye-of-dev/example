<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $title; ?></title>
        <base href="<?php echo $base; ?>" />
        
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                    <ul>
                        <li>
                            <label for="">Укажите файл:</label>
                            <input type="file" name="file">
                        </li>
                        <li>
                            <input type="submit" value="Отправить" name="">
                        </li>
                    </ul>
                </form>
            </div>