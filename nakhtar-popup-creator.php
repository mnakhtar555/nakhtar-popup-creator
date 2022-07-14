<?php
/*
Plugin Name: Nakhtar Popup Creator
Plugin URI: www.nurwebdev.com
Author: Noor Akhtar
Author URI: www.nurwebdev.com/about
Version: 1.0.0
Tags: popup, plugin, WordPress,
Description: This is a popup creator plugin for your website
Text Domain: popupcreator
Domain Path: /languages/
Plugin Type: Piklist
*/

class NakhtarPopupCreator {
    /**
     * Init HOOKS 
     */
    public function __construct(){
        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        add_action( 'init', array( $this, 'register_cpt_popup' ) );
        add_action( 'init', array( $this, 'register_popup_size' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ) );
        add_action( 'wp_footer', array( $this, 'print_modal_markup' ) );
    }

    /**
     * Loading CSS and JS files
     */
    public function load_assets(){
        wp_enqueue_style( 'modal-style', plugin_dir_url( __FILE__ ) . 'assets/css/modal.css', null, time() );
        wp_enqueue_script( 'plain-modal-script', plugin_dir_url( __FILE__ ) . 'assets/js/plain-modal.min.js', null, '1.0.34', true );
        wp_enqueue_script( 'popupcreator-main', plugin_dir_url( __FILE__ ) . 'assets/js/popupcreator-main.js', array( 'jquery', 'plain-modal-script' ), time(), true );
    }
    /**
     * Registering Custom Image sizes
     */
    public function register_popup_size(){
        add_image_size( 'popup-landscape', 600, 800, true );
        add_image_size( 'popup-square', 500, 500, true );
    }
    public function load_textdomain(){
        load_plugin_textdomain( 'popupcreator', false, plugin_dir_path( __FILE__ ) . '/languages' );
    }

    /**
     * Registering Custom Post Type
     */
    public function register_cpt_popup(){
        $labels = array( 
            'name'              => __( 'Popups', 'popupcreator' ),
            'singular_name'     => __( 'Popup', 'popupcreator' ),
            'featured_image'    => __( 'Popup Image', 'popupcreator' ),
            'set_featured_image'=> __( 'Set Popup Image', 'popupcreator' )
        );
        $args = array(
            'labels'                => $labels,
            'description'           => 'You can create your popups here',
            'public'                => false,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'delete_with_user'      => false,
            'show_in_rest'          => true,
            'has_archive'           => false,
            'show_in_menu'          =>true,
            'show_in_nav_menus'     => true,
            'exclude_from_search'   => true,
            'capability_type'       => 'post',
            'map_meta_cap'          => true,
            'hierarchical'          => false,
            'rewrite'               => array( 'slug' => 'popup', 'with_front' => true ),
            'query_var'             => true,
            'supports'              => array( 'title', 'thumbnail' ),
        );
        register_post_type( 'popups', $args );
    }

    public function print_modal_markup(){
        $arguments = array(
            'post_type'         => 'popups',
            'post_status'       => 'publish',
            'meta_key'          => 'popupcreator_active',
            'meta_value'        => 1
        );
        $query = new WP_Query( $arguments );
        while( $query->have_posts() ){
            $query->the_post();
            $size = get_post_meta( get_the_ID(), 'popupcreator_popup_size', true );
            $exit = get_post_meta( get_the_ID(), 'popupcreator_display_exit', true );
            $image = get_the_post_thumbnail_url( get_the_ID(), $size );
            $delay = get_post_meta( get_the_ID(), 'popupcreator_display_after', true );
        ?>
        <div class="modal-content" data-modal-id="<?php the_ID();?>" data-size="<?php echo esc_attr($size); ?>" data-exit="<?php echo esc_attr( $exit ); ?>" data-delay="<?php echo esc_attr( $delay ); ?>">
            <div>
                <img class="close-button" width="30" src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/img/x.png'; ?>" alt="">
            </div>
            <img src="<?php echo esc_url( $image ); ?>" alt="Popup">
        </div>
<?php
        }
        wp_reset_query();
    }
}
new NakhtarPopupCreator();
?>