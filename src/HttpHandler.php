<?php


namespace Iset\App;

use Iset\App\HttpHandler;
use Psr\Http\Message\ResponseInterface;

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
   *
   * @throws \RuntimeException
   * @throws \InvalidArgumentException
   */
  public function __invoke(): ResponseInterface
  {
    return $this->response;
  }

  public function process($request, $response)
  {
    return $response;
  }
}