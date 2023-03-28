@extends('layouts.main')

@section( 'titulo' , 'HDC EVENTOS')


@section( 'conteudo' )

    <div id="search-container" class="col-md-12">
        <h1>Proximo evento</h1>
        <form action="/" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="Procurar" >
        </form>
    </div>
    <div id="events-container" class="col-md-12">
       @if($search)
       <h2 class="subtitle">Buscando por: {{$search}}</h2>
       @else
       <h2 class="subtitle">Proximos Eventos</h2>
       @endif

       <h2 class="subtitle">Proximos Eventos</h2>
        <p>Veja os Eventos dos proximos dias</p>
        <div id="cards-container" class="row">
            @foreach($events as $event)
                <div class="card col-md-3">
                    <img src="/img/events/{{$event->image}}" alt="{{$event->title}}">
                    <div class="card-body">
                        <p class="card-date">{{date('d/m/y', strtotime($event->date)) }}</p>
                        <h5 class="card-title">{{$event->title}}</h5>
                        <p class="card-participantes">X participantes</p>
                        <a href="/events/{{$event->id}}" class="btn btn-primary">Saber mais</a>
                    </div>
                </div>

            @endforeach
            @if(count($events) == 0 && $search)
            <p>Não foi possivel encontrar nnehum evento com: {{$search}}! <a href="/">Ver todos os eventos</a> </p>
            @elseif(count($events) == 0)
            <p>Não há eventos disponíveis </p>
            @endif
        </div>

    </div>




@endsection
