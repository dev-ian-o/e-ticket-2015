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
            <h2><span class="fa fa-user"></span> Users</h2>
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
                                    <h3 class="panel-title">Users</h3>
                                    <ul class="panel-controls">

                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-default"><span class="fa fa-plus"></span></a></li>

                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>E-mail/Username</th>
                                                <th>User Group</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $a = 1;?>
                                        @foreach(User::where('deleted_at',null)->get() as $key => $value)
                                            <tr>
                                                <td>{{ $a++ }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ UserGroup::where('id',$value->user_group_id)->pluck('groupname') }}</td>
                                                <td class="action-buttons">
                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                    <input type="hidden" name="email" value="{{ $value->email }}">
                                                    <input type="hidden" name="user_group_id" value="{{ $value->user_group_id }}">
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


<script type="text/javascript">
  $(document).on('ready change input click',function() {
    $('.action-buttons').find('.edit').on('click', function(){
        $('.datatable').dataTable(); $el = $(this.parentElement.parentElement).find("[name]");
        $($el).each(function() {
           $('#modal-edit').find('[name='+this.name+']').val(this.value);
        });
    });
  });
</script>


                                    <button class="btn btn-default" data-toggle="modal" data-target="#modal-edit">Basic</button>

        <div class="modal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead">Edit</h4>
                    </div>

                    <form id="validate" role="form" class="form-horizontal" action="javascript:alert('Form #validate submited');">
                    <div class="modal-body">                            
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email:</label>
                            <div class="col-md-9">
                                <input type="email" name="email" class="validate[required] form-control"/>
                                <span class="help-block">Required, max size = 8</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">User Group:</label>
                            <div class="col-md-9">
                                <select class="validate[required] select" name="user_group_id">
                                    @foreach(UserGroup::get() as $key => $value)
                                    <option value="{{$value->id}}">{{ $value->groupname }}</option>
                                    @endforeach
                                </select>                           
                                <span class="help-block">Required</span>
                            </div>
                        </div>    

                        <div class="form-group">
                            <label class="col-md-3 control-label">Password:</label>
                            <div class="col-md-9">
                                <input type="password" name="password" class="validate[required,minSize[5]] form-control" id="password"/>
                                <span class="help-block">Required, min size = 5</span>
                            </div>
                        </div>    
                                                                          
                        <div class="form-group">
                            <label class="col-md-3 control-label">Confirm:</label>
                            <div class="col-md-9">
                                <input type="password" class="validate[required,equals[password]] form-control"/>
                                <span class="help-block">Required, equals Password</span>
                            </div>
                        </div>                                                               
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Submit</button>

                    </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="modal" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead">Delete</h4>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>