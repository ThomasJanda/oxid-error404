<?php

$sMetadataVersion = '2.0';

$aModule = array(
    'id'          => 'rs-error404',
    'title'       => '*RS Error 404',
    'description' => 'Redirect to the start page if 404',
    'thumbnail'   => '',
    'version'     => '1.0.1',
    'author'      => '',
    'url'         => '',
    'email'       => '',
    'extend'      => array(
        \OxidEsales\Eshop\Core\Utils::class => rs\error404\Core\Utils::class,
    ),
    'templates' => array(
    ),
    'blocks'      => array(
    ),
    'settings'    => array(
    ),
);