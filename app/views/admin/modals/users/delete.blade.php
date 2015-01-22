<div class="modal" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Delete</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <form action="/admin/users" method="post">
                    <input type="hidden" name="id"> 
                    <input type="hidden" name="user_group_id"> 
                    <input type="hidden" name="email">
                    <input type="hidden" name="password">
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).on('ready change input click',function() {
    $('.action-buttons').find('.edit').on('click', function(){
        $('.datatable').dataTable(); $el = $(this.parentElement.parentElement).find("[name]");
        $($el).each(function() {
           $('#modal-delete').find('[name='+this.name+']').val(this.value);
        });
    });
  });
</script>