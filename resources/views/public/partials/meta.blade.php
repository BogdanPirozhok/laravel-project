<meta property="og:title" content="{{ $meta_title ?? $title ?? ''  }}" />

@if(isset($meta_description))
    <meta property="og:description" content="{{ $meta_description }}" />
    <meta name="description" content="{{ $meta_description }}" />
@endif

<meta property="og:url" content="{{ Request::url() }}" />
<link rel="canonical" href="{{ Request::url() }}">

