<?= $this->include('front/header') ?>

<?= $this->include('home/navbar_home') ?>

<style>
    .dropdown-menu {
        left: 77px !important;
        top: 36px !important;
    }

    .dropdown-toggle::after {
        display: none;
        /* ซ่อนลูกศร */
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
    })
</script>
<?= $this->renderSection('content') ?>

<?= $this->include('front/footer') ?>