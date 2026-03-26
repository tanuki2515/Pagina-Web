@extends('layouts.app')

@section('title', 'Admin - Usuarios')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-100 mb-8">Usuarios</h1>

    <div class="bg-gray-900 rounded-xl border border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Rol</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Registrado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-800/50">
                            <td class="px-4 py-3 text-gray-400">{{ $user->id }}</td>
                            <td class="px-4 py-3 text-gray-200 font-medium">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-gray-400">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-xs font-medium {{ $user->role === 'admin' ? 'bg-yellow-900/50 text-yellow-400' : 'bg-blue-900/50 text-blue-400' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-400 text-sm">{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection
