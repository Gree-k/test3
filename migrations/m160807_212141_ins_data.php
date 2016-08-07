<?php

use yii\db\Migration;

class m160807_212141_ins_data extends Migration
{
    public function safeUp()
    {
        $data = (new \yii\db\Query())
            ->select('*')
            ->from('categories')
            ->all();
        $rows=[];

        foreach ($data as $item) {
            $rows[]=[$item['id'],$item['parent_id'], $item['name'],$item['name'],$item['name']];
        }
        $this->batchInsert('page',['id', 'parent_id', 'url', 'key', 'title'], $rows);



//        foreach ($data as $item) {
//            $this->insert('page', [
//                'id' => $item['id'],
//                'parent_id' => $item['parent_id'],
//                'url' => $item['name'],
//                'key' => $item['name'],
//                'title' => $item['name'],
//
//            ]);
//        }

    }

    public function safeDown()
    {
        $this->delete('page');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
