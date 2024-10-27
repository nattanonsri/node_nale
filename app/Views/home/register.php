<?= $this->extend('front/template') ?>

<?= $this->section('content') ?>



<!-- <div class="d-none d-sm-block"> -->
<div class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow card-registration" style="border-radius: 1rem;" data-aos="fade-up"
                    data-aos-anchor=".other-element">
                    <div class="card-body p-5 ">
                        <h2 class="fw-bold mb-5 text-capitalize"><?= lang('home.register-from') ?></h2>
                        <form id="frmReg" method="POST">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" name="fname" id="fname"
                                            oninput="this.value = this.value.replace(/[^a-z\u0E00-\u0E7F]/gi, '')"
                                            placeholder="<?= lang('home.fname') ?>" required>
                                        <label for="fname"><?= lang('home.fname') ?></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" name="lname" id="lname"
                                            oninput="this.value = this.value.replace(/[^a-z\u0E00-\u0E7F]/gi, '')"
                                            placeholder="<?= lang('home.lname') ?>" required>
                                        <label for="lname"><?= lang('home.lname') ?></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-4">
                                        <input type="date" class="form-control" name="birthday" id="birthday"
                                            placeholder="<?= lang('home.birthday') ?>" required>
                                        <label for="birthday"><?= lang('home.birthday') ?></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 mb-4">
                                    <h6 class="mb-2 pb-1"><?= lang('home.gender') ?>: </h6>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="femaleGender"
                                            value="<?= lang('home.male') ?>" checked />
                                        <label class="form-check-label"
                                            for="femaleGender"><?= lang('home.male') ?></label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="maleGender"
                                            value="<?= lang('home.female') ?>" />
                                        <label class="form-check-label"
                                            for="maleGender"><?= lang('home.female') ?></label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="otherGender"
                                            value="<?= lang('home.other') ?>" />
                                        <label class="form-check-label"
                                            for="otherGender"><?= lang('home.other') ?></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" name="phone" id="phone"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            placeholder="<?= lang('home.phone') ?>" required>
                                        <label for="phone"><?= lang('home.phone') ?></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-4">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="<?= lang('home.email') ?>" required>
                                        <label for="email"><?= lang('home.email') ?></label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="<?= lang('home.username') ?>" required>
                                        <label for="username"><?= lang('home.username') ?></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-2">
                                        <input type="password" class="form-control" name="password" id="password"
                                            oninput="this.value = this.value.replace(/[^a-zA-Z0-9!@#$%^&*]/g, '')"
                                            placeholder="<?= lang('home.password') ?>" required>
                                        <label for="password"><?= lang('home.password') ?></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-floating mb-2">
                                        <input type="password" class="form-control" name="repeat_password"
                                            id="repeat_password" placeholder="<?= lang('home.repeat-password') ?>"
                                            oninput="this.value = this.value.replace(/[^a-zA-Z0-9!@#$%^&*]/g, '')"
                                            required>
                                        <label for="repeat_password"><?= lang('home.repeat-password') ?></label>
                                    </div>
                                </div>

                                <div class="col-12 mb-4 d-none d-sm-block">
                                    <span class="fs-6 fst-normal">- มีความยาวอย่างน้อย 8 ตัวอักษร</span><br>
                                    <span class="fs-6 fst-normal">- ประกอบด้วยตัวเลขอย่างน้อย 1 ตัว</span><br>
                                    <span class="fs-6 fst-normal">- ประกอบด้วยตัวอักษรพิมพ์ใหญ่อย่างน้อย 1
                                        ตัว</span><br>
                                    <span class="fs-6 fst-normal">- ประกอบด้วยตัวอักษรพิมพ์เล็กอย่างน้อย 1
                                        ตัว</span><br>
                                    <span class="fs-6 fst-normal">- ประกอบด้วยอักขระพิเศษอย่างน้อย 1 ตัว</span>
                                </div>

                                <div class="col-12 mb-4 d-block d-sm-none d-md-none d-lg-none">
                                    <span class="fst-normal" style="font-size: 9pt;">
                                        - มีความยาวอย่างน้อย 8 ตัวอักษร</span><br>
                                    <span class="fst-normal" style="font-size: 9pt;">
                                        - ประกอบด้วยตัวเลขอย่างน้อย 1 ตัว</span><br>
                                    <span class="fst-normal" style="font-size: 9pt;">
                                        - ประกอบด้วยตัวอักษรพิมพ์ใหญ่อย่างน้อย 1 ตัว</span> <br>
                                    <span class="fst-normal" style="font-size: 9pt;">
                                        - ประกอบด้วยตัวอักษรพิมพ์เล็กอย่างน้อย 1 ตัว</span><br>
                                    <span class="fst-normal" style="font-size: 9pt;">
                                        - ประกอบด้วยอักขระพิเศษอย่างน้อย 1 ตัว</span>
                                </div>

                                <div class="col-12 text-end">
                                    <a href="<?= base_url('/login') ?>"
                                        class="btn btn-light"><?= lang('home.cancel') ?></a>
                                    <button type="submit" id="submitBtn"
                                        class="btn btn-primary"><?= lang('home.seve-sign-up') ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Set maximum date for birthday input to today
        const today = new Date().toISOString().split('T')[0];
        $('#birthday').attr('max', today);

        // Format phone number in a standard way
        const formatPhoneNumber = (phoneNumber) => {
            const cleaned = phoneNumber.replace(/\D/g, '').substring(0, 10);
            const match = cleaned.match(/^(\d{2})(\d{4})(\d{4})$/);
            return match ? `${match[1]}-${match[2]}-${match[3]}` : cleaned;
        };

        // Format phone number on input
        $('#phone').on('input', function () {
            $(this).val(formatPhoneNumber($(this).val()));
        });

        // Ensure username contains only letters and numbers
        $('#username').on('input', function () {
            $(this).val($(this).val().replace(/[^a-zA-Z0-9]/g, ''));
        });

        // Function to check for duplicate registration
        const checkDuplicateRegistration = (fname, lname, username, callback) => {
            $.ajax({
                url: '<?= base_url('check_duplicate'); ?>',
                type: 'POST',
                data: {
                    fname: fname,
                    lname: lname,
                    username: username,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: (response) => {
                    callback(response.isDuplicate);
                },
                error: () => {
                    callback(false);
                },
            });
        };

        // Validate form fields
        const validateForm = (formId) => {
            let isValid = true;
            $(`#${formId} input`).each(function () {
                if ($(this).val().trim() === '') {
                    isValid = false;
                    Swal.fire({
                        icon: 'warning',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                    });
                    return false;
                }
            });
            return isValid;
        };

        // Validate password strength
        const validatePassword = (password) => {
            if (password.length < 8) return 'รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร';
            if (!/\d/.test(password)) return 'รหัสผ่านต้องประกอบด้วยตัวเลขอย่างน้อย 1 ตัว';
            if (!/[A-Z]/.test(password)) return 'รหัสผ่านต้องประกอบด้วยตัวอักษรพิมพ์ใหญ่อย่างน้อย 1 ตัว';
            if (!/[a-z]/.test(password)) return 'รหัสผ่านต้องประกอบด้วยตัวอักษรพิมพ์เล็กอย่างน้อย 1 ตัว';
            if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) return 'รหัสผ่านต้องประกอบด้วยอักขระพิเศษอย่างน้อย 1 ตัว';
            return '';
        };

        // Submit button click event
        $('#submitBtn').on('click', function (e) {
            e.preventDefault();

            const fname = $('#fname').val().trim();
            const lname = $('#lname').val().trim();
            const username = $('#username').val().trim();
            const password = $('#password').val();
            const repeatPassword = $('#repeat_password').val();

            // Check for duplicate registration
            checkDuplicateRegistration(fname, lname, username, (isDuplicate) => {
                if (isDuplicate) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ข้อมูลผู้ใช้มีอยู่แล้ว',
                        //  กรุณาไปที่หน้าลืมรหัสผ่าน
                    });
                    return;
                }

                // Validate form fields
                if (!validateForm('frmReg')) return;

                // Validate password strength
                const passwordError = validatePassword(password);
                if (passwordError) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'เกิดข้อผิดพลาด',
                        text: passwordError,
                    });
                    return;
                }

                // Check if password and repeat password match
                if (password !== repeatPassword) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน',
                    });
                    return;
                }

                // Serialize form data and submit
                const formData = $('#frmReg').serialize();
                $.ajax({
                    url: '<?= base_url('addRegister'); ?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === 200) {
                            Swal.fire({
                                icon: 'success',
                                title: data.message,
                                text: ''
                            }).then(function () {
                                window.location.href = '<?= base_url('login'); ?>';
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: data.message,
                                text: ''
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: 'ไม่สามารถส่งข้อมูลได้ กรุณาลองใหม่อีกครั้ง',
                        });
                    }
                });
            });
        });
    });
</script>


<?= $this->endSection() ?>