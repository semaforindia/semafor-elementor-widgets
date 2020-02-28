<?php

// namespace ElementorPro\Modules\Posts\Widgets;

// use \Elementor\Controls_Manager;
// use \ElementorPro\Modules\QueryControl\Module as Module_Query;
// use \ElementorPro\Modules\QueryControl\Controls\Group_Control_Related;
// if ( ! defined( 'ABSPATH' ) ) {
// 	exit; // Exit if accessed directly
// }
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
/**
 * Elementor Post_Carousel Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class SemaforPostCarousel extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve Post_Carousel widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'Semafor Post Carousel';
    }
    /**
     * Get widget title.
     *
     * Retrieve Post_Carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Semafor Post Carousel', 'plugin-name');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Post_Carousel widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-slider-push';
    }
    public function get_categories()
    {
        return ['general'];
    }
    public function get_keywords() {
		return [ 'posts', 'cpt', 'item', 'loop', 'query', 'cards', 'custom post type' ];
	}
	
	public static function get_button_sizes() {
		return [
			'xs' => __( 'Extra Small', 'elementor-pro' ),
			'sm' => __( 'Small', 'elementor-pro' ),
			'md' => __( 'Medium', 'elementor-pro' ),
			'lg' => __( 'Large', 'elementor-pro' ),
			'xl' => __( 'Extra Large', 'elementor-pro' ),
		];
	}
    // public function on_import( $element ) {
	// 	if ( ! get_post_type_object( $element['settings']['posts_post_type'] ) ) {
	// 		$element['settings']['posts_post_type'] = 'post';
	// 	}

	// 	return $element;
	// }

    /**
     * Register Post_Carousel widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
	
	//  function _get_post_type() {
	// 	$post_types = get_post_types( array|string $args = array(), string $output = 'names', string $operator = 'and' );
	// 	return $post_types;
	// 	print_r($post_types);
	//  }
	
    protected function _register_controls() {
		// $controls_manager->add_group_control( Group_Control_Related::get_type(), new Group_Control_Related() );

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );
        
        

		$this->add_control(
			'width',
			[
				'label' => __( 'Width', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .box' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
	   
		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'slides_repeater' );

		$repeater->start_controls_tab( 'background', [ 'label' => __( 'Background', 'plugin-domain') ] );

		$repeater->add_control(
			'background_color',
			[
				'label' => __( 'Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#bbbbbb',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .custom-slide-bg' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'background_image',
			[
				'label' => _x( 'Image', 'Background Control', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .custom-slide-bg' => 'background-image: url({{URL}})',
				],
			]
		);

		$repeater->add_control(
			'background_size',
			[
				'label' => _x( 'Size', 'Background Control',  'plugin-domain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => _x( 'Cover', 'Background Control', 'plugin-domain' ),
					'contain' => _x( 'Contain', 'Background Control', 'plugin-domain' ),
					'auto' => _x( 'Auto', 'Background Control', 'plugin-domain' ),
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .custom-slide-bg' => 'background-size: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_image[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);
        $repeater->end_controls_tab();
		
		$this->end_controls_section();
        // parent::_register_controls();

		// $this->register_query_section_controls();
		//$this->register_pagination_section_controls();
	}

    // public function query_posts() {

	// 	$query_args = [
	// 		'posts_per_page' => $this->get_current_skin()->get_instance_value( 'posts_per_page' ),
	// 		'paged' => $this->get_current_page(),
	// 	];

	// 	/** @var Module_Query $elementor_query */
	// 	$elementor_query = Module_Query::instance();
	// 	$this->query = $elementor_query->get_query( $this, 'posts', $query_args, [] );
	// }

	// protected function register_query_section_controls() {
	// 	$this->start_controls_section(
	// 		'section_query',
	// 		[
	// 			'label' => __( 'Query', 'elementor' ),
	// 			'tab' =>  \Elementor\Controls_Manager::TAB_CONTENT,
	// 		]
	// 	);
		
	// 	$this->add_group_control(
	// 		Group_Control_Related::get_type(),
	// 		[
	// 			'name' => $this->get_name(),
	// 			'presets' => [ 'full' ],
	// 			'exclude' => [
	// 				'posts_per_page', //use the one from Layout section
	// 			],
	// 		]
	// 	);

	// 	$this->end_controls_section();
	// }

	protected function render() {
		$settings = $this->get_settings_for_display();
		//$post_types = get_post_types();
		echo '<div class="box" style="width: ' . $settings['width']['size'] . $settings['width']['unit'].' "></div>';
	
		//print_r($post_types);

	}

	protected function _content_template() {
		?>
		<div class="box" style="width: {{ settings.width.size }}{{ settings.width.unit }}"></div>
		<?php
	}
}