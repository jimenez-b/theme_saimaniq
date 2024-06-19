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

if ($hassiteconfig) {
    //$settings = new admin_settingpage('theme_saimaniq_settings', new lang_string('pluginname', 'theme_saimaniq'));
    
    if ($ADMIN->fulltree) {
        // $ADMIN->add("parent_section", new admin_externalpage('themesaimaniqtester', "Foo Admin Component", "$CFG->wwwroot/theme/saimaniq/foo.php"));
        // $settings = new admin_externalpage('themesaimaniqtester', "Foo Admin Component", "$CFG->wwwroot/theme/saimaniq/test-pages/regular.php");
        // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.       
        $settings = new theme_boost_admin_settingspage_tabs('themesettingsaimaniq', get_string('configtitle', 'theme_saimaniq'));    
        require_once('settings/settings_general.php');
        require_once('settings/settings_raw_scss.php');
        require_once('settings/settings_login.php');
        require_once('settings/settings_quiz_landing.php');
        require_once('settings/settings_integrations.php');
        require_once('settings/settings_test.php');
    }
}