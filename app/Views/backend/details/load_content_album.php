<div class="fs-4 mx-4 text-gray-800"><?= lang('backend.album') ?></div>
<div class="row m-4">
    <div class="card shadow ">
        <div class="card-body mt-4">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" onclick="btnCreateAlbum()"><?= lang('backend.add-album') ?></button>
            </div>


            <div class="row mt-4">
                <?php foreach ($albums as $album) {
                    echo '<div class="col-4 mt-3 position-relative">
                            <button type="button" onclick="deleteAlbmum(\'' . $album['uuid'] . '\')" class="btn btn-danger btn-sm position-absolute top-0 start-25">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <img src="' . asset_url($album['path_images']) . '" class="w-100" />
                        </div>';
                } ?>
      
            </div>

        </div>
    </div>
</div>
</div>


<script>

    function btnCreateAlbum() {
        var myModal = new bootstrap.Modal($('#addAlbumModal'));
        myModal.show();
    }


    function deleteAlbmum(uuid) {
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
                    url: `${asset_url}backend/deleteAlbumActivcity/${uuid}`,
                    type: 'POST',
                    data: {
                        uuid: uuid,
                    },
                    headers: {
                        '<?= csrf_header() ?>': '<?= csrf_hash() ?>',
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
                })
            }
        });
    }
</script>