<?php
/**
 * Create Institute Sections
 */
namespace Soundst\Theme_Helper;
use WP_Query;

new Create_Institute_Sections();

class Create_Institute_Sections {
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
        add_action( 'render_welcome_section', [$this, 'build_welcome_section'] );
        add_action( 'render_centers_section', [$this, 'build_centers_section'] );
        add_action( 'render_conditions_section', [$this, 'build_conditions_section'] );
    }

    /**
     * Build the welcome section.
     */
    public function build_welcome_section() {
        $content     = $this->acfs[0]['content'];
        $title       = get_the_title( $this->id );
        $con_img_url = $this->acfs[0]['content_image']['url'];
        $con_img_alt = $this->acfs[0]['content_image']['title'];
        ?>
            <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-12">
                <div class="w-full pb-4 border-b border-black border-solid mb-12">
                    <h2>Welcome to the <?php echo esc_html( $title ); ?></h2>
                </div>
                <div class="md:w-6/12 w-full md:pr-4">
                    <img src="<?php echo esc_url( $con_img_url ); ?>" class="" alt="<?php echo esc_attr( $con_img_alt ); ?>" />
                </div>
                <div class="md:w-6/12 w-full md:pl-4 md:pt-0 pt-8">
                    <div class="content-wrapper"><?php echo $content; ?></div>
                    <div class="flex justify-between flex-wrap pt-8">
                        <a href="#centers"
                            class="
                                content-btn
                                uppercase 
                                font-bold 
                                text-st-white 
                                bg-st-dk-blue hover:bg-st-lt-blue focus:ring-4 focus:outline-none 
                                font-medium 
                                text-sm 
                                px-5 
                                py-2 
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
                                font-medium 
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
     * Build the centers section.
     */
    public function build_centers_section() {
        $cpts = get_field( 'center_posts', $this->id );
        if ( empty( $cpts ) ) {
            return;
        }
        ?>
            <div id="cpts" class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-12">
                <div class="w-full pb-4 border-b border-black border-solid mb-12">
                    <h2>Centers of Excellence</h2>
                </div>
                <?php include( SOUNDST_PLUGIN_DIR . '/views/general-loop.php' ); ?>
            </div>
        <?php
    }

    /**
     * Build the centers section.
     */
    public function build_conditions_section() {
        $cpts = get_field( 'conditions', $this->id );
        if ( empty( $cpts ) ) {
           return;
        }
        ?>
            <div id="cpts" class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-12">
                <div class="w-full pb-4 border-b border-black border-solid mb-12">
                    <h2>Conditions Treated</h2>
                </div>
                <?php include( SOUNDST_PLUGIN_DIR . '/views/general-loop.php' ); ?>
            </div>
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
