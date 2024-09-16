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

$page = new admin_settingpage('theme_saimaniq_quiz', get_string('settingsquizpage', 'theme_saimaniq'));

$page->add(new admin_setting_heading('theme_saimaniq_quiz_landing', get_string('quizlandingheading', 'theme_saimaniq'),
        format_text(get_string('quizlandingheadingdesc', 'theme_saimaniq'), FORMAT_MARKDOWN)));

// Checkbox to Enable/Disable the check for additional instructions for the test
$name = 'theme_saimaniq/adittionallayoutclasses';
$title = get_string('adittionallayoutclasses', 'theme_saimaniq');
$description = get_string('adittionallayoutclassesdesc', 'theme_saimaniq');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true,false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Checkbox to Enable/Disable the check for additional instructions for the test
$name = 'theme_saimaniq/enableinstructionsread';
$title = get_string('enableinstructionsread', 'theme_saimaniq');
$description = get_string('enableinstructionsreaddesc', 'theme_saimaniq');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true,false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Checkbox to Enable/Disable seeing the copyright and terms and conditions modal
$name = 'theme_saimaniq/enablemodalscopyterms';
$title = get_string('enablemodalscopyterms', 'theme_saimaniq');
$description = get_string('enablemodalscopytermsdesc', 'theme_saimaniq');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true,false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

$page->add(new admin_setting_heading('theme_saimaniq_quiz_page', get_string('quizquestionheading', 'theme_saimaniq'),
        format_text(get_string('quizquestionheadingdesc', 'theme_saimaniq'), FORMAT_MARKDOWN)));

// Checkbox to Enable/Disable seeing the 'Questions answered' bar at the top of every quiz question page
$name = 'theme_saimaniq/enablequestionsanswered';
$title = get_string('enablequestionsanswered', 'theme_saimaniq');
$description = get_string('enablequestionsanswereddesc', 'theme_saimaniq');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true,false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Checkbox to Enable/Disable the custom pagination on the quiz page
$name = 'theme_saimaniq/enablecustompagination';
$title = get_string('enablecustompagination', 'theme_saimaniq');
$description = get_string('enablecustompaginationdesc', 'theme_saimaniq');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true,false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Checkbox to Enable/Disable the custom pagination on the quiz page
$name = 'theme_saimaniq/enablestickypagination';
$title = get_string('enablestickypagination', 'theme_saimaniq');
$description = get_string('enablestickypaginationdesc', 'theme_saimaniq');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true,false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Login page background opacity.
$opacitychoices = [
        'label'     => 'Label',
        'character' => 'Single Character',
        'icon' => 'Icon'
];
    
$name = 'theme_saimaniq/custompaginationnaming';
$title = get_string('custompaginationnaming', 'theme_saimaniq');
$description = get_string('custompaginationnamingdesc', 'theme_saimaniq');
$default = 'label';
$setting = new admin_setting_configselect($name, $title, $description, $default, $opacitychoices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Login page background opacity.
$opacitychoices = [
        'center' => 'Centered',
        'left'   => 'Left',
        'end'    => 'Right'
];
    
$name = 'theme_saimaniq/custompaginationposition';
$title = get_string('custompaginationposition', 'theme_saimaniq');
$description = get_string('custompaginationpositiondesc', 'theme_saimaniq');
$default = 'center';
$setting = new admin_setting_configselect($name, $title, $description, $default, $opacitychoices);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Checkbox to Enable/Disable the custom pagination on the quiz page
$name = 'theme_saimaniq/enablecustomexamnavigation';
$title = get_string('enablecustomexamnavigation', 'theme_saimaniq');
$description = get_string('enablecustomexamnavigationdesc', 'theme_saimaniq');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true,false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// allows the changing of the amount of seconds to be switch to red
/*$name = 'theme_saimaniq/quiztimercolorchange';
$title = get_string('quiztimercolorchange', 'theme_saimaniq');
$description = get_string('quiztimercolorchangedesc', 'theme_saimaniq');
$default = get_string('quiztimercolorchangedef', 'theme_saimaniq');
$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_INT);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);*/

// Must add the page after definiting all the settings! 
$settings->add($page);