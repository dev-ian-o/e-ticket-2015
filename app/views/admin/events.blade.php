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
            <h2><span class="fa fa-calendar"></span> Events</h2>
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
                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                    <input type="hidden" name="title" value="{{ $value->title }}">
                                                    <input type="hidden" name="description" value="{{ $value->description }}">
                                                    <input type="hidden" name="barcode_no_start" value="{{ $value->barcode_no_start }}">
                                                    <input type="hidden" name="barcode_no_end" value="{{ $value->barcode_no_end }}">
                                                    <input type="hidden" name="schedule" value="{{ date_format(date_create($value->schedule), 'm-d-Y') }}">
                                                    <input type="hidden" name="ticket_price" value="{{ $value->ticket_price }}">
                                                    <input type="hidden" name="design_name" value="{{ $value->design_name }}">

                                                    <button class="btn btn-warning edit" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash-o"></i></button>
                                                    <button class="btn btn-primary generate-ticket"><i class="fa fa-ticket"></i> Generate Ticket</button>
                                                    <a href="/admin/tickets/assign/{{$value->id}}" class="btn btn-primary">Assign Tickets</a>

                                                    {{-- <button class="btn btn-success design">Add Design <i class="fa fa-plus"></i></button> --}}
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
@include('admin.modals.events.add')
@include('admin.modals.events.edit')
@include('admin.modals.events.delete')
@include('admin.modals.events.designs')
<script type="text/javascript" src="../admin-assets/js/plugins/bootstrap/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    // $("#dp-2,#dp-3,#dp-4").datepicker();
    $(function() { 
       $(".date").datepicker({ dateFormat: 'yyyy/mm/dd' });
       $(".date").click(function(){$(".datepicker").css("z-index", "9999");});
       $(".datepicker").click(function(){$(".datepicker").css("z-index", "9999");});
    });

    $(function() { 
       $('.generate-ticket').click(function(){
            $('body').append('<i class="loader fa fa-spin fa-ticket fa-4x" style="position:fixed;top:50%;left:50%;"></i>');

            console.log(this);
            id = $(this).parent().find('[name=id]').val();
            console.log(id);
            $.ajax({
                    url: '../tickets/save/v2/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(results){
                      console.log(results.success == true);
                      if(results.success == true)
                      {
                        alert('Successfully Generated!');
                      }
                    },
                    complete:function(){
                        $('.loader').hide();
                    }
            });
            return false;
       });
    });
</script>



