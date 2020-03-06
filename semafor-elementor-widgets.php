<?php

/**
 * @package  SemaforElementorWidgets
 */
/*
 * Plugin Name: Semafor Elementor Widgets
 * Description: This is an elementor add-on plugin by Semafor India.
 * Plugin URI: https://www.semafor.co.in/
 * Author: Semafor India
 * Version: 1.0.0
 * Author URI: https://www.semafor.co.in/
 * License: GPLv2 or later
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Main Elementor Test Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class SemaforElementorWidgets
{

    /**
     * Plugin Version
     *
     * @since 1.0.0
     *
     * @var string The plugin version.
     */
    const VERSION = '1.0.0';

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     *
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     *
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '7.0';

    /**
     * Instance
     *
     * @since 1.0.0
     *
     * @access private
     * @static
     *
     * @var SemaforElementorWidgets The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.0.0
     *
     * @access public
     * @static
     *
     * @return SemaforElementorWidgets An instance of the class.
     */
    public static function instance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function __construct()
    {
        add_action( 'elementor/elements/categories_registered', [ $this, 'register_category' ] );
        add_action('init', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function register_category( $elements ) {

		\Elementor\Plugin::instance()->elements_manager->add_category(
			'sew',
			[
				'title' => 'Semafor Elementor Widgets',
				'icon'  => 'font'
			],
			1
		);
	}

    /**
     * Load Textdomain
     *
     * Load plugin localization files.
     *
     * Fired by `init` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function i18n()
    {

        load_plugin_textdomain('elementor-test-extension');
    }

    /**
     * Initialize the plugin
     *
     * Load the plugin only after Elementor (and other plugins) are loaded.
     * Checks for basic plugin requirements, if one check fail don't continue,
     * if all check have passed load the files required to run the plugin.
     *
     * Fired by `plugins_loaded` action hook.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init()
    {

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return;
        }

        // Add Plugin actions
        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
        // add_action('elementor/controls/controls_registered', [$this, 'init_controls']);

        // Adding Assets
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        // add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_missing_main_plugin()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension'),
            '<strong>' . esc_html__('Elementor Test Extension', 'elementor-test-extension') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-test-extension') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_elementor_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension'),
            '<strong>' . esc_html__('Elementor Test Extension', 'elementor-test-extension') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-test-extension') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension'),
            '<strong>' . esc_html__('Elementor Test Extension', 'elementor-test-extension') . '</strong>',
            '<strong>' . esc_html__('PHP', 'elementor-test-extension') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Init Widgets
     *
     * Include widgets files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_widgets()
    {

        // Include Widget files
        require_once(__DIR__ . '/widgets/navigation.php');
        require_once(__DIR__ . '/widgets/faq.php');
        // require_once(__DIR__ . '/widgets/post-carousel.php');
        require_once(__DIR__ . '/widgets/slider.php');
        require_once(__DIR__ . '/widgets/demo.php');

        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Navigation());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Semafor_FAQ());
        // \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new SemaforPostCarousel());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Slider());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Demo());
    }

    /**
     * Init Controls
     *
     * Include controls files and register them
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function init_controls()
    {

        // Include Control files
        require_once(__DIR__ . '/controls/test-control.php');

        // Register control
        \Elementor\Plugin::$instance->controls_manager->register_control('control-type-', new \Test_Control());
    }

    public function enqueue()
    {
        // enqueue all our scripts
        wp_enqueue_style('owl-carousel-css', plugins_url('/assets/lib/owl-carousel/owl.carousel.min.css', __FILE__));
        wp_enqueue_style('owl-carousel-theme-style', plugins_url('/assets/lib/owl-carousel/owl.theme.default.css', __FILE__));
        wp_enqueue_style('semafor-elementor-widgets-global-style', plugins_url('/assets/css/semafor-elementor-widgets.css', __FILE__));
        



        wp_enqueue_script('jQuery', plugins_url('/assets/lib/jQuery/jquery-3.4.1.min.js', __FILE__));
        wp_enqueue_script('owl-carousel-js', plugins_url('/assets/lib/owl-carousel/owl.carousel.min.js', __FILE__));
        wp_enqueue_script('semafor-elementor-widgets-global-js', plugins_url('/assets/js/semafor-elementor-widgets.js', __FILE__));
       
    }
    public function admin_enqueue_scripts($hook)
    {
       
        wp_enqueue_style('owl-carousel-css', plugins_url('/assets/lib/owl-carousel/owl.carousel.min.css', __FILE__));
        wp_enqueue_style('owl-carousel-theme-style', plugins_url('/assets/lib/owl-carousel/owl.theme.default.css', __FILE__));
        wp_enqueue_style('semafor-elementor-widgets-global-style', plugins_url('/assets/css/semafor-elementor-widgets.css', __FILE__));

        wp_enqueue_script('jQuery', plugins_url('/assets/lib/jQuery/jquery-3.4.1.min.js', __FILE__));
        wp_enqueue_script('owl-carousel-js', plugins_url('/assets/lib/owl-carousel/owl.carousel.min.js', __FILE__));
        wp_enqueue_script('semafor-elementor-widgets-global-js', plugins_url('/assets/js/semafor-elementor-widgets.js', __FILE__));
    }
}

SemaforElementorWidgets::instance();
