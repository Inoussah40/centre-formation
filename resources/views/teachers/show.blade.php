@extends('layouts.app')

@section('title', 'Détails du formateur')

@section('content')

```
<h1>Détails du formateur</h1>

<p>
    <strong>Nom :</strong>
    {{ $teacher->nom }}
</p>

<p>
    <strong>Prénom :</strong>
    {{ $teacher->prenom }}
</p>

<p>
    <strong>Email :</strong>
    {{ $teacher->email }}
</p>

<p>
    <strong>Téléphone :</strong>
    {{ $teacher->telephone }}
</p>

<p>
    <strong>Spécialité :</strong>
    {{ $teacher->specialite }}
</p>

<hr>

<h2>Formations de ce formateur</h2>

@if ($formations->count() > 0)

    <ul>

        @foreach ($formations as $formation)

            <li>
                {{ $formation->nom }}
                - {{ $formation->duree }} mois
                - {{ $formation->prix }}
            </li>

        @endforeach

    </ul>

@else

    <p>
        Ce formateur n'a aucune formation.
    </p>

@endif

<br>

<a href="{{ route('teachers.index') }}">
    Retour à la liste
</a>
```

@endsection
