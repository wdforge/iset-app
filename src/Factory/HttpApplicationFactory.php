<?php

namespace Iset\App\Factory;

use Iset\Di\Exception\ClassNotFound;
use Iset\Di\Exception\ParameterIsEmpty;
use Iset\Di\Factory\AbstractFactory;
use Iset\Di\Manager as Creator;
use Iset\Event\Manager as EventManager;
use Iset\Utils\IParams;
use Zend\Stratigility\MiddlewarePipe;
use Zend\Diactoros\ServerRequestFactory;
use FastRoute\RouteCollector;
use Middlewares\FastRoute;
use Middlewares\RequestHandler;
use Relay\Relay;

/**
 * Class HttpApplicationFactory
 * @package Iset\App
 */
class HttpApplicationFactory extends AbstractFactory
{
  public function createInstance(IParams $params, $class = null)
  {
    /**
     * @var \Iset\Di\Manager
     */
    $diManager = $params->get('application/di/manager');
    $appClass = $params->get('application/class');

    if (!$diManager) {
      $diManager = $this->create(Creator::class, $params ? $params->toArray() : []);
    }

    $diManager
      ->createInstance(EventManager::class, $params, 'application/event/manager')
      ->init($params);

    if (empty($appClass)) {
      throw new ParameterIsEmpty;
    }

    if (!class_exists($appClass)) {
      throw new ClassNotFound;
    }

    /**
     * @var $appInstance \Iset\App\HttpApplication
     */
    $appInstance = $this->create($appClass);

    $routeSettings = $params->get('routes');

    $routes = \FastRoute\simpleDispatcher($routeSettings);

    $middlewareQueue[] = new FastRoute($routes);
    $middlewareQueue[] = new RequestHandler($diManager);
    $requestHandler = new Relay($middlewareQueue);

    $request = ServerRequestFactory::fromGlobals();
    $response = $requestHandler->handle($request);
    $diManager->set('response', $response);

    $appInstance->setDiManager($diManager);
    return $appInstance;
  }

}