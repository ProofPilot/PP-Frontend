<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var $loader ClassLoader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

$loader->add('Cyclogram', realpath(__DIR__.'/../src/Cyclogram'));
$loader->add('Stfalcon', realpath(__DIR__.'/../vendor/bundles'));

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
