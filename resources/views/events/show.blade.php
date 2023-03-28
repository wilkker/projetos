
@extends('layouts.main')

@section( 'titulo' ,  $event->title )
@section( 'conteudo' )

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <img src="/img/events/{{$event->image}}" class="image-fluid" alt="{{$event->title}}">
            </div>
            <div id="info-container" class="col-md-6">
                <h1>{{ $event->title }}</h1>
                <p class="event-city"> <ion-icon name="location-outline"></ion-icon> {{$event->city}}</p>
                <p class="events-participantes"><ion-icon name='people-outline'></ion-icon>
                {{ count($event->users) }} {{ count($event->users) <= 1 ? 'Participante' : 'Participantes' }}</p>
                <p class="event-owner"><ion-icon name='star-outline'></ion-icon> {{$eventOwner['name']}}</p>

                @if(!$hasUserJoined)
                <form action="/events/join/{{$event->id}}" method="GET">
                    @csrf

                    <a href="/events/join/{{$event->id}}"
                        class="btn btn-primary"
                        id="event-submit"
                        ondblclick="event.preventDefault();
                        this.closest('form').submit();">
                        Confirmar presença
                    </a>
                </form>
                @else
                    <p class="already-joined-msg">Você já  marcou presença </p>

                @endif

                <h2>O evento conta com:</h2>
                <ul id="items-list">
                    @foreach($event->itens as $iten)
                    <li>
                        <ion-icon  name="play-outline"></ion-icon>
                         <span>{{$iten}}</span>
                    </li>

                    @endforeach
                </ul>
            </div>
            <div class="col-md-12" id="description-container">
                <h3>Sobre o evento</h3>
                <p class="event-description"> {{$event->description}}</p>


            </div>
        </div>
    </div>


@endsection
