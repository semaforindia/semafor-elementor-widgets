<?php


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
class Slider extends \Elementor\Widget_Base
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
		return 'Semafor Slider';
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
		return __('Semafor Slider', 'plugin-name');
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
		return ['sew'];
	}
	public function get_keywords()
	{
		return ['posts', 'cpt', 'item', 'loop', 'query', 'cards', 'custom post type'];
	}

	public static function get_button_sizes()
	{
		return [
			'xs' => __('Extra Small', 'elementor-pro'),
			'sm' => __('Small', 'elementor-pro'),
			'md' => __('Medium', 'elementor-pro'),
			'lg' => __('Large', 'elementor-pro'),
			'xl' => __('Extra Large', 'elementor-pro'),
		];
	}
	public function on_import($element)
	{
		if (!get_post_type_object($element['settings']['posts_post_type'])) {
			$element['settings']['posts_post_type'] = 'post';
		}

		return $element;
	}

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



	protected function _register_controls()
	{

		$this->start_controls_section(
			'section_slides',
			[
				'label' => __('Slides', 'elementor-pro'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'custom-text',
			[
				'label' => __('Custom Text', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Custom Text', 'elementor-pro'),
				'label_block' => true,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->start_controls_tabs('slides_repeater');

		$repeater->start_controls_tab('background', ['label' => __('Background', 'elementor-pro')]);

		$repeater->add_control(
			'background_color',
			[
				'label' => __('Color', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#bbbbbb',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .owl-slide-bg' => 'background-color: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'background_image',
			[
				'label' => _x('Image', 'Background Control', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .owl-image' => 'background-image: url({{URL}})',
				],
			]
		);

		$repeater->add_control(
			'background_size',
			[
				'label' => _x('Size', 'Background Control', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'cover' => _x('Cover', 'Background Control', 'elementor-pro'),
					'contain' => _x('Contain', 'Background Control', 'elementor-pro'),
					'auto' => _x('Auto', 'Background Control', 'elementor-pro'),
				],
				'selectors' => [
					'{{WRAPPER}} .owl-image' => 'background-size: {{VALUE}}',
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

		$repeater->add_control(
			'background_ken_burns',
			[
				'label' => __('Ken Burns Effect', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
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

		$repeater->add_control(
			'zoom_direction',
			[
				'label' => __('Zoom Direction', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'in',
				'options' => [
					'in' => __('In', 'elementor-pro'),
					'out' => __('Out', 'elementor-pro'),
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_ken_burns',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'background_overlay',
			[
				'label' => __('Background Overlay', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
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

		$repeater->add_control(
			'background_overlay_color',
			[
				'label' => __('Color', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.5)',
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_overlay',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-background-overlay' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'background_overlay_blend_mode',
			[
				'label' => __('Blend Mode', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => __('Normal', 'elementor-pro'),
					'multiply' => 'Multiply',
					'screen' => 'Screen',
					'overlay' => 'Overlay',
					'darken' => 'Darken',
					'lighten' => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'color-burn' => 'Color Burn',
					'hue' => 'Hue',
					'saturation' => 'Saturation',
					'color' => 'Color',
					'exclusion' => 'Exclusion',
					'luminosity' => 'Luminosity',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'background_overlay',
							'value' => 'yes',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-background-overlay' => 'mix-blend-mode: {{VALUE}}',
				],
			]
		);
		$repeater->add_responsive_control(
			'slides_margin',
			[
				'label' => __('Margin', 'elementor-pro'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .owl-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$repeater->end_controls_tab();
		//content tab
		$repeater->start_controls_tab('content', ['label' => __('Content', 'elementor-pro')]);

		$repeater->add_control(
			'heading',
			[
				'label' => __('Title & Description', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Slide Heading', 'elementor-pro'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'description',
			[
				'label' => __('Description', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-pro'),
				'show_label' => false,
			]
		);

		$repeater->add_control(
			'item_description',
			[
				'label' => __('Slider Content', 'plugin-domain'),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __('Default description', 'plugin-domain'),
				'placeholder' => __('Type your description here', 'plugin-domain'),
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label' => __('Button Text', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('Click Here', 'elementor-pro'),
			]
		);

		$repeater->add_control(
			'link',
			[
				'label' => __('Link', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'elementor-pro'),
			]
		);

		$repeater->add_control(
			'link_click',
			[
				'label' => __('Apply Link On', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'slide' => __('Whole Slide', 'elementor-pro'),
					'button' => __('Button Only', 'elementor-pro'),
				],
				'default' => 'slide',
				'conditions' => [
					'terms' => [
						[
							'name' => 'link[url]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$repeater->end_controls_tab();

		//style
		$repeater->start_controls_tab('style', ['label' => __('Style', 'elementor-pro')]);

		$repeater->add_control(
			'custom_style',
			[
				'label' => __('Custom', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'description' => __('Set custom style that will only affect this specific slide.', 'elementor-pro'),
			]
		);
		$repeater->add_control(
			'horizontal_position',
			[
				'label' => __('Horizontal Position', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor-pro'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'elementor-pro'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'elementor-pro'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .custom-slide-contents' => '{{VALUE}}',
				],
				'selectors_dictionary' => [
					'left' => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right' => 'margin-left: auto',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'vertical_position',
			[
				'label' => __('Vertical Position', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'top' => [
						'title' => __('Top', 'elementor-pro'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Middle', 'elementor-pro'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'elementor-pro'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .owl-slide-inner' => 'align-items: {{VALUE}}',
				],
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'text_align',
			[
				'label' => __('Text Align', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor-pro'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'elementor-pro'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'elementor-pro'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .owl-slide-inner' => 'text-align: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'content_color',
			[
				'label' => __('Content Color', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .owl-slide-inner .elementor-slide-heading' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .owl-slide-inner .elementor-slide-description' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .owl-slide-inner .elementor-slide-item-description' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .owl-slide-inner .elementor-slide-button' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'repeater_text_shadow',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .owl-slide-contents',
				'conditions' => [
					'terms' => [
						[
							'name' => 'custom_style',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();
		$this->add_control(
			'slides',
			[
				'label' => __('Slides', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'show_label' => true,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'heading' => __('Slide 1 Heading', 'elementor-pro'),
						'description' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'elementor-pro'),
						'item_description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-pro'),
						'button_text' => __('Click Here', 'elementor-pro'),
						'background_color' => '#833ca3',
					],
					[
						'heading' => __('Slide 2 Heading', 'elementor-pro'),
						'description' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'elementor-pro'),
						'item_description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-pro'),
						'button_text' => __('Click Here', 'elementor-pro'),
						'background_color' => '#4054b2',
					],
					[
						'heading' => __('Slide 3 Heading', 'elementor-pro'),
						'description' => __('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'elementor-pro'),
						'item_description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-pro'),
						'button_text' => __('Click Here', 'elementor-pro'),
						'background_color' => '#1abc9c',
					],
				],
				'title_field' => '{{{ heading }}}',
			]
		);
		$this->add_responsive_control(
			'slides_height',
			[
				'label' => __('Height', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 400,
				],
				'size_units' => ['px', 'vh', 'em'],
				'selectors' => [
					'{{WRAPPER}} .owl-item' => 'height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __('Slider Options', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SECTION,
			]
		);
		$slides_to_show = range(1, 10);

		$slides_to_show = array_combine($slides_to_show, $slides_to_show);
		//items
		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => __('Slides to Show', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'' => __('Default', 'elementor'),
				] + $slides_to_show,
				'frontend_available' => true,
			]
		);

		// $this->add_responsive_control(
		//slideby
		$this->add_control(
			'slides_to_scroll',
			[
				'label' => __('Slides to Scroll', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => '2',
				'options' => $slides_to_show,
				'condition' => [
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
			]
		);
		//margin
		$this->add_responsive_control(
			'slides_margin',
			[
				'label' => __('Margin', 'elementor-pro'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .owl-slide-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		//loop
		$this->add_control(
			'infinite',
			[
				'label' => __('Infinite Loop', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		//center mode
		$this->add_control(
			'center_mode',
			[
				'label' => __('Center Mode', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'Divider3',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		//mousedrag
		$this->add_control(
			'mouse_drag',
			[
				'label' => __('Mouse Drag', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		//touchDrag
		$this->add_control(
			'touch_drag',
			[
				'label' => __('Touch Drag', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		//pullDrag
		$this->add_control(
			'pull_drag',
			[
				'label' => __('Pull Drag', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		//freeDrag
		$this->add_control(
			'free_drag',
			[
				'label' => __('Free Drag', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'Divider2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		//autoWidth
		$this->add_control(
			'autoWidth',
			[
				'label' => __('Auto Width', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		//nav
		$this->add_control(
			'slides_nav',
			[
				'label' => __('Nav', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		//rewind
		$this->add_control(
			'slides_rewind',
			[
				'label' => __('Rewind', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		//dots
		$this->add_control(
			'slides_dots',
			[
				'label' => __('Dots', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'Divider1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __('Autoplay', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'autoplay_speed',
			[
				'label' => __('Autoplay Speed', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'condition' => [
					'autoplay!' => '',

				],
				'selectors' => [
					'{{WRAPPER}} .owl-slide' => 'transition-duration: calc({{VALUE}}ms*1.2)',
				],
				'frontend_available' => true,
				'default' => '30',
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label' => __('Pause on Hover', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'autoplay!' => '',
				],
			]
		);
		// $this->add_control(
		// 	'responsive'
		// );
		// $this->add_control(
		// 	'autoplay_Timeout',
		// 	[
		// 		'label' => __('Autoplay Timeout', 'elementor-pro'),
		// 		'type' => \Elementor\Controls_Manager::NUMBER,
		// 		'default' => 5000,
		// 		'frontend_available' => true,
		// 		'condition' => [
		// 			'autoplay!' => '',
		// 		],
		// 	]
		// );

		// $this->add_control(
		// 	'slideTransition',
		// 	[
		// 		'label' => __('Transition', 'elementor-pro'),
		// 		'type' => \Elementor\Controls_Manager::SELECT,
		// 		'default' => 'slide',
		// 		'options' => [
		// 			'slide' => __('Slide', 'elementor-pro'),
		// 			'fade' => __('Fade', 'elementor-pro'),
		// 		],
		// 		'frontend_available' => true,
		// 	]
		// );

		$this->add_control(
			'transition_speed',
			[
				'label' => __('Transition Speed', 'elementor-pro') . ' (ms)',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 500,
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'slide_transition',
			[
				'label' => __('Slide Transition', 'elementor-pro'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'linear',
				'options' => [
					'' => __('None', 'elementor-pro'),
					'linear' => __('Linear', 'elementor-pro'),
					'ease' => __('Ease', 'elementor-pro'),
					'ease-in-out' => __('Ease In Out', 'elementor-pro'),
					'ease-in' => __('Ease In', 'elementor-pro'),
					'ease-out' => __('Ease Out', 'elementor-pro'),
				],
			]
		);

		$this->end_controls_section();

		//style section
		$this->start_controls_section(
			'section_style_slides',
			[
				'label' => __('Slides', 'elementor-pro'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		//slider style
		$this->add_responsive_control(
			'content_max_width',
			[
				'label' => __('Content Width', 'elementor-pro'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['%', 'px'],
				'default' => [
					'size' => '66',
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .owl-slide-contents' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'slides_padding',
			[
				'label' => __('Padding', 'elementor-pro'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .owl-slide-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'slides_horizontal_position',
			[
				'label' => __('Horizontal Position', 'elementor-pro'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor-pro'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'elementor-pro'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'elementor-pro'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor--h-position-',
			]
		);
		$this->add_control(
			'slides_vertical_position',
			[
				'label' => __('Vertical Position', 'elementor-pro'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'middle',
				'options' => [
					'top' => [
						'title' => __('Top', 'elementor-pro'),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __('Middle', 'elementor-pro'),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __('Bottom', 'elementor-pro'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'elementor--v-position-',
			]
		);
		$this->add_control(
			'slides_text_align',
			[
				'label' => __('Text Align', 'elementor-pro'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor-pro'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'elementor-pro'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'elementor-pro'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .owl-slide-inner' => 'text-align: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .owl-slide-contents',
			]
		);

		$this->end_controls_section();
		//title style
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __('Title', 'elementor-pro'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'heading_spacing',
			[
				'label' => __('Spacing', 'elementor-pro'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-slide-inner .elementor-slide-heading:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label' => __('Text Color', 'elementor-pro'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-heading' => 'color: {{VALUE}}',

				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementor-slide-heading',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_description',
			[
				'label' => __('Description', 'elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_spacing',
			[
				'label' => __('Spacing', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-slide-inner .elementor-slide-description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __('Text Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-description' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'scheme' => Schemes\Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .elementor-slide-description',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'section_style',
			[
				'label' => __('Text Editor', 'elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __('Alignment', 'elementor'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'elementor'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'elementor'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __('Justified', 'elementor'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __('Text Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

		$text_columns = range(1, 10);
		$text_columns = array_combine($text_columns, $text_columns);
		$text_columns[''] = __('Default', 'elementor');

		$this->add_responsive_control(
			'text_columns',
			[
				'label' => __('Columns', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'options' => $text_columns,
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'columns: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[
				'label' => __('Columns Gap', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'vw'],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'%' => [
						'max' => 10,
						'step' => 0.1,
					],
					'vw' => [
						'max' => 10,
						'step' => 0.1,
					],
					'em' => [
						'max' => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-text-editor' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_spacing',
			[
				'label' => __('Spacing', 'elementor-pro'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .owl-slide-inner .elementor-slide-item-description:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __('Button', 'elementor-pro'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => __('Size', 'elementor-pro'),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __('Text Color', 'elementor-pro'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'color: {{VALUE}}; border-color: {{VALUE}}',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .elementor-slide-button',
				'scheme' => Schemes\Typography::TYPOGRAPHY_4,
			]
		);

		$this->add_control(
			'button_border_width',
			[
				'label' => __('Border Width', 'elementor-pro'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' => __('Border Radius', 'elementor-pro'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs('button_tabs');

		$this->start_controls_tab('normal', ['label' => __('Normal', 'elementor-pro')]);

		$this->add_control(
			'button_text_color',
			[
				'label' => __('Text Color', 'elementor-pro'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __('Background Color', 'elementor-pro'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' => __('Border Color', 'elementor-pro'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('hover', ['label' => __('Hover', 'elementor-pro')]);

		$this->add_control(
			'button_hover_text_color',
			[
				'label' => __('Text Color', 'elementor-pro'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_background_color',
			[
				'label' => __('Background Color', 'elementor-pro'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => __('Border Color', 'elementor-pro'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-slide-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => __('Navigation', 'elementor-pro'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => ['arrows', 'dots', 'both'],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label' => __('Arrows', 'elementor-pro'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label' => __('Arrows Position', 'elementor-pro'),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'inside' => __('Inside', 'elementor-pro'),
					'outside' => __('Outside', 'elementor-pro'),
				],
				'prefix_class' => 'elementor-arrows-position-',
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label' => __('Arrows Size', 'elementor-pro'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-owl-button' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label' => __('Arrows Color', 'elementor-pro'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-owl-button' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => ['arrows', 'both'],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label' => __('Dots', 'elementor-pro'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label' => __('Dots Position', 'elementor-pro'),
				'type' => Controls_Manager::SELECT,
				'default' => 'inside',
				'options' => [
					'outside' => __('Outside', 'elementor-pro'),
					'inside' => __('Inside', 'elementor-pro'),
				],
				'prefix_class' => 'elementor-pagination-position-',
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => __('Dots Size', 'elementor-pro'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 15,
					],
				],
				// 'selectors' => [
				// 	'{{WRAPPER}} .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
				// 	'{{WRAPPER}} .swiper-container-horizontal .swiper-pagination-progressbar' => 'height: {{SIZE}}{{UNIT}}',
				// 	'{{WRAPPER}} .swiper-pagination-fraction' => 'font-size: {{SIZE}}{{UNIT}}',
				// ],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label' => __('Dots Color', 'elementor-pro'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .owl-dot .active' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => ['dots', 'both'],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{

		$settings = $this->get_settings_for_display();
		if (empty($settings['slides'])) {
			return;
		}

		$this->add_render_attribute('button', 'class', ['elementor-button', 'elementor-slide-button']);

		if (!empty($settings['button_size'])) {
			$this->add_render_attribute('button', 'class', 'elementor-size-' . $settings['button_size']);
		}

		$slides = [];
		$slide_count = 0;

?>
		<div class="owl-carousel" data-owl-carousel='{
			 
			"items": <?php echo $settings['slides_to_show'] ?>, 
			"loop":<?php if ($settings['infinite'] == 'yes') {
						echo 'true';
					} else {
						echo 'false';
					}
					?>,
			"center":<?php if ($settings['center_mode'] == 'yes') {
							echo 'true';
						} else {
							echo 'false';
						}
						?>,
			"mouseDrag":<?php if ($settings['mouse_drag'] == 'yes') {
							echo 'true';
						} else {
							echo 'false';
						}
						?>,
			"touchDrag":<?php if ($settings['touch_drag'] == 'yes') {
							echo 'true';
						} else {
							echo 'false';
						}
						?>,
			"pullDrag":<?php if ($settings['pull_drag'] == 'yes') {
							echo 'true';
						} else {
							echo 'false';
						}
						?>,
			"freeDrag":<?php if ($settings['free_drag'] == 'yes') {
							echo 'true';
						} else {
							echo 'false';
						}
						?>,
			"autoWidth":<?php if ($settings['autoWidth'] == 'yes') {
							echo 'true';
						} else {
							echo 'false';
						}
						?>,
			"nav":<?php if ($settings['slides_nav'] == 'yes') {
						echo 'true';
					} else {
						echo 'false';
					}
					?>,
			"dots":<?php if ($settings['slides_dots'] == 'yes') {
						echo 'true';
					} else {
						echo 'false';
					}
					?>,
			"autoplay":<?php if ($settings['autoplay'] == 'yes') {
							echo 'true';
						} else {
							echo 'false';
						}
						?>,
			"autoplayHoverPause":<?php if ($settings['pause_on_hover'] == 'yes') {
										echo 'true';
									} else {
										echo 'false';
									}
									?>,
			"autoplaySpeed": <?php if ($settings['autoplay'] == 'yes') {
									echo $settings['autoplay_speed'];
								} else {
									echo 'false';
								} ?>,
			"slideTransition": <?php switch ($settings['slide_transition']) {
									case "linear":
										echo '"linear"';
										break;
									case "ease":
										echo '"ease"';
										break;
									case "ease-in-out":
										echo '"ease-in-out"';
										break;
									case "ease-in":
										echo '"ease-in"';
										break;
									case "ease-out":
										echo '"ease-out"';
										break;

									default:
										echo '"linear"';
								} ?>,
								"responsiveClass" : true,
								"responsive" : {
									0:{
										items:1,
										nav:true
									},
									600:{
										items:3,
										nav:false
									},
									1000:{
										items:5,
										nav:true,
										loop:false
									}
								}
								

			
		}'>
			<?php

			foreach ($settings['slides'] as $slide) {
			?>
				<div class="owl-image" style="background-image: url('<?php echo $slide['background_image']['url'] ?>');">
					<?php
					if ('yes' === $slide['background_overlay']) {
						echo '<div class="elementor-background-overlay"></div>';
					}
					echo '<div class="owl-slide-inner">';
					echo '<div class="owl-slide-contents">';
					if ($slide['heading']) {
						echo '<div class="elementor-slide-heading">' . $slide['heading'] . '</div>';
					}
					if ($slide['description']) {
						echo '<div class="elementor-slide-description">' . $slide['description'] . '</div>';
					}
					if ($slide['item_description']) {
						echo '<div class="elementor-slide-item-description">' . $slide['item_description'] . '</div>';
					}
					if ($slide['button_text']) {
						echo '<a  href="' . $slide['link']['url'] . '" ' . $this->get_render_attribute_string('button') . '>' . $slide['button_text'] . '</a>';
					}
					$slides_count = count($settings['slides']);
					echo '</div>
					</div>';
					?>
				</div>


			<?php
			}

			?>
		</div>
<?php
	}

	protected function _content_template()
	{
	}
}
