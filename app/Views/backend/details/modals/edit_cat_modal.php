<form id="frmEditCat">
    <div class="row">
        <div class="col-6">
            <label for="name_th"><?= lang('backend.name_th') ?></label>
            <input type="text" class="form-control" id="name_th" name="name_th" value="<?= $category['name_th'] ?>" oninput="this.value = this.value.replace(/[^\u0E00-\u0E7F]/g, '')">
        </div>
        <div class="col-6">
            <label for="name_en"><?= lang('backend.name_en') ?></label>
            <input type="text" class="form-control" id="name_en" name="name_en" value="<?= $category['name_en'] ?>" oninput="this.value = this.value.replace(/[^a-zA-Z'.]/g, '')">
        </div>
    </div>

</form>
<div class="d-flex justify-content-end mt-3">
    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal"><?= lang('backend.cancel') ?></button>
    <button type="button" onclick="btnEditCategory('<?= $category['id'] ?>')"
        class="btn btn-warning"><?= lang('backend.seve-edit') ?></button>

</div>

<script>

    function btnEditCategory(id) {

        let form_data = $('#frmEditCat').serialize();

        $.ajax({
            url: `${base_url}backend/editCategory/${id}`,
            type: 'POST',
            data: form_data,
            headers: {
                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function (data) {
                if (data.status == 200) {
                    swal.fire({
                        icon: 'success',
                        title: '<?= lang('backend.notification') ?>',
                        text: data.message,
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: '<?= lang('backend.notification') ?>',
                        text: data.message,

                    });
                }
            }
        })
    }
</script>