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

            <tr id="row-1" class="work-table-row">
                <td>0001</td>
                <td><input name="client_name" type="text" value="Test Test" disabled /></td>
                <td><input name="client_phone" type="text" value="580 00000" disabled /></td>
                <td><input name="client_email" type="text" value="test@test.ee" disabled /></td>
                <td><input name="job_equipment" type="text" value="Sülearvuti Lenovo T420 + laadija" disabled /></td>
                <td><input name="job_problem" type="text" value="Ei lae viirused, pahavara" disabled /></td>
                <td><input name="job_work" type="text" value="Tehtud hooldus" disabled /></td>
                <td><input name="job_price" type="number" value="65.00" disabled /></td>
                <td><input name="job_invoice" type="number" value="2555" disabled /></td>
                <td>04.05.2017 10:50</td>
                <td> - </td>
                <td>
                    <select name="job_status">
                        <option value="1">Vastuvõetud</option>
                        <option value="2">Ootel</option>
                        <option value="3">Teavitatud</option>
                        <option value="4">Makstud ja üleantud</option>
                    </select>
                </td>
            </tr>

            <tr id="row-2" class="work-table-row">
                <td>0002</td>
                <td><input name="client_name" type="text" value="Test Test" disabled /></td>
                <td><input name="client_phone" type="text" value="580 00000" disabled /></td>
                <td><input name="client_email" type="text" value="test@test.ee" disabled /></td>
                <td><input name="job_equipment" type="text" value="Sülearvuti Lenovo T420 + laadija" disabled /></td>
                <td><input name="job_problem" type="text" value="Ei lae viirused, pahavara" disabled /></td>
                <td><input name="job_work" type="text" value="Tehtud hooldus" disabled /></td>
                <td><input name="job_price" type="number" value="65.00" disabled /></td>
                <td><input name="job_invoice" type="number" value="2555" disabled /></td>
                <td>04.05.2017 10:50</td>
                <td> - </td>
                <td>
                    <select name="job_status">
                        <option value="1">Vastuvõetud</option>
                        <option value="2">Ootel</option>
                        <option value="3">Teavitatud</option>
                        <option value="4">Makstud ja üleantud</option>
                    </select>
                </td>
            </tr>

            <tr id="row-3" class="work-table-row">
                <td>0003</td>
                <td><input name="client_name" type="text" value="Test Test" disabled /></td>
                <td><input name="client_phone" type="text" value="580 00000" disabled /></td>
                <td><input name="client_email" type="text" value="test@test.ee" disabled /></td>
                <td><input name="job_equipment" type="text" value="Sülearvuti Lenovo T420 + laadija" disabled /></td>
                <td><input name="job_problem" type="text" value="Ei lae viirused, pahavara" disabled /></td>
                <td><input name="job_work" type="text" value="Tehtud hooldus" disabled /></td>
                <td><input name="job_price" type="number" value="65.00" disabled /></td>
                <td><input name="job_invoice" type="number" value="2555" disabled /></td>
                <td>04.05.2017 10:50</td>
                <td> - </td>
                <td>
                    <select name="job_status">
                        <option value="1">Vastuvõetud</option>
                        <option value="2">Ootel</option>
                        <option value="3">Teavitatud</option>
                        <option value="4">Makstud ja üleantud</option>
                    </select>
                </td>
            </tr>

        </tbody>
        <tfoot>
            <tr id="last_row">
                <td>0004</td>
                <td><input name="client_name"  type="text" placeholder=" - " /></td>
                <td><input name="client_phone"  type="text" placeholder=" - " /></td>
                <td><input name="client_email"  type="text" placeholder=" - " /></td>
                <td><input name="job_equipment"  type="text" placeholder=" - " /></td>
                <td><input name="job_problem"  type="text" placeholder=" - " /></td>
                <td><input name="job_work"  type="text" placeholder=" - " /></td>
                <td><input name="job_price"  type="number" placeholder="00.00" /></td>
                <td><input name="job_invoice"  type="number" placeholder="0" /></td>
                <td> - </td>
                <td> - </td>
                <td>
                    <select name="job_status" id="last_row_select">
                        <option value="1"> - </option>
                        <option value="2">Vastuvõetud</option>
                    </select>
                </td>
            </tr>
        </tfoot>
    </table>
</div>