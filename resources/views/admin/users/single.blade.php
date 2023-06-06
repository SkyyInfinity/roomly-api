@extends('layouts.app')
 
@section('title', 'Utilisateur n°' . $user->id)
 
@section('content')
    <div class="container mx-auto">
        <h1 class="text-4xl font-bold mb-8">{{ $user->first_name }} {{ $user->last_name }}</h1>
        {{-- get user info --}}
        <div class="flex flex-col">
            <div class="flex flex-row mb-4">
                <div class="w-1/2">
                    <p class="font-bold">Nom</p>
                    <p>{{ $user->first_name }}</p>
                </div>
                <div class="w-1/2">
                    <p class="font-bold">Prénom</p>
                    <p>{{ $user->last_name }}</p>
                </div>
            </div>
            <div class="flex flex-row mb-4">
                <div class="w-1/2">
                    <p class="font-bold">Email</p>
                    <p>{{ $user->email }}</p>
                </div>
                <div class="w-1/2">
                    <p class="font-bold">Role</p>
                    <p>{{ $user->roles }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection