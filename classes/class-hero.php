<?php
/**
 * Create Institute Sections
 */
namespace Soundst\Theme_Helper;

new Hero();

class Hero {
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
        add_action( 'render_hero', [$this, 'build_hero'] );
    }

    /**
     * Hero background image.
     */
    public function hero_image( $img_url ) {
        ?>
        <style>
            .institute-hero {
                background-image: url('<?php echo esc_url( $img_url ); ?>');
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                padding: 8rem 0;
            }
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
     * Build the hero section.
     * 
     * @return void
     */
    public function build_hero() {
        $url        = $this->acfs[0]['hero_image']['url'];
        $alt        = $this->acfs[0]['hero_image']['title'];
        $excerpt    = $this->acfs[0]['hero_excerpt'];
        $btn_txt    = $this->acfs[0]['button_text'];
        $btn_link   = $this->acfs[0]['button_link'];
        $btn_txt_2  = ($this->acfs[0]['button_text_2']) ? $this->acfs[0]['button_text_2'] : '';
        $btn_link_2 = ($this->acfs[0]['button_link_2']) ? $this->acfs[0]['button_link_2'] : '';
        $title      = get_the_title( $this->id );

        // Add the hero background image.
        $this->hero_image( $url );
        ?>
            <div class="institute-hero">
                <div class="max-w-6xl mx-auto px-4">
                    <div class="md:w-6/12 w-full">
                        <h1><?php echo esc_html( $title ); ?></h1>
                        <div class="blue-bottom-borrder border-solid border-b-4 border-st-lt-blue w-24 mb-3"></div>
                        <div class=w-20 border-b-4 border-sky-500"></div>
                        <p class="font-medium text-lg"><?php echo esc_html( $excerpt ); ?></p>
                        <?php if ( get_post_type() != 'institute' ) : ?>
                            <div class="w-full pt-4">
                                <a href="<?php echo esc_url( $btn_link ); ?>" class="
                                    content-btn 
                                    text-st-white 
                                    bg-[#2d5591] hover:bg-st-lt-blue focus:ring-4 focus:outline-none 
                                    font-bold 
                                    text-sm 
                                    px-5
                                    py-2.5
                                    md:mr-4
                                    text-center
                                    uppercase
                                    inline-flex 
                                    items-center">
                                    <?php echo esc_html( $btn_txt ); ?>
                                </a>
                                <a href="<?php echo esc_url( $btn_link_2 ); ?>" class="
                                    content-btn 
                                    text-st-white 
                                    bg-st-lt-blue hover:bg-[#2d5591] focus:ring-4 focus:outline-none 
                                    font-bold 
                                    text-sm
                                    px-5 
                                    py-2.5 
                                    text-center
                                    uppercase
                                    inline-flex 
                                    items-center">
                                    <?php echo esc_html( $btn_txt_2 ); ?>
                                </a>
                            </div>
                        <?php else : ?>
                            <div class="w-full pt-4">
                                <a href="<?php echo esc_url( $btn_link ); ?>" class="
                                    content-btn 
                                    text-st-white 
                                    hover:bg-[#2d5591] bg-st-lt-blue focus:ring-4 focus:outline-none 
                                    font-medium 
                                    text-sm 
                                    px-5 
                                    py-2.5 
                                    text-center 
                                    inline-flex 
                                    items-center">
                                    <?php echo esc_html( $btn_txt ); ?>
                                </a>
                            </div>      
                        <?php endif; ?>
                    </div>
                </div>
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
     * @return void
     */
    public function set_id() {
        global $post;
        return $this->id = $post->ID;
    }
}
