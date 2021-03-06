<div class="dropdown-container" dropdown>
    <span class="user-name" dropdown-toggle>
        <img class="avatar" src="{{$currentUser->getAvatar(50)}}" alt="{{ $currentUser->name }}">
        <span class="name">{{ $currentUser->getShortName(10) }}</span> <i class="zmdi zmdi-caret-down"></i>
    </span>
    <ul>
        <li>
            <a href="{{ baseUrl("/@/{$currentUser->id}") }}" class="text-primary"><i class="zmdi zmdi-account"></i>{{ $currentUser->getShortName(10) }}</a>
        </li>
        <li>
            <a href="{{ baseUrl("/settings/users/{$currentUser->id}") }}" class="text-primary"><i class="zmdi zmdi-edit"></i>{{ trans('common.edit_profile') }}</a>
        </li>
        
        @if($currentUser->can('users-manage') && ('user-roles-manage'))
            <hr style="margin-bottom:10px">
            @if(signedInUser() && userCan('settings-manage'))
                <a href="{{ baseUrl('/settings') }}" class="text-primary"><i class="zmdi zmdi-compass"></i>Admin</a>
            @endif
            <a href="{{ baseUrl('/settings/users') }}" class="text-primary"><i class="zmdi zmdi-accounts"></i>Users</a>
            <a href="{{ baseUrl('/settings/roles') }}" class="text-primary"><i class="zmdi zmdi-lock-open"></i>Roles</a>
        @endif
        
        <hr style="margin-bottom:10px">
        <li>
            <a href="{{ baseUrl('/blog') }}" target="_blank" class="text-primary"><i class="zmdi zmdi-tumblr"></i>Blog</a>
        </li>
        <li>
            <a href="{{ baseUrl('/terms') }}" class="text-primary"><i class="zmdi zmdi-assignment-check"></i>Terms</a>
        </li>
        <li>
            <a href="{{ baseUrl('/status') }}" target="_blank" class="text-primary"><i class="zmdi zmdi-check-all"></i>Status</a>
        </li>
        <li>
            <a href="{{ baseUrl('/contact') }}" class="text-primary"><i class="zmdi zmdi-email"></i>Contact</a>
        </li>
        <li>
            <a href="{{ baseUrl('/logout') }}" class="text-neg"><i class="zmdi zmdi-run"></i>{{ trans('auth.logout') }}</a>
        </li>
    </ul>
</div>
