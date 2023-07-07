@extends('layouts.login')
 
@section('title', 'Connexion')
 
@section('content')
    <div class="flex h-screen overflow-hidden">
        <div style="background-image: url('/images/room.webp')" class="app-info relative flex-1 flex flex-col justify-center p-16 bg-cover bg-center before::content-[''] before:w-full before:h-full before:z-10 before:bg-black/50 before:absolute before:top-0 before:left-0">
            <div class="relative z-20 flex flex-col gap-y-8 w-full max-w-[480px]">
                <h1 class="text-6xl font-extrabold text-white leading-tight">Connectez-vous pour accéder à l'administration</h1>
                <p class="text-lg font-regular text-neutral-300">Un accès pour gérer l'ensemble de votre établissement.</p>
            </div>
        </div>
        <div class="login-form flex-1 flex gap-y-8 flex-col justify-center items-center p-16">
            <div class="logo">
                <img src="{{asset('/images/logo.svg')}}" alt="Roomly logo">
            </div>
            <p class="text-base text-textlighter">Connectez-vous pour accéder à votre espace d'administration</p>
            <form method="POST" action="" class="flex flex-col gap-y-4 w-full max-w-[480px] mx-auto">
                @php(
                    $classes = [
                        "input" => "
                            py-4 
                            px-8 
                            rounded-lg 
                            bg-quaternary 
                            placeholder:text-textlighter 
                            focus:ring-4 
                            focus:ring-primary-light 
                            focus:outline-none
                            border
                            border-transparent
                            focus:border-primary
                            transition
                            text-base
                        ",
                        "button" => "
                            py-4 
                            px-6 
                            bg-primary
                            outline-none
                            text-base
                            font-medium
                            rounded-lg
                            transition
                            hover:brightness-105
                        "
                    ]
                )
                @csrf
                @error('username')
                    <div class="bg-red-100 text-red-500 py-2 px-6 rounded-lg text-sm">{{ $message }}</div>
                @enderror
                @error('password')
                    <div class="bg-red-100 text-red-500 py-2 px-6 rounded-lg text-sm">{{ $message }}</div>
                @enderror
                
                <input 
                    class="{{ $classes["input"] }}"
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Nom d'utilisateur"
                    class="@error('username') is-invalid @enderror"
                >
                <input 
                    class="{{ $classes["input"] }}"
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Mot de passe"
                    class="@error('password') is-invalid @enderror"
                >
             
                <button class="{{ $classes["button"] }}" type="submit">Envoyer</button>
            </form>
        </div>
    </div>
@endsection
