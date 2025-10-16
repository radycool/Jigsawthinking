<?php
// Enqueue parent + child styles
function hello_elementor_child_enqueue_styles() {
    wp_enqueue_style( 'hello-elementor-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'hello-elementor-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('hello-elementor-style')
    );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_styles' );

// Enqueue testimonials scripts and styles
function enqueue_testimonials_assets() {
    wp_enqueue_style('testimonials-css', get_stylesheet_directory_uri() . '/css/testimonials.css', array(), '1.0.0');
    wp_enqueue_script('testimonials-js', get_stylesheet_directory_uri() . '/js/testimonials.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_testimonials_assets');

// Create custom post type for testimonials
function create_testimonials_post_type() {
    $args = array(
        'public' => true,
        'label' => 'Testimonials',
        'labels' => array(
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial',
            'add_new' => 'Add New Testimonial',
            'add_new_item' => 'Add New Testimonial',
            'edit_item' => 'Edit Testimonial',
            'new_item' => 'New Testimonial',
            'view_item' => 'View Testimonial',
            'search_items' => 'Search Testimonials',
            'not_found' => 'No testimonials found',
            'not_found_in_trash' => 'No testimonials found in trash'
        ),
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote',
        'show_in_rest' => true,
    );
    register_post_type('testimonial', $args);
}
add_action('init', 'create_testimonials_post_type');

// Add meta boxes for testimonial details
function add_testimonials_meta_boxes() {
    add_meta_box(
        'testimonial_details',
        'Testimonial Details',
        'testimonial_details_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_testimonials_meta_boxes');

// Meta box callback function
function testimonial_details_callback($post) {
    wp_nonce_field('testimonial_details_nonce', 'testimonial_details_nonce');
    
    $name = get_post_meta($post->ID, '_testimonial_name', true);
    $designation = get_post_meta($post->ID, '_testimonial_designation', true);
    $company = get_post_meta($post->ID, '_testimonial_company', true);
    $video_url = get_post_meta($post->ID, '_testimonial_video_url', true);
    $background_color = get_post_meta($post->ID, '_testimonial_bg_color', true);
    $text_color = get_post_meta($post->ID, '_testimonial_text_color', true);
    $testimonial_type = get_post_meta($post->ID, '_testimonial_type', true);
    
    ?>
    <table class="form-table">
        <tr>
            <th><label for="testimonial_name">Name</label></th>
            <td><input type="text" id="testimonial_name" name="testimonial_name" value="<?php echo esc_attr($name); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="testimonial_designation">Designation</label></th>
            <td><input type="text" id="testimonial_designation" name="testimonial_designation" value="<?php echo esc_attr($designation); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="testimonial_company">Company</label></th>
            <td><input type="text" id="testimonial_company" name="testimonial_company" value="<?php echo esc_attr($company); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="testimonial_type">Testimonial Type</label></th>
            <td>
                <select id="testimonial_type" name="testimonial_type">
                    <option value="text" <?php selected($testimonial_type, 'text'); ?>>Text Testimonial</option>
                    <option value="video" <?php selected($testimonial_type, 'video'); ?>>Video Testimonial</option>
                </select>
            </td>
        </tr>
        <tr id="video_url_row" style="<?php echo ($testimonial_type !== 'video') ? 'display:none;' : ''; ?>">
            <th><label for="testimonial_video_url">Video URL</label></th>
            <td><input type="url" id="testimonial_video_url" name="testimonial_video_url" value="<?php echo esc_attr($video_url); ?>" class="regular-text" />
                <p class="description">YouTube, Vimeo, or direct video file URL</p>
            </td>
        </tr>
        <tr id="bg_color_row" style="<?php echo ($testimonial_type !== 'text') ? 'display:none;' : ''; ?>">
            <th><label for="testimonial_bg_color">Background Color</label></th>
            <td><input type="color" id="testimonial_bg_color" name="testimonial_bg_color" value="<?php echo esc_attr($background_color ?: '#00d4aa'); ?>" /></td>
        </tr>
        <tr id="text_color_row" style="<?php echo ($testimonial_type !== 'text') ? 'display:none;' : ''; ?>">
            <th><label for="testimonial_text_color">Text Color</label></th>
            <td><input type="color" id="testimonial_text_color" name="testimonial_text_color" value="<?php echo esc_attr($text_color ?: '#ffffff'); ?>" /></td>
        </tr>
    </table>
    
    <script>
    jQuery(document).ready(function($) {
        $('#testimonial_type').change(function() {
            if ($(this).val() === 'video') {
                $('#video_url_row').show();
                $('#bg_color_row, #text_color_row').hide();
            } else {
                $('#video_url_row').hide();
                $('#bg_color_row, #text_color_row').show();
            }
        });
    });
    </script>
    <?php
}

// Save meta box data
function save_testimonial_details($post_id) {
    if (!isset($_POST['testimonial_details_nonce']) || !wp_verify_nonce($_POST['testimonial_details_nonce'], 'testimonial_details_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array(
        'testimonial_name',
        'testimonial_designation',
        'testimonial_company',
        'testimonial_video_url',
        'testimonial_bg_color',
        'testimonial_text_color',
        'testimonial_type'
    );
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'save_testimonial_details');

// Shortcode to display testimonials
function testimonials_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 5,
        'columns' => 5,
    ), $atts);
    
    $testimonials = new WP_Query(array(
        'post_type' => 'testimonial',
        'posts_per_page' => $atts['limit'],
        'post_status' => 'publish'
    ));
    
    ob_start();
    
    if ($testimonials->have_posts()) :
        ?>
        <div class="testimonials-section">
            <h2 class="testimonials-title">Testimonials</h2>
            <div class="testimonials-container" data-columns="<?php echo esc_attr($atts['columns']); ?>">
                <?php while ($testimonials->have_posts()) : $testimonials->the_post();
                    $name = get_post_meta(get_the_ID(), '_testimonial_name', true);
                    $designation = get_post_meta(get_the_ID(), '_testimonial_designation', true);
                    $company = get_post_meta(get_the_ID(), '_testimonial_company', true);
                    $video_url = get_post_meta(get_the_ID(), '_testimonial_video_url', true);
                    $bg_color = get_post_meta(get_the_ID(), '_testimonial_bg_color', true) ?: '#00d4aa';
                    $text_color = get_post_meta(get_the_ID(), '_testimonial_text_color', true) ?: '#ffffff';
                    $type = get_post_meta(get_the_ID(), '_testimonial_type', true) ?: 'text';
                ?>
                    <div class="testimonial-card" 
                         data-type="<?php echo esc_attr($type); ?>"
                         data-bg-color="<?php echo esc_attr($bg_color); ?>"
                         data-text-color="<?php echo esc_attr($text_color); ?>"
                         data-video-url="<?php echo esc_attr($video_url); ?>">
                        
                        <div class="testimonial-preview">
                            <div class="testimonial-info">
                                <h3 class="testimonial-name"><?php echo esc_html($name); ?></h3>
                                <p class="testimonial-designation"><?php echo esc_html($designation); ?></p>
                                <?php if ($company) : ?>
                                    <p class="testimonial-company"><?php echo esc_html($company); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="testimonial-content">
                            <?php if ($type === 'video' && $video_url) : ?>
                                <div class="testimonial-video">
                                    <?php echo wp_oembed_get($video_url); ?>
                                </div>
                            <?php else : ?>
                                <div class="testimonial-text" style="background-color: <?php echo esc_attr($bg_color); ?>; color: <?php echo esc_attr($text_color); ?>;">
                                    <div class="testimonial-quote">
                                        <?php the_content(); ?>
                                    </div>
                                    <div class="testimonial-author">
                                        <strong><?php echo esc_html($name); ?></strong>
                                        <span><?php echo esc_html($designation); ?><?php echo $company ? ', ' . esc_html($company) : ''; ?></span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php
    endif;
    
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('testimonials', 'testimonials_shortcode');

// Register Elementor Testimonials Widget
function register_testimonials_elementor_widget() {
    // Check if Elementor is active
    if (!did_action('elementor/loaded')) {
        return;
    }

    // Include the widget file
    $widget_file = get_stylesheet_directory() . '/includes/elementor-testimonials-widget.php';
    
    if (file_exists($widget_file)) {
        require_once($widget_file);
        
        // Register the widget
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor_Testimonials_Widget());
        
        // Debug success
        error_log('✅ Testimonials Widget registered successfully!');
    } else {
        // Debug file not found
        error_log('❌ Widget file not found at: ' . $widget_file);
    }
}
add_action('elementor/widgets/widgets_registered', 'register_testimonials_elementor_widget');

// Enqueue FAQ assets
function enqueue_faq_assets() {
    wp_enqueue_style('faq-style', get_stylesheet_directory_uri() . '/assets/css/faq.css', [], '1.0.0');
    wp_enqueue_script('faq-script', get_stylesheet_directory_uri() . '/assets/js/faq.js', ['jquery'], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_faq_assets');

// Register Elementor FAQ Widget
function register_faq_elementor_widget( $widgets_manager ) {
    $widget_file = get_stylesheet_directory() . '/includes/elementor-FAQ-widget.php';
    if (file_exists($widget_file)) {
        require_once $widget_file;
        $widgets_manager->register(new Elementor_FAQ_Widget());
    } else {
        error_log('FAQ Widget file missing: ' . $widget_file);
    }
}
add_action('elementor/widgets/register', 'register_faq_elementor_widget');

// Add Elementor Widget Categories
function add_custom_elementor_widget_categories($elements_manager) {
    $elements_manager->add_category(
        'custom-widgets',
        [
            'title' => __('Custom Widgets', 'textdomain'),
            'icon' => 'fa fa-plug',
        ]
    );
    
    $elements_manager->add_category(
        'theme',
        [
            'title' => esc_html__('Theme Elements', 'textdomain'),
            'icon' => 'eicon-header',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'add_custom_elementor_widget_categories');

// FAQ Shortcode Registration
function faq_section_shortcode($atts) {
    // Make sure assets are loaded when shortcode is used
    enqueue_faq_assets();
    
    $atts = shortcode_atts([
        'title' => 'FAQ',
        'subtitle' => 'Any queries you might have',
        'class' => ''
    ], $atts);
    
    // Default FAQ data - customize this with your actual FAQs
    $default_faqs = [
        [
            'faq_question' => 'How does the coaching program work?',
            'faq_answer' => 'Our coaching program is designed to help you achieve your goals through personalized guidance and support.'
        ],
        [
            'faq_question' => 'What is included in the program?',
            'faq_answer' => 'The program includes weekly sessions, resources, and ongoing support to ensure your success.'
        ],
        [
            'faq_question' => 'How long is the program?',
            'faq_answer' => 'The standard program duration is 12 weeks, but can be customized based on your needs.'
        ],
        [
            'faq_question' => 'Can I get a refund?',
            'faq_answer' => 'Yes, we offer a 30-day money-back guarantee if you are not satisfied with the program.'
        ],
        [
            'faq_question' => 'Is there group coaching available?',
            'faq_answer' => 'We offer both individual and group coaching sessions to suit different learning preferences.'
        ],
        [
            'faq_question' => 'How do I get started?',
            'faq_answer' => 'Simply click the sign-up button and complete our brief questionnaire to begin your journey.'
        ],
    ];
    
    ob_start();
    ?>
    <div class="faq-container <?php echo esc_attr($atts['class']); ?>">
        <div class="faq-header">
            <h2 class="faq-title"><?php echo esc_html($atts['title']); ?></h2>
            <p class="faq-subtitle"><?php echo esc_html($atts['subtitle']); ?></p>
        </div>
        
        <div class="faq-layout">
            <div class="faq-grid">
                <?php foreach ($default_faqs as $index => $faq) : ?>
                    <div class="faq-item" data-index="<?php echo $index; ?>">
                        <h3 class="faq-question"><?php echo esc_html($faq['faq_question']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="faq-expanded-container">
                <div class="faq-expanded">
                    <div class="faq-expanded-content">
                        <h3 class="faq-expanded-title"><?php echo esc_html($atts['title']); ?></h3>
                        <p class="faq-expanded-subtitle"><?php echo esc_html($atts['subtitle']); ?></p>
                        <div class="faq-expanded-question"></div>
                        <div class="faq-expanded-answer"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="application/json" class="faq-data">
            <?php echo json_encode($default_faqs); ?>
        </script>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('faq_section', 'faq_section_shortcode');

// Template function for direct use in theme files
function display_faq_section($title = 'FAQ', $subtitle = 'Any queries you might have') {
    echo faq_section_shortcode(['title' => $title, 'subtitle' => $subtitle]);
}

// Remove Hello Elementor default header (consolidated)
function remove_hello_elementor_header() {
    // Remove header actions
    remove_action('hello_elementor_header', 'hello_elementor_header_layout');
    remove_action('hello_elementor_header', 'hello_elementor_header_navigation');
    
    // Remove header entirely
    remove_all_actions('hello_elementor_header');
}
add_action('init', 'remove_hello_elementor_header');

// Register Custom Header Elementor Widget (consolidated)
function register_custom_header_elementor_widget() {
    // Check if Elementor is installed and activated
    if (!did_action('elementor/loaded')) {
        add_action('admin_notices', function() {
            echo '<div class="notice notice-warning is-dismissible"><p>Custom Header Widget requires Elementor to be installed and activated.</p></div>';
        });
        return;
    }
    
    // Include the widget file
    $widget_file = get_stylesheet_directory() . '/includes/elementor-header-widget.php';
    if (file_exists($widget_file)) {
        require_once $widget_file;
    }
}
add_action('elementor/widgets/widgets_registered', 'register_custom_header_elementor_widget');
add_action('elementor/init', 'register_custom_header_elementor_widget');

// Enqueue header assets - FIXED VERSION
function enqueue_custom_header_assets() {
    $css_path = get_stylesheet_directory() . '/header.css';
    $js_path = get_stylesheet_directory() . '/header.js';
    
    // Check if files exist before using filemtime
    $css_version = file_exists($css_path) ? filemtime($css_path) : '1.0.0';
    $js_version = file_exists($js_path) ? filemtime($js_path) : '1.0.0';
    
    wp_register_style(
        'custom-header-style',
        get_stylesheet_directory_uri() . '/header.css',
        [],
        $css_version
    );
    
    wp_register_script(
        'custom-header-script',
        get_stylesheet_directory_uri() . '/header.js',
        ['jquery'],
        $js_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_custom_header_assets');

// Add body classes for header context
function add_custom_header_body_classes($classes) {
    $classes[] = 'has-custom-header';
    
    // Check if we're on a page with dark sections
    if (has_post_thumbnail() || is_front_page()) {
        $classes[] = 'has-hero-section';
    }
    
    return $classes;
}
add_filter('body_class', 'add_custom_header_body_classes');

// Debug function (remove in production)
if (WP_DEBUG) {
    function debug_custom_header() {
        if (current_user_can('administrator') && isset($_GET['debug_header'])) {
            echo '<div style="position: fixed; top: 100px; right: 20px; background: #fff; padding: 15px; border: 1px solid #ccc; z-index: 999999;">';
            echo '<h4>Header Debug Info</h4>';
            echo '<p>Widget Class Exists: ' . (class_exists('Custom_Header_Widget') ? 'Yes' : 'No') . '</p>';
            echo '<p>Elementor Active: ' . (did_action('elementor/loaded') ? 'Yes' : 'No') . '</p>';
            echo '<p>CSS File Exists: ' . (file_exists(get_stylesheet_directory() . '/header.css') ? 'Yes' : 'No') . '</p>';
            echo '<p>JS File Exists: ' . (file_exists(get_stylesheet_directory() . '/header.js') ? 'Yes' : 'No') . '</p>';
            echo '<p>Widget File Exists: ' . (file_exists(get_stylesheet_directory() . '/includes/elementor-header-widget.php') ? 'Yes' : 'No') . '</p>';
            echo '</div>';
        }
    }
    add_action('wp_footer', 'debug_custom_header');
}

// Admin notice if Elementor is not active
function faq_admin_notice_missing_elementor() {
    if (isset($_GET['activate'])) unset($_GET['activate']);
    
    $message = sprintf(
        esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'textdomain'),
        '<strong>' . esc_html__('FAQ Widget', 'textdomain') . '</strong>',
        '<strong>' . esc_html__('Elementor', 'textdomain') . '</strong>'
    );
    
    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
}

// Register Hero1 Elementor Widget
function register_hero1_elementor_widget( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/elementor-hero1-widget.php';
    $widgets_manager->register( new \Elementor_Hero1_Widget() );
}
add_action('elementor/widgets/register', 'register_hero1_elementor_widget');

// Enqueue Hero1 Assets  
function enqueue_hero1_assets() {
    wp_enqueue_style('hero1-style', get_stylesheet_directory_uri() . '/hero1.css', array(), '1.0.0');
    wp_enqueue_script('hero1-script', get_stylesheet_directory_uri() . '/hero1.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_hero1_assets');

// Enqueue the Hero2 CSS
function hero2_enqueue_styles() {
    wp_enqueue_style(
        'hero2-widget-styles',
        get_stylesheet_directory_uri() . '/css/hero2.css', // path inside child theme
        array(),
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'hero2_enqueue_styles');

// Register the Hero2 Widget with Elementor
function register_hero2_widget($widgets_manager) {
    require_once( get_stylesheet_directory() . '/includes/elementor-hero2-widget.php' ); // adjust path to match your child theme folder
    $widgets_manager->register( new \Elementor_Hero2_Widget() );
}
add_action('elementor/widgets/register', 'register_hero2_widget');


// Debug CSS Path (optional, remove later)
function hero2_debug_styles() {
    if (is_admin()) return;
    echo '<!-- Hero2 CSS Path: ' . get_stylesheet_directory_uri() . '/css/hero2.css -->';
}
add_action('wp_head', 'hero2_debug_styles');

/**
 * Enqueue Child Theme CSS & JS
 */
function hello_child_enqueue_scripts() {
    // Logo Ticker CSS
    wp_enqueue_style(
        'hello-child-logotick',
        get_stylesheet_directory_uri() . '/CSS/logotick.css',
        [],
        '1.0.0'
    );

    // Logo Ticker JS
    wp_enqueue_script(
        'hello-child-logotick',
        get_stylesheet_directory_uri() . '/JS/logotick.js',
        [ 'jquery' ],
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'hello_child_enqueue_scripts' );

/**
 * Register Elementor Custom Widgets
 */
function hello_child_register_elementor_widgets( $widgets_manager ) {
    require_once( __DIR__ . '/includes/elementor-logotick-widget.php' );

    // Register the LogoTicker widget
    $widgets_manager->register( new \Elementor_Logotick_Widget() );
}
add_action( 'elementor/widgets/register', 'hello_child_register_elementor_widgets' );

function register_custom_elementor_widgets( $widgets_manager ) {
    require_once( get_stylesheet_directory() . '/includes/elementor-Hero4-widget.php' );
    $widgets_manager->register( new \Elementor_Hero4_Widget() );
}
add_action( 'elementor/widgets/register', 'register_custom_elementor_widgets' );
// Enqueue Hero4 Assets

 // Register Scroll Reveal Widget  
function register_scroll_reveal_widget() {
    require_once get_stylesheet_directory() . '/includes/elementor-scroll-reveal-widget.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Scroll_Reveal_Widget() );
}
add_action('elementor/widgets/register', 'register_scroll_reveal_widget');

// Register Scroll Reveal 2 Widget
function register_Scroll_Reveal2_widget() {
    require_once get_stylesheet_directory() . '/includes/elementor-Scroll-Reveal2-widget.php';
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Scroll_Reveal2_Widget() );
}
add_action('elementor/widgets/register', 'register_Scroll_Reveal2_widget');

// ✅ Register Timeline Reveal Widget
function register_timeline_reveal_widget( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/Elementor-TimelineReveal-widget.php';

    $widgets_manager->register( new \Elementor_Timeline_Reveal_Widget() );
}
add_action( 'elementor/widgets/register', 'register_timeline_reveal_widget' );


// Register Custom Elementor Heading Widget
function register_custom_elementor_heading_widget( $widgets_manager ) {

    // Path to your widget file inside child theme
    require_once get_stylesheet_directory() . '/includes/elementor-Custom-Heading-Widget.php';

    // Make sure the class exists before registering
    if ( class_exists( 'Custom_Elementor_Heading_Widget' ) ) {
        $widgets_manager->register( new \Custom_Elementor_Heading_Widget() );
    } else {
        error_log('❌ Custom_Elementor_Heading_Widget class not found.');
    }
}
add_action( 'elementor/widgets/register', 'register_custom_elementor_heading_widget' );

/**
 * Register Highlighted Text Widget
 */
function register_highlighted_text_widget( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/elementor-Highlighted-Text-Widget.php';

    if ( class_exists( 'Highlighted_Text_Widget' ) ) {
        $widgets_manager->register( new \Highlighted_Text_Widget() );
    } else {
        error_log('❌ Highlighted_Text_Widget class not found');
    }
}
add_action( 'elementor/widgets/register', 'register_highlighted_text_widget' );

// ------------------------------
// 1️⃣ Load Custom Semicircle Widget
// ------------------------------
add_action('after_setup_theme', function() {
    add_action( 'elementor/widgets/register', function($widgets_manager){
        $widget_file = get_stylesheet_directory() . '/includes/circle-widget.php';
        if ( ! file_exists( $widget_file ) ) {
            wp_die( "Circle widget file not found: $widget_file" );
        }
        require_once $widget_file;
        $widgets_manager->register( new \Elementor_Circle_Widget() );
    });
});

// ------------------------------
// 2️⃣ Enqueue CSS + JS for the semicircle animations
// ------------------------------
add_action( 'wp_enqueue_scripts', function() {

    // CSS for semicircle design
    wp_enqueue_style(
        'circle-style',
        get_stylesheet_directory_uri() . '/css/circle.css',
        [],
        '1.0'
    );

    // GSAP + ScrollTrigger
    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
        [],
        '3.12.2',
        true
    );
    wp_enqueue_script(
        'scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
        ['gsap'],
        '3.12.2',
        true
    );

    // Custom Animation Script
    wp_enqueue_script(
        'circle-animation',
        get_stylesheet_directory_uri() . '/js/circle-animation.js',
        ['gsap','scrolltrigger'],
        '1.0',
        true
    );
});

// Register Stacked Cards Widget for Elementor
function register_stacked_cards_widget( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/stacked-cards-widget.php';
    $widgets_manager->register( new \Elementor_Stacked_Cards_Widget() );
}
add_action( 'elementor/widgets/register', 'register_stacked_cards_widget' );

// Enqueue jQuery (required for the animations)
function enqueue_stacked_cards_dependencies() {
    if ( ! wp_script_is( 'jquery', 'enqueued' ) ) {
        wp_enqueue_script( 'jquery' );
    }
}
add_action( 'wp_enqueue_scripts', 'enqueue_stacked_cards_dependencies' );

// ADD THIS NEW CODE:
function enqueue_stacked_cards_js() {
    wp_enqueue_script('stacked-cards-script', get_stylesheet_directory_uri() . '/includes/stacked-cards.js', [], '1.0.2', true);
}
add_action('wp_enqueue_scripts', 'enqueue_stacked_cards_js');

// -------------------------
// Coaches Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/coaches-widget.php';
    $widgets_manager->register( new \Elementor_Coaches_Widget() );
});

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'coaches-css', get_stylesheet_directory_uri() . '/css/coaches.css', array(), '1.0.0' );
    wp_enqueue_script( 'coaches-js', get_stylesheet_directory_uri() . '/js/coaches.js', array('jquery'), '1.0.0', true );
});

// -------------------------
// 3 Cards Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/3cards-widget.php';
    $widgets_manager->register( new \Elementor_3Cards_Widget() );
});
// CSS & JS inside widget itself, no enqueue needed

// -------------------------
// Puzzle Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/puzzle-widget.php';
    $widgets_manager->register( new \Elementor_Puzzle_Widget() );
});
// CSS & JS inside widget itself

// -------------------------
//  Showcase Widget
// -------------------------
if ( ! class_exists( 'Elementor_Showcase_Widget' ) ) {
    class Elementor_Showcase_Widget extends \Elementor\Widget_Base {
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/showcase-widget.php';
    $widgets_manager->register( new \Elementor_Showcase_Widget() );
});
// CSS & JS inside widget itself

// -------------------------
// Pricing Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/pricing-widget.php';
    $widgets_manager->register( new \Elementor_Pricing_Widget() );
});

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'pricing-css', get_stylesheet_directory_uri() . '/css/pricing.css', array(), '1.0.0' );
    wp_enqueue_script( 'pricing-js', get_stylesheet_directory_uri() . '/js/pricing.js', array('jquery'), '1.0.0', true );
});

// -------------------------
//  Quiz Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/quiz-widget.php';
    $widgets_manager->register( new \Elementor_Quiz_Widget() );
});

// CSS & JS inside widget itself

// -------------------------
// Footer Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/footer-widget.php';
    $widgets_manager->register( new \Elementor_Footer_Widget() );
});
// CSS & JS inside widget itself

// -------------------------
// Blog Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/blog-widget.php';
    $widgets_manager->register( new \Elementor_Blog_Widget() );
});
// CSS/JS is inside widget itself

// CSS/JS inside widget or enqueue separately if needed

// -------------------------
// Button2 Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/button2-widget.php';
    $widgets_manager->register( new \Elementor_Button2_Widget() );
});
// CSS/JS is inside widget itself


// -------------------------
// Puzzel2 Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/puzzel2-widget.php';
    $widgets_manager->register( new \Elementor_Puzzel2_Widget() );
});
// CSS/JS is inside widget itself

add_action( 'elementor/widgets/register', 'register_custom_gallery_widget' );
function register_custom_gallery_widget( $widgets_manager ) {

    $file_path = get_stylesheet_directory() . '/includes/gallery-widget.php';
    if ( ! file_exists( $file_path ) ) {
        $file_path = get_template_directory() . '/includes/gallery-widget.php';
    }

    if ( file_exists( $file_path ) ) {
        require_once $file_path;

        if ( class_exists( 'Elementor_Gallery_Widget' ) ) {
            $widgets_manager->register( new Elementor_Gallery_Widget() );
        } else {
            add_action( 'admin_notices', function() {
                echo '<div class="notice notice-error"><p>Gallery widget class not found.</p></div>';
            });
        }

    } else {
        add_action( 'admin_notices', function() use ( $file_path ) {
            echo '<div class="notice notice-error"><p>Gallery widget file not found at: ' . esc_html( $file_path ) . '</p></div>';
        });
    }
}


// CSS/JS is inside widget itself


// -------------------------
// Slide Card Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/slide-card-widget.php';
    $widgets_manager->register( new \Elementor_Slide_Card_Widget() );
});
// CSS/JS is inside widget itself

// One Slide Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/oneslide-widget.php';
    $widgets_manager->register( new \Oneslide_Widget() );
});
// CSS/JS is inside widget itself

// -------------------------
// Timeline2 Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/timeline2-widget.php';
    $widgets_manager->register( new \Timeline2_Widget() );
});
// CSS/JS is inside widget itself

// -------------------------
// Scroll2 Widget
// -------------------------
add_action( 'elementor/widgets/register', function( $widgets_manager ) {
    require_once get_stylesheet_directory() . '/includes/scroll2-widget.php';
    $widgets_manager->register( new \Scroll2_Widget() );
});

// CSS/JS is inside widget itself

