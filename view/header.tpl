<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $title; ?></title>
        <base href="<?php echo $base; ?>" />
        
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" defer="defer"></script>
        <script src="js/jquery.form.min.js" defer="defer"></script>
        <script src="js/scripts.js" defer="defer"></script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form_submit">
                    <ul>
                        <li>
                            <label for="">Укажите файл:</label>
                            <input type="file" name="file" id="fileName" value="">
                        </li>
                        <li>
                            <input type="button" value="Отправить" name="" id="button_submit">
                            <img src="css/images/loading.gif" alt="loading" style="vertical-align:middle; display: none; width: 24px;" id="loader">
                        </li>
                    </ul>
                </form>
            </div>