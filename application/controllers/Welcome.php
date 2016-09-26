<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
    }

    public function json()
    {
        $this->load->library('morris_line');

        //load the pdo db config
        $pdo = $this->load->database('', true);

        $pdo_statement = $pdo->query('test',0,10);
        var_dump($pdo_statement);
        $morris = new Morris_Line($pdo_statement);

        echo $morris;
    }
}
