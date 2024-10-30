<div class="modal-body">
    <form id="frmEditActivity">
        <input type="hidden" name="start_date" id="start_date">
        <input type="hidden" name="end_date" id="end_date">
        <div class="row">
            <div class="col-6">
                <label for="name"><?= lang('backend.name-activity') ?></label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $activity['name'] ?>">
            </div>
            <div class="col-6">
                <label for="category_id"><?= lang('backend.category') ?></label>
                <select class="form-select" name="category_id" id="category_id">
                    <option value="0" selected><?= lang('backend.category') ?></option>
                    <?php foreach ($categorys as $cat) {
                        $selected = ($activity['category_id'] == $cat['id']) ? 'selected' : '';
                        echo '<option value="' . $cat['id'] . '" ' . $selected . '>' . $cat['name_th'] . '</option>';
                    } ?>
                </select>
            </div>
            <div class="col-6 mt-3">
                <label for="address"><?= lang('backend.address-activity') ?></label>
                <input type="text" class="form-control" id="address" name="address" value="<?= $activity['address'] ?>">
            </div>
            <div class="col-6 mt-3">
                <label for="price"><?= lang('backend.price') ?></label>
                <input type="text" class="form-control" id="price" name="price" value="<?= $activity['price'] ?>">
            </div>
            <div class="col-12 mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type_total" id="limited" value="limited"
                        <?= $activity['type_total'] == 'limited' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="limited"><?= lang('backend.limited') ?></label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type_total" id="unlimited" value="unlimited"
                        <?= $activity['type_total'] == 'unlimited' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="unlimited"><?= lang('backend.unlimited') ?></label>
                </div>
            </div>
            <div class="col-12 mt-3" id="num_total">
                <label for="total_number"><?= lang('backend.total_number') ?></label>
                <input type="text" class="form-control" id="total_number" name="total_number"
                    value="<?= $activity['total_number'] ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>
            <div class="col-6 mt-3">
                <label for="image"><?= lang('backend.image') ?></label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="col-6 mt-3">
                <label for="datetimes"><?= lang('backend.period-activity') ?></label>
                <input type="text" class="form-control" id="datetimes" name="datetimes" value="<?= date('d/m/Y H:i', strtotime($activity['start_datetime'])) . ' - ' .
                    date('d/m/Y H:i', strtotime($activity['end_datetime'])) ?>">
            </div>
            <div class="col-12 mt-3">
                <label for="details"><?= lang('backend.details-activity') ?></label>
                <textarea name="details" class="form-control" id="details"
                    rows="4"><?= $activity['details'] ?></textarea>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?= lang('backend.cancel') ?></button>
    <button type="button" onclick="btnEditActivity('<?= $activity['uuid'] ?>')"
        class="btn btn-warning"><?= lang('backend.seve-edit') ?></button>
</div>

<script>
    $(document).ready(function () {

        // ตรวจสอบสถานะตอนเริ่มต้น
        if ($('#limited').prop('checked')) {
            $('#num_total').show();
        } else {
            $('#num_total').hide();
        }

        // ตั้งค่า event handler
        $('#limited').on('change', function () {
            $('#num_total').show();
        });

        $('#unlimited').on('change', function () {
            $('#num_total').hide();
        });


        var start_date = moment('<?= $activity['start_date_formatted'] ?>');
        var end_date = moment('<?= $activity['end_date_formatted'] ?>');
        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm',
                separator: ' - ',
                applyLabel: 'ยืนยัน',
                cancelLabel: 'ยกเลิก',
                fromLabel: 'จาก',
                toLabel: 'ถึง',
                daysOfWeek: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                monthNames: [
                    'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
                    'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
                ]
            }
        }, function (start, end, label) {
            $('#start_date').val(start.format('YYYY-MM-DD HH:mm:ss'));
            $('#end_date').val(end.format('YYYY-MM-DD HH:mm:ss'));
        });
    })


    function btnEditActivity(uuid) {
        let form = $('#frmEditActivity');

        let form_data = new FormData(form[0]);
        // let image = $('#image')[0].files[0];
        // form_data.append('image', image);

        $.ajax({
            url: `${asset_url}backend/editActivity/${uuid}`,
            type: 'POST',
            processData: false,
            contentType: false,
            data: form_data,
            headers: {
                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: '<?= lang('backend.notification') ?>',
                        html: data.message
                    }).then(function () {
                        window.location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: '<?= lang('backend.notification') ?>',
                        html: data.message
                    })
                }
            }
        })
    }
</script>