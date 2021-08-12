<?php

/**
 * @package local_qrbasedimage
 * @author Pearl Miglani <miglanipearl@gmail.com> and Shreyans Jain <shreyansja1n@outlook.com>
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
    
if ($oldversion < 2021081200) {


        // Define table local_qrbasedimage to be created.
        $table = new xmldb_table('local_qrbasedimage');

        // Adding fields to table local_qrbasedimage.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);

        // Adding keys to table local_qrbasedimage.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for local_qrbasedimage.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Qrbasedimage savepoint reached.
        upgrade_plugin_savepoint(true, 2021081200, 'local', 'qrbasedimage');
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

        // Message savepoint reached.
        upgrade_plugin_savepoint(true, 2021081200, 'local', 'qrbasedimage');


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
        $table->add_key('pk', XMLDB_KEY_PRIMARY, ['id']);

        // Conditionally launch create table for images.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Message savepoint reached.
        upgrade_plugin_savepoint(true, 2021081200, 'local', 'qrbasedimage');
}