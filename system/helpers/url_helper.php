<?php

function base_url($uri = '') {
    $CI =& get_instance();
    return $CI->config->base_url($uri);
}