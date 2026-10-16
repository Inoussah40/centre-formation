@extends('layouts.app')

@section('title', 'Détails de la formation')

@section('content')

```
<h1>Détails de la formation</h1>

<p>
    <strong>Nom :</strong>
    {{ $formation->nom }}
</p>

<p>
    <strong>Description :</strong>
    {{ $formation->description }}
</p>

<p>
    <strong>Durée :</strong>
    {{ $formation->duree }} mois
</p>

<p>
    <strong>Prix :</strong>
    {{ $formation->prix }}
</p>

<p>
    <strong>Statut :</strong>
    {{ $formation->statut }}
</p>

<hr>

<h2>Formateur</h2>

@if ($teacher)

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
        <strong>Spécialité :</strong>
        {{ $teacher->specialite }}
    </p>

@else

    <p>
        Aucun formateur n'est associé à cette formation.
    </p>

@endif

<br>

<a href="{{ route('formations.index') }}">
    Retour à la liste
</a>

<br><br>

<a href="{{ route('formations.edit', $formation->id) }}">
    Modifier cette formation
</a>
```

@endsection
