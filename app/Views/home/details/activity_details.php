<?= $this->extend('front/template_home') ?>

<?= $this->section('content') ?>
<?php

$start_date = new DateTime($activity['start_datetime'], new DateTimeZone('UTC'));
$start_date->setTimezone(new DateTimeZone('Asia/Bangkok'));

$end_date = new DateTime($activity['end_datetime'], new DateTimeZone('UTC'));
$end_date->setTimezone(new DAteTimeZone('Asia/Bangkok'));


$priceText = !empty($activity['price']) ? number_format($activity['price']) . ' บาท' : '0 บาท';
?>
<section style="min-height: 80vh;">
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
                    <div class="col-6 fs-5 mt-4"><?= $start_date->format('H:i d/m/Y') ?></div>

                    <div class="col-6 text-green fs-4 mt-4">เวลาหมดกิจกรรม</div>
                    <div class="col-6 fs-5 mt-4"><?= $end_date->format('H:i d/m/Y') ?></div>
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
                <div class="d-flex justify-content-end align-items-center my-3">
                    <button id="decrementButton" class="btn fs-2">-</button>
                    <span id="counter" class="fs-4 mx-1">1</span>
                    <button id="incrementButton" class="btn fs-2">+</button>
                </div>

                <button type="button" id="bookingButton" class="btn btn-green-gradient fs-5">จองกิจกรรม</button>
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

    let count = 1;

    $(document).ready(function () {
        $("#incrementButton").click(function () {
            count += 1;
            $("#counter").text(count);
            updateButtons();
        });

        $("#decrementButton").click(function () {
            if (count > 1) {
                count -= 1;
                $("#counter").text(count);
                updateButtons();
            }
        });

        function updateButtons() {
            $("#decrementButton").prop("disabled", count === 1);
        }

        $("#bookingButton").click(function () {
            const user_id = '<?= USER_ID ?>';
            const activity_id = '<?= $activity['id'] ?>';
            openCheckActivity(user_id, activity_id, count);
        });

        updateButtons();
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
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
                },
                dataType: 'json',
                success: function (data) {
                    if (data.status == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: '<?= lang('home.notification') ?>',
                            text: data.message
                        }).then(function () {
                            window.location.href = `${asset_url}bookingActivity`
                        });
                    } else {
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