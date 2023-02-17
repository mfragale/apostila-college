<?php
/*
 * Plugin Name:		Apostila do College
 * Plugin URI:		https://novaigreja.com/college
 * Description:		Plataforma do Nova College para exibir as apostilas.
 * Version:			1.0
 * Author:			Nova Digital Team
 * Author URI:		https://novaigreja.com
 * License:			GPL-2.0+
 * License URI:		http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Not called within Wordpress framework
if (!defined('WPINC')) {
    die;
}


/***************
 * global variables
 ***************/

$apostilacollege_prefix = 'apostilacollege_';
$apostilacollege_plugin_name = 'Apostila do College';



ini_set('error_log', $_SERVER['DOCUMENT_ROOT'] . '../../logs/error.log');
error_log('Apostila do College WordPress plugin');





// registration code for LOCAIS post type
function register_apostilas_posttype()
{
    $labels = array(
        'name'                 => _x('Apostilas', 'post type general name'),
        'singular_name'        => _x('Apostila', 'post type singular name'),
        'add_new'             => __('Adicionar'),
        'add_new_item'         => __('Adicionar item'),
        'edit_item'         => __('Editar item'),
        'new_item'             => __('Novo item'),
        'view_item'         => __('Ver item'),
        'search_items'         => __('Buscar itens'),
        'not_found'         => __('Não encontrado'),
        'not_found_in_trash' => __('Não encontrado no lixo'),
        'parent_item_colon' => __(''),
        'menu_name'            => __('Apostilas')
    );

    $supports = array('title', 'editor', 'excerpt', 'thumbnail');

    $post_type_args = array(
        'labels'             => $labels,
        'singular_label'     => __('Apostila'),
        'public'             => true,
        'show_ui'             => true,
        'publicly_queryable' => true,
        'query_var'            => true,
        'exclude_from_search' => false,
        'show_in_nav_menus'    => true,
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'         => false,
        'rewrite'             => array('slug' => 'apostila', 'with_front' => true),
        'supports'             => $supports,
        'menu_position'     => 4,
        'menu_icon'         => 'dashicons-book',
        'taxonomies'        => array('category'),
        'show_in_rest'        => true
    );
    register_post_type('apostilas', $post_type_args);
}

add_action('init', 'register_apostilas_posttype');





function yourplugin_enqueue_frontend()
{
    global $post;

    if ($post->post_type == 'apostilas') {
        wp_enqueue_style('apostilacollege-syles', plugins_url('apostila-college/includes/scss/dist/style-min.css', __DIR__), array(), '1.0');
        wp_enqueue_script('functions-js', plugins_url('apostila-college/includes/js/dist/functions-min.js', __DIR__), array('jquery'), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'yourplugin_enqueue_frontend');


/* Filter the single_template with our custom function*/
// https: //wordpress.stackexchange.com/questions/17385/custom-post-type-templates-from-plugin-folder

add_filter('single_template', 'my_custom_template');

function my_custom_template($single)
{
    global $post;

    /* Checks for single template by post type */
    if ($post->post_type == 'apostilas') {
        if (file_exists(plugin_dir_path(__FILE__) . '/includes/apostila-page-template.php')) {
            return plugin_dir_path(__FILE__) . '/includes/apostila-page-template.php';
        }
    }

    return $single;
}
