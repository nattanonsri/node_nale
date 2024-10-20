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
            <div class="container-fluid item-content d-none" id="sidebar-activity">
                <div id="content-activity"></div>
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



<!-- add category Modal -->
<div class="modal fade" id="add_category_modal" tabindex="-1" aria-labelledby="categoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= lang('backend.category-from-add') ?></h1>
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

<!-- edit category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= lang('backend.category-from-edit') ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="content_category"></div>
            </div>
        </div>
    </div>
</div>

<!-- add activity Modal -->
<div class="modal fade" id="addActivityModal" tabindex="-1" aria-labelledby="activityLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= lang('backend.activity-from-add') ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmAddActivity">
                    <input type="hidden" name="start_date" id="start_date">
                    <input type="hidden" name="end_date" id="end_date">

                    <div class="row">
                        <div class="col-6">
                            <label for="name"><?= lang('backend.name-activity') ?></label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="col-6">
                            <label for="category_id"><?= lang('backend.category') ?></label>
                            <select class="form-select" name="category_id" id="category_id">
                                <option value="0" selected><?= lang('backend.category') ?></option>
                                <?php foreach ($categorys as $cat) {
                                    echo '<option value="' . $cat['id'] . '">' . $cat['name_th'] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-6 mt-3">
                            <label for="address"><?= lang('backend.address-activity') ?></label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="col-6 mt-3">
                            <label for="price"><?= lang('backend.price') ?></label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="col-6 mt-3">
                            <label for="image"><?= lang('backend.image') ?></label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="col-6 mt-3">
                            <label for="datetimes"><?= lang('backend.period-activity') ?></label>
                            <input type="text" class="form-control" id="datetimes" name="datetimes">
                        </div>
                        <div class="col-12 mt-3">
                            <label for="details"><?= lang('backend.details-activity') ?></label>
                            <textarea name="details" class="form-control" id="details" rows="4"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal"><?= lang('backend.cancel') ?></button>
                <button type="button" onclick="btnSeveActivity()"
                    class="btn btn-primary"><?= lang('backend.seve-add') ?></button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        loadContentUsers();
        loadContentCategory();
        loadContenActivity();


        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm'
            }
        }, function (start, end, lebal) {
            $('#start_date').val(start.format('YYYY-MM-DD HH:mm:ss'));
            $('#end_date').val(end.format('YYYY-MM-DD HH:mm:ss'));
        });

    })

    $('.sidebar-backend-item').click(function () {
        let target = $(this).attr('data-target');
        $('.item-content').addClass('d-none');
        $(target).removeClass('d-none');
        $('.sidebar-backend-item').removeClass('active');
        $(this).addClass('active');
    });

    function btnCreateCategory() {
        $('#add_category_modal').modal('show')
    }

    function loadContentUsers() {
        $.ajax({
            url: `${base_url}backend/contentUser`,
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
            url: `${base_url}backend/contentCategory`,
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
    function loadContenActivity() {
        $.ajax({
            url: `${base_url}backend/contentActivity`,
            type: 'POST',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
            },
            dataType: 'html',
            success: function (result) {
                $('#content-activity').html(result);
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
                    }).then(function () {
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

    function btnSeveActivity() {
        let form = $('#frmAddActivity');

        let form_data = new FormData(form[0]);
        // let image = $('#image')[0].files[0];
        // form_data.append('image', image);

        $.ajax({
            url: `${base_url}/backend/addActivity`,
            type: 'POST',
            processData: false,
            contentType: false,
            data: form_data,
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
                    }).then(function () {
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



</script>

<?= $this->endSection() ?>