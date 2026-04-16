<div class="space-y-12">
    <div class="text-center">
        <h1 class="text-4xl font-black text-primario-900">
            Eventos
        </h1>
        <div class="h-1 w-20 bg-primario-500 mx-auto mt-4 rounded-full"></div>
    </div>

    <div class="bg-white p-2 rounded-2xl shadow-sm border border-gray-200 flex flex-col md:flex-row gap-2">
        <input type="text" placeholder="Buscar por nombre..." class="flex-1 border-none focus:ring-0 rounded-xl py-4 px-6 text-gray-700">
        
        <select class="border-none focus:ring-0 text-gray-500 bg-transparent px-4">
            <option>Todas las categorías</option>
        </select>

        <button class="bg-primario-500 hover:bg-primario-600 text-white px-8 py-4 rounded-xl font-bold transition shadow-lg shadow-primario-100 uppercase tracking-wider">
            Buscar
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-10">
        <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="h-48 bg-gray-100 relative">
                <div class="w-full h-full flex items-center justify-center text-gray-300">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <div class="p-6">
                <p class="text-primario-500 text-xs font-bold uppercase tracking-widest mb-2">Conferencia</p>
                <h3 class="text-xl font-bold text-gray-900 group-hover:text-primario-600 transition">Título del Evento</h3>
                <div class="mt-4 text-gray-500 text-sm space-y-2">
                    <p>📍 Lugar del evento</p>
                    <p>📅 15 de Mayo, 2026</p>
                </div>
                <button class="w-full mt-6 bg-gray-50 text-primario-600 hover:bg-primario-500 hover:text-white py-3 rounded-xl font-bold transition">
                    Ver detalles
                </button>
            </div>
        </div>
    </div>
</div>