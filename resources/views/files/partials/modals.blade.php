{{-- Modal: mover a papelera --}}
<div id="confirmationModal{{ $file->id }}" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 transition-opacity duration-300 hidden">
    <div class="bg-white rounded-lg shadow-xl transform transition-all duration-300 scale-95 opacity-0 max-w-md w-full mx-4" id="modalContent{{ $file->id }}">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Mover a la papelera</h3>
                <button onclick="closeModal({{ $file->id }})" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <p class="text-gray-600 mb-6 text-center">
                ¿Mover el archivo <strong class="ml-1">{{ $file->name }}</strong> a la papelera?
                <br>
                <span class="text-sm text-gray-500">Podrás restaurarlo después.</span>
            </p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeModal({{ $file->id }})" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">Cancelar</button>
                <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">Mover a papelera</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal: eliminar definitivamente --}}
<div id="forceModal{{ $file->id }}" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 transition-opacity duration-300 hidden">
    <div class="bg-white rounded-lg shadow-xl transform transition-all duration-300 scale-95 opacity-0 max-w-md w-full mx-4" id="forceModalContent{{ $file->id }}">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Eliminar definitivamente</h3>
                <button onclick="closeForceModal({{ $file->id }})" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <p class="text-gray-600 mb-6 text-center">
                ¿Eliminar permanentemente <strong class="ml-1">{{ $file->name }}</strong>?
                <br>
                <b class="text-red-500">El archivo físico también se borrará. Esta acción no se puede deshacer.</b>
            </p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeForceModal({{ $file->id }})" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">Cancelar</button>
                <form action="{{ route('files.force-destroy', $file->id) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700">Eliminar definitivamente</button>
                </form>
            </div>
        </div>
    </div>
</div>