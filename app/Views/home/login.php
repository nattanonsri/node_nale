<?= $this->extend('front/template') ?>

<?= $this->section('content') ?>


<section class="d-flex align-items-center py-4 vh-100">
    <main class="form-signin w-100 m-auto">
        <form class="text-center" id="frmLogin">
            <div class="fs-2" style="font-weight: 500;"></div>
            <h1 class="fs-2 mb-3"><?= lang('backend.login') ?></h1>

            <div class="form-floating mt-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="username"
                    oninput="this.value = this.value.replace(/[^a-zA-Z0-9]/g,'')">
                <label for="username"><?= lang('backend.username') ?></label>
            </div>
            <div class="form-floating mt-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="password">
                <label for="password"><?= lang('backend.password') ?></label>
            </div>
            <button class="btn btn-primary w-100 py-2 mt-3" type="submit"><?= lang('backend.login') ?></button>
            <p class="border-top pt-2 mt-5 mb-3"><a class="text-decoration-none fs-5"
                    href="<?= base_url('register') ?>">สมัครสมาชิก</a></p>
        </form>
    </main>
</section>

<style>
    .form-signin {
        max-width: 330px;
        padding: 1rem;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>
<script>
    $(document).ready(function () {
        $('#frmLogin').on('submit', function (e) {
            e.preventDefault();

            var formData = $(this).serialize();
            $.ajax({
                url: `${base_url}loginAuth`,
                type: 'POST',
                data: formData,
                headers: {
                    '<?= csrf_header() ?>': '<?= csrf_hash() ?>',
                },
                dataType: 'json',
                success: function (data) {
                    if (data.status == 200) {
                        window.location.href = `${base_url}`;
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: '<?= lang('home.notification') ?>',
                            text: data.message
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: '<?= lang('home.notification') ?>',
                        text: xhr.responseText
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>