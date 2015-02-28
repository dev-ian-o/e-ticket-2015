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
            <h2><span class="fa fa-ticket"></span> Accounting</h2>
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
                                                        <a href="/admin/tickets/{{$value->id}}" class="btn btn-primary">View Tickets</a>
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
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $a = 1;?>

                                            @foreach(EventCustomer::where('design_id','=',$id)->get() as $key => $value)
                                                <tr>
                                                    <td>{{ $a++ }}</td>
                                                    <td><span data-container="body" data-toggle="tooltip" data-placement="top" title="{{ $value->firstname.' '.$value->lastname }}">{{Str::limit($value->firstname.' '.$value->lastname, 15, '...')}}</span></td>
                                                    <td>{{ $value->year }}</td>
                                                    <td>{{ $value->course }}</td>
                                                    <td><span data-container="body" data-toggle="tooltip" data-placement="top" title="{{ $value->work }}">{{Str::limit($value->work, 10, '...')}}</span></td>
                                                    <td class="class-ticket-no">
                                                        <input type="hidden" name="customer_id" value="{{$value->id}}">
                                                        <span class=ticket-no>{{$thisEvent}}</span>
                                                    </td>
                                                    <td>
                                                            balance here
                                                    </td>
                                                    <td>
                                                            status
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
                @endif

        </div>                              
    </div>    
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER --> 


@include('admin.common.logout')

</body>

@include('admin.common.footer')

