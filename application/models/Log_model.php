<?php

class Log_model extends CI_Model{

    function get_all_log(){
        $this->datatables->select('id,nomer_aju,keterangan,kondisi');
        //$this->db->order_by("id", "desc"); 
        $this->datatables->from('log');
        return $this->datatables->generate();

    }

}

?>