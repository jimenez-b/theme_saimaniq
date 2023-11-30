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

//namespace theme_saimaniq\output;

/*
use moodle_url;
use html_writer;
use get_string;

PHP Warning:  The use statement with non-compound name 'moodle_url' has no effect in /public/home/theme/saimaniq/renderers.php on line 19

Warning: The use statement with non-compound name 'moodle_url' has no effect in /public/home/theme/saimaniq/renderers.php on line 19
PHP Warning:  The use statement with non-compound name 'html_writer' has no effect in /public/home/theme/saimaniq/renderers.php on line 20

Warning: The use statement with non-compound name 'html_writer' has no effect in /public/home/theme/saimaniq/renderers.php on line 20
PHP Warning:  The use statement with non-compound name 'get_string' has no effect in /public/home/theme/saimaniq/renderers.php on line 21

Warning: The use statement with non-compound name 'get_string' has no effect in /public/home/theme/saimaniq/renderers.php on line 21
*/
defined('MOODLE_INTERNAL') || die;
require_once($CFG->dirroot . '/backup/util/ui/renderer.php');

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_saimaniq
 * @copyright  2012 Bas Brands, www.basbrands.nl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_saimaniq_core_renderer extends theme_boost\output\core_renderer {
     /**
      * Renders the header bar.
      *
      * @param context_header $contextheader Header bar object.
      * @return string HTML for the header bar.
      */
    protected function render_context_header(\context_header $contextheader) {

        // Generate the heading first and before everything else as we might have to do an early return.
        if (!isset($contextheader->heading)) {
            $heading = $this->heading($this->page->heading, $contextheader->headinglevel, 'text');
        } else {
            if ($contextheader->headinglevel == 2) {
                $heading = $this->heading($contextheader->heading, $contextheader->headinglevel, 'text-reset');
            }
            else {
                $heading = $this->heading($contextheader->heading, $contextheader->headinglevel, 'conu-burgundy-color');
            }
        }

        // All the html stuff goes here.
        $html = html_writer::start_div('page-context-header');

        // Image data.
        if (isset($contextheader->imagedata)) {
            // Header specific image.
            $html .= html_writer::div($contextheader->imagedata, 'page-header-image mr-2');
        }

        // Headings.
        if (isset($contextheader->prefix)) {
            $prefix = html_writer::div($contextheader->prefix, 'text-muted text-uppercase small line-height-3');
            $heading = $prefix . $heading;
        }
        $extraclasses  = (isset($contextheader->prefix)) ? ' flex-column align-items-left' : ' align-items-center';
        $extraclasses .= (isset($contextheader->additionalbuttons)) ? ' col-7' : '';
        $html .= html_writer::tag('div', $heading, array('class' => 'page-header-headings d-flex'.$extraclasses));

        // Buttons.
        if (isset($contextheader->additionalbuttons)) {
            $html .= html_writer::start_div('btn-group header-button-group d-flex align-items-center col-3');
            foreach ($contextheader->additionalbuttons as $button) {
                if (!isset($button->page)) {
                    // Include js for messaging.
                    if ($button['buttontype'] === 'togglecontact') {
                        \core_message\helper::togglecontact_requirejs();
                    }
                    if ($button['buttontype'] === 'message') {
                        \core_message\helper::messageuser_requirejs();
                    }
                    $image = $this->pix_icon($button['formattedimage'], $button['title'], 'moodle', array(
                        'class' => 'iconsmall',
                        'role' => 'presentation'
                    ));
                    $image .= html_writer::span($button['title'], 'header-button-title');
                } else {
                    $image = html_writer::empty_tag('img', array(
                        'src' => $button['formattedimage'],
                        'role' => 'presentation'
                    ));
                }
                $html .= html_writer::link($button['url'], html_writer::tag('span', $image), $button['linkattributes']);
            }
            $html .= html_writer::end_div();
        }
        $html .= html_writer::end_div();

        return $html;
    }
}

class theme_saimaniq_core_backup_renderer extends \core_backup_renderer {

    /**
     * Renders an import course search object
     *
     * @param import_course_search $component
     * @return string
     */
    public function render_import_course_search(import_course_search $component) {
        $output = html_writer::start_tag('div', array('class' => 'import-course-search'));
        if ($component->get_count() === 0) {
            $output .= $this->output->notification(get_string('nomatchingcourses', 'backup'));

            $output .= html_writer::start_tag('div', array('class' => 'ics-search form-inline'));
            $attrs = array(
                'type' => 'text',
                'name' => restore_course_search::$VAR_SEARCH,
                'value' => $component->get_search(),
                'aria-label' => get_string('searchcourses'),
                'placeholder' => get_string('searchcourses'),
                'class' => 'form-control'
            );
            $output .= html_writer::empty_tag('input', $attrs);
            $attrs = array(
                'type' => 'submit',
                'name' => 'searchcourses',
                'value' => get_string('search'),
                'class' => 'btn btn-secondary ml-1'
            );
            $output .= html_writer::empty_tag('input', $attrs);
            $output .= html_writer::end_tag('div');

            $output .= html_writer::end_tag('div');
            return $output;
        }

        $countstr = '';
        if ($component->has_more_results()) {
            $countstr = get_string('morecoursesearchresults', 'backup', $component->get_count());
        } else {
            $countstr = get_string('totalcoursesearchresults', 'backup', $component->get_count());
        }

        $output .= html_writer::tag('div', $countstr, array('class' => 'ics-totalresults'));
        $output .= html_writer::start_tag('div', array('class' => 'ics-results'));

        $table = new html_table();
        $table->head = array('&nbsp', get_string('shortnamecourse'), get_string('fullnamecourse'));
        $table->data = array();
        foreach ($component->get_results() as $course) {
            $row = new html_table_row();
            $row->attributes['class'] = 'ics-course';
            if (!$course->visible) {
                $row->attributes['class'] .= ' dimmed';
            }
            $id = $this->make_unique_id('import-course');
            $row->cells = [
                html_writer::empty_tag('input', ['type' => 'radio', 'name' => 'importid', 'value' => $course->id,
                    'id' => $id]),
                html_writer::label(
                    format_string($course->shortname, true, ['context' => context_course::instance($course->id)]),
                    $id,
                    true,
                    ['class' => 'd-block']
                ),
                format_string($course->fullname, true, ['context' => context_course::instance($course->id)])
            ];
            $table->data[] = $row;
        }
        if ($component->has_more_results()) {
            $cell = new html_table_cell(get_string('moreresults', 'backup'));
            $cell->colspan = 3;
            $cell->attributes['class'] = 'notifyproblem';
            $row = new html_table_row(array($cell));
            $row->attributes['class'] = 'rcs-course';
            $table->data[] = $row;
        }
        $output .= html_writer::table($table);
        $output .= html_writer::end_tag('div');

        $output .= html_writer::start_tag('div', array('class' => 'ics-search form-inline'));
        $attrs = array(
            'type' => 'text',
            'name' => restore_course_search::$VAR_SEARCH,
            'value' => $component->get_search(),
            'aria-label' => get_string('searchcourses'),
            'placeholder' => get_string('searchcourses'),
            'class' => 'form-control');
        $output .= html_writer::empty_tag('input', $attrs);
        $attrs = array(
            'type' => 'submit',
            'name' => 'searchcourses',
            'value' => get_string('search'),
            'class' => 'btn btn-secondary ml-1'
        );
        $output .= html_writer::empty_tag('input', $attrs);
        $output .= html_writer::end_tag('div');

        $output .= html_writer::end_tag('div');
        return $output;
    }

}