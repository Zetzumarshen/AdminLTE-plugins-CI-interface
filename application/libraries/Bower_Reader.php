<?php

/**
 * Created by PhpStorm.
 * User: dot_asp
 * Date: 9/26/2016
 * Time: 9:37 PM
 */
class Bower_Reader
{
    var $test =<<< EOT
{
  "name": "AdminLTE",
  "homepage": "http://almsaeedstudio.com",
  "authors": [
    "Abdullah Almsaeed <abdullah@almsaeedstudio.com>"
  ],
  "description": "Admin dashboard and control panel template",
  "main": [
    "index2.html",
    "dist/css/AdminLTE.css",
    "dist/js/app.js",
    "build/less/AdminLTE.less"
  ],
  "keywords": [
    "css",
    "js",
    "html",
    "template",
    "admin",
    "bootstrap",
    "theme",
    "backend",
    "responsive"
  ],
  "license": "MIT",
  "ignore": [
    "/.*",
    "node_modules",
    "bower_components",
    "composer.json",
    "documentation"
  ]
}
EOT;

    var $test2 =<<< EOT
{
  "name": "AdminLTE-plugins-CI-interface",
  "homepage": "https://github.com/Zetzumarshen/AdminLTE-plugins-CI-interface",
  "authors": [
    "dot_asp <Zetzumarshen@gmail.com>"
  ],
  "description": "",
  "main": "",
  "license": "MIT",
  "ignore": [
    "**/.*",
    "node_modules",
    "bower_components",
    "test",
    "tests"
  ],
  "dependencies": {
    "AdminLTE": "adminlte#^2.3.6",
    "morris.js": "morrisjs#^0.5.1"
  }
}

EOT;

    public function __construct(){

    }

    public function get(){
//        return json_decode($this->test2);
        $this->set_bower_root();
        $this->set_bower_dependencies();
        $this->get_bower_packages_path();
    }

    public function set_bower_root(){
        $this->path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'bower_components';
    }

    public function set_bower_dependencies(){
        $bower = json_decode($this->test2,TRUE);
        $this->dependencies = array_keys($bower['dependencies']);
    }

    public function set_bower_dependencies_path(){
//        $this->dependencies_path =
    }

    public function get_bower_packages_path(){
        $iterator = new DirectoryIterator($this->path);
        foreach($iterator as $fileinfo){
            if($fileinfo->isDir() === TRUE && in_array($fileinfo,$this->dependencies)){
                $json = file_get_contents($fileinfo->getPath().DIRECTORY_SEPARATOR.$fileinfo.DIRECTORY_SEPARATOR.'bower.json');
                print_r($json);
            }
        }
    }

    public function override($package_name, $path){

    }

}