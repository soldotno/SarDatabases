<?php
/**
 * @license   Creative Commons (CC BY)
 * @copyright Copyright (c) 2014 Sven Anders Robbestad
 */

namespace SarDatabases;

class Module
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

}
