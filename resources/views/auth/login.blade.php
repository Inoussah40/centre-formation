<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Centre de formation</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #1e3a8a;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .remember {
            margin-top: 15px;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: #1d4ed8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1e40af;
        }

        .error {
            color: #b91c1c;
            margin-top: 12px;
        }

        .success {
            color: #15803d;
            margin-top: 12px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Connexion</h1>
        <p style="text-align: center;">Centre de formation</p>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <label for="email">Adresse e-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
            >

            <label for="password">Mot de passe</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            >

            <div class="remember">
                <input type="checkbox" id="remember" name="remember" value="1">
                <label for="remember" style="display: inline;">Se souvenir de moi</label>
            </div>

            <button type="submit">Se connecter</button>
        </form>
    </div>

</body>
</html>
