<div class="modal" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Add</h4>
            </div>

            <form role="form" id="form-add" class="form-horizontal">
            <div class="modal-body">                            
                <div class="form-group">
                    <label class="col-md-3 control-label">Email:</label>
                    <div class="col-md-9">
                        <input type="email" name="email" class="form-control"/>
                        <span class="help-block">Required, max size = 8</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">User Group:</label>
                    <div class="col-md-9">
                        <select class="select" name="user_group_id">
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
                        <input type="password" name="password" class="form-control" id="password"/>
                        <span class="help-block">Required, min size = 5</span>
                    </div>
                </div>    
                                                                  
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm:</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control"/>
                        <span class="help-block">Required!</span>
                    </div>
                </div>                                                               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" value="Save">

            </div>

            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).on('ready',function() {
        $("#form-add").on('submit', function(e){
          e.preventDefault();
          $.ajax({
                    url: '../api/v1/users',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(results){
                      console.log(results);
                      if(results.success == true)
                      {
                          $('#modal-add').modal('hide');
                          $('#form-add')[0].reset();
                          alert('Successfully added!');
                          location.href = window.location.href;                    
                      }
                    },
                    complete:function(){
                      // $(".loader").fadeOut('slow');
                      //loader stop here.
                    }
              });
          return false;
        });
      });
</script>