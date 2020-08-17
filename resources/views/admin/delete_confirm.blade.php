<div class="modal js-delete-confirm-modal" tabindex="-1">
    <div class="modal-dialog">
        <form method="post" class="modal-content js-delete-confirm-form">
            @csrf
            <input type="hidden" class="js-delete-confirm-id" name="id">
            <div class="modal-header">
                <h5 class="modal-title">Подтвердите удаление</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="js-delete-confirm-text">Подтвердите удаление</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет, отмена</button>
                <button type="submit" class="btn btn-danger">Да, удалить</button>
            </div>
        </form>
    </div>
</div>


