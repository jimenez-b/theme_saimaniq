<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Helper class for theme_saimaniq.
 *
 * @package    theme_saimaniq
 * @copyright  2024 Brandon Jimenez <brandon.jimenez@concordia.ca> on behalf of Concordia University
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

 namespace theme_saimaniq;

 //defined('MOODLE_INTERNAL') || die();

 class helper {
    
    public static function is_cole_preset($theme) : bool {
        //$theme = $PAGE->theme;
        $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
        return ($filename == 'cole.scss' ? true : false );
    }

    public static function checkboxes_display($return_type) {
        $enableinstructionsread = get_config('theme_saimaniq', 'enableinstructionsread');
        $enablemodalscopyterms = get_config('theme_saimaniq', 'enablemodalscopyterms');
        $enabledcheckboxes = [
            'instructions' => $enableinstructionsread,
            'copyright'    => $enablemodalscopyterms
        ];
        return ($return_type == 'object' ? (object) $enabledcheckboxes : json_encode($enabledcheckboxes) );
    }

    public static function get_role($context, $userid) : string {
        $capability  = has_capability('moodle/course:create',$context,$userid);
        $capability2 = has_capability('mod/quiz:grade',$context,$userid);
        return ($capability == 1 || $capability2 == 1)? "non-student" : "student";
    }

    public static function little_html_test_saimaniq() : string {
        return "<p>this is my little html test function from Saimaniq</p>";
    }
 }