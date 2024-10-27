<?= $this->extend('front/template') ?>

<?= $this->section('content') ?>

<section class="bg-info-subtle" style="min-height: 100vh;">

    <div class="container">
        <div class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <!-- ชื่อแบรนด์ -->
                <div class="navbar-brand col-2 fs-4 fw-500">
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
                            <a href="#" class="nav-link fs-5">Home</a>
                        </li>
                        <li class="nav-item mx-4">
                            <a href="#" class="nav-link fs-5">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link fs-5">Packages</a>
                        </li>
                    </ul>
                </div>

                <!-- ไอคอนผู้ใช้ -->
                <div class="col-2 text-end d-none d-lg-block">
                    <i class="fa-solid fa-bag-shopping fs-2 me-3"></i>
                    <i class="fa-regular fa-circle-user fs-2"></i>
                </div>
            </div>
        </div>


        <div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 80px);">
            <div class="text-center"><span class="fs-1 fw-500">NODE NALE</span><br><span
                    class="fs-2">ชุมชนโหนดนาเล</span></div>
        </div>
    </div>

</section>

<section class="bg-white" style="min-height: 50vh; padding: 2rem 0;">

    <div class="container">
        <div class="row">
            <div class="col-12 mt-3 text-center fs-1 fw-500">Our Service</div>

            <div class="d-flex justify-content-center flex-wrap mt-5">
                <div class="col-12 col-md-4 mt-5 d-flex justify-content-center">
                    <div class="bg-white shadow p-5 rounded-4 fixed-card-size">
                        <div class="fs-4 fw-500">Ticket Booking</div>
                        <div class="fs-6 mt-3">We book all kind of national or international ticket for your
                            destination.
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mt-5 d-flex justify-content-center">
                    <div class="bg-white shadow p-5 rounded-4 fixed-card-size">
                        <div class="fs-4 fw-500">Hotel Booking</div>
                        <div class="fs-6 mt-3">You can easily book your hotel according to your budget by our website.
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mt-5 d-flex justify-content-center">
                    <div class="bg-white shadow p-5 rounded-4 fixed-card-size">
                        <div class="fs-4 fw-500">Tour Plan</div>
                        <div class="fs-6 mt-3">We provide you the best plan within a short time to explore more.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-success-subtle bg-opacity-25" style="min-height: 80vh; padding: 2rem 0;">

    <div class="container">
        <div class="row">
            <div class="col-12 fs-1 fw-500 text-center mb-5">กิจกรรมโหนดนาเล</div>

            <div class="d-flex justify-content-center align-items-center flex-wrap gap-3">
                <?php if (!empty($categorys)): ?>
                    <button class="btn btn-green-gradient active" data-target="#pills-0" data-id="0">ทั้งหมด</button>
                    <?php foreach ($categorys as $category): ?>
                        <button class="btn btn-green-gradient" data-target="#pills-<?= $category['id'] ?>"
                            data-id="<?= $category['id'] ?>"><?= htmlspecialchars($category['name_th'], ENT_QUOTES, 'UTF-8') ?></button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="item-content" id="pills-0">
            <div id="content_0"></div>
        </div>
        <?php foreach ($categorys as $category): ?>
            <div class="item-content d-none" id="pills-<?= $category['id'] ?>">
                <div id="content_<?= $category['id'] ?>"></div>
            </div>
        <?php endforeach; ?>
    </div>

</section>

<section class="bg-body" style="min-height: 80vh; padding: 2rem 0;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center fs-1 fw-500 mb-5">อัลบั้มกิจกรรม</div>

            <div id="main-carousel" class="splide" aria-label="My Awesome Gallery">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php if (!empty($albums)): ?>
                            <?php foreach ($albums as $album): ?>
                                <li class="splide__slide">
                                    <img src="<?= asset_url($album['path_images']) ?>">
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <ul id="thumbnails" class="thumbnails">
                <?php if (!empty($albums)): ?>
                    <?php foreach ($albums as $album): ?>
                        <li class="thumbnail">
                            <img src="<?= asset_url($album['path_images']) ?>" style="width: 500px;">
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            
        </div>
    </div>
</section>

<style>
    .splide__slide {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .splide__slide img {
        width: 80%;
        height: auto;
        border-radius: 8px;
    }

    .thumbnails {
        display: flex;
        margin: 1rem auto 0;
        padding: 0;
        justify-content: center;
        flex-wrap: wrap;
    }

    .thumbnail {
        width: 70px;
        height: 70px;
        overflow: hidden;
        list-style: none;
        margin: 0 0.2rem;
        cursor: pointer;
        border: 2px solid transparent;
        transition: border-color 0.3s;
    }

    .thumbnail:hover {
        border-color: rgba(4, 131, 33, 1);
        border-radius: 4px;
    }

    .thumbnail img {
        width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .is-active {
        border-color: rgba(45, 208, 80, 1);
        border-radius: 4px;
    }
</style>



<script>
    $(document).ready(function () {
        let dataid = '0';

        $('.btn-green-gradient').on('click', function () {
            let target = $(this).attr('data-target');
            dataid = $(this).attr('data-id');

            $('.item-content').addClass('d-none');
            $(target).removeClass('d-none');
            $('.btn-green-gradient').removeClass('active');
            $(this).addClass('active');

            loadContentActivity(dataid);
        });

        var splide = new Splide('#main-carousel', {
            pagination: false,
        });

        // เก็บรายชื่อ thumbnails
        var thumbnails = document.getElementsByClassName('thumbnail');
        var current;

        for (var i = 0; i < thumbnails.length; i++) {
            initThumbnail(thumbnails[i], i);
        }

        function initThumbnail(thumbnail, index) {
            thumbnail.addEventListener('click', function () {
                splide.go(index);
            });
        }

        splide.on('mounted move', function () {
            var thumbnail = thumbnails[splide.index];

            if (thumbnail) {
                if (current) {
                    current.classList.remove('is-active'); // ลบคลาส is-active
                }

                thumbnail.classList.add('is-active'); // เพิ่มคลาส is-active
                current = thumbnail;
            }
        });

        splide.mount();



        loadContentActivity(dataid);
    })

    function loadContentActivity(dataid) {
        $.ajax({
            url: `${asset_url}content_activity`,
            type: 'POST',
            data: {
                id: dataid,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            headers: {
                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'html',
            success: function (result) {
                $('#content_' + dataid).html(result);
            }
        })

    }

</script>
<?= $this->endSection() ?>