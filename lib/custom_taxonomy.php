<?php
///hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_equipos_hierarchical_taxonomy', 0 );
 
//create a custom taxonomy name it equipos for your posts
 
function create_equipos_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $labels = array(
    'name' => _x( 'Equipos', 'taxonomy general name' ),
    'singular_name' => _x( 'Equipo', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Equipos' ),
    'all_items' => __( 'Todos los Equipos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Equipo' ), 
    'update_item' => __( 'Update Equipo' ),
    'add_new_item' => __( 'Add New Equipo' ),
    'new_item_name' => __( 'New Equipo Name' ),
    'menu_name' => __( 'Equipos' ),
  );    
 
// Now register the taxonomy
 
  register_taxonomy('equipos',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_rest'      => true,
    'show_tagcloud'     => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'equipo' ),
  ));
 
}

//hook into the init action and call create_equipos_nonhierarchical_taxonomy when it fires
 
add_action( 'init', 'create_equipos_nonhierarchical_taxonomy', 0 );
 
function create_equipos_nonhierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Equipos', 'taxonomy general name' ),
    'singular_name' => _x( 'Equipo', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Equipos' ),
    'popular_items' => __( 'Popular Equipos' ),
    'all_items' => __( 'All Equipos' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Equipo' ), 
    'update_item' => __( 'Update Equipo' ),
    'add_new_item' => __( 'Add New Equipo' ),
    'new_item_name' => __( 'New Equipo Name' ),
    'separate_items_with_commas' => __( 'Separate equipos with commas' ),
    'add_or_remove_items' => __( 'Add or remove equipos' ),
    'choose_from_most_used' => __( 'Choose from the most used equipos' ),
    'menu_name' => __( 'Equipos' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('equipos','post',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'equipo' ),
  ));
}


add_action( 'create_equipos_hierarchical_taxonomy', 'add_feature_group_field', 10, 2 );

function add_feature_group_field($taxonomy) {
    global $feature_groups;
    ?><div class="form-field term-group">
        <label for="featuret-group"><?php _e('Feature Group', 'my_plugin'); ?></label>
        <select class="postform" id="equipment-group" name="feature-group">
            <option value="-1"><?php _e('none', 'my_plugin'); ?></option><?php foreach ($feature_groups as $_group_key => $_group) : ?>
                <option value="<?php echo $_group_key; ?>" class=""><?php echo $_group; ?></option>
            <?php endforeach; ?>
        </select>
    </div><?php
}

function single_term_slug( $prefix = '', $display = true ) {
  $term = get_queried_object();
  if ( !$term )
  return;
  if ( is_category() )
      $term_slug = apply_filters( 'single_cat_slug', $term->slug );
  elseif ( is_tag() )
      $term_slug = apply_filters( 'single_tag_slug', $term->slug );
  elseif ( is_tax() )
      $term_slug = apply_filters( 'single_term_slug', $term->slug );
  else
      return;
  if ( empty( $term_slug ) )
      return;
  if ( $display )
      echo $prefix . $term_slug;
  else
      return $term_slug;
}

?>

