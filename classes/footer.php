<?php defined('EXAMPLE') or die('Access denied');

/**
 * Description of footer
 */
class Footer extends Controller
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
        $this->template = 'footer.tpl';
        print $this->render();
    }
}
