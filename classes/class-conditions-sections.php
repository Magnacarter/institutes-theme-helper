<?php
/**
 * Create Conditions Sections
 */
namespace Soundst\Theme_Helper;
use WP_Query;

new Condition_Sections();

class Condition_Sections {
    /**
     * @var int id
     */
    private $id;

    /**
     * @var array acfs
     */
    private $acfs;

    /**
     * Constructor function
     */
    public function __construct() {
        $this->set_id();
        $this->set_acfs();
        add_action( 'render_condition_tabs_section', [$this, 'build_tabs_section'] );
        add_action( 'render_condition_faqs_section', [$this, 'condition_faq_section'] );
        add_action( 'render_physician_section', [$this, 'build_physician_section'] );
        add_action( 'render_visit_section', [$this, 'build_visit_section'] );
    }

    /**
     * Build the physician section.
     */
    public function build_physician_section() {
        $title      = $this->acfs[0]['physician_title'];
        $content    = $this->acfs[0]['physician_excerpt'];
        $bg_img_url = $this->acfs[0]['physician_background_image'];
        $img_url    = $this->acfs[0]['physician_featured_image']['url'];
        $img_alt    = $this->acfs[0]['physician_featured_image']['title'];
        ?>
        <div class="physician-wrapper py-4">
            <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-4">
                <div class="w-full pb-4 border-b border-black border-solid mb-8">
                    <h2><?php echo esc_html( $title ); ?></h2>
                </div>
                <div class="content-wrapper md:w-6/12 w-full"><?php echo $content; ?></div>
                <div class="md:w-5/12 w-full">
                    <img src="<?php echo esc_url( $img_url ); ?>" class="" alt="<?php echo esc_attr( $img_alt ); ?>" />
                </div>
            </div>
        </div>
        <style>
            .physician-wrapper {
                background-image: url('<?php echo esc_url( $bg_img_url ); ?>');
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
            }
        </style>
        <?php
    }

    /**
     * Build the visit section.
     */
    public function build_visit_section() {
        $title   = $this->acfs[0]['visit_title'];
        $content = $this->acfs[0]['visit_excerpt'];
        $img_url = $this->acfs[0]['visit_featured_image']['url'];
        $img_alt = $this->acfs[0]['visit_featured_image']['title'];
        ?>
        <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 pt-8 pb-12 text-center">
            <div class="w-full pb-4 border-b border-black border-solid mb-8">
                <h2><?php echo esc_html( $title ); ?></h2>
            </div>
            <div class="content-wrapper w-full pb-8"><?php echo $content; ?></div>
            <div class="w-full">
                <img src="<?php echo esc_url( $img_url ); ?>" style="width: 100%;" alt="<?php echo esc_attr( $img_alt ); ?>" />
            </div>
        </div>
        <?php
    }

    /**
     * Build the conditions section.
     */
    public function build_tabs_section() {
        ?>
        <div class="bg-st-bg-gray">
            <div class="max-w-6xl mx-auto">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                        <li class="mr-2">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" data-id="overview-tab" data-tabs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="false">Overview</button>
                        </li>
                        <li class="mr-2">
                            <button class="inline-block p-4 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" data-id="symptoms-tab" data-tabs-target="#symptoms" type="button" role="tab" aria-controls="symptoms" aria-selected="false">Symptoms</button>
                        </li>
                        <li class="mr-2">
                            <button class="inline-block p-4 hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" data-id="treatment-tab" data-tabs-target="#treatment" type="button" role="tab" aria-controls="treatment" aria-selected="false">Treatment</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="myTabContent">
            <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="overview-tab">
                <?php $this->condition_overview_section(); ?>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="symptoms-tab">
                <?php $this->condition_symptoms_section(); ?>
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="treatment-tab">
                <?php $this->condition_treatment_section(); ?>
            </div>
        </div>
        </div>
        <style>
            #myTabContent div.active {
                display: block;
            }
        </style>
        <?php
    }

   /**
     * Build the treatment section.
     */
    public function condition_treatment_section() {
        $content     = $this->acfs[0]['treatment_content'];
        $title       = get_the_title( $this->id );
        ?>
            <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-4">
                <div class="w-full pb-4 border-b border-black border-solid mb-12">
                    <h2>Treatment: <?php echo esc_html( $title ); ?></h2>
                </div>
                <div class="content-wrapper"><?php echo $content; ?></div>
            </div>
        <?php
    }

   /**
     * Build the symptoms section.
     */
    public function condition_symptoms_section() {
        $content     = $this->acfs[0]['symptoms_content'];
        $title       = get_the_title( $this->id );
        ?>
            <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-4">
                <div class="w-full pb-4 border-b border-black border-solid mb-12">
                    <h2>Symptoms: <?php echo esc_html( $title ); ?></h2>
                </div>
                <div class="content-wrapper"><?php echo $content; ?></div>
            </div>
        <?php
    }

    /**
     * Build the overview section.
     */
    public function condition_overview_section() {
        $content     = $this->acfs[0]['content'];
        $title       = get_the_title( $this->id );
        $con_img_url = $this->acfs[0]['content_image']['url'];
        $con_img_alt = $this->acfs[0]['content_image']['title'];
        ?>
            <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-4">
                <div class="w-full pb-4 border-b border-black border-solid mb-12">
                    <h2>Overview: <?php echo esc_html( $title ); ?></h2>
                </div>
                <div class="md:w-4/12 w-full md:pr-4">
                    <img src="<?php echo esc_url( $con_img_url ); ?>" class="" alt="<?php echo esc_attr( $con_img_alt ); ?>" />
                </div>
                <div class="md:w-8/12 w-full md:pl-4 md:pt-0 pt-8">
                    <div class="content-wrapper"><?php echo $content; ?></div>
                    <div class="flex flex-wrap pt-8">
                        <a href="#centers"
                            class="
                                content-btn
                                uppercase 
                                font-bold 
                                text-st-white 
                                bg-st-dk-blue hover:bg-st-lt-blue focus:ring-4 focus:outline-none 
                                text-sm 
                                px-5 
                                py-2
                                md:mr-4
                                text-center
                                inline-flex
                                items-center">
                            Our Centers
                        <a href="#consult-form"
                            class="
                                content-btn
                                uppercase
                                font-bold 
                                text-st-white 
                                bg-st-lt-blue hover:bg-st-dk-blue focus:ring-4 focus:outline-none 
                                text-sm 
                                px-5 
                                py-2 
                                text-center 
                                inline-flex 
                                items-center">
                            Request a Consultation
                        </a>
                    </div>
                </div>
            </div>
            <style>
            .content-btn:after {
                padding-left: 10px;
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                content: "\f138";
                font-size: 20px;
                color: #ffffff;
                display: inline-block;
            }
            </style>
        <?php
    }

    /**
     * Build the FAQs section.
     */
    public function condition_faq_section() {
        $bg_img         = $this->acfs[0]['faq_background_image'];
        $faq_header     = $this->acfs[0]['faq_header'];
        $faq_sub_header = $this->acfs[0]['faq_sub_header'];
        $faqs           = $this->acfs[0]['faqs'];

        if( have_rows( 'faqs' ) ) : ?>
            <div class="faq-wrapper">
                <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-12">
                    <div class="text-center px-48">
                        <h2 class="text-st-dk-blue"><?php echo esc_html( $faq_header ); ?></h2>
                        <p class=""><?php echo esc_html( $faq_sub_header ); ?></p>
                    </div>
                    <div class="grid gap-x-8 gap-y-8 grid-cols-2 pt-12">
                        <?php $i = 0; ?>
                        <?php while( have_rows( 'faqs' ) ) : the_row(); 
                            $q = get_sub_field( 'question' );
                            $a = get_sub_field( 'answer' );
                            ?>
                            <div id="faq-<?php echo esc_attr( $i++ ); ?>" class="
                                faq
                                relative
                                border 
                                border-[#D9D9D9] 
                                border-solid 
                                rounded-md
                                border-l
                                border-l-solid
                                border-l-st-lt-blue
                                border-l-8
                                px-8 
                                py-6">
                                <a class="text-st-dk-gray toggle-faq closed center-question font-bold hover:cursor-pointer"><?php echo esc_html( $q ); ?></a>
                                <p class="center-answer toggle-answer py-4"><?php echo esc_html( $a ); ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <style>
            .faq-wrapper {
                background-image: url('<?php echo esc_url( $bg_img ); ?>');
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
            }
            .center-question.closed:after {
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                content: "\f055";
                font-size: 20px;
                color: #00c0ff;
                position: absolute;
                top: 1.5rem;
                right: .5rem;
                display: inline-block;
            }
            .center-question.open:after {
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                content: "\f056";
                font-size: 20px;
                color: #00c0ff;
                position: absolute;
                top: 1.5rem;
                right: .5rem;
                display: inline-block;
            }
            .toggle-answer {
                transition: height .25s ease;
                overflow: hidden;
            }
            .toggle-answer:not(.active) {
                height: 0;
                display: none;
            }
            </style>
        <?php endif;
    }

    /**
     * Set custom field values from acfs.
     * 
     * @return void
     */
    public function set_acfs() {
        $id         = $this->id;
        $acfs[]     = get_fields( $id );
        $this->acfs = $acfs;
    }

    /**
     * Set post id.
     * 
     * @return int
     */
    public function set_id() {
        global $post;
        return $this->id = $post->ID;
    }
}
