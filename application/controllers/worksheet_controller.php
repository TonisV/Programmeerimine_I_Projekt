<?php
class Worksheet_Controller {

    function index() {
        $worksheet = Worksheet_Model::get_all_rows();
        require_once('application/views/worksheet/index.php');
    }

    function insert() {
        $job_done = Worksheet_Model::insert_new_row();

        if ($job_done == 'success') {
            $new_rows = Worksheet_Model::get_last_row();
            require_once('application/views/worksheet/new_row.php');
        } else {
            echo  $job_done;
        }
    }

    function update() {
        $job_done = Worksheet_Model::update_row_cell();
        echo  $job_done;
    }

    function delete() {
        $row_id = Request::post('work_id');
        $job_done = Worksheet_Model::delete_row($row_id);

    }

}
?>