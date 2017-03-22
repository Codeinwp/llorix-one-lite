
module.exports = function( grunt ) {
    'use strict';

    var loader = require( 'load-project-config' ),
        config = require( 'grunt-theme-fleet' );
    config = config();
    config.files.php.push( '!ti-customizer-notify/**/*.php');
    config.files.js.push( '!ti-customizer-notify/**/*.js');
    config.files.php.push( '!class-tgm-plugin-activation.php');

    loader( grunt, config ).init();
};