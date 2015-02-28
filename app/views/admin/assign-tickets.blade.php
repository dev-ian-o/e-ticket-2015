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
            <h2><span class="fa fa-calendar"></span> Assign Tickets</h2>
            <h2 class="pull-right">Available Tickets : <b><span class="ticket-counter">{{ Ticket::where('event_id','=',$id)->count() - EventCustomer::where('event_id','=',$id)->count()  }}</span></b></h2>
        </div>
        <!-- END PAGE TITLE -->                
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">                
        
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                                                    <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Customers</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-default" data-toggle="modal" data-target="#modal-add"><span class="fa fa-plus"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Year</th>
                                                <th>Course</th>
                                                <th>Work</th>
                                                <th>Assign</th>
                                                <th>Ticket #</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $a = 1;?>
                                        @foreach(Customer::where('deleted_at','=',null)->get() as $key => $value)
                                            <tr>
                                                <td>{{ $a++ }}</td>
                                                <td><span data-container="body" data-toggle="tooltip" data-placement="top" title="{{ $value->firstname.' '.$value->lastname }}">{{Str::limit($value->firstname.' '.$value->lastname, 15, '...')}}</span></td>
                                                <td>{{ $value->year }}</td>
                                                <td>{{ $value->course }}</td>
                                                <td><span data-container="body" data-toggle="tooltip" data-placement="top" title="{{ $value->work }}">{{Str::limit($value->work, 10, '...')}}</span></td>
                                                <td>
                                                    <form>
                                                        <input type="hidden" name="id" value="">
                                                        <input type="hidden" name="customer_id" value="{{$value->id}}">
                                                        <input type="hidden" name="event_id" value="{{ $id }}">
                                                        <?php 
                                                            $thisEvent = EventCustomer::where('event_id','=',$id)
                                                                    ->where('customer_id','=',$value->id)->pluck('ticket_no');
                                                        ?>
                                                        <input type="checkbox" class="check" name="assign" @if($thisEvent) {{'checked'}} @endif>
                                                    </form>
                                                </td>
                                                <td class="class-ticket-no">
                                                    <input type="hidden" name="customer_id" value="{{$value->id}}">
                                                    <span class=ticket-no>{{$thisEvent}}</span>
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
            
        </div>                              
    </div>    
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER --> 


@include('admin.common.logout')

</body>

@include('admin.common.footer')
@include('admin.modals.customers.add')

<script type="text/javascript" src="../admin-assets/js/plugins/bootstrap/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    // $("#dp-2,#dp-3,#dp-4").datepicker();
    $(function() { 
       $(".date").datepicker({ dateFormat: 'yyyy/mm/dd' });
       $(".date").click(function(){$(".datepicker").css("z-index", "9999");});
       $(".datepicker").click(function(){$(".datepicker").css("z-index", "9999");});
    });

    $(function() {
        $('input[type=checkbox]').on('input click',function(){
            that = $(this);
            thisForm = $(this).parent();  
            console.log(this);  
            $.ajax({
                url: '{{URL::to("api/v1/event_customers")}}',
                type: 'POST',
                data: $(thisForm).serialize(),
                dataType: 'json',
                success: function(results){
                  console.log(results);
                  if(results.success == true)
                  {
                        $('.ticket-counter').html(results.total_ticket);
                        $(that).parent().parent().parent().find('.ticket-no').html(results.ticket_no);
                  }
                },
                complete:function(){
                //   // $(".loader").fadeOut('slow');
                  // loader stop here.
                }
              });
        });
    });
</script>



