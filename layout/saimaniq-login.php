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

defined('MOODLE_INTERNAL') || die();

$bodyattributes = $OUTPUT->body_attributes();

/**
 * First, we get all the config for the login page
 */

$loginimage        = get_config('theme_saimaniq', 'loginbgimage');
$loginopacity      = get_config('theme_saimaniq', 'loginbgopacity');
$loginformopacity  = get_config('theme_saimaniq', 'loginformopacity');
$loginformposition = get_config('theme_saimaniq', 'loginformposition');
$logindefault         = get_config('theme_saimaniq', 'defaultnobackground');
$loginjsrectangles    = get_config('theme_saimaniq', 'loginjsrectangles');
$loginbackgroundcolor = get_config('theme_saimaniq', 'loginbackgroundcolor');
$showdefaultfrontpagebody = get_config('theme_saimaniq', 'showdefaultfrontpagebody');
$defaultfrontpagebody     = get_config('theme_saimaniq', 'defaultfrontpagebody');
$formatfrontpagebody      = get_config('theme_saimaniq', 'formatfrontpagebody');

/**
 * we have to cleanup the initial tags from the text to be put in the blockquote
 */
if (isset($defaultfrontpagebody)){
    $defaultfrontpagebody = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $defaultfrontpagebody);
    $defaultfrontpagebody = preg_replace('/\&nbsp;/i', '$1', $defaultfrontpagebody);
    //$defaultfrontpagebody = 'something to see here';
}
else {
    $defaultfrontpagebody = 'nothing to see here';
}

$hasbackground = empty($loginimage) ? 'saimaniq-no-background' : 'saimaniq-background';

$nobackground = $hasbackground == 'saimaniq-no-background' ? 'saimaniq-'.$logindefault : '';
$additionalclasses = [
    $hasbackground,
    $nobackground,
];
$bodyattributes = $OUTPUT->body_attributes($additionalclasses);

$blockquoteposition = '';
if ($loginformposition=='left'){
    $blockquoteposition = 'right';
}
else if ($loginformposition=='right'){
    $blockquoteposition = 'left';
} else {
    $blockquoteposition = 'center';
}

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
    'loginbgimage'            => $loginimage,
    'loginbgopacity'          => $loginopacity,
    'loginformopacity'        => $loginformopacity,
    'loginformposition'       => $loginformposition,
    'defaultnobackground'     => $logindefault,
    'loginbackgroundcolor'    => $loginbackgroundcolor,
    'loginjsrectangles'       => $loginjsrectangles,
    'showdefaultfrontpagebody'=> $showdefaultfrontpagebody,
    'defaultfrontpagebody'    => $defaultfrontpagebody,
    'formatfrontpagebody'     => $formatfrontpagebody,
    'hasbackground'           => $hasbackground,
    'nobackground'            => $nobackground,
    'blockquoteposition'      => $blockquoteposition,
];

echo $OUTPUT->render_from_template('theme_saimaniq/login', $templatecontext);

