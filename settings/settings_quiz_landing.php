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

$page = new admin_settingpage('theme_saimaniq_quiz_landing', get_string('settingsquizlandingpage', 'theme_saimaniq'));

$page->add(new admin_setting_heading('theme_saimaniq_quiz_landing', get_string('quizlandingheading', 'theme_saimaniq'),
        format_text(get_string('quizlandingheadingdesc', 'theme_saimaniq'), FORMAT_MARKDOWN)));

// Checkbox to Enable/Disable LivePerson
$name = 'theme_saimaniq/enableinstructionsread';
$title = get_string('enableinstructionsread', 'theme_saimaniq');
$description = get_string('enableinstructionsreaddesc', 'theme_saimaniq');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true,false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Checkbox to Enable/Disable LivePerson
$name = 'theme_saimaniq/enablemodalscopyterms';
$title = get_string('enablemodalscopyterms', 'theme_saimaniq');
$description = get_string('enablemodalscopytermsdesc', 'theme_saimaniq');
$default = false;
$setting = new admin_setting_configcheckbox($name, $title, $description, $default, true,false);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings! 
$settings->add($page);