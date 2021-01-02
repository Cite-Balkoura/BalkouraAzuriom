@extends('admin.layouts.admin')

@section('footer_description', 'Theme config')

@push('footer-scripts')
    <script>
        function addLinkListener(el) {
            el.addEventListener('click', function () {
                const element = el.parentNode.parentNode.parentNode.parentNode;

                element.parentNode.removeChild(element);
            });
        }

        document.querySelectorAll('.link-remove').forEach(function (el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function () {
            let input = '<div class="form-row"><div class="form-group col-md-6">';
            input += '<input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div>';
            input += '<div class="form-group col-md-6"><div class="input-group">';
            input += '<input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}">';
            input += '<div class="input-group-append"><button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="fas fa-times"></i></button></div></div></div></div>';

            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });

        document.getElementById('addLinkButton2').addEventListener('click', function () {
            let input = '<div class="form-row">' +
                '<div class="form-group col-md-1">' +
                '<input type="text" class="form-control" name="carousel_images[{index}][name]" placeholder="Identifiant">' +
                '</div>' +
                '<div class="form-group col-md-3">' +
                '<input type="text" class="form-control" name="carousel_images[{index}][name]" placeholder="Lien">' +
                '</div>' +
                '<br/>' +
                '<div class="form-group col-md-4">' +
                '<div class="input-group">' +
                '<input type="url" class="form-control" name="carousel_images[{index}][value]" placeholder="Titre">' +
                '</div>' +
                '</div>' +
                '' +
                '<div class="form-group col-md-4">' +
                '<div class="input-group">' +
                '<input type="url" class="form-control" name="carousel_images[{index}][value]" placeholder="Sous-titre">' +
                '<div class="input-group-append">' +
                '<button class="btn btn-outline-danger link-remove" type="button">' +
                '<i class="fas fa-times"></i>' +
                '</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';


            const newElement = document.createElement('div');
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('carousel').appendChild(newElement);
        });

        document.getElementById('configForm').addEventListener('submit', function () {
            let i = 0;

            document.getElementById('links').querySelectorAll('.form-row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', i.toString());
                });

                i++;
            });

            i = 0;

            document.getElementById('carousel').querySelectorAll('.form-row').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', i.toString());
                });

                i++;
            });

        });
    </script>
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.themes.config', $theme) }}" method="POST" id="configForm">
                @csrf

                <div class="form-group">
                    <label for="footerDescriptionInput">{{ trans('theme::balkoura.config.footer_description') }}</label>
                    <textarea class="form-control @error('footer_description') is-invalid @enderror" id="footerDescriptionInput" name="footer_description" rows="3">{{ old('footer_description', theme_config('footer_description')) }}</textarea>

                    @error('footer_description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                @foreach(['twitter', 'youtube', 'discord'] as $social)
                    <div class="form-group">
                        <label for="{{ $social }}Input">{{ trans('theme::balkoura.links.'.$social) }}</label>
                        <input type="text" class="form-control @error('footer_social_'.$social) is-invalid @enderror" id="{{ $social }}Input" name="footer_social_{{ $social }}" value="{{ old('footer_social_'.$social, theme_config('footer_social_'.$social)) }}">

                        @error('footer_social_'.$social)
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                @endforeach

                <label>{{ trans('theme::balkoura.config.footer_links') }}</label>

                <div id="links">

                    @foreach(theme_config('footer_links') ?? [] as $link)
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="footer_links[{index}][name]" placeholder="{{ trans('messages.fields.name') }}" value="{{ $link['name'] }}">
                            </div>

                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <input type="url" class="form-control" name="footer_links[{index}][value]" placeholder="{{ trans('messages.fields.link') }}" value="{{ $link['value'] }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger link-remove" type="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-2">
                    <button type="button" id="addLinkButton" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> {{ trans('messages.actions.add') }}
                    </button>
                </div>

                <label>{{ trans('theme::balkoura.config.carousel_images') }}</label>

                <div id="carousel">

                    @foreach(theme_config('carousel_images') ?? [] as $image)
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                <input type="text" class="form-control" name="carousel_images[{index}][id]" placeholder="Identifiant" value="{{ $image['id'] }}">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" name="carousel_images[{index}][image]" placeholder="Lien" value="{{ $image['image'] }}">
                            </div>
                            <br/>
                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="carousel_images[{index}][title]" placeholder="Titre" value="{{ $image['title'] }}">
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="carousel_images[{index}][subtitle]" placeholder="Sous-titre" value="{{ $image['subtitle'] }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger link-remove" type="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mb-2">
                    <button type="button" id="addLinkButton2" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> {{ trans('messages.actions.add') }}
                    </button>
                </div>

                <div class="form-group">
                    <label for="discord-id">{{ trans('theme::balkoura.config.discord-id') }}</label>
                    <textarea class="form-control @error('footer_description') is-invalid @enderror" id="discord-id" name="discord-id" rows="1">{{ old('discord-id', theme_config('discord-id')) }}</textarea>

                    @error('discord-id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ trans('messages.actions.save') }}
                </button>

            </form>
        </div>
    </div>
@endsection
