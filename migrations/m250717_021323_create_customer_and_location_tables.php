<?php

use yii\db\Migration;

class m250717_021323_create_customer_and_location_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //Province table
        $this->createTable('province', [
           'id'=> $this->primaryKey(),
            'name'=> $this->string(50)->notNull()->unique(),
        ]);

        //Distric table
        $this->createTable('district', [
            'id'=> $this->primaryKey(),
            'name'=> $this->string(50)->notNull()->unique(),
            'province_id'=> $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_district_province',
            'district',
            'province_id',
            'province',
            'id',
            'CASCADE'
        );
        //Ward table
        $this->createTable('ward', [
            'id'=> $this->primaryKey(),
            'name'=> $this->string(50)->notNull()->unique(),
            'district_id'=> $this->integer(),
        ]);

        $this->addForeignKey(
            'fk_ward_district',
            'ward',
            'district_id',
            'district',
            'id',
            'CASCADE'
        );

        // Customer table
        $this->createTable('customer', [
            'id'=> $this->primaryKey(),
            'name'=> $this->string(50)->notNull(),
            'note'=> $this->text(),
            'dob'=> $this->date(),
            'province_id'=> $this->integer(),
            'district_id'=> $this->integer(),
            'ward_id'=> $this->integer(),
            'address'=> $this->string(50),
            'created_at'=> $this->date(),
            'updated_at'=> $this->date(),
            'created_by'=> $this->integer(),
            'is_deleted'=>$this->boolean()->defaultValue(false),
        ]);
        $this->addForeignKey('fk_customer_province', 'customer', 'province_id', 'province', 'id', 'CASCADE');
        $this->addForeignKey('fk_customer_district', 'customer', 'district_id', 'district', 'id', 'CASCADE');
        $this->addForeignKey('fk_customer_ward', 'customer', 'ward_id', 'ward', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey('fk_customer_province', 'customer');
        $this->dropForeignKey('fk_customer_district', 'customer');
        $this->dropForeignKey('fk_customer_ward', 'customer');
        $this->dropForeignKey('fk_ward_district', 'ward');
        $this->dropForeignKey('fk_district_province', 'district');

        // Sau đó xóa các bảng theo thứ tự ngược lại
        $this->dropTable('customer');
        $this->dropTable('ward');
        $this->dropTable('district');
        $this->dropTable('province');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250717_021323_create_customer_and_location_tables cannot be reverted.\n";

        return false;
    }
    */
}
