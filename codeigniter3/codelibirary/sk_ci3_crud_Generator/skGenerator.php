 <?php
  /* 
 مثال للاستدعاء 
 <?php
include 'application/libraries/sk_ci3_crud_Generator/skGenerator.php';

class MyGenerator extends  skGenerator
{

  public $table = "doctors";
  public $crudNameEnglish = "AdminDashbord_ManageDoctors";
  public $crudNameArabic = "أدارة الأطباء ";
  public $uploadFilePath="application/uploads";
    public $feilds = [
    "username" => ["lable"=>"اسم المستخدم","type"=>"text"],
    "password" => ["lable"=>"كلمة  المرور ","type"=>"password"] ,
    "doctor_name" => ["lable"=>"اسم الدكتور ","type"=>"text"],
    "phone_number" =>["lable"=>"رقم العيادة","type"=>"number"],
    "address" => ["lable"=>"العنوان","type"=>"textarea"],
    "map" => ["lable"=>"العنوان على خريطة كوكل","type"=>"text"],
    "cost" =>["lable"=>"كلفة الحجز","type"=>"text"] ,
    "Accurate_Specialty" =>["lable"=>"تخصص دقيق	","type"=>"text"],
    "general_Specialty" => ["lable"=>"تخصص عام	","type"=>"text"],
    "Maximum_visitors" =>["lable"=>"اقصى عدد للمراجعين","type"=>"number"] ,
    "gender" => ["lable"=>"اقصى عدد للمراجعين","type"=>"select","data"=>["ذكر","انثى"]] ,
    "image" => ["lable"=>"الصورة الشخصية","type"=>"select"] ,

  ];
  public $validation = [
    "username" => "required",
    "password" => "required",
    "doctor_name" => "required",
    "phone_number" => "required",
    "address" => "required",
    "map" => "required",
    "cost" => "required",
    "Accurate_Specialty" => "required",
    "general_Specialty" => "required",
    "Maximum_visitors" => "required",
    "gender" => "required",
    "image" => "required",

  ];
  public $title = "أدارة معلومات الطبيب";
  public $headerPagePath = "includes/dashbord_header.php";
  public $footerPagePath = "includes/dashbord_footer.php";
  public $idName = "id";
 
 
}
 
 
 */
  /**
   * Ganarator crud Pages     كلاس لتوليد صفحات  crud والكتابة بها
   * class by sajjad kareem 
   *@auther 

   */
  class  skGenerator  extends CI_Controller
  {

    public $table = "doctors";
    public $crudNameEnglish = "AdminDashbord_ManageDoctors";
    public $crudNameArabic = "أدارة الأطباء ";
    public $uploadFilePath = "application/uploads";
    public $feilds = [
      "username" => ["lable" => "اسم المستخدم", "type" => "text"],
    ];
    public $validation = [
      "username" => "required|namaric",

    ];
    public $title = "أدارة معلومات الطبيب";
    public $headerPagePath = "includes/dashbord_header.php";
    public $footerPagePath = "includes/dashbord_footer.php";
    public $idName = "id";


    public $model_data = [
      "@table",
      "@modelName",
      "@idName",
      "@controllerName",
      "@updateFeilds",
      "@deleteMsg",
      "@generateTime"
    ];

    public $controller_data = [
      "@controllerName",
      "@genarate_validation",
      "@generate_show_data_feilds",
      "@genarate_insert_feilds",
      "@genarate_update_feilds",
      "@ModelClassName",
      "@genarate_deletes_files",
      "@title",
      "@headerpagePath",
      "@viewpagePath",
      "@footerpagePath",
      "@generateTime",
      "@idName"
    ];

    public $view_data = [
      "@idName",
      "@ControllerName@",
      "@crudNameArabic@",
      "@generate_table_cols_html@",
      "@generate_js_edit_showing_form@",
      "@generate_filter_search",
      "@generateTime@",

    ];

    public  $Ganarators_pages_paths = [
      "Genarate_view" => "application/libraries/sk_ci3_crud_Generator/MvcPages/Genarate_view.txt",
      "Genarate_model" => "application/libraries/sk_ci3_crud_Generator/MvcPages/Genarate_model.txt",
      "Genarate_controller" => "application/libraries/sk_ci3_crud_Generator/MvcPages/Genarate_controller.txt",
      "Genarate_skCrudModalAjax_core" => "application/libraries/sk_ci3_crud_Generator/core/skCrudModalAjax.php",
      "Genarate_skCrudModel_core" => "application/libraries/sk_ci3_crud_Generator/core/skCrudModel.php",
      "Genarate_js_crud_core" => "application/libraries/sk_ci3_crud_Generator/core/sk_js_crud_modal.php",

    ];



    public function index()
    {
      //generate core files
      $this->generate_core_files();

      //generate model  
      $this->model_data["@table"] = "'" . $this->table . "'";
      $this->model_data["@modelName"] = $this->crudNameEnglish . "Model";
      $this->model_data["@idName"] = "'" . $this->idName . "'";
      $this->model_data["@controllerName"] = "'" . $this->crudNameEnglish . 'Controller' . "'";
      $updateFeilds = "";
      foreach ($this->feilds as $key => $val) {
        $updateFeilds .= "'$key'" . '=>' . "'$key'" . ',';
      }

      $this->model_data["@updateFeilds"] = "[$updateFeilds]";
      $genarate_details = "model auto genarate by sk_ci3_crud_generator  create at " . date("Y/m/d g:i:s A");
      $this->model_data['@generateTime'] = $genarate_details;
      $this->generate_Model($this->crudNameEnglish . "Model", $this->model_data);

      //generate controller
      $this->controller_data["@controllerName"] = $this->crudNameEnglish . "Controller ";
      $this->controller_data["@genarate_validation"] = $this->validation;
      $Feildss = [];
      foreach ($this->feilds as $key => $val) {
        $Feildss[$key] = $val['type'];
      }
      $this->controller_data["@generate_show_data_feilds"] = $Feildss;
      $this->controller_data["@genarate_insert_feilds"] = $Feildss;
      $this->controller_data["@genarate_update_feilds"] = $Feildss;
      $this->controller_data["@genarate_deletes_files"] = $Feildss;

      $this->controller_data["@ModelClassName"] = $this->crudNameEnglish . "Model";
      $this->controller_data["@title"] =  $this->title;
      $this->controller_data["@idName"] = $this->idName;
      $this->controller_data["@headerpagePath"] = $this->headerPagePath;
      $this->controller_data["@viewpagePath"] = $this->crudNameEnglish . "View.php";
      $this->controller_data["@footerpagePath"] = $this->footerPagePath;
      $genarate_details = "controller auto genarate by sk_ci3_crud_generator  create at " . date("Y/m/d g:i:s A");
      $this->controller_data['@generateTime'] = $genarate_details;
      $this->generate_Controller($this->crudNameEnglish . "Controller", $this->controller_data);

      //generate view
      $Feildss_Arabic = [];
      $count_filds = "";
      foreach ($this->feilds as $key => $val) {

        $Feildss_labels[] = $val['label'];
        $count_filds .= "<th></th>";
      }
      $this->view_data['@idName']="" . $this->idName . "";
      $this->view_data['@generate_filter_search'] = $count_filds;
      $this->view_data["@crudNameArabic@"] = $this->crudNameArabic;
      $this->view_data["@generate_table_cols_html@"] = $Feildss_labels;
      $this->view_data["@ControllerName@"] = $this->crudNameEnglish . "Controller";
      $this->view_data["@generate_js_edit_showing_form@"] = $Feildss;
      $genarate_details_view = "view auto genarate by sk_ci3_crud_generator  create at " . date("Y/m/d g:i:s A");
      $this->view_data["@generateTime@"] =  $genarate_details_view;

      $this->generate_view($this->crudNameEnglish . "View", $this->view_data);
    }


    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Method get_codes_from_Ganarators_pages لاخذ الاكواد من صفحة 
     *  @param $filePath رابط الملف لاخذ الكود منه 
     *
     *  
     */
    protected function get_codes_from_Ganarators_pages($filePath)
    {
      return  file_get_contents($filePath);
    }


    /**
     * Method generate_page لتوليد صفحة والكتابة بها 
     *
     * @param $pageNamePath  اسم الصفحة ex   employscontroller.php
     *  $file_codes_Path  امتداد االملف لنسخ الكود منه
     *
     *  
     */
    public function generate_page($pageNamePath, $file_codes_Path)
    {
      $open = fopen($pageNamePath, "w");
      fwrite($open, $this->get_codes_from_Ganarators_pages($file_codes_Path));
      fclose($open);
    }



    /**
     * Method update_codes_Ganarators_pages
     *
     * @param $fileNamePath   رابط الملف لجلب الكود منه
     * @param $selected_word     الكلمة المراد البحث عنها لكتابة محتوى بدلها
     * @param $newContent     كود المحتوى الجديد
     *
     * @return void
     */
    public function update_codes_Ganarators_pages($fileNamePath, $selected_word, $newContent)
    {
      file_put_contents($fileNamePath, str_replace($selected_word, $newContent, file_get_contents($fileNamePath)));
    }

    public function generate_Model($model_name, $model_data = array())
    {
      //create model class
      $this->generate_page("application/models/$model_name.php", $this->Ganarators_pages_paths["Genarate_model"]);
      //update code in model file
      foreach ($model_data as $modelVar  => $modelvalue) {
        $this->update_codes_Ganarators_pages("application/models/$model_name.php", $modelVar, "$modelvalue");
      }
    }

    /**
     * Method generate_Controller لتوليد كونترولير
     *
     * @param $controller_name   
     * @param $controller_data  
     *
     * @return void
     */
    public function generate_Controller($controller_name, $controller_data = array())
    {
      //create controller class
      $this->generate_page("application/controllers/$controller_name.php", $this->Ganarators_pages_paths["Genarate_controller"]);

      //update code in controller data
      foreach ($controller_data as $controllerVar  => $controllervalue) {
        switch ($controllerVar) {
          case "@genarate_validation":
            $validation =  $this->generate_validation_controller((array)$controllervalue);
            $this->update_codes_Ganarators_pages("application/controllers/$controller_name.php", $controllerVar, "$validation");
            break;

          case "@generate_show_data_feilds":
            $show_feilds = $this->generate_show_data_feilds_controller($controllervalue);
            $this->update_codes_Ganarators_pages("application/controllers/$controller_name.php", $controllerVar, " $show_feilds");
            break;
          case "@genarate_insert_feilds":
            $insert_feilds = $this->genarate_insert_feilds_controller($controllervalue);
            $this->update_codes_Ganarators_pages("application/controllers/$controller_name.php", $controllerVar, " $insert_feilds");
            break;
          case "@genarate_update_feilds":
            $update_feilds = $this->genarate_update_feilds_controller($controllervalue);
            $this->update_codes_Ganarators_pages("application/controllers/$controller_name.php", $controllerVar, " $update_feilds");
            break;
            case "@genarate_deletes_files";
            $genarate_deletes_files = $this->genarate_deletes_files_controller($controllervalue);
            $this->update_codes_Ganarators_pages("application/controllers/$controller_name.php", $controllerVar, " $genarate_deletes_files");

            break;
          default:
            $this->update_codes_Ganarators_pages("application/controllers/$controller_name.php", $controllerVar, "$controllervalue");
        }
      }
    }
    // لتوليد  صفحة العرض   
    public function generate_View($view_name, $view_data = array())
    {
      //create view page
      $this->generate_page("application/views/$view_name.php", $this->Ganarators_pages_paths["Genarate_view"]);
      //update code in view file

      foreach ($view_data as $viewVar  => $viewvalue) {
        switch ($viewVar) {
          case "@generate_table_cols_html@":
            $html_table_cols = "";
            $html_table_cols = $this->generate_table_cols_html_View((array)$viewvalue);
            $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar, "$html_table_cols");
            break;
          case "@generate_js_edit_showing_form@":
            $_js_edit_showing_form = "";
            $_js_edit_showing_form = $this->generate_js_edit_showing_form_View((array)$viewvalue);
            $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar, "$_js_edit_showing_form");
            break;
          case "@crudNameArabic@":
            $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar, "$viewvalue");
            break;
          case "@ControllerName@":
            $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar, "$viewvalue");
            break;
          case "@generateTime@":
            $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar, "$viewvalue");
            break;
          case "@generate_filter_search":
            $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar, "$viewvalue");
            break;
            case "@idName":
              $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar, $viewvalue);
              break;
        }
      }
    }


    public function  generate_js_edit_showing_form_View($viewvalue)
    {
      $_js_edit_showing_form = "
    function(dataResult){
    ";
    foreach ($viewvalue as $key => $value) {    
      if($value=="image"|| $value=="file") {
      }else{
        $_js_edit_showing_form .=  " $('#" . $key  . "edit').val(dataResult[0]." . $key . ");" . "\n";
      }
      }
      $_js_edit_showing_form .= "}";
      return   $_js_edit_showing_form;
    }
    public function generate_table_cols_html_View($viewvalue)
    {
      $html_table_cols = "";
      foreach ($viewvalue as $valus) {
        $html_table_cols .= "<th>" . $valus . "</th>";
      }

      return  $html_table_cols;
    }
    /* لتوليد الملفات الرئيسية واضافتها الى libirars */
    public function  generate_core_files()
    {
      if (!file_exists('application/libraries/sk_generator_core_files/')) {
        mkdir('application/libraries/sk_generator_core_files', 0777, true);
      }

      //generate model core file in libararies
      $this->generate_page("application/libraries/sk_generator_core_files/skCrudModalAjax.php", $this->Ganarators_pages_paths["Genarate_skCrudModalAjax_core"]);
      //generate model core file in libararies
      $this->generate_page("application/libraries/sk_generator_core_files/skCrudModel.php", $this->Ganarators_pages_paths["Genarate_skCrudModel_core"]);
      //generate js crud core file in libararies
      $this->generate_page("application/libraries/sk_generator_core_files/sk_js_crud.php", $this->Ganarators_pages_paths["Genarate_js_crud_core"]);
    }



    public function generate_validation_controller($validation_data)
    {
      $validation = " return array(";

      foreach ($validation_data as $key => $value) {
        $validation .= "array(";

        $validation .= "'field' =>" . "'$key'" . "," . "\n";
        $validation .= "'rules' =>"  . "'$value'" . "," . "\n";
        //جلب اسم الحقل بلعربي 
        @$lable = $this->feilds[$key]['label'];
        $validation .= "'label' =>"  . "'$lable'" . "," . "\n";
        $validation .= "'errors' => array(
        'required' => 'الرجاء ملء حقل %s.',
        ),)," . "\n";
      }

      $validation .= " );";

      return $validation;
    }

    public function generate_show_data_feilds_controller($show_feilds)
    {

      $show_data_feild = "";
      foreach ($show_feilds as $key => $value) {
        $show_data_feild .= '$r->' . $key  . ',' . "\n";
      }
      return   $show_data_feild;
    }


    public function genarate_deletes_files_controller($delete_flds){
      $id = $this->idName;
      $table=$this->table;
      $delete_feilds="";
       foreach($delete_flds as $key => $value){
        if ($value == "image" || $value == "file") {
          $file=$key;
          $delete_feilds.='$this->delete_file('.  "'$id'" .  ",'$table'" .  ",'$file'" .');' . "\n";
         
        }
       }
       return $delete_feilds;
    }
    public function genarate_insert_feilds_controller($insert_feilds_data)
    {
      $insert_feilds = "";
      $id = $this->idName;
      //اختبار نوع المدخل 
      foreach ($insert_feilds_data as $key => $value) {

        if ($value == "image" || $value == "file") {

          $insert_feilds .= '$flage_file_validation=true;' . "\n";
         }
        // if ($value == "image"||$value == "file") {
        //   $insert_feilds.='if (isset($_FILES) and !empty($_FILES)) {';
        // }

        // التأكد من وجود رفع صورة في الجدول
        if ($value == "image") {
          //اذا كان هناك رفع صورة 
          $image = $key;

          // $insert_feilds.='if(isset($_FILES)'. 'and !empty($_FILES'.'['. "'$image'" .']'.'["name"])){';

          $insert_feilds .= '$' . "$image" . 'path=' . '$this->uploadfile' . '("insert",' .  "'$id'" . ', ' .  "'$image'" . ',  ' . "'" .  $this->uploadFilePath  . "'" . ', "gif|jpg|png|jpeg|");' . "\n";
          $insert_feilds .= " if($" . $image . 'path!==false){' . "\n";
          $insert_feilds .= '$' . "$image" . '=';
          $insert_feilds .= '$' . "$image" . 'path' . ';' . "\n" . '}' . "\n" . 'else{
            $flage_file_validation=false;
         }' . "\n" . "\n";
          // $insert_feilds.='}';

        } else if ($value == "file") {
          //اذا كان هناك رفع ملف
          $file = $key;
          // $insert_feilds.='if(isset($_FILES)'. 'and !empty($_FILES'.'['. "'$file'" .']'.'["name"])){';

          $insert_feilds .= '$' . "$file" . 'path=' . '$this->uploadfile' . '("insert",' .  "'$id'" . ', ' .  "'$file'" . ',  ' . "'" .  $this->uploadFilePath  . "'" . ', "*");' . "\n";
          $insert_feilds .= " if($" . $file . 'path!==false){' . "\n";
          $insert_feilds .= '$' . "$file" . '=';
          $insert_feilds .= '$' . "$file" . 'path' . ';' . "\n" . '}' . "\n" . 'else{
            $flage_file_validation=false;
         }' . "\n" . "\n";
           // $insert_feilds.='}'."\n" ;

        }
      }

      if ($value == "image" || $value == "file") {
        $insert_feilds .= ' if($flage_file_validation==true){' . "\n";
      }
      $insert_feilds .= ' $data = array(';

      foreach ($insert_feilds_data as $key => $value) {
        if ($key == "date") {
          $insert_feilds .= "      " . "'date'" . '=>  '   . "date('Y/m/d')" . ',' . "\n";
        } else if ($value == "image") {
          $insert_feilds .= "      " . "'$key'" . '=>  ' . '@$' . "$key"  . ',' . "\n";
        } else if ($value == "file") {
          $insert_feilds .= "      " . "'$key'" . '=>  ' . '@$' . "$key"  . ',' . "\n";
        } else {
          $insert_feilds .= "      " . "'$key'" . '=> $this->input->post' . '(' . "'$key'" . '),' . "\n";
        }
      }
      $insert_feilds .= " );" . "\n";

      $insert_feilds .= 'return $data;';
      if ($value == "image" || $value == "file") {
        $insert_feilds .= '}' . "\n";
      }

      return $insert_feilds;
    }

    public function genarate_update_feilds_controller($update_feilds_data)
    {

      $update_feilds = "";
      $id = $this->idName;
      $table=$this->table;
      //اختبار نوع المدخل 
      foreach ($update_feilds_data as $key => $value) {

        if ($value == "image" || $value == "file") {

         }
 
        // التأكد من وجود رفع صورة في الجدول
        if ($value == "image") {
          //اذا كان هناك رفع صورة 
          $image = $key;

 
          $update_feilds .= '$' . "$image" .'=' . '$this->update_file_upload' . '('.  "'$id'" . ', ' . "'$id'" . ', ' .  "'$table'"  .  ",'$image'" . ',  ' . "'" .  $this->uploadFilePath  . "'" . ', "gif|jpg|png|jpeg|");' . "\n";
   

        } else if ($value == "file") {
          //اذا كان هناك رفع ملف
          $file = $key;
 
          $update_feilds .= '$' . "$file" . '=' . '$this->update_file_upload' . '('.  "'$id'" . ', ' . "'$id'" . ', ' .  "'$table'" .  ",'$file'" . ',  ' . "'" .  $this->uploadFilePath  . "'" . ', "*");' . "\n";
         
        }
      }

     
      $update_feilds .= ' $data = array(';
      $idname=$this->idName;
      $flage=0;
      foreach ($update_feilds_data as $key => $value) {
        if($flage==0){
          $update_feilds .="'" .$this->idName ."'". '=> $this->input->post' . '(' . "'$idname'" . '),' . "\n";

        }
        $flage+=1;
        if ($key == "date") {
          $update_feilds .= "      " . "'date'" . '=>  '   . "date('Y/m/d')" . ',' . "\n";
        } else if ($value == "image") {
          $update_feilds .= "      " . "'$key'" . '=>  ' . '@$' . "$key"  . ',' . "\n";
        } else if ($value == "file") {
          $update_feilds .= "      " . "'$key'" . '=>  ' . '@$' . "$key"  . ',' . "\n";
        } else {
          $update_feilds .= "      " . "'$key'" . '=> $this->input->post' . '(' . "'$key'" . '),' . "\n";
        }
      }
      $update_feilds .= " );" . "\n";

      $update_feilds .= 'return $data;' . "\n";
 

      return $update_feilds;
    }
  };
