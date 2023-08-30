# Starter theme documentation

## WP hooks & templates

There are several template files in the theme and you are free to create more if needed. Most
templates have a function iteration through ACF flexible content blocks. It looks like this:

```php
<?php if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        $post_id = get_the_ID();
        $blocks  = get_field( 'sections', $post_id );

        if ( $blocks ) {
            foreach ( $blocks as $block ) {
                uni_get_proper_hook($block);
            }
        }

    endwhile;

    // extra sections
    do_action( "uni_tmpl/related_articles" );
endif; ?>
```

In Builderius you should create templates type 'hook'. Each such template would have its own hook in
this format: `uni_tmpl/{$block_name}`. Then you should create ACF flexible content field where each
block should have a unique slug name `{$block_name}`. Example: `uni_tmpl/hero_slider`.

Please, check [this video tutorial](https://www.youtube.com/watch?v=akQ41X669ko] to understand 
better how everything works together.

## Using webpack

### NPM commands

The theme includes a basic webpack setup. Open theme folder in terminal and execute 
`npm i --legacy-peer-deps` to install NPM packages. After that, run `npm run watch` for development
or `npm run build` to build final assets to be used in production.

### SCSS functions

There is a `clamped` SCSS function added to the theme and used in some .scss files. This is a convenient
function helper to quickly set min and max values. Example: `clamped(16px, 18px)`;

