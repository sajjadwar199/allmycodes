<?php


include  'application/libraries/skLogin.php';
class DoctorDashbordLogin extends CI_Controller
{

    public function index()
    {
        if (@isset($this->session->userdata['ok_LoginDoctorDash']) and @$this->session->userdata['ok_LoginDoctorDash'] != "") {
            redirect('DoctorBookingDashbord');
        } else {
        }
        $this->load->view('DoctorDashbord/login.php');
    }

    function __construct()
    {
        if (@isset($this->session->userdata['ok_LoginDoctorDash']) and @$this->session->userdata['ok_LoginDoctorDash'] != "") {
            redirect('DoctorBookingDashbord');
        } else {
        }
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library("form_validation");
        $this->load->library("session");

        $this->load->database();
        // print_r($this->session->userdata['ok_LoginDoctorDash']);
        // print_r($this->session->userdata);
    }

    public function login()
    {
        if (@isset($this->session->userdata['ok_LoginDoctorDash']) and @$this->session->userdata['ok_LoginDoctorDash'] != "") {
            redirect('DoctorBookingDashbord');
        } else {
        }
        $this->form_validation->set_rules('username', 'اسم المستخدم', 'required');
        $this->form_validation->set_rules('password', 'كلمة المرور', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('DoctorDashbord/login.php');
        } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->db->get_where('doctors', ['username' => $username, "password" => $password])->row();

            if (!$user) {
                $this->session->set_flashdata('error', '<div class="alert alert-warning">هناك خطأ في اسم المستخدم او كلمة المرور</div>', 300);
                redirect(uri_string());
            }
               
            if($this->db->get_where('doctors', ['username' => $username, "password" => $password,"account_state"=>2])->row()){
                //اذا كان الحساب معطل
                $this->session->set_flashdata('error', '<div class="alert alert-warning">الحساب الخاص بك معطل يرجى مراسلة ادارة الموقع لتفعيل حسابك</div>', 300);
                redirect(uri_string());
            }
            
            $data = array(
                'doctor_name' => $user->doctor_name,
				'username' => $user->username,

                'idd' => $user->idd,
                "image" => $user->image,            );


            $this->session->set_userdata("ok_LoginDoctorDash", $data);

            //redirect('/'); // redirect to home
            // echo 'Login success!';
            redirect('DoctorBookingDashLogin');

            exit;
        }
    }

    public function logout()
    {
        // if(@isset($this->session->userdata['ok_LoginDoctorDash']) and @$this->session->userdata['ok_LoginDoctorDash']!="" ){
        //     redirect('DoctorBookingDashbord');
        //  }else{

        //  }
        unset($_SESSION['ok_LoginDoctorDash']);
        redirect('DoctorBookingDashLogin');
    }
}
