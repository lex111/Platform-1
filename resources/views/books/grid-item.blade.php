<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 book-grid-item"  data-entity-type="book" data-entity-id="{{$book->id}}">
    <a href="{{$book->getUrl()}}" title="{{$book->name}}">
        <div class="featured-image-container">
            <img width="1600" height="900" src="{{$book->getBookCover()}}" alt="{{$book->name}}">
        </div>
    </a>
    <div class="book-grid-content">
        <h2><a href="{{$book->getUrl()}}" title="{{$book->name}}" > {{$book->getShortName(35)}} </a></h2>
        @if(isset($book->searchSnippet))
            <p >{!! $book->searchSnippet !!}</p>
        @else
            <p >{{ $book->getExcerpt(130) }}</p>
        @endif
        <div >
            <span>@include('partials.entity-meta', ['entity' => $book])</span>
        </div>
    </div>
</div>
