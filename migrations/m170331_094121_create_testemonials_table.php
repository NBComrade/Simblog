<?php

use yii\db\Migration;

/**
 * Handles the creation of table `testemonials`.
 */
class m170331_094121_create_testemonials_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('testemonials', [
            'id' => $this->primaryKey(),
            'title'=> $this->string(),
            'content' => $this->text(),
            'author' => $this->string(),
            'photo' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('testemonials');
    }
}
