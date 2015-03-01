@include('admin.common.header')
<body>
<!-- START PAGE CONTAINER -->
<div class="page-container">
    
    <!-- START PAGE SIDEBAR -->
    @include('admin.common.sidebar')
    <!-- END PAGE SIDEBAR -->
    
    <!-- PAGE CONTENT -->
    <div class="page-content">
    
    @include('admin.common.navbar')    
                           
    @include('admin.common.breadcrumbs')
        

        
        <!-- PAGE TITLE -->
        <div class="page-title">                    
            <h2><span class="fa fa-barcode"></span> Registration</h2>
        </div>
        <!-- END PAGE TITLE -->

        <!-- PAGE CONTENT WRAPPER -->

        <div class="page-content-wrap">                
                @if(!isset($id)) <?php $id = 0;?> @endif

                @if($id == 0)
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                                <!-- START DEFAULT DATATABLE -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">                                
                                        <h3 class="panel-title">Events</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                            {{-- <li><a href="#" class="panel-default" data-toggle="modal" data-target="#modal-add"><span class="fa fa-plus"></span></a></li> --}}
                                        </ul>                                
                                    </div>
                                    <div class="panel-body">
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Event Title</th>
                                                    <th>Descritpion</th>
                                                    <th>Barcodes</th>
                                                    <th>Schedule</th>
                                                    <th>Ticket Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $a = 1;?>
                                            <?php
                                            $events = Event::where('events.deleted_at', '=', NULL)
                                                ->leftJoin('designs', 'events.design_id', '=', 'designs.id')
                                                ->select('*','events.id','events.deleted_at','events.created_at','events.updated_at')
                                                ->get();
                                            ?>
                                            @foreach($events as $key => $value)
                                                <tr>
                                                    <td>{{ $a++}}</td>
                                                    <td><span data-container="body" data-toggle="tooltip" data-placement="top" title="{{ $value->title }}">{{Str::limit($value->title, 15, '...')}}</span></td>
                                                    <td><span data-container="body" data-toggle="tooltip" data-placement="top" title="{{ $value->description }}">{{Str::limit($value->description, 15, '...')}}</span></td>
                                                    <td>{{ $value->barcode_no_start.'-'.$value->barcode_no_end }}</td>
                                                    <td>{{ date_format(date_create($value->schedule), 'm-d-Y') }}</td>
                                                    <td>{{ number_format($value->ticket_price,'2') }}</td>
                                                    <td class="action-buttons">
                                                        <a href="/admin/registration/{{$value->id}}" class="btn btn-primary">Register Attendee</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- END DEFAULT DATATABLE -->
                          
                        </div>
                    </div>
                </div>
                @else

                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                                <!-- START DEFAULT DATATABLE -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">                                
                                        <h3 class="panel-title">Input ticket number or use your barcode reader to input in textbox.</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        </ul>                                
                                    </div>

                                    <div class="panel-body">
                                        <form class="form-reg">
                                            <input type="hidden" name="event_id" value="{{$id}}">
                                            <input type="text" name="ticket_no" class="form-control barcode_no" placeholder="Input or target your barcode number here!">
                                        </form>
                                    </div>
                                </div>
                                <!-- END DEFAULT DATATABLE -->
                          
                        </div>
                    </div>
                </div>
                @endif

        </div>                              
    </div>    
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER --> 


@include('admin.common.logout')

</body>

@include('admin.common.footer')
<div class="modal" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Customer Information</h4>
            </div>

            <form role="form" id="form-register" class="form-horizontal">
            <input type="hidden" name="event_id" value="{{$id}}"/>
            <input type="hidden" name="customer_id" value=""/>
            <div class="modal-body">                            
                <div class="row">
                    Name: <h3 class="name"></h3>
                    Account Status: <h3 class="account-status"></h3>
                    Work: <h3 class="work"></h3>
                    Course: <h3 class="course"></h3>
                    Year and Section: <h3 class="year"></h3>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" value="Register">

            </div>

            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).on('ready',function() {
        $("#form-register").on('submit', function(e){
          e.preventDefault();
          console.log(this);
          $.ajax({
                    url: '{{URL::to("/register/customer")}}',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(results){
                      console.log(results);
                      if(results.success == true)
                      {
                          $('#modal-info').modal('hide');
                          alert('Successfully registered!');
                          // location.href = window.location.href;                    
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


<script type="text/javascript">
    $(document).on('ready',function() {
        $('.form-reg').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                    url: '{{URL::to("api/v1/event_customers/1")}}',
                    type: 'DELETE',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(results){
                      console.log(results);
                      if(results.success != null)
                      {
                        console.log(results.customer_profile[0]);
                        customer_profile = results.customer_profile[0];
                        success = results.success[0];
                        $('#modal-info').find('.name').html(customer_profile.firstname+' '+customer_profile.lastname);
                        $('#modal-info').find('.work').html(customer_profile.work);
                        $('#modal-info').find('.course').html(customer_profile.course);
                        $('#modal-info').find('.year').html(customer_profile.year+'-'+customer_profile.section);
                        $('#modal-info').find('.account-status').html(success.account_status);
                        $('#modal-info').find('[name=customer_id]').val(success.customer_id);
                        $('#modal-info').modal('show');
                          // alert('Successfully updated!');
                          // window.location.reload();
                      }else{
                        // alert('invalid amount!');
                      }
                    },
                    complete:function(){
                      // $(".loader").fadeOut('slow');
                      //loader stop here.
                    }
              });
            return false;
        })
        $(".barcode_no").on('input', function(e){
          e.preventDefault();
          that = $(this);
          thisForm = $(that).parent();
          $.ajax({
                    url: '{{URL::to("api/v1/event_customers/1")}}',
                    type: 'DELETE',
                    data: $(thisForm).serialize(),
                    dataType: 'json',
                    success: function(results){
                      console.log(results);
                      if(results.success != null)
                      {
                        console.log(results.customer_profile[0]);
                        customer_profile = results.customer_profile[0];
                        success = results.success[0];
                        $('#modal-info').find('.name').html(customer_profile.firstname+' '+customer_profile.lastname);
                        $('#modal-info').find('.work').html(customer_profile.work);
                        $('#modal-info').find('.course').html(customer_profile.course);
                        $('#modal-info').find('.year').html(customer_profile.year+'-'+customer_profile.section);
                        $('#modal-info').find('.account-status').html(success.account_status);
                        $('#modal-info').find('[name=customer_id]').val(success.customer_id);
                        $('#modal-info').modal('show');
                          // alert('Successfully updated!');
                          // window.location.reload();
                      }else{
                        // alert('invalid amount!');
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