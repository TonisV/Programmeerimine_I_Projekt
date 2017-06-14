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

        if ($job_done == 'success' && Request::post('work_status') == '4') {
            $work_id = Request::post('work_id');
            $work_check_out = Worksheet_Model::get_work_check_out($work_id);
            echo $work_check_out;
        } else {
            echo  $job_done;
        }
    }

    function delete() {
        $row_id = Request::post('work_id');
        $delete_message = Request::post('client_name');

        if ($delete_message === 'DELETE ROW') {

            $job_done = Worksheet_Model::delete_row($row_id);
            if ($job_done) {
                echo 'success';
            } else {
                echo 'error : delete';
            }

        } else {
            echo 'error : message';
        }
    }

}
?>