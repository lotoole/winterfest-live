<?php

new winterfest();

class winterfest {
    private $version;

    public static $sm = '(min-width: 576px)';
    public static $md = '(min-width: 768px)';
    public static $lg = '(min-width: 992px)';
    public static $xl = '(min-width: 1200px)';

    function __construct() {
        $theme = wp_get_theme();
        $this->version = $theme->Version;

        add_theme_support( 'menus' );
        add_theme_support( 'post-thumbnails' );

        add_image_size( 'icon', 60, 60, true );
        add_image_size( 'excerpt', 640, 480, true );
        add_image_size( 'share', 1200, 630, true );
        add_image_size( 'hero', 1280, 1000, true );
        add_image_size( 'section-heading', 1280, 600, true );

        add_image_size( 'square', 640, 640, true );
        add_image_size('square_two', 500, 500, true);
        add_image_size('square_three', 400, 400, true);
        add_image_size('square_four', 300, 300, true);
        add_image_size('square_six', 200, 200, true);

        add_action( 'admin_init',                   array( $this, 'add_editor_styles' ) );
        add_action( 'init',                         array( $this, 'action_register_nav_menus' ) );
        add_action( 'init',                         array( $this, 'action_acf_add_options_page' ) );
        add_action( 'init',                         array( $this, 'register_taxonomy_country' ) );
        add_action( 'acf/init',                     array( $this, 'action_acf_init' ) );
        add_action( 'wp_enqueue_scripts',           array( $this, 'action_enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts',           array( $this, 'action_enqueue_styles' ), 20 );
        add_action( 'admin_enqueue_scripts',        array( $this, 'action_admin_enqueue_styles' ) );
        add_action( 'pre_get_posts',                array( $this, 'action_modify_walk_query' ) );
        add_action( 'save_post',                    array( $this, 'action_save_tweet' ) );

        add_filter( 'post_type_link',               array( $this, 'filter_post_type_link' ), 10, 2 );
        add_filter( 'body_class',                   array( $this, 'filter_body_class' ) );
        add_filter( 'mce_buttons_2',                array( $this, 'filter_mce_buttons_2' ) );
        add_filter( 'tiny_mce_before_init',         array( $this, 'filter_tiny_mce_before_init' ) );
        add_filter( 'attachment_fields_to_edit',    array( $this, 'filter_image_attachment_fields_to_edit' ), null, 2);
        add_filter( 'attachment_fields_to_save',    array( $this, 'filter_image_attachment_fields_to_save' ), null , 2);
        add_filter( 'wp_get_attachment_image_attributes', array( $this, 'filter_wp_get_attachment_image_attributes' ), 10, 2 );
        add_filter( 'template_include',             array( $this, 'filter_template_include' ) );
        add_filter( 'image_size_names_choose',      array( $this, 'filter_image_size_names_choose' ) );
        add_filter( 'excerpt_length',               array( $this, 'filter_excerpt_length' ) );
        add_filter( 'post_link',                    array( $this, 'filter_post_link' ), 10, 2 );
        add_filter( 'next_posts_link_attributes',   array( $this, 'posts_link_attributes' ) );
        add_filter( 'previous_posts_link_attributes', array( $this, 'posts_link_attributes' ) );
    }

    function add_editor_styles() {
        add_editor_style( 'static/css/editor.css' );
    }

    function action_register_nav_menus() {
        register_nav_menus(
            array(
                'primary' => 'Primary Navigation in Header',
                'secondary' => 'Secondary Navigation in Header',
                'footer' => 'Navigation in Footer'
            )
        );
    }

    function action_acf_add_options_page() {
        if ( function_exists( 'acf_add_options_page' ) ) {
            acf_add_options_page();
        }
    }

    function register_taxonomy_country() {
        $labels = array(
            'name'                       => 'Countries',
            'singular_name'              => 'Country',
        );

        $args = array(
            'labels'                     => $labels,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'hierarchical'               => true
        );

        register_taxonomy( 'country', array( 'team_member' ), $args );
    }

    function action_acf_init() {
        acf_update_setting( 'google_api_key', GOOGLE_MAPS_API_KEY );
    }

    function action_enqueue_scripts() {
        // Header
        wp_enqueue_script( 'head', get_stylesheet_directory_uri() . '/static/js/head.min.js', false, $this->version, false );

        // Footer
        wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/static/js/main.js', false, $this->version, true );
        wp_enqueue_script( 'google-translate', '//translate.google.com/translate_a/element.js?cb=winterfest.init_google_translate_element', array( 'main' ), null, true );

        $data = array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'template_directory_url' => get_stylesheet_directory_uri(),
            'walks' => self::get_walk_data(),
            'page_titles' => self::get_page_titles(),
        );

        wp_localize_script( 'main', 'winterfest', $data );
    }

    function action_enqueue_styles() {
        wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/static/css/main.css', false, $this->version );
        wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css?family=Oswald:300,400,700', false, $this->version );
        // Remove unnecessary styles
        wp_deregister_style( 'contact-form-7' );
        wp_deregister_style( 'wordpress-popular-posts' );
    }

    function action_admin_enqueue_styles() {
        // wp_enqueue_style( 'admin', get_stylesheet_directory_uri() . '/static/css/admin.css', false, $this->version, 'admin' );
    }

    function action_modify_walk_query( $query ) {
        if ( $query->get( 'post_type') !== 'walk' ) {
            return false;
        }

        $query->set( 'orderby', 'menu_order' );
        $query->set( 'order', 'ASC');
    }

    function action_save_tweet($post_id) {
        $tweet = get_field( 'tweet_url' );

        if ( !$tweet ) {
          return false;
        }

        require_once( dirname( __FILE__ ) . '/includes/twitter.php' );

        if ($tweet = self::get_tweet($tweet)) {
          update_post_meta($post_id, 'tweet_profile_image', $tweet->user->profile_image_url_https);
          update_post_meta($post_id, 'tweet_screen_name', $tweet->user->screen_name);
          update_post_meta($post_id, 'tweet_name', $tweet->user->name);
          update_post_meta($post_id, 'tweet_text', $tweet->full_text);
          update_post_meta($post_id, 'tweet_image', self::get_image_from_tweet($tweet));
          update_post_meta($post_id, 'tweet_video', self::get_video_from_tweet($tweet));

          // unhook this function so it doesn't loop infinitely
          remove_action('save_post', array($this, 'action_save_tweet'));

          // update the post, which calls save_post again
          $shorter_string = (strlen($tweet->full_text) > 30) ? substr($tweet->full_text,0,27).'...' : $tweet->full_text;
          wp_update_post(array(
            'ID'  => $post_id,
            'post_title' => $shorter_string,
          ));

          // re-hook this function
          add_action('save_post', array($this, 'action_save_tweet'));
        }
        add_action('save_post', 'action_save_tweet');
    }

    function filter_post_type_link( $url, $post ) {
        $permalink = get_field( 'permalink', $post->ID );

        return $permalink ? $permalink : $url;
    }

    function filter_body_class( $classes ) {
        global $post;

        if ( isset( $post ) && is_singular() ) {
            $classes[] = $post->post_type . '-' . $post->post_name;
        }

        if ( !empty( $_REQUEST['format'] ) && 'print' == $_REQUEST['format'] ) {
            $classes[] = 'noscroll';
        }

        if ( is_singular( 'post' ) ) {
            $classes[] = 'article-active';
        }

        return $classes;
    }

    function filter_mce_buttons_2( $buttons ) {
        array_unshift( $buttons, 'styleselect' );
        return $buttons;
    }

    function filter_tiny_mce_before_init( $init ) {
        $style_formats = array(
            array(
                'title' => 'Arrow',
                'block' => 'p',
                'classes' => 'arrow',
                'wrapper' => false,
            ),
            array(
                'title' => 'Button Regular',
                'inline' => 'a',
                'block' => 'a',
                'classes' => 'btn btn-primary',
                'wrapper' => false,
            ),
            array(
                'title' => 'Button Orange',
                'inline' => 'a',
                'block' => 'a',
                'classes' => 'btn btn-primary-orange',
                'wrapper' => false,
            ),
            array(
                'title' => 'Button - Block',
                'inline' => 'a',
                'block' => 'a',
                'classes' => 'btn btn-primary btn-block',
                'wrapper' => false,
            ),
            array(
                'title' => 'Button - Outline',
                'inline' => 'a',
                'block' => 'a',
                'classes' => 'btn btn-outline',
                'wrapper' => false,
            ),
            array(
                'title' => 'Callout',
                'block' => 'div',
                'classes' => 'callout',
                'wrapper' => false,
            ),
            array(
                'title' => 'Caption',
                'block' => 'p',
                'classes' => 'caption',
                'wrapper' => false,
            ),
            array(
                'title' => 'Cite',
                'block' => 'cite',
                'wrapper' => true,
            ),
            array(
                'title' => 'Intro',
                'block' => 'p',
                'classes' => 'intro',
                'wrapper' => false,
            ),
            array(
                'title' => 'Intro - Large',
                'block' => 'p',
                'classes' => 'intro-lg',
                'wrapper' => false,
            ),
            array(
                'title' => 'Label',
                'block' => 'p',
                'classes' => 'label',
                'wrapper' => false,
            ),
            array(
                'title' => 'List With Columns',
                'block' => 'ul',
                'classes' => 'list-with-columns',
                'wrapper' => false,
            ),
            array(
                'title' => 'List Header',
                'block' => 'li',
                'classes' => 'list-header',
                'wrapper' => false,
            ),
            array(
                'title' => 'Label - Blue',
                'block' => 'p',
                'classes' => 'label-blue',
                'wrapper' => false,
            ),
        );

        $init['style_formats'] = json_encode( $style_formats );

        $custom_colours = array(
            'FFFFFF', 'White',
            '484848', 'Black',
            'E15F55', 'Red 1',
            'E03C31', 'Red 2',
            'D9AD38', 'Gold',
            '326EAD', 'Blue',
            'CF8148', 'Orange',
            '94AF54', 'Green',
            '168DA2', 'Teal',
            'DB8675', 'Pink',
            'E3B270', 'Manhattan',
            'EAB793', 'Wax',
            '8C8752', 'Olive',
        );

        $init['textcolor_map'] = json_encode( $custom_colours );
        $init['textcolor_cols'] = 8;

        return $init;
    }

    function filter_image_attachment_fields_to_edit( $form_fields, $post ) {
        $form_fields['credit'] = array(
            'label' => 'Photo Credit',
            'input' => 'text',
            'value' => get_post_meta( $post->ID, 'credit', true ),
        );

        $form_fields['link'] = array(
            'label' => 'Link',
            'input' => 'text',
            'value' => get_post_meta( $post->ID, 'link', true ),
            'helps' => 'Use to link an image in the gallery to a video.',
        );

        return $form_fields;
    }

    function filter_image_attachment_fields_to_save( $post, $attachment ) {
        if ( isset( $attachment['credit'] ) ){
            update_post_meta( $post['ID'], 'credit', $attachment['credit'] );
        }

        if ( isset( $attachment['link'] ) ){
            update_post_meta( $post['ID'], 'link', $attachment['link'] );
        }

        return $post;
    }

    function filter_wp_get_attachment_image_attributes( $attr, $attachment ) {
        if ($credit = get_post_meta( $attachment->ID, 'credit', true )) {
            $attr['data-credit'] = $credit;
        }
        return $attr;
    }

    function filter_template_include( $template ) {
        global $wp_query;

        if ( $wp_query->is_search && 'post' == $wp_query->get('post_type') ) {
            $template = locate_template( 'archive.php' );
        }

        return $template;
    }

    function filter_image_size_names_choose( $sizes ) {
        $sizes['excerpt'] = 'Excerpt';
        $sizes['excerpt-wide'] = 'Excerpt Wide';
        $sizes['square'] = 'Square';

        return $sizes;
    }

    function filter_excerpt_length() {
      return 30;
    }

    function filter_post_link( $permalink, $post ) {
        if ( get_field( 'permalink', $post ) ) {
            return get_field( 'permalink', $post );
        }

        return $permalink;
    }

    function posts_link_attributes() {
      return 'class="pagination-link"';
    }

    static function is_ajax() {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    static function get_header() {
        if (!self::is_ajax()) { get_header(); };
    }

    static function get_footer() {
        if (!self::is_ajax()) { get_footer(); };
    }

    static function get_pagination( $query = null ) {
        global $wp_query;

        $query = $query ? $query : $wp_query;

        return paginate_links( array(
            'current' => max( 1, get_query_var( 'paged' ) ),
            'total' => $query->max_num_pages,
        ) );
    }

    static function fields_to_classes() {
        $fields = func_get_args();
        $field_values = array_map( function ( $field ) {
            return get_sub_field( $field );
        }, $fields );
        $field_values = array_filter( $field_values );

        return implode( ' ', $field_values );
    }

    static function truncate_string( $string, $limit, $break = '.', $pad = '...' ) {
        // return with no change if string is shorter than $limit
        if ( strlen( $string ) <= $limit ) {
            return $string;
        }

        // is $break present between $limit and the end of the string?
        if ( false !== ( $breakpoint = strpos( $string, $break, $limit ) ) ) {
            if ( $breakpoint < strlen( $string ) - 1) {
                $string = substr( $string, 0, $breakpoint ) . $pad;
            }
        }

        return $string;
    }

    static function format_url( $url ) {
        $parts = parse_url( $url );

        if ( !empty( $parts['host'] ) ) {
            return str_replace( 'www.', '', $parts['host'] );
        }

        return $url;
    }

    static function get_country_slugs( $post ) {
        $countries = wp_get_post_terms( $post->ID, 'country' );
        $slugs = wp_list_pluck( $countries, 'slug' );
        return implode(' ', $slugs);
    }

    static function format_comment($comment, $args, $depth) {
       ?>

      <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div class="comment-wrap">
          <img src="<?php echo get_avatar_url($comment); ?>" alt="">
           <div class="comment-intro">
               <a class="comment-permalink" href="<?php echo htmlspecialchars ( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf("",comment_author_link()); ?></a>
               <?php comment_date('m/d/y'); ?>
               <?php comment_text(); ?>
           </div>
        </div>
         <?php
    }

    static function get_walk_data() {
        $walks = get_posts( array( 'post_type' => 'walk', 'posts_per_page' => -1 ) );
        $walk_data = array();

        foreach( $walks as $walk ) {
            $walk_data[$walk->post_name] = array(
                'slug' => $walk->post_name,
                'title' => $walk->post_title,
                'date' => get_field('walk_date', $walk->ID),
                'blurb' => get_field('walk_blurb', $walk->ID),
                'features' => get_field('walk_path', $walk->ID),
                'status' => get_field('walk_status', $walk->ID),
                'permalink' => get_permalink($walk),
            );
        }

        return $walk_data;
    }

    static function get_page_titles() {
      $page_titles = array();
      $pages = new WP_Query( array(
        'post_type' => array('post', 'page', 'walk'),
        'posts_per_page' => -1,
      ) );

      foreach ($pages->posts as $page) {
        $page_titles[get_permalink($page)] = sprintf('%s - %s', $page->post_title, get_bloginfo('name'));
      }

      return $page_titles;
    }

    static function get_status_id_from_url( $url ) {
        $url_parts = explode( '/', $url );

        return array_pop( $url_parts );
    }

    static function get_image_from_tweet( $tweet ) {
        if ( isset($tweet->entities->media[0]->media_url_https) ) {
            return $tweet->entities->media[0]->media_url_https;
        }
        return null;
    }

    static function get_video_from_tweet( $tweet ) {
        if (!isset($tweet->extended_entities->media[0]->video_info->variants)) {
            return null;
        }

        $video = null;
        $max_bitrate = 0;
        $variants = $tweet->extended_entities->media[0]->video_info->variants;
        foreach ($variants as $variant) {
            if ( !isset($variant->content_type) || 'video/mp4' !== $variant->content_type) {
                continue;
            }

            if ( !isset($variant->bitrate) || $max_bitrate > $variant->bitrate) {
                continue;
            }

            $max_bitrate = $variant->bitrate;
            $video = $variant->url;
        }

        return $video;
    }

    static function get_tweet( $status_url ) {
        require_once( dirname( __FILE__ ) . '/includes/twitter.php' );

        $args = array(
            'id' => self::get_status_id_from_url( $status_url ),
            'include_entities' => true,
            'tweet_mode' => 'extended'
        );
        $response = Twitter::get_tweets( 'statuses/show', $args );

        return $response;
    }

    static function remove_last_url_from_tweet($str) {
        $last_url_index = strrpos($str, 'https://t.co');
        if (false !== $last_url_index) {
            return substr($str, 0, $last_url_index);
        }
        return $str;
    }

    static function linkify_urls($str) {
        return preg_replace('/(http[s]{0,1}\:\/\/\S{4,})\s{0,}/ims', '<a href="$1" target="_blank">$1</a> ', $str);
    }

    static function format_tweet($str) {
        return self::linkify_urls(self::remove_last_url_from_tweet($str));
    }

    static function facebook_share_url( $args = null ) {
        $args = wp_parse_args( $args, array(
            'u' => get_the_permalink(),
        ) );
        $args = array_filter( $args );
        $url = 'https://www.facebook.com/sharer/sharer.php?' . http_build_query( $args );

        return $url;
    }

    static function twitter_share_url( $args = null ) {
        global $post;

        $args = wp_parse_args( $args, array(
            'text' => $post->post_title,
            'url' => get_the_permalink(),
            'related' => false,
            'via' => 'JaguarJourney',
        ) );
        $args = array_filter( $args );
        $args['text'] = self::truncate_string( $args['text'], 116, ' ' );
        $url = 'https://twitter.com/intent/tweet?' . http_build_query( $args );

        return $url;
    }

    static function get_previous_post( $post ) {
        $walk = get_field( 'walk', $post );
        $previous = new WP_Query(array(
            'post_type' => 'post',
            'meta_query' => array(
                array(
                    'key'     => 'walk',
                    'value'   => $walk->ID,
                ),
            ),
            'date_query' => array(
                array(
                    'before' => $post->post_date,
                    'inclusive' => false,
                ),
            ),
            'order' => 'DESC',
            'posts_per_page' => 1
        ));

        return isset($previous->posts[0]) ? $previous->posts[0] : null;
    }

    static function get_next_post( $post ) {
        $walk = get_field( 'walk', $post );
        $next = new WP_Query(array(
            'post_type' => 'post',
            'meta_query' => array(
                array(
                    'key'     => 'walk',
                    'value'   => $walk->ID,
                ),
            ),
            'date_query' => array(
                array(
                    'after' => $post->post_date,
                    'inclusive' => false,
                ),
            ),
            'order' => 'ASC',
            'posts_per_page' => 1
        ));

        return isset($next->posts[0]) ? $next->posts[0] : null;
    }

    static function widont($str) {
        return preg_replace('|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', $str);
    }

    static function go_back_url() {
        $previous = !empty($_GET['previous']) ? $_GET['previous'] : null;

        return $previous ? $previous : site_url( '/news/' );
    }

    static function get_related_posts( $post ) {
      $cats = wp_get_post_terms( $post->ID, 'category', ['fields' => 'ids'] );

      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post__not_in' => array( $post->ID ),
        'tax_query' => array(
          array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $cats,
            'operator' => 'AND',
          ),
        ),
      );

      return new WP_Query( $args );
    }
}
