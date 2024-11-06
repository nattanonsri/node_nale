<?= $this->extend('front/template_home') ?>

<?= $this->section('content') ?>
<?php

$start_date = date('H:i d/m/Y', strtotime($activity['start_datetime']));
$end_date = date('H:i d/m/Y', strtotime($activity['end_datetime']));

$priceText = !empty($activity['price']) ? number_format($activity['price']) . ' บาท' : '0 บาท';
?>
<section id="activityDetail" style="min-height: 80vh;">
    <div class="container">
        <div class="row bg-white border shadow p-4 mt-5">

            <div class="col-7">
                <div class="row">
                    <div class="col-6 fs-2"><?= $activity['name'] ?></div>
                    <div class="col-6 fs-2 text-end text-danger"><?= $priceText ?></div>

                    <div class="col-12 text-start fs-5 mt-4"><?= $activity['details'] ?></div>

                    <div class="col-12 text-green fs-4 mt-3">ที่อยู่ </div>
                    <div class="col-12 fs-5 mt-3"><?= $activity['address'] ?></div>

                    <div class="col-6 text-green fs-4 mt-4">เวลาเริ่มกิจกรรม</div>
                    <div class="col-6 fs-5 mt-4"><?= $start_date ?></div>

                    <div class="col-6 text-green fs-4 mt-4">เวลาหมดกิจกรรม</div>
                    <div class="col-6 fs-5 mt-4"><?= $end_date ?></div>
                </div>
            </div>
            <div class="col-5 text-end">
                <div class="fs-4 mt-3">
                    <?php
                    if (!empty($activity['type_total'])) {
                        if ($activity['type_total'] == 'unlimited') {
                            echo lang('home.unlimited');
                        } else {
                            echo $items . '/' . $activity['total_number'];
                        }
                    }
                    ?>
                </div>
                <div class="mt-3 fs-5">จำนวนคน</div>
                <div class="d-flex justify-content-end align-items-center my-3">
                    <button id="decrementButton" class="btn fs-2">-</button>
                    <span id="counter" class="fs-4 mx-1">1</span>
                    <button id="incrementButton" class="btn fs-2">+</button>
                </div>

                <div class="my-2 d-grid justify-content-end" style="grid-template-columns: max-content;">
                    <input type="text" class="form-control" id="datetimes" name="datetimes">
                </div>
                <input type="hidden" name="start_date" id="start_date">
                <input type="hidden" name="end_date" id="end_date">

                <button type="button" id="bookingButton" class="btn btn-green-gradient fs-5">จองกิจกรรม</button>

                <div id="loader"
                    style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 9999;">
                    <div class="spinner" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>

            <div class="col-12 text-center mt-5">
                <img src="<?= asset_url($activity['image']) ?>" style="width:30%">
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-5">
            <div class="modal-header pb-0 border-0">
                <span class="modal-title">&nbsp;</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0 text-center">
                <div class="pt-5 pb-2 fs-3">
                    กรุณาล็อกอินก่อนจองกิจกรรม
                </div>
                <div class="py-5">
                    <a href="<?= asset_url('login') ?>"
                        class="btn btn-green-gradient py-2 px-4 fs-4 rounded-5">ล็อกอิน</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    let items = <?= isset($items) ? $items : 0 ?>;
    let maxLimit = <?= isset($activity['total_number']) && $activity['total_number'] > 0 ? $activity['total_number'] : 'Infinity' ?>;
    let maxCount = maxLimit === Infinity ? Infinity : maxLimit - items;
    let count = 1;

    $(document).ready(function () {

        function updateCounter() {
            $("#counter").text(count);
            $("#decrementButton").prop("disabled", count === 1);
            $("#incrementButton").prop("disabled", count >= maxCount || count >= maxLimit);
        }

        updateCounter();

        $("#incrementButton").click(function () {
            if (count < maxCount && (count + items) < maxLimit) {
                count += 1;
                updateCounter();
            }
        });

        $("#decrementButton").click(function () {
            if (count > 1) {
                count -= 1;
                updateCounter();
            }
        });

        console.log("Current booked items:", items);
        console.log("Maximum allowed count:", maxLimit);
        console.log("Max count based on limit and booked items:", maxCount);

        $("#bookingButton").click(function () {
            const user_id = '<?= USER_ID ?>';
            const activity_id = '<?= $activity['id'] ?>';
            openCheckActivity(user_id, activity_id, count);
        });


        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            startDate: moment('<?= date('Y-m-d H:i:s', strtotime($activity['start_datetime'])) ?>'),
            endDate: moment('<?= date('Y-m-d H:i:s', strtotime($activity['end_datetime'])) ?>'),
            minDate: moment('<?= date('Y-m-d H:i:s', strtotime($activity['start_datetime'])) ?>'),
            maxDate: moment('<?= date('Y-m-d H:i:s', strtotime($activity['end_datetime'])) ?>'),
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
            },
            isInvalidDate: function (date) {
                return date.isBefore(moment('<?= date('Y-m-d H:i:s', strtotime($activity['start_datetime'])) ?>')) ||
                    date.isAfter(moment('<?= date('Y-m-d H:i:s', strtotime($activity['end_datetime'])) ?>'));
            }
        }, function (start, end, label) {
            $('#start_date').val(start.format('YYYY-MM-DD HH:mm:ss'));
            $('#end_date').val(end.format('YYYY-MM-DD HH:mm:ss'));
        });

    });
    function openCheckActivity(user_id, activity_id, count) {

        if (user_id == '') {
            $('#profileModal').modal('show');
        } else {
            $.ajax({
                url: `${asset_url}confirmBooking/${user_id}/${activity_id}/${count}`,
                type: 'POST',
                data: {
                    user_id: user_id,
                    activity_id: activity_id,
                    count: count,
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val(),
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                },
                dataType: 'json',
                beforeSend: function () {
                    $('#bookingButton').attr('disabled', true);
                    $('#loader').show();
                },
                success: function (data) {
                    if (data.status == 200) {
                        $('#loader').hide();
                        Swal.fire({
                            icon: 'success',
                            title: '<?= lang('home.notification') ?>',
                            text: data.message
                        }).then(function () {
                            window.location.href = `${asset_url}bookingActivity#shopping`
                        });
                    } else {
                        $('#loader').hide();
                        Swal.fire({
                            icon: 'warning',
                            title: '<?= lang('home.notification') ?>',
                            text: data.message
                        })
                    }
                }

            })
        }
    }

</script>
<?= $this->endSection() ?>