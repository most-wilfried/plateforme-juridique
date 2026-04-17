<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuriConseil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F8FAFC] text-[#1A2B42] font-sans">

    @include('partials.header')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Bouton scroll to bottom -->
    <button id="scrollToBottom" class="fixed bottom-6 right-6 z-50 hidden h-12 w-12 items-center justify-center rounded-full bg-[#1A2B42] text-white shadow-lg hover:bg-[#15203a] md:flex">
        <span class="text-lg">↓</span>
    </button>

    <script>
        document.getElementById('scrollToBottom').addEventListener('click', function() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        });

        window.addEventListener('scroll', function() {
            const button = document.getElementById('scrollToBottom');
            if (window.scrollY > 100) {
                button.classList.remove('hidden');
            } else {
                button.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
