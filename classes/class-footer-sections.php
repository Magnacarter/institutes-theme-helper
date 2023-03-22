<?php
/**
 * Footer form and address sections.
 */
namespace Soundst\Footer_Sections;

new Footer_Sections();

class Footer_Sections {
    public function __construct() {
        add_action( 'render_footer_sections', [$this, 'footer_sections'] );
    }

    public function footer_sections() {
        global $post;
        $page_name = get_the_title( $post->ID );
        ?>
        <div class="bg-st-bg-gray">
            <div id="consult-form" class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-12">
                <div class="w-full pb-4 border-b border-black border-solid mb-12">
                    <h2>Request A Consultation</h2>
                </div>
                <div class="w-1/2 bg-st-white p-4">
                    <h3 class="uppercase text-black py-3"><?php echo esc_html( $page_name ); ?></h3>
                </div>
                <div class="w-1/2 bg-st-white p-4">
                    <h3 class="uppercase text-black py-3">Contact</h3>
                    <?php echo do_shortcode( '[gravityform id="1" title="false" description="false" ajax="true"]' ); ?>
                </div>
            </div>
        </div>
        <?php
    }
}
