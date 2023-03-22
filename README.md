##
Tailwind Docs
https://tailwindcss.com/docs/installation

##
Run Tailwind in plugin root dir after installing node moudules.
```npx tailwindcss -i ./assets/css/input.css -o ./dist/output.css --watch```

##
Build single-posttypes.php in the theme with the plugin's custum action hooks
```
<?php
/**
 * Template for single institutes.
 */
 get_header();

   do_action( 'render_hero' );
   do_action( 'render_welcome_section' );
   do_action( 'render_centers_section' );
   do_action( 'render_footer_sections' );

 get_footer();`
```