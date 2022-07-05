<div class="modal fade" id="delete" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
        Once you delete, it's not reversible and may impact the system.
        </div>
        <div class="modal-footer">
          <form id="form_send_delete" action='' method ='post'  enctype="multipart/form-data">
            <input type='hidden' name='id' id="id_delete">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input type='submit' class="btn btn-primary" value='Submit'>
          </form>
        </div>
      </div>
    </div>
  </div>
