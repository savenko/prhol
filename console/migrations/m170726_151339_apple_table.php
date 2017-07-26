<?php

use yii\db\Migration;

class m170726_151339_apple_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(50),
            'created_at' => $this->integer(),
            'fall_at' => $this->integer(),
            'status' => 'ENUM("hanging","fall","rotten") DEFAULT "hanging"',
            'size' =>  $this->decimal(3,2)
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%apple}}');

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170726_151339_apple_table cannot be reverted.\n";

        return false;
    }
    */
}
