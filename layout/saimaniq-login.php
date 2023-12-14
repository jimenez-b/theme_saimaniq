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

$loginmaintextconf        = get_config('theme_saimaniq', 'loginmaintextconf');
$loginimage               = get_config('theme_saimaniq', 'loginbgimage');
$loginopacity             = get_config('theme_saimaniq', 'loginbgopacity');
$loginformopacity         = get_config('theme_saimaniq', 'loginformopacity');
$loginlogoposition        = get_config('theme_saimaniq', 'loginlogoposition');
$loginformposition        = get_config('theme_saimaniq', 'loginformposition');
$logindefault             = get_config('theme_saimaniq', 'defaultnobackground');
$loginjsrectangles        = get_config('theme_saimaniq', 'loginjsrectangles');
$loginbackgroundcolor     = get_config('theme_saimaniq', 'loginbackgroundcolor');
$showdefaultfrontpagebody = get_config('theme_saimaniq', 'showdefaultfrontpagebody');
$defaultfrontpagebody     = get_config('theme_saimaniq', 'defaultfrontpagebody');
$formatfrontpagebody      = get_config('theme_saimaniq', 'formatfrontpagebody');
$corelogo                 = get_config('core_admin', 'logo');
$corelogosmall            = get_config('core_admin', 'logocompact');
$themedesigner            = get_config('core','themedesignermode');

$themedesignertrue = (get_config('core','themedesignermode')== 1) ? "theme-designer-true" : "";

/**
 * we have to cleanup the initial tags from the text to be put in the blockquote
 */
if (isset($defaultfrontpagebody)){
    $defaultfrontpagebody = preg_replace('/<p[^>]*>(.*)<\/p[^>]*>/i', '$1', $defaultfrontpagebody);
    $defaultfrontpagebody = preg_replace('/\&nbsp;/i', '$1', $defaultfrontpagebody);
}
else {
    $defaultfrontpagebody = 'nothing to see here';
}

$loginmaintextconf = empty($loginmaintextconf) ? get_string('loginmaintext', 'theme_saimaniq') : $loginmaintextconf;

$hasbackground = empty($loginimage) ? 'saimaniq-no-background' : 'saimaniq-background';

$nobackground = $hasbackground == 'saimaniq-no-background' ? 'saimaniq-'.$logindefault : '';
$additionalclasses = [
    $hasbackground,
    $nobackground,
    $themedesignertrue,
];
$bodyattributes = $OUTPUT->body_attributes($additionalclasses);

$logorenderwhitin = ($loginlogoposition=='within') ? true : false;

$blockquoteposition = '';
if ($loginformposition=='left'){
    $blockquoteposition = 'right';
}
else if ($loginformposition=='right'){
    $blockquoteposition = 'left';
} else {
    $blockquoteposition = 'center';
}
$logorender = ($loginformposition=='left' || $loginformposition=='right' ) ? true : false;

$reverse = ($loginformposition=='right') ? true : false;

$shapesload = $logindefault == "random" ? true : false;

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
    'loginmaintextconf'       => $loginmaintextconf,
    'loginbgimage'            => $loginimage,
    'loginbgopacity'          => $loginopacity,
    'loginformopacity'        => $loginformopacity,
    'loginlogoposition'       => $loginlogoposition,
    'logorenderwhitin'        => $logorenderwhitin,
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
    'corelogo'                => $corelogo,
    'corelogosmall'           => $corelogosmall,
    'logorender'              => $logorender,
    'reverse'                 => $reverse,
    'themedesigner'           => $themedesigner,
    'shapesload'              => $shapesload,
];

echo $OUTPUT->render_from_template('theme_saimaniq/login', $templatecontext);

