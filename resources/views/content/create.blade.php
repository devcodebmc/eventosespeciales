<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Receta') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <form action="#" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg">
            @csrf
            @method('POST')
        </form>
    </div>
</x-app-layout>