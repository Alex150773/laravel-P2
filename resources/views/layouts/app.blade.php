<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Gestão de Categorias</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #f6f8fa;
            --text: #2c3e50;
            --muted: #7f8c8d;
            --primary: #3498db;
            --primary-700: #2980b9;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
            --white: #ffffff;
            --border: #e5e9f0;
            --shadow: rgba(0,0,0,0.08);
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; }
        .layout { display: grid; grid-template-columns: 240px 1fr; min-height: 100vh; }
        .sidebar { background: #1f2937; color: var(--white); display: flex; flex-direction: column; padding: 24px 16px; gap: 16px; }
        .brand { font-size: 18px; font-weight: 600; letter-spacing: 0.5px; }
        .nav { display: flex; flex-direction: column; gap: 8px; }
        .nav a { color: #cbd5e1; text-decoration: none; padding: 10px 12px; border-radius: 6px; }
        .nav a:hover { background: #111827; color: var(--white); }
        .nav a.active { background: #374151; color: var(--white); }
        .main { display: flex; flex-direction: column; }
        .topbar { background: var(--white); border-bottom: 1px solid var(--border); box-shadow: 0 1px 2px var(--shadow); }
        .topbar-inner { max-width: 1100px; margin: 0 auto; padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; }
        .topbar-title { font-size: 18px; font-weight: 600; color: var(--text); }
        .topbar-actions { display: flex; gap: 8px; }
        .content { max-width: 1100px; margin: 0 auto; padding: 20px; width: 100%; }
        .alert { padding: 12px 16px; margin-bottom: 16px; border-radius: 8px; border: 1px solid var(--border); }
        .alert-success { background-color: #e8f7ee; color: #1e6b36; }
        .alert-error { background-color: #fde8e8; color: #7e2424; }
        .card { background: var(--white); border-radius: 10px; box-shadow: 0 4px 12px var(--shadow); padding: 20px; margin-bottom: 20px; border: 1px solid var(--border); }
        .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
        .page-header h1, .page-header h2 { font-size: 20px; font-weight: 600; color: var(--text); }
        .btn { display: inline-block; padding: 10px 16px; border: none; border-radius: 8px; cursor: pointer; text-decoration: none; font-size: 14px; transition: transform 0.1s ease, background 0.2s ease; }
        .btn:active { transform: scale(0.98); }
        .btn-primary { background: var(--primary); color: var(--white); }
        .btn-primary:hover { background: var(--primary-700); }
        .btn-success { background: var(--success); color: var(--white); }
        .btn-success:hover { background: #229954; }
        .btn-warning { background: var(--warning); color: var(--white); }
        .btn-warning:hover { background: #e67e22; }
        .btn-danger { background: var(--danger); color: var(--white); }
        .btn-danger:hover { background: #c0392b; }
        .btn-secondary { background: #95a5a6; color: var(--white); }
        .btn-secondary:hover { background: #7f8c8d; }
        table { width: 100%; border-collapse: collapse; background: var(--white); border: 1px solid var(--border); border-radius: 10px; overflow: hidden; }
        thead { background: #f4f6f8; color: var(--text); }
        th { padding: 14px; text-align: left; font-weight: 600; border-bottom: 1px solid var(--border); }
        td { padding: 14px; border-bottom: 1px solid var(--border); }
        tbody tr:hover { background-color: #fafafa; }
        .actions { display: flex; gap: 8px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; font-weight: 500; color: var(--text); }
        input[type="text"], textarea { width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; font-family: inherit; font-size: 14px; }
        input[type="text"]:focus, textarea:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.15); }
        textarea { resize: vertical; min-height: 100px; }
        .form-actions { display: flex; gap: 10px; margin-top: 20px; }
        .error-message { color: var(--danger); font-size: 14px; margin-top: 5px; }
        .empty-state { text-align: center; padding: 40px 20px; color: var(--muted); }
        .empty-state p { margin-bottom: 16px; font-size: 16px; }
        @media (max-width: 900px) {
            .layout { grid-template-columns: 1fr; }
            .sidebar { flex-direction: row; align-items: center; justify-content: space-between; }
            .nav { flex-direction: row; flex-wrap: wrap; }
            .topbar-inner, .content { padding: 16px; }
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="brand">Gestão</div>
            <nav class="nav">
                <a href="{{ route('categorias.index') }}" class="{{ request()->is('categorias*') ? 'active' : '' }}">Categorias</a>
                <a href="{{ route('categorias.create') }}" class="{{ request()->is('categorias/create') ? 'active' : '' }}">Nova Categoria</a>
            </nav>
        </aside>
        <div class="main">
            <div class="topbar">
                <div class="topbar-inner">
                    <div class="topbar-title">@yield('title')</div>
                    <div class="topbar-actions">@yield('top_actions')</div>
                </div>
            </div>
            <div class="content">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">{{ $message }}</div>
                @endif
                @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
