<div class="grid md:grid-cols-5 grid-cols-1 gap-4">
    <?php if( $cpts ) : ?>
        <?php foreach( $cpts as $cpt ) : ?>
            <div class="
                md:my-0 my-4
                md:px-0 px-4
                md:hover:scale-125 
                md:justify-center 
                md:items-center
                h-64
                border-solid 
                border-st-lt-gray 
                border
                rounded-sm 
                bg-st-white 
                text-center 
                transition 
                duration-300">
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
