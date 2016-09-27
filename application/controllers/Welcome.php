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
        phpinfo();
    }

    public function json()
    {
        $this->load->library('morris_line');

        //load the pdo db config
        $db = $this->load->database('', true);
        $sql = <<<EOT
SELECT `timestamp`, SUM(value1), SUM(value2)
FROM `test`
GROUP BY (`timestamp`)
EOT;

        $ci_result = $db->query($sql);

        $morris = new Morris_Line($ci_result);

        echo "<pre>";
        echo $morris->get_data();
        echo "</pre>";
    }

    public function bower (){
        $this->load->library('bower_reader');
        $bwr = new Bower_Reader();
        echo "<pre>";
        echo var_dump($bwr->get());
        echo "</pre>";
    }

    public function dir(){
        $dir = new FilesystemIterator($_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR.'bower_components');
        echo "<pre>";
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir()) {
                echo $fileinfo->getFilename() . "\n";
            }
        }
        echo "</pre>";
    }
}
