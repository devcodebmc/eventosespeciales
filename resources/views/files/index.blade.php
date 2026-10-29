<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Archivos') }}
            </h2>
            <p class="text-sm text-gray-500">
                {{ $files->total() }} {{ $files->total() === 1 ? 'archivo' : 'archivos' }}
                @if (request('search'))
                    · resultados para "<span class="font-medium text-gray-700">{{ request('search') }}</span>"
                @endif
            </p>
        </div>
    </x-slot>

    @if (session('success'))
        <div id="flash-message" class="fixed top-20 right-8 flex items-center justify-between p-6 text-sm rounded-lg shadow-md bg-white border border-gray-200 z-50">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-500 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="font-semibold text-gray-900">{{ session('success') }}</p>
            </div>
            <button onclick="document.getElementById('flash-message').style.display='none';" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <script>
            setTimeout(() => document.getElementById('flash-message').style.display = 'none', 4000);
        </script>
    @endif

    @php
        // Helper local para construir URLs de ordenamiento
        $sortUrl = function (string $column) use ($sort, $direction) {
            $newDir = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
            return request()->fullUrlWithQuery(['sort' => $column, 'direction' => $newDir]);
        };
        $sortIcon = function (string $column) use ($sort, $direction) {
            if ($sort !== $column) {
                return '<svg class="w-3 h-3 text-gray-300 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" /></svg>';
            }
            return $direction === 'asc'
                ? '<svg class="w-3 h-3 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" /></svg>'
                : '<svg class="w-3 h-3 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>';
        };
    @endphp

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                {{-- Barra superior --}}
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 py-6 px-4 sm:px-6 border-b border-gray-100">
                    <form method="GET" action="{{ route('files.index') }}" class="flex flex-col sm:flex-row items-stretch gap-3 w-full lg:w-auto">
                        {{-- Conservar sort/direction al buscar --}}
                        <input type="hidden" name="sort" value="{{ $sort }}">
                        <input type="hidden" name="direction" value="{{ $direction }}">

                        <div class="relative flex-grow min-w-[200px]">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar archivos..."
                                   class="w-full border border-gray-300 rounded-md pl-9 pr-3 py-2 text-sm focus:ring-emerald-500 focus:border-emerald-500"/>
                        </div>

                        <select name="status" onchange="this.form.submit()"
                                class="border border-gray-300 rounded-md py-2 px-3 text-sm bg-white focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="all" {{ $status === 'all' ? 'selected' : '' }}>Todos</option>
                            <option value="active" {{ $status === 'active' ? 'selected' : '' }}>Activos</option>
                            <option value="trashed" {{ $status === 'trashed' ? 'selected' : '' }}>Eliminados</option>
                        </select>

                        <button type="submit" class="inline-flex justify-center items-center py-2 px-4 text-sm font-medium rounded-md text-white bg-emerald-500 hover:bg-emerald-600">
                            Buscar
                        </button>
                        @if (request('search') || request('status'))
                            <a href="{{ route('files.index') }}" class="inline-flex justify-center items-center py-2 px-4 text-sm font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200">
                                Limpiar
                            </a>
                        @endif
                    </form>

                    <div class="flex items-center gap-2">
                        {{-- Toggle de vista (oculto en móvil) --}}
                        <div class="hidden md:inline-flex rounded-md border border-gray-300 overflow-hidden" role="group">
                            <button type="button" id="viewTableBtn" onclick="setView('table')"
                                    class="px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 flex items-center"
                                    title="Vista tabla">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h1.5C5.496 19.5 6 18.996 6 18.375m-3.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-1.5A1.125 1.125 0 0 1 18 18.375M20.625 4.5H3.375m17.25 0c.621 0 1.125.504 1.125 1.125M20.625 4.5h-1.5C18.504 4.5 18 5.004 18 5.625m3.75 0v1.5c0 .621-.504 1.125-1.125 1.125M3.375 4.5c-.621 0-1.125.504-1.125 1.125M3.375 4.5h1.5C5.496 4.5 6 5.004 6 5.625m-3.75 0v1.5c0 .621.504 1.125 1.125 1.125m0 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m1.5-3.75C5.496 8.25 6 7.746 6 7.125v-1.5M4.875 8.25C5.496 8.25 6 8.754 6 9.375v1.5m0-5.25v5.25m0-5.25C6 5.004 6.504 4.5 7.125 4.5h9.75c.621 0 1.125.504 1.125 1.125m1.125 2.625h1.5m-1.5 0A1.125 1.125 0 0 1 18 7.125v-1.5m1.125 2.625c-.621 0-1.125.504-1.125 1.125v1.5m2.625-2.625c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125M18 5.625v5.25M7.125 12h9.75m-9.75 0A1.125 1.125 0 0 1 6 10.875M7.125 12C6.504 12 6 12.504 6 13.125m0-2.25C6 11.496 5.496 12 4.875 12M18 10.875c0 .621-.504 1.125-1.125 1.125M18 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m-12 5.25v-5.25m0 5.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125m-12 0v-1.5c0-.621-.504-1.125-1.125-1.125M18 18.375v-5.25m0 5.25v-1.5c0-.621.504-1.125 1.125-1.125M18 13.125v1.5c0 .621.504 1.125 1.125 1.125M18 13.125c0-.621.504-1.125 1.125-1.125M6 13.125v1.5c0 .621-.504 1.125-1.125 1.125M6 13.125C6 12.504 5.496 12 4.875 12m-1.5 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M19.125 12h1.5m0 0c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h1.5m14.25 0h1.5" />
                                </svg>
                                Tabla
                            </button>
                            <button type="button" id="viewCardsBtn" onclick="setView('cards')"
                                    class="px-3 py-2 text-sm text-gray-600 hover:bg-gray-50 border-l border-gray-300 flex items-center"
                                    title="Vista tarjetas">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                                </svg>
                                Cards
                            </button>
                        </div>

                        <a href="{{ route('files.create') }}" class="inline-flex items-center justify-center py-2 px-4 text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Nuevo Archivo
                        </a>
                    </div>
                </div>

                {{-- ============ VISTA TABLA ============ --}}
                {{-- Nota: Sin md:block para que JS controle la visibilidad --}}
                <div id="viewTable" class="hidden p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    <a href="{{ $sortUrl('name') }}" class="group inline-flex items-center gap-1 text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700">
                                        Archivo {!! $sortIcon('name') !!}
                                    </a>
                                </th>
                                <th class="px-4 py-3 text-left">
                                    <a href="{{ $sortUrl('type') }}" class="group inline-flex items-center gap-1 text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700">
                                        Tipo {!! $sortIcon('type') !!}
                                    </a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                                <th class="px-4 py-3 text-left">
                                    <a href="{{ $sortUrl('size') }}" class="group inline-flex items-center gap-1 text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700">
                                        Tamaño {!! $sortIcon('size') !!}
                                    </a>
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-4 py-3 text-left">
                                    <a href="{{ $sortUrl('updated_at') }}" class="group inline-flex items-center gap-1 text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700">
                                        Actualizado {!! $sortIcon('updated_at') !!}
                                    </a>
                                </th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($files as $file)
                                <tr class="hover:bg-gray-50 {{ $file->trashed() ? 'bg-red-50/40' : '' }}">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 w-10 h-10 rounded-md overflow-hidden bg-gray-100 flex items-center justify-center">
                                                @if ($file->type === 'image' && $file->url)
                                                    <img src="{{ $file->url }}" alt="{{ $file->name }}" class="w-10 h-10 object-cover">
                                                @else
                                                    @include('files.partials.type-icon', ['type' => $file->type, 'size' => 'w-5 h-5'])
                                                @endif
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-sm font-medium truncate {{ $file->trashed() ? 'text-gray-400 line-through' : 'text-gray-900' }}">
                                                    {{ $file->name }}
                                                </p>
                                                @if ($file->original_name)
                                                    <p class="text-xs text-gray-400 truncate">{{ $file->original_name }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">@include('files.partials.type-badge', ['type' => $file->type])</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $file->category->name ?? '—' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700 whitespace-nowrap">{{ $file->human_size }}</td>
                                    <td class="px-4 py-3">
                                        @if ($file->trashed())
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Eliminado
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Activo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($file->updated_at)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-end gap-1">
                                            @if ($file->trashed())
                                                <form action="{{ route('files.restore', $file->id) }}" method="POST" class="inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="p-1.5 rounded-md text-emerald-600 hover:bg-emerald-50" title="Restaurar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" /></svg>
                                                    </button>
                                                </form>
                                                <button type="button" class="p-1.5 rounded-md text-red-600 hover:bg-red-50" title="Eliminar definitivamente" onclick="openForceModal({{ $file->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                                </button>
                                            @else
                                                <button type="button" class="p-1.5 rounded-md text-gray-500 hover:bg-gray-100 hover:text-emerald-600" title="Ver"
                                                        onclick="openPreviewModal('{{ $file->type }}', '{{ $file->url }}', '{{ addslashes($file->name) }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                                </button>
                                                <button type="button" class="p-1.5 rounded-md text-gray-500 hover:bg-gray-100 hover:text-indigo-600" title="Copiar URL"
                                                        onclick="copyUrl('{{ $file->url }}', this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" /></svg>
                                                </button>
                                                <a href="{{ route('files.download', $file->id) }}" class="p-1.5 rounded-md text-gray-500 hover:bg-gray-100 hover:text-blue-600" title="Descargar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                                                </a>
                                                <a href="{{ route('files.edit', $file->id) }}" class="p-1.5 rounded-md text-gray-500 hover:bg-gray-100 hover:text-gray-700" title="Editar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                                </a>
                                                <button type="button" class="p-1.5 rounded-md text-gray-500 hover:bg-red-50 hover:text-red-600" title="Mover a papelera" onclick="openModal({{ $file->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                                </button>
                                            @endif
                                        </div>
                                        @include('files.partials.modals', ['file' => $file])
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <svg class="w-14 h-14 mx-auto mb-4 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                        <p class="text-base font-medium text-gray-700">No hay archivos</p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            @if (request('search'))
                                                No se encontraron resultados para "{{ request('search') }}"
                                            @else
                                                Comienza agregando tu primer archivo
                                            @endif
                                        </p>
                                        @if (!request('search'))
                                            <a href="{{ route('files.create') }}" class="inline-flex items-center mt-4 text-sm font-medium text-indigo-600 hover:text-indigo-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                                Subir archivo
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ============ VISTA CARDS ============ --}}
                <div id="viewCards" class="hidden p-4 sm:p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @forelse ($files as $file)
                        <div class="group relative flex flex-col rounded-lg border border-gray-200 bg-white hover:shadow-md transition-shadow overflow-hidden {{ $file->trashed() ? 'opacity-70' : '' }}">
                            <div class="relative h-32 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center overflow-hidden">
                                @if ($file->type === 'image' && $file->url)
                                    <img src="{{ $file->url }}" alt="{{ $file->name }}" class="w-full h-full object-cover">
                                @else
                                    @include('files.partials.type-icon', ['type' => $file->type, 'size' => 'w-12 h-12'])
                                @endif

                                <span class="absolute top-2 right-2 inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-medium {{ $file->trashed() ? 'bg-red-500 text-white' : 'bg-emerald-500 text-white' }}">
                                    {{ $file->trashed() ? 'Eliminado' : 'Activo' }}
                                </span>
                            </div>

                            <div class="p-3 flex-1 flex flex-col">
                                <p class="text-sm font-medium truncate {{ $file->trashed() ? 'text-gray-400 line-through' : 'text-gray-900' }}" title="{{ $file->name }}">
                                    {{ $file->name }}
                                </p>
                                <p class="text-xs text-gray-400 truncate mt-0.5" title="{{ $file->original_name }}">
                                    {{ $file->original_name }}
                                </p>

                                <div class="mt-2 flex items-center gap-2 text-xs text-gray-500">
                                    @include('files.partials.type-badge', ['type' => $file->type, 'small' => true])
                                    <span>{{ $file->human_size }}</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1 truncate">
                                    {{ $file->category->name ?? 'Sin categoría' }}
                                </p>

                                <div class="mt-3 pt-3 border-t border-gray-100 flex items-center justify-between">
                                    @if ($file->trashed())
                                        <form action="{{ route('files.restore', $file->id) }}" method="POST" class="flex-1">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="w-full py-1.5 text-xs font-medium rounded-md text-emerald-700 bg-emerald-50 hover:bg-emerald-100">Restaurar</button>
                                        </form>
                                        <button type="button" onclick="openForceModal({{ $file->id }})" class="ml-2 flex-1 py-1.5 text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100">Eliminar</button>
                                    @else
                                        <div class="flex items-center gap-1">
                                            <button type="button" class="p-1.5 rounded text-gray-500 hover:bg-gray-100 hover:text-emerald-600" title="Ver"
                                                    onclick="openPreviewModal('{{ $file->type }}', '{{ $file->url }}', '{{ addslashes($file->name) }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                                            </button>
                                            <a href="{{ route('files.download', $file->id) }}" class="p-1.5 rounded text-gray-500 hover:bg-gray-100 hover:text-blue-600" title="Descargar">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                                            </a>
                                            <a href="{{ route('files.edit', $file->id) }}" class="p-1.5 rounded text-gray-500 hover:bg-gray-100 hover:text-gray-700" title="Editar">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                            </a>
                                            <button type="button" class="p-1.5 rounded text-gray-500 hover:bg-red-50 hover:text-red-600" title="Mover a papelera" onclick="openModal({{ $file->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                            </button>
                                        </div>
                                        <span class="text-[10px] text-gray-400">{{ \Carbon\Carbon::parse($file->updated_at)->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>
                            @include('files.partials.modals', ['file' => $file])
                        </div>
                    @empty
                        <div class="col-span-full p-12 text-center text-gray-500">
                            <svg class="w-14 h-14 mx-auto mb-4 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            <p class="text-base font-medium text-gray-700">No hay archivos</p>
                        </div>
                    @endforelse
                </div>

                {{-- Paginación --}}
                <div class="px-4 sm:px-6 py-4 border-t border-gray-100">
                    {{ $files->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de preview global --}}
    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-75 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] flex flex-col" id="previewModalContent">
            <div class="flex items-center justify-between px-5 py-3 border-b border-gray-200">
                <h3 id="previewTitle" class="text-base font-semibold text-gray-900 truncate"></h3>
                <button onclick="closePreviewModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div id="previewBody" class="flex-1 overflow-auto p-5 flex items-center justify-center bg-gray-50"></div>
        </div>
    </div>

    <script>
        // ============ Toggle de vista (tabla / cards) ============
        function setView(view) {
            const table = document.getElementById('viewTable');
            const cards = document.getElementById('viewCards');
            const btnTable = document.getElementById('viewTableBtn');
            const btnCards = document.getElementById('viewCardsBtn');

            if (view === 'table') {
                // Mostrar tabla, ocultar cards
                table.classList.remove('hidden');
                cards.classList.add('hidden');
                
                // Estilos de botón activo
                btnTable.classList.add('bg-white', 'shadow-sm', 'text-gray-900', 'font-medium');
                btnCards.classList.remove('bg-white', 'shadow-sm', 'text-gray-900', 'font-medium');
            } else {
                // Mostrar cards, ocultar tabla
                table.classList.add('hidden');
                cards.classList.remove('hidden');
                
                // Estilos de botón activo
                btnCards.classList.add('bg-white', 'shadow-sm', 'text-gray-900', 'font-medium');
                btnTable.classList.remove('bg-white', 'shadow-sm', 'text-gray-900', 'font-medium');
            }
            localStorage.setItem('files_view', view);
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Recuperar vista guardada (por defecto 'table')
            let saved = localStorage.getItem('files_view') || 'table';
            
            // Si la pantalla es menor a 768px, forzar 'cards' visualmente
            if (window.innerWidth < 768) {
                saved = 'cards';
            }
            
            setView(saved);
        });

        // ============ Modales de confirmación ============
        function openModal(id) {
            const modal = document.getElementById('confirmationModal' + id);
            const content = modal.querySelector('#modalContent' + id);
            modal.classList.remove('hidden'); modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }
        function closeModal(id) {
            const modal = document.getElementById('confirmationModal' + id);
            const content = modal.querySelector('#modalContent' + id);
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('opacity-100');
            setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
        }
        function openForceModal(id) {
            const modal = document.getElementById('forceModal' + id);
            const content = modal.querySelector('#forceModalContent' + id);
            modal.classList.remove('hidden'); modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.add('opacity-100');
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }
        function closeForceModal(id) {
            const modal = document.getElementById('forceModal' + id);
            const content = modal.querySelector('#forceModalContent' + id);
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            modal.classList.remove('opacity-100');
            setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
        }

        // ============ Preview modal ============
        function openPreviewModal(type, url, name) {
            const modal = document.getElementById('previewModal');
            document.getElementById('previewTitle').textContent = name;
            const body = document.getElementById('previewBody');
            body.innerHTML = '';

            if (!url) {
                body.innerHTML = '<p class="text-gray-500">Archivo no disponible</p>';
            } else if (type === 'image') {
                body.innerHTML = `<img src="${url}" alt="${name}" class="max-w-full max-h-[75vh] object-contain rounded">`;
            } else if (type === 'pdf') {
                body.innerHTML = `<iframe src="${url}" class="w-full h-[75vh] rounded" frameborder="0"></iframe>`;
            } else {
                body.innerHTML = `
                    <div class="text-center">
                        <p class="text-gray-700 mb-3">Este tipo de archivo no se puede previsualizar.</p>
                        <a href="${url}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Abrir en nueva pestaña</a>
                    </div>`;
            }

            modal.classList.remove('hidden'); modal.classList.add('flex');
        }
        function closePreviewModal() {
            document.getElementById('previewBody').innerHTML = '';
            document.getElementById('previewModal').classList.add('hidden');
            document.getElementById('previewModal').classList.remove('flex');
        }

        // ============ Copiar URL ============
        function copyUrl(url, btn) {
            navigator.clipboard.writeText(url).then(() => {
                const original = btn.innerHTML;
                btn.innerHTML = '<svg class="w-5 h-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>';
                setTimeout(() => { btn.innerHTML = original; }, 1500);
            });
        }

        // ============ Backdrop + ESC ============
        document.querySelectorAll('[id^="confirmationModal"]').forEach(m => m.addEventListener('click', e => {
            if (e.target === m) closeModal(m.id.replace('confirmationModal', ''));
        }));
        document.querySelectorAll('[id^="forceModal"]').forEach(m => m.addEventListener('click', e => {
            if (e.target === m) closeForceModal(m.id.replace('forceModal', ''));
        }));
        document.getElementById('previewModal')?.addEventListener('click', function (e) {
            if (e.target === this) closePreviewModal();
        });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closePreviewModal(); });
    </script>
</x-app-layout>