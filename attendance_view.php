<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Attendance View - Wahid Tuition</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #0a0a1a; color: white; min-height: 100vh; }

        .page-header {
            background: linear-gradient(135deg, #1a1a3e, #2d1b69);
            padding: 15px 20px; display: flex; align-items: center; gap: 15px;
            position: sticky; top: 0; z-index: 100;
            border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.5);
        }

        .back-btn {
            width: 40px; height: 40px; border-radius: 12px;
            background: rgba(255,255,255,0.1); border: none; color: white;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 18px;
        }

        .page-title { font-size: 18px; font-weight: 700; }
        .content { padding: 20px; padding-bottom: 40px; }

        /* Tab Switcher */
        .view-tabs {
            display: flex; background: rgba(255,255,255,0.08); border-radius: 14px;
            padding: 4px; margin-bottom: 20px;
        }

        .view-tab {
            flex: 1; padding: 12px 8px; border: none; background: transparent;
            color: rgba(255,255,255,0.5); font-family: 'Poppins', sans-serif;
            font-size: 12px; font-weight: 600; border-radius: 10px;
            cursor: pointer; transition: all 0.3s;
        }

        .view-tab.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white; box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }

        .tab-panel { display: none; }
        .tab-panel.active { display: block; animation: fadeIn 0.4s ease; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        /* Search & Filter */
        .search-wrapper { position: relative; margin-bottom: 12px; }
        .search-wrapper i {
            position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
            color: rgba(255,255,255,0.4);
        }

        .search-box {
            width: 100%; padding: 14px 16px 14px 44px;
            background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1);
            border-radius: 14px; color: white; font-family: 'Poppins', sans-serif;
            font-size: 14px; outline: none;
        }

        .search-box:focus { border-color: #667eea; }

        .filter-bar {
            display: flex; gap: 8px; margin-bottom: 15px;
            overflow-x: auto; -webkit-overflow-scrolling: touch; padding-bottom: 5px;
        }

        .filter-chip {
            padding: 8px 16px; background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1); border-radius: 20px;
            font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.6);
            white-space: nowrap; cursor: pointer; transition: all 0.3s; font-family: 'Poppins', sans-serif;
        }

        .filter-chip.active { background: rgba(102,126,234,0.2); border-color: #667eea; color: #667eea; }

        /* Student List Card */
        .student-att-card {
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px; padding: 16px; margin-bottom: 12px;
            cursor: pointer; transition: all 0.3s; animation: slideUp 0.4s ease both;
        }

        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .student-att-card:hover {
            background: rgba(102,126,234,0.08); border-color: rgba(102,126,234,0.2);
            transform: translateY(-2px);
        }

        .student-att-card.expanded {
            background: rgba(102,126,234,0.05); border-color: rgba(102,126,234,0.15);
        }

        .att-card-top {
            display: flex; align-items: center; gap: 12px;
        }

        .att-avatar {
            width: 48px; height: 48px; border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 20px; flex-shrink: 0;
        }

        .att-info { flex: 1; }
        .att-info h4 { font-size: 15px; font-weight: 700; }
        .att-info p { font-size: 11px; color: rgba(255,255,255,0.5); }

        .att-stats-mini {
            display: flex; gap: 6px; text-align: center;
        }

        .att-stat-mini {
            padding: 4px 8px; border-radius: 8px; font-size: 10px; font-weight: 700;
        }

        .stat-p { background: rgba(46,213,115,0.15); color: #2ed573; }
        .stat-a { background: rgba(255,107,107,0.15); color: #ff6b6b; }
        .stat-l { background: rgba(255,165,2,0.15); color: #ffa502; }

        /* Expanded Attendance Detail */
        .att-detail {
            display: none; margin-top: 16px; padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .att-detail.show { display: block; animation: fadeIn 0.3s ease; }

        /* Student Profile Calendar */
        .stu-calendar {
            background: rgba(255,255,255,0.04); border-radius: 16px;
            padding: 14px; margin-bottom: 15px;
        }

        .cal-nav {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;
        }

        .cal-nav-btn {
            width: 32px; height: 32px; border-radius: 8px;
            background: rgba(255,255,255,0.1); border: none; color: white;
            cursor: pointer; font-size: 12px;
        }

        .cal-month-label { font-size: 14px; font-weight: 700; }

        .cal-weekdays {
            display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px; margin-bottom: 4px;
        }

        .cal-wd { text-align: center; font-size: 9px; font-weight: 700; color: rgba(255,255,255,0.3); padding: 4px 0; }

        .cal-days { display: grid; grid-template-columns: repeat(7, 1fr); gap: 3px; }

        .cal-day {
            aspect-ratio: 1; border-radius: 8px; display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            font-size: 11px; font-weight: 600; transition: all 0.2s; line-height: 1;
        }

        .cal-day.present { background: rgba(46,213,115,0.25); color: #2ed573; }
        .cal-day.absent { background: rgba(255,107,107,0.25); color: #ff6b6b; }
        .cal-day.late { background: rgba(255,165,2,0.25); color: #ffa502; }
        .cal-day.today { border: 2px solid #667eea; }

        .cal-day .day-status {
            font-size: 7px; margin-top: 1px; font-weight: 800;
        }

        /* Attendance History List */
        .history-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 12px; border-radius: 10px;
            background: rgba(255,255,255,0.03); margin-bottom: 6px;
            font-size: 12px;
        }

        .history-date { color: rgba(255,255,255,0.6); font-weight: 500; }

        .history-badge {
            padding: 3px 12px; border-radius: 6px; font-size: 10px; font-weight: 700;
        }

        .h-present { background: rgba(46,213,115,0.15); color: #2ed573; }
        .h-absent { background: rgba(255,107,107,0.15); color: #ff6b6b; }
        .h-late { background: rgba(255,165,2,0.15); color: #ffa502; }

        /* Percentage Bar */
        .percent-bar-container {
            margin: 12px 0;
        }

        .percent-bar-label {
            display: flex; justify-content: space-between; font-size: 11px;
            margin-bottom: 5px; color: rgba(255,255,255,0.5);
        }

        .percent-bar-label .percent-value { color: #667eea; font-weight: 700; }

        .percent-bar {
            height: 10px; background: rgba(255,255,255,0.08);
            border-radius: 5px; overflow: hidden;
        }

        .percent-fill {
            height: 100%; border-radius: 5px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 1s ease;
        }

        /* Calendar Tab View */
        .calendar-card {
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px; padding: 18px; margin-bottom: 20px;
        }

        .calendar-nav {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;
        }

        .nav-btn {
            width: 40px; height: 40px; border-radius: 12px;
            background: rgba(255,255,255,0.1); border: none; color: white;
            cursor: pointer; font-size: 16px; transition: all 0.3s;
        }

        .nav-btn:hover { background: rgba(102,126,234,0.3); }
        .month-year { font-size: 18px; font-weight: 700; }

        .weekday-row {
            display: grid; grid-template-columns: repeat(7, 1fr);
            gap: 4px; margin-bottom: 8px;
        }

        .weekday {
            text-align: center; font-size: 11px; font-weight: 700;
            color: rgba(255,255,255,0.4); padding: 8px 0;
        }

        .days-grid {
            display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px;
        }

        .day-cell {
            aspect-ratio: 1; border-radius: 12px; display: flex;
            align-items: center; justify-content: center; font-size: 13px;
            font-weight: 600; cursor: pointer; transition: all 0.2s;
            position: relative;
        }

        .day-cell:hover { background: rgba(255,255,255,0.1); }
        .day-cell.today-cell { border: 2px solid #667eea; }
        .day-cell.has-data::after {
            content: ''; position: absolute; bottom: 3px;
            width: 5px; height: 5px; border-radius: 50%;
        }

        .day-cell.has-full::after { background: #2ed573; }
        .day-cell.has-partial::after { background: #ffa502; }

        .legend {
            display: flex; gap: 12px; justify-content: center; margin-top: 15px; flex-wrap: wrap;
        }

        .legend-item {
            display: flex; align-items: center; gap: 5px; font-size: 11px;
            color: rgba(255,255,255,0.5);
        }

        .legend-dot { width: 10px; height: 10px; border-radius: 50%; }

        .summary-grid {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 10px; margin-bottom: 15px;
        }

        .summary-card {
            background: rgba(255,255,255,0.05); border-radius: 14px;
            padding: 12px; text-align: center;
        }

        .summary-value { font-size: 20px; font-weight: 800; }
        .summary-label { font-size: 10px; color: rgba(255,255,255,0.5); }

        /* Daily detail popup */
        .daily-detail {
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px; padding: 18px; display: none;
        }

        .detail-title {
            font-size: 15px; font-weight: 700; margin-bottom: 15px;
            display: flex; align-items: center; gap: 8px;
        }

        .detail-title i { color: #667eea; }

        .detail-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .detail-item:last-child { border-bottom: none; }

        .d-avatar {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px; flex-shrink: 0;
        }

        .d-info { flex: 1; }
        .d-info h4 { font-size: 13px; font-weight: 600; }
        .d-info p { font-size: 11px; color: rgba(255,255,255,0.5); }

        .d-badge { padding: 4px 12px; border-radius: 8px; font-size: 10px; font-weight: 700; }
        .d-present { background: rgba(46,213,115,0.15); color: #2ed573; }
        .d-absent { background: rgba(255,107,107,0.15); color: #ff6b6b; }
        .d-late { background: rgba(255,165,2,0.15); color: #ffa502; }

        .empty-state {
            text-align: center; padding: 40px; color: rgba(255,255,255,0.3);
        }

        .empty-state i { font-size: 50px; display: block; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="page-header">
        <button class="back-btn" onclick="location.href='admin.php'"><i class="fas fa-arrow-left"></i></button>
        <div class="page-title"><i class="fas fa-calendar-alt"></i> Attendance View</div>
    </div>

    <div class="content">
        <!-- View Tabs -->
        <div class="view-tabs">
            <button class="view-tab active" onclick="switchView('student', this)">
                <i class="fas fa-user"></i> By Student
            </button>
            <button class="view-tab" onclick="switchView('calendar', this)">
                <i class="fas fa-calendar"></i> Calendar View
            </button>
        </div>

        <!-- ========== STUDENT VIEW TAB ========== -->
        <div class="tab-panel active" id="panel-student">
            <!-- Search by Name -->
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" class="search-box" id="stu-search" placeholder="Search student by name...">
            </div>

            <!-- Filter by Class -->
            <div class="filter-bar" id="stu-filter-bar">
                <div class="filter-chip active" onclick="stuFilter('all', this)">All Classes</div>
            </div>

            <!-- Student Cards -->
            <div id="student-att-list"></div>
        </div>

        <!-- ========== CALENDAR VIEW TAB ========== -->
        <div class="tab-panel" id="panel-calendar">
            <div class="filter-bar" id="cal-filter-bar">
                <div class="filter-chip active" onclick="calFilter('all', this)">All</div>
            </div>

            <div class="calendar-card">
                <div class="calendar-nav">
                    <button class="nav-btn" onclick="changeMonth(-1)"><i class="fas fa-chevron-left"></i></button>
                    <div class="month-year" id="month-year">January 2025</div>
                    <button class="nav-btn" onclick="changeMonth(1)"><i class="fas fa-chevron-right"></i></button>
                </div>

                <div class="weekday-row">
                    <div class="weekday">Sun</div><div class="weekday">Mon</div>
                    <div class="weekday">Tue</div><div class="weekday">Wed</div>
                    <div class="weekday">Thu</div><div class="weekday">Fri</div>
                    <div class="weekday">Sat</div>
                </div>

                <div class="days-grid" id="days-grid"></div>

                <div class="legend">
                    <div class="legend-item"><div class="legend-dot" style="background:#2ed573"></div> Full</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#ffa502"></div> Partial</div>
                    <div class="legend-item"><div class="legend-dot" style="border:2px solid #667eea;width:8px;height:8px;"></div> Today</div>
                </div>
            </div>

            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-value" style="color:#2ed573" id="sum-present">0</div>
                    <div class="summary-label">Present</div>
                </div>
                <div class="summary-card">
                    <div class="summary-value" style="color:#ff6b6b" id="sum-absent">0</div>
                    <div class="summary-label">Absent</div>
                </div>
                <div class="summary-card">
                    <div class="summary-value" style="color:#ffa502" id="sum-late">0</div>
                    <div class="summary-label">Late</div>
                </div>
            </div>

            <div class="daily-detail" id="daily-detail">
                <div class="detail-title"><i class="fas fa-list"></i> <span id="detail-date"></span></div>
                <div id="detail-list"></div>
            </div>
        </div>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.5.2/firebase-app.js";
        import { getDatabase, ref, get, child, onValue } from "https://www.gstatic.com/firebasejs/10.5.2/firebase-database.js";

        const firebaseConfig = {
            apiKey: "AIzaSyDHE23soLh5wWFtic_yT2RGypiU3GP8a3Q",
            authDomain: "towfik-f8850.firebaseapp.com",
            databaseURL: "https://towfik-f8850-default-rtdb.firebaseio.com",
            projectId: "towfik-f8850",
            storageBucket: "towfik-f8850.firebasestorage.app",
            messagingSenderId: "575010413525",
            appId: "1:575010413525:web:ab50f29db6156a18b5bb5c"
        };

        const app = initializeApp(firebaseConfig);
        const db = getDatabase(app);

        if (sessionStorage.getItem('adminLoggedIn') !== 'true') window.location.href = 'index.php';

        let allStudents = {};
        let allAttendance = {};
        let stuCurrentFilter = 'all';
        let calCurrentFilter = 'all';
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();
        let expandedCards = {};
        let studentCalMonths = {};

        // ========== LOAD DATA ==========
        onValue(ref(db, 'students'), (snapshot) => {
            allStudents = snapshot.exists() ? snapshot.val() : {};
            buildFilters();
            renderStudentList();
        });

        onValue(ref(db, 'attendance'), (snapshot) => {
            allAttendance = snapshot.exists() ? snapshot.val() : {};
            renderStudentList();
            renderCalendar();
        });

        // ========== FILTERS ==========
        function buildFilters() {
            const classes = new Set();
            for (let k in allStudents) classes.add(allStudents[k].class);

            const stuBar = document.getElementById('stu-filter-bar');
            stuBar.innerHTML = `<div class="filter-chip active" onclick="stuFilter('all', this)">All Classes</div>`;
            [...classes].sort().forEach(c => {
                stuBar.innerHTML += `<div class="filter-chip" onclick="stuFilter('${c}', this)">${c}</div>`;
            });

            const calBar = document.getElementById('cal-filter-bar');
            calBar.innerHTML = `<div class="filter-chip active" onclick="calFilter('all', this)">All</div>`;
            [...classes].sort().forEach(c => {
                calBar.innerHTML += `<div class="filter-chip" onclick="calFilter('${c}', this)">${c}</div>`;
            });
        }

        window.stuFilter = function(cls, el) {
            stuCurrentFilter = cls;
            document.querySelectorAll('#stu-filter-bar .filter-chip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            renderStudentList();
        };

        window.calFilter = function(cls, el) {
            calCurrentFilter = cls;
            document.querySelectorAll('#cal-filter-bar .filter-chip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            renderCalendar();
        };

        document.getElementById('stu-search').addEventListener('input', renderStudentList);

        // ========== TAB SWITCH ==========
        window.switchView = function(view, el) {
            document.querySelectorAll('.view-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('panel-' + view).classList.add('active');
            if (view === 'calendar') renderCalendar();
        };

        // ========== STUDENT VIEW ==========
        function getStudentAttendanceData(code) {
            let present = 0, absent = 0, late = 0;
            let history = [];
            for (let date in allAttendance) {
                for (let k in allAttendance[date]) {
                    if (allAttendance[date][k].code === code) {
                        const s = allAttendance[date][k].status;
                        if (s === 'P') present++;
                        else if (s === 'A') absent++;
                        else if (s === 'L') late++;
                        history.push({ date, status: s });
                    }
                }
            }
            history.sort((a, b) => b.date.localeCompare(a.date));
            return { present, absent, late, history };
        }

        function renderStudentList() {
            const container = document.getElementById('student-att-list');
            const search = document.getElementById('stu-search').value.toLowerCase();
            container.innerHTML = '';
            const colors = ['#667eea','#2ed573','#ff6b6b','#ffa502','#3498db','#e056a0','#1abc9c','#9b59b6'];
            let idx = 0;

            const entries = Object.entries(allStudents).sort((a, b) => a[1].name.localeCompare(b[1].name));

            for (let [key, stu] of entries) {
                if (stuCurrentFilter !== 'all' && stu.class !== stuCurrentFilter) continue;
                if (search && !stu.name.toLowerCase().includes(search)) continue;

                const color = colors[idx % colors.length];
                const data = getStudentAttendanceData(stu.code);
                const total = data.present + data.absent + data.late;
                const percent = total > 0 ? Math.round((data.present / total) * 100) : 0;
                const isExpanded = expandedCards[stu.code] || false;

                // Build history list (last 15)
                let historyHtml = '';
                data.history.slice(0, 15).forEach(h => {
                    const cls = h.status === 'P' ? 'h-present' : h.status === 'A' ? 'h-absent' : 'h-late';
                    const label = h.status === 'P' ? 'Present' : h.status === 'A' ? 'Absent' : 'Late';
                    const dateFormatted = new Date(h.date).toLocaleDateString('en-IN', { day:'numeric', month:'short', year:'numeric', weekday:'short' });
                    historyHtml += `
                        <div class="history-item">
                            <span class="history-date"><i class="fas fa-calendar-day" style="margin-right:6px;color:rgba(255,255,255,0.3);"></i>${dateFormatted}</span>
                            <span class="history-badge ${cls}">${label}</span>
                        </div>
                    `;
                });

                if (data.history.length === 0) {
                    historyHtml = '<div style="text-align:center;padding:15px;color:rgba(255,255,255,0.3);font-size:12px;">No attendance records yet</div>';
                }

                // Build mini calendar for current month
                const calMonth = studentCalMonths[stu.code] || { m: new Date().getMonth(), y: new Date().getFullYear() };
                const miniCalHtml = buildMiniCalendar(stu.code, calMonth.m, calMonth.y);

                container.innerHTML += `
                    <div class="student-att-card ${isExpanded ? 'expanded' : ''}" style="animation-delay:${idx * 0.04}s" id="card-${stu.code}">
                        <div class="att-card-top" onclick="toggleExpand('${stu.code}')">
                            <div class="att-avatar" style="background:${color}20; color:${color}">${stu.name.charAt(0).toUpperCase()}</div>
                            <div class="att-info">
                                <h4>${stu.name}</h4>
                                <p>${stu.code} • ${stu.class}</p>
                            </div>
                            <div class="att-stats-mini">
                                <span class="att-stat-mini stat-p">${data.present}P</span>
                                <span class="att-stat-mini stat-a">${data.absent}A</span>
                                <span class="att-stat-mini stat-l">${data.late}L</span>
                            </div>
                        </div>
                        <div class="att-detail ${isExpanded ? 'show' : ''}" id="detail-${stu.code}">
                            <!-- Percentage Bar -->
                            <div class="percent-bar-container">
                                <div class="percent-bar-label">
                                    <span>Attendance Rate</span>
                                    <span class="percent-value">${percent}%</span>
                                </div>
                                <div class="percent-bar">
                                    <div class="percent-fill" style="width:${percent}%"></div>
                                </div>
                            </div>

                            <!-- Mini Calendar -->
                            <div class="stu-calendar" id="mini-cal-${stu.code}">
                                ${miniCalHtml}
                            </div>

                            <!-- History -->
                            <div style="font-size:13px;font-weight:700;margin-bottom:10px;display:flex;align-items:center;gap:6px;">
                                <i class="fas fa-history" style="color:#667eea;"></i> Recent History
                            </div>
                            ${historyHtml}
                        </div>
                    </div>
                `;
                idx++;
            }

            if (idx === 0) {
                container.innerHTML = '<div class="empty-state"><i class="fas fa-user-slash"></i>No students found<br><span style="font-size:12px;margin-top:5px;display:block;">Try a different search or class filter</span></div>';
            }
        }

        function buildMiniCalendar(code, month, year) {
            const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const today = new Date();

            // Get attendance for this student
            const stuAtt = {};
            for (let date in allAttendance) {
                for (let k in allAttendance[date]) {
                    if (allAttendance[date][k].code === code) {
                        stuAtt[date] = allAttendance[date][k].status;
                    }
                }
            }

            let html = `
                <div class="cal-nav">
                    <button class="cal-nav-btn" onclick="event.stopPropagation(); changeStuCalMonth('${code}', -1)"><i class="fas fa-chevron-left"></i></button>
                    <div class="cal-month-label">${months[month]} ${year}</div>
                    <button class="cal-nav-btn" onclick="event.stopPropagation(); changeStuCalMonth('${code}', 1)"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="cal-weekdays">
                    <div class="cal-wd">S</div><div class="cal-wd">M</div>
                    <div class="cal-wd">T</div><div class="cal-wd">W</div>
                    <div class="cal-wd">T</div><div class="cal-wd">F</div>
                    <div class="cal-wd">S</div>
                </div>
                <div class="cal-days">
            `;

            for (let i = 0; i < firstDay; i++) {
                html += '<div class="cal-day"></div>';
            }

            for (let d = 1; d <= daysInMonth; d++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                const isToday = today.getDate() === d && today.getMonth() === month && today.getFullYear() === year;
                const status = stuAtt[dateStr];

                let cls = 'cal-day';
                let statusLabel = '';
                if (isToday) cls += ' today';
                if (status === 'P') { cls += ' present'; statusLabel = 'P'; }
                else if (status === 'A') { cls += ' absent'; statusLabel = 'A'; }
                else if (status === 'L') { cls += ' late'; statusLabel = 'L'; }

                html += `<div class="${cls}">${d}${statusLabel ? `<span class="day-status">${statusLabel}</span>` : ''}</div>`;
            }

            html += '</div>';
            return html;
        }

        window.changeStuCalMonth = function(code, delta) {
            if (!studentCalMonths[code]) {
                studentCalMonths[code] = { m: new Date().getMonth(), y: new Date().getFullYear() };
            }
            studentCalMonths[code].m += delta;
            if (studentCalMonths[code].m > 11) { studentCalMonths[code].m = 0; studentCalMonths[code].y++; }
            if (studentCalMonths[code].m < 0) { studentCalMonths[code].m = 11; studentCalMonths[code].y--; }

            const container = document.getElementById('mini-cal-' + code);
            if (container) {
                container.innerHTML = buildMiniCalendar(code, studentCalMonths[code].m, studentCalMonths[code].y);
            }
        };

        window.toggleExpand = function(code) {
            expandedCards[code] = !expandedCards[code];
            const detail = document.getElementById('detail-' + code);
            const card = document.getElementById('card-' + code);
            if (detail) {
                detail.classList.toggle('show');
                card.classList.toggle('expanded');
            }
        };

        // ========== CALENDAR VIEW ==========
        window.changeMonth = function(delta) {
            currentMonth += delta;
            if (currentMonth > 11) { currentMonth = 0; currentYear++; }
            if (currentMonth < 0) { currentMonth = 11; currentYear--; }
            renderCalendar();
        };

        function renderCalendar() {
            const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            document.getElementById('month-year').textContent = months[currentMonth] + ' ' + currentYear;

            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const today = new Date();
            const grid = document.getElementById('days-grid');
            grid.innerHTML = '';

            let monthPresent = 0, monthAbsent = 0, monthLate = 0;

            for (let i = 0; i < firstDay; i++) {
                grid.innerHTML += '<div class="day-cell"></div>';
            }

            for (let d = 1; d <= daysInMonth; d++) {
                const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                const isToday = today.getDate() === d && today.getMonth() === currentMonth && today.getFullYear() === currentYear;
                let hasData = false, allPresent = true;

                if (allAttendance[dateStr]) {
                    const dayData = allAttendance[dateStr];
                    for (let k in dayData) {
                        if (calCurrentFilter !== 'all' && dayData[k].class !== calCurrentFilter) continue;
                        hasData = true;
                        if (dayData[k].status === 'P') monthPresent++;
                        else if (dayData[k].status === 'A') { monthAbsent++; allPresent = false; }
                        else if (dayData[k].status === 'L') { monthLate++; allPresent = false; }
                    }
                }

                let classes = 'day-cell';
                if (isToday) classes += ' today-cell';
                if (hasData) classes += allPresent ? ' has-data has-full' : ' has-data has-partial';

                grid.innerHTML += `<div class="${classes}" onclick="showDayDetail('${dateStr}')">${d}</div>`;
            }

            document.getElementById('sum-present').textContent = monthPresent;
            document.getElementById('sum-absent').textContent = monthAbsent;
            document.getElementById('sum-late').textContent = monthLate;
        }

        window.showDayDetail = function(dateStr) {
            const detail = document.getElementById('daily-detail');
            const list = document.getElementById('detail-list');
            detail.style.display = 'block';

            const dateFormatted = new Date(dateStr).toLocaleDateString('en-IN', { day:'numeric', month:'long', year:'numeric', weekday:'long' });
            document.getElementById('detail-date').textContent = dateFormatted;

            list.innerHTML = '';

            if (!allAttendance[dateStr]) {
                list.innerHTML = '<div style="text-align:center;padding:20px;color:rgba(255,255,255,0.3);font-size:13px;">No attendance data for this date</div>';
                detail.scrollIntoView({ behavior: 'smooth' });
                return;
            }

            const data = allAttendance[dateStr];
            const colors = ['#667eea','#2ed573','#ff6b6b','#ffa502','#3498db'];
            let i = 0;

            for (let k in data) {
                if (calCurrentFilter !== 'all' && data[k].class !== calCurrentFilter) continue;
                const s = data[k].status;
                const badgeClass = s === 'P' ? 'd-present' : s === 'A' ? 'd-absent' : 'd-late';
                const badgeText = s === 'P' ? 'Present' : s === 'A' ? 'Absent' : 'Late';
                const color = colors[i % colors.length];

                list.innerHTML += `
                    <div class="detail-item">
                        <div class="d-avatar" style="background:${color}25; color:${color}">${(data[k].name || 'S').charAt(0).toUpperCase()}</div>
                        <div class="d-info">
                            <h4>${data[k].name || 'Student'}</h4>
                            <p>${data[k].code} • ${data[k].class}</p>
                        </div>
                        <span class="d-badge ${badgeClass}">${badgeText}</span>
                    </div>
                `;
                i++;
            }

            if (i === 0) {
                list.innerHTML = '<div style="text-align:center;padding:20px;color:rgba(255,255,255,0.3);font-size:13px;">No data for selected class filter</div>';
            }

            detail.scrollIntoView({ behavior: 'smooth' });
        };
    </script>
</body>
</html>