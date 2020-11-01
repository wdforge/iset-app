<?php

namespace Iset\App\Factory;

use Iset\Di\Factory\AbstractFactory;
use Zend\Diactoros\Response;

class HandlerFactory extends AbstractFactory
{
  public function createInstance(\Iset\Utils\IParams $params, $class = null)
  {
    $response = new Response();
    $params->set('response', $response);

    return new $class($response);
  }
}