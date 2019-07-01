<?php
class Log extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->library('datatables');
        $this->load->model('log_model');
    }
    function index(){
        $this->load->view('log_view');
    }
    function get_all(){
        header('Content-Type: application/json');
        $data=$this->log_model->get_all_log();
        echo $data;
    }

    function getMinute(){
        $menit=date('i');
        
        $y=0;
        for($i=0;$i<=60;$i++){
            if($y<=60){
                if($y==$menit){
                    echo "siap";
                }

            }
            else{
                break;
            }
            $y=$y+5;
        }
    }
}

?>