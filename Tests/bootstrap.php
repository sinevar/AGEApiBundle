<?php

/*
 * This file is part of the AGEApiBundle package.
 *
 * (c) Adam Gegotek <adam.gegotek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$vendorDir = __DIR__.'/../vendor';
require_once $vendorDir.'/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony' => array($vendorDir.'/symfony/src', $vendorDir.'/bundles'),
));

$loader->register();

spl_autoload_register(function($class) {

    if (0 === strpos($class, 'AGE\\ApiBundle\\')) {

        $file = __DIR__ . '/../' . implode('/', array_slice(explode('\\', $class), 2)) . '.php';
        if (file_exists($file) === false) {
            return false;
        }

        require_once $file;
        return true;
    }

});
