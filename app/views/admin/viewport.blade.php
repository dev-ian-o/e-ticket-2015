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
        

        
        <!-- PAGE TITLE -->
        <div class="page-title">                    
            <h2><span class="fa fa-university"></span> Design</h2>
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
                                    <h3 class="panel-title">Design</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <button id="add-number" class="btn btn-primary">add ticket number</button>
                                    <button id="add-barcode" class="btn btn-primary">add Barcode</button>
                                    <button id="bring-backward" class="btn btn-primary">Send to back</button>
                                    <button id="bring-forward" class="btn btn-primary">Send to top</button>
                                    <button id="remove-object" class="btn btn-primary">Remove Object</button>
                                    <button id="save-btn" class="btn btn-primary">Save</button>
                                    

                                    <img src="/images/barcode.png" id="barcode-image" class="hide">
                                    <div >

                                            <span class="fa fa-spinner fa-4x fa-spin loader"></span>
                                            <form enctype="multipart/form-data">
                                                <input type="file" name="file" id="imgLoader">
                                                <input type="hidden" name="id" value="1">
                                                <input type="hidden" name="event_id" value="1">
                                                <input type="hidden" name="design_name" value="#sample">

                                            </form>
                                            <section>
                                                <canvas id="viewport-ticket" class="viewport-ticket" width="800" height="200">
                                                </canvas>
                                            </section>
                                    </div>
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


    <script type="text/javascript" src="/assets/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/fabricjs/dist/fabric.min.js"></script>
    <script type="text/javascript" src="/js/loader.js"></script>
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
                id = 1;
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
            // jsonString = {"objects":[{"type":"text","originX":"left","originY":"top","left":78,"top":30,"width":135.53,"height":52,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":1,"scaleY":1,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","text":"wdasdas","fontSize":40,"fontWeight":"normal","fontFamily":"Times New Roman","fontStyle":"","lineHeight":1.3,"textDecoration":"","textAlign":"left","path":null,"textBackgroundColor":"","useNative":true},{"type":"image","originX":"left","originY":"top","left":64,"top":106.98,"width":336,"height":150,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":0.55,"scaleY":0.55,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","src":"http://localhost:8000/images/barcode.png","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"}],"background":""};
            // jsonString = {"objects":[{"type":"image","originX":"left","originY":"top","left":-2,"top":-61.82,"width":699,"height":526,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":1.01,"scaleY":0.75,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","src":"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD//gAEKgD/4gIcSUNDX1BST0ZJ…B7q/8A8rKAPyFor9ev+ILv9qX/AKHz4A/+D3V//lZR/wAQXf7Uv/Q+fAH/AMHur/8AysoA/9k=","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"image","originX":"left","originY":"top","left":710.58,"top":188.82,"width":336,"height":150,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":0.55,"scaleY":0.55,"angle":269.73,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","src":"http://localhost:8000/images/barcode.png","filters":[],"crossOrigin":"","alignX":"none","alignY":"none","meetOrSlice":"meet"},{"type":"text","originX":"left","originY":"top","left":584,"top":107,"width":80,"height":52,"fill":"rgb(0,0,0)","stroke":null,"strokeWidth":1,"strokeDashArray":null,"strokeLineCap":"butt","strokeLineJoin":"miter","strokeMiterLimit":10,"scaleX":1,"scaleY":1,"angle":0,"flipX":false,"flipY":false,"opacity":1,"shadow":null,"visible":true,"clipTo":null,"backgroundColor":"","fillRule":"nonzero","globalCompositeOperation":"source-over","text":"#000","fontSize":40,"fontWeight":"normal","fontFamily":"Times New Roman","fontStyle":"","lineHeight":1.3,"textDecoration":"","textAlign":"left","path":null,"textBackgroundColor":"","useNative":true}],"background":""};

            // jsonString = JSON.stringify(jsonString);
            // canvas.loadFromJSON(jsonString);
            
        });

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

        $('#save-btn').on('click',function(){
            jsonObj = encodeURI(JSON.stringify(canvas));
            console.log(jsonObj);
            // encodeURI(jsonObj);

            $.ajax({
                type: "POST",
                url: '/api/v1/designs?'+$('form').serialize() + '&json_object=' + jsonObj,
                data: $('form').serialize() + '&json_object=' + jsonObj,
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

        var renderWithJson = function(json){
            canvas.loadFromJSON(json, function() {
                canvas.renderAll();
            });
        }
         

    </script>
