<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Migration_Add_doctors extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
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
                "comment" => "كلمة المرور  "
            ),
            'doctor_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                "comment" => "أسم الدكتور"
            ),
            'phone_number' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                "comment" => " رقم العيادة  "
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                "comment" => "العنوان"
            ),
            'map' => array(
                'type' => 'longtext',
                 "comment" => "العنوان على خريطة كوكل"
            ),
           
            'cost' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                "comment" => "كلفة الحجز"
            ),
            'Accurate_Specialty' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                "comment" => "تخصص دقيق"
            ),
            'general_Specialty' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
                "comment" => "تخصص عام"
            ),
            'Maximum_visitors' => array(
                'type' => 'INT',
                 "comment" => "اقصى عدد للمراجعين"
            ),
           
            'gender' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
                "comment" => "الجنس  "
            ),
            
            'image' => array(
                'type' => 'longtext',
                "comment" => "الصورة الشخصية  "
            ),
            
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('doctors');
    }
    public function down()
    {
        $this->dbforge->drop_table('doctors');
    }
}
