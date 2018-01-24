@if($currentUser->can('user-manage') || $currentUser->can('settings-manage') || $currentUser->can('user-roles-manage'))
<div class="col-md-12 setting-nav nav-tabs">
    @if($currentUser->can('settings-manage'))
        <a href="{{ baseUrl('/settings') }}" @if($selected == 'settings') class="selected text-button" @endif><i class="zmdi zmdi-settings"></i>{{ trans('settings.settings') }}</a>
    @endif
</div>
@endif