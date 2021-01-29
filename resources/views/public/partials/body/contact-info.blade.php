<div class="contact__info">
    <h2>{{ $contact_title ?? '' }}</h2>

    @foreach($body['contacts'] as $key => $item)
        <span class="contact__title">{{ $item['title'] }}:</span>
        @if(isset( $item['sub_title'] ))
            <p class="contact__location">
                {{ $item['sub_title'] }}:
            </p>
        @endif
        <div class="contact__stack">
            @if(isset($item['phone']))
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $item['phone']) }}" class="contact__phone">
                    {{ $item['phone'] }}
                </a>
            @endif
            @if(isset($item['email']))
                <a href="email:{{ $item['email'] }}" class="contact__email">
                    {{ $item['email'] }}
                </a>
            @endif
        </div>
    @endforeach


</div>
