<?php
namespace App\Console;

use App\Creator\ControllerCreator;
use App\Creator\ModelCreator;
use App\Creator\ViewCreator;

class Engine {
  
    private $root;

    public function __construct() {
        //global $argv;
        $this->create();
    }

    public function create() {
        global $argv;

        if( isset($argv[1]) ) {
            switch($argv[1]) {
                case 'controller': 
                    $ccreator = new ControllerCreator();
                    $ccreator->create();
                break;
                case 'view':
                    echo "Gear view '{$argv[1]}'";
                break;
                case 'model':
                    $mcreator = new ModelCreator();
                    $mcreator->create();
                break;
                case 'shortcode':
                    echo "Gear model '{$argv[1]}'";
                break;
                default:
                    echo "Gear unknown command '{$argv[1]}'";
                break;
            }
        }
    }

    

}