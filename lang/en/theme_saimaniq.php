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
$string['settingscoursepage']    = 'Course settings';
// All the settings for the Quiz Landing page
$string['coursepageheading']     = 'Settings for the Course page';
$string['coursepageheadingdesc'] = 'Allows the administrator to control several aspects of the course page';
$string['enablesupportfaq']      = 'Enables Support FAQ';
$string['enablesupportfaqdesc']  = 'Enable/Disable the support FAQ for the course page';

//the name for the Quiz Landing tab
$string['settingsquizpage']    = 'Quiz settings';
// All the settings for the Quiz Landing page
$string['quizlandingheading']          = 'Settings for the Quiz Landing page';
$string['quizlandingheadingdesc']      = 'Allows the administrator to control several aspects of the quiz landing page';
$string['adittionallayoutclasses']     = 'Enables layout elements';
$string['adittionallayoutclassesdesc'] = 'Enable/Disable additional layout items to help visualize the information';
$string['enableinstructionsread']      = 'Enables additional check for the instructions';
$string['enableinstructionsreaddesc']  = 'Enable/Disable checkbox to verify if the user has read the instructions before the exam';
$string['enablemodalscopyterms']       = 'Enables additional check for the Copy/Terms';
$string['enablemodalscopytermsdesc']   = 'Enable/Disable checkbox to verify if the user has read the Copyright and Terms';
// All the settings for the Quiz page
$string['quizquestionheading']          = 'Settings for the Quiz question(s) page';
$string['quizquestionheadingdesc']      = 'Allows the administrator to control several aspects of quiz question page';
$string['enablequestionsanswered']      = 'Enables Questions Answered bar';
$string['enablequestionsanswereddesc']  = 'Enable/Disable the Questions bar';
$string['enablecustompagination']       = 'Enables Custom pagination';
$string['enablecustompaginationdesc']   = 'Enable/Disable the custom pagination at the bottom of the quiz page';
$string['custompaginationnaming']       = 'Select pagination type';
$string['custompaginationnamingdesc']   = 'Allows selection of the pagination type: default strings, single character or icon';
$string['custompaginationposition']     = 'Select pagination position';
$string['custompaginationpositiondesc'] = 'Selects the position of the pagination bar for the quiz';

//the name for the Integrations tab
$string['settingsintegrationpage'] = 'Integrations settings';
// All the settings for the Integrations page
$string['integrationsheading']     = 'Integrations with additional components';
$string['integrationsheadingdesc'] = 'Allows the administrator to enable/disable several integrations with additional components';
$string['enableliveperson']        = 'Enable LivePerson integration';
$string['enablelivepersondesc']    = 'Enable/Disable the inclusion of the LivePerson chat';
$string['enableproctorio']         = 'Enable Proctorio integration';
$string['enableproctoriodesc']     = 'Enable/Disable the inclusion of Proctorio';
$string['enableconquizzer']        = 'Enable Conquizzer plugin integration';
$string['enableconquizzerdesc']    = 'Enable/Disable the display of the Conquizzer plugin information';

//the name for the Test settings tab
$string['settingstestpage'] = 'Settings test page';
// All the settings for the Test settings page
$string['testsettingsheading']     = 'Test the elements corresponding to the Concordia UI';
$string['testsettingsheadingdesc'] = 'Test page to check the elements of the Concordia UI designed for the Saimaniq theme';
$string['styleguide'] = 'Style Guide';

//Login page strings
$string['learnmore'] = 'Learn More';
$string['learnmoreurl'] = 'https://www.concordia.ca/it.html#notices';
$string['contactit'] = 'Contact IT Service Desk';
$string['contactiturl'] = 'https://www.concordia.ca/it/support.html';
$string['loginmaintext'] = ' students, faculty and staff login';

// quiz page
//Summary strings
//Table strings
$string['questionno'] = 'Q No.';
$string['questionsatt'] = 'Questions attempted:';

// We need to include a lang string for each block region.
$string['region-side-pre'] = 'Right';

$string['adminlogin'] = 'Admin log in';
$string['forgotpassword'] = 'Forgot password?';

//strings belonging to COLE
//added from the Conquizzer old version
//Checkbox section
$string['instructions'] = "I have read the instructions completely";
$string['copyrightnotice'] = 'I understand the <a href="#" data-toggle="modal" data-target="#copyright-modal">Copyright notice</a> and <a href="#" data-toggle="modal" data-target="#terms-modal">Terms and Conditions</a>';
$string['obligatoryapproval'] = 'You must approve both checkboxes';
$string['obligatoryapprovalsingle'] = 'You must approve the checkbox';
//modals
$string['copyright'] = "The present exam and the contents thereof are the property and copyright of the professor(s) who prepared this exam at Concordia University. No part of the present exam may be used for any purpose other than research or teaching purposes at Concordia University. Furthermore, no part of the present exam may be sold, reproduced, republished or re-disseminated in any manner or form without the prior written permission of its owner and copyright holder.";
$string['termsandconditions'] = '<p>You are about to enter into an online exam environment. If you are taking a proctored exam, you must have your Concordia ID card or, failing that, government issued ID readily accessible.</p>
<p>Before you access the exam, you must make sure that you meet all technological and logistical requirements. Read the FAQ about online exams without proctoring or the FAQ about online exams with proctoring, depending on the exam you are about to take. They contain important information and you are strongly encouraged to review that information prior to your exam.</p>
<p>The academic integrity standards applicable to you during this exam are identical to those applicable in an in-person exam. If it is suspected that you did not respect those standards, you may be charged under the Academic Code of Conduct. It is your responsibility to ensure that you remove anything from your exam environment that can be perceived to be unauthorized materials during the exam. Material that you are allowed to use during the exam are mentioned above.</p>
<p>By entering the exam, you represent and warrant that you are the person whose name is associated with the login used in COLE. You affirm that you have had the opportunity to review and that you understand the Academic Code of Conduct.</p>
<p>If you require support during the exam, please call 1-888-202-8615 as soon as possible.</p>';

//suppport FAQ
$string['support'] = "Support FAQ";
$string['technicaldifficultieshdr'] = "Technical difficulty?";
$string['technicaldifficulties'] = "Use the <strong>Exam Support</strong> chat button on the right of your screen to contact COLE support or call the toll free number at the bottom of the page.";
$string['proctorioissueshdr'] = "Proctorio issues?";
$string['proctorioissues'] = "First use the <strong>Exam Support</strong> chat button on the right of your screen to contact COLE support. If they direct you to Proctorio support, click the Proctorio shield icon in your browser (upper right) to access Proctorio live chat.";
$string['questionsinstructorhdr'] = "Questions for your instructor";
$string['questionsinstructor'] = "Use the <strong>Exam Support</strong> chat button on the right of your screen to contact COLE support. They will connect you with your instructor.";
$string['acsdaccomodationshdr'] = "ACSD accommodations";
$string['acsdaccomodations'] = "If you are eligible for extended time, your exam time has been configured and verified by the COLE exam team and ACSD.";
$string['chinaoriranhdr'] = "Writing from China or Iran";
$string['chinaoriran'] = "If your exam is proctored, make sure you are not connected with VPN. VPN is not compatible with proctored exams.";
$string['supportphone'] = 'Call <a href="tel:+18882028615">1-888-202-8615</a> for support';
