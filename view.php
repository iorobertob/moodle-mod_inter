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
 * Prints an instance of mod_inter.
 *
 * @package     mod_inter
 * @copyright   2019 LMTA <roberto.becerra@lmta.lt>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../config.php');
require_once(__DIR__.'/lib.php');


require_once("$CFG->dirroot/mod/inter/locallib.php");

global $DB, $CFG;//, $PAGE;

// Course_module ID, or
$id = optional_param('id', 0, PARAM_INT);

// ... module instance id.
$i  = optional_param('i', 0, PARAM_INT);

if ($id) {
    $cm             = get_coursemodule_from_id('inter', $id, 0, false, MUST_EXIST);
    $course         = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $moduleinstance = $DB->get_record('inter', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($i) {
    $moduleinstance = $DB->get_record('inter', array('id' => $n), '*', MUST_EXIST);
    $course         = $DB->get_record('course', array('id' => $moduleinstance->course), '*', MUST_EXIST);
    $cm             = get_coursemodule_from_instance('inter', $moduleinstance->id, $course->id, false, MUST_EXIST);
} else {
    print_error(get_string('missingidandcmid', mod_inter));
}

require_login($course, true, $cm);
require_capability('mod/inter:view', $PAGE->context);

$modulecontext = context_module::instance($cm->id);

$event = \mod_inter\event\course_module_viewed::create(array(
    'objectid' => $moduleinstance->id,
    'context' => $modulecontext
));
$event->add_record_snapshot('course', $course);
$event->add_record_snapshot('inter', $moduleinstance);
$event->trigger();

$PAGE->set_url('/mod/inter/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($moduleinstance->name));
$PAGE->set_heading(format_string($course->fullname));

$data_array    = [];
$the_big_array = []; 

// Get an array with the data about posters
$courseid = $PAGE->course->id;
// $the_big_array = get_poster_list_array($data_array, $courseid, $moduleinstance);

// $data = $data = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $DB->get_field('inter', 'serial_data', array ('id' => $moduleinstance->id)));
$data = $DB->get_field('inter', 'serial_data', array ('id' => $moduleinstance->id));
// $data = preg_replace_callback ( '!s:(\d+):"(.*?)";!', function($match) {      
    // return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';
// },$data );

$the_big_array = unserialize($data);

// This is the HTML table to render, built based on the big array data
$table         = inter_build_html_table($course, $moduleinstance, $the_big_array);

$PAGE->set_context($modulecontext);

echo $OUTPUT->header();

echo $table;

echo $OUTPUT->footer();






























