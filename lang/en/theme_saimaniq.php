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
 * Plugin strings are defined here.
 *
 * @package     theme_saimaniq
 * @category    string
 * @copyright   2023 Brandon Jimenez <brandon.jimenez@concordia.ca>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname']   = 'Saimaniq';
$string['choosereadme'] = 'Saimaniq, the Inuktitut word for Peace, is our new Boost-based Moodle theme. It reflects the Concordia branding with a few additional features, such as customizable login page.';
$string['privacy:metadata'] = 'The Saimaniq theme does not store any personal data.';
// Name of the settings pages.
$string['configtitle'] = 'Saimaniq settings';
// Name of the first settings tab.
$string['generalsettings'] = 'General settings';
// Preset setting.
$string['preset'] = 'Theme preset';
// Preset help text.
$string['preset_desc'] = 'Pick a preset to broadly change the look of the theme.';
// Preset files setting.
$string['presetfiles'] = 'Additional theme preset files';
// Preset files help text.
$string['presetfiles_desc'] = 'Preset files can be used to dramatically alter the appearance of the theme. See <a href=https://docs.moodle.org/dev/Boost_Presets>Boost presets</a> for information on creating and sharing your own preset files, and see the <a href=http://moodle.net/boost>Presets repository</a> for presets that others have shared.';
// The background color choices as a general adjustment for all the site.
$string['backgroundcolorchoices'] = 'Background color';
// The background color choices setting description.
$string['backgroundcolorchoices_desc'] = 'The color to be applied as a background throughout the site';
// The brand colour setting.
$string['brandcolor'] = 'Brand colour';
// The brand colour setting description.
$string['brandcolor_desc'] = 'The accent colour.';

// The name of the second tab in the theme settings.        
$string['settingsrawscss'] = 'Raw Scss settings';
// Raw initial SCSS setting.
$string['rawscsspre'] = 'Raw initial SCSS';
// Raw initial SCSS setting help text.
$string['rawscsspre_desc'] = 'In this field you can provide initialising SCSS code, it will be injected before everything else. Most of the time you will use this setting to define variables.';
// Raw SCSS setting.
$string['rawscss'] = 'Raw SCSS'; 
// Raw SCSS setting help text.
$string['rawscss_desc'] = 'Use this field to provide SCSS or CSS code which will be injected at the end of the style sheet.';

// The name of the third tab in the theme settings.        
$string['settingsloginpage'] = 'Login page settings';
// All the settings for the login page
$string['loginsettingsheading'] = 'Customize the login page';
$string['logindesc'] = 'Customize the login page by adding an image background and texts above and below the login box.';
$string['loginbgimage']     = 'Background image';
$string['loginbgimagedesc'] = 'Add a background image to the full size page.';
$string['loginmaintextconf']     = 'Login text';
$string['loginmaintextconfdesc'] = 'Text that will appear as a guide on the login page';
$string['loginbgopacity']     = 'Opacity background image';
$string['loginbgopacitydesc'] = 'Login background opacity for the background image. Opacity 1 means completely visible and 0 completely transparent.';
$string['loginformopacity']     = 'Opacity login form';
$string['loginformopacitydesc'] = 'Login background opacity for the form. Opacity 1 means completely visible and 0 completely transparent.';
$string['loginlogoposition']     = 'Login logo position';
$string['loginlogopositiondesc'] = 'Login logo position. It can have one of two values and determines the position of the logo on the login page';
$string['loginformposition']     = 'Login form position';
$string['loginformpositiondesc'] = 'Login form position. It can have one of three values and determines the position of loginbottomtext';
$string['loginnobackground']     = 'Default no image';
$string['loginnobackgrounddesc'] = 'Default behavior when no background image is present.';
$string['loginbackgroundcolor']     = 'Background color';
$string['loginbackgroundcolordesc'] = 'Background color when no image is supplied';
$string['loginjsrectangles']     = 'JS Rectangles';
$string['loginjsrectanglesdesc'] = 'When JS is enabled, number of figures to produce';
$string['loginbottomtextshow']     = 'Display login bottom text';
$string['loginbottomtextshowdesc'] = 'Hide/Display login bottom text';
$string['loginbottomtext']     = 'Login bottom text';
$string['loginbottomtextdesc'] = 'Text to be included in the bottom of the login page';
$string['loginnobformatfrontpagebody']     = 'Format bottom section';
$string['loginnobformatfrontpagebodydesc'] = 'The styling for the text that will be renderer on the login page';
$string['loginshowchangepassword']     = 'Display "Forgot Password?" link';
$string['loginshowchangepassworddesc'] = 'Hide or show the "Forgot password?" link on the login page';
$string['cookiesnoticemobile'] = 'Cookies';

//the name for the Quiz Landing tab
$string['settingsquizlandingpage']    = 'Quiz Landing settings';
// All the settings for the Quiz Landing page
$string['quizlandingheading']         = 'Settings for the Quiz Landing page';
$string['quizlandingheadingdesc']     = 'Allows the administrator to control several aspects of the quiz landing page';
$string['enableinstructionsread']     = 'Enables additional check for the instructions';
$string['enableinstructionsreaddesc'] = 'Enable/Disable checkbox to verify if the user has read the instructions before the exam';
$string['enablemodalscopyterms']      = 'Enables additional check for the modals';
$string['enablemodalscopytermsdesc']  = 'Enable/Disable checkbox to verify if the user has read the Copyright and Terms';

//the name for the Integrations tab
$string['settingsintegrationpage'] = 'Integrations settings';
// All the settings for the Integrations page
$string['integrationsheading']     = 'Integrations with additional components';
$string['integrationsheadingdesc'] = 'Allows the administrator to enable/disable several integrations with additional components';
$string['enableliveperson']     = 'Enable LivePerson integration';
$string['enablelivepersondesc'] = 'Enable/Disable the inclusion of the LivePerson chat';
$string['enableproctorio']      = 'Enable Proctorio integration';
$string['enableproctoriodesc']  = 'Enable/Disable the inclusion of Proctorio';
$string['enableconquizzer']     = 'Enable Conquizzer plugin integration';
$string['enableconquizzerdesc'] = 'Enable/Disable the display of the Conquizzer plugin information';

//the name for the Test settings tab
$string['settingstestpage'] = 'Settings test page';
// All the settings for the Test settings page
$string['testsettingsheading']     = 'Test the elements corresponding to the Concordia UI';
$string['testsettingsheadingdesc'] = 'Test page to check the elements of the Concordia UI designed for the Saimaniq theme';
$string['styleguide'] = 'Style Guide';

$string['learnmore'] = 'Learn More';
$string['learnmoreurl'] = 'https://www.concordia.ca/it.html#notices';
$string['contactit'] = 'Contact IT Service Desk';
$string['contactiturl'] = 'https://www.concordia.ca/it/support.html';

$string['loginmaintext'] = ' students, faculty and staff login';

// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Right';

$string['adminlogin'] = 'Admin log in';
$string['forgotpassword'] = 'Forgot password?';