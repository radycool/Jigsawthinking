<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Gallery_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'gallery';
    }

    public function get_title() {
        return __( 'Gallery', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        ?>
        <div class="gallery-widget">
            <p><?php echo __( 'This is the Gallery widget.', 'text-domain' ); ?></p>
        </div>
        <?php
    }
}
