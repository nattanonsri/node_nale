<div class="fs-4 mx-4 text-gray-800 "><?= lang('backend.category') ?></div>

<div class="row m-4">

    <div class="card shadow ">
        <!-- <p class="mb-0"><?= lang("profile.dont'have-an-account") ?><a href="<?= base_url('/register') ?>"
                class="fw-bold ms-1"><?= lang('profile.sign-up') ?></a>
        </p> -->

        <div class="card-body mt-4">
            <button type="button" class="btn btn-primary" onclick="btnCreateCategory()"
                style="float: inline-end;"><?= lang('backend.add-category') ?></button>
            <div class="table-responsive">
                <table class="table table-striped" id="my_category" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%">ลำดับ</th>
                            <th class="text-center" width="35%"><?= lang('backend.name_th') ?></th>
                            <th class="text-center" width="35%"><?= lang('backend.name_en') ?></th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 1;
                        foreach ($categorys as $cat) {
                            echo '<tr>
                                    <td>' . $n . '</td>
                                    <td>' . htmlspecialchars($cat['name_th']) . '</td>
                                    <td>' . htmlspecialchars($cat['name_en']) . '</td>
                                    <td>
                                        <a role="button" data-bs-toggle="tooltip" data-bs-title="' . lang('backend.edit') . '" class="modalButton" onclick="btnEditCats(\'' . $cat['id'] . '\')">
                                            <i class="fa-solid fa-pen-to-square fs-3 text-warning"></i>
                                        </a>
                                        <a onclick="deletecCats(\'' . $cat['id'] . '\');" role="button" data-bs-toggle="tooltip" data-bs-title="' . lang('backend.delete') . '">
                                            <i class="fa-solid fa-trash fs-3 text-danger"></i>
                                        </a>
                                    </td>
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
    new DataTable('#my_category', {
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


    function btnEditCats(id) {
        $.ajax({
            url: `${base_url}/backend/editCategoryModal/${id}`,
            type: 'POST',
            data: {
                id: id
            },
            headers: {
                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'html',
            success: function (result) {
                $('#content_category').html(result);
                $('#editCategoryModal').modal('show');
            }
        })
    }




    function deletecCats(id) {

        Swal.fire({
            icon: 'question',
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณไม่สามารถย้อนกลับได้หลังจากลบข้อมูล!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบข้อมูล!',
            cancelButtonText: 'ยกเลิก'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: `${base_url}/backend/deleteCategory/${id}`,
                    type: 'POST',
                    data: {
                        id: id,
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
        });
    }
</script>