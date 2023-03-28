@extends('layouts.main')

@section( 'titulo' , 'Dashboard')


@section( 'conteudo' )

    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus Eventos</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if (count($events)>0)
        <table>
            <thead>
                <tr>
                    <th scope="col" >#</th>
                    <th scope="col" >Nome</th>
                    <th scope="col" >participantes</th>
                    <th scope="col" >Ações</th>
                </tr>
            </thead>
        </table>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <th scope="row">{{$loop->index +1 }}</th>
                    <td><a href="/events/{{$event->id}}">{{$event->title}}</a></td>
                </tr>
            @endforeach
        </tbody>

        @else
        <p>
            Você ainda não tem eventos! <a href="/events/create">Criar Eventos</a>
        </p>

        @endif
    </div>




@endsection
