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
 * Upgrade script for the quiz module.
 *
 * @package    mod_quiz
 * @copyright  2006 Eloy Lafuente (stronk7)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Quiz module upgrade function.
 * @param string $oldversion the version we are upgrading from.
 */
function xmldb_quiz_upgrade($oldversion) {
    global $CFG, $DB;
    $dbman = $DB->get_manager();

    // Automatically generated Moodle v3.6.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.7.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.8.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.9.0 release upgrade line.
    // Put any upgrade step following this.

    if ($oldversion < 2021072504) {

        // Define field completionminattempts to be added to quiz.
        $table = new xmldb_table('quiz');
        $field = new xmldb_field('completionminattempts', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0',
            'completionpass');

        // Conditionally launch add field completionminattempts.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define table randomnumber to be created.
        $table = new xmldb_table('randomnumber');

        // Adding fields to table randomnumber.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '9', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('ran_num', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('attemptid', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('tstamp', XMLDB_TYPE_DATETIME, null, null, XMLDB_NOTNULL, null, 'CURRENT_TIMESTAMP');

        // Adding keys to table randomnumber.
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for randomnumber.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

                // Define table images to be created.
        $table = new xmldb_table('images');

        // Adding fields to table images.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '9', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('name', XMLDB_TYPE_CHAR, '80', null, XMLDB_NOTNULL, null, 'image');
        $table->add_field('image', XMLDB_TYPE_CHAR, '80', null, XMLDB_NOTNULL, null, 'image');
        $table->add_field('ran_num', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('attemptid', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('uniqueid', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('tstamp', XMLDB_TYPE_DATETIME, null, null, XMLDB_NOTNULL, null, 'CURRENT_TIMESTAMP');
        $table->add_field('quesid', XMLDB_TYPE_INTEGER, '9', null, null, null, null);
        $table->add_field('slot', XMLDB_TYPE_INTEGER, '9', null, null, null, null);

        // Adding keys to table images.
        $table->add_key('primarykey', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for images.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
        else{
            $table = new xmldb_table('images');
            $field = new xmldb_field('uniqueid', XMLDB_TYPE_INTEGER, '9', null, null, null, null, 'attemptid');
            $dbman->add_field($table, $field);
        }

        // Quiz savepoint reached.
        upgrade_mod_savepoint(true, 2021072504, 'quiz');
    }

    // Automatically generated Moodle v3.10.0 release upgrade line.
    // Put any upgrade step following this.

    // Automatically generated Moodle v3.11.0 release upgrade line.
    // Put any upgrade step following this.

    return true;
}
