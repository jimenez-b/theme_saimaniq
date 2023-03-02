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

// Raw Scss settings.
$page = new admin_settingpage('theme_saimaniq_raw_scss', get_string('settingsrawscss', 'theme_saimaniq'));

// Raw SCSS to include before the content.
$setting = new admin_setting_configtextarea('theme_saimaniq/scsspre',
get_string('rawscsspre', 'theme_saimaniq'), get_string('rawscsspre_desc', 'theme_saimaniq'), '', PARAM_RAW);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Raw SCSS to include after the content.
$setting = new admin_setting_configtextarea('theme_saimaniq/scss', get_string('rawscss', 'theme_saimaniq'),
    get_string('rawscss_desc', 'theme_saimaniq'), '', PARAM_RAW);
$setting->set_updatedcallback('theme_reset_all_caches');
$page->add($setting);

// Must add the page after definiting all the settings! 
$settings->add($page);  