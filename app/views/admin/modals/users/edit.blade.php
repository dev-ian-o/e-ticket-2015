<div class="modal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Edit</h4>
            </div>

            <form role="form" class="form-horizontal" action="/api/v1/users/1/edit" method="get">
             <input type="hidden" name="id">
            <div class="modal-body">                            
                <div class="form-group">
                    <label class="col-md-3 control-label">Email:</label>
                    <div class="col-md-9">
                        <input type="email" name="email" class="validate[required] form-control"/>
                        <span class="help-block">Required, max size = 8</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">User Group:</label>
                    <div class="col-md-9">
                        <select class="validate[required] select" name="user_group_id">
                            @foreach(UserGroup::get() as $key => $value)
                            <option value="{{$value->id}}">{{ $value->groupname }}</option>
                            @endforeach
                        </select>                           
                        <span class="help-block">Required</span>
                    </div>
                </div>    

                <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="col-md-9">
                        <input type="password" name="password" class="validate[required,minSize[5]] form-control" id="password"/>
                        <span class="help-block">Required, min size = 5</span>
                    </div>
                </div>    
                                                                  
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm:</label>
                    <div class="col-md-9">
                        <input type="password" class="validate[required,equals[password]] form-control"/>
                        <span class="help-block">Required, equals Password</span>
                    </div>
                </div>                                                               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit">Submit</button>

            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).on('ready change input click',function() {
    $('.action-buttons').find('.edit').on('click', function(){
        $('.datatable').dataTable(); $el = $(this.parentElement.parentElement).find("[name]");
        $($el).each(function() {
           $('#modal-edit').find('[name='+this.name+']').val(this.value);
        });
    });
  });
</script>