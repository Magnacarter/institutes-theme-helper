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
        <div class="bg-st-bg-gray border-solid border-y-[1px] border-st-lt-gray">
            <div id="consult-form" class="max-w-6xl mx-auto flex justify-between flex-wrap px-4 py-12">
                <div class="w-full pb-4 border-b border-black border-solid mb-12">
                    <h2>Request A Consultation</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-st-white p-4">
                        <h3 class="uppercase text-black py-3"><?php echo esc_html( $page_name ); ?></h3>
                        <div class="blue-bottom-borrder border-solid border-b-4 border-st-lt-blue w-24 mb-3"></div>
                        <div>
                            <?php if ( get_field( 'address_description', $post->ID  ) ) : ?>
                                <?php the_field( 'address_description', $post->ID ); ?>
                            <?php endif; ?>
                            <div class="flex my-6">
                                <div class="address-icon mx-4"></div>
                                <div class="ml-2">
                                    <h3>Main Address:</h3>
                                    <?php the_field( 'address', $post->ID ); ?>
                                </div>
                            </div>
                            <div class="flex my-6">
                                <div class="phone-icon mx-4"></div>
                                <div class="ml-2">
                                    <h3>Phone:</h3>
                                    <p><?php the_field( 'phone_number', $post->ID ); ?></p>
                                </div>
                            </div>
                            <div class="flex my-6">
                                <div class="email-icon mx-4"></div>
                                <div class="ml-2">
                                    <h3>Email:</h3>
                                    <p><?php the_field( 'email', $post->ID ); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-st-white p-4">
                        <h3 class="uppercase text-black py-3">Contact</h3>
                        <div class="blue-bottom-borrder border-solid border-b-4 border-st-lt-blue w-24 mb-3"></div>
                        <?php $shortcode = get_field( 'form_shortcode', $post->ID ); ?> 
                        <?php echo do_shortcode( "{$shortcode}" ); ?>
                        <p class="form-disclaimer text-center italic text-[#666666]"><?php the_field( 'form_disclaimer', $post->ID ); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- This can be updated to hold user input icons and their styles -->
        <style>
            .address-icon:before {
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                content: "\f3c5";
                font-size: 24px;
                color: #0da2e4;
                display: inline-block;
            }
            .phone-icon:before {
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                content: "\f095";
                font-size: 24px;
                color: #0da2e4;
            }
            .email-icon:before {
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                content: "\f0e0";
                font-size: 24px;
                color: #0da2e4;
            }
        </style>
        <?php
    }
}
