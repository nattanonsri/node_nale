<div class="fs-4 mx-4 text-gray-800 "><?= lang('backend.activity') ?></div>

<div class="row m-4">

    <div class="card shadow ">
        <div class="card-body mt-4">
            <button type="button" class="btn btn-primary btn-lg" onclick="btnCreateActivity()"
                style="float: inline-end;"><?= lang('backend.add-activity') ?></button>
            <div class="table-responsive">
                <table class="table table-striped" id="my_activity" width="100%" cellspacing="0">
                    <thead>

                        <tr>
                            <th class="text-center" width="6%">ลำดับ</th>
                            <th><?= lang('backend.image') ?></th>
                            <th><?= lang('backend.name-activity') ?></th>
                            <th><?= lang('backend.price') ?></th>
                            <th><?= lang('backend.start-activity') ?></th>
                            <th><?= lang('backend.end-activity') ?></th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 1;
                        foreach ($activitys as $act) {
                            $startDateTime = new DateTime($act['start_datetime']);
                            $endDateTime = new DateTime($act['end_datetime']);
                            //(!empty($act['image']) ? $act['image'] : lang('backend.null-value'))
                            echo '<tr>
                                    <td>' . $n . '</td>
                                    <td><img src="'. asset_url($act['image']) .'" width="140px"></td>
                                    <td>' . $act['name'] . '</td>
                                    <td>' . $act['price'] . '</td>
                                    <td>' . $startDateTime->format('H:i:s d/m/Y') . '</td>
                                    <td>' . $endDateTime->format('H:i:s d/m/Y') . '</td>
                                    <td>
                                        <a role="button" data-bs-toggle="tooltip" data-bs-title="' . lang('backend.edit') . '" class="modalButton" onclick="btnEditActs(\'' . $act['uuid'] . '\')">
                                            <i class="fa-solid fa-pen-to-square fs-3 text-warning"></i>
                                        </a>
                                        <a onclick="deleteActs(\'' . $act['uuid'] . '\');" role="button" data-bs-toggle="tooltip" data-bs-title="' . lang('backend.delete') . '">
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
    new DataTable('#my_activity', {
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


    function btnCreateActivity() {
        var myModal = new bootstrap.Modal($('#addActivityModal'));
        myModal.show();
    }
    function deleteActs(uuid){

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
                    url: `${base_url}/backend/deleteActivity/${uuid}`,
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
                                title: 'แจ้งเตือน!',
                                text: data.message,
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'แจ้งเตือน!',
                                text: data.message,

                            });
                        }
                    }
                });
            }
        });
    }

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
                                title: 'แจ้งเตือน!',
                                text: data.message,
                            }).then(function () {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'แจ้งเตือน!',
                                text: data.message,

                            });
                        }
                    }
                });
            }
        });
    }
</script>