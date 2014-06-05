<?php defined('EXAMPLE') or die('Access denied');

/**
 * Description of Header
 */
class Header extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
    }
    
    /**
     * Точка входа
     * @return void
     */
    public function index()
    {
        
        $this->data['title'] = 'Тестовая программка';
        
        $this->data['base'] = $_SERVER['SERVER_NAME'];
        
        $this->data['action'] = '/engine/upload.php';
        
        $this->template = 'header.tpl';
        print $this->render();
    }
}
