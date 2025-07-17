<?php

namespace core\library;

class Router
{
  protected $routes = [];
  protected ?string $controller = null;
  protected string $action;

  public function add(
    string $method,
    string $uri,
    array $route
  ) {
    $this->routes[$method][$uri] = $route;
  } //? add

  public function execute()
  {
    foreach ($this->routes as $request => $routes) {
      if ($request === REQUEST_METHOD) {
        return $this->handleUri($routes);
      }
    }
  } //? execute

  private function handleUri(array $routes)
  {
    foreach ($routes as $uri => $route) {
      if ($uri === REQUEST_URI) {
        [$this->controller, $this->action] = $route;
        break;
      }

      $pattern = str_replace('/', '\/', trim($uri, '/'));
      if ($uri !== '/' && preg_match("/^$pattern$/", trim(REQUEST_URI, '/'), $matches)) {
        [$this->controller, $this->action] = $route;
        unset($matches[0]);
        break;
      }
    }

    if ($this->controller) {

      return $this->handleController();
    }

    return $this->handleNotFound();
  } //? handleUri

  private function handleController()
  {
    dump('Found Controller');
  } //? handleController

  private function handleNotFound()
  {
    dump(vars: ' not found controller ');
  } //? handleNotFound
}
