@extends('layouts.app')
 
@section('title', 'Liste des utilisateurs')
 
@section('content')
    <div class="">
        <h1 class="text-4xl font-bold mb-8">Liste des utilisateurs</h1>
        {{-- users table list --}}
        <table class="w-full block overflow-auto">
            <thead class="w-full block rounded-lg bg-slate-50">
                <tr class="flex">
                    <th class="p-3 min-w-[300px] text-left">Prénom</th>
                    <th class="p-3 min-w-[300px] text-left">Nom</th>
                    <th class="p-3 min-w-[300px] text-left">Email</th>
                    <th class="p-3 min-w-[300px] text-left">Roles</th>
                </tr>
            </thead>
            <tbody class="w-full flex flex-col">
                @foreach ($users as $user)
                    <tr class="border-b border-slate-300 flex w-full">
                        <td class="p-3 min-w-[300px]">{{ $user->first_name }}</td>
                        <td class="p-3 min-w-[300px]">{{ $user->last_name }}</td>
                        <td class="p-3 min-w-[300px]">{{ $user->email }}</td>
                        <td class="p-3 min-w-[300px] flex flex-wrap gap-2 items-center">
                            @foreach (json_decode($user->roles) as $role)
                                <span class="bg-violet-100 text-violet-500 block px-2 py-1 w-max h-max rounded-full uppercase text-xs m-0">{{ $role }}</span>
                            @endforeach
                        </td>
                        <td class="p-3 min-w-[300px] flex flex-wrap gap-2 items-center">
                            <a href="{{ route('admin.users.single', $user) }}" class="text-blue-500 hover:text-blue-700">Modifier</a>
                            <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button onClick="deleteUser" type="submit" class="text-red-500 hover:text-red-700">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection