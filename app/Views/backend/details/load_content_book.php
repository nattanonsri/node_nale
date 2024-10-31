<div class="fs-4 mx-4 text-gray-800 "><?= lang('backend.book') ?></div>

<div class="row m-4">

    <div class="card shadow ">
        <!-- <p class="mb-0"><?= lang("profile.dont'have-an-account") ?><a href="<?= base_url('/register') ?>"
                class="fw-bold ms-1"><?= lang('profile.sign-up') ?></a>
        </p> -->

        <div class="card-body mt-4">
            <!-- <button type="button" class="btn btn-primary btn-lg" onclick="btnCreateCategory()"
                style="float: inline-end;"><?= lang('backend.add-book') ?></button> -->
            <div class="table-responsive">
                <table class="table table-striped" id="my_book" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center fs-5" width="5%">ลำดับ</th>
                            <th class="text-center fs-5">ชื่อ-นามสกุล</th>
                            <th class="text-center fs-5">เบอร์โทรศัพท์</th>
                            <th class="text-center fs-5">ชื่อกิจกรรม</th>
                            <th class="text-center fs-5">ชื่อประเภท</th>
                            <th class="text-center fs-5" width="7%">จำนวนคน</th>
                            <th class="text-center fs-5">ราคาทั้งหมด</th>
                            <th class="text-center fs-5">ช่วงเวลากิจกรรม</th>
                            <th class="text-center fs-5">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 1;
                        foreach ($books as $book) {
        
                            $start_date = new DateTime($book['start_datetime'], new DateTimeZone('UTC'));
                            $start_date->setTimezone(new DateTimeZone('Asia/Bangkok'));
    
                            $end_date = new DateTime($book['end_datetime'], new DateTimeZone('UTC'));
                            $end_date->setTimezone(new DAteTimeZone('Asia/Bangkok'));
    
                            $price = !empty($book['price']) ? $book['price'] : '0';
                            $total = $book['count'] * $price;
                            $priceText = number_format($total) . ' บาท';

                            echo '<tr>';
                            echo '<td class="fs-5 text-center">' . $n . '</td>';
                            echo '<td class="fs-5 text-center">' . $book['full_name'] . '</td>';
                            echo '<td class="fs-5 text-center">' . $book['tel'] . '</td>';
                            echo '<td class="fs-5 text-center">' . $book['name_activity'] . '</td>';
                            echo '<td class="fs-5 text-center">' . $book['name_category'] . '</td>';
                            echo '<td class="fs-5 text-center">' . $book['count'] . '</td>';
                            echo '<td class="fs-5 text-center">' . $priceText . '</td>';
                            echo '<td class="fs-5 text-center">' . $start_date->format('H:i d/m/Y') . ' - ' . $end_date->format('H:i d/m/Y') . '</td>';
                            echo '<td class="text-center fs-5">';
                            if ($book['status'] == 'padding') {
                                echo '<button type="button" onclick="approveBooking(\'' . $book['uuid'] . '\')" class="btn btn-success btn-sm">';
                                echo '<i class="fa-solid fa-check"></i>';
                                echo '</button>';
                                echo '<button type="button" onclick="rejectBooking(\'' . $book['uuid'] . '\')" class="btn btn-danger btn-sm">';
                                echo '<i class="fa-solid fa-xmark"></i>';
                                echo '</button>';
                            } else {
                                if ($book['status'] == 'approve') {
                                    echo '<span class="fs-5">' . lang('backend.approve') . '</span>';
                                } else if ($book['status'] == 'reject') {
                                    echo '<span class="fs-5">' . lang('backend.reject') . '</span>';
                                }
                            }
                            echo '</td>';
                            echo '</tr>';
                            $n++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>



<script>
    new DataTable('#my_book', {
        "language": {
            "sProcessing": "กำลังดำเนินการ...",
            "sLengthMenu": "แสดง _MENU_ รายการ",
            "sZeroRecords": "ไม่พบข้อมูล",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 รายการ",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sSearch": "ค้นหา:",
            "sUrl": "",
            // "oPaginate": {
            //     "sFirst":    "หน้าแรก",
            //     "sPrevious": "ก่อนหน้า",
            //     "sNext":     "ถัดไป",
            //     "sLast":     "หน้าสุดท้าย"
            // }
        }
    });

    var tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    var tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));


    function approveBooking(uuid) {

        $.ajax({
            url: `${asset_url}backend/approveBooking/${uuid}`,
            type: 'POST',
            data: {
                uuid: uuid,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: '<?= lang('backend.notification') ?>',
                        text: data.message,
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: '<?= lang('backend.notification') ?>',
                        text: data.message,

                    });
                }
            }
        })
    }
    function rejectBooking(uuid) {

        $.ajax({
            url: `${asset_url}backend/rejectBooking/${uuid}`,
            type: 'POST',
            data: {
                uuid: uuid,
            },
            headers: {
                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    swal.fire({
                        icon: 'success',
                        title: '<?= lang('backend.notification') ?>',
                        text: data.message,
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: '<?= lang('backend.notification') ?>',
                        text: data.message,

                    });
                }
            }
        });

    }
</script>