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
 * Plugin version and other meta-data are defined here.
 *
 * @package     theme_saimaniq
 * @copyright   2023 Brandon Jimenez <brandon.jimenez@concordia.ca>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__FILE__) . '/../../../config.php');
//require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/adminlib.php');
GLOBAL $THEME;
//admin_externalpage_setup('themesaimaniqtester');

$strheading = 'Theme Tester: Bootswatch 4 Examples page';
$url = new moodle_url('/theme/saimaniq/tester.php');

// Start setting up the page.
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);
echo $OUTPUT->header();
echo html_writer::link(new moodle_url('index.php'), '&laquo; Back to index');
//echo $OUTPUT->heading($strheading);
echo '----------------';
//echo '<p>diagnose</p>';
//echo $THEME->diagnose($THEME->name);
//echo '----------------';
echo '----------------';
echo '<p>urls</p>';
echo "$CFG->wwwroot/theme/$CFG->theme";
//echo $THEME->css_urls($PAGE);
echo '----------------';
?>
<div class="d-grid">
<div class="card-deck parbase section">
<div class=" card-rows cols-3 stack-tablet-3 stack-mobile-2">
    <div class="card-deck-parsys parsys">

<div class="card parbase section">

<div class="card-container conun conu-burgundy-background left ">

	<div class="card-block">
			<h3 class="card-title default card-title-white">Burgundy</h3>
			<div class="card-text card-text-white card-link-default"><p>HEX: #912338<br></p><p>Compliant AAA</p></div>
	</div>
</div>

</div>


<div class="card parbase section">

<div class="card-container new-magenta left " style="background-color: #DB0272; border: none">

	<div class="card-block">
			<h3 class="card-title default card-title-white">Magenta</h3>
			<div class="card-text card-text-white card-link-default"><p>HEX: #db0272<br></p><p>Compliant AA</p></div>
	</div>
</div>

</div>


<div class="card parbase section">

<div class="card-container new-orange left " style="background-color: #DA3A16; border: none">

	<div class="card-block">
			<h3 class="card-title default card-title-white">Orange</h3>
			<div class="card-text card-text-white card-link-default"><p>HEX: #da3a16<br></p><p>Compliant AA</p></div>
	</div>
</div>

</div>


<div class="card parbase section">

<div class="card-container new-mauve  left " style="background-color: #573996; border: none">

	<div class="card-block">
			<h3 class="card-title default card-title-white">Mauve</h3>
			<div class="card-text card-text-white card-link-default"><p>HEX: #573996<br></p><p>Compliant AAA</p></div>
	</div>
</div>

</div>


<div class="card parbase section">

<div class="card-container  left " style="background-color: #004085; border: none">

	<div class="card-block">
			<h3 class="card-title default card-title-white">Dark blue</h3>
			<div class="card-text card-text-white card-link-default"><p>HEX: #004085<br></p><p>Compliant AAA</p></div>
	</div>
</div>

</div>


<div class="card parbase section">

<div class="card-container  left " style="background-color: #0072A8; border: none">

	<div class="card-block">
			<h3 class="card-title default card-title-white">Blue</h3>
			<div class="card-text card-text-white card-link-default"><p>HEX: #0072a8<br></p><p>Compliant AA</p></div>
	</div>
</div>

</div>


<div class="card parbase section">

<div class="card-container new-turquoise left " style="background-color: #057D78; border: none">

	<div class="card-block">
			<h3 class="card-title default card-title-white">Turquoise</h3>
			<div class="card-text card-text-white card-link-default"><p>HEX: #057d78</p><p>Compliant AA</p></div>
	</div>
</div>

</div>


<div class="card parbase section">

<div class="card-container new-green left " style="background-color: #508212; border: none">

	<div class="card-block">
			<h3 class="card-title default card-title-white">Green</h3>
			<div class="card-text card-text-white card-link-default"><p>HEX: #508212<br></p><p>Compliant AA</p></div>
	</div>
</div>

</div>
</div>

</div></div></div>
<?php
echo $OUTPUT->footer();