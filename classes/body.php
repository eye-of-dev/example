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

        // width - config image width
        // height - config image height
        $this->data['width'] = width;
        $this->data['height'] = height;
        
        $image = $this->registry->get('image');
        $this->data['images'] = $image->get_images();
        
        $this->template = 'body.tpl';
        print $this->render();
    }
    
    /**
     * 
     * @return json
     */
    public function get_images()
    {
        
        $image = $this->registry->get('image');
        
        return json_encode($image->get_images());
    }

}
