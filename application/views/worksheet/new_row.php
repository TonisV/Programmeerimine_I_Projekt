<?php if ($new_rows) { foreach ($new_rows as $key => $row) { ?>
    <tr id="row-<?= $row->work_id; ?>" class="work-table-row">
        <td><?= $row->work_id; ?></td>
        <td><input name="client_name" type="text" value="<?= $row->client_name; ?>" disabled /></td>
        <td><input name="client_phone" type="text" value="<?= $row->client_phone; ?>" disabled /></td>
        <td><input name="client_email" type="text" value="<?= $row->client_email; ?>" disabled /></td>
        <td><input name="work_device" type="text" value="<?= $row->work_device; ?>" disabled /></td>
        <td><input name="work_description" type="text" value="<?= $row->work_description; ?>" disabled /></td>
        <td><input name="work_report" type="text" value="<?= $row->work_report; ?>" disabled /></td>
        <td><input name="work_price" type="number" value="<?= $row->work_price; ?>" disabled /></td>
        <td><input name="work_invoice" type="number" value="<?= $row->work_invoice; ?>" disabled /></td>
        <td><?= $row->work_check_in; ?></td>
        <td><?= $row->work_check_out; ?></td>
        <td>
            <select name="work_status">
                <option value="1" <?= (($row->work_status == 1) ? 'selected' : ''); ?>>Vastuvõetud</option>
                <option value="2" <?= (($row->work_status == 2) ? 'selected' : ''); ?>>Ootel</option>
                <option value="3" <?= (($row->work_status == 3) ? 'selected' : ''); ?>>Teavitatud</option>
                <option value="4" <?= (($row->work_status == 4) ? 'selected' : ''); ?>>Makstud ja üleantud</option>
            </select>
        </td>
    </tr>
<?php
    }
}
?>