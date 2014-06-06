<?php defined('EXAMPLE') or die('Access denied');

/**
 * Description of image
 */
class Image
{
    private $file;
    private $image;
    private $info;

    /**
     * Изменения размера изображений с сохранением отношения длины к ширене
     * @param string $file Полный путь до исходного файла
     * @param int $width Ширина изображения
     * @param int $height Высота изображения
     * @param string $image_name Название ихображения
     * @param string $images_dir Папка, хранения результирующих изображений
     * @param string $default
     * @return string
     */
    public function resize($file = NULL, $width = 0, $height = 0, $image_name = '', $images_dir = '', $default = '')
    {
        
        if ($this->validate($file) && ($this->info['width'] || $this->info['height']))
        {
            
            if ( ! file_exists(DIR_IMAGES . $images_dir))
            {
                mkdir(DIR_IMAGES . $images_dir, 0777);
            }
            
            $xpos = 0;
            $ypos = 0;
            $scale = 1;
            
            $scale_w = $width / $this->info['width'];
            $scale_h = $height / $this->info['height'];
            
            if ($default == 'w')
            {
                $scale = $scale_w;
            }
            elseif ($default == 'h')
            {
                $scale = $scale_h;
            }
            else
            {
                $scale = min($scale_w, $scale_h);
            }
            
            if ($scale == 1 && $scale_h == $scale_w && $this->info['mime'] != 'image/png')
            {
                return;
            }
            
            $new_width = ( int ) ($this->info['width'] * $scale);
            $new_height = ( int ) ($this->info['height'] * $scale);
            $xpos = ( int ) (($width - $new_width) / 2);
            $ypos = ( int ) (($height - $new_height) / 2);
            
            $image_old = $this->image;
            $this->image = imagecreatetruecolor($width, $height);
            
            if (isset($this->info['mime']) && $this->info['mime'] == 'image/png')
            {
                imagealphablending($this->image, false);
                imagesavealpha($this->image, true);
                $background = imagecolorallocatealpha($this->image, 255, 255, 255, 127);
                imagecolortransparent($this->image, $background);
            }
            else
            {
                $background = imagecolorallocate($this->image, 255, 255, 255);
            }

            // Если true то идображение будет пропорционально уменьшино, пустые места заполнятся 
            // белым фоном.
            if (IMG_BACKGROUND)
            {
                imagefilledrectangle($this->image, 0, 0, $width, $height, $background);

                imagecopyresampled($this->image, $image_old, $xpos, $ypos, 0, 0, $new_width, $new_height, $this->info['width'], $this->info['height']);
            }
            else
            {
                imagecopyresampled($this->image, $image_old,  0, 0, 0, 0, $width, $height, $this->info['width'], $this->info['height']);
            }
            
            imagejpeg($this->image, DIR_IMAGES . $images_dir . $width . '_' . $height . '_' . $image_name);
            imagedestroy($image_old);

            $this->info['width'] = $width;
            $this->info['height'] = $height;
            
            return '/images/' . $images_dir . $width . '_' . $height . '_' . $image_name;
        }

    }
    
    /**
     * Функция наложкения водяного знака.
     * @param type $img_file
     * @param type $width
     * @param type $height
     * @param type $images_dir
     */
    public function watermark($img_file, $width = 0, $height = 0, $images_dir)
    {
        
        // Получаем название картинки
        $data = explode('/', $img_file);
        $image_name = rawurldecode(end($data));
        
        if ( ! file_exists(DIR_IMAGES . $images_dir . 'w_' . $image_name))
        {
            return '/images/' . $images_dir . 'w_' . $image_name;
        }
        else
        {
         
            $image = getimagesize(DIR_ROOT . $img_file);
            $xImg = $image[0];
            $yImg = $image[1];

            switch($image[2])
            {
                case 1:
                    $img = imagecreatefromgif(DIR_ROOT . $img_file);
                    break;
                case 2:
                    $img = imagecreatefromjpeg(DIR_ROOT . $img_file);
                    break;
                case 3:
                    $img = imagecreatefrompng(DIR_ROOT . $img_file);
                    break;
            }

            $r = imagecreatefrompng(DIR_ROOT . '/watermark.png');
            $x = imagesx($r);
            $y = imagesy($r);

            $xDest = $xImg - ($x);
            $yDest = $yImg - ($y);
            imagealphablending($img, 1);
            imagealphablending($r, 1);
            imagesavealpha($img, 1);
            imagesavealpha($r, 1);
            imagecopyresampled($img, $r, $xDest, $yDest, 0, 0, $x, $y, $x, $y);

            switch($image[2])
            {
                case 1:
                    imagegif($img, DIR_IMAGES . $images_dir . 'w_' . $image_name);
                    break;
                case 2:
                    imagejpeg($img, DIR_IMAGES . $images_dir . 'w_' . $image_name, 100);
                    break;
                case 3:
                    imagepng($img, DIR_IMAGES . $images_dir . 'w_' . $image_name);
                    break;
            }
            imagedestroy($r);
            imagedestroy($img);

            return '/images/' . $images_dir . 'w_' . $image_name;
        
        }
    }
    
    /**
     * 
     * @param string $folder
     * @param int $width
     * @param int $height
     * @param string $image_name
     * @return string
     */
    public function get_image($folder = NULL, $width = 0, $height = 0, $image_name = '')
    {
        if (file_exists(DIR_IMAGES . $folder . $width . '_' . $height . '_' . $image_name))
        {
            return '/images/' . $folder . $width . '_' . $height . '_' . $image_name;
        }
        else
        {
            return $this->resize(DIR_IMAGES . $image_name, $width, $height, $image_name);
        }
    }

        /**
     * Проверка на существование файла
     * @param string $file
     * @return boolean
     */
    private function validate($file)
    {
        if (file_exists($file))
        {
            $this->file = $file;

            $info = getimagesize($file);

            $this->info = array(
                'width' => $info[0],
                'height' => $info[1],
                'bits' => $info['bits'],
                'mime' => $info['mime']
            );
            
            $this->image = $this->create($file);
            
            return TRUE;
        }
        
        return FALSE;

    }
    
    /**
     * 
     * @param string $image
     * @return resource
     */
    private function create($image) {
            $mime = $this->info['mime'];

            if ($mime == 'image/gif') {
                    return imagecreatefromgif($image);
            } elseif ($mime == 'image/png') {
                    return imagecreatefrompng($image);
            } elseif ($mime == 'image/jpeg') {
                    return imagecreatefromjpeg($image);
            }
    }
}
