<div class="swiper pt-5" id="swiper_activity">
    <div class="swiper-wrapper">
        <?php if (!empty($activitys)): ?>
            <?php foreach ($activitys as $activity):

                $start_date = date('H:i d/m/Y', strtotime($activity['start_datetime']));
                $end_date = date('H:i d/m/Y', strtotime($activity['end_datetime']));

                ?>
                <div class="swiper-slide">
                    <div class="card bg-white rounded-4 p-3" role="button"
                        onclick="window.location.href='<?= asset_url('activityDetails/' . $activity['uuid']) ?>'"
                        style="cursor: pointer">
                        <div class="image-activity" style="background-image: url(<?= asset_url($activity['image']) ?>);"></div>
                        <div class="mt-3">
                            เวลาเริ่ม <?= $start_date. ' - ' . $end_date ?>
                        </div>
                        <div class="fs-4 mt-3">
                            <?= (mb_strlen($activity['name'], 'UTF-8') > 32) ? mb_substr($activity['name'], 0, 32, 'UTF-8') . '...' : $activity['name'] ?>
                        </div>
                        <div class="fs-5 mt-3">
                            <?= (mb_strlen($activity['details'], 'UTF-8') > 80) ? mb_substr($activity['details'], 0, 80, 'UTF-8') . '...' : $activity['details'] ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>

<style>
    .swiper {
        height: 520px;
        margin-top: 5%;
    }

    .image-activity {
        width: 100%;
        height: 250px;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        /* background: round; */
    }


    .image-album {
        width: 100%;
        height: 250px;
        background-size: cover;
        background-position: center;
        border-radius: 8px;
    }

    .swiper-slide .bg-white {
        width: 90%;
        margin: auto;
        padding: 15px;
        border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .swiper-slide .bg-white:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
</style>

<script>
    $(document).ready(function () {
        var swiper = new Swiper("#swiper_activity", {
            slidesPerView: 3,
            spaceBetween: 30,
            centeredSlides: true,
            loop: true,
            autoplay: {
                delay: 1500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
                clickable: true,
            },
        });
    })


</script>