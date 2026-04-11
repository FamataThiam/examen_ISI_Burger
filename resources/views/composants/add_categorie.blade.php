<div id="modal-category" class="fixed inset-0 flex items-center justify-center bg-black/60 backdrop-blur-sm z-50" style="display:none; opacity:0; transition: opacity 0.3s ease;">

    <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl">

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-bold text-slate-800">Nouvelle Catégorie</h3>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <button onclick="toggleModal('modal-category')" class="text-slate-400 hover:text-slate-600">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nom de la catégorie</label>
                <input type="text" name="libelle" required class="w-full px-4 py-3 rounded-xl bg-slate-100 focus:ring-2 focus:ring-orange-500">
            </div>
            <div class="flex gap-4">
                <button type="button" onclick="toggleModal('modal-category')" class="flex-1 bg-gray-200 py-3 rounded-xl">Annuler</button>
                <button type="submit" class="flex-1 bg-orange-500 text-white py-3 rounded-xl">Enregistrer</button>
            </div>
        </form>

    </div>
</div>

<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) {
            console.error('Modal introuvable : ' + modalId);
            return;
        }

        const isHidden = modal.style.display === 'none' || modal.style.display === '';

        if (isHidden) {
            modal.style.display = 'flex';
            modal.style.alignItems = 'center';
            modal.style.justifyContent = 'center';
            setTimeout(() => { modal.style.opacity = '1'; }, 10);
        } else {
            modal.style.opacity = '0';
            setTimeout(() => { modal.style.display = 'none'; }, 300);
        }
    }


    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[id^="modal-"]').forEach(function (modal) {
            modal.style.display = 'none';
            modal.style.opacity = '0';
            modal.style.transition = 'opacity 0.3s ease';
        });
    });


    window.addEventListener('click', function (event) {
        if (event.target.id && event.target.id.startsWith('modal-')) {
            toggleModal(event.target.id);
        }
    });
</script>
