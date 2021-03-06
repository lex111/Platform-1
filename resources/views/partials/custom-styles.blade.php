<style id="custom-styles" data-color="{{ setting('app-color') }}" data-color-light="{{ setting('app-color-light') }}">
    header, [back-to-top], .primary-background { background-color: #534292 !important }
    .faded-small, .primary-background-light { background-color: #e6e6e6 }
    .button-base, .button, input[type="button"], input[type="submit"] { background-color: {{ setting('app-color') }}; border-color: {{ setting('app-color') }} }
    .button-base:hover, .button:hover, input[type="button"]:hover, input[type="submit"]:hover, .button:focus { background-color: {{ setting('app-color') }} }
    .text-primary, p.primary, p .primary, span.primary:hover, .text-primary:hover, a, a:hover, a:focus, .text-button, .text-button:hover, .text-button:focus { color: {{ setting('app-color') }} }
</style>

@if(setting('app-custom-head') && \Route::currentRouteName() !== 'settings')
    <!-- Custom user content -->
    {!! setting('app-custom-head') !!}
    <!-- End custom user content -->
@endif