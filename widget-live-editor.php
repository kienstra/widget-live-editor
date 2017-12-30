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
Description: A flexible widget, with an image, headline, copy, and link. Resize the image, and link to any page or post.
Version: 1.0.4
Author: Ryan Kienstra
Author URI: http://ryankienstra.com
License: GPLv2

*/

require_once dirname( __FILE__ ) . '/php/class-plugin.php';
$plugin = Plugin::get_instance();
$plugin->init();
