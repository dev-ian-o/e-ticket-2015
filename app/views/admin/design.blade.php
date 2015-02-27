@include('admin.common.header')
<style type="text/css">
    .loader{
            position: absolute;
            top: 50%;
            left: 50%;
        }
        .viewport-ticket{
            height: 200px;
            width: 800px;
            border: 1px solid #000;
        }
</style>
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
        

        @if(!isset($id)) <?php $id = 0;?> @endif

        <!-- PAGE TITLE -->
        <div class="page-title">                    
            <h2><span class="fa fa-university"></span> Designs</h2>
        </div>
        <!-- END PAGE TITLE -->                
        
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">                
            @if($id != 0)

                <?php $design = Design::where('id','=', $id)->get();?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                                <!-- START DEFAULT DATATABLE -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">                                
                                        <h3 class="panel-title">Edit your design</h3>
                                        <ul class="panel-controls">

                                            <li><a href="/admin/design"><span class="fa fa-arrow-left"></span></a></li>
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        </ul>                                
                                    </div>
                                    <div class="panel-body">
                                        <button id="add-number" class="btn btn-primary">Add ticket number</button>
                                        <button id="add-barcode" class="btn btn-primary">Add Barcode</button>
                                        <button id="bring-backward" class="btn btn-primary">Send to back</button>
                                        <button id="bring-forward" class="btn btn-primary">Send to top</button>
                                        <button id="remove-object" class="btn btn-primary">Remove Object</button>
                                        <button id="save-btn" class="btn btn-primary">Save</button>
                                        

                                        <img src="/images/barcode.png" id="barcode-image" class="hide">
                                        <div>

                                                <!-- <span class="fa fa-spinner fa-4x fa-spin loader"></span> -->
                                                <form class="form-canvas" enctype="multipart/form-data">
                                                    <br>
                                                    <label>Add image: </label>

                                                    <input type="file" name="file" id="imgLoader">
                                                    @if(isset($design[0]))
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="hidden" name="design_name" value="{{$design[0]->design_name}}">
                                                    @endif



                                                </form>

                                                <br>
                                                <section>
                                                    <canvas id="viewport-ticket" class="viewport-ticket" width="800" height="200">
                                                    </canvas>
                                                </section>

                                        </div>
                                        <br>
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
                                        <h3 class="panel-title">Designs</h3>
                                        <ul class="panel-controls">
                                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                            <li><a href="/admin/add/design" class="panel-default"><span class="fa fa-plus"></span></a></li>

                                        </ul>                                
                                    </div>
                                    <div class="panel-body">
                                        <table class="table datatable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Design Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $a = 1;?>
                                            @foreach(Design::where('deleted_at',null)->get() as $key => $value)
                                                <tr>
                                                    <td>{{ $a++ }}</td>
                                                    <td>{{ $value->design_name }}</td>
                                                    <td class="action-buttons">
                                                        <a  href="/admin/design/{{$value->id}}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                         {{--<button class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash-o"></i></button> --}}
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

    @if($id != 0)

    <script type="text/javascript" src="/assets/fabricjs/dist/fabric.min.js"></script>
    <script type="text/javascript">
        $('document').ready(function(){
            canvas = new fabric.Canvas('viewport-ticket');

            $('#imgLoader').on('change', function(e){
                console.log('change');
                var reader = new FileReader();
                reader.onload = function (event) { 

                    var imgObj = new Image();
                    imgObj.src = event.target.result;
                    imgObj.onload = function () {
                        // start fabricJS stuff
                        
                        var image = new fabric.Image(imgObj);
                        image.set({
                            name:'design',
                            left: 0,
                            top: 0,
                            angle: 0,
                            padding: 10,
                            cornersize: 10
                        });
                        canvas.add(image);
                        
                        // end fabricJS stuff
                    }      
                }
                reader.readAsDataURL(e.target.files[0]);
                x = $("#imgLoader")[0].files[0];
                 var fd = new FormData();
                    fd.append("file", x);
                    $.ajax({
                        type: "POST",
                        url: '/upload/photos',
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function(response)
                        {
                            console.log(response);
                            path = '/users_images/'+response.path;
                            reload = JSON.stringify(canvas);
                            reload = $.parseJSON(reload);
                            x = 0;
                            while(x < reload.objects.length)
                            {
                                if(reload.objects[x].type == 'image')
                                    if(reload.objects[x].src.indexOf("data:image/") == 0 )
                                        reload.objects[x].src = path;
                                x++;

                            }
                            renderWithJson(reload);
                        },
                        complete: function()
                        {
                            // Allow form to be submited again
                        },
                        dataType: 'json'
                    });
            });

            id = $('.form-canvas').find('[name=id]').val()
            $.ajax({
                type: "GET",
                url: '/api/v1/designs/'+id,
                processData: false,
                contentType: false,
                success: function(response)
                {
                    // console.log(response);
                    renderWithJson($.parseJSON(decodeURI(response[0].json_object)));
                },
                complete: function()
                {
                    // Allow form to be submited again
                },
                dataType: 'json'
            });
        });

        $('#save-btn').on('click',function(){
            jsonObj = encodeURI(JSON.stringify(canvas));
            console.log(jsonObj);
            // encodeURI(jsonObj);

            $.ajax({
                type: "POST",
                url: '/api/v1/designs?'+$('form').serialize() + '&json_object=' + jsonObj +'&code='+canvas.toSVG(),
                data: $('form').serialize() + '&json_object=' + jsonObj +'&code='+canvas.toSVG(),
                processData: false,
                contentType: false,
                success: function(response)
                {
                    console.log(response);
                },
                complete: function()
                {
                    // Allow form to be submited again
                },
                dataType: 'json'
            });
        });


        /** function fabric**/
        var renderWithJson = function(json){
            canvas.loadFromJSON(json, function() {
                canvas.renderAll();
            });
        }

        $('#add-number').on('click',function(){
            var text = new fabric.Text('0000', { name:'number',left: 100, top: 100 });
            canvas.add(text);
        });
        $('#add-barcode').on('click',function(){
            var imgObj = new Image();
            imgObj.src = '/images/barcode.png';
            var imgInstance = new fabric.Image(imgObj, {
              name: 'barcode',
              left: 0,
              top: 0
            });
            canvas.add(imgInstance);
        });
        $('#bring-forward').on('click',function(){
            var activeObject = canvas.getActiveObject();
            if (activeObject) {
              canvas.bringForward(activeObject);
            }
         });

        $('#bring-backward').on('click',function(){
            var activeObject = canvas.getActiveObject();
            if (activeObject) {
              canvas.sendToBack(activeObject);
            }
        });
        $('#remove-object').on('click',function(){
            var activeObject = canvas.getActiveObject(),
                activeGroup = canvas.getActiveGroup();

            if (activeGroup) {
                canvas.getActiveGroup().forEachObject(function(o){ canvas.remove(o) });
                canvas.discardActiveGroup().renderAll();
              
            }
            else if (activeObject) {
              canvas.remove(activeObject);
            }
        });
        
    </script>
    @endif