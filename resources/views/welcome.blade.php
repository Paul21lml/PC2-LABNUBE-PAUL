<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<div class="container">
    <div class="row">
        <h1>PC-02</h1>
        <form method="post" action="{{route('guardar')}}" enctype="multipart/form-data">
            @csrf
        <div class="input-field col s12">
            <input id="descripcion" type="text" class="validate" name="descripcion">
            <label for="descripcion">Descripcion</label>
        </div>
        <div class="input-field col s12">
            <input id="precio" type="number" class="validate" name="precio">
            <label for="precio">Precio</label>
        </div>
        <div class="input-field col s12">
            <input id="categoria" type="text" class="validate" name="categoria">
            <label for="categoria">Categoria</label>
        </div>
        <input type="file" name="foto">
        <br>
        <br>
        <br>
        <button type="submit" class="waves-effect waves-light btn">Enviar</button>
        </form>
        <table class="centered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Categoria</th>
                <th>Foto</th>
                <th>Opciones</th>
            </tr>
            </thead>

            <tbody>
            @foreach($imagenes as $imagen)
            <tr>
                <td>{{$imagen->id}}</td>
                <td>{{$imagen->descripcion}}</td>
                <td>{{$imagen->precio}}</td>
                <td>{{$imagen->categoria}}</td>
                <td>{{$imagen->foto}}</td>
                <td> <!-- Modal Trigger -->
                    <a class="waves-effect waves-light btn modal-trigger yellow accent-4" href="#modal1{{$imagen->id}}"><i class="material-icons left">edit</i></a>

                    <!-- Modal Structure -->
                    <div id="modal1{{$imagen->id}}" class="modal">
                        <div class="modal-content">
                            <form method="post" action="{{route('actualizar',['id'=>$imagen->id])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="input-field col s12">
                                    <input id="descripcion" type="text" class="validate" name="descripcion" value="{{$imagen->descripcion}}">
                                    <label for="descripcion">Descripcion</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="precio" type="number" class="validate" name="precio" value="{{$imagen->precio}}">
                                    <label for="precio">Precio</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="categoria" type="text" class="validate" name="categoria" value="{{$imagen->categoria}}">
                                    <label for="categoria">Categoria</label>
                                </div>
                                <input type="file" name="foto">
                                <br>
                                <br>
                                <br>
                                <button type="submit" class="waves-effect waves-light btn green accent-3">Guardar</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                        </div>
                    </div>
                    <a href="{{url('/eliminar/'.$imagen->id)}}" class="waves-effect waves-light btn modal-trigger red"><i class="material-icons left">delete</i></a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
<!--JavaScript at end of body for optimized loading-->
<script
    src="https://code.jquery.com/jquery-3.4.1.slim.js"
    integrity="sha256-BTlTdQO9/fascB1drekrDVkaKd9PkwBymMlHOiG+qLI="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        var instances = M.Modal.init(elems, options);
    });

    // Or with jQuery

    $(document).ready(function(){
        $('.modal').modal();
    });

</script>
</body>
</html>

