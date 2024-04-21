<div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="delete_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="delete_modalLabel">Eliminazione Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="modal_title"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="./destroy.php" method="get">
                    <input type="hidden" value="" id="post_id" name="post_id">
                    <button type="submit" class="btn btn-primary">Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>