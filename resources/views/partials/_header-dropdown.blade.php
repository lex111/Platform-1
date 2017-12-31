<div class="dropdown-container" dropdown>
    <span class="user-name" dropdown-toggle>
        <img class="avatar" src="{{$currentUser->getAvatar(150)}}" alt="{{ $currentUser->name }}">
        <span class="name" ng-non-bindable>{{ $currentUser->getShortName(9) }}</span> <i class="zmdi zmdi-caret-down"></i>
    </span>
    <ul>
        <li>
            <a href="{{ baseUrl("/user/{$currentUser->id}") }}" class="text-primary"><i class="zmdi zmdi-account"></i>{{ $currentUser->getShortName(9) }}</a>
        </li>
        <li>
            <a href="{{ baseUrl("/settings/users/{$currentUser->id}") }}" class="text-primary"><i class="zmdi zmdi-edit"></i>{{ trans('common.edit_profile') }}</a>
        </li>
        @if(signedInUser() && userCan('settings-manage'))
            <hr style="margin-bottom:10px">
            <a href="{{ baseUrl('/settings') }}" class="text-primary"><i class="zmdi zmdi-compass"></i>Admin</a>
            <a href="https://github.com/DocsPen/Platform" class="text-primary"><i class="zmdi zmdi-github"></i>GitHub</a>       
        @endif
        <hr style="margin-bottom:10px">
        <li>
            <a href="{{ baseUrl("/books/docspen/page/about") }}" class="text-primary"><i class="zmdi zmdi-info"></i>About</a>
        </li>
        <li>
            <a href="{{ baseUrl("/books/docspen/page/terms") }}" class="text-primary"><i class="zmdi zmdi-assignment-check"></i>Terms</a>
        </li>
        <li>
            <a href="{{ baseUrl("/books/docspen/page/privacy") }}" class="text-primary"><i class="zmdi zmdi-shield-security"></i>Privacy</a>
        </li>
        <li>
            <a href="{{ baseUrl('/logout') }}" class="text-neg"><i class="zmdi zmdi-run"></i>{{ trans('auth.logout') }}</a>
        </li>
    </ul>
</div>
