<?php

// use \Elementor\Controls_Manager;
// Group_Control_Image_Size::get_type()

class Demo extends \Elementor\Widget_Base
{


    public function get_name()
    {
        return 'demo';
    }

    public function get_title()
    {
        return __('Demo', 'plugin-name');
    }

    public function get_icon()
    {
        return 'fas fa-laptop-code';
    }

    public function get_categories()
    {
        return ['sew'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // $this->add_control(
        //     'heading',
        //     [
        //         'label' => __('Heading', 'plugin-name'),
        //         'type' => \Elementor\Controls_Manager::HEADING,
        //     ]
        // );
        // $this->add_control(
        //     'widget_title',
        //     [
        //         'label' => __('Title', 'plugin-domain'),
        //         'type' => \Elementor\Controls_Manager::TEXT,
        //         'default' => __('Default title', 'plugin-domain'),
        //         'placeholder' => __('Type your title here', 'plugin-domain'),
        //     ]
        // );
        // $this->add_control(
        //     'hr',
        //     [
        //         'type' => \Elementor\Controls_Manager::DIVIDER,
        //     ]
        // );

        // $this->add_control(
        //     'important_note',
        //     [
        //         'label' => __('Important Note', 'plugin-name'),
        //         'type' => \Elementor\Controls_Manager::RAW_HTML,
        //         'raw' => __('A very important message to show in the panel.', 'plugin-name'),
        //         'content_classes' => 'your-class',
        //     ]
        // );

        // $this->add_control(
        //     'hr',
        //     [
        //         'type' => \Elementor\Controls_Manager::DIVIDER,
        //     ]
        // );

        // $this->add_control(
        //     'delete_content',
        //     [
        //         'label' => __('Delete Content', 'plugin-name'),
        //         'type' => \Elementor\Controls_Manager::BUTTON,
        //         'separator' => 'before',
        //         'button_type' => 'success',
        //         'text' => __('Delete', 'plugin-domain'),
        //         'event' => 'namespace:editor:delete',
        //     ]
        // );

        // $this->add_control(
        //     'hr',
        //     [
        //         'type' => \Elementor\Controls_Manager::DIVIDER,
        //     ]
        // );

        $this->add_control(
            'data_control_heading',
            [
                'label' => __('Data Controls', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'control_text',
            [
                'label' => __('Text', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Default title', 'plugin-domain'),
                'placeholder' => __('Type your title here', 'plugin-domain'),
            ]
        );

        $this->add_control(
            'control_number',
            [
                'label' => __('Number', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 5,
                'max' => 100,
                'step' => 5,
                'default' => 10,
            ]
        );

        $this->add_control(
            'control_textarea',
            [
                'label' => __('Text Area', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => __('Default description', 'plugin-domain'),
                'placeholder' => __('Type your description here', 'plugin-domain'),
            ]
        );

        $this->add_control(
            'control_wysiwyg',
            [
                'label' => __('WYSIWYG', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Default description', 'plugin-domain'),
                'placeholder' => __('Type your description here', 'plugin-domain'),
            ]
        );

        $this->add_control(
            'control_code',
            [
                'label' => __('Code', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::CODE,
                'language' => 'html',
                'rows' => 20,
            ]
        );



        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->end_controls_section();
        // $this->start_controls_section(
        //     'content_section',
        //     [
        //         'label' => __('Content', 'plugin-name'),
        //         'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        //     ]
        // );

        // $this->add_control(
        //     'image',
        //     [
        //         'label' => __('Choose Image', 'elementor'),
        //         'type' => \Elementor\Controls_Manager::MEDIA,
        //         'default' => [
        //             'url' => \Elementor\Utils::get_placeholder_image_src(),
        //         ],
        //     ]
        // );

        // $this->add_group_control(
        //     Group_Control_Image_Size::get_type(),
        //     [
        //         'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
        //         'exclude' => ['custom'],
        //         'include' => [],
        //         'default' => 'large',
        //     ]
        // );

        // $this->end_controls_section();
    }

    protected function render()
    {
    }

    protected function _content_template()
    {
    }
}
