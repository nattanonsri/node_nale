<div class="fs-4 mx-4 text-gray-800"><?= lang('backend.home') ?></div>

<div class="row m-4" data-aos="fade-up">

    <div class="col-xl-3 col-md-6 ">
        <div class="card shadow rounded-2 px-3 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col  mr-2">
                        <div class="fw-500 text-gray-600 fs-5 mb-1">
                            <?= lang('backend.sum-users') ?>
                        </div>
                        <div class="fs-4 fw-500"><?= $sum_users ?></div>
                    </div>
                    <div class="col-auto">
                        <img src="<?= base_url() . LIBRARY_PATH . '/icons/user_sum.svg' ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow rounded-2 px-3 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="fw-500 text-gray-600 fs-5 mb-1">
                            <?= lang('backend.male') ?>
                        </div>
                        <div class="fs-4 fw-500"><?= $male ?></div>
                    </div>
                    <div class="col-auto">
                        <img src="<?= base_url() . LIBRARY_PATH . '/icons/user_mr.svg' ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow rounded-2 px-3 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="fw-500 text-gray-600 fs-5 mb-1">
                            <?= lang('backend.female') ?>
                        </div>
                        <div class="fs-4 fw-500"><?= $female ?></div>
                    </div>
                    <div class="col-auto">
                        <img src="<?= base_url() . LIBRARY_PATH . '/icons/user_mis.svg' ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center m-4" data-aos="fade-up">
    <div class="col-12 ">
        <div class="card shadow rounded-2 mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="text-primary fw-500 fs-6 m-0"><?= lang('backend.number-users') ?></div>
            </div>
            <div class="card-body">
                <div class="p-2">
                    <canvas id="acquisitions"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function generatePastDates(numOfDays) {
        let pastDateNumbers = [];
        const millisecondsPerDay = 24 * 60 * 60 * 1000;
        const currentDate = new Date();

        for (let i = 0; i <= numOfDays; i++) {
            const pastDate = new Date(currentDate.getTime() - i * millisecondsPerDay);
            const pastDateNumber = pastDate.getDate();
            pastDateNumbers.push(pastDateNumber);
        }
        return pastDateNumbers;
    }

    var numOfDays = 4;
    var number = generatePastDates(numOfDays);
    var datatimes = <?= json_encode($datetime) ?>;

    new Chart($('#acquisitions'), {
        type: 'bar',
        data: {
            labels: [
                'วันที่ ' + number[4],
                'วันที่ ' + number[3],
                'วันที่ ' + number[2],
                'วันที่ ' + number[1],
                'วันที่ ' + number[0],
            ],
            datasets: [{
                label: '<?= lang('backend.number-users') ?>',
                data: [
                    datatimes.get_dateTime5,
                    datatimes.get_dateTime4,
                    datatimes.get_dateTime3,
                    datatimes.get_dateTime2,
                    datatimes.get_dateTime1,
                ],
                backgroundColor: '#9BD0F5',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: true,
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>