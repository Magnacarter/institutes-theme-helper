<?php
/**
 * Create Faculty Sections
 */
namespace Soundst\Theme_Helper;
use WP_Query;

new Faculty_Sections();

class Faculty_Sections {
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
        add_action( 'render_faculty_hero', [$this, 'build_hero_section'] );
        add_action( 'render_faculty_profile', [$this, 'build_profile_section'] );
        add_action( 'render_faculty_credentials_primary', [$this, 'build_credentials_primary'] );
        add_action( 'render_faculty_credentials_secondary', [$this, 'build_credentials_secondary'] );
    }

    /**
     * Build the hero section.
     */
    public function build_hero_section() {
        $title = get_the_title( $this->id );
        ?>
        <div class="hero-wrapper py-4">
            <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4">
                <h1 class="text-st-white"><?php echo esc_html( $title ); ?></h1>
            </div>
        </div>
        <style>
            .hero-wrapper {
                background-image: url('<?php echo get_site_url(); ?>/wp-content/uploads/2021/02/4_web_web.jpg');
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                padding: 8rem 0;
            }
        </style>
        <?php
    }

    /**
     * Build the physician section.
     */
    public function build_profile_section() {
        $title   = get_the_title( $this->id );
        $img     = get_the_post_thumbnail( $this->id );
        $content = get_the_content( $this->id );
        ?>
        <div class="physician-wrapper py-4">
            <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-4">
                <div class="md:w-5/12 w-full">
                    <?php echo $img; ?>
                </div>
                <div class="content-wrapper md:w-6/12 w-full">
                    <div class="w-full pb-4 border-b border-black border-solid mb-8">
                        <h2><?php echo esc_html( $title ); ?></h2>
                    </div>
                    <?php echo $content; ?>
                    <a href="#consult-form" class="
                        content-btn
                        uppercase
                        font-bold 
                        mt-4
                        text-st-white 
                        bg-st-dk-blue hover:bg-st-lt-blue focus:ring-4 focus:outline-none 
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
     * Build the primary creds section.
     */
    public function build_credentials_primary() {
        $title = get_the_title( $this->id );
        if( have_rows( 'creds_one' ) ) : ?>
            <div class="faq-wrapper">
                <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-12">
                    <div class="w-full pb-4 border-b border-black border-solid mb-8">
                        <h2><?php echo esc_html( $title ); ?> CREDENTIALS</h2>
                    </div>
                    <div class="grid gap-x-8 gap-y-8 grid-cols-2">
                        <?php $j = 0; ?>
                        <?php while( have_rows( 'creds_one' ) ) : the_row(); 
                            $label = get_sub_field( 'credential_label' );
                            if ( $j == 0 || $j == 1 ) : ?>                        
                                <div>
                                    <h4><?php echo esc_html( $label ); ?></h4>
                                    <?php if ( have_rows( 'credentials_list' ) ) : ?>
                                        <ul class="list-outside">
                                        <?php $i = 0; ?>
                                        <?php while( have_rows( 'credentials_list' ) ) : the_row(); ?>
                                            <?php if ( $i % 2 == 0 ) : ?>
                                                <li class="py-2 cred-list-item"><strong><?php echo esc_html( get_sub_field( 'credential' ) ); ?></strong></li>
                                            <?php else : ?>
                                                <li class="py-2 cred-list-item-indent"><?php echo esc_html( get_sub_field( 'credential' ) ); ?></li>
                                            <?php endif; ?>
                                            <?php $i++; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            <?php else : ?>
                                <div>
                                    <h4><?php echo esc_html( $label ); ?></h4>
                                    <?php if ( have_rows( 'credentials_list' ) ) : ?>
                                        <ul class="list-outside">
                                        <?php $i = 0; ?>
                                        <?php while( have_rows( 'credentials_list' ) ) : the_row(); ?>
                                            <li class="py-2 cred-list-item"><?php echo esc_html( get_sub_field( 'credential' ) ); ?></li>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <?php $j++; ?>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <style>
                .cred-list-item-indent {
                    list-style-position: inside;
                    text-indent: -1px;
                    padding-left: 32px;
                }
            </style>
        <?php endif;
    }

    /**
     * Build the secondary creds section.
     */
    public function build_credentials_secondary() {
        $title = get_the_title( $this->id );
        if( have_rows( 'creds_two' ) ) : ?>
            <div class="cred-wrapper">
                <div class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-12">
                    <div class="w-full pb-4 border-b border-black border-solid mb-8">
                        <h2><?php echo esc_html( $title ); ?> CREDENTIALS CONTINUED</h2>
                    </div>
                    <div class="grid gap-x-8 gap-y-8 grid-cols-2">
                        <?php $i = 0; ?>
                        <?php while( have_rows( 'creds_two' ) ) : the_row(); 
                            $label = get_sub_field( 'credential_label' );
                            ?>
                            <div>
                                <h4><?php echo esc_html( $label ); ?></h4>
                                <?php if ( have_rows( 'credentials_list' ) ) : ?>
                                    <ul class="list-outside">
                                    <?php while( have_rows( 'credentials_list' ) ) : the_row(); ?>
                                        <li class="py-2 cred-list-item"><?php echo esc_html( get_sub_field( 'credential' ) ); ?></li>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <style>
                .cred-list-item {
                    list-style-position: inside;
                    text-indent: -27px;
                    padding-left: 30px;
                }
                .cred-list-item:before {
                    margin-right: 13px;
                    font-family: "Font Awesome 5 Free";
                    font-weight: 900;
                    content: "\f138";
                    font-size: 14px;
                    color: #0da2e4;
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
