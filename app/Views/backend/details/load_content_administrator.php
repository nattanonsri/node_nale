<div class="fs-4 mx-4 text-gray-800 "><?= lang('backend.administrator') ?></div>

<div class="row m-4">

    <div class="card shadow ">
        <!-- <p class="mb-0"><?= lang("profile.dont'have-an-account") ?><a href="<?= base_url('/register') ?>"
                class="fw-bold ms-1"><?= lang('profile.sign-up') ?></a>
        </p> -->

        <div class="card-body mt-4">
            <!-- <button type="button" class="btn btn-primary btn-lg" onclick="btnCreateCategory()"
                style="float: inline-end;"><?= lang('backend.add-administrator') ?></button> -->
            <div class="table-responsive">
                <table class="table table-striped" id="my_administrator" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%">ลำดับ</th>
                            <th class="text-center">ชื่อ-นามสกุล</th>
                            <th class="text-center">Username</th>
                            <!-- <th width="10%"></th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 1;
                        foreach ($admins as $admin) {
                            echo '<tr>
                                    <td>' . $n . '</td>
                                    <td>' . $admin['first_name'] . ' ' . $admin['last_name'] . '</td>
                                    <td>' . $admin['username'] . '</td>
                                </tr>';
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
    new DataTable('#my_administrator', {
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

</script>