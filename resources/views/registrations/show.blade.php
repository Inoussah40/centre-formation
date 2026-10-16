@extends('layouts.app')

@section('title', 'Détails de l’inscription')

@section('content')

```
<h1>Détails de l'inscription</h1>

<p>
    <strong>Étudiant :</strong>

    @if ($registration->student)
        {{ $registration->student->nom }}
        {{ $registration->student->prenom }}
    @else
        Étudiant introuvable
    @endif
</p>

<p>
    <strong>Formation :</strong>

    @if ($registration->formation)
        {{ $registration->formation->nom }}
    @else
        Formation introuvable
    @endif
</p>

<p>
    <strong>Date d'inscription :</strong>
    {{ $registration->date_inscription }}
</p>

<p>
    <strong>Statut :</strong>
    {{ $registration->statut }}
</p>

<br>

<a href="{{ route('registrations.index') }}">
    Retour à la liste
</a>

<br><br>

<a href="{{ route('registrations.edit', $registration->id) }}">
    Modifier cette inscription
</a>
```

@endsection
