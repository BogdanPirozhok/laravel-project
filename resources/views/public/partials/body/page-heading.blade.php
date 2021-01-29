<section class="hero {{ $main ?? false ? 'hero-main' : 'hero-recipe'  }} hero--100vh"
         style="background: {{$background_color ?? ''}}">
    <div class="wrapper">
        <div class="hero__text">
            <h1 class="h1">
                {{ $body['header']['title'] }}
            </h1>
            @if(isset($body['header']['sub_title'] ))
                <span class="hero__description">
                    {{ $body['header']['sub_title'] }}
                </span>
            @endif
            @if(isset($body['header']['button_url']) || isset($body['header']['button_text']))
                <a href="{{ $body['header']['button_url'] ?? '' }}" class="btn">
                    {{ $body['header']['button_text'] ?? ''}}
                </a>
            @endif
        </div>

        @if(isset($body['header']['image_url']))
            <div class="hero__picture">
                <img src="{{ $body['header']['image_url'] }}" alt="" class="hero__img">
                @if(isset($image_icon_url))
                    <img src="{{  $image_icon_url  }}" alt="" class="hero__svg {{ $fish ?? false ? 'hero__svg--fish'  : '' }}">
                @endif
                @if(isset($image_bg_color))
                    <div class="hero__picture-bg" style="background: {{ $image_bg_color }};"></div>
                @endif
            </div>
        @endif
    </div>

    <waves
        class="wave--bottom"
        :color-wave="'{{$color_wave ?? '#fff'}}'"
        :id="'in_header'"
    ></waves>
</section>
