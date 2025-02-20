<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h4>{{ trans('theme::balkoura.footer.about') }}</h4>

            <p>{!! theme_config('footer_description') !!}</p>
        </div>
        <div class="col-md-3 links">
            <h4>{{ trans('theme::balkoura.footer.links') }}</h4>

            <ul class="list-unstyled">
                @foreach(theme_config('footer_links') ?? [] as $link)
                    <li>
                        <a href="{{ $link['value'] }}"><i class="fas fa-chevron-right"></i> {{ $link['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-3 social">
            <h4>{{ trans('theme::balkoura.footer.social') }}</h4>

            <ul class="list-inline">
                @foreach(['twitter', 'youtube', 'discord', 'steam', 'teamspeak', 'instagram'] as $social)
                    @if($socialLink = theme_config("footer_social_{$social}"))
                        <li class="list-inline-item">
                            <a href="{{ $socialLink }}" target="_blank" rel="noreferrer noopener" title="{{ trans('theme::balkoura.links.'.$social) }}"><i class="fab fa-{{ $social }} fa-2x"></i></a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <hr>

    <div class="row footer-bottom">
        <div class="col-md-6">
            {{ setting('copyright') }}
        </div>
        <div class="col-md-6 text-right">
            Propulsé par <a href="https://azuriom.com/">Azuriom</a> et designé par <a href="https://github.com/Romitou">Romitou</a>.
        </div>
    </div>
</div>
