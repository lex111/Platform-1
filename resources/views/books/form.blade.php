
{{ csrf_field() }}
<div class="form-group title-input">
    <label for="name">{{ trans('common.name') }}</label>
    @include('form.text', ['name' => 'name'])
</div>

<div class="form-group description-input">
    <label for="description">{{ trans('common.description') }}</label>
    @include('form.textarea', ['name' => 'description'])
</div>

<div class="form-group" collapsible id="logo-control">
        <div class="collapse-title text-primary" collapsible-trigger>
            <label for="user-avatar">{{ trans('common.cover_image') }}</label>
        </div>
        <div class="collapse-content" collapsible-content>
            <p class="small">{{ trans('common.cover_image_description') }}</p>

            @include('components.image-picker', [
                'resizeHeight' => '512',
                'resizeWidth' => '512',
                'showRemove' => false,
                'defaultImage' => 'https://unpkg.com/docspen@18.0.1/imgs/default.png',
                'currentImage' => @isset($model) ? $model->getBookCover() : 'https://unpkg.com/docspen@12.0.0/imgs/default.png' ,
                'currentId' => @isset($model) ? $model->image_id : 0,
                'name' => 'image_id',
                'imageClass' => 'cover'
            ])
        </div>
</div>

<div class="form-group text-right">
    <a href="{{ isset($book) ? $book->getUrl() : baseUrl('/books') }}" class="button outline">{{ trans('common.cancel') }}</a>
    <button type="submit" class="button pos">{{ trans('entities.books_save') }}</button>
</div>
