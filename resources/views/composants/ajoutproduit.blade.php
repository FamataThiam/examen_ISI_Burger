<div id="modal-burger" class="fixed inset-0 flex items-center justify-center bg-black/60 backdrop-blur-sm z-50 p-4" style="display:none; opacity:0; transition: opacity 0.3s ease;">
    <div class="bg-white rounded-3xl p-8 w-full max-w-4xl shadow-2xl max-h-[95vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-8 border-b pb-4">
            <div>
                <h3 id="modal-title" class="text-2xl font-bold text-slate-800">Ajouter un Nouveau Burger</h3>
                <p id="modal-desc" class="text-slate-500 text-sm">Remplissez les détails pour l'ajouter au catalogue.</p>
            </div>
            <button type="button" onclick="toggleModal('modal-burger')" class="p-2 bg-slate-100 rounded-full text-slate-400 hover:text-orange-500 transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <form id="burger-form" action="{{ route('produits.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div id="method-field"></div> {{-- Pour insérer @method('PUT') dynamiquement --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nom du Burger</label>
                        <input type="text" name="libelle" id="input-libelle" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-200 transition-all outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Prix (FCFA)</label>
                            <input type="number" name="prix" id="input-prix" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-200 transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Stock</label>
                            <input type="number" name="stock" id="input-stock" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-200 transition-all outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Catégorie</label>
                        <select name="categorie_id" id="input-categorie" required class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-200 transition-all outline-none cursor-pointer">
                            @foreach(\App\Models\Categorie::all() as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                        <textarea name="description" id="input-description" rows="4" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-transparent focus:border-orange-500 focus:bg-white focus:ring-2 focus:ring-orange-200 transition-all outline-none resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Image <span id="image-label-info" class="font-normal text-slate-400">(Laisser vide pour garder l'ancienne)</span></label>
                        <input type="file" name="image" id="input-image" class="w-full px-4 py-3 rounded-xl bg-slate-50 border-2 border-dashed border-slate-200 hover:border-orange-300 transition-colors cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700">
                    </div>
                </div>
            </div>

            <div class="mt-10 flex justify-end gap-4 border-t pt-6">
                <button type="button" onclick="toggleModal('modal-burger')" class="px-8 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-100 transition-all">Annuler</button>
                <button type="submit" id="submit-btn" class="px-10 py-3 rounded-xl bg-orange-500 text-white font-bold shadow-lg shadow-orange-200 hover:bg-orange-600 transition-all">
                    Enregistrer le Burger
                </button>
            </div>
        </form>
    </div>
</div>







<script>
function openEditModal(produit) {
const form = document.getElementById('burger-form');
const methodField = document.getElementById('method-field');
const title = document.getElementById('modal-title');
const desc = document.getElementById('modal-desc');
const submitBtn = document.getElementById('submit-btn');
const imageInfo = document.getElementById('image-label-info');

// 1. Changer le titre et l'action du formulaire
title.innerText = "Modifier : " + produit.libelle;
desc.innerText = "Modifiez les informations ci-dessous.";
submitBtn.innerText = "Mettre à jour le Burger";
imageInfo.style.display = "inline";

// 2. Changer l'URL pour pointer vers produits.update
form.action = `/produits/${produit.id}`;

// 3. Ajouter @method('PUT') dynamiquement
methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';

// 4. Remplir les champs avec les données du produit
document.getElementById('input-libelle').value = produit.libelle;
document.getElementById('input-prix').value = produit.prix;
document.getElementById('input-stock').value = produit.stock;
document.getElementById('input-categorie').value = produit.categorie_id;
document.getElementById('input-description').value = produit.description;

// L'image n'est plus obligatoire lors d'une modification
document.getElementById('input-image').required = false;

toggleModal('modal-burger');
}

// Modifier ta fonction toggleModal pour qu'elle réinitialise le mode "Ajout"
// Quand on clique sur le bouton "Nouveau Burger"
function resetToCreateMode() {
const form = document.getElementById('burger-form');
const methodField = document.getElementById('method-field');
const title = document.getElementById('modal-title');
const desc = document.getElementById('modal-desc');
const submitBtn = document.getElementById('submit-btn');
const imageInfo = document.getElementById('image-label-info');

title.innerText = "Ajouter un Nouveau Burger";
desc.innerText = "Remplissez les détails pour l'ajouter au catalogue.";
submitBtn.innerText = "Enregistrer le Burger";
imageInfo.style.display = "none";

form.action = "{{ route('produits.store') }}";
methodField.innerHTML = ''; // Enlever le PUT
form.reset();
document.getElementById('input-image').required = true;
}
</script>
