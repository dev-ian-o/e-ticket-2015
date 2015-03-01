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
            <h2><span class="fa fa-ticket"></span> Tickets</h2>
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
                <h3>Event: {{Event::where('id','=',$id)->pluck('title')}}</h3>
                <div class="content-frame">   
                    <!-- START CONTENT FRAME BODY -->    
                    <div class="row">
                        <a href="/admin/print/{{$id}}" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</a>
                    </div>
                    <div class="gallery" id="links">

                        @foreach(Ticket::where('event_id','=',$id)->get() as $key => $value)
                        <a class="gallery-item" href="{{$value->path}}" title="Nature Image 1" data-gallery>
                            <div class="image">  
                                <object data="{{ $value->path }}" type="image/svg+xml"></object>
                            </div>
                            <div class="meta">
                                <strong>{{$value->filename}}</strong>
                            </div>                                
                        </a>
                        @endforeach                  
                    </div>
                             
                </div>
                @endif
        </div>                              
    </div>    
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER --> 

<!-- BLUEIMP GALLERY -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>      
<!-- END BLUEIMP GALLERY -->

@include('admin.common.logout')

</body>

@include('admin.common.footer')

{{-- <script type="text/javascript" src="../../admin-assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script> --}}

<script>            
    // document.getElementById('links').onclick = function (event) {
    //     event = event || window.event;
    //     var target = event.target || event.srcElement;
    //     var link = target.src ? target.parentNode : target;
    //     var options = {index: link, event: event,onclosed: function(){
    //             setTimeout(function(){
    //                 $("body").css("overflow","");
    //             },200);                        
    //         }};
    //     var links = this.getElementsByTagName('a');
    //     blueimp.Gallery(links, options);
    // };
</script> 




