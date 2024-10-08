<?php

add_filter( 'pt-ocdi/import_files', 'cdi_import_files' );
function cdi_import_files() {
    return array(
		array(
            'import_file_name'             => __('Green Eco Homepage 6','cdi'),
            'categories'                   =>  array( 'Homepage' ),
            'local_import_file'            => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/content.xml',
            'local_import_customizer_file' => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/options.dat',
            'import_preview_image_url'     => CDI_PLUGIN_DIR_URL . '/assets/images/green-eco-planet/homepage-6.jpg',
            'local_import_widget_file'     => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/widgets.wie',
            'preview_url'                  => 'https://bizbergthemes.com/green-eco-planet-pro/homepage-6/'
        ),
        array(
            'import_file_name'             => __('Green Wealth Homepage PRO','cdi'),
            'categories'                   =>  array( 'Homepage' ),
            'local_import_file'            => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/content.xml',
            'local_import_customizer_file' => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/options.dat',
            'import_preview_image_url'     => CDI_PLUGIN_DIR_URL . '/assets/images/green-eco-planet/homepage-green-wealth.jpg',
            'local_import_widget_file'     => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/widgets.wie',
            'preview_url'                  => 'https://bizbergthemes.com/green-eco-planet-pro/homepage-5/'
        ),
        array(
            'import_file_name'             => __('Fully Green Homepage PRO','cdi'),
            'categories'                   =>  array( 'Homepage' ),
            'local_import_file'            => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/content.xml',
            'local_import_customizer_file' => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/options.dat',
            'import_preview_image_url'     => CDI_PLUGIN_DIR_URL . '/assets/images/green-eco-planet/homepage-fully-green.jpg',
            'local_import_widget_file'     => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/widgets.wie',
            'preview_url'                  => 'https://bizbergthemes.com/green-eco-planet-pro/fully-green-homepage-pro/'
        ),
        array(
            'import_file_name'             => __('Homepage Free','cdi'),
            'categories'                   =>  array( 'Homepage' ),
            'local_import_file'            => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/content.xml',
            'local_import_customizer_file' => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/options.dat',
            'import_preview_image_url'     => CDI_PLUGIN_DIR_URL . '/assets/images/green-eco-planet/homepage.jpg',
            'local_import_widget_file'     => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/widgets.wie',
            'preview_url'                  => 'https://bizbergthemes.com/green-eco-planet-pro/'
        ),
        array(
            'import_file_name'             => __('Homepage PRO','cdi'),
            'categories'                   =>  array( 'Homepage' ),
            'local_import_file'            => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/content.xml',
            'local_import_customizer_file' => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/options.dat',
            'local_import_widget_file'     => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/widgets.wie',
            'import_preview_image_url'     => CDI_PLUGIN_DIR_URL . '/assets/images/green-eco-planet/homepage-pro.jpg',
            'preview_url'                  => 'https://bizbergthemes.com/green-eco-planet-pro/homepage-pro/'
        ),
        array(
            'import_file_name'             => __('Green Globe PRO','cdi'),
            'categories'                   =>  array( 'Homepage' ),
            'local_import_file'            => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/content.xml',
            'local_import_customizer_file' => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/options.dat',
            'local_import_widget_file'     => CDI_PLUGIN_DIR_PATH . '/themes/green-eco-planet-pro/inc/widgets.wie',
            'import_preview_image_url'     => CDI_PLUGIN_DIR_URL . '/assets/images/green-eco-planet/green-globe-pro.jpg',
            'preview_url'                  => 'https://bizbergthemes.com/green-eco-planet-pro/green-globe-pro/'
        ),
    );
}

add_action( 'pt-ocdi/after_import', 'cdi_after_import_setup' );
function cdi_after_import_setup( $selected_import ) {

    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'menu-1' => $main_menu->term_id,
        )
    );

    $import_file_name = $selected_import['import_file_name'];

    switch ( $import_file_name ) {

        case 'Homepage Free':
            $front_page_id = get_page_by_path( 'homepage-free' );
            break;

        case 'Homepage PRO':
            $front_page_id = get_page_by_path( 'homepage-pro' );
            break;

        case 'Fully Green Homepage PRO':
            $front_page_id = get_page_by_path( 'fully-green-homepage-pro' );
            break;

        case 'Green Globe PRO':
            $front_page_id = get_page_by_path( 'green-globe-pro' );
            break;

        case 'Green Wealth Homepage PRO':
            $front_page_id = get_page_by_path( 'homepage-5' );
            break;
			
		case 'Green Eco Homepage 6':
            $front_page_id = get_page_by_path( 'homepage-6' );
            break;
        
        default:
            # code...
            break;
    }

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );

    // Change elementor options
    update_option( 'elementor_disable_color_schemes' , 'yes' );
    update_option( 'elementor_disable_typography_schemes' , 'yes' );
    update_option( 'elementor_page_title_selector' , 'h3.blog-title' );

    cdi_set_elementor_active_kit();

}

function cdi_set_elementor_active_kit(){

    $args = array(
        'post_type' => 'elementor_library',
        'numberposts' => 1,
        'post_status' => 'publish',
        'name' => 'default-kit-cyclone'
    );

    $my_posts = get_posts($args);
    if( $my_posts ) :
        update_option( 'elementor_active_kit',  absint( $my_posts[0]->ID ) );
    endif;

}

function cdi_register_plugins( $plugins ) {

    $theme_plugins = [
        [ 
          'name'     => 'Contact Form 7', 
          'slug'     => 'contact-form-7', 
          'required' => true,             
        ],
        [ 
          'name'     => 'Elementor Page Builder', 
          'slug'     => 'elementor', 
          'required' => true,             
        ],
        [ 
          'name'     => 'Essential Addons for Elementor', 
          'slug'     => 'essential-addons-for-elementor-lite', 
          'required' => true,             
        ],
        [ 
          'name'     => 'Charity Addon for Elementor', 
          'slug'     => 'charity-addon-for-elementor', 
          'required' => true,             
        ],
        [ 
          'name'     => 'GiveWP – Donation Plugin and Fundraising Platform', 
          'slug'     => 'give', 
          'required' => true,             
        ],
    ];
 
    return $theme_plugins;

}
add_filter( 'ocdi/register_plugins', 'cdi_register_plugins' );