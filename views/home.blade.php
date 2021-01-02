@extends('layouts.app')

@section('title', trans('messages.home'))

@section('content')
<div id="carouselExampleIndicators" class="carousel slide mb-4" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-slide-to="0" class="active"></li>
            <li data-slide-to="1"></li>
            <li data-slide-to="2"></li>
            <li data-slide-to="3"></li>
            <li data-slide-to="4"></li>
            <li data-slide-to="5"></li>
            <li data-slide-to="6"></li>
            <li data-slide-to="7"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item home-background active">
                <img class="d-block carousel-image" src="https://cite-balkoura.fr/storage/img/background1.png">
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p></p>
                </div>
            </div>
            <div class="carousel-item home-background">
                <img class="d-block carousel-image" src="https://cite-balkoura.fr/storage/img/background2.png">
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p></p>
                </div>
            </div>
            <div class="carousel-item home-background">
                <img class="d-block carousel-image" src="https://cite-balkoura.fr/storage/img/background3.png">
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p></p>
                </div>
            </div>
            <div class="carousel-item home-background">
                <img class="d-block carousel-image" src="https://cite-balkoura.fr/storage/img/background4.png">
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p></p>
                </div>
            </div>
            <div class="carousel-item home-background">
                <img class="d-block carousel-image" src="https://cite-balkoura.fr/storage/img/background5.png">
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p></p>
                </div>
            </div>
            <div class="carousel-item home-background">
                <img class="d-block carousel-image" src="https://cite-balkoura.fr/storage/img/background6.png">
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p></p>
                </div>
            </div>
            <div class="carousel-item home-background">
                <img class="d-block carousel-image" src="https://cite-balkoura.fr/storage/img/background7.png">
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p></p>
                </div>
            </div>
            <div class="carousel-item home-background">
                <img class="d-block carousel-image" src="https://cite-balkoura.fr/storage/img/background8.png">
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p></p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Précédent</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Suivant</span>
        </a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach($posts as $post)
                    <div class="post-preview card mb-3 shadow-sm">
                        @if($post->hasImage())
                            <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h3>
                            <p class="card-text">{{ Str::limit(strip_tags($post->content), 250) }}</p>
                            <a class="btn btn-primary"
                            href="{{ route('posts.show', $post) }}">{{ trans('messages.posts.read') }}</a>
                        </div>
                        <div class="card-footer text-muted">
                            {{ trans('messages.posts.posted', ['date' => format_date($post->published_at), 'user' => $post->author->name]) }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4">
                <iframe src="https://discordapp.com/widget?id=554074223870738433&theme=dark" title="Discord" height="500" class="discord-widget shadow mb-3" allowtransparency="true"></iframe>
            </div>
        </div>
    </div>
@endsection
