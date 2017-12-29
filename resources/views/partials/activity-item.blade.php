
{{--Requires an Activity item with the name $activity passed in--}}

@if($activity->user)
    <div class="left">
        <img class="avatar" src="{{ $activity->user->getAvatar(150) }}" alt="{{ $activity->user->name }}">
    </div>
@endif

<div class="right" v-pre>
    @if($activity->user)
        <a href="{{ $activity->user->getProfileUrl() }}">{{ $activity->user->name }}</a>
    @else
        <img class="avatar left" style="margin-right:12px" src="https://cdn.jsdelivr.net/npm/docspen@5.0.0/imgs/deleted.png"><b>{{ trans('common.deleted_user') }}</b>
    @endif

    {{ $activity->getText() }}

    @if($activity->entity)
        <a href="{{ $activity->entity->getUrl() }}">{{ $activity->entity->name }}</a>
    @endif

    @if($activity->extra) "{{ $activity->extra }}" @endif

    <br>

    <span class="text-muted"><small><i class="zmdi zmdi-time"></i>{{ $activity->created_at->diffForHumans() }}</small></span>
</div>
