<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Puzzel2_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'puzzel2';
    }

    public function get_title() {
        return __( 'Puzzel 2', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-code';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        ?>
        <div class="puzzel2-widget">
            <p><?php echo __( 'This is the Puzzel 2 widget.', 'text-domain' ); ?></p>
        </div>
        <?php
    }
}
