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
            <div class="container-fluid item-content d-none" id="sidebar-album">
                <div id="content-album"></div>
            </div>
            <div class="container-fluid item-content d-none" id="sidebar-book">
                <div id="content-book"></div>
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
                        <input type="text" class="form-control" id="name_th" name="name_th" oninput="this.value = this.value.replace(/[^\u0E00-\u0E7F]/g, '')">
                    </div>
                    <div class="col-6">
                        <label for="name_en"><?= lang('backend.name_en') ?></label>
                        <input type="text" class="form-control" id="name_en" name="name_en" oninput="this.value = this.value.replace(/[^a-zA-Z'.]/g, '')">
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
                        <div class="col-12 mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_total" id="limited" value="limited">
                                <label class="form-check-label" for="limited"><?= lang('backend.limited') ?></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type_total" id="unlimited" value="unlimited" checked>
                                <label class="form-check-label" for="unlimited"><?= lang('backend.unlimited') ?></label>
                            </div>

                        </div>
                        <div class="col-12 mt-3" id="num_total">
                            <label for="total_number"><?= lang('backend.total_number') ?></label>
                            <input type="text" class="form-control" id="total_number" name="total_number" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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


<!-- edit activity Modal -->
<div class="modal fade" id="editActivityModal" tabindex="-1" aria-labelledby="editActivityLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= lang('backend.activity-from-add') ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="content_activity"></div>
        </div>
    </div>
</div>

<!-- add activity Modal -->
<div class="modal fade" id="addAlbumModal" tabindex="-1" aria-labelledby="activityLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= lang('backend.activity-from-add') ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frmAlbum">
                <div class="modal-body">
                    <label>รูปขนาด 1720x1280 <span class="text-danger">*</span></label>

                    <div class="drop-area" id="drop-area">
                        ลากไฟล์มาวางที่นี่ หรือ คลิกเพื่อเลือกไฟล์
                    </div>
                    <input type="file" accept=".jpg, .jpeg, .png" name="file" id="file-input" style="display: none;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal"><?= lang('backend.cancel') ?></button>
                    <button type="submit" class="btn btn-primary"><?= lang('backend.seve-add') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .drop-area {
        border: 2px solid #007bff;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
    }

    .drop-area.highlight {
        border-color: #0056b3;
    }
</style>
<script>
    $(document).ready(function () {
        loadContentDashboard();
        loadContentUsers();
        loadContentAdministrator();
        loadContentCategory();
        loadContentActivity();
        loadContentAlbum();
        loadContentBook();

        $('#limited').on('change, click', function () {
            $('#num_total').hide();
        })
        $('#unlimited').on('change, click', function () {
            $('#num_total').show();
        })

        $('input[name="datetimes"]').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm',
                separator: ' - ',
                applyLabel: 'ยืนยัน',
                cancelLabel: 'ยกเลิก',
                fromLabel: 'จาก',
                toLabel: 'ถึง',
                daysOfWeek: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
                monthNames: [
                    'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
                    'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
                ]
            }
        }, function (start, end, label) {
            $('#start_date').val(start.format('YYYY-MM-DD HH:mm:ss'));
            $('#end_date').val(end.format('YYYY-MM-DD HH:mm:ss'));
        });
    })



    // เพิ่มฟังก์ชันตรวจสอบขนาดรูปภาพ
    function validateImageDimensions(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onload = function (e) {
                const img = new Image();
                img.src = e.target.result;

                img.onload = function () {
                    if (this.width === 1720 && this.height === 1280) {
                        resolve(true);
                    } else {
                        // reject(`ขนาดรูปภาพไม่ถูกต้อง <br> กรุณาอัพโหลดรูปขนาด ${this.width}x${this.height}px`);
                        reject(`ขนาดรูปภาพไม่ถูกต้อง <br> กรุณาอัพโหลดรูปขนาด 1720x1280px`);
                    }
                };
            };
        });
    }

    // ปรับปรุง event submit
    $('#frmAlbum').submit(function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const fileInput = document.getElementById('file-input');

        if (!fileInput.files || !fileInput.files[0]) {
            Swal.fire({
                icon: 'warning',
                title: '<?= lang('backend.notification') ?>',
                html: 'กรุณาเลือกรูปภาพ',
            });
            return;
        }

        validateImageDimensions(fileInput.files[0])
            .then(() => {
                // ส่งข้อมูลไปยังเซิร์ฟเวอร์เมื่อผ่านการตรวจสอบ
                $.ajax({
                    url: `${asset_url}backend/addAlbumActivcity`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        '<?= csrf_header() ?>': '<?= csrf_hash() ?>',
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: '<?= lang('backend.notification') ?>',
                                html: data.message,
                            }).then(function () {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: '<?= lang('backend.notification') ?>',
                                html: data.message,
                            });
                        }
                    }
                });
            })
            .catch(error => {
                Swal.fire({
                    icon: 'warning',
                    title: '<?= lang('backend.notification') ?>',
                    html: error,
                });
            });
    });

    // เพิ่ม event สำหรับแสดงตัวอย่างรูปภาพและตรวจสอบขนาดทันทีที่เลือกไฟล์
    $('#file-input').change(function () {
        const file = this.files[0];
        if (file) {
            validateImageDimensions(file)
                .then(() => {
                    // สามารถเพิ่มโค้ดแสดงตัวอย่างรูปภาพที่นี่
                    console.log('รูปภาพถูกต้อง');
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'warning',
                        title: '<?= lang('backend.notification') ?>',
                        html: error,
                    });
                    this.value = ''; // ล้างค่าไฟล์ที่เลือก
                });
        }
    });

    $('.sidebar-backend-item').click(function () {
        let target = $(this).attr('data-target');
        $('.item-content').addClass('d-none');
        $(target).removeClass('d-none');
        $('.sidebar-backend-item').removeClass('active');
        $(this).addClass('active');
    });

    const $dropArea = $('#drop-area');

    // เมื่อผู้ใช้คลิกที่ drop-area เพื่อเปิด dialog เลือกไฟล์
    $dropArea.on('click', function () {
        $('#file-input').click(); // คลิกที่ input file แทน
    });

    // เมื่อไฟล์ถูกเลือกจาก input
    $('#file-input').on('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            displayImage(file);
        }
    });

    // เมื่อไฟล์ถูกลากเข้ามาในพื้นที่
    $dropArea.on('dragover', function (event) {
        event.preventDefault();
        $dropArea.addClass('highlight');
    });

    // เมื่อไฟล์ถูกลากออกจากพื้นที่
    $dropArea.on('dragleave', function () {
        $dropArea.removeClass('highlight');
    });

    // เมื่อไฟล์ถูกปล่อยลงในพื้นที่
    $dropArea.on('drop', function (event) {
        event.preventDefault();
        $dropArea.removeClass('highlight');
        const file = event.originalEvent.dataTransfer.files[0];
        if (file) {
            displayImage(file);
        }
    });

    // แสดงภาพที่อัปโหลด
    function displayImage(file) {
        const imgURL = URL.createObjectURL(file);
        $dropArea.html(`<img src="${imgURL}" style="max-width: 100%; height: auto;">`);

        // อัปเดต input file เพื่อให้ส่งข้อมูลไปยังเซิร์ฟเวอร์
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        $('#file-input')[0].files = dataTransfer.files;
    }



    function btnCreateCategory() {
        $('#add_category_modal').modal('show')
    }
    function loadContentDashboard() {
        $.ajax({
            url: `${asset_url}backend/contentDashboard`,
            type: 'POST',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
            },
            dataType: 'html',
            success: function (result) {
                $('#content-dashboard').html(result);
            }
        });
    }

    function loadContentUsers() {
        $.ajax({
            url: `${asset_url}backend/contentUser`,
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

    function loadContentAdministrator() {
        $.ajax({
            url: `${asset_url}backend/contentAdministrator`,
            type: 'POST',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
            },
            dataType: 'html',
            success: function (result) {
                $('#content-administrator').html(result);
            }
        });
    }

    function loadContentCategory() {
        $.ajax({
            url: `${asset_url}backend/contentCategory`,
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

    function loadContentActivity() {
        $.ajax({
            url: `${asset_url}backend/contentActivity`,
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
    function loadContentAlbum() {
        $.ajax({
            url: `${asset_url}backend/contentAlbum`,
            type: 'POST',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
            },
            dataType: 'html',
            success: function (result) {
                $('#content-album').html(result);
            }
        });
    }
    function loadContentBook() {
        $.ajax({
            url: `${asset_url}backend/contentBook`,
            type: 'POST',
            data: {
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>',
            },
            dataType: 'html',
            success: function (result) {
                $('#content-book').html(result);
            }
        });
    }


    function btnSeveCategory() {
        $.ajax({
            url: `${asset_url}backend/addCategory`,
            type: 'POST',
            data: {
                name_th: $('#name_th').val(),
                name_en: $('#name_en').val(),
            },
            headers: {
                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: '<?= lang('backend.notification') ?>',
                        html: data.message
                    }).then(function () {
                        window.location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: '<?= lang('backend.notification') ?>',
                        html: data.message
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
            url: `${asset_url}backend/addActivity`,
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
                        title: '<?= lang('backend.notification') ?>',
                        html: data.message
                    }).then(function () {
                        window.location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: '<?= lang('backend.notification') ?>',
                        html: data.message
                    })
                }
            }
        })
    }



</script>

<?= $this->endSection() ?>