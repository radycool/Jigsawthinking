<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Slide_Card_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'slide_card';
    }

    public function get_title() {
        return __( 'Slide Card', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        ?>
        <div class="slide-card-widget">
            <p><?php echo __( 'This is the Slide Card widget.', 'text-domain' ); ?></p>
        </div>
        <?php
    }
}
