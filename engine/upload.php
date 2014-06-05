<?php 

// Какие файлы можно обрабатывать.
$allowed_expansion = array('txt');

$data = $_FILES['file'];

$ext = substr(strrchr($data['name'], '.'), 1);

// Проверка на расширение файла
if ( ! in_array($ext, $allowed_expansion)) 
{
    exit('Incorrect file type');
}

// Проверка на размер файла. Макс 2mb
if ($data['size'] > 2 * 1024 * 1024)
{
    exit('File size is large');
}

if (is_uploaded_file($data['tmp_name']))
{
    move_uploaded_file($data['tmp_name'], dirname(__DIR__) . '/tmp/' . $data['name']);
}