<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Button2_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'button2';
    }

    public function get_title() {
        return __( 'Button 2', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        ?>
        <div class="button2-widget">
            <p><?php echo __( 'This is the Button 2 widget.', 'text-domain' ); ?></p>
        </div>
        <?php
    }
}
