<?php
/**
 * FIXED WIDGET REGISTRATION SECTION
 
 */

// ========================================
// ENABLE DEBUG MODE (Remove in production)
// ========================================
if ( ! defined( 'WP_DEBUG' ) ) {
    define( 'WP_DEBUG', true );
}
if ( ! defined( 'WP_DEBUG_LOG' ) ) {
    define( 'WP_DEBUG_LOG', true );
}

// ========================================
// CENTRALIZED WIDGET REGISTRATION FUNCTION
// ========================================
function register_all_custom_elementor_widgets( $widgets_manager ) {
    
    // Array of widgets to register [file => class_name]
    $widgets = [
        'gallery-widget.php'                => 'Elementor_Gallery_Widget',
        'quiz-widget.php'                   => 'Elementor_Quiz_Widget',
        'elementor-FAQ-widget.php'          => 'Elementor_FAQ_Widget',
        'elementor-Scroll-Reveal2-widget.php' => 'Elementor_Scroll_Reveal2_Widget',
        'elementor-testimonials-widget.php' => 'Elementor_Testimonials_Widget',
        'elementor-header-widget.php'       => 'Custom_Header_Widget',
        'elementor-hero1-widget.php'        => 'Elementor_Hero1_Widget',
        'elementor-hero2-widget.php'        => 'Elementor_Hero2_Widget',
        'elementor-logotick-widget.php'     => 'Elementor_Logotick_Widget',
        'elementor-Hero4-widget.php'        => 'Elementor_Hero4_Widget',
        'elementor-scroll-reveal-widget.php' => 'Elementor_Scroll_Reveal_Widget',
        'Elementor-TimelineReveal-widget.php' => 'Elementor_Timeline_Reveal_Widget',
        'elementor-Custom-Heading-Widget.php' => 'Custom_Elementor_Heading_Widget',
        'elementor-Highlighted-Text-Widget.php' => 'Highlighted_Text_Widget',
        'circle-widget.php'                 => 'Elementor_Circle_Widget',
        'stacked-cards-widget.php'          => 'Elementor_Stacked_Cards_Widget',
        'coaches-widget.php'                => 'Elementor_Coaches_Widget',
        '3cards-widget.php'                 => 'Elementor_3Cards_Widget',
        'puzzle-widget.php'                 => 'Elementor_Puzzle_Widget',
        'showcase-widget.php'               => 'Elementor_Showcase_Widget',
        'pricing-widget.php'                => 'Elementor_Pricing_Widget',
        'footer-widget.php'                 => 'Elementor_Footer_Widget',
        'blog-widget.php'                   => 'Elementor_Blog_Widget',
        'button2-widget.php'                => 'Elementor_Button2_Widget',
        'puzzel2-widget.php'                => 'Elementor_Puzzel2_Widget',
        'slide-card-widget.php'             => 'Elementor_Slide_Card_Widget',
        'oneslide-widget.php'               => 'Oneslide_Widget',
        'timeline2-widget.php'              => 'Timeline2_Widget',
        'scroll2-widget.php'                => 'Scroll2_Widget',
    ];

    $includes_dir = get_stylesheet_directory() . '/includes/';
    $registered_count = 0;
    $failed_count = 0;

    foreach ( $widgets as $file => $class_name ) {
        $file_path = $includes_dir . $file;
        
        // Check if file exists
        if ( ! file_exists( $file_path ) ) {
            error_log( "❌ Widget file not found: {$file}" );
            $failed_count++;
            continue;
        }

        // Include the file
        require_once $file_path;

        // Check if class exists
        if ( ! class_exists( $class_name ) ) {
            error_log( "❌ Widget class '{$class_name}' not found in {$file}" );
            $failed_count++;
            continue;
        }

        // Register the widget
        try {
            $widgets_manager->register( new $class_name() );
            error_log( "✅ Successfully registered: {$class_name}" );
            $registered_count++;
        } catch ( Exception $e ) {
            error_log( "❌ Failed to register {$class_name}: " . $e->getMessage() );
            $failed_count++;
        }
    }

    error_log( "========================================" );
    error_log( "Widget Registration Summary:" );
    error_log( "Registered: {$registered_count}" );
    error_log( "Failed: {$failed_count}" );
    error_log( "========================================" );
}
add_action( 'elementor/widgets/register', 'register_all_custom_elementor_widgets' );

// ========================================
// ENQUEUE ALL WIDGET ASSETS
// ========================================
function enqueue_all_widget_assets() {
    
    $child_theme_uri = get_stylesheet_directory_uri();
    $child_theme_dir = get_stylesheet_directory();

    // CSS Files
    $css_files = [
        'testimonials'  => '/css/testimonials.css',
        'faq'           => '/assets/css/faq.css',
        'hero1'         => '/hero1.css',
        'hero2'         => '/css/hero2.css',
        'header'        => '/header.css',
        'logotick'      => '/CSS/logotick.css',
        'circle'        => '/css/circle.css',
        'coaches'       => '/css/coaches.css',
        'pricing'       => '/css/pricing.css',
    ];

    foreach ( $css_files as $handle => $path ) {
        $full_path = $child_theme_dir . $path;
        if ( file_exists( $full_path ) ) {
            wp_enqueue_style( 
                $handle . '-css', 
                $child_theme_uri . $path, 
                [], 
                filemtime( $full_path ) 
            );
        } else {
            error_log( "⚠️ CSS file not found: {$path}" );
        }
    }

    // JavaScript Files
    $js_files = [
        'testimonials'      => '/js/testimonials.js',
        'faq'               => '/assets/js/faq.js',
        'hero1'             => '/hero1.js',
        'header'            => '/header.js',
        'logotick'          => '/JS/logotick.js',
        'circle-animation'  => '/js/circle-animation.js',
        'coaches'           => '/js/coaches.js',
        'pricing'           => '/js/pricing.js',
        'stacked-cards'     => '/includes/stacked-cards.js',
    ];

    foreach ( $js_files as $handle => $path ) {
        $full_path = $child_theme_dir . $path;
        if ( file_exists( $full_path ) ) {
            wp_enqueue_script( 
                $handle . '-js', 
                $child_theme_uri . $path, 
                ['jquery'], 
                filemtime( $full_path ), 
                true 
            );
        } else {
            error_log( "⚠️ JS file not found: {$path}" );
        }
    }

    // External Libraries
    wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', [], '3.12.2', true );
    wp_enqueue_script( 'scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', ['gsap'], '3.12.2', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_all_widget_assets' );

// ========================================
// ADMIN DEBUG PANEL
// ========================================
function custom_widgets_debug_panel() {
    if ( ! current_user_can( 'administrator' ) || ! isset( $_GET['debug_widgets'] ) ) {
        return;
    }

    $includes_dir = get_stylesheet_directory() . '/includes/';
    $registered_widgets = \Elementor\Plugin::instance()->widgets_manager->get_widget_types();
    
    ?>
    <div style="position: fixed; top: 32px; right: 20px; background: white; padding: 20px; border: 2px solid #0073aa; z-index: 999999; max-width: 400px; max-height: 80vh; overflow-y: auto; box-shadow: 0 5px 25px rgba(0,0,0,0.2);">
        <h3 style="margin-top: 0; color: #0073aa;">🔧 Widget Debug Panel</h3>
        
        <h4>📋 Registered Widgets (<?php echo count( $registered_widgets ); ?>)</h4>
        <ul style="font-size: 12px; line-height: 1.6;">
            <?php foreach ( $registered_widgets as $widget_name => $widget_instance ) : ?>
                <li><strong><?php echo esc_html( $widget_name ); ?></strong></li>
            <?php endforeach; ?>
        </ul>

        <h4>📁 Widget Files</h4>
        <ul style="font-size: 12px; line-height: 1.6;">
            <?php
            $files = glob( $includes_dir . '*-widget.php' );
            foreach ( $files as $file ) {
                $filename = basename( $file );
                $exists = file_exists( $file ) ? '✅' : '❌';
                echo "<li>{$exists} {$filename}</li>";
            }
            ?>
        </ul>

        <h4>🔌 Elementor Status</h4>
        <ul style="font-size: 12px;">
            <li>Active: <?php echo did_action( 'elementor/loaded' ) ? '✅ Yes' : '❌ No'; ?></li>
            <li>Version: <?php echo defined( 'ELEMENTOR_VERSION' ) ? ELEMENTOR_VERSION : 'N/A'; ?></li>
        </ul>

        <p style="font-size: 11px; color: #666; margin-top: 15px;">
            Check <code>wp-content/debug.log</code> for detailed error messages
        </p>
    </div>
    <?php
}
add_action( 'wp_footer', 'custom_widgets_debug_panel' );
add_action( 'admin_footer', 'custom_widgets_debug_panel' );

// ========================================
// TROUBLESHOOTING: List All Registered Widgets
// ========================================
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    $registered = \Elementor\Plugin::instance()->widgets_manager->get_widget_types();
    error_log( '📋 Total Registered Elementor Widgets: ' . count( $registered ) );
    error_log( '📋 Custom Widget Names: ' . implode( ', ', array_keys( $registered ) ) );
}, 999 );