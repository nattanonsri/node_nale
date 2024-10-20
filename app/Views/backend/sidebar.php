<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() . 'backend' ?>">
        <div class="sidebar-brand-text mt-3 mx-3 fs-3">NODE NALE</div>
    </a>

    <li class="nav-item sidebar-backend-item active" data-target="#sidebar-dashboard">
        <a class="nav-link" role="button" id="sideber-dashboard-table">
            <i class="fa-solid fa-house fs-6"></i>
            <span class="fs-6"><?= lang('backend.home') ?></span>
        </a>
    </li>

    <li class="nav-item sidebar-backend-item" data-target="#sidebar-users">
        <a class="nav-link" role="button" id="sideber-users-table">
            <i class="fa-solid fa-user"></i>
            <span class="fs-6"><?= lang('backend.users') ?></span>
        </a>
    </li>

    <li class="nav-item sidebar-backend-item" data-target="#sidebar-admin">
        <a class="nav-link" role="button" id="sideber-administrator-table">
            <i class="fa-solid fa-user-tie"></i>
            <span class="fs-6"><?= lang('backend.administrator') ?></span>
        </a>
    </li>

    <li class="nav-item sidebar-backend-item" data-target="#sidebar-category">
        <a class="nav-link" role="button" id="sideber-category-table">
            <i class="fa-solid fa-layer-group"></i>
            <span class="fs-6"><?= lang('backend.category') ?></span>
        </a>
    </li>

    <li class="nav-item sidebar-backend-item" data-target="#sidebar-activity">
        <a class="nav-link" role="button" id="sideber-activity-table">
            <i class="fa-solid fa-person-running"></i>
            <span class="fs-6"><?= lang('backend.activity') ?></span>
        </a>
    </li>
</ul>