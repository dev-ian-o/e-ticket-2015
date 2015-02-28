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
            <h2><span class="fa fa-user"></span> Customers</h2>
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
                                                <th>Last Name</th>
                                                <th>First Name</th>
                                                <th>Year</th>
                                                <th>Course</th>
                                                <th>Work</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $a = 1;?>
                                        @foreach(Customer::where('deleted_at','=',null)->get() as $key => $value)
                                            <tr>
                                                <td>{{ $a++ }}</td>
                                                <td>{{ $value->lastname }}</td>
                                                <td>{{ $value->firstname }}</td>
                                                <td>{{ $value->year }}</td>
                                                <td>{{ $value->course }}</td>
                                                <td>{{ $value->work }}</td>
                                                <td class="action-buttons">
                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                    <input type="hidden" name="firstname" value="{{ $value->firstname }}">
                                                    <input type="hidden" name="lastname" value="{{ $value->lastname }}">
                                                    <input type="hidden" name="birthdate" value="{{ $value->birthdate }}">
                                                    <input type="hidden" name="year" value="{{ $value->year }}">
                                                    <input type="hidden" name="course" value="{{ $value->course }}">
                                                    <input type="hidden" name="work" value="{{ $value->work }}">
                                                    <button class="btn btn-warning edit" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash-o"></i></button>
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
@include('admin.modals.customers.edit')
@include('admin.modals.customers.delete')

<script type="text/javascript" src="../admin-assets/js/plugins/bootstrap/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $(function() { 
       $(".date").datepicker({ dateFormat: 'yyyy/mm/dd' });
       $(".date").click(function(){$(".datepicker").css("z-index", "9999");});
       $(".datepicker").click(function(){$(".datepicker").css("z-index", "9999");});
    });
</script>
