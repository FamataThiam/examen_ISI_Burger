@extends('template')

@section('content')
    <style>
        .admin-panel { max-width: 1200px; margin: 50px auto; font-family: 'Inter', sans-serif; }
        .header-flex { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 30px; border-bottom: 2px solid #f1f5f9;  }
        .title-area h2 { font-size: 1.8rem; color: #1e293b; margin: 0; }
        .title-area p { color: #64748b; margin: 5px 0 15px 0; }

        .card-table { background: white; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8fafc; padding: 15px 20px; text-align: left; color: #475569; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; }
        td { padding: 20px; border-top: 1px solid #f1f5f9; }

        .client-info b { display: block; color: #1e293b; }
        .client-info span { font-size: 0.85rem; color: #64748b; }

        .status-pill { padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .status-en-attente { background: #fef3c7; color: #92400e; }
        .status-prete { background: #dcfce7; color: #166534; }
        .status-payee { background: #dbeafe; color: #1e40af; }

        .btn-ready {
            background: #f97316; color: white; border: none; padding: 8px 16px;
            border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.85rem;
            transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-ready:hover { background: #ea580c; transform: translateY(-1px); }
        .btn-ready.green { background: #16a34a; }
        .btn-ready.green:hover { background: #15803d; }
        .btn-ready i { font-size: 1rem; }

        .empty-msg { padding: 40px; text-align: center; color: #94a3b8; }
    </style>

    <div class="admin-panel">
        <div class="header-flex">
            <div class="title-area">
                <h2>Gestion des <span>Commandes</span></h2>
                <p>Interface Administrateur — {{ Auth::guard('client')->user()->prenom }}</p>
            </div>
        </div>

        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:12px 20px; border-radius:8px; margin-bottom:20px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background:#fee2e2; color:#991b1b; padding:12px 20px; border-radius:8px; margin-bottom:20px;">
                ❌ {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div style="background:#e0f2fe; color:#0369a1; padding:12px 20px; border-radius:8px; margin-bottom:20px;">
                ℹ️ {{ session('info') }}
            </div>
        @endif

        <div class="card-table">
            <table>
                <thead>
                <tr>
                    <th>Commande</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>État</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($commandes as $commande)
                    <tr>
                        <td><b>#{{ $commande->id }}</b><br><small>{{ $commande->created_at->diffForHumans() }}</small></td>
                        <td class="client-info">
                            <b>{{ $commande->client->prenom }} {{ $commande->client->nom }}</b>
                            <span>{{ $commande->client->email }}</span>
                        </td>
                        <td><strong style="color: #0f172a;">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</strong></td>
                        <td>
                            <span class="status-pill
                                {{ $commande->etat == 'prete' ? 'status-prete' : '' }}
                                {{ $commande->etat == 'payee' ? 'status-payee' : '' }}
                                {{ $commande->etat == 'en_attente' ? 'status-en-attente' : '' }}">
                                {{ $commande->etat }}
                            </span>
                        </td>
                        <td>
                            @if($commande->etat == 'payee')
                                <span style="color:#1e40af; font-size:0.85rem;">
                                    <i class="fa-solid fa-check"></i> Payée
                                </span>
                            @elseif($commande->etat == 'prete')
                                <form action="{{ route('commandes.prete', $commande->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-ready green">
                                        <i class="fa-solid fa-money-bill"></i> Marquer comme payée
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('commandes.prete', $commande->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn-ready">
                                        <i class="fa-solid fa-utensils"></i> Marquer comme prête
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty-msg">Aucune commande enregistrée pour le moment.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
