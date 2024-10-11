<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin') }}" class="logo">
    @php
        $logo_image = App\Models\Arm_visual_setting::where('status','active')->select('logo_image_path','logo_image_name','mini_logo_image_path','mini_logo_image_name')->first();
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $roles_privileges = App\Models\Arm_role_privilege::where('id', $role_id)->select('role_name')->first();
    @endphp 
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <img src="{{ !empty($logo_image->mini_logo_image_path) && Storage::exists($logo_image->mini_logo_image_path) ? url('/').Storage::url($logo_image->mini_logo_image_path) : URL::asset('admin_panel/commonarea/dist/img/favicon.png') }}" alt="{{ !empty($logo_image->logo_image_name) ? $logo_image->logo_image_name : 'Mini Logo Image' }}">
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg" style="font-size: 18px;">
            <img src="{{ !empty($logo_image->logo_image_path) && Storage::exists($logo_image->logo_image_path) ? url('/').Storage::url($logo_image->logo_image_path) : URL::asset('admin_panel/commonarea/dist/img/logo.png') }}" alt="{{ !empty($logo_image->logo_image_name) ? $logo_image->logo_image_name : 'Logo' }}">
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ !empty(Auth::guard('arm_admins')->user()->user_profile_image_path) && Storage::exists(Auth::guard('arm_admins')->user()->user_profile_image_path) ? url('/').Storage::url(Auth::guard('arm_admins')->user()->user_profile_image_path) : URL::asset('admin_panel/commonarea/dist/img/avatar5.png') }}" class="user-image" alt="{{ !empty(Auth::guard('arm_admins')->user()->user_profile_image_name) ? Auth::guard('arm_admins')->user()->user_profile_image_name : 'User Image' }}">
                        <span class="hidden-xs">{{ Auth::guard('arm_admins')->user()->user_name }}</span>
                    </a>
                    <ul class="dropdown-menu user-image-admin">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ !empty(Auth::guard('arm_admins')->user()->user_profile_image_path) && Storage::exists(Auth::guard('arm_admins')->user()->user_profile_image_path) ? url('/').Storage::url(Auth::guard('arm_admins')->user()->user_profile_image_path) : URL::asset('admin_panel/commonarea/dist/img/avatar5.png') }}" class="img-circle" alt="{{ !empty(Auth::guard('arm_admins')->user()->user_profile_image_name) ? Auth::guard('arm_admins')->user()->user_profile_image_name : 'User Image' }}">
                            <h5>{{ $roles_privileges->role_name }}</h5>
                            <p><small>Member since 2023</small></p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{ url('admin/system-user/'.Crypt::encrypt(Auth::guard('arm_admins')->user()->id).'/edit') }}" class="btn btn-default btn-flat">Edit Profile</a>
                                <a href="{{ URL('admin/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
