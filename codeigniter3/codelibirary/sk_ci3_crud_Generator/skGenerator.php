  
<?php
 /* 
 مثال للاستدعاء 
 <?php
include 'application/libraries/sk_ci3_crud_Generator/skGenerator.php';

class MyGenerator extends  skGenerator
{

  public $table="categories";  
  public $crudNameEnglish="new";
  public $crudNameArabic="الاصناف ";
  public $feilds=["name"=>"الاسم"];
  public $validation=["name" => "required|string"];
  public $title="  sajjad crud  generator ";
  public $headerPagePath="template/header.php";  
  public $footerPagePath="template/footer.php";  
  public $idName="id";  
 
 
}
 
 
 */
/**
 * Ganarator crud Pages     كلاس لتوليد صفحات  crud والكتابة بها
 * class by sajjad kareem 
 *@auther 

 */
class  skGenerator  extends CI_Controller
{

  public $table = "sajjadCrud";
  public $crudNameEnglish = "sajjadCrud";
  public $feilds = ["name" => "الأسم", "age" => "العمر"];
  public $validation = ["name" => "required|string", "lable" => "اسم المستخدم"];
  public $title = "ادارة الاصناف";
  public $headerPagePath = "template/header.php";
  public $footerPagePath = "template/footer.php";
  public $idName = "id";
  public $crudNameArabic = "الموضفين";

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
    "@title",
    "@headerpagePath",
    "@viewpagePath",
    "@footerpagePath",
    "@generateTime"

  ];

  public $view_data = [
    "@ControllerName@",
    "@crudNameArabic@",
    "@generate_table_cols_html@",
    "@generate_js_edit_showing_form@",
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
      $Feildss[] = $key;
    }
    $this->controller_data["@generate_show_data_feilds"] = $Feildss;
    $this->controller_data["@genarate_insert_feilds"] = $Feildss;
    $this->controller_data["@genarate_update_feilds"] = $Feildss;

    $this->controller_data["@ModelClassName"] = $this->crudNameEnglish . "Model";
    $this->controller_data["@title"] = "ادارة";
    $this->controller_data["@headerpagePath"] = $this->headerPagePath;
    $this->controller_data["@viewpagePath"] = $this->crudNameEnglish . "View.php";
    $this->controller_data["@footerpagePath"] = $this->footerPagePath;
    $genarate_details = "controller auto genarate by sk_ci3_crud_generator  create at " . date("Y/m/d g:i:s A");
    $this->controller_data['@generateTime'] = $genarate_details;
    $this->generate_Controller($this->crudNameEnglish . "Controller", $this->controller_data);

    //generate view
    $Feildss_Arabic = [];
    foreach ($this->feilds as $key => $val) {
      $Feildss_Arabic[] = $val;
    }

    
    $this->view_data["@crudNameArabic@"] =$this->crudNameArabic;
    $this->view_data["@generate_table_cols_html@"] =$Feildss_Arabic;
    $this->view_data["@ControllerName@"] = $this->crudNameEnglish."Controller";
    $this->view_data["@generate_js_edit_showing_form@"] = $Feildss;
    $genarate_details_view = "view auto genarate by sk_ci3_crud_generator  create at " . date("Y/m/d g:i:s A");
    $this->view_data["@generateTime@"] =  $genarate_details_view;

    $this->generate_view($this->crudNameEnglish."View", $this->view_data);
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
          $html_table_cols="";
          $html_table_cols = $this->generate_table_cols_html_View((array)$viewvalue);
          $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar,"$html_table_cols");
          break;
        case "@generate_js_edit_showing_form@":
          $_js_edit_showing_form ="";
          $_js_edit_showing_form = $this->generate_js_edit_showing_form_View((array)$viewvalue);
          $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar,"$_js_edit_showing_form");
          break;
          case "@crudNameArabic@":
          $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar,"$viewvalue");
          break;
          case "@ControllerName@":
            $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar,"$viewvalue");
            break;
            case "@generateTime@":
              $this->update_codes_Ganarators_pages("application/views/$view_name.php", $viewVar,"$viewvalue");
              break;
            
    }
  }

  }


  public function  generate_js_edit_showing_form_View($viewvalue)
  {
    $_js_edit_showing_form = "
    function(dataResult){
    ";
    foreach ($viewvalue as $valus) {
      $_js_edit_showing_form .=  " $('#" . $valus  . "edit').val(dataResult[0]." . $valus . ");" . "\n";
    }
    $_js_edit_showing_form .= "}";
    return   $_js_edit_showing_form;
  }
  public function generate_table_cols_html_View($viewvalue)
  {
    $html_table_cols = "";
    foreach ($viewvalue as $valus) {
      $html_table_cols .= "<td>" . $valus . "</td>";
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
      $validation.="array(" ;

      $validation .= "'field' =>" . "'$key'" . "," . "\n";
      $validation .= "'rules' =>"  . "'$value'" . "," . "\n";

      $validation .= "'errors' => array(
        'required' => 'الرجاء ملء حقل %s.',
        ),)," ."\n";
    }
    $validation .= " );";

    return $validation;
  }

  public function generate_show_data_feilds_controller($show_feilds)
  {

    $show_data_feild = "";
    foreach ($show_feilds as $feilds) {
      $show_data_feild .= '$r->' . $feilds  . ',' . "\n";
    }
    return   $show_data_feild;
  }

  public function genarate_insert_feilds_controller($insert_feilds_data)
  {
    $insert_feilds = "";
    foreach ($insert_feilds_data as $feilds) {
      if ($feilds == "date") {
        $insert_feilds .= "      " . "'date'" . '=>  '   . "date('Y/m/d')" . ',' . "\n";
      } else {
        $insert_feilds .= "      " . "'$feilds'" . '=> $this->input->post' . '(' . "'$feilds'" . '),' . "\n";
      }
    }

    return $insert_feilds;
  }

  public function genarate_update_feilds_controller($update_feilds_data)
  {
    $update_feilds = "";
    foreach ($update_feilds_data as $feilds) {
      if ($feilds == "date") {
        $update_feilds .=  "      " . "'date'" . '=>  '   . "date('Y/m/d')" . ',' . "\n";
      } else {
        $update_feilds .= "      " . "'$feilds'" . '=> $this->input->post' . '(' . "'$feilds'" . '),' . "\n";
      }
    }

    return $update_feilds;
  }
};
