<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дневник Давления от mtodzi · умный трекер</title>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background: #f4f7fc;
            color: #1e293b;
            line-height: 1.5;
        }

        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
        }

        /* навигация */
        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem 1.5rem;
            margin: 1.5rem 0 2.5rem;
            border-bottom: 2px solid rgba(0, 80, 200, 0.15);
            padding-bottom: 0.75rem;
        }
        .nav-links a {
            text-decoration: none;
            font-weight: 600;
            color: #2c3e50;
            padding: 0.25rem 0.5rem;
            border-radius: 30px;
            transition: 0.2s;
            font-size: 1.1rem;
            cursor: pointer;
        }
        .nav-links a i {
            margin-right: 6px;
            color: #2563eb;
        }
        .nav-links a:hover {
            background: #e6edf8;
            color: #1e40af;
        }
        .active-tab {
            background: #2563eb !important;
            color: white !important;
        }
        .active-tab i {
            color: white !important;
        }

        /* карточки */
        .card {
            background: white;
            border-radius: 32px;
            padding: 2.5rem;
            box-shadow: 0 20px 35px -8px rgba(0, 34, 80, 0.15);
            margin-bottom: 2.5rem;
            border: 1px solid rgba(255,255,255,0.5);
        }

        h1 {
            font-size: 2.8rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            background: linear-gradient(145deg, #0b2b5c, #1e4b8a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .logo-badge {
            background: #e9effa;
            padding: 0.3rem 1.5rem;
            border-radius: 60px;
            color: #1f3e6b;
            font-size: 1.2rem;
            font-weight: 500;
        }

        /* хедер */
        .hero {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }
        .feature-item {
            background: #f8fbff;
            border-radius: 28px;
            padding: 2rem 1.8rem;
            border: 1px solid #d4e2ff;
        }
        .feature-icon {
            font-size: 2.2rem;
            color: #2563eb;
            margin-bottom: 1rem;
        }
        .feature-item h3 {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .instruction-step {
            display: flex;
            gap: 1.5rem;
            margin: 2rem 0;
            align-items: flex-start;
            background: #f0f7ff;
            border-radius: 40px;
            padding: 1.8rem 2rem;
        }
        .step-number {
            background: #2563eb;
            color: white;
            width: 48px;
            height: 48px;
            border-radius: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.6rem;
            flex-shrink: 0;
        }

        .legal-text {
            background: #eef5ff;
            padding: 2rem;
            border-radius: 24px;
            color: #1f3a6b;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .hidden-page {
            display: none;
        }

        footer {
            margin-top: 4rem;
            text-align: center;
            color: #667c9e;
            border-top: 1px solid #b9d3ff;
            padding-top: 2rem;
        }

        hr {
            border: 1px solid #b9d3ff;
            margin: 2rem 0;
        }

        .btn {
            background: #2563eb;
            border: none;
            padding: 0.9rem 2.5rem;
            border-radius: 60px;
            font-weight: 600;
            font-size: 1.2rem;
            color: white;
            cursor: pointer;
            box-shadow: 0 8px 18px -6px #2563eb99;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            transition: 0.2s;
            text-decoration: none;
            border: 1px solid #2563eb;
        }
        .btn:hover {
            background: #1d4ed8;
            transform: scale(1.02);
        }
        /* Флаг России */
        .flag-ru {
            background-image: url('https://flagcdn.com/w320/ru.png');
        }

        /* Флаг Великобритании (для английского) */
        .flag-gb {
            background-image: url('https://flagcdn.com/w320/gb.png');
        }

        /* Альтернатива - флаг США */
        .flag-us {
            background-image: url('https://flagcdn.com/w320/us.png');
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Шапка с логотипом и навигацией (только информационные страницы) -->
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <h1>
                <i class="fas fa-heartbeat" style="color: #2563eb;"></i>
                Pressure Diary
                <span class="logo-badge">by mtodzi</span>
            </h1>
            <div class="nav-links">
                <a onclick="showPage('main'); return false;" id="link-main" class="active-tab"><i class="fas fa-home"></i>Main</a>
                <a onclick="showPage('about'); return false;" id="link-about"><i class="fas fa-user"></i>About me</a>
                <a onclick="showPage('instructions'); return false;" id="link-instr"><i class="fas fa-clipboard-list"></i>Manual</a>
                <a onclick="showPage('legal'); return false;" id="link-legal"><i class="fas fa-file-contract"></i>Terms of use</a>
                @if(app()->getLocale() == 'ru')
                    <a href="{{ route('lang.switch', 'en') }}"><i class="fas fa-globe"></i> English</a>
                @else
                    <a href="{{ route('lang.switch', 'ru') }}"><i class="fas fa-globe"></i> Русский</a>
                @endif
            </div>
        </div>

        <!-- Главная страница (только информация) -->
        <div id="main-page">
            <div class="hero">
                <p style="font-size: 1.4rem; color: #2d4b7c; max-width: 800px;">A simple and intuitive blood pressure monitoring diary. Without unnecessary difficulties.</p>
            </div>

            <div class="card">
                <h2 style="font-size: 2rem; margin-bottom: 1.5rem;">How it works</h2>
                <div class="feature-grid">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-notes-medical"></i></div>
                        <h3>Three measurements</h3>
                        <p>Three measurements are performed for each hand. The first is a trial, the next two are used to calculate the average.</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-hand-peace"></i></div>
                        <h3>Left / Right</h3>
                        <p>You can disable any hand using the slider. Flexible approach if you measure only one side.</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-clock"></i></div>
                        <h3>Time control</h3>
                        <p>Be sure to pause for at least 2 minutes between measurements for accuracy.</p>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                        <h3>Pulse pressure</h3>
                        <p>The difference between systolic and diastolic is automatically calculated - is an important indicator.</p>
                    </div>
                </div>

                <div style="background: #ddeeff; border-radius: 50px; padding: 2rem; margin-top: 1rem;">
                    <p style="font-size: 1.2rem;"><i class="fas fa-lock" style="color: #2563eb;"></i> <strong>Registration is required for use.</strong> — log in to the app to add measurements. Email is needed to restore your password only.</p>
                </div>
            </div>
        </div>

        <!-- Страница "Обо мне" -->
        <div id="about-page" class="hidden-page">
            <div class="card">
                <h2><i class="fas fa-heart" style="color: #2563eb;"></i> About me — mtodzi</h2>
                <div style="display: flex; flex-direction: column; gap: 1.5rem; margin-top: 2rem; font-size: 1.2rem;">
                    <p>Hi! I am the creator of this pressure diary. I came across hypertension myself and realized how important it is to keep accurate records, but to do it simply and without unnecessary pain. That's why this project was born.</p>
                    <p><i class="fas fa-check-circle" style="color:#2563eb; width: 30px;"></i> I believe that pressure control should not be difficult. There are no ads here, and your data does not leave the device (except for a backups). Everything is transparent.</p>
                    <p style="margin-top: 1.5rem"><i class="fas fa-envelope"></i> mtodzi@pressure.ru (for feedback)</p>
                </div>
            </div>
        </div>

        <!-- Страница "Инструкция использования" (акцент на регистрацию и логику) -->
        <div id="instructions-page" class="hidden-page">
            <div class="card">
                <h2><i class="fas fa-book-open"></i> Instructions: how to start</h2>

                <div class="instruction-step">
                    <span class="step-number">1</span>
                    <div><strong style="font-size: 1.4rem;">Registration / Login</strong> — to measure the pressure, you must register and log in to the app. The data will not be saved without logging in. We only use email to recover a forgotten password.</div>
                </div>

                <div class="instruction-step">
                    <span class="step-number">2</span>
                    <div><strong style="font-size: 1.4rem;">Add measurement</strong> — on the main page, click "Add measurement". A form opens with two blocks (left and right hand).</div>
                </div>

                <div class="instruction-step">
                    <span class="step-number">3</span>
                    <div><strong style="font-size: 1.4rem;">Hand disable slider</strong> — if you measure only one hand, you can turn off the other. For each active hand, you need to make three measurements.</div>
                </div>

                <div class="instruction-step">
                    <span class="step-number">4</span>
                    <div><strong style="font-size: 1.4rem;">Input indicators</strong> — for each measurement, enter systolic (upper), diastolic (lower), and pulse. After each one, click "Apply".</div>
                </div>

                <div class="instruction-step">
                    <span class="step-number">5</span>
                    <div><strong style="font-size: 1.4rem;">Pause for 2 minutes</strong> — it must take at least 2 minutes between measurements. The app will remind you.</div>
                </div>

                <div class="instruction-step">
                    <span class="step-number">6</span>
                    <div><strong style="font-size: 1.4rem;">Save a series</strong> — after three applications, the "Save" button will appear. Click it to return to the main page.</div>
                </div>

                <div class="instruction-step">
                    <span class="step-number">7</span>
                    <div><strong style="font-size: 1.4rem;">Average values</strong> — the main page displays the average values for the last two measurements (the first one is not taken into accounts). You will immediately see the pulse pressure (the difference between the upper and lower).</div>
                </div>

                <div class="instruction-step">
                    <span class="step-number">8</span>
                    <div><strong style="font-size: 1.4rem;">The "show" button</strong> — in the table, you can click "show" to see detailed information on all entered measurements.</div>
                </div>
            </div>
        </div>

        <!-- Страница "Условия использования" -->
        <div id="legal-page" class="hidden-page">
            <div class="card">
                <h2><i class="fas fa-balance-scale"></i> Terms of use</h2>
                <div class="legal-text">
                    <p><i class="fas fa-cookie-bite fa-fw"></i> <strong>Using cookies:</strong> By being on the resource, you grant permission to use technical cookies (necessary for logging in and running sessions).</p>
                    <p><i class="fas fa-user-secret fa-fw"></i> <strong>Personal data:</strong> We do not ask you to enter any personal information other than your email address. The mail is only needed to recover a forgotten password. We do not share information with third parties.</p>
                    <p><i class="fas fa-stethoscope fa-fw"></i> <strong>Medical warning:</strong> The mtodzi's blood pressure diary is a self—monitoring tool, it does not substitute a doctor's consultation. Make all treatment decisions only with a specialist.</p>
                </div>
            </div>
        </div>

        <!-- Призыв к регистрации (на всех страницах) -->
        <div style="background: linear-gradient(135deg, #1e3a8a, #2563eb); border-radius: 40px; padding: 2.5rem; color: white; margin: 3rem 0;">
            <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 2rem; margin-bottom: 0.5rem;">Start keeping a diary</h3>
                    <p style="font-size: 1.2rem; opacity: 0.9;">Register and log in to the app to add measurements.</p>
                </div>
                <a href="{{ route('login') }}" class="btn" style="background: white; color: #1e3a8a; font-size: 1.3rem; border: none;"><i class="fas fa-arrow-right"></i> Login / Registration</a>
            </div>
        </div>

        <footer>
            <p>© mtodzi · Pressure Diary · care without unnecessary difficulties</p>
        </footer>
    </div>

    <script>
        // Простая навигация между страницами (без форм и данных)
        function showPage(pageId) {
            const pages = ['main', 'about', 'instructions', 'legal'];
            pages.forEach(p => document.getElementById(p+'-page').classList.add('hidden-page'));
            document.getElementById(pageId+'-page').classList.remove('hidden-page');

            // подсветка активной ссылки
            document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active-tab'));
            if (pageId === 'main') document.getElementById('link-main').classList.add('active-tab');
            if (pageId === 'about') document.getElementById('link-about').classList.add('active-tab');
            if (pageId === 'instructions') document.getElementById('link-instr').classList.add('active-tab');
            if (pageId === 'legal') document.getElementById('link-legal').classList.add('active-tab');
        }

        // начальное состояние — главная
        showPage('main');
    </script>
</body>
</html>
