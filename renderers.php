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

defined('MOODLE_INTERNAL') || die;
include_once($CFG->dirroot . "/mod/quiz/renderer.php");
require_once($CFG->dirroot . '/backup/util/ui/renderer.php');

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_saimaniq
 * @copyright  2012 Bas Brands, www.basbrands.nl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class theme_saimaniq_mod_quiz_renderer extends mod_quiz_renderer  {
    //CONUMDLS0206 Customized checkboxes for the Copyright notice and the Terms and conditions
    public function export_for_template($array) {
        $checkboxes_display = theme_saimaniq\helper::checkboxes_display('array');
        $data = new stdClass();
        $data->instructions = $checkboxes_display['instructions'];
        $data->copyright = $checkboxes_display['copyright'];
        $data->checkmessage = (!empty($checkboxes_display['instructions']) && !empty($checkboxes_display['copyright'])) ? true : false;
        return $data;
    }

    public function view_confirmation() : string {
        $preset = theme_saimaniq\helper::is_cole_preset(theme_config::load('saimaniq'));
        $checkboxes_display = theme_saimaniq\helper::checkboxes_display('array');
        $data = $this->export_for_template($checkboxes_display);
        return ($preset == true ? $this->render_from_template('theme_saimaniq/cole/checkboxes', $data) : '' );
    }

    public function render_modals() : string {
        $preset = theme_saimaniq\helper::is_cole_preset(theme_config::load('saimaniq'));
        $checkboxes_display = theme_saimaniq\helper::checkboxes_display('array');
        $output = '';
        if ($preset == true && !empty($checkboxes_display['copyright'])) {
            $output .= $this->render_from_template('theme_saimaniq/cole/copy_modal', '');
            $output .= $this->render_from_template('theme_saimaniq/cole/terms_modal', '');
        }
        return $output;
    }
    public function js_loaders_landing() : string {
        $preset = theme_saimaniq\helper::is_cole_preset(theme_config::load('saimaniq'));
        $checkboxes_display = theme_saimaniq\helper::checkboxes_display('array');
        $output = '';
        if ($preset == true) {
            $output .= $this->page->requires->js_call_amd('theme_saimaniq/cole/landing','init');
            $output .= $this->page->requires->js_call_amd('theme_saimaniq/cole/landing','bolder');
            $output .= $this->page->requires->js_call_amd('theme_saimaniq/cole/landing','checkboxEnabler', [$checkboxes_display['instructions'] , $checkboxes_display['copyright']]);
        }
        return $output;
    }

    public function saimaniq_row($quiz, $cm, $context, $viewobj) : string {
        $info = ['id' =>'saimaniq-quiz-landing-container', 'class'=> (get_config('theme_saimaniq', 'adittionallayoutclasses') ? 'row saimaniq-row' : '')];
        $rendered  = html_writer::start_tag('div', $info);
        //CONUMDLS0103 Build Conquizzer integration - begin
        $rendered .= $this->cole_description($quiz);
        //CONUMDLS0103 Build Conquizzer integration - end
        $rendered .= $this->saimaniq_information($quiz, $cm, $context, $viewobj);
        $rendered .= html_writer::end_tag('div');
        return $rendered;
    }

    public function cole_description($quiz) : string {
        $plugininfo = \core_plugin_manager::instance()->get_plugin_info('quizaccess_conquizzer');
        $rendered = '';
        $info = ['id' =>'saimaniq-quiz-landing-left', 'class'=> (get_config('theme_saimaniq', 'adittionallayoutclasses') ? 'col-6' : '')];
        if ($plugininfo){
            $rendered .= html_writer::start_tag('div', $info);
            $rendered .= $this->render_from_template('quizaccess_conquizzer/description', quizaccess_conquizzer\helper_rules::quiz_description($quiz));
            $rendered .= html_writer::end_tag('div');
        }
        return $rendered;
    }

    public function saimaniq_information($quiz, $cm, $context, $viewobj) : string {
        //CONUMDLS0209 Landing information reordered -- begin
        $info = ['id' =>'saimaniq-quiz-landing-right', 'class'=> (get_config('theme_saimaniq', 'adittionallayoutclasses') ? 'col-6' : '')];
        $rendered  = html_writer::start_tag('div', $info);
        $rendered .= $this->view_information($quiz, $cm, $context, $viewobj->infomessages);
        $rendered .= $this->view_confirmation();
        $rendered .= $this->view_page_tertiary_nav($viewobj);
        $rendered .= html_writer::end_tag('div');
        //CONUMDLS0209 Landing information reordered -- end
        return $rendered;
    }

    /*
     * View Page
     */
    /**
     * Generates the view page
     *
     * @param stdClass $course the course settings row from the database.
     * @param stdClass $quiz the quiz settings row from the database.
     * @param stdClass $cm the course_module settings row from the database.
     * @param context_module $context the quiz context.
     * @param mod_quiz_view_object $viewobj
     * @return string HTML to display
     */
    public function view_page($course, $quiz, $cm, $context, $viewobj) {
        /*
        * Revised logic: 
        * if CONQUIZZER is not installed don't load its information
        * if COLE is the preset, show/hide
        * - checkboxes
        * - Liveperson
        */
        $output = '';
        $output .= $this->saimaniq_row($quiz, $cm, $context, $viewobj);
        $output .= $this->view_table($quiz, $context, $viewobj);
        $output .= $this->view_result_info($quiz, $context, $cm, $viewobj);
        //CONUMDLS0206 Customized checkboxes for the Copyright notice and the Terms and conditions - begin
        $output .= $this->render_modals();
        //CONUMDLS0206 Customized checkboxes for the Copyright notice and the Terms and conditions - end
        $output .= $this->js_loaders_landing();
        $output .= $this->box($this->view_page_buttons($viewobj), 'quizattempt');
        
        return $output;
    }
}

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

    public function render_login(\core_auth\output\login $form) {
        global $CFG, $SITE;

        $context = $form->export_for_template($this);

        $context->errorformatted = $this->error_text($context->error);
        $url = $this->get_logo_url();
        if ($url) {
            $url = $url->out(false);
        }
        $context->logourl = $url;
        $context->sitename = format_string($SITE->fullname, true,
                ['context' => context_course::instance(SITEID), "escape" => false]);
        $context->showchangepassword = get_config('theme_saimaniq', 'showchangepassword');

        return $this->render_from_template('theme_saimaniq/core/loginform', $context);
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