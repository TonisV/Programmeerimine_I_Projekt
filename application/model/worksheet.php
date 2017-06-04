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


    // Update or insert new row in worksheet table
    public static function insert_or_update_row() {

        $row = array(
            'work_id'          => self::validate_data(Request::post('work_id')),
            'client_name'      => self::validate_data(Request::post('client_name')),
            'client_phone'     => self::validate_data(Request::post('client_phone')),
            'client_email'     => self::validate_data(Request::post('client_email')),
            'work_device'      => self::validate_data(Request::post('work_device')),
            'work_description' => self::validate_data(Request::post('work_description')),
            'work_report'      => self::validate_data(Request::post('work_report')),
            'work_price'       => self::validate_data(Request::post('work_price')),
            'work_invoice'     => self::validate_data(Request::post('work_invoice')),
            'work_status'      => self::validate_data(Request::post('work_status'))
        );

        $validation_result = self::validate_row_data($row);

        if (!$validation_result) {
            return false;
        } else {
            if ($row['work_id'] == NULL) {
                return self::insert_row($row) ? true : false;
            } else {
                return self::update_row($row) ? true : false;
            }
        }
    }


    // Insert row into worksheet table
    public static function insert_row($row) {
        $db = Db::get_instance();

        $query = $db->prepare(
            'INSERT INTO ws_worksheet (
                client_name,
                client_phone,
                client_email,
                work_device,
                work_description,
                work_check_in
             )
             VALUES (
                :client_name,
                :client_phone,
                :client_email,
                :work_device,
                :work_description,
                :work_check_in
            )'
        );

        $query->execute(
            array(
                ':client_name'      => $row['client_name'],
                ':client_phone'     => $row['client_phone'],
                ':client_email'     => $row['client_email'],
                ':work_device'      => $row['work_device'],
                ':work_description' => $row['work_description'],
                ':work_check_in'    => time()
            )
        );

        $count = $query->rowCount();

        return $count == 1 ? true : false;
    }


    // Update row in worksheet table
    public static function update_row($row) {
        $db = Db::get_instance();

        $query = $db->prepare(
            'UPDATE ws_worksheet SET 
                client_name = :client_name,
                client_phone = :client_phone,
                client_email = :client_email,
                work_device = :work_device,
                work_description = :work_description,
                work_report = :work_report,
                work_price = :work_price,
                work_invoice = :work_invoice,
                work_check_out = :work_check_out,
                work_status = :work_status
             WHERE work_id = :work_id'
        );

        $query->execute(
            array(
                ':client_name'      => $row['client_name'],
                ':client_phone'     => $row['client_phone'],
                ':client_email'     => $row['client_email'],
                ':work_device'      => $row['work_device'],
                ':work_description' => $row['work_description'],
                ':work_report'      => $row['work_report'],
                ':work_price'       => $row['work_price'],
                ':work_invoice'     => $row['work_invoice'],
                ':work_check_out'   => $row['work_check_out'],
                ':work_status'      => $row['work_status'],

            )
        );

        $count = $query->rowCount();

        return $count == 1 ? true : false;
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
    static function validate_row_data($row) {

        foreach ($row as $key => $value) {
            if (!preg_match("/^[.,@()+0-9ÖÄÜÕöäüõA-Za-z\\- \']+$/",$value)) {
                return false;
            }
        }
        return true;
    }


    // Return data as NULL if it is empty
    static function validate_data($data) {
        if ($data == '') {
            return $data = NULL;
        }
        return $data;
    }

}
?>