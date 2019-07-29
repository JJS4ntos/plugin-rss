<?php
namespace App\Console;

use App\Creator\Controller;
use App\Creator\Model;
use App\Creator\View;

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
                    echo "Gear controller '{$argv[1]}'";
                break;
                case 'view':
                    echo "Gear view '{$argv[1]}'";
                break;
                case 'model':
                    echo "Gear model '{$argv[1]}'";
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