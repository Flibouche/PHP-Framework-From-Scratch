<?php

namespace Migration;

defined('ROOTPATH') or exit('Access Denied');

/**
 * {CLASSNAME} class
 */
class {CLASSNAME}
{
    use Migration;

    public function up()
    {
        /** Méthodes autorisées **/
        /*
        $this->addColumn();
        $this->addPrimaryKey();
        $this->addUniqueKey();

        $this->addData();
        $this->insertData();

        $this->createTable();
        */
    }

    public function down()
    {
        $this->dropTable('{classname}');
    }
}