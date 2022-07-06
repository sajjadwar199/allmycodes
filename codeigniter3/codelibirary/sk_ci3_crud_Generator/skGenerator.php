 <?php
  /* 
 مثال للاستدعاء 
 <?php
include 'application/libraries/sk_ci3_crud_Generator/skGenerator.php';

class MyCrudGenerator extends  skGenerator
{

  public $table = "doctors";
  public $crudNameEnglish = "AdminDashbord_ManageDoctors";
  public $crudNameArabic = "أدارة الأطباء ";
  public $uploadFilePath="uploads";
  public $feilds = [
  "username" => ["label"=>"اسم المستخدم","type"=>"text"],
    "password" => ["label"=>"كلمة  المرور ","type"=>"password"] ,
    "doctor_name" => ["label"=>"اسم الدكتور ","type"=>"text"],
    "phone_number" =>["label"=>"رقم العيادة","type"=>"number"],
    "address" => ["label"=>"العنوان","type"=>"textarea"],
    "map" => ["label"=>"العنوان على خريطة كوكل","type"=>"text"],
    "cost" =>["label"=>"كلفة الحجز","type"=>"text"] ,
    "Accurate_Specialty" =>["label"=>"تخصص دقيق	","type"=>"text"],
    "general_Specialty" => ["label"=>"تخصص عام	","type"=>"text"],
    "Maximum_visitors" =>["label"=>"اقصى عدد للمراجعين","type"=>"number"] ,
    "gender" => ["label"=>"اقصى عدد للمراجعين","type"=>"select","data"=>["mail","femail",]] ,
      "image" => ["label"=>"الصورة الشخصية","type"=>"image"] ,
      "file" => ["label"=>"الصورة الشخصية","type"=>"file"] ,
       "Accurate_Specialty" =>["label"=>"تخصص دقيق	","type"=>"date"],



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
     

  ];
  public $title = "أدارة معلومات الطبيب";
  public $headerPagePath = "includes/dashbord_header.php";
  public $footerPagePath = "includes/dashbord_footer.php";
  public $idName = "idd";
 
 
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
      "@generate_insert_form",
      "@generate_update_form",
      "@generate_showing_details",
      "@generate_js_showing_details@",
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
      $this->view_data['@idName'] = "" . $this->idName . "";
      $this->view_data['@generate_filter_search'] = $count_filds;
      $this->view_data["@crudNameArabic@"] = $this->crudNameArabic;
      $this->view_data["@generate_table_cols_html@"] = $Feildss_labels;
      $this->view_data["@ControllerName@"] = $this->crudNameEnglish . "Controller";
      $this->view_data["@generate_js_edit_showing_form@"] = $Feildss;
      $genarate_details_view = "view auto genarate by sk_ci3_crud_generator  create at " . date("Y/m/d g:i:s A");
      $this->view_data["@generateTime@"] =  $genarate_details_view;
      $this->view_data['@generate_insert_form'] =  $Feildss;
      $this->view_data['@generate_update_form'] =  $Feildss;
      $this->view_data['@generate_showing_details'] =  $Feildss;
      $this->view_data['@generate_js_showing_details@'] =  $Feildss;

      $this->generate_view($this->crudNameEnglish . "View", $this->view_data);
      //الملفات الاساسية لل datatables links
      
       $projectName = explode('/', $_SERVER['REQUEST_URI'])[1];
       echo '<h1  align="right" style="color:green">  :) تم توليد الكود بنجاح  </h1>';

      $this->copyfolder(dirname(__FILE__).'/assets/','assets/');
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
          case "@generate_insert_form":
            $generate_insert_form = $this->generate_insert_form_view((array)$viewvalue);
            $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar, "$generate_insert_form");
            break;
          case "@generate_update_form":
            $generate_update_form = $this->generate_update_form_view((array)$viewvalue);
            $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar, "$generate_update_form");
            break;
          case "@generate_showing_details":
            $generate_showing_details = $this->generate_showing_details_view((array)$viewvalue);
            $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar, "$generate_showing_details");
            break;
          case "@generate_js_showing_details@":
            $generate_update_form = $this->generate_js_showing_details_view((array)$viewvalue);
            $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar, "$generate_update_form");
            break;
        }
      }
    }


    public function generate_js_showing_details_view($viewvalue)
    {
      $js_showing_details = "
      function(dataResult){
       ";
      foreach ($viewvalue as $key => $value) {
        if ($value == "image") {
          $js_showing_details .=  " $('#" . $key  . "').attr('src',dataResult[0]." . $key . ");" . "\n";
        } else if ($value == "file") {
          $js_showing_details .=  " $('#" . $key  . "').attr('href',dataResult[0]." . $key . ");" . "\n";
          $js_showing_details .=  " $('#" . $key  . "').html(dataResult[0]." . $key . ");" . "\n";
        } else {
          $js_showing_details .=  " $('#" . $key  . "').html(dataResult[0]." . $key . ");" . "\n";
        }
      }
      $js_showing_details .= "}";
      return   $js_showing_details;
    }
    public function generate_showing_details_view($viewvalue)
    {
      $showing_details = "";
      $feild = $this->feilds;
      foreach ($viewvalue as $key => $value) {
        if ($value == "image") {
          $lable = $this->feilds[$key]['label'];

          $showing_details .= "<tr>";
          $showing_details .= "
          <th>$lable</th>
          <th ><img style='max-width:200px;max-height:200px;min-height:200px;min-width:200px;' src='' id='$key' class='img-thumbnail'> </th>
          ";

          $showing_details .= "</tr>";
        } else if ($value == "file") {
          $lable = $this->feilds[$key]['label'];


          $showing_details .= "</tr>";
          $showing_details .= "
          <th>$lable</th>
          <th ><a   target='_blank'  href='' id='$key'></a> </th>
          ";
          $showing_details .= "</tr>";
        } else {
          $lable = $this->feilds[$key]['label'];
          $showing_details .= "<tr>";
          $showing_details .= "
          <th>$lable</th>
          <th id='$key'> </th>
          ";

          $showing_details .= "</tr>";
        }
      }
      return $showing_details;
    }
    public function  generate_js_edit_showing_form_View($viewvalue)
    {
      $_js_edit_showing_form = "
     function(dataResult){
      ";
      foreach ($viewvalue as $key => $value) {
        if ($value == "image" || $value == "file") {
        } else {
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
      if (count($validation_data) == 0) {
        $validation = " return true;";
      } else {
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
      }

      return $validation;
    }
    public function generate_show_data_feilds_controller($show_feilds)
    {
      $show_data_feild = "";
      foreach ($show_feilds as $key => $value) {
        if ($value == 'image') {
          $image = $key;
          $r = '$r->';
          $show_data_feild .= '"';
          $show_data_feild .= "<img  style='max-width:70px;max-height:70px;min-height:70px;min-width:70px;' src=' $r" . $image . "' class='img-thumbnail'/>";
          $show_data_feild .= '",';
        } else if ($value == 'file') {
          $file = $key;
          $file = '$r->' . $file;

          $show_data_feild .= '"';
          $show_data_feild .= "<a   class='   ' href=" . $file . ">$file</a>";
          $show_data_feild .= '",';
        } else {


          $show_data_feild .= '$r->' . $key  . ',' . "\n";
        }
      }
      return   $show_data_feild;
    }
    public function genarate_deletes_files_controller($delete_flds)
    {
      $id = $this->idName;
      $table = $this->table;
      $delete_feilds = "";
      foreach ($delete_flds as $key => $value) {
        if ($value == "image" || $value == "file") {
          $file = $key;
          $delete_feilds .= '$this->delete_file(' .  "'$id'" .  ",'$table'" .  ",'$file'" . ');' . "\n";
        }
      }
      return $delete_feilds;
    }
    public function genarate_insert_feilds_controller($insert_feilds_data)
    {
      $insert_feilds = "";
      $id = $this->idName;
      //اختبار نوع المدخل 
      $flage = 0;
      foreach ($insert_feilds_data as $key => $value) {
        if ($value == "image" || $value == "file") {
          if ($flage == 0) {
            $insert_feilds .= '$flage_file_validation=true;' . "\n";
          }
          $flage += 1;
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
      $table = $this->table;
      //اختبار نوع المدخل 
      foreach ($update_feilds_data as $key => $value) {
        if ($value == "image" || $value == "file") {
        }
        // التأكد من وجود رفع صورة في الجدول
        if ($value == "image") {
          //اذا كان هناك رفع صورة 
          $image = $key;
          $update_feilds .= '$' . "$image" . '=' . '$this->update_file_upload' . '(' .  "'$id'" . ', ' . "'$id'" . ', ' .  "'$table'"  .  ",'$image'" . ',  ' . "'" .  $this->uploadFilePath  . "'" . ', "gif|jpg|png|jpeg|");' . "\n";
        } else if ($value == "file") {
          //اذا كان هناك رفع ملف
          $file = $key;
          $update_feilds .= '$' . "$file" . '=' . '$this->update_file_upload' . '(' .  "'$id'" . ', ' . "'$id'" . ', ' .  "'$table'" .  ",'$file'" . ',  ' . "'" .  $this->uploadFilePath  . "'" . ', "*");' . "\n";
        }
      }
      $update_feilds .= ' $data = array(';
      $idname = $this->idName;
      $flage = 0;
      foreach ($update_feilds_data as $key => $value) {
        if ($flage == 0) {
          $update_feilds .= "'" . $this->idName . "'" . '=> $this->input->post' . '(' . "'$idname'" . '),' . "\n";
        }
        $flage += 1;
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
    public function generate_insert_form_view($viewvalue)
    {
      $insert_form = "";
      foreach ($viewvalue as $key => $value) {
        switch ($value) {
          case "text":
            $insert_form .= "<div class='form-group col-md-4  text-center' >";
            $insert_form .= $this->generate_input_form("insert", $value, $key, $this->feilds[$key]['label']);
            $insert_form .= "</div>";
            break;
          case "number":
            $insert_form .= "<div class='form-group col-md-4  text-center'>";
            $insert_form .= $this->generate_input_form("insert", $value, $key, $this->feilds[$key]['label']);
            $insert_form .= "</div>";
            break;
          case "select":
            $insert_form .= "<div class='form-group col-md-4  text-center'>";
            $insert_form .= $this->generate_input_form("insert", $value, $key, $this->feilds[$key]['label'], $this->feilds[$key]['data']);
            $insert_form .= "</div>";
            break;
          case "textarea":
            $insert_form .= "<div class='form-group col-md-4  text-center'>";
            $insert_form .= $this->generate_input_form("insert", $value, $key, $this->feilds[$key]['label']);
            $insert_form .= "</div>";
            break;
          case "checkbox":
            $insert_form .= "<div class='form-group col-md-4  text-center'>";
            $insert_form .= $this->generate_input_form("insert", $value, $key, $this->feilds[$key]['label']);
            $insert_form .= "</div>";
            break;
          case "file":
            $insert_form .= "<div class='form-group col-md-4  text-center'>";
            $insert_form .= $this->generate_input_form("insert", $value, $key, $this->feilds[$key]['label']);
            $insert_form .= "</div>";
            break;
          case "image":
            $insert_form .= "<div class='form-group col-md-4  text-center'>";
            $insert_form .= $this->generate_input_form("insert", $value, $key, $this->feilds[$key]['label']);
            $insert_form .= "</div>";
            break;
          case "radio":
            $insert_form .= "<div class='form-group col-md-4  text-center'>";
            $insert_form .= $this->generate_input_form("insert", $value, $key, $this->feilds[$key]['label'], $this->feilds[$key]['data']);
            $insert_form .= "</div>";
            break;
          case "date":
            $insert_form .= "<div class='form-group col-md-4  text-center'>";
            $insert_form .= $this->generate_input_form("insert", $value, $key, $this->feilds[$key]['label']);
            $insert_form .= "</div>";
            break;

          default:
            $insert_form .= "<div class='form-group col-md-4  text-center'>";
            $insert_form .= $this->generate_input_form("insert", 'text', $key, $this->feilds[$key]['label']);
            $insert_form .= "</div>";
        }
      }
      return $insert_form;
    }
    public function generate_update_form_view($viewvalue)
    {
      $update_form = "";
      foreach ($viewvalue as $key => $value) {
        switch ($value) {
          case "text":
            $update_form .= "<div class='form-group col-md-4  text-center' >";
            $update_form .= $this->generate_input_form("update", $value, $key, $this->feilds[$key]['label']);
            $update_form .= "</div>";
            break;
          case "number":
            $update_form .= "<div class='form-group col-md-4  text-center'>";
            $update_form .= $this->generate_input_form("update", $value, $key, $this->feilds[$key]['label']);
            $update_form .= "</div>";
            break;
          case "select":
            $update_form .= "<div class='form-group col-md-4  text-center'>";
            $update_form .= $this->generate_input_form("update", $value, $key, $this->feilds[$key]['label'], $this->feilds[$key]['data']);
            $update_form .= "</div>";
            break;
          case "textarea":
            $update_form .= "<div class='form-group col-md-4  text-center'>";
            $update_form .= $this->generate_input_form("update", $value, $key, $this->feilds[$key]['label']);
            $update_form .= "</div>";
            break;
          case "checkbox":
            $update_form .= "<div class='form-group col-md-4  text-center'>";
            $update_form .= $this->generate_input_form("update", $value, $key, $this->feilds[$key]['label']);
            $update_form .= "</div>";
            break;
          case "file":
            $update_form .= "<div class='form-group col-md-4  text-center'>";
            $update_form .= $this->generate_input_form("update", $value, $key, $this->feilds[$key]['label']);
            $update_form .= "</div>";
            break;
          case "image":
            $update_form .= "<div class='form-group col-md-4  text-center'>";
            $update_form .= $this->generate_input_form("update", $value, $key, $this->feilds[$key]['label']);
            $update_form .= "</div>";
            break;
          case "radio":
            $update_form .= "<div class='form-group col-md-4  text-center'>";
            $update_form .= $this->generate_input_form("update", $value, $key, $this->feilds[$key]['label'], $this->feilds[$key]['data']);
            $update_form .= "</div>";
            break;
          case "date":
            $update_form .= "<div class='form-group col-md-4  text-center'>";
            $update_form .= $this->generate_input_form("update", $value, $key, $this->feilds[$key]['label']);
            $update_form .= "</div>";
            break;
          default:
            $update_form .= "<div class='form-group col-md-4  text-center'>";
            $update_form .= $this->generate_input_form("update", 'text', $key, $this->feilds[$key]['label']);
            $update_form .= "</div>";
        }
      }
      return $update_form;
    }
    /* 
     @param $data=array()
     */
    public function generate_input_form($formtype = "insert", $type, $name, $lable, $data = null)
    {
      $inputHtml = "";
      if ($formtype == 'insert') {
        switch ($type) {
          case "text":
            $inputHtml =  "
                   <label for='validationDefault01'>$lable</label><span style='color:red;'>*</span>
                   <input type='text' name ='$name' class='form-control' />
               ";
            break;
          case "date":
            $inputHtml =  "
                     <label for='validationDefault01'>$lable</label><span style='color:red;'>*</span>
                     <input type='date' name ='$name' class='form-control' />
                 ";
            break;
          case "number":
            $inputHtml =  "
              <label for='validationDefault01'>$lable</label><span style='color:red;'>*</span>
              <input type='number' name ='$name' class='form-control' />
           ";
            break;
          case "select":
            $inputHtml .=  "  
          <label for='validationDefault04'>$lable</label><span style='color:red;'>*</span>
          <select  name='$name' class='custom-select' >
          <option selected disabled >اختر خيار من فضلك</option> ";
            //print data
            if ($data != null) {
              foreach ($data as $d) {
                $inputHtml .= "
              <option value='$d'>$d</option>";
              }
              $inputHtml .= " </select>" . "\n";
            }
            break;
          case "textarea":
            $inputHtml =  "
              <label >$lable</label><span style='color:red;'>*</span>
              <textarea  name='$name' class='form-control'  rows='3'></textarea>
            ";
            break;
          case "checkbox":
            $inputHtml =  "<div class='form-check form-check-inline'><span style='color:red;'>*</span>
                  <input class='form-check-input' name='$name' type='checkbox'  value='1'>
                  <label class='form-check-label' for='inlineCheckbox1'>$lable :</label>
                </div>";
            break;
          case "file":
            $inputHtml =  "
            <label  for='customFile'>$lable</label><span style='color:red;'>*</span>
            <input type='file' name='$name' >
                  ";
            break;
          case "image":
            $inputHtml =  " 
              <label for='customFile'>$lable</label><span style='color:red;'>*</span>
              <input type='file' name='$name'   >
            ";
            break;
          case "radio":
            //print data
            $inputHtml .= "<label for='validationDefault01'>$lable :</label><span style='color:red;'>*</span>";
            if ($data != null) {
              $count = 0;
              foreach ($data as $d) {
                $inputHtml .= "
                <div class='custom-control custom-radio custom-control-inline'>
                <input  value='$d' type='radio' id='customRadio$count' name='$name' class='custom-control-input'>
              <label class='custom-control-label' for='customRadio$count'>$d</label>
              </div>
              " . "\n";
                $count += 1;
              }
            }
            break;
          default:
            $inputHtml =  "
                   <label for='validationDefault01'>$lable</label><span style='color:red;'>*</span>
                   <input type='text' name ='$name' class='form-control' />
                  ";
        }
        return $inputHtml;
      } else if ($formtype == 'update') {
        $nameedit = $name . 'edit';
        switch ($type) {
          case "text":
            $inputHtml =  " 
                   <label for='validationDefault01'>$lable</label><span style='color:red;'>*</span>
                   <input type='text' id='$nameedit' name ='$name' class='form-control' />
                 ";
            break;
          case "date":
            $inputHtml =  "
                     <label for='validationDefault01'>$lable</label><span style='color:red;'>*</span>
                     <input type='date' id='$nameedit' name ='$name' class='form-control' />
                 ";
            break;
          case "number":
            $inputHtml =  "
              <label for='validationDefault01'>$lable</label><span style='color:red;'>*</span>
              <input type='number'  id='$nameedit' name ='$name' class='form-control' />
             ";
            break;
          case "select":
            $inputHtml .=  "  
          <label for='validationDefault04'>$lable</label><span style='color:red;'>*</span>
          <select id='$nameedit'  name='$name' class='custom-select' >
          <option selected disabled >اختر خيار من فضلك</option> ";
            //print data
            if ($data != null) {
              foreach ($data as $d) {
                $inputHtml .= "
              <option value='$d'>$d</option>";
              }
              $inputHtml .= " </select>" . "\n";
            }
            break;
          case "file":
            $inputHtml =  " 
            <input type='file' name='$name'   >
            <label  >$lable</label>
          ";
            break;
          case "image":
            $inputHtml =  " 
              <input type='file' name='$name'  >
              <label for='customFile'>$lable</label>
            ";
            break;
          case "textarea":
            $inputHtml =  " 
              <label for='exampleFormControlTextarea1'>$lable</label><span style='color:red;'>*</span>
              <textarea id='$nameedit' class='form-control'  name='$name' rows='3'></textarea>
           ";
            break;
          case "checkbox":
            $inputHtml =  "<div class='form-check form-check-inline'>
                  <input id='$nameedit' class='form-check-input' name='$name' type='checkbox'  value='1'>
                  <label class='form-check-label' for='inlineCheckbox1'>$lable</label><span style='color:red;'>*</span>
                </div>";
            break;
          case "radio":
            //print data
            $inputHtml .= "<label for='validationDefault01'>$lable :</label><span style='color:red;'>*</span>";
            if ($data != null) {
              $count = 0;
              foreach ($data as $d) {
                $inputHtml .= "
                <div class='custom-control custom-radio custom-control-inline'>
                <input  value='$d' type='radio' id='customRadio$count' name='$name' class='custom-control-input'>
              <label class='custom-control-label' for='customRadio$count'>$d</label>
              </div>
              " . "\n";
                $count += 1;
              }
            }
            break;
          default:
            $inputHtml =  " 
                   <label for='validationDefault01'>$lable</label><span style='color:red;'>*</span>
                   <input id='$nameedit' type='text' name ='$name' class='form-control' />
                ";
        }
      }
      return $inputHtml;
    }
   

    // (A) COPY ENTIRE FOLDER
public   function copyfolder ($from, $to, $ext="*") {
  // (A1) SOURCE FOLDER CHECK
  if (!is_dir($from)) { exit("$from does not exist"); }
 
  // (A2) CREATE DESTINATION FOLDER
  if (!is_dir($to)) {
    if (!mkdir($to)) { exit("Failed to create $to"); };
    echo "$to created\r\n";
  }
 
  // (A3) GET ALL FILES + FOLDERS IN SOURCE
  $all = glob("$from$ext", GLOB_MARK);
  print_r($all);
 
  // (A4) COPY FILES + RECURSIVE INTERNAL FOLDERS
  if (count($all)>0) { foreach ($all as $a) {
    $ff = basename($a); // CURRENT FILE/FOLDER
    if (is_dir($a)) {
      $this->copyfolder("$from$ff/", "$to$ff/");
    } else {
      if (!copy($a, "$to$ff")) { exit("Error copying $a to $to$ff"); }
      echo "$a copied to $to$ff\r\n";
    }
  }}
}
 
// (B) GO!
  };
