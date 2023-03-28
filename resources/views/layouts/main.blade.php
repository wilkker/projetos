<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('titulo')</title>

        <!--fonte do goole -->

        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        <!--ccss bootstrapo -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <!--css da aplicação -->
        <link rel="stylesheet" href="/css/styles.css">

        <script src="/js/scripts.js"></script>

    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand">
                        <img src="/img/hc.png" alt="Logo">
                    </a>
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a href="/" class="nav-link">Eventos</a>
                        </li>

                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">criar eventos</a>
                        </li>

                        @auth
                        <li class="nav-item">
                             <a href="/dashboard" class="nav-link">Meus eventos</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" name="logout" action="/logout">
                            @csrf
                            <!-- <a href="javascript:document.logout.submit()" class="nav-link">Sair</a>-->
                           <a href="/logout" onclick="event.preventDefault();this.closest('form').submit();" class="nav-link">Sair</a>
                            </form>
                        </li>
                        <li class="nav-item">
                             <strong><a href="/dashboard" class="nav-link">{{$event->user->name}}</a></strong>
                        </li>

                        @endauth

                        @guest
                        <li class="nav-item">
                             <a href="/login" class="nav-link">entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">cadastrar</a>
                        </li>
                        @endguest
                    </ul>
                    </a>

                </div>
            </nav>
        </header>

        <main>
                <div class="container-fluid">
                    <div class="row">
                        @if(session('msg'))
                        <p class="msg">{{session('msg')}}</p>
                        @endif
                        @yield('conteudo')
                    </div>
                </div>
        </main>

        <footer>
            <p>HDC EVENTS &copy; 2020</p>
        </footer>
        <script type ="module" src ="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>


    </body>
</html>
