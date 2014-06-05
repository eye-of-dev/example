<?php defined('EXAMPLE') or die('Access denied');

/**
 * Description of controller
 */
class Controller
{

    protected $template;
    protected $children = array();
    protected $data = array();
    protected $output;

    public function __construct()
    {
        
    }

    protected function render()
    {

        if (file_exists(DIR_VIEW . $this->template))
        {
            extract($this->data);

            ob_start();

            require(DIR_VIEW . $this->template);

            $this->output = ob_get_contents();

            ob_end_clean();

            return $this->output;
        }
        else
        {
            trigger_error('Error: Could not load template ' . DIR_VIEW . $this->template . '!');
            exit();
        }
    }

}
