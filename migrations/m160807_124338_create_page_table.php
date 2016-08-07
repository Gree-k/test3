<?php

use yii\db\Migration;

/**
 * Handles the creation for table `page`.
 */
class m160807_124338_create_page_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('page', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->bigInteger(),
            'url' => $this->string(),
            'key' => $this->string(),
            'text' => $this->text(),
            'new' => $this->boolean(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('page');
    }
}
