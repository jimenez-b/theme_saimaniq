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
 * Plugin administration pages are defined here.
 *
 * @package     theme_saimaniq
 * @category    admin
 * @copyright   created for Concordia University 2023 by Brandon Jimenez <brandon.jimenez@concordia.ca>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$page = new admin_settingpage('theme_saimaniq_login', get_string('settingsloginpage', 'theme_saimaniq'));

$page->add(new admin_setting_heading('theme_saimaniq_login', get_string('loginsettingsheading', 'theme_saimaniq'),
        format_text(get_string('logindesc', 'theme_saimaniq'), FORMAT_MARKDOWN)));

// Login page background image.
$name = 'theme_saimaniq/loginbgimage';
$title = get_string('loginbgimage', 'theme_saimaniq');
$description = get_string('loginbgimagedesc', 'theme_saimaniq');
$setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbgimage', 0 , ['accepted_types' => ['.jpg','.jpeg','.png','web_image']]);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Login page background opacity.
$opacitychoices = [
    '0.0' => '0.0',
    '0.1' => '0.1',
    '0.2' => '0.2',
    '0.3' => '0.3',
    '0.4' => '0.4',
    '0.5' => '0.5',
    '0.6' => '0.6',
    '0.7' => '0.7',
    '0.8' => '0.8',
    '0.9' => '0.9',
    '1.0' => '1.0'
];

$name = 'theme_saimaniq/loginbgopacity';
$title = get_string('loginbgopacity', 'theme_saimaniq');
$description = get_string('loginbgopacitydesc', 'theme_saimaniq');
$default = '0.8';
$setting = new admin_setting_configselect($name, $title, $description, $default, $opacitychoices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

//
$name = 'theme_saimaniq/loginformopacity';
$title = get_string('loginformopacity', 'theme_saimaniq');
$description = get_string('loginformopacitydesc', 'theme_saimaniq');
$default = '0.8';
$setting = new admin_setting_configselect($name, $title, $description, $default, $opacitychoices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Default setting when no background image is provided
$name = 'theme_saimaniq/loginformposition';
$title = get_string('loginformposition', 'theme_saimaniq');
$description = get_string('loginformpositiondesc', 'theme_saimaniq');
$default = 'center';
$setting = new admin_setting_configselect($name, $title, $description, $default, ['left' => 'Left','center' => 'Center','right' => 'Right']);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Default setting when no background image is provided
$name = 'theme_saimaniq/defaultnobackground';
$title = get_string('loginnobackground', 'theme_saimaniq');
$description = get_string('loginnobackgrounddesc', 'theme_saimaniq');
$default = 'plain';
$setting = new admin_setting_configselect($name, $title, $description, $default, ['plain' => 'Plain Color','random' => 'JS Generator']);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);
  
// We use an empty default value because the default colour should come from the preset.    
$name = 'theme_saimaniq/loginbackgroundcolor';     
$title = get_string('loginbackgroundcolor', 'theme_saimaniq');       
$description = get_string('loginbackgroundcolordesc', 'theme_saimaniq');     
$setting = new admin_setting_configcolourpicker($name, $title, $description, '#fff');  
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// When JS is enabled, number of rectangles to produce
$name = 'theme_saimaniq/loginjsrectangles';
$title = get_string('loginjsrectangles', 'theme_saimaniq');
$description = get_string('loginjsrectanglesdesc', 'theme_saimaniq');
$default = 20;
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_INT,2);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);
// $page->hide_if($name,'theme_saimaniq/defaultnobackground','noeq','random');


// Checkbox to Show/hide the front page quote
$name = 'theme_saimaniq/showdefaultfrontpagebody';
$title = get_string('loginbottomtextshow', 'theme_saimaniq');
$description = get_string('loginbottomtextshowdesc', 'theme_saimaniq');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true,false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// HTML to include in the bottom of login.
$name = 'theme_saimaniq/defaultfrontpagebody';
$title = get_string('loginbottomtext', 'theme_saimaniq');
$description = get_string('loginbottomtextdesc', 'theme_saimaniq');
$setting = new admin_setting_confightmleditor($name, $title, $description, '', PARAM_RAW);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Format for the text to be displayed
$name = 'theme_saimaniq/formatfrontpagebody';
$title = get_string('loginnobformatfrontpagebody', 'theme_saimaniq');
$description = get_string('loginnobformatfrontpagebodydesc', 'theme_saimaniq');
$default = 'backquote';
$setting = new admin_setting_configselect($name, $title, $description, $default, ['backquote' => 'Background Quote','styledquote' => 'Styled Quote']);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings! 
$settings->add($page);  