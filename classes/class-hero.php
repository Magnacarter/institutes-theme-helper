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
        </style>
        <?php
    }

    /**
     * Build the hero section.
     * 
     * @return void
     */
    public function build_hero() {
        $url      = $this->acfs[0]['hero_image']['url'];
        $alt      = $this->acfs[0]['hero_image']['title'];
        $excerpt  = $this->acfs[0]['hero_excerpt'];
        $btn_txt  = $this->acfs[0]['button_text'];
        $btn_link = $this->acfs[0]['button_link'];
        $title    = get_the_title( $this->id );

        // Add the hero background image.
        $this->hero_image( $url );
        ?>
            <div class="institute-hero">
                <div class="max-w-6xl mx-auto px-4">
                    <div class="md:w-6/12 w-full">
                        <h1><?php echo esc_html( $title ); ?></h1>
                        <div class=w-20 border-b-4 border-sky-500"></div>
                        <p class="font-medium text-lg"><?php echo esc_html( $excerpt ); ?></p>
                        <div class="w-full pt-4">
                            <button type="button" class="text-st-white bg-[#2d5591] hover:bg-st-lt-blue focus:ring-4 focus:outline-none font-medium text-sm px-5 py-2.5 text-center inline-flex items-center">
                                <?php echo esc_html( $btn_txt ); ?>
                                <svg aria-hidden="true" class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </div>
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
