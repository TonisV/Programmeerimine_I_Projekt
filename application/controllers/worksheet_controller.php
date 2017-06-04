<?php
class Worksheet_Controller {

    function index() {
        $worksheet = Worksheet_Model::get_all_rows();
        require_once('application/views/worksheet/index.php');
    }

    function insert() {
        return $job_done = Worksheet_Model::insert_or_update_row();
    }

    function update() {
        return $job_done = Worksheet_Model::insert_or_update_row();
    }

    function delete() {
        $row_id = Request::post('work_id');
        return $job_done = Worksheet_Model::delete_row($row_id);
    }

}
?>