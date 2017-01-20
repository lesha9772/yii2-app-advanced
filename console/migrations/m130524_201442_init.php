<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        
        $tableOptions2 = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions2 = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB AUTO_INCREMENT=43';
        }
        
           $this->createTable('{{%user_details}}', [
            'user_id' => $this->primaryKey(),
            'user_name' => $this->string(200)->notNull(),
            'avatar' => $this->string(255)->null(),
            'skype' => $this->string(60)->notNull(),
            'phone' => $this->string(60)->notNull(),
            'is_active' => $this->smallInteger(1)->defaultValue(1)->notNull(),
            'is_approved' => $this->smallInteger(1)->defaultValue(0)->notNull(),
            'country' => $this->string(80)->null(),
            'city' => $this->string(80)->null(),
            'sex' => $this->smallInteger(1)->defaultValue(1)->notNull(),
            'birthday' => $this->dateTime()->null(),
            'about' => $this->text(),
            'interest' => $this->text(),
            'is_teacher' => $this->smallInteger(1)->null(),
            'is_student' => $this->smallInteger(1)->null(),
                   
            'auth_key' => $this->string(32)->notNull(),   
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
               
               
        ], $tableOptions2);
           
           
            $this->createIndex('is_active', 'user_details', 'is_active');
            $this->createIndex('is_approved', 'user_details', 'is_approved');
            $this->createIndex('is_teacher', 'user_details', 'is_teacher');
            $this->createIndex('is_student', 'user_details', 'is_student');
           
        
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
        
        $this->dropIndex('is_active','user_details');
        $this->dropIndex('is_approved','user_details');
        $this->dropIndex('is_teacher','user_details');
        $this->dropIndex('is_student','user_details');
        
        $this->dropTable('{{%user_details}}');
    }
}
