<?php
/**
 * Class create a custom post types.
 */
namespace Soundst\create_cpt;

class Create_Custom_Post_Type {

  // Set options for Custom Post Type
  private $args = [];

  // Set post type name.
  private $pt_name;

  // Constructor function to initialize the custom post type
  public function __construct( $args = [], $pt_name ) {
    $this->set_args( $args );
    $this->set_pt_name( $pt_name );
    add_action( 'init', array( $this, 'create_post_type' ) );
  }

  public function set_args( $args ) {
    return $this->args = $args;
  }

  public function set_pt_name( $pt_name ) {
    return $this->pt_name = $pt_name;
  }
 
  // Register the custom post type
  public function create_post_type() {
    register_post_type( $this->pt_name, $this->args );
  }
}

$labels_inst = [
  'name'                => _x( 'Institutes', 'Post Type General Name' ),
  'singular_name'       => _x( 'Institute', 'Post Type Singular Name' ),
  'menu_name'           => __( 'Institutes' ),
  'parent_item_colon'   => __( 'Parent Institute' ),
  'all_items'           => __( 'All Institutes' ),
  'view_item'           => __( 'View Institute' ),
  'add_new_item'        => __( 'Add New Institute' ),
  'add_new'             => __( 'Add New' ),
  'edit_item'           => __( 'Edit Institute' ),
  'update_item'         => __( 'Update Institute' ),
  'search_items'        => __( 'Search Institute' ),
  'not_found'           => __( 'Not Found' ),
  'not_found_in_trash'  => __( 'Not found in Trash' )
];

$args_inst = [
  'label'               => __( 'Institutes' ),
  'description'         => __( 'Institutes' ),
  'labels'              => $labels_inst,
  'supports'            => array( 'title', 'author', 'revisions', 'custom-fields' ), 
  'taxonomies'          => array( '' ),
  'hierarchical'        => false,
  'public'              => true,
  'show_ui'             => true,
  'show_in_menu'        => true,
  'show_in_nav_menus'   => true,
  'show_in_admin_bar'   => true,
  'menu_position'       => 5,
  'can_export'          => true,
  'has_archive'         => true,
  'exclude_from_search' => false,
  'publicly_queryable'  => true,
  'capability_type'     => 'post',
  'show_in_rest'        => true
];

$labels_cent = [
  'name'                => _x( 'Centers', 'Post Type General Name' ),
  'singular_name'       => _x( 'Center', 'Post Type Singular Name' ),
  'menu_name'           => __( 'Centers' ),
  'parent_item_colon'   => __( 'Parent Center' ),
  'all_items'           => __( 'All Centers' ),
  'view_item'           => __( 'View Center' ),
  'add_new_item'        => __( 'Add New Center' ),
  'add_new'             => __( 'Add New' ),
  'edit_item'           => __( 'Edit Center' ),
  'update_item'         => __( 'Update Center' ),
  'search_items'        => __( 'Search Center' ),
  'not_found'           => __( 'Not Found' ),
  'not_found_in_trash'  => __( 'Not found in Trash' )
];

$args_cent = [
  'label'               => __( 'Centers' ),
  'description'         => __( 'Centers' ),
  'labels'              => $labels_cent,
  'supports'            => array( 'title', 'author', 'revisions', 'custom-fields', 'thumbnail' ), 
  'taxonomies'          => array( '' ),
  'hierarchical'        => false,
  'public'              => true,
  'show_ui'             => true,
  'show_in_menu'        => true,
  'show_in_nav_menus'   => true,
  'show_in_admin_bar'   => true,
  'menu_position'       => 6,
  'can_export'          => true,
  'has_archive'         => true,
  'exclude_from_search' => false,
  'publicly_queryable'  => true,
  'capability_type'     => 'post',
  'show_in_rest'        => true
];

$labels_cond = [
  'name'                => _x( 'Conditions', 'Post Type General Name' ),
  'singular_name'       => _x( 'Condition', 'Post Type Singular Name' ),
  'menu_name'           => __( 'Conditions' ),
  'parent_item_colon'   => __( 'Parent Condition' ),
  'all_items'           => __( 'All Conditions' ),
  'view_item'           => __( 'View Condition' ),
  'add_new_item'        => __( 'Add New Condition' ),
  'add_new'             => __( 'Add New' ),
  'edit_item'           => __( 'Edit Condition' ),
  'update_item'         => __( 'Update Condition' ),
  'search_items'        => __( 'Search Condition' ),
  'not_found'           => __( 'Not Found' ),
  'not_found_in_trash'  => __( 'Not found in Trash' )
];

$args_cond = [
  'label'               => __( 'Conditions' ),
  'description'         => __( 'Conditions' ),
  'labels'              => $labels_cond,
  'supports'            => array( 'title', 'author', 'revisions', 'custom-fields', ), 
  'taxonomies'          => array( '' ),
  'hierarchical'        => false,
  'public'              => true,
  'show_ui'             => true,
  'show_in_menu'        => true,
  'show_in_nav_menus'   => true,
  'show_in_admin_bar'   => true,
  'menu_position'       => 7,
  'can_export'          => true,
  'has_archive'         => true,
  'exclude_from_search' => false,
  'publicly_queryable'  => true,
  'capability_type'     => 'post',
  'show_in_rest'        => true
];

$labels_fac = [
  'name'                => _x( 'Faculty', 'Post Type General Name' ),
  'singular_name'       => _x( 'Faculty', 'Post Type Singular Name' ),
  'menu_name'           => __( 'Faculty' ),
  'parent_item_colon'   => __( 'Parent Faculty' ),
  'all_items'           => __( 'All Faculty' ),
  'view_item'           => __( 'View Faculty' ),
  'add_new_item'        => __( 'Add New Faculty' ),
  'add_new'             => __( 'Add New' ),
  'edit_item'           => __( 'Edit Faculty' ),
  'update_item'         => __( 'Update Faculty' ),
  'search_items'        => __( 'Search Faculty' ),
  'not_found'           => __( 'Not Found' ),
  'not_found_in_trash'  => __( 'Not found in Trash' )
];

$args_fac = [
  'label'               => __( 'Faculty' ),
  'description'         => __( 'Faculty' ),
  'labels'              => $labels_fac,
  'supports'            => array( 'title', 'author', 'revisions', 'custom-fields', ), 
  'taxonomies'          => array( '' ),
  'hierarchical'        => false,
  'public'              => true,
  'show_ui'             => true,
  'show_in_menu'        => true,
  'show_in_nav_menus'   => true,
  'show_in_admin_bar'   => true,
  'menu_position'       => 8,
  'can_export'          => true,
  'has_archive'         => true,
  'exclude_from_search' => false,
  'publicly_queryable'  => true,
  'capability_type'     => 'post',
  'show_in_rest'        => true
];

// Initialize post types
$institutes_cpt = new Create_Custom_Post_Type( $args_inst, 'institute' );
$centers_cpt    = new Create_Custom_Post_Type( $args_cent, 'center' );
$conditions_cpt = new Create_Custom_Post_Type( $args_cond, 'condition' );
$faculty_cpt    = new Create_Custom_Post_Type( $args_fac, 'faculty' );
