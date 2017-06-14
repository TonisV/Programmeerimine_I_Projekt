<div class="container">
    <h2>Tööleht</h2>
    <table class="work-table">
        <thead>
            <tr>
                <th>Töö nr.</th>
                <th>Nimi</th>
                <th>Telefon</th>
                <th>Email</th>
                <th>Seadmed</th>
                <th>Vead</th>
                <th>Tööd</th>
                <th>Hind</th>
                <th>Arve</th>
                <th>Vastuvõetud</th>
                <th>Väljastatud</th>
                <th>Hetkeseis</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($worksheet) { foreach ($worksheet as $key => $row) {
            $status = array('', 'waiting', 'notified', 'paid');
            $status_class = $status[$row->work_status-1];
            ?>
            <tr id="row-<?= $row->work_id; ?>" class="work-table-row">
                <td><?= $row->work_id; ?></td>
                <td class="client_name"><input name="client_name" type="text" value="<?= $row->client_name; ?>" disabled /></td>
                <td><input name="client_phone" type="text" value="<?= $row->client_phone; ?>" disabled /></td>
                <td><input name="client_email" type="text" value="<?= $row->client_email; ?>" disabled /></td>
                <td><input name="work_device" type="text" value="<?= $row->work_device; ?>" disabled /></td>
                <td><input name="work_description" type="text" value="<?= $row->work_description; ?>" disabled /></td>
                <td><input name="work_report" type="text" value="<?= $row->work_report; ?>" disabled /></td>
                <td><input name="work_price" type="number" value="<?= $row->work_price; ?>" disabled /></td>
                <td><input name="work_invoice" type="number" value="<?= $row->work_invoice; ?>" disabled /></td>
                <td><?= $row->work_check_in; ?></td>
                <td class="work-check-out"><?= $row->work_check_out; ?></td>
                <td class="select-cell">
                    <select name="work_status" class="row-select <?= $status_class; ?>" <?= (($row->work_status == 4) ? 'disabled' : ''); ?>>
                        <option value="1" <?= (($row->work_status == 1) ? 'selected' : ''); ?>>Vastuvõetud</option>
                        <option value="2" <?= (($row->work_status == 2) ? 'selected' : ''); ?>>Ootel</option>
                        <option value="3" <?= (($row->work_status == 3) ? 'selected' : ''); ?>>Teavitatud</option>
                        <option value="4" <?= (($row->work_status == 4) ? 'selected' : ''); ?>>Makstud ja üleantud</option>
                    </select>
                </td>
            </tr>
        <?php } }?>
        </tbody>
        <tfoot>
            <tr id="last-row">
                <td>#</td>
                <td><input name="client_name"  type="text" placeholder=" - " /></td>
                <td><input name="client_phone"  type="text" placeholder=" - " /></td>
                <td><input name="client_email"  type="text" placeholder=" - " /></td>
                <td><input name="work_device"  type="text" placeholder=" - " /></td>
                <td><input name="work_description"  type="text" placeholder=" - " /></td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td class="select-cell">
                    <select name="work_status" id="last-row-select">
                        <option value="1"> - </option>
                        <option value="2">Vastuvõetud</option>
                    </select>
                </td>
            </tr>
        </tfoot>
    </table>
</div>