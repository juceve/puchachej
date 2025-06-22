@extends('layouts.app')

@section('content')
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">

            <div class="mb-3" style="opacity: 0.6">
                <h1>Fraternidad Puchachej</h1>
            </div>
            <img src="{{ asset('template/img/escudo1.jpg') }}" alt="escudo" class="imagen-redonda"
                style="width: 25%; opacity: 0.6;">
            <div class="container">
                <p class="text-center mt-3"><i>Fundada el 24 de Febrero de 2004 en Santa Cruz de la Sierra</i></p>
            </div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#portfolio">Mas información</a>
        </div>
    </header>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Galería</h2>
                @if ($galeria)
                    <h3 class="section-subheading text-muted">{{ $galeria->titulo }}</h3>
                    <h3 class="section-subheading">{{ $galeria->descripcion }}</h3>

                @endif
            </div>
            <div class="row">
                @if ($galeria)
                    @foreach ($galeria->fotos as $foto)
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <div class="portfolio-item">
                                <a class="portfolio-link" data-bs-toggle="modal" href="#modal{{$foto->id}}">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-search fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="{{ Storage::url($foto->url) }}"
                                        alt="Foto-{{ $foto->id }}" />
                                </a>
                            </div>
                        </div>

                        <div class="portfolio-modal modal fade" id="modal{{$foto->id}}" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content bg-dark">
                                    <div class="close-modal" data-bs-dismiss="modal"><i class="fas fa-times fa-3x text-white"></i></div>
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8">
                                                <div class="modal-body">
                                                    <img class="img-fluid d-block mx-auto" src="{{ Storage::url($foto->url) }}"
                                                        alt="..." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
