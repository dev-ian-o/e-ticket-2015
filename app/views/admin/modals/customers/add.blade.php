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
                    <label class="col-md-3 control-label">First Name:</label>
                    <div class="col-md-9">
                        <input type="text" name="firstname" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Last Name:</label>
                    <div class="col-md-9">
                        <input type="text" name="lastname" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Birthdate</label>
                    <div class="col-md-5">
                        <div class="input-group date" id="dp-2" data-date="{{date('Y-m-d')}}" data-date-format="yyyy-mm-dd">
                            <input type="text" name="birthdate" class="form-control" value="{{date('Y-m-d')}}" />
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>    

                <div class="form-group">
                    <label class="col-md-3 control-label">Gender:</label>
                    <div class="col-md-9">
                        <select class="form-control" name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>   
                    </div>
                </div>    
                <div class="form-group">
                    <label class="col-md-3 control-label">Year:</label>
                    <div class="col-md-9">
                        <select class="form-control" name="year">
                            <option value="none">none</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>   
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-md-3 control-label">Section:</label>
                    <div class="col-md-9">
                        <select class="form-control" name="section">
                            <option value="none">none</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>   
                    </div>
                </div>    
                <div class="form-group">
                    <label class="col-md-3 control-label">Course:</label>
                    <div class="col-md-9">
                        <select class="form-control" name="course">
                            <option value="none">none</option>
                            <option value="none">others</option>
                            <option value="1">ITSM</option>
                            <option value="2">CNA</option>
                            <option value="3">CSAD</option>
                        </select>   
                    </div>
                </div>    
                <div class="form-group">
                    <label class="col-md-3 control-label">Work:</label>
                    <div class="col-md-9">
                        <input type="text" name="work" class="form-control"/>
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
                    url: '{{URL::to("api/v1/customers")}}',
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
                          // location.href = window.location.href;                    
                          window.location.reload();
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