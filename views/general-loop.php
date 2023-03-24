<div class="flex flex-wrap justify-between">
    <?php if( $cpts ) : ?>
        <?php foreach( $cpts as $cpt ) : ?>
            <div
                class="
                md:w-1/6 
                h-64
                w-full
                border-solid 
                border-st-lt-gray 
                border 
                rounded-sm 
                md:my-0 my-4 
                bg-st-white 
                text-center 
                md:px-0 px-4 
                transition 
                duration-500 
                md:hover:scale-125 
                md:justify-center 
                md:items-center">
                <a href="<?php the_permalink( $cpt->ID ); ?>">
                    <img
                        class="h-36 w-full object-cover"
                        src="<?php echo esc_url( get_the_post_thumbnail_url( $cpt->ID ) ); ?>" 
                        alt="<?php echo esc_attr( get_the_title( $cpt->ID ) ); ?>"
                        />
                </a>
                <a href="<?php the_permalink( $cpt->ID ); ?>">
                    <h5 class="py-4"><?php echo get_the_title( $cpt->ID ); ?></h5>
                </a>
            </div>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
</div>
