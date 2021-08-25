<?php

namespace Drupal\hello_world\Controller;
use Drupal\Core\Controller\ControllerBase;

/**
 * Controller fro the salutation message
*/

class HelloWorldController extends ControllerBase {
/**
 * Hello world drupal
 * @return array
 * Our message
*/

    public function helloWorld(){
        return [
            '#markup' => $this->t('Hello World Drupal 9'),
        ];
    }
}