<?php
/**
 * Instantiates the Widget Live Editor plugin
 *
 * @package WidgetLiveEditor
 */

namespace WidgetLiveEditor;

/*
Plugin Name: Widget Live Editor
Plugin URI: www.ryankienstra.com/plugins/widget-live-editor
Description: See instant updates as you edit. Select and resize images and vectors. Enter text, and link to any page or post.
Version: 1.0.4
Author: Ryan Kienstra
Author URI: http://ryankienstra.com
License: GPLv2

*/

require_once dirname( __FILE__ ) . '/php/class-plugin.php';
$plugin = Plugin::get_instance();
$plugin->init();
