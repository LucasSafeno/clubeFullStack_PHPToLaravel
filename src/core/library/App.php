<?php

namespace core\library;

use DI\Container;
use Dotenv\Dotenv;
use DI\ContainerBuilder;
use Spatie\Ignition\Ignition;

class App
{
  public readonly Container $container;
  public static function create()
  {
    return new self;
  } //? create

  public  function withErrorPage()
  {

    Ignition::make()
      ->setTheme("dark")
      ->shouldDisplayException(env('ENV') == 'development')
      ->register();
    return $this;
  } //? withErrorPage

  public  function withContainer()
  {

    $builder = new ContainerBuilder();
    $this->container = $builder->build();
    return $this;
  } //? withContainer

  public function withEnviromentVariables()
  {
    $dotenv = Dotenv::createImmutable(dirname(__FILE__, 3));
    $dotenv->load();
    return $this;
  } //? withEnviromentVariables
}
