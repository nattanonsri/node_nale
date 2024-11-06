<section
    style="min-height: 100vh; background-image: url(<?= asset_url(LIBRARY_PATH . '/image/background_nales.jpg') ?>);	background-position: top; background-repeat: no-repeat; background-size: cover;"
    id="home">

    <div class="container">
        <div class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <!-- ชื่อแบรนด์ -->
                <div class="navbar-brand col-2 fs-3 fw-500">
                    NODE NALE
                </div>

                <!-- ปุ่ม Hamburger สำหรับหน้าจอเล็ก -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- เมนู -->
                <div class="collapse navbar-collapse col-lg-8" id="navbarContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="<?= base_url('#home') ?>" class="nav-link fs-4">หน้าแรก</a>
                        </li>
                        <li class="nav-item mx-4">
                            <a href="<?= base_url('#activity') ?>" class="nav-link fs-4">กิจกรรมชุมชนโหนดนาเล</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('#album') ?>" class="nav-link fs-4">รูปภาพกิจกรรม</a>
                        </li>
                    </ul>
                </div>

                <!-- ไอคอนผู้ใช้ -->
                <div class="col-2 text-end d-none d-lg-block">
                    <?php if (empty(USER_ID)): ?>
                        <a href="<?= asset_url('login') ?>" class="text-decoration-none fs-4 text-dark">เข้าสู่ระบบ</a>
                    <?php else: ?>
                        <a class="nav-link dropdown-toggle" role="button" id="btnDropdown" aria-expanded="false">
                            <span class="mr-2 d-lg-inline fs-4"><?= FULLNAME ?></span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu" id="dropdownMenu" aria-labelledby="btnDropdown"
                            style="max-width: 200px; display: none;">
                            <a class="dropdown-item fs-5" href="<?= base_url('bookingActivity'.'#shopping') ?>">
                                <i class="fa-solid fa-bag-shopping fs-5 mr-1"></i>
                                <?= lang('home.shopping') ?>
                            </a>
                            <a class="dropdown-item fs-5" href="<?= base_url('logout') ?>">
                                <i class="fa-solid fa-arrow-right-from-bracket fa-sm mr-1"></i>
                                <?= lang('home.logout') ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 80px);">
            <div class="text-center">
                <span class="fw-bold"
                    style="font-size: 8rem; color: #f8f9fa; text-shadow: 4px 4px 12px rgba(0, 0, 0, 0.5); letter-spacing: 0.1em;">
                    NODE NALE
                </span>
                <br>
                <span style="font-size: 4rem; color: #f8f9fa; text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);">
                    ศูนย์เรียนรู้ชุมชนโหนดนาเล
                </span>
            </div>
        </div>
    </div>

</section>