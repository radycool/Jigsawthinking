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

    protected function register_controls() {
        
        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Quiz Settings', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'quiz_title',
            [
                'label' => __( 'Quiz Title', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Take Our Quiz', 'text-domain' ),
                'placeholder' => __( 'Enter quiz title', 'text-domain' ),
            ]
        );

        $this->add_control(
            'quiz_description',
            [
                'label' => __( 'Description', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Answer the questions below to get your results.', 'text-domain' ),
                'placeholder' => __( 'Enter description', 'text-domain' ),
            ]
        );

        $this->add_control(
            'show_progress',
            [
                'label' => __( 'Show Progress Bar', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'text-domain' ),
                'label_off' => __( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Questions Section
        $this->start_controls_section(
            'questions_section',
            [
                'label' => __( 'Questions', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question_text',
            [
                'label' => __( 'Question', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Enter your question here', 'text-domain' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'question_type',
            [
                'label' => __( 'Question Type', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'single',
                'options' => [
                    'single' => __( 'Single Choice', 'text-domain' ),
                    'multiple' => __( 'Multiple Choice', 'text-domain' ),
                ],
            ]
        );

        $repeater->add_control(
            'answers',
            [
                'label' => __( 'Answers (one per line)', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( "Answer 1\nAnswer 2\nAnswer 3\nAnswer 4", 'text-domain' ),
                'description' => __( 'Enter each answer on a new line', 'text-domain' ),
            ]
        );

        $repeater->add_control(
            'correct_answers',
            [
                'label' => __( 'Correct Answer(s)', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( '0', 'text-domain' ),
                'description' => __( 'Enter answer index (0-based). For multiple answers, separate with commas (e.g., 0,2)', 'text-domain' ),
            ]
        );

        $repeater->add_control(
            'points',
            [
                'label' => __( 'Points', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 0,
                'max' => 100,
            ]
        );

        $this->add_control(
            'questions',
            [
                'label' => __( 'Quiz Questions', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'question_text' => __( 'What is the capital of France?', 'text-domain' ),
                        'answers' => __( "Paris\nLondon\nBerlin\nMadrid", 'text-domain' ),
                        'correct_answers' => '0',
                        'points' => 1,
                    ],
                    [
                        'question_text' => __( 'Which of these are programming languages?', 'text-domain' ),
                        'answers' => __( "Python\nHTML\nJavaScript\nCSS", 'text-domain' ),
                        'question_type' => 'multiple',
                        'correct_answers' => '0,2',
                        'points' => 2,
                    ],
                ],
                'title_field' => '{{{ question_text }}}',
            ]
        );

        $this->end_controls_section();

        // Results Section
        $this->start_controls_section(
            'results_section',
            [
                'label' => __( 'Results', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_score',
            [
                'label' => __( 'Show Score', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'text-domain' ),
                'label_off' => __( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_correct_answers',
            [
                'label' => __( 'Show Correct Answers', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'text-domain' ),
                'label_off' => __( 'Hide', 'text-domain' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'success_message',
            [
                'label' => __( 'Success Message', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Congratulations! You scored {score}% on the quiz!', 'text-domain' ),
                'description' => __( 'Use {score} for the percentage and {points} for total points', 'text-domain' ),
            ]
        );

        $this->add_control(
            'fail_message',
            [
                'label' => __( 'Fail Message', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'You scored {score}%. Keep learning and try again!', 'text-domain' ),
                'description' => __( 'Use {score} for the percentage and {points} for total points', 'text-domain' ),
            ]
        );

        $this->add_control(
            'passing_score',
            [
                'label' => __( 'Passing Score (%)', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 70,
                'min' => 0,
                'max' => 100,
            ]
        );

        $this->end_controls_section();

        // Style Section - Quiz Container
        $this->start_controls_section(
            'style_container',
            [
                'label' => __( 'Container', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_padding',
            [
                'label' => __( 'Padding', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quiz-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'container_background',
            [
                'label' => __( 'Background Color', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quiz-container' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .quiz-container',
            ]
        );

        $this->add_control(
            'container_border_radius',
            [
                'label' => __( 'Border Radius', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quiz-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Buttons
        $this->start_controls_section(
            'style_buttons',
            [
                'label' => __( 'Buttons', 'text-domain' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .quiz-button',
            ]
        );

        $this->start_controls_tabs( 'button_tabs' );

        $this->start_controls_tab(
            'button_normal',
            [
                'label' => __( 'Normal', 'text-domain' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quiz-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Background Color', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quiz-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover',
            [
                'label' => __( 'Hover', 'text-domain' ),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Text Color', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quiz-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __( 'Background Color', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quiz-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'text-domain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quiz-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if ( empty( $settings['questions'] ) ) {
            echo '<p>' . __( 'Please add questions to your quiz.', 'text-domain' ) . '</p>';
            return;
        }

        $widget_id = $this->get_id();
        $quiz_data = [
            'questions' => $settings['questions'],
            'show_score' => $settings['show_score'],
            'show_correct_answers' => $settings['show_correct_answers'],
            'success_message' => $settings['success_message'],
            'fail_message' => $settings['fail_message'],
            'passing_score' => $settings['passing_score'],
        ];
        ?>
        
        <style>
        .quiz-container-<?php echo $widget_id; ?> {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .quiz-container-<?php echo $widget_id; ?> .quiz-header {
            margin-bottom: 30px;
            text-align: center;
        }
        .quiz-container-<?php echo $widget_id; ?> .quiz-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .quiz-container-<?php echo $widget_id; ?> .quiz-description {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }
        .quiz-container-<?php echo $widget_id; ?> .quiz-progress {
            margin-bottom: 30px;
        }
        .quiz-container-<?php echo $widget_id; ?> .progress-bar {
            width: 100%;
            height: 8px;
            background-color: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 10px;
        }
        .quiz-container-<?php echo $widget_id; ?> .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4CAF50 0%, #45a049 100%);
            transition: width 0.3s ease;
        }
        .quiz-container-<?php echo $widget_id; ?> .progress-text {
            display: block;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .quiz-container-<?php echo $widget_id; ?> .quiz-question {
            margin-bottom: 30px;
        }
        .quiz-container-<?php echo $widget_id; ?> .question-text {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            line-height: 1.4;
        }
        .quiz-container-<?php echo $widget_id; ?> .answers-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .quiz-container-<?php echo $widget_id; ?> .answer-option {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            background: #f8f9fa;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .quiz-container-<?php echo $widget_id; ?> .answer-option:hover {
            background: #e8f5e9;
            border-color: #4CAF50;
        }
        .quiz-container-<?php echo $widget_id; ?> .answer-option input[type="radio"],
        .quiz-container-<?php echo $widget_id; ?> .answer-option input[type="checkbox"] {
            margin-right: 12px;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        .quiz-container-<?php echo $widget_id; ?> .answer-option input:checked ~ .answer-text {
            font-weight: 600;
            color: #4CAF50;
        }
        .quiz-container-<?php echo $widget_id; ?> .answer-option:has(input:checked) {
            background: #e8f5e9;
            border-color: #4CAF50;
        }
        .quiz-container-<?php echo $widget_id; ?> .answer-text {
            font-size: 16px;
            color: #333;
            line-height: 1.4;
            flex: 1;
        }
        .quiz-container-<?php echo $widget_id; ?> .quiz-navigation {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 30px;
        }
        .quiz-container-<?php echo $widget_id; ?> .quiz-button {
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
            background: #4CAF50;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            flex: 1;
            max-width: 200px;
        }
        .quiz-container-<?php echo $widget_id; ?> .quiz-button:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        }
        .quiz-container-<?php echo $widget_id; ?> .btn-prev {
            background: #757575;
        }
        .quiz-container-<?php echo $widget_id; ?> .btn-prev:hover {
            background: #616161;
        }
        .quiz-container-<?php echo $widget_id; ?> .btn-submit {
            background: #2196F3;
        }
        .quiz-container-<?php echo $widget_id; ?> .btn-submit:hover {
            background: #1976D2;
        }
        .quiz-container-<?php echo $widget_id; ?> .quiz-results {
            animation: fadeIn 0.5s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .quiz-container-<?php echo $widget_id; ?> .results-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .quiz-container-<?php echo $widget_id; ?> .result-message {
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 18px;
            text-align: center;
            line-height: 1.6;
        }
        .quiz-container-<?php echo $widget_id; ?> .result-message.passed {
            background: #e8f5e9;
            color: #2e7d32;
            border: 2px solid #4CAF50;
        }
        .quiz-container-<?php echo $widget_id; ?> .result-message.failed {
            background: #ffebee;
            color: #c62828;
            border: 2px solid #f44336;
        }
        .quiz-container-<?php echo $widget_id; ?> .score-display,
        .quiz-container-<?php echo $widget_id; ?> .points-display {
            font-size: 18px;
            margin: 15px 0;
            text-align: center;
            color: #333;
        }
        .quiz-container-<?php echo $widget_id; ?> .answers-review {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #e0e0e0;
        }
        .quiz-container-<?php echo $widget_id; ?> .answers-review h4 {
            font-size: 20px;
            color: #333;
            margin-bottom: 20px;
        }
        .quiz-container-<?php echo $widget_id; ?> .question-review {
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 6px;
            border-left: 4px solid #e0e0e0;
            background: #f8f9fa;
        }
        .quiz-container-<?php echo $widget_id; ?> .question-review.correct {
            background: #e8f5e9;
            border-left-color: #4CAF50;
        }
        .quiz-container-<?php echo $widget_id; ?> .question-review.incorrect {
            background: #ffebee;
            border-left-color: #f44336;
        }
        .quiz-container-<?php echo $widget_id; ?> .review-question {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.5;
        }
        .quiz-container-<?php echo $widget_id; ?> .review-status {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .quiz-container-<?php echo $widget_id; ?> .question-review.correct .review-status {
            color: #2e7d32;
        }
        .quiz-container-<?php echo $widget_id; ?> .question-review.incorrect .review-status {
            color: #c62828;
        }
        .quiz-container-<?php echo $widget_id; ?> .review-answers {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
            margin-top: 10px;
        }
        .quiz-container-<?php echo $widget_id; ?> .btn-restart {
            display: block;
            margin: 30px auto 0;
            background: #FF9800;
        }
        .quiz-container-<?php echo $widget_id; ?> .btn-restart:hover {
            background: #F57C00;
        }
        @media (max-width: 768px) {
            .quiz-container-<?php echo $widget_id; ?> { padding: 20px; }
            .quiz-container-<?php echo $widget_id; ?> .quiz-title { font-size: 24px; }
            .quiz-container-<?php echo $widget_id; ?> .question-text { font-size: 18px; }
            .quiz-container-<?php echo $widget_id; ?> .quiz-navigation { flex-direction: column; }
            .quiz-container-<?php echo $widget_id; ?> .quiz-button { max-width: 100%; width: 100%; }
        }
        </style>

        <div class="quiz-container-<?php echo $widget_id; ?>" data-quiz='<?php echo esc_attr( json_encode( $quiz_data ) ); ?>'>
            <div class="quiz-header">
                <h2 class="quiz-title"><?php echo esc_html( $settings['quiz_title'] ); ?></h2>
                <?php if ( ! empty( $settings['quiz_description'] ) ) : ?>
                    <p class="quiz-description"><?php echo esc_html( $settings['quiz_description'] ); ?></p>
                <?php endif; ?>
            </div>

            <?php if ( $settings['show_progress'] === 'yes' ) : ?>
                <div class="quiz-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 0%"></div>
                    </div>
                    <span class="progress-text">Question <span class="current-question">1</span> of <span class="total-questions"><?php echo count( $settings['questions'] ); ?></span></span>
                </div>
            <?php endif; ?>

            <div class="quiz-questions">
                <?php foreach ( $settings['questions'] as $index => $question ) :
                    $answers = array_filter( array_map( 'trim', explode( "\n", $question['answers'] ) ) );
                    $is_first = $index === 0;
                    ?>
                    <div class="quiz-question" data-question-index="<?php echo $index; ?>" style="<?php echo $is_first ? '' : 'display: none;'; ?>">
                        <h3 class="question-text"><?php echo esc_html( $question['question_text'] ); ?></h3>
                        <div class="answers-list" data-type="<?php echo esc_attr( $question['question_type'] ); ?>">
                            <?php foreach ( $answers as $answer_index => $answer ) : ?>
                                <label class="answer-option">
                                    <input 
                                        type="<?php echo $question['question_type'] === 'multiple' ? 'checkbox' : 'radio'; ?>" 
                                        name="question_<?php echo $widget_id; ?>_<?php echo $index; ?>" 
                                        value="<?php echo $answer_index; ?>"
                                    >
                                    <span class="answer-text"><?php echo esc_html( $answer ); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="quiz-navigation">
                <button class="quiz-button btn-prev" style="display: none;"><?php _e( 'Previous', 'text-domain' ); ?></button>
                <button class="quiz-button btn-next"><?php _e( 'Next', 'text-domain' ); ?></button>
                <button class="quiz-button btn-submit" style="display: none;"><?php _e( 'Submit Quiz', 'text-domain' ); ?></button>
            </div>

            <div class="quiz-results" style="display: none;">
                <h3 class="results-title"><?php _e( 'Quiz Results', 'text-domain' ); ?></h3>
                <div class="results-content"></div>
                <button class="quiz-button btn-restart"><?php _e( 'Restart Quiz', 'text-domain' ); ?></button>
            </div>
        </div>

        <script>
        jQuery(document).ready(function($) {
            $('.quiz-container-<?php echo $widget_id; ?>').each(function() {
                const container = $(this);
                const quizData = container.data('quiz');
                let currentQuestion = 0;
                let userAnswers = {};

                const totalQuestions = quizData.questions.length;
                const questions = container.find('.quiz-question');
                const btnNext = container.find('.btn-next');
                const btnPrev = container.find('.btn-prev');
                const btnSubmit = container.find('.btn-submit');
                const btnRestart = container.find('.btn-restart');
                const progressFill = container.find('.progress-fill');
                const currentQuestionSpan = container.find('.current-question');

                function updateProgress() {
                    const progress = ((currentQuestion + 1) / totalQuestions) * 100;
                    progressFill.css('width', progress + '%');
                    currentQuestionSpan.text(currentQuestion + 1);
                }

                function showQuestion(index) {
                    questions.hide().eq(index).show();
                    btnPrev.toggle(index > 0);
                    btnNext.toggle(index < totalQuestions - 1);
                    btnSubmit.toggle(index === totalQuestions - 1);
                    updateProgress();
                }

                function saveAnswer(questionIndex) {
                    const question = questions.eq(questionIndex);
                    const questionType = question.find('.answers-list').data('type');
                    
                    if (questionType === 'multiple') {
                        userAnswers[questionIndex] = question.find('input:checked').map(function() {
                            return parseInt($(this).val());
                        }).get();
                    } else {
                        const checked = question.find('input:checked').val();
                        userAnswers[questionIndex] = checked !== undefined ? [parseInt(checked)] : [];
                    }
                }

                function calculateScore() {
                    let totalPoints = 0;
                    let earnedPoints = 0;

                    quizData.questions.forEach((question, index) => {
                        totalPoints += parseInt(question.points) || 1;
                        const correctAnswers = question.correct_answers.split(',').map(a => parseInt(a.trim())).sort();
                        const userAnswerArray = (userAnswers[index] || []).sort();
                        
                        if (JSON.stringify(correctAnswers) === JSON.stringify(userAnswerArray)) {
                            earnedPoints += parseInt(question.points) || 1;
                        }
                    });

                    const score = totalPoints > 0 ? Math.round((earnedPoints / totalPoints) * 100) : 0;
                    return { score, earnedPoints, totalPoints };
                }

                function showResults() {
                    const result = calculateScore();
                    const isPassed = result.score >= parseInt(quizData.passing_score);
                    
                    let message = isPassed ? quizData.success_message : quizData.fail_message;
                    message = message.replace('{score}', result.score)
                                   .replace('{points}', result.earnedPoints + '/' + result.totalPoints);

                    let resultsHTML = '<div class="result-message ' + (isPassed ? 'passed' : 'failed') + '">' + message + '</div>';

                    if (quizData.show_score === 'yes') {
                        resultsHTML += '<div class="score-display"><strong>Score:</strong> ' + result.score + '%</div>';
                        resultsHTML += '<div class="points-display"><strong>Points:</strong> ' + result.earnedPoints + ' / ' + result.totalPoints + '</div>';
                    }

                    if (quizData.show_correct_answers === 'yes') {
                        resultsHTML += '<div class="answers-review"><h4>Review Your Answers:</h4>';
                        
                        quizData.questions.forEach((question, index) => {
                            const correctAnswers = question.correct_answers.split(',').map(a => parseInt(a.trim()));
                            const userAnswerArray = userAnswers[index] || [];
                            const answers = question.answers.split('\n').map(a => a.trim()).filter(a => a);
                            
                            const isCorrect = JSON.stringify(correctAnswers.sort()) === JSON.stringify(userAnswerArray.sort());
                            
                            resultsHTML += '<div class="question-review ' + (isCorrect ? 'correct' : 'incorrect') + '">';
                            resultsHTML += '<p class="review-question"><strong>Q' + (index + 1) + ':</strong> ' + question.question_text + '</p>';
                            resultsHTML += '<p class="review-status">' + (isCorrect ? '✓ Correct' : '✗ Incorrect') + '</p>';
                            
                            if (!isCorrect) {
                                resultsHTML += '<p class="review-answers">';
                                resultsHTML += '<strong>Your answer:</strong> ';
                                if (userAnswerArray.length > 0) {
                                    resultsHTML += userAnswerArray.map(i => answers[i]).join(', ');
                                } else {
                                    resultsHTML += 'No answer selected';
                                }
                                resultsHTML += '<br><strong>Correct answer:</strong> ' + correctAnswers.map(i => answers[i]).join(', ');
                                resultsHTML += '</p>';
                            }
                            
                            resultsHTML += '</div>';
                        });
                        
                        resultsHTML += '</div>';
                    }

                    container.find('.results-content').html(resultsHTML);
                    container.find('.quiz-questions, .quiz-navigation, .quiz-progress').hide();
                    container.find('.quiz-results').show();
                }

                function restartQuiz() {
                    currentQuestion = 0;
                    userAnswers = {};
                    
                    container.find('input[type="radio"], input[type="checkbox"]').prop('checked', false);
                    container.find('.quiz-results').hide();
                    container.find('.quiz-questions, .quiz-navigation, .quiz-progress').show();
                    
                    showQuestion(0);
                }

                btnNext.on('click', function() {
                    saveAnswer(currentQuestion);
                    if (currentQuestion < totalQuestions - 1) {
                        currentQuestion++;
                        showQuestion(currentQuestion);
                    }
                });

                btnPrev.on('click', function() {
                    saveAnswer(currentQuestion);
                    if (currentQuestion > 0) {
                        currentQuestion--;
                        showQuestion(currentQuestion);
                    }
                });

                btnSubmit.on('click', function() {
                    saveAnswer(currentQuestion);
                    showResults();
                });

                btnRestart.on('click', function() {
                    restartQuiz();
                });

                showQuestion(0);
            });
        });
        </script>
        <?php
    }
}