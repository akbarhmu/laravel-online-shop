@if ($errors->any())
    <div {!! $attributes->merge(['class' => 'alert alert-danger']) !!} role="alert">
        <div class="alert-title font-weight-bold">{{ __('Whoops! Something went wrong.') }}</div>
        <ul class="">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
