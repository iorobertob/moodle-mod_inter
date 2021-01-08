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
 * Backup steps for mod_inter are defined here.
 *
 * @package     mod_inter
 * @category    backup
 * @copyright   2019 LMTA <roberto.becerra@lmta.lt>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// For more information about the backup and restore process, please visit:
// https://docs.moodle.org/dev/Backup_2.0_for_developers
// https://docs.moodle.org/dev/Restore_2.0_for_developers

/**
 * Define the complete structure for backup, with file and id annotations.
 */
class backup_inter_activity_structure_step extends backup_activity_structure_step {

    /**
     * Defines the structure of the resulting xml file.
     *
     * @return backup_nested_element The structure wrapped by the common 'activity' element.
     */
    protected function define_structure() {
        $userinfo = $this->get_setting_value('userinfo');

        // Replace with the attributes and final elements that the element will handle.
        // $attributes = null;
        // $final_elements = null;
        // TODO !!!!!!!!!!! ADD NAME OF FIELD TO BACKUP ALSO THE SEPARATION CHAR ( AND TEST !!!!! )
        $inter = new backup_nested_element('inter', 
                                            array('id'), 
                                            array(
                                                'name',
                                                'separationchar'
                                                'timecreated',
                                                'timemodified'));
        // Build the tree with these elements with $root as the root of the backup tree.

        // Define the data source.
        $inter->set_source_table('inter', array('id' => backup::VAR_ACTIVITYID));

        // Define id annotations.

        // Define file annotations.
        $inter->annotate_files('mod_inter', 'intro', null);
        $inter->annotate_files('mod_inter', 'content', null); // This file areas haven't itemid
        $inter->annotate_files('mod_inter', 'file', null); // This file areas haven't itemid

        return $this->prepare_activity_structure($inter);
    }
}
