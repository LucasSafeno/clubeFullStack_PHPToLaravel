<?php

use core\library\App;

$app = App::create()
  ->withEnviromentVariables()
  ->withErrorPage()
  ->withContainer();
