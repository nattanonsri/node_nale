<?= $this->extend('front/template_home') ?>

<?= $this->section('content') ?>

<section style="min-height: 80vh;">
    <div class="container">
        <div class="row bg-white border rounded-4 shadow-lg p-5 my-5" style="min-height: 80vh;">
            <div class="col-12 border-bottom border-dark pb-3 mb-4 text-center">
                <h2 class="fw-semibold"><?= lang('home.booking-activity') ?></h2>
            </div>

            <div class="col-12">
                <!-- ใส่เนื้อหาสำหรับส่วนนี้ได้ที่นี่ -->
                <p class="text-muted text-center">รายละเอียดกิจกรรมการจองของคุณจะแสดงที่นี่</p>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
