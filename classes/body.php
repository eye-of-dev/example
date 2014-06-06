<?php defined('EXAMPLE') or die('Access denied');

/**
 * Description of body
 */
class Body extends Controller
{
    private $registry;
    
    public function __construct($registry)
    {
        parent::__construct();
        
        $this->registry = $registry;
    }
    
    /**
     * Точка входа
     * @return void
     */
    public function index()
    {
        
        $image = $this->registry->get('image');
        
        $this->data['width'] = IMG_W;
        $this->data['height'] = IMG_H;
        $this->data['images'] = array();
        
        $images = array();
        
        $files = scandir(DIR_IMAGES);
        
        // Источник изображений
        $images_dir = (IMG_BACKGROUND) ? IMG_W . '-' . IMG_H . '_b/' : IMG_W . '-' . IMG_H . '/';
        
        foreach ($files as $key => $file)
        {
            if ($file == '.' || $file == '..' || is_dir(DIR_IMAGES . $file))
                continue;
            
            if ( ! file_exists(DIR_IMAGES . $images_dir . IMG_W . '_' . IMG_H . '_' . $file))
            {
                $images[] = $image->resize(DIR_IMAGES . $file, IMG_W, IMG_H, $file, $images_dir);
            }
            else
            {
                $images[] = $image->get_image($images_dir, IMG_W, IMG_H, $file);
            }
        }
        
        if (IMG_WATERMARK)
        {
            foreach ($images as $item)
            {
                $this->data['images'][] = $image->watermark($item, IMG_W, IMG_H, $images_dir);
            }
        }
        else
        {
            $this->data['images'] = $images;
        }
        
        $this->template = 'body.tpl';
        print $this->render();
    }
}
