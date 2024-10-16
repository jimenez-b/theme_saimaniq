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
        global $OUTPUT;
        $output = '';
        $enablequestionsanswered = get_config('theme_saimaniq', 'enablequestionsanswered');
        if (!$enablequestionsanswered){
            return '';
        }

        $enablequestionsbar = get_config('theme_saimaniq', 'enablequestionsbar');

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
        $data = new stdClass();
        $data->question_answered = $contents = get_string('questionsatt', 'theme_saimaniq').$attempted."/".$total;
        $data->classes = 'summarymarks';
        $page = strpos($OUTPUT->body_attributes(),'page-mod-quiz-attempt');
        $idpage = ($page === false ? false : true);
        if ($enablequestionsbar && $idpage) {
            $data->questionbar = $enablequestionsbar;
            $data->percentage = ($attempted/$total)*100;
            $data->attempted = $attempted;
            $data->total = $total;
        }
        else{
            $data->classes .= ' h2';
        }
        return $this->render_from_template('theme_saimaniq/cole/progress_section', $data);
    }
    //CONUMDLS0208 Questions answered bar -- end

    protected function add_img_modal() {
        $preset = theme_saimaniq\helper::is_cole_preset(theme_config::load('saimaniq'));
        $data = '';
        return $output = (($preset == true) ? $this->render_from_template('theme_saimaniq/cole/image_modal', $data) : '');
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
        $output .= $this->add_img_modal();
        $output .= $this->page->requires->js_call_amd('theme_saimaniq/cole/attempt','init');
        $output .= $this->page->requires->js_call_amd('theme_saimaniq/cole/attempt','modal_images');
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
        $enablestickypagination = get_config('theme_saimaniq', 'enablestickypagination');
    
        $navClasses  = 'nav';

        $navClasses .= ($enablestickypagination ? ' position-sticky conu-white-background fixed-bottom':' position-relative');
        $navClasses .= ($custompaginationposition ? ' justify-content-'.$custompaginationposition :' justify-content-center');

        $pagesshow = ($num_pages < 5) ?$num_pages:$pagesshow;
        $changeperc = floor($pagesshow*0.7);
        
        $previousclasses = $nextclasses = 'btn btn-link'; /*'btn btn-light ml-1 mr-2';*/

        $previousclasses .= ($page == 0) ? "disabled pe-none" : '';
        $nextclasses     .= ($lastpage) ? "disabled pe-none d-none" : '';
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
            //$linkClasses = "btn btn-link";
            //reverted to class qnbutton because of a bug preventing navigation between pages
            $linkClasses = "qnbutton";
            $linkClasses .= ($start_level == $page+1) ? " active font-weight-bold" : "";
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

        $extraclasses = ($custompaginationposition == 'end' ? '' :' position-absolute right-0');

        $output .= html_writer::end_tag('div');     
        $output .= html_writer::link(
            new moodle_url($baseurl, array('attempt' => $attemptid, 'cmid' => $cmid)), 
            get_string('endtest', 'quiz'),
            array("class"=>'endtestlink btn btn-primary align-self-center'.$extraclasses, "role"=>"button")
        ); 
        $output .= html_writer::end_tag('div');
        return $output;
    }
    //CONUMDLS0211 Modified question footer with navigation to all the questions -- End

    //CONUMDLS0203 General Quiz UX/UI -- begin
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
    
    /**
     * Get an HTML string with the last time an attempt was saved.
     *
     * @return string HTML Fragment
     */
    public function last_autosave() {
        global $DB;

        $attemptid = optional_param('attempt', false, PARAM_INT);

        $sql = "SELECT MAX(qat.timemodified) AS lastsaved
                FROM {quiz_attempts} qa
                INNER JOIN mdl_question_usages qu ON qa.uniqueid = qu.id
                INNER JOIN mdl_question_attempts qat ON qat.questionusageid = qu.id
                WHERE qa.id = :attemptid";

        $lastsave = $DB->get_field_sql($sql, ['attemptid' => $attemptid]);

        $lastsavestr = $lastsave == 0 ? get_string('never') : '';

        return html_writer::span(html_writer::span(get_string('lastautosave', 'theme_saimaniq'),"strong h6") .html_writer::span($lastsavestr, 'lastsaved', ['data-lastsaved' => $lastsave]),"conu-lastautosave");
    }
    //CONUMDLS0203 General Quiz UX/UI -- end

    //CONUMDLS0203 General Quiz UX/UI -- Begin -- Custom Exam Navigation block
    /**
     * Outputs the navigation block panel
     *
     * @param quiz_nav_panel_base $panel instance of quiz_nav_panel_base
     */
    public function navigation_panel(quiz_nav_panel_base $panel) {
        global $OUTPUT,$USER;
        $extraclasses = [];
        $bodyattributes = $OUTPUT->body_attributes($extraclasses);

        $output = '';
        $enablecustomexamnavigation = get_config('theme_saimaniq', 'enablecustomexamnavigation');
        //we first verify if the setting is not enabled
        // if it's not enabled, loads the original parent function
        if (!$enablecustomexamnavigation) {
            $output .= parent::navigation_panel($panel);
            return $output;
        }

        $userpicture = $panel->user_picture();
        if ($userpicture) {
            $fullname = fullname($userpicture->user);
            if ($userpicture->size === true) {
                $fullname = html_writer::div($fullname);
            }
            $output .= html_writer::tag('div', $this->render($userpicture) . $fullname,
                    array('id' => 'user-picture', 'class' => 'clearfix'));
        }
        $output .= $panel->render_before_button_bits($this);
        $bcc = $panel->get_button_container_class();
        $output .= html_writer::start_tag('div', array('class' => "qn_buttons clearfix $bcc"));
        foreach ($panel->get_question_buttons() as $button) {
            $output .= $this->render($button);
        }
        $output .= html_writer::end_tag('div');

        //the color key segment
        $bodyattributes = $OUTPUT->body_attributes($extraclasses);

        $reflection = new ReflectionClass($panel);
        $property = $reflection->getProperty('attemptobj');
        $property->setAccessible(true);
        $attemptobj = $property->getValue($panel);
        //we are going to check if the QR Hybrid question plugin is installed
        $plugininfo = \core_plugin_manager::instance()->get_plugin_info('qtype_hybrid');
        if ($plugininfo){
            $qrsub = new qrsub();
            $has_hybrid = $qrsub->has_hybrid_question($attemptobj);
            if ($has_hybrid) {
                $search_keys = array('answered','unsure','unanswered','invalidanswerhybrid');
            }
        } else {
            $search_keys = array('answered','unsure','unanswered','invalidanswer');
        }

        if (strpos($bodyattributes,'page-mod-quiz-review')!==false){
            $search_keys = array('correct','partiallycorrect','incorrect','notanswered','gradingrequired');
        }
        $key_strings = get_strings($search_keys, 'theme_saimaniq');
        $array_keys = json_decode(json_encode($key_strings), true);
        $output .= html_writer::start_tag('div', array('class' => "question_key"));
        $output .= html_writer::tag('span', get_string('question_key', 'theme_saimaniq'));
        $output .= html_writer::start_tag('ul');
        foreach ( $array_keys as $key => $value )
        {
            $output .= html_writer::start_tag('li');
            $output .= html_writer::tag('span', $value, array('class' => "$key"));
            $output .= html_writer::end_tag('li');
        }
        
        $output .= html_writer::end_tag('ul');
        $output .= html_writer::end_tag('div');

        if (strpos($bodyattributes,'quiz-attempt')!==false) {
            $output .= $this->last_autosave();
        }
        $output .= html_writer::tag('div', $panel->render_end_bits($this),
            array('class' => 'othernav'));
        
        $this->page->requires->js_init_call('M.mod_quiz.nav.init', null, false,
                quiz_get_js_module());

        return $output;
    }

    
    /**
     * Display a quiz navigation button.
     *
     * @param quiz_nav_question_button $button
     * @return string HTML fragment.
     */
    protected function render_quiz_nav_question_button(quiz_nav_question_button $button) {

        $enablecustomexamnavigation = get_config('theme_saimaniq', 'enablecustomexamnavigation');
        //we first verify if the setting is not enabled
        // if it's not enabled, loads the original parent function
        if (!$enablecustomexamnavigation) {
            return parent::render_quiz_nav_question_button($button);
        }

        $classes = array('qnbutton', $button->stateclass, $button->navmethod, 'btn');
        $extrainfo = array();
        $unsureclasses = array ('unsure');

        if ($button->currentpage) {
            $classes[] = 'thispage';
            $extrainfo[] = get_string('onthispage', 'quiz');
        }

        // Flagged?
        if ($button->flagged) {
            //$classes[] = 'flagged';
            $flaglabel = get_string('flagged', 'question');
            $unsureclasses[]='flagged';
        } else {
            $flaglabel = '';
        }
        $extrainfo[] = html_writer::tag('span', $flaglabel, array('class' => 'flagstate'));

        if (is_numeric($button->number)) {
            $qnostring = 'questionnonav';
        } else {
            $qnostring = 'questionnonavinfo';
        }
        $a = new stdClass();
        $a->number = $button->number;
        $a->attributes = implode(' ', $extrainfo);
        $tagcontents =  html_writer::tag('span', '', array('class' => 'thispageholder')) .
                        html_writer::tag('span', '', array('class' => 'trafficlight')) .
                        html_writer::tag('span', get_string($qnostring, 'quiz', $a) , array('class' => 'buttonnumber')) .
                        html_writer::tag('span', '', array('class' => implode(' ', $unsureclasses)));
        $tagattributes = array('class' => implode(' ', $classes), 'id' => $button->id,
                                  'title' => $button->statestring, 'data-quiz-page' => $button->page);

        if ($button->url) {
            return html_writer::link($button->url, $tagcontents, $tagattributes);
        } else {
            return html_writer::tag('span', $tagcontents, $tagattributes);
        }
    }
    //CONUMDLS0203 General Quiz UX/UI -- End -- Custom Exam Navigation block
    
    //CONUMDLS0204 Summary of questions -- Start
    //Functions ported from Theme Quizzer
    public function convert_status($status,$flagged,$type='') {
        $converted = '';
        $preffix = 'badge badge-pill saimaniq-badge-';
        switch ($status) {
            case "Answer saved":
                $converted .=  get_string('answered', 'theme_saimaniq');
                $class = 'answered';
                break;
            case "Not yet answered":
                $converted .=  get_string('unanswered', 'theme_saimaniq');
                $class = 'unanswered';
                break;
            case "Incomplete answer":
                if($type == 'hybrid'){
                    $converted .=  get_string('invalidsummaryhybrid', 'theme_saimaniq');
                }else{
                    $converted .=  get_string('invalidanswer', 'theme_saimaniq');
                }
                $class = 'invalidanswer';
                break;
        }
        $flagged = ($flagged == 'flagged')?html_writer::nonempty_tag('span',get_string('unsureshort', 'theme_saimaniq'), array('class'=>$preffix.$flagged)).' / ':'';
        $output = $flagged.html_writer::nonempty_tag('span', $converted, array('class'=>$preffix.$class));
        return $output;
    }
//<span class="badge badge-pill badge-primary mr-5">Pill Badge primary</span>
    /**
     * Generates the table of summarydata
     *
     * @param quiz_attempt $attemptobj
     * @param mod_quiz_display_options $displayoptions
     */
    public function summary_table($attemptobj, $displayoptions) {
        global $USER;

        $enablecustomattemptsummary = get_config('theme_saimaniq', 'enablecustomattemptsummary');
        //we first verify if the setting is not enabled
        // if it's not enabled, loads the original parent function
        if (!$enablecustomattemptsummary) {
            return parent::summary_table($attemptobj, $displayoptions);
        }
        // Prepare the summary table header.
        $table = new html_table();
        $table->attributes['class'] = 'generaltable quizsummaryofattempt boxaligncenter';
        //$table->attributes['class'] = 'flexible quizsummaryofattempt boxaligncenter';
        $table->head = [
                            get_string('questionno', 'theme_saimaniq'),
                            get_string('question', 'quiz'), 
                            get_string('status', 'quiz')
                        ];
        $table->align = ['','',''];
        $table->size = ['','',''];
        $markscolumn = $displayoptions->marks = question_display_options::MARK_AND_MAX;
        if ($markscolumn) {
            $table->head[] = get_string('marks', 'quiz');
            $table->align[] = '';
            $table->size[] = '';
        }
        $tablewidth = count($table->align);
        $table->data = array();

        // Get the summary info for each question.
        $slots = $attemptobj->get_slots();
        foreach ($slots as $slot) {
            // Add a section headings if we need one here.
            $heading = $attemptobj->get_heading_before_slot($slot);
            if ($heading) {
                $cell = new html_table_cell(format_string($heading));
                $cell->header = true;
                $cell->colspan = $tablewidth;
                $table->data[] = [$cell];
                $table->rowclasses[] = 'quizsummaryheading';
            }

            // Don't display information items.
            if (!$attemptobj->is_real_question($slot)) {
                continue;
            }
            // Real question, show it.
            $flag = '';
            $flagged = '';
            if ($attemptobj->is_question_flagged($slot)) {
                $flagged = 'flagged';
                // Quiz has custom JS manipulating these image tags - so we can't use the pix_icon method here.
                $flag = html_writer::empty_tag('img', array('src' => $this->image_url('i/flagged'),
                        'alt' => get_string('flagged', 'question'), 'class' => 'questionflag icon-post'));
            }
            //if ($attemptobj->can_navigate_to($slot) && $checkstu == 'else') {
            if ($attemptobj->can_navigate_to($slot)) {
                $row = array(
                            html_writer::link(  $attemptobj->attempt_url($slot),
                                                $attemptobj->get_question_number($slot)),
                            html_writer::link(  $attemptobj->attempt_url($slot),
                                                html_writer::tag(
                                                                'div',
                                                                strip_tags($attemptobj->get_question_attempt($slot)->get_question($slot,false)->questiontext),
                                                                array('class'=>'questiontext-container'))),
                            html_writer::link(  $attemptobj->attempt_url($slot),
                            $this->convert_status($attemptobj->get_question_status($slot, $displayoptions->correctness),$flagged, $attemptobj->get_question_type_name($slot)))
                        );
            } else {
                $row = array(
                            $attemptobj->get_question_number($slot) . $flag,
                            $attemptobj->get_question_attempt($slot)->get_question($slot,false)->questiontext,
                            $this->convert_status($attemptobj->get_question_status($slot, $displayoptions->correctness),$flagged)
                        );
            }
            if ($markscolumn) {
                //$row[] = $attemptobj->get_question_mark($slot);
                $row[] = html_writer::link( $attemptobj->attempt_url($slot),
                                            $attemptobj->get_question_attempt($slot)->get_max_mark());
            }
            $table->data[] = $row;
            $table->rowclasses[] = 'answerrow quizsummary' . $slot . ' ' . $attemptobj->get_question_state_class(
                    $slot, $displayoptions->correctness).' '.$flagged;

        }

        // Print the summary table.
        $output = html_writer::nonempty_tag(
                                            'div', 
                                            html_writer::tag(
                                                'div',
                                                html_writer::tag(
                                                    'div',
                                                    html_writer::tag(
                                                        'div',
                                                        html_writer::table($table),
                                                        array('class'=>'no-overflow')        
                                                    ),
                                                    array('class'=>'summarytable')        
                                                )
                                            ), 
                                            array('class'=>'summarycontent')
                                        );
        $output = html_writer::nonempty_tag('div',
                                                html_writer::tag(
                                                    'div',
                                                    html_writer::tag(
                                                        'div',
                                                        html_writer::table($table),
                                                        array('class'=>'no-overflow')        
                                                    ),
                                                    array('class'=>'summarytable')        
                                                )
                                        );

        return $output;
    }
    /*
    * original function imported from theme_quizzer
    * this version should be cleaner and leaner
    */
    public function filter_panel($attemptobj, $displayoptions){
        $output = '';
        $slots = $attemptobj->get_slots();
        $filterall = $answered = $unsure = $unanswered = $invalidanswer = 0;

        $data = [];
        $data['title'] = get_string('sortby', 'theme_saimaniq');

        $search_keys = ['filterall','answered','invalidanswer','unanswered','unsure'];
        foreach ($slots as $slot) {
            $type = $attemptobj->get_question_type_name($slot);
            if($type!='description') $filterall++;
            $state = $attemptobj->get_question_state_class($slot, $displayoptions->correctness);
            switch ($state) {
                case "notyetanswered":
                    if($type!='description') $unanswered++; break;
                case "invalidanswer": $invalidanswer++; break;
                case "answersaved":
                    if($type!='description') $answered++; break;
            }
            if ($attemptobj->is_question_flagged($slot)) $unsure++;
        }
        foreach ($search_keys as $key) {
            switch ($key) {
                case "unsure":
                    $outtext = get_string('unsureshort', 'theme_saimaniq'); break;
                case "invalidanswer":
                    $plugininfo = \core_plugin_manager::instance()->get_plugin_info('qtype_hybrid');
                    if ($plugininfo){
                        $qrsub = new qrsub();
                        $has_hybrid = $qrsub->has_hybrid_question($attemptobj);
                        if ($has_hybrid) {
                            $outtext = get_string('invalidsummaryhybridbutton', 'theme_saimaniq');
                        }
                    }
                    else {
                        $outtext = get_string($key, 'theme_saimaniq');
                    }
                    break;
                default:
                    $outtext = get_string($key, 'theme_saimaniq');
            }
            $enabled = ($key == 'filterall')?'enabled':'disabled';
            $data['buttons'][]=['key' => $key, 'outtext' => $outtext, 'amount' => ${$key}, 'enabled' => $enabled ];
        }
        $output .= $this->render_from_template('theme_saimaniq/cole/filter_panel', $data);
        return $output;
    } 

    /*
     * Summary Page
     * imported from theme_quizzer
     */
    /**
     * Create the summary page
     *
     * @param quiz_attempt $attemptobj
     * @param mod_quiz_display_options $displayoptions
     */
    public function summary_page($attemptobj, $displayoptions) {
        global $CFG,$PAGE;

        $enablecustomattemptsummary = get_config('theme_saimaniq', 'enablecustomattemptsummary');
        //we first verify if the setting is not enabled
        // if it's not enabled, loads the original parent function
        if (!$enablecustomattemptsummary) {
            return parent::summary_page($attemptobj, $displayoptions);
        }
        $output = '';
        $output .= $this->header();
        //$output .= $this->heading(format_string($attemptobj->get_quiz_name()));
        //$output .= $this->heading(get_string('summaryofattempt', 'quiz'), 3);
        $output .= $this->filter_panel($attemptobj, $displayoptions);
        $output .= html_writer::start_tag('div', array('class' => "summarycontent"));
        $output .= $this->header_questions_attempted($attemptobj, false);
        $output .= $this->summary_table($attemptobj, $displayoptions);
        $output .= $this->summary_page_controls($attemptobj);
        $output .= html_writer::end_tag('div');

        $output .= $this->page->requires->js_call_amd('theme_saimaniq/cole/summary','init');
        $output .= $this->page->requires->js_call_amd('theme_saimaniq/cole/summary','modalSummary');
/*         $PAGE->requires->js(new moodle_url('/theme/quizzer/javascript/modal_summary.js'));
*/
        $output .= $this->footer();
        $templatecontext = [
            'quiz_name' => $attemptobj->get_quiz_name(),
            'isreview' => false
        ];

        /*
        * new logic to be added to contemplate scenarios with the hybrid questions
        *  The checkmark page:
        *  1 - No hybrid question: no change
        *  2 - Hybrid question: display a message specifying: 
            the student is done with the first part of the exam, 
            he will be redirected to the attempt start page 
            where he will scan the QR Code and upload his file.
        */
        $plugininfo = \core_plugin_manager::instance()->get_plugin_info('qtype_hybrid');
        if ($plugininfo) {
            $qrsub = new qrsub();
            $has_hybrid = $qrsub->has_hybrid_question($attemptobj);
            if ($has_hybrid) $templatecontext['hybrid'] = 'true';
        }
        $output .= $this->render_from_template('theme_saimaniq/cole/review', $templatecontext);
        //end new logic
        return $output;
    }
    //CONUMDLS0204 Summary of questions -- End
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

class theme_saimaniq_core_question_renderer extends core_question_renderer {
     /**
     * Generate the information bit of the question display that contains the
     * metadata like the question number, current state, and mark.
     * @param question_attempt $qa the question attempt to display.
     * @param qbehaviour_renderer $behaviouroutput the renderer to output the behaviour
     *      specific parts.
     * @param qtype_renderer $qtoutput the renderer to output the question type
     *      specific parts.
     * @param question_display_options $options controls what should and should not be displayed.
     * @param string|null $number The question number to display. 'i' is a special
     *      value that gets displayed as Information. Null means no number is displayed.
     * @return HTML fragment.
     */
    protected function info(question_attempt $qa, qbehaviour_renderer $behaviouroutput,
            qtype_renderer $qtoutput, question_display_options $options, $number) {
        global $OUTPUT;
        $output = '';

        $enablecustomquestionvisuals = get_config('theme_saimaniq', 'enablecustomquestionvisuals');

        if (!$enablecustomquestionvisuals) {
            $output .= parent::info($qa, $behaviouroutput, $qtoutput, $options, $number);
            return $output;
        }
        //enablecustomquestionvisuals
        $output .= $this->number_custom($number, $qa);

        $extraclasses = [];
        $bodyattributes = $OUTPUT->body_attributes($extraclasses);
        /**
         * two conditions 
         * a. the exam is closed and
         * b. teacher enabled review after exam closed
         */
        if (!empty($options->editquestionparams)) {
            $output .= $this->status($qa, $behaviouroutput, $options);
            $output .= $this->mark_summary($qa, $behaviouroutput, $options);
            //$output .= $this->question_flag($qa, $options->flags);
        //added verification in case a student is here
        } else {
            //extra verification to prevent error on question preview page
            //2024-10-01 - we invert the verification
            if (strpos($bodyattributes,'page-question-preview')==true ||
                strpos($bodyattributes,'page-question-bank-previewquestion-preview')==true ){    
                $output .= $this->mark_summary($qa, $behaviouroutput, $options);
            }
            else{
                $reflection = new ReflectionClass($qa);
                $property = $reflection->getProperty('usageid');
                $property->setAccessible(true);
                $attemptid = $property->getValue($qa);

                $quizobj =$this->get_quiz_by_id($this->get_quiz_id_by_attemptid($attemptid));

                $t=time();
                $closingtime = $quizobj->timeclose;
                if($closingtime && 
                    $t>$closingtime && 
                    $quizobj->reviewattempt & mod_quiz_display_options::AFTER_CLOSE){
                        $output .= $this->mark_summary($qa, $behaviouroutput, $options);
                }
            }       
        }
        $output .= $this->edit_question_link($qa, $options);
        $output .= $this->question_flag_custom($qa, $options->flags);
        return $output;
    }

    protected function get_quiz_by_id(int $quizid): stdClass {
        global $DB;
        return $DB->get_record('quiz', array('id' => $quizid), '*', MUST_EXIST);
    }

    protected function get_quiz_id_by_attemptid(string $attemptid) {
        global $DB;
        return $DB->get_field('quiz_attempts','quiz', array('uniqueid' => $attemptid));
    }

    /**
     * Render the question flag, assuming $flagsoption allows it.
     *
     * @param question_attempt $qa the question attempt to display.
     * @param int $flagsoption the option that says whether flags should be displayed.
     */
    protected function question_flag_custom(question_attempt $qa, $flagsoption) {
        global $CFG;

        $divattributes = array('class' => 'questionflag');

        switch ($flagsoption) {
            /*
            case question_display_options::VISIBLE:
                $flagcontent = $this->get_flag_html_custom($qa->is_flagged());
                break;
            */
            case question_display_options::EDITABLE:
                $id = $qa->get_flag_field_name();
                // The checkbox id must be different from any element name, because
                // of a stupid IE bug:
                // http://www.456bereastreet.com/archive/200802/beware_of_id_and_name_attribute_mixups_when_using_getelementbyid_in_internet_explorer/
                $checkboxattributes = array(
                    'type' => 'checkbox',
                    'id' => $id . 'checkbox',
                    'name' => $id,
                    'value' => 1,
                );
                if ($qa->is_flagged()) {
                    $checkboxattributes['checked'] = 'checked';
                }
                $postdata = question_flags::get_postdata($qa);
                $flagcontent =  html_writer::empty_tag('input',
                                    array('type' => 'hidden', 'name' => $id, 'value' => 0)) .
                                html_writer::empty_tag('input', $checkboxattributes) .
                                html_writer::empty_tag('input',
                                        array('type' => 'hidden', 'value' => $postdata, 'class' => 'questionflagpostdata')) .
                                html_writer::tag('label', $this->get_flag_html_custom($qa->is_flagged(), $id . 'img'),
                                        array('id' => $id . 'label', 'for' => $id . 'checkbox')) . "\n";

                $divattributes = array(
                    'class' => 'questionflag editable',
                    'aria-atomic' => 'true',
                    'aria-relevant' => 'text',
                    'aria-live' => 'assertive',
                );

                break;

            default:
                $flagcontent = '';
        }

        return html_writer::nonempty_tag('div', $flagcontent, $divattributes);
    }

    /**
     * Work out the actual img tag needed for the flag
     *
     * @param bool $flagged whether the question is currently flagged.
     * @param string $id an id to be added as an attribute to the img (optional).
     * @return string the img tag.
     */
    protected function get_flag_html_custom($flagged, $id = '') {
        if ($flagged) {
            $icon = 'i/flagged';
            $alt = get_string('clickunflag', 'question');
            $label = get_string('unsureattempt', 'theme_saimaniq');
        } else {
            $icon = 'i/unflagged';
            $alt = get_string('clickflag', 'question');
            $label = get_string('unsureattempt', 'theme_saimaniq');
        }
        $attributes = array(
            'src' => $this->image_url($icon),
            'alt' => $alt,
            'class' => 'questionflagimage',
        );
        if ($id) {
            $attributes['id'] = $id;
        }
        $img = html_writer::empty_tag('img', $attributes);
        $img .= html_writer::span($label);

        return $img;
    }

    /**
     * Generate the display of the question number.
     * @param string|null $number The question number to display. 'i' is a special
     *      value that gets displayed as Information. Null means no number is displayed.
     * @param question_attempt $qa the question attempt to display.
     * @return HTML fragment.
     */
    protected function number_custom($number, question_attempt $qa) {
        global $DB;

        $questionusageid = $DB->get_field('question_attempts','questionusageid', array('id' => $qa->get_database_id()));

        $sql = "SELECT qa.id, q.id, q.qtype FROM {question_attempts} qa INNER JOIN {question} q ON qa.questionid = q.id WHERE qa.questionusageid = :questionusageid AND q.qtype <> 'description' ORDER BY qa.id ASC";
        $qtotal = count($DB->get_records_sql($sql,array('questionusageid' => $questionusageid)));

        if (trim($number) === '') {
            return '';
        }
        $numbertext = '';

        if (trim($number) === 'i') {
            $numbertext = get_string('information', 'question');
        } else {
            $percentage = round(($number/$qtotal)*100);
            $classperc = ($percentage>50) ? "over50" : '';

            $number = html_writer::tag('span', $number, array('class' => 'qnumber question-font'));
            $qtotal = html_writer::tag('span', " of ".$qtotal, array('class' => 'qtotal small small-60 question-font'));
            $numbertext .= html_writer::tag('span', $number.$qtotal, array('class' => 'qnumber qno'));
        }
        return html_writer::tag('h3', $numbertext, array('class' => 'no'));
    }

    /**
     *
     * @return HTML fragment.
     */
    protected function highlighters() {
        return html_writer::tag('div','', array('class' => 'text-highlight-pallet'));
    }

    protected function max_mark_question(question_attempt $qa) {
        $output  = '';
        $marks = $qa->get_max_mark();
        $mark = ($marks>1) ? get_string('attemptmarks', 'theme_saimaniq') : get_string('attemptmark', 'theme_saimaniq');
        $display = ($qa->get_question(false)->get_type_name() == 'description' ? 'd-none' : 'd-flex');
        $output .= html_writer::start_tag('div', array('class' => 'qmarks '.$display.' flex-wrap position-relative w-15'));
        $output .= html_writer::tag('span',$mark, array('class' => 'pl-2 string w-50 small conu-tint-dark-blue-background align-content-center'));
        $output .= html_writer::tag('span',$marks, array('class' => 'pl-2 number w-50 pl-2 bold conu-tint-blue-background'));
        $output .= html_writer::end_tag('div');
        return $output;
    }

    protected function add_part_marks($highlighters, $marks) {
        
        global $USER,$PAGE;
        $context = $PAGE->context;
        $role = theme_saimaniq\helper::get_role($context,$USER->id);
        $preset = theme_saimaniq\helper::is_cole_preset(theme_config::load('saimaniq'));
        return ($role == "student" && $preset == true ? html_writer::tag('div', $highlighters.$marks, array('class' => 'row mx-0 flex-row justify-content-end', 'id' => 'additional-control')) : '' );
        
        /*return html_writer::tag('div', $highlighters.$marks, array('class' => 'row mx-0 flex-row justify-content-end', 'id' => 'additional-control'));*/
    }

    /**
     * Generate the display of a question in a particular state, and with certain
     * display options. Normally you do not call this method directly. Intsead
     * you call {@link question_usage_by_activity::render_question()} which will
     * call this method with appropriate arguments.
     *
     * @param question_attempt $qa the question attempt to display.
     * @param qbehaviour_renderer $behaviouroutput the renderer to output the behaviour
     *      specific parts.
     * @param qtype_renderer $qtoutput the renderer to output the question type
     *      specific parts.
     * @param question_display_options $options controls what should and should not be displayed.
     * @param string|null $number The question number to display. 'i' is a special
     *      value that gets displayed as Information. Null means no number is displayed.
     * @return string HTML representation of the question.
     */
    public function question(question_attempt $qa, qbehaviour_renderer $behaviouroutput,
            qtype_renderer $qtoutput, question_display_options $options, $number) {
        
        $output = '';
        
        $preset = theme_saimaniq\helper::is_cole_preset(theme_config::load('saimaniq'));
        $enablecustomquestionvisuals = get_config('theme_saimaniq', 'enablecustomquestionvisuals');

        if (!$enablecustomquestionvisuals || $preset == false) {
            $output .= parent::question($qa, $behaviouroutput, $qtoutput, $options, $number);
            return $output;
        }
        $output .= html_writer::start_tag('div', array(
            'id' => $qa->get_outer_question_div_unique_id(),
            'class' => implode(' ', array(
                'que',
                $qa->get_question(false)->get_type_name(),
                $qa->get_behaviour_name(),
                $qa->get_state_class($options->correctness && $qa->has_marks()),
            ))
        ));

        $output .= html_writer::tag('div',
                $this->info($qa, $behaviouroutput, $qtoutput, $options, $number),
                array('class' => 'info'));

        $output .= html_writer::start_tag('div', array('class' => 'content'));

        //$output .= $this->max_mark_question($qa);
        $output .= $this->add_part_marks( $this->highlighters(), $this->max_mark_question($qa));
        $output .= html_writer::tag('div',
                $this->add_part_heading($qtoutput->formulation_heading(),
                    $this->formulation($qa, $behaviouroutput, $qtoutput, $options)),
                array('class' => 'formulation clearfix'));
        $output .= html_writer::nonempty_tag('div',
                $this->add_part_heading(get_string('feedback', 'question'),
                    $this->outcome($qa, $behaviouroutput, $qtoutput, $options)),
                array('class' => 'outcome clearfix'));
        $output .= html_writer::nonempty_tag('div',
                $this->add_part_heading(get_string('comments', 'question'),
                    $this->manual_comment($qa, $behaviouroutput, $qtoutput, $options)),
                array('class' => 'comment clearfix'));
        $output .= html_writer::nonempty_tag('div',
                $this->response_history($qa, $behaviouroutput, $qtoutput, $options),
                array('class' => 'history clearfix border p-2'));
        //$output .= $this->notes_area($number);
        $output .= html_writer::end_tag('div');
        $output .= html_writer::end_tag('div');
        //Added from Nicolas' renderers.php
        //21-09-2021

        // Only add the files from the upload exam on hybrid question.
        $question_definition = $qa->get_question(false);
        if (get_class($question_definition) == 'qtype_hybrid_question') {

	          $id = optional_param('attempt', 0, PARAM_INT);

	          // Those pages shouldn't have the file list attach to them.
	          $no_file_pages = array('local-qrsub-attempt', 'mod-quiz-attempt');

	          // Make sure we have an attempt id and we are not in a question attempt page.
	          if ($id !== 0 && !in_array($this->page->pagetype, $no_file_pages)) {
	              $attemptobj = quiz_attempt::create($id);

	              // Create a quiz attempt obj, get the uploaded files and add them to the page.
	              $files = qrsub::get_files_from_upload_exam($attemptobj, $qa->get_slot(), $this->output);
	              if (!empty($files)) {
	                  $output = qrsub::add_upload_exam_files_to_review($output, $files);
	              }
	          }
        }
        // QRMOOD-40
        //end Nicolas' addition 
        return $output;
    }
}