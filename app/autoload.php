<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var $loader ClassLoader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

$loader->add('Cyclogram', realpath(__DIR__.'/../src/Cyclogram'));
$loader->add('Common', realpath(__DIR__.'/../src/Common'));
$loader->add('Stfalcon', realpath(__DIR__.'/../vendor/bundles'));

foreach(glob(realpath(__DIR__.'/../src/Common').DIRECTORY_SEPARATOR."*.php") as $filename) {
    include_once $filename;
}

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
