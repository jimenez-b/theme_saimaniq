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
    /*} else if ($filename == 'cole.scss') {                                                                                         
        $scss .= file_get_contents($CFG->dirroot . '/theme/saimaniq/scss/preset/cole.scss'); */                                 
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_saimaniq', 'preset', 0, '/', $filename))) {              
        // This preset file was fetched from the file area for theme_saimaniq and not theme_boost (see the line above).                
        $scss .= $presetfile->get_content();                                                                                        
    } else {                                                                                                                        
        // Safety fallback - maybe new installs etc.                                                                                
        //$scss .= file_get_contents($CFG->dirroot . '/theme/saimaniq/scss/preset/concordia2.scss');
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');                                        
    }                                                                                                                                       
     // Pre CSS - this is loaded AFTER any prescss from the setting but before the main scss.                                        
     //$pre = file_get_contents($CFG->dirroot . '/theme/saimaniq/scss/pre.scss');                                                         
     $pre = file_get_contents($CFG->dirroot . '/theme/boost/scss/pre.scss');
     // Post CSS - this is loaded AFTER the main scss but before the extra scss from the setting.                                    
     //$post = file_get_contents($CFG->dirroot . '/theme/saimaniq/scss/post.scss');    
     $post = file_get_contents($CFG->dirroot . '/theme/boost/scss/post.scss');
     
     // Combine them together.                                                                                                       
    return $pre . "\n" . $scss . "\n" . $post;                                                                                                         
}