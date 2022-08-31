<?php
defined('BASEPATH') or exit('No direct script access allowed');
/* اضافة جدول ادارة  المساعدين الاطباء  */
class Migration_Add_Assistant extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                "comment" => "اسم المستخدم"
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                "comment" => "كلمة المرور"
            ),
               
            'doctor_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
             ),

            'Power' => array(
                'type' => 'INT',
                'constraint' => 5,
                "comment" => "الصلاحية"
            ),
         
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('doctorAssistant');
    }
    public function down()
    {
        $this->dbforge->drop_table('doctorAssistant');
    }
}
