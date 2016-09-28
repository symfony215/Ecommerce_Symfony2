<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

$loader->add('FOS',__DIR__.'/../vendor/bundles');
$loader->add('WhiteOctober', __DIR__.'/../vendor/bundles');
$loader->register();

return $loader;
