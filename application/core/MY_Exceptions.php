<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dimas
 * Date: 2016-09-26
 * Time: 1:20 PM
 */

class MY_Exceptions extends CI_Exceptions   {

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * General Error Page
     *
     * Takes an error message as input (either as a string or an array)
     * and displays it using the specified template.
     *
     * @param	string		$heading	Page heading
     * @param	string|string[]	$message	Error message
     * @param	string		$template	Template name
     * @param 	int		$status_code	(default: 500)
     *
     * @return	string	Error page output
     */
    public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
    {
        $templates_path = config_item('error_views_path');
        if (empty($templates_path))
        {
            $templates_path = VIEWPATH.'errors'.DIRECTORY_SEPARATOR;
        }

        if (is_cli())
        {
            $message = "\t".(is_array($message) ? implode("\n\t", $message) : $message);
            $template = 'cli'.DIRECTORY_SEPARATOR.$template;
        }
        else
        {
            set_status_header($status_code);
            $message = '<p>'.(is_array($message) ? implode('</p><p>', $message) : $message).'</p>';
            $template = 'html'.DIRECTORY_SEPARATOR.$template;
        }

        if (ob_get_level() > $this->ob_level + 1)
        {
            ob_end_flush();
        }


        ob_start();
        if (extension_loaded('xdebug')){
            xdebug_print_function_stack("Show error triggered");
        }
        include($templates_path.$template.'.php');
        $buffer = ob_get_contents();
        ob_end_clean();
        return $buffer;
    }
}