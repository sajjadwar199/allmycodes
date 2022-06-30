<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *  controller auto genarate by sk_ci3_crud_generator
 *    create crud with modalBootstrap and ajax
 * @package skLibiraris
 * @author sajjadkareem 
 * @category modalAjaxCrud
 * 
 * 
 */
class skCrudModalAjax  extends CI_Controller
{
    public   $ModelClassName = "manageUsersModel";

    //لعمل فحص للمدخلات
    public   function set_validation(){
       return   array(
            array(
                'field' => 'username',
                'label' => 'أسم المستخدم ',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'الرجاء ملء حقل %s.',
                ),
            ),
            array(
                'field' => 'password',
                'label' => ' كلمة المرور ',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'الرجاء ملء حقل %s.',
                ),
            ),
            array(
                'field' => 'validity',
                'label' => ' الصلاحية ',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'الرجاء أختيار   %s.',
                ),
            )
        );
    }
  
    //لعمل عرض البيانات 
    public function set_show_data($r)
    {
        return  array(
            $r->username,
            $r->password,
            $r->validity,
            "<a      class='btn btn-success update_btn' id=" . $r->id .  ">تعديل</a>",
            "<a  class='btn btn-danger delete_btn' id=" .  $r->id . ">حذف</a>",
        );
    }
    //لعمل مدخلات المرسلة للتحديث
    public function set_update_post()
    {
        return  array(
            "id" => $this->input->post("id"),
            "username" => $this->input->post("username"),
            "password" => $this->input->post("password"),
            "validity" => $this->input->post("validity")
        );
    }
    //لعمل مدخلات المرسلة للاضافة
    public function set_insert_post()
    {
        return  array(
            "username" => $this->input->post("username"),
            "password" => $this->input->post("password"),
            "validity" => $this->input->post("validity")
        );
    }

    public function index()
    {
        // $this->load->view("dashbord_inc/header.php");
        // $this->load->view("pages/importExcel.php");
        // $this->load->view("dashbord_inc/footer.php");
    }

    /* setting end *******************************************8 */
    public function __construct()
    {
        parent::__construct();
        // import model 
        $this->load->model($this->ModelClassName, "ModelName");
        $this->load->library('form_validation');
         $this->load->helper('form');
         $this->load->library("upload");

    }
  
    /**
     * insert لأضافة البيانات 
     *
     * @return void
     */
    public function insert()
    {
        // set data
        $data = $this->set_insert_post();
        //validation 
        $this->form_validation->set_rules($this->set_validation());
        if ($this->form_validation->run() != false and $data !=false  ) {
             // insert 
                  
             $res = $this->ModelName->insert($data);
             if ($res) {
                 header('Content-Type: application/json');
                 echo json_encode(['status' => "success"]);
             } 
           
         }else { 
             // http_response_code(412);
             header('Content-Type: application/json');
             echo validation_errors();
         //   echo json_encode(['status' => "error"]);
         }
    }
    /**
     * edit    لعرض العنصر المراد تعديله
     *
     * @param  mixed $id
     * @return void
     * 
     * 
     * 
     */
    public function edit()
    {
        $id = $this->input->post("id");
        $data = $this->ModelName->get_where($id);
        echo json_encode($data);
    }
    /**
     * update  لتعديل البيانات
     *
     * @return void
     */
    public function update()
    {
        $data = $this->set_update_post();
        $this->form_validation->set_rules($this->set_validation());

        if ($this->form_validation->run() != false) {

        $res = $this->ModelName->update($data);
        if ($res) {
            header('Content-Type: application/json');
            echo json_encode(['status' => "success"]);
        }
        }else {
        //     http_response_code(412);
        //    header('Content-Type: application/json');
        //    echo json_encode(['status' => "error"]);
        header('Content-Type: application/json');

        echo validation_errors();
       }
        // json_encode($res);
        // echo $this->input->post("id");
    }
    /**
     * delete لحذف البيانات
     *
     * @param  mixed $id
     * @return void
     */
    public function delete()
    {
        $id = $this->input->post("id");
        $delet = $this->ModelName->delete($id);
        if($delet){
            header('Content-Type: application/json');
            echo json_encode(['status' => "success"]);
        }else{
            http_response_code(412);
            header('Content-Type: application/json');

            echo json_encode(['status' => "error"]);

        }
    }
    /**
     * show لعرض البيانات 
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $show =  $this->ModelName->get_where($id);
        json_encode($show);
    }
    public  function set_show_data_ajax()
    {
        $model = new $this->ModelName;
        $model_data = $model->get_data();
        $data = array();
        foreach ($model_data as $r) {
            $data[] = $this->set_show_data($r);
        }
        return $data;
    }
    /**
     * List لعرض البيانات وتحويلها الى json
     *
     * @return void
     */
    public function List()
    {
        // Datatables Variables
        $model = new $this->ModelName;
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $model->get_count(),
            "recordsFiltered" => $model->get_count(),
            "data" => $this->set_show_data_ajax()
        );
        echo json_encode($output);
        exit();
        $data = $this->ModelName->get_data();
        json_encode($data);
    }





 /**
         * uploadfile  دالة لرفع الملفات من form
         * 
         * @param  mixed $post_input_name ex..  <input type="file" name="website_photo"/> =>  website_photo
         * @param  mixed $upload_path    مسار رفع الملف 
         * @param  mixed $allowtypes  الصيغ المسموحة
         * @param  mixed $action   الحدث اذا كان للتعديل او الاضافة  ex.. insert ,update 
         * @return void
         */
        public function uploadfile($action = "insert", $id = null, $post_input_name = "website_photo", $upload_path = "./uploads/websites_photos/", $allowtypes = 'gif|jpg|png|jpeg|',$error_message="هناك خطأ في رفع الصورة الرجاء التأكد من الملف أذا كان صورة وبلحجم المسموح")
        {
                //insert 
                if ($action == 'insert') {
                        // print_r($_FILES);
                        $config['upload_path']          = $upload_path;
                        $config['allowed_types']        = $allowtypes;
                        $config['encrypt_name']        = TRUE;
                        $config['remove_spaces']        = TRUE;
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload($post_input_name)) {
                                //في حالة وجود خطأ في رفع الملف
                                $error = array('error' => $this->upload->display_errors());
                                  echo $error['error'];
                                //  echo $error_message;
                                return false;
                        } else {
                                 return $this->upload->data('file_name');;
                        }
                } else if ($action == 'update') {
                        //update 
                        if (isset($_FILES) and $_FILES[$post_input_name]['name'] != '') {
                                //اذا تم ارسال ملف 
                                // print_r($_FILES);
                                $config['upload_path']          = $upload_path;
                                $config['allowed_types']        = $allowtypes;
                                $config['encrypt_name']        = TRUE;
                                $config['remove_spaces']        = TRUE;
                                $this->upload->initialize($config);
                                if (!$this->upload->do_upload($post_input_name)) {
                                        //في حالة وجود خطأ في رفع الملف
                                        $error = array('error' => $this->upload->display_errors());
                                        
                                        echo $error['error'];
                                        // echo $error_message;
                                } else {
                                        print_r($this->upload->data());
                                        return $this->upload->data('file_name');
                                }
                        } else {
                                //اذا لم يرسل  ملف 
                                echo $error_message;
                                return false;
                        }
                }
        }


}
