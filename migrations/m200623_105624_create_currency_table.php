<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency}}`.
 */
class m200623_105624_create_currency_table extends Migration
{
    private $table_name = '{{%currency}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table_name, [
            'id' => $this->string(10),
            'name' => $this->string(255)->notNull(),
            'rate' => $this->double()->notNull(),
        ]);
        
        $this->addPrimaryKey('id_primary_key', $this->table_name, 'id');
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table_name);
    }
}
