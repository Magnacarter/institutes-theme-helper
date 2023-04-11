<?php
/**
 * The plugin bootstrap file
 *
 * @link              https://github.com/Magnacarter/soundst-theme-helper
 * @since             1.0.0
 * @package           SoundST/soundst-theme-helper
 *
 * @wordpress-plugin
 * Plugin Name:       SoundST Theme Helper
 * Plugin URI:        https://github.com/Magnacarter/soundst-theme-helper
 * Description:       Customize theme with CPTs and new background architecture to meet client needs.
 * Version:           1.0.0
 * Author:            Adam Carter
 * Author URI:        https://github.com/Magnacarter/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       soundst-theme-helper
 * Domain Path:       /languages
 */
namespace Soundst\theme_helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Cheatin&#8217?' );
}

$plugin_url = plugin_dir_url( __FILE__ );
define( 'SOUNDST_PLUGIN_URL', $plugin_url );
define( 'SOUNDST_PLUGIN_DIR', plugin_dir_path( __DIR__ ) . '/soundst-theme-helper' );
define( 'SOUNDST_PLUGIN_VER', '1.0.0' );

new Init_Plugin();

/**
 * Class Init_Plugin
 */
class Init_Plugin {

	/**
	 * Construct function
	 *
	 * @return void
	 */
	public function __construct() {
		register_activation_hook( __FILE__, array( __CLASS__, 'activate_plugin' ) );
		register_deactivation_hook( __FILE__, array( __CLASS__, 'deactivate_plugin' ) );
		register_uninstall_hook( __FILE__, array( __CLASS__, 'uninstall_plugin' ) );

        // Load CPTs.
		require_once 'classes/class-custom-post-types.php';

		// Load plugin classes.
		add_action( 'wp_enqueue_scripts', [$this, 'init_autoloader'] );

		// Load plugin scripts and styles.
		add_action( 'wp_enqueue_scripts', [$this, 'public_scripts'] );
	}

    /**
	 * Enqueue public scripts and styles
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function public_scripts() {
		global $post;

		// Load dependencies if the post-type is correct.
		if ( 
			'institute' == get_post_type( $post->ID )
			||
			'center' == get_post_type( $post->ID )
			||
			'condition' == get_post_type( $post->ID )
			||
			'faculty' == get_post_type( $post->ID )
		) {
			// Enqueue slick styles.
			wp_enqueue_style(  'soundst_slick_styles', SOUNDST_PLUGIN_URL . 'assets/css/slick.css', array(), SOUNDST_PLUGIN_VER );

			// Enqueue plugin styles.
			wp_enqueue_style(  'soundst_plugin_styles', SOUNDST_PLUGIN_URL . 'dist/output.css', array(), SOUNDST_PLUGIN_VER );

			// Enqueue slick js.
			wp_enqueue_script( 'soundst_flowbite_js', SOUNDST_PLUGIN_URL . 'assets/js/slick.min.js', array(), SOUNDST_PLUGIN_VER, true );

			// Enqueue plugin js.
			wp_enqueue_script( 'soundst_webcomponent', SOUNDST_PLUGIN_URL . 'assets/js/plugin.js', array(), SOUNDST_PLUGIN_VER, true );

			// Load Font Awesome.
			?>
			<link
			rel="stylesheet"
			href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" 
			integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" 
			crossorigin="anonymous"/>
			<?php
		}
	}

	/**
	 * Plugin activation handler
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function activate_plugin() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		flush_rewrite_rules();
	}

	/**
	 * The plugin is deactivating. Delete out the rewrite rules option.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function deactivate_plugin() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		delete_option( 'rewrite_rules' );
	}

	/**
	 * Uninstall plugin handler
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public static function uninstall_plugin() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		check_admin_referer( 'bulk-plugins' );

		// Important: Check if the file is the one
		// that was registered during the uninstall hook.
		if ( __FILE__ != WP_UNINSTALL_PLUGIN ) {
			return;
		}
		delete_option( 'rewrite_rules' );
	}

	/**
	 * Kick off the plugin by initializing the plugin files.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init_autoloader() {
		require_once 'classes/class-hero.php';
		require_once 'classes/class-create-institute-sections.php';
		require_once 'classes/class-centers-sections.php';
		require_once 'classes/class-conditions-sections.php';
		require_once 'classes/class-faculty-sections.php';
		require_once 'classes/class-footer-sections.php';
	}
}
