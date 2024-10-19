<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" role="button" id="btnDropdown" aria-expanded="false">
                <span class="mr-2 d-lg-inline text-gray-600 small"></span>
                <i class="fa-solid fa-chevron-down"></i>
            </a>
            <div class="dropdown-menu" id="dropdownMenu" aria-labelledby="btnDropdown"
                style="max-width: 200px; display: none;">
                <a class="dropdown-item" href="<?= base_url() . 'backend/login' ?>">
                    <i class="fa-solid fa-arrow-right-from-bracket fa-sm mr-1 text-gray-400"></i>
                    <?= lang('backend.logout') ?>
                </a>
            </div>

        </li>
    </ul>
</nav>

<style>
    .dropdown-menu {
        left: -55px !important;
    }

    @media screen and (max-width: 992px) {
        .dropdown-menu {
            left: 65px !important;
        }
    }
</style>

<script>
    $(document).ready(function () {
        $('#btnDropdown').on('click', function (e) {
            e.preventDefault();
            $('#dropdownMenu').toggle(); // สลับการแสดงผล dropdown
        });

        // ปิด dropdown เมื่อคลิกนอก dropdown
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#btnDropdown, #dropdownMenu').length) {
                $('#dropdownMenu').hide(); // ซ่อน dropdown เมื่อคลิกนอก
            }
        });
    });
</script>