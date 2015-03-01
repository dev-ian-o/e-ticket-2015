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
            <h2><span class="fa fa-rouble"></span> Accounting</h2>
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
                                            <li><a href="#" class="panel-default" data-toggle="modal" data-target="#modal-add"><span class="fa fa-plus"></span></a></li>
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
                                                        <a href="/admin/accounting/{{$value->id}}" class="btn btn-primary">Check Accounts</a>
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
                                        <h3 class="panel-title">Event Customers</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
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
                                                    <th>Ticket #</th>
                                                    <th>Balance</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $a = 1;?>
                                                @if(EventCustomer::where('event_id','=',$id)->count())
                                                   @foreach(EventCustomer::where('event_id','=',$id)->get() as $key => $value)
                                                    <tr>
                                                        <td>{{ $a++ }}</td>
                                                        <?php
                                                            $customer = Customer::where('id','=',$value->customer_id)->get()->first();
                                                        ?>
                                                        <td><span data-container="body" data-toggle="tooltip" data-placement="top" title="{{ $customer->firstname.' '.$customer->lastname }}">{{Str::limit($customer->firstname.' '.$customer->lastname, 15, '...')}}</span></td>
                                                        <td>{{ $customer->year }}</td>
                                                        <td>{{ $customer->course }}</td>
                                                        <td><span data-container="body" data-toggle="tooltip" data-placement="top" title="{{ $value->work }}">{{Str::limit($customer->work, 10, '...')}}</span></td>
                                                        <td class="class-ticket-no">
                                                            <span class=ticket-no>{{$value->ticket_no}}</span>
                                                        </td>
                                                        <td>
                                                            P{{number_format($value->balance,2)}}
                                                        </td>
                                                        <td>
                                                            <form>
                                                                <input type="text" name="balance" class="form-control" value="{{$value->balance}}">
                                                                <input type="hidden" name="event_id" value="{{$id}}">
                                                                <input type="hidden" name="customer_id" value="{{$value->customer_id}}">
                                                            </form>
                                                        </td>
                                                        <td>
                                                            @if($value->account_status == "not paid")
                                                            <button class="btn btn-alert">{{$value->account_status}}</button>
                                                            @elseif($value->account_status == "paid with balance")
                                                            <button class="btn btn-danger">{{$value->account_status}}</button>
                                                            @elseif($value->account_status == "paid")
                                                            <button class="btn btn-success">{{$value->account_status}}</button>
                                                            @else
                                                            <button class="btn btn-primary">{{$value->account_status}}</button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-success update">Update</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
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



<script type="text/javascript">
    $(document).on('ready',function() {
        $(".update").on('click', function(e){
          e.preventDefault();
          that = $(this);
          thisForm = $(that).parent().parent().find('form');
          $.ajax({
                    url: '{{URL::to("api/v1/event_customers")}}',
                    type: 'GET',
                    data: $(thisForm).serialize(),
                    dataType: 'json',
                    success: function(results){
                      console.log(results);
                      if(results.success == true)
                      {
                          alert('Successfully updated!');
                          window.location.reload();
                      }else{
                        alert('invalid amount!');
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