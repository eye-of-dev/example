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

$file = $data['name'];

if (is_uploaded_file($data['tmp_name']))
{
    move_uploaded_file($data['tmp_name'], dirname(__DIR__) . '/tmp/' . $file);
}

// Какие файлы можно обрабатывать.
$valid_types = array('gif', 'jpg', 'png', 'jpeg');
$valid_mime = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png', 'image/svg+xml', 'image/tiff', 'image/vnd.microsoft.icon', 'image/vnd.wap.wbmp');

if (file_exists(dirname(__DIR__) . '/tmp/' . $file))
{
    $handle = @fopen(dirname(__DIR__) . '/tmp/' . $file, "r");
       
    if ($handle) {
        while (($link = fgets($handle, 4096)) !== false) {
            
            $link = trim($link);

            $ext = substr(strrchr($link, '.'), 1);
                        
            $data = explode('/', $link);
            $file_name = rawurldecode(end($data));
            
            // Проверка на расширение файла
            // Проверка на mime
            // Проверка на существование файла
            if (in_array($ext, $valid_types) && ! file_exists(dirname(__DIR__) . '/images/' . $file_name)) 
            {
                $image = @file_get_contents($link);

                if ($image)
                {
                    file_put_contents(dirname(__DIR__) . '/images/' . $file_name, $image);
                }
            }
            
        }
        if (!feof($handle)) {
            echo "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
    }
}
exit;