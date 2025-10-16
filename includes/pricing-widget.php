<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Pricing_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'pricing';
    }

    public function get_title() {
        return __( 'Pricing', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-money';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        ?>
        <div class="pricing-widget">
            <p><?php echo __( 'This is the Pricing widget.', 'text-domain' ); ?></p>
        </div>
        <?php
    }
}
