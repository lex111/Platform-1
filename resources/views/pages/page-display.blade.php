<div ng-non-bindable>

    <h1 id="bkmrk-page-title">{{$page->name}}</h1>
    <div 
    	class="fb-like" 
    	data-href="{{ $page->getUrl('/') }}" 
    	style="margin-bottom:12px"
    	data-layout="standard"
    	data-action="like"
    	data-size="large"
    	data-show-faces="false"
    	data-share="true">
    </div>

    <div style="clear:left;"></div>

    @if (isset($diff) && $diff)
        {!! $diff !!}
    @else
        {!! isset($page->renderedHTML) ? $page->renderedHTML : $page->html !!}
    @endif
</div>

<div id="fb-root"></div>
<script>
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=144193326127105';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>