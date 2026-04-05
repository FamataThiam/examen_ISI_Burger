@extends('template')

@section('title', 'ISIBurger — Mon Panier')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap');

        .panier-page * { font-family: 'DM Sans', sans-serif; }
        .panier-page h1, .panier-page h2 { font-family: 'Syne', sans-serif; }

        /* ── HERO ── */
        .panier-hero {
            background: #0f172a;
            padding: 56px 24px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .panier-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 60% 80% at 50% 120%, rgba(249,115,22,.25) 0%, transparent 70%);
        }
        .panier-hero h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            color: white;
            position: relative;
            letter-spacing: -1px;
        }
        .panier-hero h1 span { color: #f97316; }
        .panier-hero p {
            color: #94a3b8;
            margin-top: 8px;
            font-size: .95rem;
            position: relative;
        }

        /* ── LAYOUT ── */
        .panier-layout {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 20px 80px;
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 32px;
            align-items: start;
        }
        @media (max-width: 900px) {
            .panier-layout { grid-template-columns: 1fr; }
        }

        /* ── TOOLBAR ── */
        .panier-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .panier-toolbar h2 {
            font-size: 1.3rem;
            color: #0f172a;
        }
        .btn-select-all {
            background: none;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 7px 16px;
            font-size: .85rem;
            font-weight: 600;
            color: #475569;
            cursor: pointer;
            transition: all .2s;
        }
        .btn-select-all:hover { border-color: #f97316; color: #f97316; }

        /* ── CARTE PRODUIT ── */
        .cart-item {
            background: white;
            border-radius: 20px;
            border: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            margin-bottom: 14px;
            transition: all .25s ease;
            position: relative;
            overflow: hidden;
        }
        .cart-item::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background: #e2e8f0;
            transition: background .25s;
        }
        .cart-item.checked {
            border-color: #f97316;
            box-shadow: 0 4px 24px rgba(249,115,22,.12);
        }
        .cart-item.checked::before { background: #f97316; }

        /* Checkbox custom */
        .item-checkbox {
            width: 24px; height: 24px;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            flex-shrink: 0;
            position: relative;
            transition: all .2s;
            background: white;
        }
        .item-checkbox:checked {
            background: #f97316;
            border-color: #f97316;
        }
        .item-checkbox:checked::after {
            content: '✓';
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 13px;
            font-weight: 800;
        }

        /* Image */
        .item-img {
            width: 80px; height: 80px;
            border-radius: 14px;
            object-fit: cover;
            background: #f1f5f9;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 1.5rem;
            overflow: hidden;
        }
        .item-img img { width: 100%; height: 100%; object-fit: cover; }

        /* Infos */
        .item-info { flex: 1; min-width: 0; }
        .item-info h3 {
            font-weight: 700;
            font-size: 1rem;
            color: #0f172a;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .item-cat {
            font-size: .72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: #f97316;
            background: #fff7ed;
            display: inline-block;
            padding: 2px 8px;
            border-radius: 6px;
            margin-top: 4px;
        }
        .item-price {
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 800;
            color: #0f172a;
            margin-top: 8px;
        }
        .item-price small { font-size: .65rem; font-weight: 500; color: #475569; }

        /* Quantité */
        .item-qty {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }
        .qty-btn {
            width: 32px; height: 32px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            background: white;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all .15s;
            display: flex; align-items: center; justify-content: center;
            color: #0f172a;
        }
        .qty-btn:hover { border-color: #f97316; color: #f97316; }
        .qty-value {
            font-weight: 700;
            font-size: 1rem;
            min-width: 20px;
            text-align: center;
        }

        /* Bouton supprimer */
        .btn-remove {
            background: none;
            border: none;
            color: #cbd5e1;
            cursor: pointer;
            font-size: 1.1rem;
            padding: 6px;
            border-radius: 8px;
            transition: all .2s;
            flex-shrink: 0;
        }
        .btn-remove:hover { color: #dc2626; background: #fef2f2; }

        /* ── PANIER VIDE ── */
        .panier-empty {
            text-align: center;
            padding: 80px 20px;
            color: #94a3b8;
        }
        .panier-empty i { font-size: 4rem; margin-bottom: 16px; display: block; }
        .panier-empty p { font-size: 1.1rem; }
        .panier-empty a {
            display: inline-block;
            margin-top: 20px;
            background: #f97316;
            color: white;
            padding: 12px 28px;
            border-radius: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: background .2s;
        }
        .panier-empty a:hover { background: #ea580c; }

        /* ── RÉCAP (colonne droite) ── */
        .recap-card {
            background: white;
            border-radius: 24px;
            border: 2px solid #e2e8f0;
            padding: 28px;
            position: sticky;
            top: 80px;
        }
        .recap-card h2 {
            font-size: 1.2rem;
            color: #0f172a;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid #e2e8f0;
        }
        .recap-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: .9rem;
            color: #475569;
            margin-bottom: 10px;
        }
        .recap-line.total {
            border-top: 2px solid #e2e8f0;
            padding-top: 14px;
            margin-top: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
        }
        .recap-line.total span:last-child {
            font-family: 'Syne', sans-serif;
            font-size: 1.3rem;
            color: #f97316;
        }

        /* Indicateur sélectionnés */
        .recap-selected-count {
            background: #fff7ed;
            border-radius: 12px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: .85rem;
            font-weight: 600;
            color: #ea580c;
            margin-bottom: 20px;
        }

        /* Bouton commander */
        .btn-commander {
            width: 100%;
            padding: 16px;
            background: #f97316;
            color: white;
            border: none;
            border-radius: 16px;
            font-family: 'Syne', sans-serif;
            font-size: 1.1rem;
            font-weight: 800;
            cursor: pointer;
            letter-spacing: .02em;
            transition: all .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 24px;
            box-shadow: 0 8px 24px rgba(249,115,22,.3);
        }
        .btn-commander:hover { background: #ea580c; transform: translateY(-2px); box-shadow: 0 12px 32px rgba(249,115,22,.35); }
        .btn-commander:disabled {
            background: #e2e8f0;
            color: #94a3b8;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Animations */
        @keyframes slide-in {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .cart-item { animation: slide-in .3s ease both; }
        .cart-item:nth-child(1) { animation-delay: .05s }
        .cart-item:nth-child(2) { animation-delay: .10s }
        .cart-item:nth-child(3) { animation-delay: .15s }
        .cart-item:nth-child(4) { animation-delay: .20s }
        .cart-item:nth-child(5) { animation-delay: .25s }

        @keyframes remove-anim {
            to { opacity: 0; transform: scale(.9) translateX(30px); height: 0; padding: 0; margin: 0; border: 0; }
        }
        .cart-item.removing { animation: remove-anim .3s ease forwards; }
    </style>

    <div class="panier-page">

        {{-- HERO --}}
        <div class="panier-hero">
            <h1>Mon <span>Panier</span></h1>
            <p>Sélectionnez les articles à inclure dans votre commande</p>
        </div>

        {{-- LAYOUT --}}
        <div class="panier-layout">

            {{-- COLONNE GAUCHE : liste des produits --}}
            <div>
                <div class="panier-toolbar">
                    <h2>Articles ajoutés</h2>
                    <button class="btn-select-all" onclick="PanierManager.toggleAll()">
                        <i class="fa-regular fa-check"></i>
                        <span id="select-all-label">Tout sélectionner</span>
                    </button>
                </div>

                {{-- La liste sera générée par JS depuis le localStorage --}}
                <div id="cart-list"></div>

                {{-- Message panier vide --}}
                <div id="cart-empty" class="panier-empty" style="display:none;">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <p>Votre panier est vide.</p>
                    <a href="{{ route('catalogue') }}">Découvrir le catalogue</a>
                </div>
            </div>

            {{-- COLONNE DROITE : récapitulatif --}}
            <div>
                <div class="recap-card">
                    <h2>Récapitulatif</h2>

                    <div class="recap-selected-count">
                        <i class="fa-solid fa-circle-check"></i>
                        <span id="recap-selected-text">0 article(s) sélectionné(s)</span>
                    </div>

                    <div id="recap-lines">
                        {{-- lignes générées dynamiquement --}}
                    </div>

                    <div class="recap-line total">
                        <span>Total</span>
                        <span id="recap-total">0 FCFA</span>
                    </div>

                    <button class="btn-commander" id="btn-commander" onclick="PanierManager.commander()" disabled>
                        <i class="fa-solid fa-bag-shopping"></i>
                        Commander
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL CONFIRMATION --}}
    <div id="modal-confirmation" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5); z-index:999; align-items:center; justify-content:center;">
        <div style="background:white; border-radius:24px; padding:36px; max-width:440px; width:90%; text-align:center; animation: slide-in .3s ease;">
            <div style="font-size:3rem; margin-bottom:16px;">🎉</div>
            <h2 style="font-family:'Syne',sans-serif; font-size:1.5rem; color:#0f172a; margin-bottom:8px;">Commande passée !</h2>
            <p style="color:#64748b; margin-bottom:24px;">Votre commande a bien été enregistrée. Nous la préparons.</p>
            <div id="modal-detail" style="background:#fff7ed; border-radius:14px; padding:16px; text-align:left; margin-bottom:24px; font-size:.9rem; color:#0f172a;"></div>
            <button onclick="PanierManager.fermerModal()"
                    style="background:#f97316; color:white; border:none; border-radius:14px; padding:14px 32px; font-family:'Syne',sans-serif; font-weight:800; font-size:1rem; cursor:pointer; width:100%;">
                OK, super !
            </button>
        </div>
    </div>

    <script>
        const PanierManager = {
            items: [],
            checked: {},

            init() {
                this.items = JSON.parse(localStorage.getItem('cart_items') || '[]');
                this.items.forEach(item => {
                    this.checked[item.id] = this.checked[item.id] ?? true;
                });
                this.render();
                this.updateRecap();
            },

            render() {
                const list = document.getElementById('cart-list');
                const empty = document.getElementById('cart-empty');

                if (this.items.length === 0) {
                    list.innerHTML = '';
                    empty.style.display = 'block';
                    this.updateBadgeNav(0);
                    return;
                }
                empty.style.display = 'none';

                list.innerHTML = this.items.map((item, idx) => `
                    <div class="cart-item ${this.checked[item.id] ? 'checked' : ''}" id="item-${item.id}" style="animation-delay:${idx * 0.05}">
                        <input type="checkbox" class="item-checkbox" ${this.checked[item.id] ? 'checked' : ''} onchange="PanierManager.toggleCheck(${item.id}, this.checked)">
                        <div class="item-img">
                            ${item.image ? `<img src="/storage/${item.image}" alt="${item.libelle}">` : `<i class="fa-solid fa-burger"></i>`}
                        </div>
                        <div class="item-info">
                            <h3>${item.libelle}</h3>
                            <span class="item-cat">${item.categorie ?? 'Menu'}</span>
                            <div class="item-price">
                                ${(item.prix * item.quantite).toLocaleString('fr-FR')} <small>FCFA</small>
                            </div>
                        </div>
                        <div class="item-qty">
                            <button class="qty-btn" onclick="PanierManager.changeQty(${item.id}, -1)">−</button>
                            <span class="qty-value">${item.quantite}</span>
                            <button class="qty-btn" onclick="PanierManager.changeQty(${item.id}, +1)">+</button>
                        </div>
                        <button class="btn-remove" onclick="PanierManager.remove(${item.id})" title="Retirer">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                `).join('');
                this.updateSelectAllLabel();
            },

            toggleCheck(id, isChecked) {
                this.checked[id] = isChecked;
                document.getElementById(`item-${id}`)?.classList.toggle('checked', isChecked);
                this.updateRecap();
                this.updateSelectAllLabel();
            },

            toggleAll() {
                const allChecked = this.items.every(i => this.checked[i.id]);
                this.items.forEach(i => { this.checked[i.id] = !allChecked; });
                this.render();
                this.updateRecap();
            },

            updateSelectAllLabel() {
                const allChecked = this.items.length > 0 && this.items.every(i => this.checked[i.id]);
                document.getElementById('select-all-label').textContent = allChecked ? 'Tout désélectionner' : 'Tout sélectionner';
            },

            changeQty(id, delta) {
                const item = this.items.find(i => i.id === id);
                if (!item) return;
                item.quantite = Math.max(1, item.quantite + delta);
                this.save();
                this.render();
                this.updateRecap();
            },

            remove(id) {
                const card = document.getElementById(`item-${id}`);
                if (card) {
                    card.classList.add('removing');
                    setTimeout(() => {
                        this.items = this.items.filter(i => i.id !== id);
                        delete this.checked[id];
                        this.save();
                        this.render();
                        this.updateRecap();
                    }, 300);
                }
            },

            updateRecap() {
                const selected = this.items.filter(i => this.checked[i.id]);
                const count = selected.length;
                const total = selected.reduce((sum, i) => sum + i.prix * i.quantite, 0);

                document.getElementById('recap-selected-text').textContent = `${count} article${count > 1 ? 's' : ''} sélectionné${count > 1 ? 's' : ''}`;
                document.getElementById('recap-lines').innerHTML = selected.map(i => `
                    <div class="recap-line">
                        <span>${i.libelle} ×${i.quantite}</span>
                        <span>${(i.prix * i.quantite).toLocaleString('fr-FR')} FCFA</span>
                    </div>
                `).join('') || '<p style="color:#94a3b8;font-size:.85rem;text-align:center;margin-bottom:8px;">Aucun article sélectionné</p>';

                document.getElementById('recap-total').textContent = total.toLocaleString('fr-FR') + ' FCFA';
                document.getElementById('btn-commander').disabled = count === 0;

                this.updateBadgeNav(this.items.reduce((s, i) => s + i.quantite, 0));
            },

            updateBadgeNav(count) {
                localStorage.setItem('cart_count', count);
                document.querySelectorAll('.isi-nav__badge').forEach(b => {
                    b.textContent = count;
                    b.style.display = count > 0 ? 'flex' : 'none';
                });
            },

            save() {
                localStorage.setItem('cart_items', JSON.stringify(this.items));
            },

            /* ── APPEL AU CONTROLLER ── */
            commander() {
                const selected = this.items.filter(i => this.checked[i.id]);
                const total = selected.reduce((sum, i) => sum + i.prix * i.quantite, 0);

                fetch('{{ route("commandes.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        produits: selected,
                        total: total
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log("REPONSE SERVEUR :", data);

                        if (data.success) {
                            this.afficherConfirmation(selected, total);

                            const commandedIds = selected.map(i => i.id);
                            this.items = this.items.filter(i => !commandedIds.includes(i.id));
                            commandedIds.forEach(id => delete this.checked[id]);
                            this.save();
                        } else {
                            alert("ERREUR : " + data.error);
                        }
                    })
                    .catch(err => console.error("Erreur:", err));
            },

            afficherConfirmation(selected, total) {
                const detail = document.getElementById('modal-detail');
                detail.innerHTML = selected.map(i => `
                    <div style="display:flex;justify-content:space-between;padding:4px 0;border-bottom:1px solid #fed7aa;">
                        <span>${i.libelle} ×${i.quantite}</span>
                        <strong>${(i.prix * i.quantite).toLocaleString('fr-FR')} FCFA</strong>
                    </div>`).join('') +
                    `<div style="display:flex;justify-content:space-between;padding:8px 0;font-weight:700;">
                        <span>Total</span><span>${total.toLocaleString('fr-FR')} FCFA</span>
                    </div>`;
                document.getElementById('modal-confirmation').style.display = 'flex';
            },

            fermerModal() {
                document.getElementById('modal-confirmation').style.display = 'none';
                this.render();
                this.updateRecap();
            }
        };

        document.addEventListener('DOMContentLoaded', () => PanierManager.init());
    </script>
@endsection
