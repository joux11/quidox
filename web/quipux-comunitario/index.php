<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quidox — Sistema de Gestión Documental</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green:      #1a3a0a;
            --green-mid:  #2a5210;
            --orange:     #f29122;
            --lime:       #57D31F;
            --text:       #2c2c2c;
            --text-muted: #6b7280;
            --white:      #ffffff;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--white);
            color: var(--text);
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 48px;
            height: 72px;
            background: url(img/head-bg.png) repeat-x;
            border-bottom: 3px solid var(--orange);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .nav-logo-box {
            width: 40px; height: 40px;
            background: var(--orange);
            display: flex; align-items: center; justify-content: center;
            border-radius: 8px;
        }
        .nav-logo-box svg { width: 22px; height: 22px; fill: var(--green); }

        .nav-title { display: flex; flex-direction: column; }
        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            color: black;
            line-height: 1.1;
            font-weight: bold;
        }
        .brand-sub {
            font-size: 10px;
            color: black;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .btn-nav {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--orange);
            color: var(--green);
            font-family: 'DM Sans', sans-serif;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            padding: 10px 24px;
            border-radius: 6px;
            transition: background .2s, transform .15s;
            text-decoration: none;
        }
        .btn-nav:hover { background: var(--lime); transform: translateY(-1px); }
        .btn-nav svg {
            width: 14px; height: 14px;
            stroke: var(--green); fill: none;
            stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
        }

        /* HERO */
        .hero {

            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--white);
            position: relative;
            overflow: hidden;
            padding: 80px 48px;
        }

        .hero::before {
            content: '';
            position: absolute;
            bottom: -100px; right: -100px;
            width: 520px; height: 520px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(242,145,34,.09) 0%, transparent 70%);
            pointer-events: none;
        }
        .hero::after {
            content: '';
            position: absolute;
            top: -80px; left: -80px;
            width: 440px; height: 440px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(87,211,31,.07) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
            max-width: 640px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(242,145,34,0.1);
            border: 1px solid rgba(242,145,34,0.35);
            padding: 6px 16px;
            border-radius: 100px;
            margin-bottom: 36px;
            animation: fadeUp .5s ease both;
        }
        .hero-badge-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--orange);
            animation: pulse 2s infinite;
        }
        .hero-badge span {
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--orange);
            font-weight: 600;
        }

        @keyframes pulse {
            0%,100% { opacity: 1; transform: scale(1); }
            50% { opacity: .4; transform: scale(.8); }
        }

        .hero-heading {
            font-family: 'Playfair Display', serif;
            font-size: clamp(40px, 6vw, 68px);
            color: var(--green);
            line-height: 1.1;
            margin-bottom: 20px;
            animation: fadeUp .6s .1s ease both;
        }
        .hero-heading em {
            font-style: italic;
            color: var(--orange);
        }

        .hero-sub {
            font-size: 16px;
            color: var(--text-muted);
            line-height: 1.75;
            max-width: 500px;
            margin-bottom: 48px;
            font-weight: 400;
            animation: fadeUp .6s .2s ease both;
        }

        .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--green);
            color: var(--white);
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            padding: 16px 40px;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            transition: all .25s;
            text-decoration: none;
            animation: fadeUp .6s .3s ease both;
            box-shadow: 0 4px 20px rgba(26,58,10,.18);
        }
        .btn-hero:hover {
            background: var(--orange);
            color: var(--green);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(242,145,34,.35);
        }
        .btn-hero svg {
            width: 16px; height: 16px;
            stroke: var(--white); fill: none;
            stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
            transition: stroke .25s;
        }
        .btn-hero:hover svg { stroke: var(--green); }

        /* FOOTER */
        footer {
            background: var(--green);
            padding: 24px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 3px solid var(--orange);
        }
        .footer-brand { display: flex; align-items: center; gap: 12px; }
        .footer-brand span {
            font-family: 'Playfair Display', serif;
            font-size: 13px;
            color: rgba(255,255,255,.65);
        }
        .footer-copy {
            font-size: 12px;
            color: rgba(255,255,255,.3);
            letter-spacing: 0.04em;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 640px) {
            nav { padding: 0 20px; }
            .hero { padding: 60px 24px; }
            footer { flex-direction: column; gap: 10px; padding: 24px 20px; text-align: center; }
        }
    </style>
</head>
<body>

<!-- NAV -->
<nav>
    <a href="#" class="nav-brand">
        <div class="">
            <img src='imagenes/logo_ing2.png' width='80' height='45'>

        </div>
        <div class="nav-title">
            <span class="brand-name">Quidox</span>
            <span class="brand-sub">Versión 1.0</span>
        </div>
    </a>

    <a href="javascript:void(0)" onclick="irLogin(1)" class="btn-nav">
        <svg viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4M10 17l5-5-5-5M15 12H3"/></svg>
        Ingresar al Sistema
    </a>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge">
            <div class="hero-badge-dot"></div>
            <span>Sistema Activo</span>
        </div>

        <h1 class="hero-heading">
            <em>Quidox</em><br>
            Sistema de Gestión Documental
            <br>

        </h1>

        <p class="hero-sub">
            Administre, controle y digitalice los documentos de la Cooperativa con una plataforma moderna, segura y eficiente.
        </p>


    </div>
</section>



<script>
    function irLogin(admin) {
        try {
            const x = screen.width - 20, y = screen.height - 80;
            const param = admin === 1 ? '?txt_administrador=1' : '';
            const w = window.open('./login.php' + param, 'QUIPUX',
                'toolbar=no,directories=no,menubar=no,status=no,scrollbars=yes,width='+x+',height='+y);
            w.focus(); w.moveTo(10, 40);
        } catch(e) {}
    }
</script>
</body>
</html>
