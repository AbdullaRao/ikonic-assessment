<?php
/**
 * Plugin Name: Custom Projects
 * Description: Adds a custom post type "Projects" with taxonomy "Project Type"
 * Version: 1.3
 * Author: Abdullah Saleem
 */

if (!defined('ABSPATH')) exit;

function hs_register_projects() {
    register_post_type('projects', [
        'labels' => [
            'name'          => 'Projects',
            'singular_name' => 'Project'
        ],
        'public'       => true,
        'has_archive'  => true, // ✅ Ensures archive page works
        'supports'     => ['title', 'editor', 'thumbnail'],
        'rewrite'      => ['slug' => 'projects'],
        'show_in_rest' => true, // ✅ Required for Query Loop to detect CPT
    ]);

    register_taxonomy('project_type', 'projects', [
        'labels'       => [
            'name'          => 'Project Types',
            'singular_name' => 'Project Type'
        ],
        'public'       => true,
        'hierarchical' => true,
        'rewrite'      => ['slug' => 'project-type'],
        'show_in_rest' => true, // ✅ Required for block editor support
    ]);
}
add_action('init', 'hs_register_projects');





function hs_get_architecture_projects() {
    if (!is_user_logged_in()) {
        $limit = 3;
    } else {
        $limit = 6;
    }

    $query = new WP_Query([
        'post_type' => 'projects',
        'posts_per_page' => $limit,
        'tax_query' => [
            [
                'taxonomy' => 'project_type',
                'field' => 'slug',
                'terms' => 'architecture'
            ]
        ]
    ]);

    $projects = [];
    while ($query->have_posts()) {
        $query->the_post();
        $projects[] = [
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'link' => get_permalink()
        ];
    }
    wp_reset_postdata();

    wp_send_json(['success' => true, 'data' => $projects]);
}

add_action('wp_ajax_hs_get_projects', 'hs_get_architecture_projects');
add_action('wp_ajax_nopriv_hs_get_projects', 'hs_get_architecture_projects');
