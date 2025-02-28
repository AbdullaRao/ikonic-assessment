<?php
/**
 * Plugin Name: IP Blocker
 * Description: Blocks users with IPs starting with 77.29
 * Version: 1.1
 * Author: Abdullah Saleem
 */

if (!defined('ABSPATH')) exit;

function hs_block_ips() {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    if (strpos($user_ip, '77.29') === 0) {
        wp_redirect('https://youtu.be/dQw4w9WgXcQ?si=od4kuyKGlFh5-0ox');
        exit;
    }
}
add_action('init', 'hs_block_ips');
