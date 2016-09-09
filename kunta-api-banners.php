<?php
/*
 * Created on Sep 9, 2016
 * Plugin Name: Kunta API Banners
 * Description: Kunta API Header Banners plugin for Wordpress
 * Version: 0.1
 * Author: Antti Leppä / Otavan Opisto
 */
defined ( 'ABSPATH' ) || die ( 'No script kiddies please!' );

require_once ('constants.php');

add_action ( 'init', 'kuntaApiBannersCreatePostType' );

function kuntaApiBannersCreatePostType() {
  
  register_post_type ( 'kunta_api_banners', array (
    'labels' => array (
      'name'               => __( 'Header Banners', KUNTA_API_BANNERS_I18N_DOMAIN ),
      'singular_name'      => __( 'Header Banner', KUNTA_API_BANNERS_I18N_DOMAIN ),
      'add_new'            => __( 'Add Banner', KUNTA_API_BANNERS_I18N_DOMAIN ),
      'add_new_item'       => __( 'Add New Banner', KUNTA_API_BANNERS_I18N_DOMAIN ),
      'edit_item'          => __( 'Edit Banner', KUNTA_API_BANNERS_I18N_DOMAIN ),
      'new_item'           => __( 'New Banner', KUNTA_API_BANNERS_I18N_DOMAIN ),
      'view_item'          => __( 'View Banner', KUNTA_API_BANNERS_I18N_DOMAIN ),
      'search_items'       => __( 'Search Banners', KUNTA_API_BANNERS_I18N_DOMAIN ),
      'not_found'          => __( 'No Banners found', KUNTA_API_BANNERS_I18N_DOMAIN ),
      'not_found_in_trash' => __( 'No Banners in trash', KUNTA_API_BANNERS_I18N_DOMAIN ),
      'menu_name'          => __( 'Banners', KUNTA_API_BANNERS_I18N_DOMAIN ),
      'all_items'          => __( 'Banners', KUNTA_API_BANNERS_I18N_DOMAIN )
    ),
    'public' => true,
    'has_archive' => true,
    'supports' => array (
      'title',
      'editor',
      'thumbnail'
     )
  ));
  
}

?>