<?= $this->extend('front/template_home') ?>

<?= $this->section('content') ?>
<?php

$start_date = new DateTime($activity['start_datetime'], new DateTimeZone('UTC'));
$start_date->setTimezone(new DateTimeZone('Asia/Bangkok'));

$end_date = new DateTime($activity['end_datetime'], new DateTimeZone('UTC'));
$end_date->setTimezone(new DAteTimeZone('Asia/Bangkok'));

?>
<section style="min-height: 80vh;">
    <div class="container">
        <div class="row bg-white border shadow p-4 mt-5">

            <div class="col-7">
                <div class="row">
                    <div class="col-6 fs-2"><?= $activity['name'] ?></div>
                    <div class="col-6 fs-2 text-end text-danger"><?= number_format($activity['price']) . ' บาท' ?></div>

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
                <button type="button" onclick="openCheckActivity('<?= USER_ID ?>','<?= $activity['id'] ?>')"
                    class="btn btn-green-gradient fs-5">จองกิจกรรม</button>
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

    function openCheckActivity(user_id, activity_id) {

        if (user_id == '') {
            $('#profileModal').modal('show');
        } else {
            $.ajax({
                url: `${asset_url}confirmBooking/${user_id}/${activity_id}`,
                type: 'POST',
                data: {
                    user_id: user_id,
                    activity_id: activity_id,
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
                            window.location.href= `${asset_url}bookingActivity`
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