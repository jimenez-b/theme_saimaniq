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

    public function view_confirmation() : string {
        $preset = theme_saimaniq\helper::is_cole_preset(theme_config::load('saimaniq'));
        $checkboxes_display = theme_saimaniq\helper::checkboxes_display('object');
        $checkboxes_display->checkmessage = (!empty($checkboxes_display->instructions) && !empty($checkboxes_display->copyright)) ? true : false;
        return ($preset == true ? $this->render_from_template('theme_saimaniq/cole/checkboxes', $checkboxes_display) : '' );
    }

    public function render_modals() : string {
        $preset = theme_saimaniq\helper::is_cole_preset(theme_config::load('saimaniq'));
        $checkboxes_display = theme_saimaniq\helper::checkboxes_display('object');
        $output = '';
        if ($preset == true && !empty($checkboxes_display->copyright)) {
            $output .= $this->render_from_template('theme_saimaniq/cole/copy_modal', '');
            $output .= $this->render_from_template('theme_saimaniq/cole/terms_modal', '');
        }
        return $output;
    }
    public function js_loaders_landing() : string {
        $preset = theme_saimaniq\helper::is_cole_preset(theme_config::load('saimaniq'));
        $checkboxes_display = theme_saimaniq\helper::checkboxes_display('object');
        $output = '';
        if ($preset == true) {
            $output .= $this->page->requires->js_call_amd('theme_saimaniq/cole/landing','init');
            $output .= $this->page->requires->js_call_amd('theme_saimaniq/cole/landing','bolder');
            $output .= $this->page->requires->js_call_amd('theme_saimaniq/cole/landing','checkboxEnabler', [$checkboxes_display->instructions , $checkboxes_display->copyright]);
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

    public function build_data_liveperson_template($context) {
        global $USER;

        $role = theme_saimaniq\helper::get_role($context,$USER->id);
        $data = new stdClass();
        $data->username = $USER->username;
        if($role == "non-student") {
            $data->employeeid = $USER->profile['aim'];
        }
        if($role == "student") {
            $data->studentid = $USER->idnumber;
        }
        $data->userrole = $role;
        return $this->render_from_template('theme_saimaniq/cole/lpfields', $data);
    }

    //CONUMDLS0208 Questions answered bar -- Begin
    public function header_questions_attempted($attemptobj,$display=false,$bar = false) {
        $output = '';
        $enablequestionsanswered = get_config('theme_saimaniq', 'enablequestionsanswered');
        if (!$enablequestionsanswered){
            return '';
        }
        
        $slots = $attemptobj->get_slots();
        $attempted = 0;
        $total = 0;
        foreach ($slots as $slot) {
            $state = $attemptobj->get_question_state_class($slot, $display);
            $type = $attemptobj->get_question_type_name($slot);
            if($type=='hybrid' && ($state=='answersaved'||$state=='invalidanswer')){
                $attempted++;
            } 
            if($state=='answersaved' && $type!='description'){
                $attempted++;
            }
            if($type!='description'){
                $total++;
            }
        }
        $contents = get_string('questionsatt', 'theme_saimaniq').$attempted."/".$total;
        $classes = array('class' => 'summarymarks');
        if ($bar == true){
            $percentage = ($attempted/$total)*100;
            $output .= html_writer::start_tag('div', ['id'=>'saimaniq-questions-bar', 'class' => "container mb-4 mx-w-inh"]);
            $output .= html_writer::tag('div', $contents, $classes);
            $output .= html_writer::start_tag('div', array('class' => "progress rounded-0"));
            $output .= html_writer::start_tag('div', array('class' => "progress-bar", 'role' => "progressbar",'aria-valuenow' => $attempted,'aria-valuemin' => 0,'aria-valuemax' => $total,'style' => "width:$percentage%"));
            $output .= html_writer::tag('span', $percentage." completed", array('class' => "sr-only"));
            $output .= html_writer::end_tag('div');
            $output .= html_writer::end_tag('div');
            $output .= html_writer::end_tag('div');
        }
        else{
            $output .= html_writer::tag('div', $contents, $classes);
        }
        return $output;
    }
    //CONUMDLS0208 Questions answered bar -- end

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
        global $USER;
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
        $output .= $this->build_data_liveperson_template($context);
        $output .= $this->box($this->view_page_buttons($viewobj), 'quizattempt');
        return $output;
    }

    /**
     * Attempt Page
     *
     * @param quiz_attempt $attemptobj Instance of quiz_attempt
     * @param int $page Current page number
     * @param access_manager $accessmanager Instance of access_manager
     * @param array $messages An array of messages
     * @param array $slots Contains an array of integers that relate to questions
     * @param int $id The ID of an attempt
     * @param int $nextpage The number of the next page
     * @return string HTML to output.
     */
    public function attempt_page($attemptobj, $page, $accessmanager, $messages, $slots, $id,
            $nextpage) {
        $output = '';
        $output .= $this->header();
        //CONUMDLS0208 Questions answered bar -- Begin
        $output .= $this->header_questions_attempted($attemptobj, false,true);
        //CONUMDLS0208 Questions answered bar -- End
        $output .= $this->during_attempt_tertiary_nav($attemptobj->view_url());
        $output .= $this->quiz_notices($messages);
        $output .= $this->countdown_timer($attemptobj, time());
        $output .= $this->attempt_form($attemptobj, $page, $slots, $id, $nextpage);
        $output .= $this->footer();
        return $output;
    }

    //CONUMDLS0211 Modified question footer with navigation to all the questions -- Begin

    /**
     * Display the prev/next buttons that go at the bottom of each page of the attempt.
     *
     * @param int $page the page number. Starts at 0 for the first page.
     * @param bool $lastpage is this the last page in the quiz?
     * @param string $navmethod Optional quiz attribute, 'free' (default) or 'sequential'
     * @return string HTML fragment.
     */
    protected function attempt_navigation_buttons_custom($page, $lastpage, $navmethod = 'free', $attemptid = '', $cmid = '', $num_pages = 1, $pagesshow=5) {
        global $DB,$PAGE;
        $quizid = $DB->get_field('quiz_attempts','quiz',array('id' => $attemptid));
        
        $baseurl = strtok($PAGE->url, "?");

        $output = '';

        $custompaginationnaming = get_config('theme_saimaniq', 'custompaginationnaming');

        $prevlabel = $nextlabel = $styleLabel= '';

        if($custompaginationnaming) {
            switch($custompaginationnaming){
                case 'character':
                    $prevlabel = '<';
                    $nextlabel = '>';
                    break;
                case 'icon':
                    $prevlabel = '&#xf053;';//fa-chevron-left [&#xf053;]
                    $nextlabel = '&#xf054;';//fa-chevron-right [&#xf054;]
                    $styleLabel= "font-family: FontAwesome";
                    break;
                default:
                    $prevlabel = get_string('navigateprevious', 'quiz');
                    $nextlabel = get_string('navigatenext', 'quiz');
                    break;
            }
        }
        
        $custompaginationposition = get_config('theme_saimaniq', 'custompaginationposition');
        /*$navClasses = match ($custompaginationposition) {
            'center' => 'justify-content-center',
            'center' => 'justify-content-center',
            'center' => 'justify-content-center',
        };*/
        $navClasses  = 'nav bg-secondary';
        $navClasses .= ($custompaginationposition?' justify-content-'.$custompaginationposition:' justify-content-center');

        $pagesshow = ($num_pages < 5) ?$num_pages:$pagesshow;
        $changeperc = floor($pagesshow*0.7);
        
        $previousclasses = ($page == 0)? "disabled pe-none rounded-0":'rounded-0';
        $nextclasses = ($lastpage)? "disabled pe-none d-none rounded-0":'rounded-0';
        $last = ($lastpage==1)? "true":'false';
        $output .= html_writer::start_tag('div', array('id' => 'saimaniq-attempt_navigation_buttons', 'class'=> $navClasses));
        $output .= html_writer::start_tag('div', array('id' => 'saimaniq-pagination-main-buttons', 'class' => 'd-inline-flex'));
        if ($page >0 ){
            $output .= html_writer::empty_tag('input',array('type' => 'submit','name' => 'previous','value' => $prevlabel,'class' => $previousclasses,'style'=>$styleLabel));
        }

        $start_level = 0;
        if (($page >= 0)&&($page < $changeperc)||($num_pages==1)){
            $start_level = 1; 
        }
        elseif (($page >= $changeperc)&&($page < $num_pages - $changeperc)){
            $start_level = $page - 1; 
        }
        elseif($page >= $num_pages - $changeperc){
            $start_level = $num_pages - ($pagesshow-1);
        }
        for ($i=1;$i<=$pagesshow;$i++) {
            
            $options = array_merge(
                ['attempt' => $attemptid, 'cmid' => $cmid],
                ($start_level > 1 ? ["page" => $start_level-1] : [])
            );
            $linkClasses = "btn qnbutton";
            $linkClasses .= ($start_level == $page+1) ? " active" : "";
            $output .= html_writer::link(
                new moodle_url($baseurl, $options),
                $start_level,
                ["class" => $linkClasses,
                 "data-current-page" => ($start_level == $page+1) ? "true" : "false"
                ]
                );
            $start_level++;
        }
        
        $output .= html_writer::empty_tag('input', array('type' => 'submit', 'name' => 'next',
                'value' => $nextlabel,'class'=>$nextclasses, 'data-last-page'=>$last, 'style' =>$styleLabel));

        $output .= html_writer::end_tag('div');     
        $output .= html_writer::link(
            new moodle_url($baseurl, array('attempt' => $attemptid, 'cmid' => $cmid)), 
            get_string('endtest', 'quiz'),
            array("class"=>'endtestlink align-self-center', "role"=>"button")
        ); 
        $output .= html_writer::end_tag('div');
        return $output;
    }

    /**
     * Outputs the form for making an attempt
     *
     * @param quiz_attempt $attemptobj
     * @param int $page Current page number
     * @param array $slots Array of integers relating to questions
     * @param int $id ID of the attempt
     * @param int $nextpage Next page number
     */
    public function attempt_form($attemptobj, $page, $slots, $id, $nextpage) {
        $output = '';
        $enablecustompagination = get_config('theme_saimaniq', 'enablecustompagination');

        if (!$enablecustompagination) {
            $output .= parent::attempt_form($attemptobj, $page, $slots, $id, $nextpage);
            return $output;
        }

        
        $output .= '<h1>tester</h1>';
        // Start the form.
        $output .= html_writer::start_tag('form',
                ['action' => new moodle_url($attemptobj->processattempt_url(),
                        ['cmid' => $attemptobj->get_cmid()]), 'method' => 'post',
                        'enctype' => 'multipart/form-data', 'accept-charset' => 'utf-8',
                        'id' => 'responseform']);
        $output .= html_writer::start_tag('div');

        // Print all the questions.
        foreach ($slots as $slot) {
            $output .= $attemptobj->render_question($slot, false, $this,
                    $attemptobj->attempt_url($slot, $page));
        }

        $navmethod = $attemptobj->get_quiz()->navmethod;
        //$output .= $this->attempt_navigation_buttons($page, $attemptobj->is_last_page($page), $navmethod);
        $output .= $this->attempt_navigation_buttons_custom($page, $attemptobj->is_last_page($page), $navmethod, $attemptobj->get_attemptid(), $attemptobj->get_cmid(), $attemptobj->get_num_pages());


        // Some hidden fields to track what is going on.
        $output .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'attempt',
                'value' => $attemptobj->get_attemptid()]);
        $output .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'thispage',
                'value' => $page, 'id' => 'followingpage']);
        $output .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'nextpage',
                'value' => $nextpage]);
        $output .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'timeup',
                'value' => '0', 'id' => 'timeup']);
        $output .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'sesskey',
                'value' => sesskey()]);
        $output .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'mdlscrollto',
                'value' => '', 'id' => 'mdlscrollto']);

        // Add a hidden field with questionids. Do this at the end of the form, so
        // if you navigate before the form has finished loading, it does not wipe all
        // the student's answers.
        $output .= html_writer::empty_tag('input', ['type' => 'hidden', 'name' => 'slots',
                'value' => implode(',', $attemptobj->get_active_slots($page))]);

        // Finish the form.
        $output .= html_writer::end_tag('div');
        $output .= html_writer::end_tag('form');

        $output .= $this->connection_warning();

        return $output;
    }
    //CONUMDLS0211 Modified question footer with navigation to all the questions -- End

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