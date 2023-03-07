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

global $CFG;

require_once($CFG->dirroot . '/theme/saimaniq/saimaniq_admin_settings_styleguide.php');

// Raw Scss settings.
$page = new admin_settingpage('theme_saimaniq_test', get_string('settingstestpage', 'theme_saimaniq'));

$page->add(new admin_setting_heading('theme_saimaniq_test', get_string('testsettingsheading', 'theme_saimaniq'),
        format_text(get_string('testsettingsheadingdesc', 'theme_saimaniq'), FORMAT_MARKDOWN)));

// Raw Bootstrap HTML to show the options of theme.
$setting = new saimaniq_admin_settings_styleguide('theme_saimaniq_styleguide',
    get_string('styleguide', 'theme_saimaniq'));

//
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings! 
$settings->add($page);  