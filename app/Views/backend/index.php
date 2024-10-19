<?= $this->extend('front/template') ?>

<?= $this->section('content') ?>
<div id="wrapper">
    <?= view('backend/sidebar'); ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?= view('backend/navber'); ?>
            <div class="container-fluid item-content" id="sidebar-dashboard">
                <div id="content-dashboard"></div>
            </div>
            <div class="container-fluid item-content d-none" id="sidebar-users">
                <div id="content-users"></div>
            </div>
            <div class="container-fluid item-content d-none" id="sidebar-admin">
                <div id="content-administrator"></div>
            </div>
            <div class="container-fluid item-content d-none" id="sidebar-category">
                <div id="content-category"></div>
            </div>
        </div>
        <!-- <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <!-- <span>Copyright &copy; Your Website 2021</span> -->
    </div>
</div>
</div>
</div>



<!-- Register Modal -->
<div class="modal fade" id="category_modal" tabindex="-1" aria-labelledby="categoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= lang('backend.category-from') ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <label for="name_th"><?= lang('backend.name_th') ?></label>
                        <input type="text" class="form-control" id="name_th" name="name_th">
                    </div>
                    <div class="col-6">
                        <label for="name_en"><?= lang('backend.name_en') ?></label>
                        <input type="text" class="form-control" id="name_en" name="name_en">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal"><?= lang('backend.cancel') ?></button>
                <button type="button" onclick="btnSeveCategory()"
                    class="btn btn-primary"><?= lang('backend.seve-add') ?></button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        loadContentUsers();
        loadContentCategory();
    })

    $('.sidebar-backend-item').click(function () {
        let target = $(this).attr('data-target');
        $('.item-content').addClass('d-none');
        $(target).removeClass('d-none');
        $('.sidebar-backend-item').removeClass('active');
        $(this).addClass('active');
    });

    function btnCreateCategory() {
        $('#category_modal').modal('show')
    }

    function loadContentUsers() {
        $.ajax({
            url: '<?= asset_url('backend/contentUser') ?>',
            type: 'POST',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
            },
            dataType: 'html',
            success: function (result) {
                $('#content-users').html(result);
            }
        });
    }
    function loadContentCategory() {
        $.ajax({
            url: '<?= asset_url('backend/contentCategory') ?>',
            type: 'POST',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
            },
            dataType: 'html',
            success: function (result) {
                $('#content-category').html(result);
            }
        });
    }


    function btnSeveCategory() {


        $.ajax({
            url: `${base_url}/backend/addCategory`,
            type: 'POST',
            data: {
                name_th: $('#name_th').val(),
                name_en: $('#name_th').val(),
            },
            headers: {
                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'แจ้งเตือน!',
                        text: data.message
                    }).then(function() {
                        // loadContentCategory();
                        window.location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'แจ้งเตือน!',
                        text: data.message
                    })
                }
            }
        })
    }


    // function btnEditUsers(uuid) {
    //     $.ajax({
    //         url: '<?= base_url('backend/openEditUsersModal') ?>',
    //         type: 'POST',
    //         data: {
    //             uuid: uuid,
    //             '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
    //         },
    //         dataType: 'html',
    //         success: function (result) {
    //             $('#detailsUsers').html(result);
    //             $('#editUsersModal').modal('show');
    //         }
    //     });
    // }

    // function deleteUsers(uuid) {
    //     Swal.fire({
    //         title: 'คุณแน่ใจหรือไม่?',
    //         text: "คุณไม่สามารถย้อนกลับได้หลังจากลบข้อมูล!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'ใช่, ลบข้อมูล!',
    //         cancelButtonText: 'ยกเลิก'
    //     }).then(function (result) {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: '<?= base_url('profile/delete_form_user/') ?>' + uuid,
    //                 type: 'DELETE',
    //                 success: function (data) {
    //                     var data = JSON.parse(data);
    //                     if (data.status === 200) {
    //                         Swal.fire({
    //                             icon: 'success',
    //                             title: data.message,
    //                             text: '',
    //                             showConfirmButton: true,
    //                         }).then(function () {
    //                             location.reload();
    //                         });
    //                     } else {
    //                         Swal.fire({
    //                             icon: 'warning',
    //                             title: data.message,
    //                             text: '',
    //                         });
    //                     }
    //                 },
    //             });
    //         }
    //     });
    // }

</script>

<?= $this->endSection() ?>