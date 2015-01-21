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
            <h2><span class="fa fa-arrow-circle-o-left"></span> Buttons</h2>
        </div>
        <!-- END PAGE TITLE -->                
        
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">                
        
            <div class="row">
                <div class="col-md-6">

                    <!-- START DEFAULT BUTTONS -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Buttons</h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>                                
                        </div>
                        <div class="panel-body">                            
                            <p>Use any of the available button classes to quickly create a styled button.</p>
                            <div class="form-group">
                                <button type="button" class="btn btn-default">Default</button>
                                <button type="button" class="btn btn-primary">Primary</button>
                                <button type="button" class="btn btn-success">Success</button>
                                <button type="button" class="btn btn-info">Info</button>
                                <button type="button" class="btn btn-warning">Warning</button>
                                <button type="button" class="btn btn-danger">Danger</button>
                                <button type="button" class="btn btn-link">Link</button>                                                                
                            </div>
                            <h4>Rounded</h4>
                            <p>Add class <code>.btn-rounded</code> to get buttons like this:</p>
                            <div class="form-group">
                                <button type="button" class="btn btn-default btn-rounded">Default</button>
                                <button type="button" class="btn btn-primary btn-rounded">Primary</button>
                                <button type="button" class="btn btn-success btn-rounded">Success</button>
                                <button type="button" class="btn btn-info btn-rounded">Info</button>
                                <button type="button" class="btn btn-warning btn-rounded">Warning</button>
                                <button type="button" class="btn btn-danger btn-rounded">Danger</button>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button type="button" class="btn btn-default pull-left">Left</button>
                            <button type="button" class="btn btn-primary pull-right">Right</button>
                        </div>
                    </div>
                    <!-- END DEFAULT BUTTONS -->

                    <!-- START BUTTON STATES -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Button States</h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>                                
                        </div>
                        <div class="panel-body">                            
                            <p><code>disabled</code> state</p>
                            <button type="button" class="btn btn-default" disabled="disabled">Default</button>
                            <button type="button" class="btn btn-primary" disabled="disabled">Primary</button>
                            <button type="button" class="btn btn-success" disabled="disabled">Success</button>
                            <button type="button" class="btn btn-info" disabled="disabled">Info</button>
                            <button type="button" class="btn btn-warning" disabled="disabled">Warning</button>
                            <button type="button" class="btn btn-danger" disabled="disabled">Danger</button>
                            <button type="button" class="btn btn-link" disabled="disabled">Link</button>                                                                
                        </div>
                        <div class="panel-body">                            
                            <p><code>.active</code> state</p>
                            <button type="button" class="btn btn-default active">Default</button>
                            <button type="button" class="btn btn-primary active">Primary</button>
                            <button type="button" class="btn btn-success active">Success</button>
                            <button type="button" class="btn btn-info active">Info</button>
                            <button type="button" class="btn btn-warning active">Warning</button>
                            <button type="button" class="btn btn-danger active">Danger</button>
                            <button type="button" class="btn btn-link active">Link</button>                                                                
                        </div>
                    </div>
                    <!-- END BUTTON STATES -->

                    <!-- START BUTTON SIZES -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Buttons Sizes</h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>                                
                        </div>
                        <div class="panel-body">                  
                            <p>Use classes <code>btn-lg, btn-sm, bt-xs</code> to get custom sizes</p>
                            <p>
                                <button type="button" class="btn btn-primary btn-lg">Large button</button>
                                <button type="button" class="btn btn-default btn-lg">Large button</button>
                            </p>
                            <p>
                                <button type="button" class="btn btn-info">Default button</button>
                                <button type="button" class="btn btn-default">Default button</button>
                            </p>
                            <p>
                                <button type="button" class="btn btn-warning btn-sm">Small button</button>
                                <button type="button" class="btn btn-default btn-sm">Small button</button>
                            </p>
                            <p>
                                <button type="button" class="btn btn-danger btn-xs">Extra small button</button>
                                <button type="button" class="btn btn-default btn-xs">Extra small button</button>
                            </p>                                                             
                        </div>                            
                    </div>
                    <!-- END BUTTON STATES -->

                    <!-- START GROUP BUTTONS -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Button Groups</h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>                                
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <div class="col-md-12">                                                                                                                                                                                                               
                                        <div class="btn-group btn-group-lg">
                                            <button class="btn btn-default">Large</button>
                                            <button class="btn btn-default">Size</button>                                                
                                            <button class="btn btn-default">Buttons</button>                                        
                                        </div>      
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">                                                                                    
                                        <div class="btn-group">
                                            <button class="btn btn-default">Default</button>
                                            <button class="btn btn-default">Size</button>                                                
                                            <button class="btn btn-default">Buttons</button>                                        
                                        </div>
                                    </div>             
                                </div>                                    
                                <div class="form-group">
                                    <div class="col-md-12">                                                                                                                        
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-default">Small</button>
                                            <button class="btn btn-default">Size</button>                                                
                                            <button class="btn btn-default">Buttons</button>                                        
                                        </div>      
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <div class="col-md-12">                                                                                                                        
                                        <div class="btn-group btn-group-xs">
                                            <button class="btn btn-default">Extra Small</button>
                                            <button class="btn btn-default">Size</button>                                                
                                            <button class="btn btn-default">Buttons</button>                                        
                                        </div>      
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END BLOCK BUTTONS -->

                </div>
                <div class="col-md-6">

                    <!-- START SWITCH BUTTONS -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Switch Button</h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>                                
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Checkbox</label>
                                    <div class="col-md-10">
                                        <label class="switch">
                                            <input type="checkbox" checked value="0"/>
                                            <span></span>
                                        </label>
                                        <label class="switch">
                                            <input type="checkbox" value="1"/>
                                            <span></span>
                                        </label>                                        
                                        <label class="switch">
                                            <input type="checkbox" value="2"/>
                                            <span></span>
                                        </label>
                                        <label class="switch">
                                            <input type="checkbox" disabled value="2"/>
                                            <span></span>
                                        </label>                                            
                                    </div>
                                </div>                                    

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Radio</label>
                                    <div class="col-md-10">
                                        <label class="switch">
                                            <input type="radio" name="switch-radio1" checked value="0"/>
                                            <span></span>
                                        </label>
                                        <label class="switch">
                                            <input type="radio" name="switch-radio1" value="1"/>
                                            <span></span>
                                        </label>                                        
                                        <label class="switch">
                                            <input type="radio" name="switch-radio1" value="2"/>
                                            <span></span>
                                        </label>                                        
                                        <label class="switch">
                                            <input type="radio" name="switch-radio1" disabled value="3"/>
                                            <span></span>
                                        </label>                                            
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Custom size</label>
                                    <div class="col-md-10">
                                        <label class="switch switch-small">
                                            <input type="checkbox" checked value="0"/>
                                            <span></span>
                                        </label>
                                        <label class="switch switch-small">
                                            <input type="checkbox" value="1"/>
                                            <span></span>
                                        </label>                                        
                                        <label class="switch switch-small">
                                            <input type="checkbox" value="2"/>
                                            <span></span>
                                        </label>
                                        <label class="switch switch-small">
                                            <input type="checkbox" disabled value="2"/>
                                            <span></span>
                                        </label>                                            
                                    </div>
                                </div>
                                
                            </form>
                        </div>                            
                    </div>
                    <!-- END SWITCH BUTTONS -->

                    <!-- START BUTTONS WITH DROPDOWN -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title">Buttons With Dropdown</h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>                                
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form">                                    
                                <div class="form-group">                                        
                                    <div class="col-md-12">
                                        <div class="btn-group">
                                            <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Dropdown <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li role="presentation" class="dropdown-header">Dropdown header</li>
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>                                                    
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">Split Buttons</button>
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li role="presentation" class="dropdown-header">Dropdown header</li>
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>                                                    
                                            </ul>
                                        </div>
                                        <div class="btn-group dropup">
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">Dropup <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li role="presentation" class="dropdown-header">Dropdown header</li>
                                                <li><a href="#">Action</a></li>
                                                <li><a href="#">Another action</a></li>
                                                <li><a href="#">Something else here</a></li>                                                    
                                            </ul>
                                        </div>
                                    </div>
                                </div>                                                                                                                    
                            </form>
                        </div>                            
                    </div>
                    <!-- END BUTTONS WITH DROPDOWN -->

                    <!-- START BLOCK BUTTONS -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Block Level Buttons</h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>                                
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        Add <code>.btn-block</code> to use block button
                                    </div>
                                </div>
                                <div class="form-group">                                        
                                    <div class="col-md-12">
                                        <button class="btn btn-default btn-block">Default</button>
                                    </div>
                                </div>                                    
                                <div class="form-group">                                        
                                    <div class="col-md-6">
                                        <button class="btn btn-primary btn-block">Primary</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-info btn-block">Info</button>
                                    </div>                                        
                                </div>                                                                        
                                <div class="form-group">                                        
                                    <div class="col-md-4">
                                        <button class="btn btn-success btn-block">Success</button>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-warning btn-block">Warning</button>
                                    </div>              
                                    <div class="col-md-4">
                                        <button class="btn btn-danger btn-block">Danger</button>
                                    </div>              
                                </div>                                             
                            </form>
                        </div>                            
                    </div>
                    <!-- END BLOCK BUTTONS -->

                    <!-- START BUTTONS WITH ICONS -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title">Buttons With Icons</h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>                                
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form">                                    
                                <div class="form-group">                                        
                                    <div class="col-md-12">
                                        <p>Glyphicon icons support</p>
                                        <button class="btn btn-default"><i class="glyphicon glyphicon-home"></i></button>
                                        <button class="btn btn-primary"><i class="glyphicon glyphicon-heart"></i></button>
                                        <button class="btn btn-info"><i class="glyphicon glyphicon-phone-alt"></i></button>
                                        <button class="btn btn-success"><i class="glyphicon glyphicon-user"></i></button>
                                        <button class="btn btn-warning"><i class="glyphicon glyphicon-tint"></i></button>
                                        <button class="btn btn-danger"><i class="glyphicon glyphicon-shopping-cart"></i></button>
                                    </div>
                                </div>                                    
                                <div class="form-group">                                        
                                    <div class="col-md-12">
                                        <p>Font Awesome icons support</p>
                                        <button class="btn btn-default"><i class="fa fa-coffee"></i></button>
                                        <button class="btn btn-primary"><i class="fa fa-cog"></i></button>
                                        <button class="btn btn-info"><i class="fa fa-bookmark"></i></button>
                                        <button class="btn btn-success"><i class="fa fa-plus"></i></button>
                                        <button class="btn btn-warning"><i class="fa fa-cloud"></i></button>
                                        <button class="btn btn-danger"><i class="fa fa-globe"></i></button>
                                    </div>
                                </div>                                    
                                <div class="form-group">                                                                                
                                    <div class="col-md-12">
                                        <p>Button with text and icon</p>
                                        <button class="btn btn-default"><i class="fa fa-arrow-left"></i> Left</button>
                                        <button class="btn btn-default">Right <i class="fa fa-arrow-right"></i></button>
                                        <button class="btn btn-default"><i class="fa fa-arrow-up"></i> Up</button>
                                        <button class="btn btn-default">Bottom <i class="fa fa-arrow-down"></i></button>
                                    </div>                                        
                                </div>                                                                        
                                <div class="form-group">                                        
                                    <div class="col-md-12">
                                        <p>Button group with icons</p>
                                        <div class="btn-group">
                                            <button class="btn btn-default"><i class="fa fa-backward"></i></button>
                                            <button class="btn btn-default"><i class="fa fa-play"></i></button>                                                
                                            <button class="btn btn-default"><i class="fa fa-pause"></i></button>
                                            <button class="btn btn-default"><i class="fa fa-stop"></i></button>                                                
                                            <button class="btn btn-default"><i class="fa fa-forward"></i></button>                                                                                                                                                
                                        </div>
                                    </div>                                                    
                                </div>                                             
                            </form>
                        </div>                            
                    </div>
                    <!-- END BUTTONS WITH ICONS -->

                </div>
            </div>
            
        </div>
        <!-- PAGE CONTENT WRAPPER -->                                
    </div>    
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER --> 


@include('admin.common.logout')

</body>
@include('admin.common.footer')


