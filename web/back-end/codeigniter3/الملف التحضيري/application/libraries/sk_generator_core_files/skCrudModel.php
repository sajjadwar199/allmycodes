<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*  model auto genarate by sk_ci3_crud_generator */
class skCrudModel extends CI_Model
{
   /********************************setting start *********************************************************************************************** */
   /** مكتبة عمل بسيطة للمودل crud تمت برمجتها بواسطة سجاد عبد الكريم 
    *  create in 2021/9/5 at 9:13pm
    *                                    طريقة الاستدعاء
    *    <?php
    *    defined('BASEPATH') or exit('No direct script access allowed');
    *    include  'application/libraries/skModel.php ';
    *     class brandsModel extends skModel
    *      {
    *     public function __construct()
    *     {
    *        parent:: __construct('brands', 'id', 'brands', ["status" => "status", "brand_name" => "brand_name"], 'تم حذف الماركة بنجاح',);
    *     }
    *   }
    *********************************************************************************************************************************************
    *
    *
    *
    *
    */
   /**
    * table اسم الجدول
    *
    * @var string
    */
   protected $table = 'brands';
   /**
    * idName في قاعدة البيانات id اسم حقل 
    *
    * @var string
    */
   private   $idName = 'id';
   /**
    * orderby الترتيب في قاعدة البيانات 
    *
    * @var string
    */
   private   $orderby = 'asc';
   /**
    * select ex: name,id,username     , *
    *
    * @var string
    */
   private   $select = '*';
   /**
    * sucessMessageDelete  أسم رسالة الحذف
    *
    * @var string
    */
   private   $sucessMessageDelete = 'تمت حذف  الماركة بنجاح';
   /**
    * controllerName أسم الكنترولر
    *
    * @var string
    */
   private   $controllerName = 'brands';
   /**
    * updateFeilds example    ["اسم الحقل في المدخلات  "<="اسم الحقل في قاعدة البيانات"]
    *
    * @var array
    */
   private   $updateFeilds = [
      "status" => "status",
      "brand_name" => "brand_name"
   ];
   /********************************setting end ****************************** */

   /**
    * __construct
    *
    * @param  mixed $table اسم الجدول
    * @param  mixed $idName اسم الحقل في قاعدة البيانات
    * @param  mixed $controllerName اسم الكنترولر
    * @param  array $updateFeilds   example    ["اسم الحقل في المدخلات  "<="اسم الحقل في قاعدة البيانات"]
    * @param  mixed $sucessMessageDelete       رسالة الحذف
    * @param  mixed $orderby   الترتيب في قاعدة البيانات 
    * @param  mixed $select    ex: name,id,username      او *
    * @return void
    */
   public function __construct($table, $idName, $controllerName, $updateFeilds = array(), $sucessMessageDelete, $orderby = 'asc', $select = '*')
   {
      parent::__construct();
      $this->load->database();
      $this->table = $table;
      $this->idName = $idName;
      $this->controllerName = $controllerName;
      $this->updateFeilds = $updateFeilds;
      $this->sucessMessageDelete = $sucessMessageDelete;
      $this->orderby = $orderby;
      $this->select = $select;
   }
   //for showing brands   
   /**
    * get_data
    *
    * @return void
    */
   public function get_data()
   {
      $query =
         $this->db->order_by($this->idName, $this->orderby)
         ->get($this->table);
      return $query->result();
   }
   //insert    
   /**
    * insert
    *
    * @param  mixed $data
    * @return void
    */
   public function insert($data)
   {

      return $this->db->insert($this->table, $data);
   }
   //count data in db    
   /**
    * get_count
    *
    * @return void
    */
   public function get_count()
   {
      return $this->db->count_all($this->table);
   }
   //get count where    
   /**
    * get_count_where
    *
    * @param  mixed $id
    * @return void
    */
   public function get_count_where($id)
   {
      $this->db->select($this->select);
      $this->db->from($this->table);
      $this->db->where($this->idName, $id);
      return $this->db->count_all_results();
   }
   //delete   
   /**
    * delete
    *
    * @param  mixed $id
    * @return void
    */
   public function delete($id)
   {
       
      $this->db->where($this->idName, $id);
      $this->db->delete($this->table);
      $this->session->set_flashdata('success', $this->sucessMessageDelete);
      echo $this->session->flashdata('success');
      redirect("$this->controllerName/index");
   }
   public function get_where($id)
   {
      $query = $this->db->select($this->select)
         ->where($this->idName, $id)
         ->get($this->table);
      return $query->result();
   }
   // للتحديث   
   /**
    * update
    *
    * @param  mixed $data
    * @return void
    */
    public function update($data)
    {
     
      $this->db->where($this->idName,$data[$this->idName]);
      if ($this->setUpdateFeilds($data)) {
         $f = $this->db->update($this->table, $this->setUpdateFeilds($data));
      }
      if ($f) {
         return true;
      }
    }
   //لتهيئة العناصر للأضافة    
   /**
    * setUpdateFeilds
    *
    * @param  mixed $data
    * @return void
    */
   private function setUpdateFeilds($data)
   {
      $updateFelids = array();
      foreach ($this->updateFeilds as $k => $v) {
         $updateFelids["$k"] = $data["$v"];
      }
      if ($updateFelids) {
         return   $updateFelids;
      }
   }
   /**
    * delete_file   دالة لحذف الملفات
    *   طريقة الاستدعاء    $model->delete_file('website_photo',$id,"./uploads/websites_photos/"); 
    * @param  mixed $file_feild_name   اسم حقل الملف في قاعدة البيانات
    * @param  mixed $id   الايدي في قاعدة البيانات 
    * @param  mixed $idName اسم الايدي في قاعدة البيانات 
    * @param  mixed $path_upload_folder موقع وجود الملف ex.. 
    * @return void
    */
    public function delete_file($file_feild_name,$id,$path_upload_folder)
    {
       //get data form database   
       $this->load->helper("file");
       $query = $this->db->select($this->select)
          ->where($this->idName, $id)
          ->get($this->table);
         $query->result();
        foreach ( $query->result() as $q) {
          $path = $q->$file_feild_name;
       }
       if(file_exists($path)){
         if (unlink($path_upload_folder.$path)) {
            return true;
         } else {
            return false;
         }
       }
      
    }
}
