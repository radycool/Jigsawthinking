<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Elementor_Quiz_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'quiz';
    }

    public function get_title() {
        return __( 'Quiz', 'text-domain' );
    }

    public function get_icon() {
        return 'eicon-editor-list-ol';
    }

    public function get_categories() {
        return [ 'general' ];
    }

    protected function render() {
        ?>
        <div class="quiz-widget">
            <p><?php echo __( 'This is the Quiz widget.', 'text-domain' ); ?></p>
        </div>
        <?php
    }
}
