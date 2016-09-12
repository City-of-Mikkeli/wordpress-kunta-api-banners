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
add_action ( 'add_meta_boxes', 'kuntaApiBannerMetaBox', 9999, 2 );
add_action ('save_post', 'kuntaApiBannerSaveLink');

function kuntaApiBannersCreatePostType() {
  
  register_post_type ( 'banner', array (
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
    'show_in_rest' => true,
    'supports' => array (
      'title',
      'editor',
      'thumbnail'
     )
  ));
  
}

function kuntaApiBannerRenderMetaBox($banner) {
  $link = get_post_meta($banner->ID, "banner-link", true);
  echo '<input name="banner-link" id="banner-link" type="url" style="width: 100%;" value="' . $link . '"></input>';
}

function kuntaApiBannerMetaBox() {
  add_meta_box( 
    'banner-link-meta-box',
    __( 'Banner Link', KUNTA_API_BANNERS_I18N_DOMAIN ),
     'kuntaApiBannerRenderMetaBox',
     'banner',
     'side',
     'default'
  );
}

function kuntaApiBannerSaveLink($bannerId) {
  if (array_key_exists('banner-link', $_POST)) {
	update_post_meta($bannerId, 'banner-link', $_POST['banner-link']);
  }
}

function kuntaApiBannerRestGet( $object, $field_name, $request) {
  return get_post_meta( $object[ 'id' ], $field_name, true);
}

add_action('rest_api_init', function () {
	
  register_rest_field( 'banner', 'banner-link', array(
	'get_callback' => 'kuntaApiBannerRestGet',
	'update_callback' => null,
	'schema' => array (
	  "type" => "string",
	  "format" => "url",
	  "description" => "Banner link"
	)
  ));
  
});

?>