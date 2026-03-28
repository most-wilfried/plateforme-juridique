<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme Juridique</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#EDEDCE] flex flex-col min-h-screen">

<!-- HEADER -->
<header class="bg-[#0C2C55] text-white p-4 flex justify-between items-center">

    <!-- Logo -->
    <h1 class="text-xl font-bold text-[#629FAD]">
        Juridique
    </h1>

    <!-- Menu -->
    <nav class="space-x-6">
        <a href="{{ route('accueil') }}" class="hover:text-[#629FAD]">Accueil</a>
        <a href="#" class="hover:text-[#629FAD]">À propos</a>
        <a href="#" class="hover:text-[#629FAD]">Avocats</a>
    </nav>

    <!-- Bouton connexion -->
    <div>
        @auth
            <a href="/dashboard" class="bg-[#629FAD] px-4 py-2 rounded">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="bg-[#629FAD] px-4 py-2 rounded">
                Connexion
            </a>
        @endauth
    </div>

</header>

<!-- CONTENU PRINCIPAL -->
<main class="flex-grow">

    <!-- SECTION PRINCIPALE -->
    <section class="text-center py-20">

        <h2 class="text-4xl font-bold mb-4 text-[#0C2C55]">
            Bienvenue sur la plateforme juridique
        </h2>

        <p class="text-lg text-gray-700 mb-6">
            Consultez des avocats professionnels en ligne et obtenez des conseils juridiques rapidement.
        </p>

        <!-- Bouton principal -->
        @auth
            <a href="#" class="bg-[#0C2C55] text-white px-6 py-3 rounded-lg">
                Contacter un avocat
            </a>
        @else
            <a href="{{ route('login') }}" class="bg-[#0C2C55] text-white px-6 py-3 rounded-lg">
                Se connecter pour contacter
            </a>
        @endauth

    </section>

    <!-- SECTION AVOCATS -->
    <section class="py-16 px-6">

        <h3 class="text-2xl font-bold text-center mb-10 text-[#0C2C55]">
            Nos avocats
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Avocat 1 -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="font-bold text-lg">Maître Dupont</h4>
                <p class="text-gray-600">Droit civil</p>

                @auth
                    <a href="#" class="mt-4 inline-block bg-[#296374] text-white px-4 py-2 rounded">
                        Contacter
                    </a>
                @else
                    <a href="{{ route('login') }}" class="mt-4 inline-block bg-[#296374] text-white px-4 py-2 rounded">
                        Se connecter
                    </a>
                @endauth
            </div>

            <!-- Avocat 2 -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="font-bold text-lg">Maître Martin</h4>
                <p class="text-gray-600">Droit pénal</p>

                @auth
                    <a href="#" class="mt-4 inline-block bg-[#296374] text-white px-4 py-2 rounded">
                        Contacter
                    </a>
                @else
                    <a href="{{ route('login') }}" class="mt-4 inline-block bg-[#296374] text-white px-4 py-2 rounded">
                        Se connecter
                    </a>
                @endauth
            </div>

            <!-- Avocat 3 -->
            <div class="bg-white p-6 rounded-xl shadow">
                <h4 class="font-bold text-lg">Maître Bernard</h4>
                <p class="text-gray-600">Droit des affaires</p>

                @auth
                    <a href="#" class="mt-4 inline-block bg-[#296374] text-white px-4 py-2 rounded">
                        Contacter
                    </a>
                @else
                    <a href="{{ route('login') }}" class="mt-4 inline-block bg-[#296374] text-white px-4 py-2 rounded">
                        Se connecter
                    </a>
                @endauth
            </div>

        </div>

    </section>

</main>

<!-- FOOTER -->
<footer class="bg-[#0C2C55] text-white p-6 text-center">

    <p class="mb-2">© 2026 Plateforme Juridique</p>

    <div class="space-x-4">
        <a href="{{ route('accueil') }}">Accueil</a>
        <a href="#">À propos</a>
        <a href="#">Contact</a>
    </div>

</footer>

</body>
</html>