<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * The configuration for theme_saimaniq is defined here.
 *
 * @package     theme_saimaniq
 * @copyright   2023 Brandon Jimenez <brandon.jimenez@concordia.ca>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 // This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// We will add callbacks here as we add features to our theme.
function theme_saimaniq_get_main_scss_content($theme) {        
    global $CFG;        
 
    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;    
    $fs = get_file_storage();

    $context = context_system::instance();

    if ($filename == 'default.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.    
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss'); 
    } else if ($filename == 'plain.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.    
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');       
    } else if ($filename == 'saimaniq.scss') {  
        $scss .= file_get_contents($CFG->dirroot . '/theme/saimaniq/scss/preset/saimaniq.scss');      
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_saimaniq', 'preset', 0, '/', $filename))) {     
        // This preset file was fetched from the file area for theme_saimaniq and not theme_boost (see the line above).       
        $scss .= $presetfile->get_content();       
    } else {   
        // Safety fallback - maybe new installs etc.        
        //$scss .= file_get_contents($CFG->dirroot . '/theme/saimaniq/scss/preset/concordia2.scss');
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');    
    }
     // Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.    
     $pre = file_get_contents($CFG->dirroot . '/theme/saimaniq/scss/pre.scss');
     // Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.
     $post = file_get_contents($CFG->dirroot . '/theme/saimaniq/scss/post.scss');
     
     // Combine them together.    
    return $pre . "\n" . $scss . "\n" . $post;      
}

/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme
 *            The theme config object.
 * @return string
 */
function theme_saimaniq_get_pre_scss($theme) {
    $scss = '';
    $configurable = [       
        // Config key => [variableName, ...].         
        'brandcolor'          => ['brand-primary'],            
        'cardbg'              => ['card-bg'],
        'loginbgopacity'      => ['loginbgopacity'],
        'loginformopacity'    => ['loginformopacity'],
        'loginformposition'   => ['loginformposition'],
        'loginbackgroundcolor'=> ['loginbackgroundcolor'],
        'defaultnobackground' => ['defaultnobackground'],
    ];
    
    $backgroundimageurl = $theme->setting_file_url('loginbgimage', 'loginbgimage');

    $scss .= (!empty($backgroundimageurl)) ? "\$login-backgroundimage: '$backgroundimageurl';\n" : "\$login-backgroundimage: none;\n";

    // Prepend variables first.          
    foreach ($configurable as $configkey => $targets) {            
        $value = isset($theme->settings->{$configkey}) ? $theme->settings->{$configkey} : null;           
        if (empty($value)) {
            continue;       
        }      
        array_map(function($target) use (&$scss, $value) {         
            $scss .= '$' . $target . ': ' . $value . ";\n";
        }, (array) $targets);            
    }
    $loginformposition = $theme->settings->loginformposition;
    $blockquoteposition = '';
    if ($loginformposition=='left'){
        $blockquoteposition = 'right';
    }
    else if ($loginformposition=='right'){
        $blockquoteposition = 'left';
    } else {
        $blockquoteposition = 'center';
    }
    $scss .= '$blockquoteposition: ' . $blockquoteposition . ";\n";
    //$scss .= "body #page-wrapper { background-image: url(". '$'.'login-backgroundimage '.") !important; }\n";
    // Prepend pre-scss.
    if (! empty($theme->settings->scsspre)) {
        $scss .= $theme->settings->scsspre;
    }
    return $scss;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_saimaniq_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM) {
        $theme = theme_config::load('saimaniq');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (! array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}