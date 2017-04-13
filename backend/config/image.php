<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'imagick',
	'catalog_big_img' => '/images/catalog/big/',
	'catalog_small_img' => '/images/catalog/small/',
	'image_gag' => '/static/img/logo/image_gag.png',
	'tmp_img' => '/../storage/app/public/',

);
