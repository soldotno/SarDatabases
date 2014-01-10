<?php
/**
 * SarDatabases Configuration
 *
 * If you have a ./config/autoload/ directory set up for your project, you can
 * drop this config file in it and change the values as you wish.
 */
return array(
    'sardatabases' => array(

        /**
         * Environment
         */

        'environment' => 'development',

        /**
         * Hosts
         */
        'host' => array(
            'production' => 'mongodb://localhost',
            'development' => 'mongodb://localhost',
        )

    ),
    /**
     * End of SarDatabases configuration
     */
);
