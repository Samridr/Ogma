{{-- <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des documents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>

</html> --}}


@extends('master')

@section('content')

<body>


    <div class="container text-center">
        <div class="row">
          <div class="col s12">
            <h1>Liste des documents</h1>
            <a href="/index" class="btn btn-primary"> Ajouter un document</a>


            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Adresse</th>
                        <th>Mail</th>
                        <th>Telephone</th>
                        <th>Bulletins</th>
                        <th>Relevé de note</th>
                        <th>Attestation et diplome</th>
                        <th>Naissance, Nationalité, Piece D'identité</th>
                        <th>CV</th>
                        <th>Specialité</th>
                        <th>Dernier niveau d'étude</th>
                        <th>Formation souhaité</th>
                        <th>Situation familiale</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($documents as $document)


                    <tr>
                        <td>{{$document=>nom}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="#" class="btn btn-info">Modifier</a>
                            <a href="#" class="btn btn-danger">Supprimer</a>

                        </td>


                    </tr>
                    @endforeach


                </tbody>

            </table>
          </div>

        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>




@endsection
