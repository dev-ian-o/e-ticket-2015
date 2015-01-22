
@if(Auth::check())
    <?php $id = Auth::user()->user_group_id; ?>
    <?php $group_name = UserGroup::where('id',$id)->pluck('groupname'); ?>
@endif
    
<div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
            <li class="xn-logo">
                <a href="/admin">E-Iicket</a>
                <a href="#" class="x-navigation-control"></a>
            </li>
            <li class="xn-profile">
                <a href="#" class="profile-mini">
                    <img src="{{ URL::to('admin-assets/assets/images/users/avatar.jpg') }}" alt="John Doe"/>
                </a>
                <div class="profile">
                    <div class="profile-image">
                        <img src="{{ URL::to('admin-assets/assets/images/users/avatar.jpg') }}" alt="John Doe"/>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name">{{ ucfirst($group_name) }}</div>
                        <div class="profile-data-title">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="profile-controls">
                        <a href="#" class="profile-control-left"><span class="fa fa-info"></span></a>
                        <a href="#" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                    </div>
                </div>                                                                        
            </li>
            @if($group_name === "admin")
            <li class="xn-title">Admin</li>
            <li>
                <a href="/admin/users"><span class="fa fa-user"></span> <span class="xn-text">Users</span></a>
            </li>
            <li>
                <a href="/admin/user-group"><span class="fa fa-users"></span> <span class="xn-text">Users Group</span></a>
            </li>                    
            <li>
                <a href="/admin/students"><span class="fa fa-university"></span> <span class="xn-text">Students</span></a>
            </li>                    
            <li>
                <a href="/admin/tickets"><span class="fa fa-ticket"></span> <span class="xn-text">Tickets</span></a>
            </li>
            <li>
                <a href="/admin/viewport"><span class="fa fa-ticket"></span> <span class="xn-text">Design</span></a>
            </li>
            <li>
                <a href="/admin/events"><span class="fa fa-calendar"></span> <span class="xn-text">Events</span></a>
            </li>                    
            @endif;

            <li class="xn-title">Others</li>
            
            @if($group_name === "admin" || $group_name === "accounting" )
            <li>
                <a href="/admin/accounting"><span class="fa fa-superscript"></span> <span class="xn-text">Accounting</span></a>
            </li>                    
            @endif
            <li>
                <a href="/admin/registration"><span class="fa fa-barcode"></span> <span class="xn-text">Registration</span></a>
            </li>                    
        </ul>
        <!-- END X-NAVIGATION -->
    </div>