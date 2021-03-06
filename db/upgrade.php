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
 * Plugin upgrade steps are defined here.
 *
 * @package     mod_inter
 * @category    upgrade
 * @copyright   2019 LMTA <roberto.becerra@lmta.lt>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once(__DIR__.'/upgradelib.php');

/**
 * Execute mod_inter upgrade from the given old version.
 *
 * @param int $oldversion
 * @return bool
 */
function xmldb_inter_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    // For further information please read the Upgrade API documentation:
    // https://docs.moodle.org/dev/Upgrade_API
    //
    // You will also have to create the db/install.xml file by using the XMLDB Editor.
    // Documentation for the XMLDB Editor can be found at:
    // https://docs.moodle.org/dev/XMLDB_editor

    if ($oldversion < 2019030501)
    {
    	// Define field author to be added to mposter.
        $table = new xmldb_table('inter');
        $field = new xmldb_field('platformwide', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'intro');

        // Conditionally launch add field author.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
     
        // Poster savepoint reached.
        upgrade_mod_savepoint(true, 2019030501, 'inter');
    } 


    if ($oldversion < 2019030505)
    {
        // Define field author to be added to mposter.
        $table = new xmldb_table('inter');
        $field = new xmldb_field('meta1', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'name');

        // Conditionally launch add field author.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('meta2', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'meta1');

        // Conditionally launch add field author.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('meta3', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'meta2');

        // Conditionally launch add field author.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('meta4', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'meta3');

        // Conditionally launch add field author.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('meta5', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null, 'meta4');

        // Conditionally launch add field author.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Poster savepoint reached.
        upgrade_mod_savepoint(true, 2019030505, 'inter');
    }

    if ($oldversion < 2019030507)
    {
    	// Define field author to be added to mposter.
        $table = new xmldb_table('inter');
        $field = new xmldb_field('serial_data', XMLDB_TYPE_TEXT, null, null, null, null, null, 'intro');

        // Conditionally launch add field author.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
     
        // Poster savepoint reached.
        upgrade_mod_savepoint(true, 2019030507, 'inter');
    } 

    if ($oldversion < 2019030510)
    {
        // Define field author to be added to mposter.
        $table = new xmldb_table('inter');
        $field = new xmldb_field('meta6', XMLDB_TYPE_TEXT, null, null, null, null, null, 'meta5');

        // Conditionally launch add field author.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
     
        // Poster savepoint reached.
        upgrade_mod_savepoint(true, 2019030510, 'inter');
    } 

    if ($oldversion < 2019030512)
    {
        // Define field author to be added to mposter.
        $table = new xmldb_table('inter');
        $field = new xmldb_field('meta7', XMLDB_TYPE_TEXT, null, null, null, null, null, 'meta6');

        // Conditionally launch add field author.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
     
        // Poster savepoint reached.
        upgrade_mod_savepoint(true, 2019030512, 'inter');
    } 

    return true;
}
