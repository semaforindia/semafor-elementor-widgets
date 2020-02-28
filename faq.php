<?php

/**
 * Elementor oEmbed Widget.aaa
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Semafor_FAQ extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'Semafor_FAQ';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Semafor_FAQ', 'plugin-name');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'fa fa-code';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['general'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => __('URL to embed', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => __('https://your-link.com', 'plugin-name'),
            ]
        );

        $this->add_control(
            'label',
            [
                'label' => __('Text', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'my_section',
            [
                'label' => __('Font', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();
    }

    /**
     * PHP Render
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $html = wp_oembed_get($settings['url']);

        echo '<div class="oembed-elementor-widget">';

        echo ($html) ? $html : $settings['url'];
        echo $settings['control-name'];

        echo '</div>';
    }

    /**
     * Javascript Render
     */
    protected function _content_template()
    {
    }
}
