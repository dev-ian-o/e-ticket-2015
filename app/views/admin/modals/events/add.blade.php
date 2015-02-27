<div class="modal" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Add</h4>
            </div>

            <form role="form" id="form-add" class="form-horizontal">
            <input type="hidden" name="design_id" value="">
            <div class="modal-body">                            
                <div class="form-group">
                    <label class="col-md-3 control-label">Event Title:</label>
                    <div class="col-md-9">
                        <input type="text" name="title" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Event Description:</label>
                    <div class="col-md-9">
                        <input type="text" name="description" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Schedule</label>
                    <div class="col-md-5">
                        <div class="input-group date" id="dp-2" data-date="{{date('Y-m-d')}}" data-date-format="yyyy-mm-dd">
                            <input type="text" name="schedule" class="form-control" value="{{date('Y-m-d')}}" />
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <h4 class="col-md-12 text-center">Barcode No.</h4>
                    <label class="col-md-3 control-label">Start No.:</label>
                    <div class="col-md-9">
                        <input type="number" name="barcode_no_start" class="form-control" min="0"/>
                    </div>
                    <label class="col-md-3 control-label">End No.:</label>
                    <div class="col-md-9">
                        <input type="number" name="barcode_no_end" class="form-control" min="0"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Design.:</label>
                    <div class="col-md-9">
                        <button type="button" class="btn btn-primary" class="choose-design" data-toggle="modal" data-target="#modal-design">Choose design</button>
                        <span class="design-name"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Ticket Price:</label>
                    <div class="col-md-9">
                        <input type="number" name="ticket_price" class="form-control" min="0"/>
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
                    url: '../api/v1/events',
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
        $('.choose-design').click(function(e){

        })
      });
</script>