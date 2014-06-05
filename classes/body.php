<?php defined('EXAMPLE') or die('Access denied');

/**
 * Description of body
 */
class Body extends Controller
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
        $this->template = 'body.tpl';
        print $this->render();
    }
}
