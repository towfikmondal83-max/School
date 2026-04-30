<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Admin Dashboard - Wahid Tuition</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #0a0a1a;
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== HEADER ===== */
        .header {
            background: linear-gradient(135deg, #1a1a3e, #2d1b69);
            padding: 18px 20px 15px;
            border-bottom-left-radius: 24px;
            border-bottom-right-radius: 24px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 5px 30px rgba(0,0,0,0.5);
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .greeting { font-size: 12px; color: rgba(255,255,255,0.6); }
        .greeting h2 { font-size: 20px; font-weight: 700; color: white; margin-top: 2px; }
        .header-actions { display: flex; gap: 10px; }

        .header-btn {
            width: 42px; height: 42px; border-radius: 14px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.1);
            color: white; display: flex; align-items: center;
            justify-content: center; cursor: pointer; transition: all 0.3s;
            font-size: 17px;
        }

        .header-btn:hover { background: rgba(102,126,234,0.3); }

        /* ===== MAIN CONTENT ===== */
        .main-content { padding-bottom: 140px; }

        /* ===== STATS GRID ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            padding: 20px 16px 0;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--from), var(--to));
            border-radius: 20px; padding: 16px;
            position: relative; overflow: hidden;
            animation: cardSlide 0.5s ease-out both;
        }

        .stat-card:nth-child(1) { --from: #667eea; --to: #764ba2; animation-delay: 0.1s; }
        .stat-card:nth-child(2) { --from: #2ed573; --to: #17a05e; animation-delay: 0.2s; }
        .stat-card:nth-child(3) { --from: #ff6b6b; --to: #ee5a24; animation-delay: 0.3s; }
        .stat-card:nth-child(4) { --from: #ffa502; --to: #e67e22; animation-delay: 0.4s; }

        @keyframes cardSlide {
            from { opacity: 0; transform: translateY(30px) scale(0.9); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .stat-bg-icon {
            position: absolute; right: -10px; bottom: -10px;
            font-size: 55px; opacity: 0.15;
        }

        .stat-icon {
            width: 38px; height: 38px;
            background: rgba(255,255,255,0.25);
            border-radius: 12px; display: flex;
            align-items: center; justify-content: center;
            margin-bottom: 8px; font-size: 16px;
        }

        .stat-value { font-size: 24px; font-weight: 800; line-height: 1; }
        .stat-label { font-size: 11px; opacity: 0.85; margin-top: 4px; font-weight: 500; }

        /* ===== SECTION TITLE ===== */
        .section-title {
            padding: 16px 16px 0;
            font-size: 14px; font-weight: 700;
            display: flex; align-items: center; gap: 8px;
        }

        .section-title i { color: #667eea; }

        /* ===== PIE CHART - FULL WIDTH ===== */
        .pie-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 18px 16px;
            margin: 12px 16px 0;
            animation: cardSlide 0.5s ease-out 0.2s both;
        }

        .pie-card-title {
            font-size: 13px; font-weight: 700;
            color: rgba(255,255,255,0.8);
            margin-bottom: 14px;
            display: flex; align-items: center; gap: 8px;
        }

        .pie-card-title i { color: #667eea; }

        /* Pie + Legend side by side */
        .pie-inner {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .pie-canvas-wrap {
            width: 140px;
            height: 140px;
            flex-shrink: 0;
            position: relative;
        }

        .pie-canvas-wrap canvas {
            display: block !important;
        }

        /* Center text in pie */
        .pie-center-text {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            pointer-events: none;
        }

        .pie-center-pct {
            font-size: 18px; font-weight: 800; color: white;
            line-height: 1;
        }

        .pie-center-label {
            font-size: 9px; color: rgba(255,255,255,0.5);
            font-weight: 600;
        }

        /* Legend */
        .pie-legend-list { flex: 1; }

        .pie-legend-item {
            display: flex; align-items: center; gap: 8px;
            padding: 8px 10px; border-radius: 12px;
            margin-bottom: 6px;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
        }

        .pie-legend-item:last-child { margin-bottom: 0; }

        .legend-color-dot {
            width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0;
        }

        .legend-text { flex: 1; }
        .legend-text .l-name { font-size: 11px; color: rgba(255,255,255,0.7); font-weight: 600; }
        .legend-text .l-pct { font-size: 10px; color: rgba(255,255,255,0.4); }

        .legend-count {
            font-size: 16px; font-weight: 800;
        }

        /* ===== BAR CHART - FULL WIDTH ===== */
        .bar-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 18px 16px;
            margin: 12px 16px 0;
            animation: cardSlide 0.5s ease-out 0.3s both;
        }

        .bar-card-title {
            font-size: 13px; font-weight: 700;
            color: rgba(255,255,255,0.8);
            margin-bottom: 14px;
            display: flex; align-items: center; gap: 8px;
        }

        .bar-card-title i { color: #ffa502; }

        .bar-canvas-wrap {
            position: relative;
            width: 100%;
            height: 160px;
        }

        .bar-canvas-wrap canvas {
            display: block !important;
        }

        /* ===== WEEKLY SECTION ===== */
        .weekly-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px; padding: 18px 16px;
            margin: 12px 16px 0;
            animation: cardSlide 0.5s ease-out 0.4s both;
        }

        .weekly-header {
            display: flex; align-items: center;
            justify-content: space-between; margin-bottom: 16px;
        }

        .weekly-header-left {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; font-weight: 700;
        }

        .weekly-header-left i { color: #667eea; }

        .weekly-pct-badge {
            font-size: 11px; font-weight: 700;
            padding: 4px 12px; border-radius: 20px;
            background: rgba(102,126,234,0.15);
            color: #667eea;
        }

        /* Day boxes grid - 7 columns */
        .week-days-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
            margin-bottom: 14px;
        }

        .week-day-box {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 8px 4px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .week-day-box.today-box {
            background: rgba(102,126,234,0.15);
            border-color: rgba(102,126,234,0.35);
        }

        .week-day-box.has-data {
            border-color: rgba(255,255,255,0.12);
        }

        /* Day name in box */
        .wdb-name {
            font-size: 9px;
            font-weight: 800;
            color: rgba(255,255,255,0.4);
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 6px;
        }

        .week-day-box.today-box .wdb-name { color: #667eea; }

        /* Mini bar inside each day box */
        .wdb-bars {
            height: 50px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 2px;
        }

        .wdb-bar {
            width: 6px;
            border-radius: 3px 3px 0 0;
            min-height: 3px;
            transition: height 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .wdb-bar.p-bar { background: linear-gradient(180deg, #2ed573, #17a05e); }
        .wdb-bar.a-bar { background: linear-gradient(180deg, #ff6b6b, #ee5a24); }
        .wdb-bar.l-bar { background: linear-gradient(180deg, #ffa502, #e67e22); }
        .wdb-bar.empty { background: rgba(255,255,255,0.08); height: 50px; border-radius: 3px; }

        /* Total under bars */
        .wdb-total {
            font-size: 9px;
            font-weight: 700;
            color: rgba(255,255,255,0.5);
            margin-top: 4px;
        }

        /* Legend row */
        .week-legend {
            display: flex; gap: 14px; justify-content: center;
            margin-bottom: 14px;
        }

        .wk-legend-item {
            display: flex; align-items: center; gap: 5px;
            font-size: 10px; color: rgba(255,255,255,0.5);
        }

        .wk-dot {
            width: 8px; height: 8px; border-radius: 3px;
        }

        /* Progress bar */
        .progress-bar-container {
            background: rgba(255,255,255,0.1);
            border-radius: 10px; height: 10px;
            overflow: hidden; margin-bottom: 6px;
        }

        .progress-bar-fill {
            height: 100%; border-radius: 10px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 1.5s ease; position: relative;
        }

        .progress-bar-fill::after {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer { 0%{transform:translateX(-100%)} 100%{transform:translateX(100%)} }

        .progress-info {
            display: flex; justify-content: space-between;
            font-size: 11px; color: rgba(255,255,255,0.5);
        }

        .progress-info .pct-val { color: #667eea; font-weight: 700; }

        /* ===== QUICK ACTIONS ===== */
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding: 12px 16px 0;
        }

        .qa-item {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 12px 6px;
            text-align: center; cursor: pointer;
            transition: all 0.3s; text-decoration: none;
            color: white; display: block;
            animation: popIn 0.4s ease both;
        }

        .qa-item:nth-child(1){animation-delay:0.05s}
        .qa-item:nth-child(2){animation-delay:0.1s}
        .qa-item:nth-child(3){animation-delay:0.15s}
        .qa-item:nth-child(4){animation-delay:0.2s}
        .qa-item:nth-child(5){animation-delay:0.25s}
        .qa-item:nth-child(6){animation-delay:0.3s}
        .qa-item:nth-child(7){animation-delay:0.35s}
        .qa-item:nth-child(8){animation-delay:0.4s}

        @keyframes popIn {
            from { opacity: 0; transform: scale(0.6); }
            to { opacity: 1; transform: scale(1); }
        }

        .qa-item:hover { transform: translateY(-3px); background: rgba(102,126,234,0.12); border-color: rgba(102,126,234,0.25); }
        .qa-item:active { transform: scale(0.94); }

        .qa-icon {
            width: 44px; height: 44px; border-radius: 14px;
            margin: 0 auto 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }

        .qa-item:nth-child(1) .qa-icon { background: linear-gradient(135deg,#667eea,#764ba2); }
        .qa-item:nth-child(2) .qa-icon { background: linear-gradient(135deg,#2ed573,#17a05e); }
        .qa-item:nth-child(3) .qa-icon { background: linear-gradient(135deg,#ff6b6b,#ee5a24); }
        .qa-item:nth-child(4) .qa-icon { background: linear-gradient(135deg,#ffa502,#e67e22); }
        .qa-item:nth-child(5) .qa-icon { background: linear-gradient(135deg,#3498db,#2980b9); }
        .qa-item:nth-child(6) .qa-icon { background: linear-gradient(135deg,#e056a0,#c0392b); }
        .qa-item:nth-child(7) .qa-icon { background: linear-gradient(135deg,#1abc9c,#16a085); }
        .qa-item:nth-child(8) .qa-icon { background: linear-gradient(135deg,#9b59b6,#8e44ad); }

        .qa-label { font-size: 10px; font-weight: 600; color: rgba(255,255,255,0.8); line-height: 1.2; }

        /* ===== RECENT ACTIVITY ===== */
        .recent-section { padding: 12px 16px 0; }

        .recent-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 13px 14px;
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 10px;
            animation: cardSlide 0.5s ease-out both;
        }

        .recent-avatar {
            width: 42px; height: 42px; border-radius: 13px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 15px; flex-shrink: 0;
        }

        .recent-info { flex: 1; }
        .recent-info h4 { font-size: 13px; font-weight: 600; }
        .recent-info p { font-size: 11px; color: rgba(255,255,255,0.5); }

        .recent-badge { padding: 4px 10px; border-radius: 8px; font-size: 10px; font-weight: 700; }
        .badge-present { background: rgba(46,213,115,0.15); color: #2ed573; }
        .badge-absent { background: rgba(255,107,107,0.15); color: #ff6b6b; }
        .badge-late { background: rgba(255,165,2,0.15); color: #ffa502; }

        /* ===== BOTTOM NAV ===== */
        .bottom-nav-wrapper {
            position: fixed;
            bottom: 0; left: 0; right: 0;
            z-index: 200;
            background: rgba(8,8,28,0.97);
            backdrop-filter: blur(25px);
            border-top: 1px solid rgba(255,255,255,0.07);
            padding-bottom: env(safe-area-inset-bottom);
            box-shadow: 0 -10px 40px rgba(0,0,0,0.6);
        }

        .scroll-hint {
            display: flex; justify-content: center;
            gap: 5px; padding: 6px 0 2px;
        }

        .scroll-dot {
            width: 5px; height: 5px; border-radius: 50%;
            background: rgba(255,255,255,0.15); transition: all 0.3s;
        }

        .scroll-dot.active {
            width: 18px; border-radius: 3px; background: #667eea;
        }

        .bottom-nav-scroll {
            display: flex; overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
            padding: 8px 10px 10px; gap: 4px;
        }

        .bottom-nav-scroll::-webkit-scrollbar { display: none; }

        .nav-item {
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            gap: 4px; padding: 8px 10px; min-width: 72px;
            border-radius: 16px; cursor: pointer;
            text-decoration: none; color: rgba(255,255,255,0.4);
            transition: all 0.3s; scroll-snap-align: start;
            position: relative; border: 1px solid transparent;
            flex-shrink: 0;
        }

        .nav-item:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.7); }

        .nav-item.active {
            background: rgba(102,126,234,0.15);
            border-color: rgba(102,126,234,0.25); color: #667eea;
        }

        .nav-item.active::before {
            content: ''; position: absolute; top: -1px; left: 50%;
            transform: translateX(-50%);
            width: 28px; height: 3px;
            background: linear-gradient(90deg,#667eea,#764ba2);
            border-radius: 0 0 4px 4px;
        }

        .nav-icon-wrap {
            width: 42px; height: 42px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 19px; transition: all 0.3s;
        }

        .nav-item.active .nav-icon-wrap { transform: translateY(-2px); }
        .nav-item:active .nav-icon-wrap { transform: scale(0.88); }

        .nav-item:nth-child(1) .nav-icon-wrap { background: rgba(102,126,234,0.15); }
        .nav-item:nth-child(2) .nav-icon-wrap { background: rgba(46,213,115,0.15); }
        .nav-item:nth-child(3) .nav-icon-wrap { background: rgba(255,107,107,0.15); }
        .nav-item:nth-child(4) .nav-icon-wrap { background: rgba(255,165,2,0.15); }
        .nav-item:nth-child(5) .nav-icon-wrap { background: rgba(52,152,219,0.15); }
        .nav-item:nth-child(6) .nav-icon-wrap { background: rgba(224,86,160,0.15); }
        .nav-item:nth-child(7) .nav-icon-wrap { background: rgba(26,188,156,0.15); }
        .nav-item:nth-child(8) .nav-icon-wrap { background: rgba(155,89,182,0.15); }

        .nav-item:nth-child(1).active .nav-icon-wrap { background: rgba(102,126,234,0.3); }
        .nav-item:nth-child(2).active .nav-icon-wrap { background: rgba(46,213,115,0.3); }
        .nav-item:nth-child(3).active .nav-icon-wrap { background: rgba(255,107,107,0.3); }
        .nav-item:nth-child(4).active .nav-icon-wrap { background: rgba(255,165,2,0.3); }
        .nav-item:nth-child(5).active .nav-icon-wrap { background: rgba(52,152,219,0.3); }
        .nav-item:nth-child(6).active .nav-icon-wrap { background: rgba(224,86,160,0.3); }
        .nav-item:nth-child(7).active .nav-icon-wrap { background: rgba(26,188,156,0.3); }
        .nav-item:nth-child(8).active .nav-icon-wrap { background: rgba(155,89,182,0.3); }

        .nav-item:nth-child(1).active{color:#667eea}
        .nav-item:nth-child(2).active{color:#2ed573}
        .nav-item:nth-child(3).active{color:#ff6b6b}
        .nav-item:nth-child(4).active{color:#ffa502}
        .nav-item:nth-child(5).active{color:#3498db}
        .nav-item:nth-child(6).active{color:#e056a0}
        .nav-item:nth-child(7).active{color:#1abc9c}
        .nav-item:nth-child(8).active{color:#9b59b6}

        .nav-label { font-size: 9.5px; font-weight: 600; white-space: nowrap; }

        @keyframes navPulse {
            0%{box-shadow:0 0 0 0 rgba(102,126,234,0.3)}
            70%{box-shadow:0 0 0 8px rgba(102,126,234,0)}
            100%{box-shadow:0 0 0 0 rgba(102,126,234,0)}
        }

        .nav-item.active .nav-icon-wrap { animation: navPulse 2s ease-out infinite; }

        .scroll-arrows {
            position: absolute; right: 0; top: 0; bottom: 0; width: 40px;
            background: linear-gradient(to left,rgba(8,8,28,0.98),transparent);
            display: flex; align-items: center; justify-content: center;
            pointer-events: none; transition: opacity 0.3s;
        }

        .scroll-arrows i {
            font-size: 12px; color: rgba(255,255,255,0.4);
            animation: arrowBounce 1.5s ease-in-out infinite;
        }

        @keyframes arrowBounce {
            0%,100%{transform:translateX(0);opacity:0.4}
            50%{transform:translateX(3px);opacity:1}
        }

        .bottom-nav-container { position: relative; }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <div class="header-top">
            <div class="greeting">
                <span>Welcome back 👋</span>
                <h2>Admin Panel</h2>
            </div>
            <div class="header-actions">
                <div class="header-btn" onclick="location.href='notifications.php?type=admin'">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="header-btn" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-value" id="total-students">0</div>
                <div class="stat-label">Total Students</div>
                <i class="fas fa-users stat-bg-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-value" id="total-present">0</div>
                <div class="stat-label">Present Today</div>
                <i class="fas fa-check-circle stat-bg-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-times-circle"></i></div>
                <div class="stat-value" id="total-absent">0</div>
                <div class="stat-label">Absent Today</div>
                <i class="fas fa-times-circle stat-bg-icon"></i>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <div class="stat-value" id="total-late">0</div>
                <div class="stat-label">Late Today</div>
                <i class="fas fa-clock stat-bg-icon"></i>
            </div>
        </div>

        <!-- PIE CHART - Full Width, Below Stats -->
        <div class="section-title"><i class="fas fa-chart-pie"></i> Today's Attendance</div>

        <div class="pie-card">
            <div class="pie-card-title"><i class="fas fa-chart-pie"></i> Pie Chart – Today</div>
            <div class="pie-inner">
                <!-- Donut -->
                <div class="pie-canvas-wrap">
                    <canvas id="pieChart" width="140" height="140"></canvas>
                    <div class="pie-center-text">
                        <div class="pie-center-pct" id="pie-pct">0%</div>
                        <div class="pie-center-label">Present</div>
                    </div>
                </div>
                <!-- Legend -->
                <div class="pie-legend-list">
                    <div class="pie-legend-item">
                        <div class="legend-color-dot" style="background:#2ed573;"></div>
                        <div class="legend-text">
                            <div class="l-name">Present</div>
                            <div class="l-pct" id="pct-present">0%</div>
                        </div>
                        <div class="legend-count" style="color:#2ed573;" id="leg-p">0</div>
                    </div>
                    <div class="pie-legend-item">
                        <div class="legend-color-dot" style="background:#ff6b6b;"></div>
                        <div class="legend-text">
                            <div class="l-name">Absent</div>
                            <div class="l-pct" id="pct-absent">0%</div>
                        </div>
                        <div class="legend-count" style="color:#ff6b6b;" id="leg-a">0</div>
                    </div>
                    <div class="pie-legend-item">
                        <div class="legend-color-dot" style="background:#ffa502;"></div>
                        <div class="legend-text">
                            <div class="l-name">Late</div>
                            <div class="l-pct" id="pct-late">0%</div>
                        </div>
                        <div class="legend-count" style="color:#ffa502;" id="leg-l">0</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BAR CHART - Full Width, Below Pie -->
        <div class="bar-card">
            <div class="bar-card-title"><i class="fas fa-chart-bar"></i> Bar Chart – Today</div>
            <div class="bar-canvas-wrap">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- WEEKLY ATTENDANCE - Day Boxes -->
        <div class="section-title"><i class="fas fa-calendar-week"></i> Weekly Attendance</div>
        <div class="weekly-card">
            <div class="weekly-header">
                <div class="weekly-header-left"><i class="fas fa-chart-bar"></i> This Week</div>
                <span class="weekly-pct-badge" id="weekly-pct-badge">0%</span>
            </div>

            <!-- 7 Day Boxes -->
            <div class="week-days-grid" id="week-days-grid">
                <!-- Rendered by JS -->
            </div>

            <!-- Legend -->
            <div class="week-legend">
                <div class="wk-legend-item"><div class="wk-dot" style="background:#2ed573;"></div>Present</div>
                <div class="wk-legend-item"><div class="wk-dot" style="background:#ff6b6b;"></div>Absent</div>
                <div class="wk-legend-item"><div class="wk-dot" style="background:#ffa502;"></div>Late</div>
            </div>

            <!-- Overall progress -->
            <div class="progress-bar-container">
                <div class="progress-bar-fill" id="weekly-bar" style="width:0%"></div>
            </div>
            <div class="progress-info">
                <span>Overall this week</span>
                <span class="pct-val" id="weekly-pct-text">0%</span>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <div class="section-title"><i class="fas fa-th-large"></i> Quick Actions</div>
        <div class="quick-actions-grid">
            <a href="add_student.php" class="qa-item">
                <div class="qa-icon"><i class="fas fa-user-plus"></i></div>
                <div class="qa-label">Add Student</div>
            </a>
            <a href="student_profile.php" class="qa-item">
                <div class="qa-icon"><i class="fas fa-id-badge"></i></div>
                <div class="qa-label">Profiles</div>
            </a>
            <a href="attendance.php" class="qa-item">
                <div class="qa-icon"><i class="fas fa-clipboard-check"></i></div>
                <div class="qa-label">Attendance</div>
            </a>
            <a href="attendance_view.php" class="qa-item">
                <div class="qa-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="qa-label">Calendar</div>
            </a>
            <a href="fees.php" class="qa-item">
                <div class="qa-icon"><i class="fas fa-money-bill-wave"></i></div>
                <div class="qa-label">Fees</div>
            </a>
            <a href="reports.php" class="qa-item">
                <div class="qa-icon"><i class="fas fa-paper-plane"></i></div>
                <div class="qa-label">Reports</div>
            </a>
            <a href="settings.php" class="qa-item">
                <div class="qa-icon"><i class="fas fa-cog"></i></div>
                <div class="qa-label">Settings</div>
            </a>
            <a href="notifications.php?type=admin" class="qa-item">
                <div class="qa-icon"><i class="fas fa-bell"></i></div>
                <div class="qa-label">Notify</div>
            </a>
        </div>

        <!-- RECENT ACTIVITY -->
        <div class="section-title"><i class="fas fa-history"></i> Recent Activity</div>
        <div class="recent-section" id="recent-activity">
            <div style="text-align:center;padding:30px;color:rgba(255,255,255,0.25);">
                <i class="fas fa-spinner fa-spin" style="font-size:28px;display:block;margin-bottom:10px;"></i>
                Loading...
            </div>
        </div>

    </div>

    <!-- BOTTOM NAV - 8 Scrollable -->
    <div class="bottom-nav-wrapper">
        <div class="scroll-hint">
            <div class="scroll-dot active" id="dot-0"></div>
            <div class="scroll-dot" id="dot-1"></div>
            <div class="scroll-dot" id="dot-2"></div>
            <div class="scroll-dot" id="dot-3"></div>
            <div class="scroll-dot" id="dot-4"></div>
            <div class="scroll-dot" id="dot-5"></div>
            <div class="scroll-dot" id="dot-6"></div>
            <div class="scroll-dot" id="dot-7"></div>
        </div>
        <div class="bottom-nav-container">
            <div class="bottom-nav-scroll" id="bottom-nav">
                <a href="admin.php" class="nav-item active">
                    <div class="nav-icon-wrap"><i class="fas fa-home"></i></div>
                    <span class="nav-label">Dashboard</span>
                </a>
                <a href="add_student.php" class="nav-item">
                    <div class="nav-icon-wrap"><i class="fas fa-user-plus"></i></div>
                    <span class="nav-label">Add Student</span>
                </a>
                <a href="student_profile.php" class="nav-item">
                    <div class="nav-icon-wrap"><i class="fas fa-id-badge"></i></div>
                    <span class="nav-label">Profiles</span>
                </a>
                <a href="attendance.php" class="nav-item">
                    <div class="nav-icon-wrap"><i class="fas fa-clipboard-check"></i></div>
                    <span class="nav-label">Attendance</span>
                </a>
                <a href="attendance_view.php" class="nav-item">
                    <div class="nav-icon-wrap"><i class="fas fa-calendar-alt"></i></div>
                    <span class="nav-label">Calendar</span>
                </a>
                <a href="fees.php" class="nav-item">
                    <div class="nav-icon-wrap"><i class="fas fa-money-bill-wave"></i></div>
                    <span class="nav-label">Fees</span>
                </a>
                <a href="reports.php" class="nav-item">
                    <div class="nav-icon-wrap"><i class="fas fa-paper-plane"></i></div>
                    <span class="nav-label">Reports</span>
                </a>
                <a href="settings.php" class="nav-item">
                    <div class="nav-icon-wrap"><i class="fas fa-cog"></i></div>
                    <span class="nav-label">Settings</span>
                </a>
            </div>
            <div class="scroll-arrows" id="scroll-arrow">
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>
    </div>

    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>

    <script>
        firebase.initializeApp({
            apiKey: "AIzaSyDHE23soLh5wWFtic_yT2RGypiU3GP8a3Q",
            authDomain: "towfik-f8850.firebaseapp.com",
            databaseURL: "https://towfik-f8850-default-rtdb.firebaseio.com",
            projectId: "towfik-f8850",
            storageBucket: "towfik-f8850.firebasestorage.app",
            messagingSenderId: "575010413525",
            appId: "1:575010413525:web:ab50f29db6156a18b5bb5c"
        });
        var db = firebase.database();

        if (sessionStorage.getItem('adminLoggedIn') !== 'true') {
            window.location.href = 'index.php';
        }

        // ===== SCROLL DOTS =====
        var navScroll = document.getElementById('bottom-nav');
        var scrollArrow = document.getElementById('scroll-arrow');

        navScroll.addEventListener('scroll', function() {
            var sl = navScroll.scrollLeft;
            var sw = navScroll.scrollWidth - navScroll.clientWidth;
            var active = sw > 0 ? Math.round((sl / sw) * 7) : 0;
            for (var i = 0; i < 8; i++) {
                var d = document.getElementById('dot-' + i);
                if (d) d.classList.toggle('active', i === active);
            }
            scrollArrow.style.opacity = sl >= sw - 5 ? '0' : '1';
        });

        // ===== COUNTER =====
        function animateCounter(id, target) {
            var el = document.getElementById(id);
            var cur = 0;
            var step = Math.max(1, Math.ceil(target / 20));
            var t = setInterval(function() {
                cur += step;
                if (cur >= target) { cur = target; clearInterval(t); }
                el.textContent = cur;
            }, 50);
        }

        // ===== CHART INSTANCES =====
        var pieInst = null;
        var barInst = null;
        var pieCache = { p: -1, a: -1, l: -1 };
        var barCache = { p: -1, a: -1, l: -1 };

        // ===== PIE CHART =====
        function initPieChart() {
            var ctx = document.getElementById('pieChart').getContext('2d');
            pieInst = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Present', 'Absent', 'Late'],
                    datasets: [{
                        data: [1, 1, 1],
                        backgroundColor: [
                            'rgba(46,213,115,0.85)',
                            'rgba(255,107,107,0.85)',
                            'rgba(255,165,2,0.85)'
                        ],
                        borderColor: ['#2ed573','#ff6b6b','#ffa502'],
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
                    animation: { animateRotate: true, duration: 1000 },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(c) {
                                    var total = c.dataset.data.reduce(function(a,b){return a+b;},0);
                                    var pct = total > 0 ? Math.round((c.parsed/total)*100) : 0;
                                    return ' ' + c.label + ': ' + c.parsed + ' (' + pct + '%)';
                                }
                            }
                        }
                    },
                    cutout: '68%'
                }
            });
        }

        // ===== BAR CHART =====
        function initBarChart() {
            var ctx = document.getElementById('barChart').getContext('2d');
            barInst = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Present', 'Absent', 'Late'],
                    datasets: [{
                        label: 'Students',
                        data: [0, 0, 0],
                        backgroundColor: [
                            'rgba(46,213,115,0.75)',
                            'rgba(255,107,107,0.75)',
                            'rgba(255,165,2,0.75)'
                        ],
                        borderColor: ['#2ed573','#ff6b6b','#ffa502'],
                        borderWidth: 2,
                        borderRadius: 10,
                        borderSkipped: false,
                        barThickness: 40
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: { duration: 900 },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(c) {
                                    return ' ' + c.label + ': ' + c.parsed.y + ' students';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: 'rgba(255,255,255,0.6)',
                                font: { family: 'Poppins', size: 11, weight: '600' }
                            },
                            grid: { color: 'rgba(255,255,255,0.04)' },
                            border: { color: 'rgba(255,255,255,0.08)' }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'rgba(255,255,255,0.5)',
                                font: { family: 'Poppins', size: 10 },
                                stepSize: 1, precision: 0
                            },
                            grid: { color: 'rgba(255,255,255,0.04)' },
                            border: { color: 'rgba(255,255,255,0.08)' }
                        }
                    }
                }
            });
        }

        // ===== UPDATE PIE (stable) =====
        function updatePie(p, a, l) {
            if (!pieInst) return;
            if (pieCache.p === p && pieCache.a === a && pieCache.l === l) return;
            pieCache = { p:p, a:a, l:l };

            var total = p + a + l;
            pieInst.data.datasets[0].data = total > 0 ? [p, a, l] : [1, 1, 1];
            pieInst.update('active');

            // Update legend
            document.getElementById('leg-p').textContent = p;
            document.getElementById('leg-a').textContent = a;
            document.getElementById('leg-l').textContent = l;

            var pp = total > 0 ? Math.round((p/total)*100) : 0;
            var ap = total > 0 ? Math.round((a/total)*100) : 0;
            var lp = total > 0 ? Math.round((l/total)*100) : 0;

            document.getElementById('pct-present').textContent = pp + '%';
            document.getElementById('pct-absent').textContent = ap + '%';
            document.getElementById('pct-late').textContent = lp + '%';
            document.getElementById('pie-pct').textContent = pp + '%';
        }

        // ===== UPDATE BAR (stable) =====
        function updateBar(p, a, l) {
            if (!barInst) return;
            if (barCache.p === p && barCache.a === a && barCache.l === l) return;
            barCache = { p:p, a:a, l:l };
            barInst.data.datasets[0].data = [p, a, l];
            barInst.update('active');
        }

        // ===== WEEKLY DAY BOXES =====
        var DAY_NAMES = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        // Short = first letter only for box header
        var DAY_SHORT = ['S', 'M', 'T', 'W', 'T', 'F', 'S'];
        // Full names shown below letter
        var DAY_FULL = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        function renderWeekDayBoxes(weekData) {
            var grid = document.getElementById('week-days-grid');
            grid.innerHTML = '';

            var todayIdx = new Date().getDay();
            var maxTotal = 0;
            for (var i = 0; i < 7; i++) {
                var tot = weekData[i].p + weekData[i].a + weekData[i].l;
                if (tot > maxTotal) maxTotal = tot;
            }
            if (maxTotal === 0) maxTotal = 1;

            var totalP = 0, totalAll = 0;

            for (var i = 0; i < 7; i++) {
                var d = weekData[i];
                var total = d.p + d.a + d.l;
                totalP += d.p;
                totalAll += total;

                var isToday = (i === todayIdx);
                var hasData = total > 0;

                // Heights proportional to maxTotal (max 50px bar area)
                var pH = hasData ? Math.max(3, Math.round((d.p / maxTotal) * 50)) : 0;
                var aH = hasData ? Math.max(3, Math.round((d.a / maxTotal) * 50)) : 0;
                var lH = hasData ? Math.max(3, Math.round((d.l / maxTotal) * 50)) : 0;

                var boxClass = 'week-day-box' + (isToday ? ' today-box' : '') + (hasData ? ' has-data' : '');

                var barsHtml = '';
                if (!hasData) {
                    barsHtml = '<div style="width:6px;border-radius:3px;height:50px;background:rgba(255,255,255,0.07);"></div>' +
                               '<div style="width:6px;border-radius:3px;height:50px;background:rgba(255,255,255,0.07);"></div>' +
                               '<div style="width:6px;border-radius:3px;height:50px;background:rgba(255,255,255,0.07);"></div>';
                } else {
                    barsHtml = '<div class="wdb-bar p-bar" style="height:' + pH + 'px;"></div>' +
                               '<div class="wdb-bar a-bar" style="height:' + aH + 'px;"></div>' +
                               '<div class="wdb-bar l-bar" style="height:' + lH + 'px;"></div>';
                }

                grid.innerHTML +=
                    '<div class="' + boxClass + '">' +
                        '<div class="wdb-name">' + DAY_SHORT[i] + '</div>' +
                        '<div class="wdb-bars">' + barsHtml + '</div>' +
                        '<div class="wdb-total">' + (hasData ? total : '-') + '</div>' +
                    '</div>';
            }

            // Progress bar
            var pct = totalAll > 0 ? Math.round((totalP / totalAll) * 100) : 0;
            document.getElementById('weekly-bar').style.width = pct + '%';
            document.getElementById('weekly-pct-text').textContent = pct + '%';
            document.getElementById('weekly-pct-badge').textContent = pct + '%';
        }

        // ===== INIT CHARTS =====
        initPieChart();
        initBarChart();

        // ===== FIREBASE DATA =====
        var today = new Date().toISOString().split('T')[0];

        db.ref('students').on('value', function(snap) {
            animateCounter('total-students', snap.exists() ? Object.keys(snap.val()).length : 0);
        });

        db.ref('attendance/' + today).on('value', function(snap) {
            var p = 0, a = 0, l = 0;
            if (snap.exists()) {
                var data = snap.val();
                for (var k in data) {
                    if (data[k].status === 'P') p++;
                    else if (data[k].status === 'A') a++;
                    else if (data[k].status === 'L') l++;
                }
            }
            animateCounter('total-present', p);
            animateCounter('total-absent', a);
            animateCounter('total-late', l);

            // Update charts
            updatePie(p, a, l);
            updateBar(p, a, l);

            // Recent activity
            var container = document.getElementById('recent-activity');
            container.innerHTML = '';

            if (!snap.exists()) {
                container.innerHTML = '<div style="text-align:center;padding:30px;color:rgba(255,255,255,0.25);font-size:13px;"><i class="fas fa-inbox" style="font-size:36px;display:block;margin-bottom:10px;opacity:0.5;"></i>No attendance today</div>';
                return;
            }

            var data = snap.val();
            var count = 0;
            var colors = ['#667eea','#2ed573','#ff6b6b','#ffa502','#3498db','#e056a0','#1abc9c','#9b59b6'];

            for (var k in data) {
                var item = data[k];
                var badge = item.status === 'P' ? 'present' : item.status === 'A' ? 'absent' : 'late';
                var bText = item.status === 'P' ? 'Present' : item.status === 'A' ? 'Absent' : 'Late';
                var color = colors[count % colors.length];

                container.innerHTML +=
                    '<div class="recent-card" style="animation-delay:' + (count * 0.05) + 's">' +
                        '<div class="recent-avatar" style="background:' + color + '22;color:' + color + '">' +
                            (item.name || 'S').charAt(0).toUpperCase() +
                        '</div>' +
                        '<div class="recent-info">' +
                            '<h4>' + (item.name || 'Student') + '</h4>' +
                            '<p>' + (item.code || '') + ' &bull; ' + (item.class || '') + '</p>' +
                        '</div>' +
                        '<div class="recent-badge badge-' + badge + '">' + bText + '</div>' +
                    '</div>';
                count++;
            }
        });

        // ===== WEEKLY DATA =====
        var nowDate = new Date();
        var weekStart = new Date(nowDate);
        weekStart.setDate(nowDate.getDate() - nowDate.getDay());

        var weekDates = [];
        for (var i = 0; i < 7; i++) {
            var wd = new Date(weekStart);
            wd.setDate(weekStart.getDate() + i);
            weekDates.push(wd.toISOString().split('T')[0]);
        }

        // Initial empty boxes
        var emptyWeek = [];
        for (var i = 0; i < 7; i++) emptyWeek.push({ p:0, a:0, l:0 });
        renderWeekDayBoxes(emptyWeek);

        // Load weekly
        var weeklyPromises = [];
        for (var i = 0; i < 7; i++) {
            weeklyPromises.push(db.ref('attendance/' + weekDates[i]).once('value'));
        }

        Promise.all(weeklyPromises).then(function(snaps) {
            var weekData = [];
            for (var j = 0; j < snaps.length; j++) {
                var p = 0, a = 0, l = 0;
                if (snaps[j].exists()) {
                    var d = snaps[j].val();
                    for (var k in d) {
                        if (d[k].status === 'P') p++;
                        else if (d[k].status === 'A') a++;
                        else if (d[k].status === 'L') l++;
                    }
                }
                weekData.push({ p:p, a:a, l:l });
            }
            renderWeekDayBoxes(weekData);
        });

        function logout() {
            sessionStorage.clear();
            window.location.href = 'index.php';
        }
    </script>
</body>
</html>