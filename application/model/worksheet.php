<?php
class Worksheet_Model {

    // Worksheet parameters
    public $work_id;
    public $client_name;
    public $client_phone;
    public $client_email;
    public $work_device;
    public $work_description;
    public $work_report;
    public $work_price;
    public $work_invoice;
    public $work_check_in;
    public $work_check_out;
    public $work_status;

    public function __construct(
        $work_id,
        $client_name,
        $client_phone,
        $client_email,
        $work_device,
        $work_description,
        $work_report,
        $work_price,
        $work_invoice,
        $work_check_in,
        $work_check_out,
        $work_status
    ) {
        $this->work_id          = $work_id;
        $this->client_name      = $client_name;
        $this->client_phone     = $client_phone;
        $this->client_email     = $client_email;
        $this->work_device      = $work_device;
        $this->work_description = $work_description;
        $this->work_report      = $work_report;
        $this->work_price       = $work_price;
        $this->work_invoice     = $work_invoice;
        $this->work_check_in    = $work_check_in;
        $this->work_check_out   = $work_check_out;
        $this->work_status      = $work_status;
    }


    // Get all rows from worksheet table
    public static function get_all_rows() {
        $worksheet = [];

        $db = Db::get_instance();
        $query = $db->query('SELECT * FROM ws_worksheet');
        $result = $query->fetchAll();

        foreach ($result as $key => $row) {
            $worksheet[] = new Worksheet_Model(
                $row['work_id'],
                $row['client_name'],
                $row['client_phone'],
                $row['client_email'],
                $row['work_device'],
                $row['work_description'],
                $row['work_report'],
                $row['work_price'],
                $row['work_invoice'],
                $row['work_check_in'],
                $row['work_check_out'],
                $row['work_status']

            );
        }
        return $worksheet;
    }

    // Get last row from worksheet table
    public static function get_last_row() {
        $worksheet = [];

        $db = Db::get_instance();
        $query = $db->query('SELECT * FROM ws_worksheet ORDER BY work_id DESC LIMIT 1');
        $result = $query->fetchAll();

        foreach ($result as $key => $row) {
            $worksheet[] = new Worksheet_Model(
                $row['work_id'],
                $row['client_name'],
                $row['client_phone'],
                $row['client_email'],
                $row['work_device'],
                $row['work_description'],
                $row['work_report'],
                $row['work_price'],
                $row['work_invoice'],
                $row['work_check_in'],
                $row['work_check_out'],
                $row['work_status']
            );
        }
        return $worksheet;
    }


    // Insert new row in worksheet table and handles errors
    public static function insert_new_row() {

        $row = array(
            'client_name'      => Request::post('client_name'),
            'client_phone'     => Request::post('client_phone'),
            'client_email'     => Request::post('client_email'),
            'work_device'      => Request::post('work_device'),
            'work_description' => Request::post('work_description'),
        );

        $validation_result = self::validate_row_data($row);

        if ($validation_result) {
            return 'error : validation';
        } else {
            return self::insert_row($row) ? 'success' : 'error : insert';
        }
    }


    // Insert row into worksheet table
    private static function insert_row($row) {
        $db = Db::get_instance();

        $query = $db->prepare(
            'INSERT INTO ws_worksheet (
                client_name,
                client_phone,
                client_email,
                work_device,
                work_description
             )
             VALUES (
                :client_name,
                :client_phone,
                :client_email,
                :work_device,
                :work_description
            )'
        );

        $query->execute(
            array(
                ':client_name'      => $row['client_name'],
                ':client_phone'     => $row['client_phone'],
                ':client_email'     => $row['client_email'],
                ':work_device'      => $row['work_device'],
                ':work_description' => $row['work_description']
            )
        );

        $count = $query->rowCount();

        return $count == 1 ? true : false;
    }


    // Updates row cell in worksheet table and handles errors
    public static function update_row_cell() {

        $cell = request::postArray();

        $validation_result = self::validate_cell_data($cell);

        if ($validation_result) {
            return 'error : validation';
        } else {
            $cell_data = [];
            $keys = array_keys($cell);
            $key = $keys[1];

            $cell_data['cell_id'] = intval($cell['work_id']);
            $cell_data['cell_name'] = $key;
            $cell_data['cell_value'] = $cell[$key];

            return self::update_cell($cell_data) ? 'success' : 'error : update';
        }
    }

    // Update cell in worksheet table
    private static function update_cell($cell) {

        $cell_name =  $cell['cell_name'];

        $valid_fields = Array(
            'client_name',
            'client_phone',
            'client_email',
            'work_device',
            'work_description',
            'work_report',
            'work_price',
            'work_invoice',
            'work_status'
        );

        if (in_array($cell_name, $valid_fields)) {

            $db = Db::get_instance();

            $query = $db->prepare('UPDATE ws_worksheet SET '.$cell_name.' = :cell_value WHERE work_id = :cell_id');

            $query_done = $query->execute(
                array(
                    ':cell_id' => $cell['cell_id'],
                    ':cell_value' => $cell['cell_value']
                )
            );

            return $query_done ? true : false;
        }

        return false;
    }


    // Delete row in worksheet table
    public static function delete_row($id) {
        $db = Db::get_instance();

        $query = $db->prepare('DELETE FROM ws_worksheet WHERE work_id = :id');
        $query->execute(array(':id' => $id));

        $count = $query->rowCount();

        return $count == 1 ? true : false;
    }


    // Check row for not allowed characters
    private static function validate_row_data($row) {

        foreach ($row as $key => $value) {
            if ($key == 'client_phone' && empty($value)) {
                return true;
            }
            if(!empty($value)) {
                if (!preg_match("/^[.,_%&$+@0-9ÖÄÜÕöäüõA-Za-z\\- \']+$/", $value)) {
                    return true;
                }
            }
        }

        return false;
    }


    // Validate cell data
    private static function validate_cell_data($cell) {

        foreach ($cell as $key => $value) {
            if (($key == 'work_id' && empty($value)) || ($key == 'work_id' && !is_numeric($value))) {
                return true;
            }
            if(!empty($value)) {
                if (strlen($value) > 300 ) {
                    return true;
                }
                if (($key == 'work_price' || $key == 'work_invoice' || $key == 'work_status') && !is_numeric($value)) {
                    return true;
                }
                if (!preg_match("/^[.,_%&$+@0-9ÖÄÜÕöäüõA-Za-z\\- \']+$/", $value)) {
                    return true;
                }
            }
        }

        return false;
    }

}
?>