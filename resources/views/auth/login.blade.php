<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EzOffice - Login</title>
	<meta name="author" content="EzOffice">
    <meta name="description" content="">

    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .body-bg {
            background-color: #9921e8;
            background-image: linear-gradient(315deg, #9921e8 0%, #5f72be 74%);
        }
    </style>
</head>
<body class="body-bg min-h-screen pt-12 md:pt-20 pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif;">
    <header class="max-w-lg mx-auto">
        <a href="#">
            <h1 class="text-4xl font-bold text-white text-center">EzOffice</h1>
        </a>
    </header>

    <main class="bg-white max-w-lg mx-auto p-8 md:p-12 my-10 rounded-lg shadow-2xl">
        <section>
            <h3 class="font-bold text-2xl">Bem vindo a EzOffice</h3>
            <p class="text-gray-600 pt-2">Entre com sua conta:</p>
        </section>

        <section class="mt-10">
            <form class="flex flex-col" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-jet-label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3" type="email" name="email" :value="old('email')" required autofocus />
                </div>
    
                <div class="mt-4">
                    <x-jet-label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password" value="{{ __('Senha') }}" />
                    <x-jet-input id="password" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-purple-600 transition duration-500 px-3 pb-3" type="password" name="password" required autocomplete="current-password" />
                </div>
    
                <div class="block mt-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-gray-600">{{ __('Lembrar de mim') }}</span>
                    </label>
                </div>
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-purple-600 hover:text-purple-700 hover:underline mb-6" href="{{ route('password.request') }}">
                            {{ __('Esqueceu a senha?') }}
                        </a>
                    @endif
    
                    
                </div>
                <x-jet-button class="ml-4">
                    {{ __('Entrar
                        
                        ') }}
                </x-jet-button>
            </form>
        </section>
    </main>

    <div class="max-w-lg mx-auto text-center mt-12 mb-6">
        <p class="text-white">Não tem uma conta? <a href="{{ route('register') }}" class="font-bold hover:underline">Registre-se</a>.</p>
    </div>

    <footer class="max-w-lg mx-auto flex justify-center text-white">
        <a href="#" class="hover:underline">Contato</a>
        <span class="mx-3">•</span>
        <a href="#" class="hover:underline">Privacidade</a>
    </footer>
</body>
</html>
