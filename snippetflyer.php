<?php
    /**
     *  Snippet Flyer
     *
     *  @package     Snippet Flyer
     *  @author      S. Saif
     *  @copyright   2022 S. Saif
     *  @license     GPL-2.0+
     *
     *  @wordpress-plugin
     *  Plugin Name: Snippet Flyer
     *  Description: Add beautiful code snippets to your blog posts or content area.
     *  Author: S. Saif
     *  Author URI: http://www.saif.im
     *  Text Domain: snippetflyer
     *  License:     GPL-2.0+
     *  License URI: http://www.gnu.org/license/gpl-2.0.txt
     *  Version: 1.0.1
     */

    /*
        Copyright 2012-2022  Saifullah Siddique (email : info@saifullah.co)
    */

    if ( !defined( 'ABSPATH' ) ) {
        exit;
        // Exit if accessed directly.
    }

    function snippetFlyer($attr, $content) {
        $default_language = array(
            'lang' => ''
        );

        $language_attr = shortcode_atts( $default_language, $attr );

        return sprintf(
            '<div class="codeblock">
                <div class="codeDiv">
                    <svg xmlns="http://www.w3.org/2000/svg" width="54" height="14" viewBox="0 0 54 14">
                        <g fill="none" fill-rule="evenodd" transform="translate(1 1)">
                            <circle cx="6" cy="6" r="6" fill="#FF5F56" stroke="#E0443E" stroke-width=".5"></circle>
                            <circle cx="26" cy="6" r="6" fill="#FFBD2E" stroke="#DEA123" stroke-width=".5"></circle>
                            <circle cx="46" cy="6" r="6" fill="#27C93F" stroke="#1AAB29" stroke-width=".5"></circle>
                        </g>
                    </svg>

                    <pre>
                        <code class="language-%s">
                            %s
                        </code>
                    </pre>
                </div>
            </div>',
            $language_attr['lang'],
            strip_tags($content)
        );
    }
    add_shortcode( 'sf-editor', 'snippetFlyer' );

    /**
     * Enqueue stylesheets for WP Accessibility.
     */
    function snippetflyer_stylesheet() {
        // Add CSS
        wp_register_style( 'snippetflyer-css', plugins_url('/css/editor.css', __FILE__));
        wp_enqueue_style( 'snippetflyer-css' );
        wp_register_style( 'snippetflyer-hljs-css', plugins_url( '/css/solarized_dark.css', __FILE__ ));
        wp_enqueue_style( 'snippetflyer-hljs-css' );

        // Add JS
        wp_register_script( 'snippetflyer-hljs', plugins_url( '/js/highlight.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'snippetflyer-hljs' );
        wp_register_script( 'snippetflyer-app', plugins_url( '/js/app.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'snippetflyer-app' );
    }
    add_action( 'wp_enqueue_scripts', 'snippetflyer_stylesheet' );
