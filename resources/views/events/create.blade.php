
@extends('layouts.main')

@section( 'titulo' , 'criar evento')
@section( 'conteudo' )

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Crie o seu evento</h1>
    <form action="/events" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="image">Imagem do evento</label>
            <input type="file" id="image" name="image"  class="form-control-file">
        </div>

        <div class="form-group">
            <label for="title">Evento</label>
            <input type="text" name="title"  id="title" class="form-control" placeholder="Título do Evento">
        </div>

        <div class="form-group">
            <label for="date">Data do evento:</label>
            <input type="date" name="date"  id="date" class="form-control" >
        </div>

        <div class="form-group">
            <label for="city">Cidade:</label>
            <input type="text" name="city"  id="city" class="form-control" placeholder="Cidade do Evento">
        </div>

        <div class="form-group">
            <label for="private">O evento é privado?</label>
            <select name="private" id="private">
                <OPtion value="0">Não</OPtion>
                <OPtion value="1">sim</OPtion>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Descrição:</label>
            <textarea name="description"  id="description" class="form-control" placeholder="descrição do Evento"></textarea>
        </div>

        <div class="form-group">
            <label >Adcione itens de infraestrutura::</label>
            <div class="for-group">
                <input type="checkbox" name="itens[]" value="cadeiras"> Cadeiras
            </div>
            <div class="for-group">
                <input type="checkbox" name="itens[]" value="palco"> Palco
            </div>
            <div class="for-group">
                <input type="checkbox" name="itens[]" value="cerveja gratis"> Cerveja gratis
            </div>
            <div class="for-group">
                <input type="checkbox" name="itens[]" value="open food"> Open food
            </div>
            <div class="for-group">
                <input type="checkbox" name="itens[]" value="brindes"> Brindes
            </div>
        </div>



        <input type="submit" class="btn btn-primary" value="Criar evento">

    </form>
</div>


@endsection
