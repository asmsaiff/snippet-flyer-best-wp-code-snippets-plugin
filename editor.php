<?php
    /**
     *  Editor
     *
     *  @package     Editor
     *  @author      Saifullah Siddique
     *  @copyright   2022 Saifullah Siddique
     *  @license     GPL-2.0+
     *
     *  @wordpress-plugin
     *  Plugin Name: Editor
     *  Description: Add beautiful code snippets to your blog posts or content area.
     *  Author: Saifullah Siddique
     *  Author URI: http://www.saifullah.co
     *  Text Domain: editor
     *  License:     GPL-2.0+
     *  License URI: http://www.gnu.org/license/gpl-2.0.txt
     *  Version: 1.0.0
     */

    /*
        Copyright 2012-2022  Saifullah Siddique (email : info@saifullah.co)
    */

    if ( !defined( 'ABSPATH' ) ) {
        exit;
        // Exit if accessed directly.
    }

    function _editor($attr, $content) {
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
    add_shortcode( 'editor', '_editor' );

    /**
     * Enqueue stylesheets for WP Accessibility.
     */
    function editor_stylesheet() {
        // Add CSS
        wp_register_style( 'editor-css', plugins_url('/css/editor.css', __FILE__));
        wp_enqueue_style( 'editor-css' );
        wp_register_style( 'editor-hljs-css', plugins_url( '/css/solarized_dark.css', __FILE__ ));
        wp_enqueue_style( 'editor-hljs-css' );

        // Add JS
        wp_register_script( 'editor-hljs', plugins_url( '/js/highlight.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'editor-hljs' );
        wp_register_script( 'editor-app', plugins_url( '/js/app.js', __FILE__ ), null, time(), true );
        wp_enqueue_script( 'editor-app' );
    }
    add_action( 'wp_enqueue_scripts', 'editor_stylesheet' );