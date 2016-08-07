<?php

use yii\db\Migration;

class m160807_210934_insert_page_data extends Migration
{
    public function up()
    {

        $this->addColumn('page', 'title', 'string');

    }

    public function down()
    {
        $this->dropColumn('page', 'title');
    }




}
