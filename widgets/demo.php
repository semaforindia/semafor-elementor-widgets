<?php

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
        return 'fa fa-code';
    }

    public function get_categories()
    {
        return ['sew'];
    }

    protected function _register_controls()
    {

        
    }

    protected function render()
    {

       
    }

    protected function _content_template()
    {
    }
}
