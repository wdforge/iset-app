<?php


namespace Iset\App;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\ServerRequest;

class HttpHandler
{

  /**
   * @var ResponseInterface
   */
  protected $response;

  /**
   *
   * @param ResponseInterface $response
   */
  public function __construct(ResponseInterface $response) {
    $this->response = $response;
  }

  /**
   *
   * @param ServerRequest
   * @throws \RuntimeException
   * @throws \InvalidArgumentException
   */
  public function __invoke(ServerRequest $request): ResponseInterface
  {
    return $this->response;
  }

  public function process($request, $response)
  {
    return $response;
  }
}