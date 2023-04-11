<?php
/**
 * Create Institute Sections
 */
namespace Soundst\Theme_Helper;
use WP_Query;

new Center_Sections();

class Center_Sections {
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
        add_action( 'render_center_welcome_section', [$this, 'center_welcome_section'] );
        add_action( 'render_center_faqs_section', [$this, 'center_faq_section'] );
        add_action( 'render_center_additional_content', [$this, 'center_additional_content'] );
        add_action( 'render_center_conditions_section', [$this, 'build_conditions_section'] );
    }

    /**
     * Build the conditions section.
     */
    public function build_conditions_section() {
        $cpts = get_field( 'conditions', $this->id );
        if ( empty( $cpts ) ) {
           return;
        }
        ?>
            <div id="cpts" class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 pb-12">
                <div class="w-full pb-4 border-b border-black border-solid mb-12">
                    <h2>Conditions Treated</h2>
                </div>
                <?php include( SOUNDST_PLUGIN_DIR . '/views/general-loop.php' ); ?>
            </div>
        <?php
    }

    /**
     * Additional content sections.
     */
    public function center_additional_content() {
        if( have_rows( 'additional_content' ) ) : ?>
            <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-4 additional-content">
                <?php while( have_rows( 'additional_content' ) ) : the_row(); ?>
                    <div class="pb-12">
                        <div class="w-full pb-4 border-b border-black border-solid mb-12">
                            <h2><?php echo esc_html( get_sub_field( 'add_content_header' ) ); ?></h2>
                        </div>
                        <div>
                            <?php echo get_sub_field( 'additional_content_text' ); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <style>
                .additional-content ul {
                    list-style: disc;
                    padding-left: 40px;
                }
            </style>
        <?php endif;
    }

    /**
     * Build the FAQs section.
     */
    public function center_faq_section() {
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
     * Build the welcome section.
     */
    public function center_welcome_section() {
        $content     = $this->acfs[0]['content'];
        $title       = get_the_title( $this->id );
        $con_img_url = $this->acfs[0]['content_image']['url'];
        $con_img_alt = $this->acfs[0]['content_image']['title'];
        ?>
            <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-12">
                <div class="w-full pb-4 border-b border-black border-solid mb-12">
                    <h2>Welcome to the <?php echo esc_html( $title ); ?></h2>
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
