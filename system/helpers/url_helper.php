<?php

function base_url($uri = '') {
    $configs = include GLOAL_CONF_PATH . '/config.php';
    $baseUrl = !empty($configs['base_url']) ? $configs['base_url'] : '';

    if (!empty($uri)) $baseUrl .= '/' . $uri;

    return $baseUrl;
}