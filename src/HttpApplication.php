<?php

namespace Iset\App;

use Iset\Di\Middleware\Decorator;
use Iset\Di\Manager;
use Narrowspark\HttpEmitter\SapiEmitter;

/**
 * Class HttpApplication
 * @package Iset\App
 */
class HttpApplication extends Decorator
{
  /**
   * @param Manager $diManager
   */
  public function setDiManager(Manager $diManager)
  {
    $this->_diManager = $diManager;
  }

  /**
   * @return Manager
   */
  public function getDiManager(): Manager
  {
    return $this->_diManager;
  }

  /**
   * @futute
   */
  //код предстартовой обработки
  //+карта событий:
  // app-run-pre
  // app-run-post
  // route-pre
  // route-post
  // middleware-handle - pre
  // middleware-handle - post

  // past middlewares to handler
  // past request to request-handler
  public function init()
  {
    return $this;
  }

  /**
   * запуск приложения
   */
  public function run()
  {
    $response = $this->getDiManager()->get('response');
    $emitter = new SapiEmitter();
    return $emitter->emit($response);
  }

}