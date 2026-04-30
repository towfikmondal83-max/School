<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Student Dashboard - Wahid Tuition</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #0a0a1a; color: white; min-height: 100vh; }
        .header { background: linear-gradient(135deg, #667eea, #764ba2); padding: 20px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px; position: relative; overflow: hidden; }
        .header::before { content: ''; position: absolute; top: -60px; right: -60px; width: 180px; height: 180px; border-radius: 50%; background: rgba(255,255,255,0.1); }
        .header-top { display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 2; }
        .student-info { display: flex; align-items: center; gap: 14px; }
        .student-avatar { width: 50px; height: 50px; border-radius: 16px; background: rgba(255,255,255,0.25); display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; border: 2px solid rgba(255,255,255,0.3); }
        .student-greeting { font-size: 12px; opacity: 0.85; }
        .student-greeting h2 { font-size: 18px; font-weight: 700; opacity: 1; }
        .student-greeting .stu-badge { display: inline-block; padding: 2px 10px; background: rgba(255,255,255,0.2); border-radius: 8px; font-size: 10px; font-weight: 600; margin-top: 3px; }
        .header-btn { width: 42px; height: 42px; border-radius: 14px; background: rgba(255,255,255,0.2); border: none; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; position: relative; z-index: 2; }
        .notif-badge { position: absolute; top: -2px; right: -2px; width: 18px; height: 18px; background: #ff6b6b; border-radius: 50%; font-size: 10px; font-weight: 700; display: none; align-items: center; justify-content: center; }
        .content { padding: 20px; padding-bottom: 100px; }
        .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 20px; }
        .stat-mini { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 16px 10px; text-align: center; animation: cardPop 0.5s ease both; }
        .stat-mini:nth-child(1) { animation-delay: 0.1s; }
        .stat-mini:nth-child(2) { animation-delay: 0.2s; }
        .stat-mini:nth-child(3) { animation-delay: 0.3s; }
        @keyframes cardPop { from { opacity: 0; transform: scale(0.8); } to { opacity: 1; transform: scale(1); } }
        .stat-mini-icon { width: 36px; height: 36px; border-radius: 12px; margin: 0 auto 8px; display: flex; align-items: center; justify-content: center; font-size: 16px; }
        .stat-mini:nth-child(1) .stat-mini-icon { background: rgba(46,213,115,0.2); color: #2ed573; }
        .stat-mini:nth-child(2) .stat-mini-icon { background: rgba(255,107,107,0.2); color: #ff6b6b; }
        .stat-mini:nth-child(3) .stat-mini-icon { background: rgba(255,165,2,0.2); color: #ffa502; }
        .stat-mini-value { font-size: 24px; font-weight: 800; }
        .stat-mini:nth-child(1) .stat-mini-value { color: #2ed573; }
        .stat-mini:nth-child(2) .stat-mini-value { color: #ff6b6b; }
        .stat-mini:nth-child(3) .stat-mini-value { color: #ffa502; }
        .stat-mini-label { font-size: 10px; color: rgba(255,255,255,0.5); margin-top: 2px; }
        .section-title { font-size: 15px; font-weight: 700; margin: 20px 0 12px; display: flex; align-items: center; gap: 8px; }
        .section-title i { color: #667eea; }
        .attendance-percent-card { background: linear-gradient(135deg, rgba(102,126,234,0.2), rgba(118,75,162,0.2)); border: 1px solid rgba(102,126,234,0.2); border-radius: 16px; padding: 20px; text-align: center; margin-bottom: 20px; }
        .percent-circle { width: 100px; height: 100px; border-radius: 50%; border: 6px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 10px; }
        .percent-value { font-size: 28px; font-weight: 800; color: #667eea; }
        .percent-label { font-size: 12px; color: rgba(255,255,255,0.5); }
        .calendar-card { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 16px; margin-bottom: 20px; }
        .cal-nav { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
        .cal-nav-btn { width: 34px; height: 34px; border-radius: 10px; background: rgba(255,255,255,0.1); border: none; color: white; cursor: pointer; font-size: 14px; }
        .cal-month { font-size: 15px; font-weight: 700; }
        .cal-weekdays { display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px; margin-bottom: 5px; }
        .cal-wd { text-align: center; font-size: 10px; font-weight: 700; color: rgba(255,255,255,0.35); padding: 5px 0; }
        .cal-days { display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px; }
        .cal-day { aspect-ratio: 1; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 600; }
        .cal-day.present { background: rgba(46,213,115,0.25); color: #2ed573; }
        .cal-day.absent { background: rgba(255,107,107,0.25); color: #ff6b6b; }
        .cal-day.late { background: rgba(255,165,2,0.25); color: #ffa502; }
        .cal-day.today { border: 2px solid #667eea; }
        .fee-item { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 14px; padding: 14px; display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
        .fee-month-name { font-size: 13px; font-weight: 600; }
        .fee-amount { font-size: 12px; color: rgba(255,255,255,0.5); }
        .fee-status { padding: 4px 12px; border-radius: 8px; font-size: 10px; font-weight: 700; }
        .fee-paid { background: rgba(46,213,115,0.15); color: #2ed573; }
        .fee-due { background: rgba(255,107,107,0.15); color: #ff6b6b; }
        .notif-card { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 14px; padding: 14px; margin-bottom: 10px; }
        .notif-card.notif-new { border-left: 3px solid #667eea; }
        .notif-card-title { font-size: 14px; font-weight: 600; margin-bottom: 4px; }
        .notif-card-body { font-size: 12px; color: rgba(255,255,255,0.6); margin-bottom: 6px; }
        .notif-card-time { font-size: 10px; color: rgba(255,255,255,0.3); }
        .bottom-nav { position: fixed; bottom: 0; left: 0; right: 0; background: rgba(15,15,40,0.95); backdrop-filter: blur(20px); border-top: 1px solid rgba(255,255,255,0.08); display: flex; justify-content: space-around; padding: 10px 0; padding-bottom: calc(10px + env(safe-area-inset-bottom)); z-index: 100; }
        .nav-item { display: flex; flex-direction: column; align-items: center; gap: 3px; cursor: pointer; color: rgba(255,255,255,0.4); transition: all 0.3s; background: none; border: none; font-family: 'Poppins', sans-serif; }
        .nav-item.active { color: #667eea; }
        .nav-item.active::before { content: ''; position: absolute; top: -10px; width: 30px; height: 3px; background: #667eea; border-radius: 2px; }
        .nav-item i { font-size: 20px; }
        .nav-item span { font-size: 9px; font-weight: 600; }
        .tab-panel { display: none; }
        .tab-panel.active { display: block; }
        .empty-state { text-align: center; padding: 30px; color: rgba(255,255,255,0.3); }
        .empty-state i { font-size: 40px; display: block; margin-bottom: 10px; }
        .logout-btn { display: block; width: 100%; padding: 14px; background: rgba(255,71,87,0.15); border: 1px solid rgba(255,71,87,0.3); border-radius: 14px; color: #ff6b6b; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; text-align: center; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-top">
            <div class="student-info">
                <div class="student-avatar" id="s-avatar">S</div>
                <div class="student-greeting">
                    <span>Welcome back 👋</span>
                    <h2 id="s-name">Student</h2>
                    <span class="stu-badge" id="s-code">STU001</span>
                </div>
            </div>
            <button class="header-btn" onclick="showTab('notifications', this)">
                <i class="fas fa-bell"></i>
                <span class="notif-badge" id="notif-count">0</span>
            </button>
        </div>
    </div>

    <div class="content">
        <div class="tab-panel active" id="panel-home">
            <div class="stats-row">
                <div class="stat-mini"><div class="stat-mini-icon"><i class="fas fa-check"></i></div><div class="stat-mini-value" id="my-present">0</div><div class="stat-mini-label">Present</div></div>
                <div class="stat-mini"><div class="stat-mini-icon"><i class="fas fa-times"></i></div><div class="stat-mini-value" id="my-absent">0</div><div class="stat-mini-label">Absent</div></div>
                <div class="stat-mini"><div class="stat-mini-icon"><i class="fas fa-clock"></i></div><div class="stat-mini-value" id="my-late">0</div><div class="stat-mini-label">Late</div></div>
            </div>
            <div class="attendance-percent-card"><div class="percent-circle"><span class="percent-value" id="att-percent">0%</span></div><div class="percent-label">Overall Attendance Rate</div></div>
            <div class="section-title"><i class="fas fa-bell"></i> Recent Notifications</div>
            <div id="recent-notifs"></div>
            <button class="logout-btn" onclick="sessionStorage.clear();location.href='index.php';"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </div>

        <div class="tab-panel" id="panel-attendance">
            <div class="section-title"><i class="fas fa-calendar-alt"></i> Attendance Calendar</div>
            <div class="calendar-card">
                <div class="cal-nav">
                    <button class="cal-nav-btn" onclick="changeMonth(-1)"><i class="fas fa-chevron-left"></i></button>
                    <div class="cal-month" id="cal-month">January 2025</div>
                    <button class="cal-nav-btn" onclick="changeMonth(1)"><i class="fas fa-chevron-right"></i></button>
                </div>
                <div class="cal-weekdays"><div class="cal-wd">S</div><div class="cal-wd">M</div><div class="cal-wd">T</div><div class="cal-wd">W</div><div class="cal-wd">T</div><div class="cal-wd">F</div><div class="cal-wd">S</div></div>
                <div class="cal-days" id="cal-days"></div>
            </div>
            <div style="display:flex;gap:12px;justify-content:center;margin-bottom:20px;">
                <div style="display:flex;align-items:center;gap:5px;font-size:11px;color:rgba(255,255,255,0.5);"><div style="width:12px;height:12px;border-radius:4px;background:rgba(46,213,115,0.25);"></div>Present</div>
                <div style="display:flex;align-items:center;gap:5px;font-size:11px;color:rgba(255,255,255,0.5);"><div style="width:12px;height:12px;border-radius:4px;background:rgba(255,107,107,0.25);"></div>Absent</div>
                <div style="display:flex;align-items:center;gap:5px;font-size:11px;color:rgba(255,255,255,0.5);"><div style="width:12px;height:12px;border-radius:4px;background:rgba(255,165,2,0.25);"></div>Late</div>
            </div>
        </div>

        <div class="tab-panel" id="panel-fees">
            <div class="section-title"><i class="fas fa-money-bill-wave"></i> Fee History</div>
            <div id="my-fees"></div>
        </div>

        <div class="tab-panel" id="panel-notifications">
            <div class="section-title"><i class="fas fa-bell"></i> All Notifications</div>
            <div id="all-notifs"></div>
        </div>
    </div>

    <div class="bottom-nav">
        <button class="nav-item active" onclick="showTab('home', this)"><i class="fas fa-home"></i><span>Home</span></button>
        <button class="nav-item" onclick="showTab('attendance', this)"><i class="fas fa-calendar-check"></i><span>Attendance</span></button>
        <button class="nav-item" onclick="showTab('fees', this)"><i class="fas fa-wallet"></i><span>Fees</span></button>
        <button class="nav-item" onclick="showTab('notifications', this)"><i class="fas fa-bell"></i><span>Alerts</span></button>
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

        if (sessionStorage.getItem('studentLoggedIn') !== 'true') window.location.href = 'index.php';

        var myCode = sessionStorage.getItem('studentCode');
        var myName = sessionStorage.getItem('studentName');
        var myClass = sessionStorage.getItem('studentClass');

        document.getElementById('s-avatar').textContent = myName ? myName.charAt(0).toUpperCase() : 'S';
        document.getElementById('s-name').textContent = myName || 'Student';
        document.getElementById('s-code').textContent = myCode + ' • ' + myClass;

        var currentMonth = new Date().getMonth();
        var currentYear = new Date().getFullYear();
        var allMyAttendance = {};

        // Attendance
        db.ref('attendance').on('value', function(snapshot) {
            allMyAttendance = {};
            var present = 0, absent = 0, late = 0;
            if (snapshot.exists()) {
                var data = snapshot.val();
                for (var date in data) {
                    for (var key in data[date]) {
                        if (data[date][key].code === myCode) {
                            allMyAttendance[date] = data[date][key].status;
                            var s = data[date][key].status;
                            if (s === 'P') present++;
                            else if (s === 'A') absent++;
                            else if (s === 'L') late++;
                        }
                    }
                }
            }
            document.getElementById('my-present').textContent = present;
            document.getElementById('my-absent').textContent = absent;
            document.getElementById('my-late').textContent = late;
            var total = present + absent + late;
            var percent = total > 0 ? Math.round((present / total) * 100) : 0;
            document.getElementById('att-percent').textContent = percent + '%';
            renderCalendar();
        });

        // Fees
        db.ref('fees/' + myCode).on('value', function(snapshot) {
            var container = document.getElementById('my-fees');
            container.innerHTML = '';
            if (!snapshot.exists()) { container.innerHTML = '<div class="empty-state"><i class="fas fa-receipt"></i>No fee records</div>'; return; }
            var data = snapshot.val();
            var entries = [];
            for (var k in data) entries.push({ key: k, data: data[k] });
            entries.sort(function(a, b) { return b.key.localeCompare(a.key); });
            for (var i = 0; i < entries.length; i++) {
                var fee = entries[i].data;
                container.innerHTML += '<div class="fee-item"><div><div class="fee-month-name">' + fee.month + ' ' + fee.year + '</div><div class="fee-amount">৳' + fee.amount + '</div></div><span class="fee-status ' + (fee.status === 'Paid' ? 'fee-paid' : 'fee-due') + '">' + fee.status + '</span></div>';
            }
        });

        // Notifications
        db.ref('notifications').on('value', function(snapshot) {
            var recentContainer = document.getElementById('recent-notifs');
            var allContainer = document.getElementById('all-notifs');
            recentContainer.innerHTML = '';
            allContainer.innerHTML = '';
            if (!snapshot.exists()) {
                recentContainer.innerHTML = '<div class="empty-state"><i class="fas fa-bell-slash"></i>No notifications</div>';
                allContainer.innerHTML = '<div class="empty-state"><i class="fas fa-bell-slash"></i>No notifications</div>';
                return;
            }
            var data = snapshot.val();
            var entries = [];
            for (var k in data) entries.push({ key: k, data: data[k] });
            entries.sort(function(a, b) { return new Date(b.data.timestamp) - new Date(a.data.timestamp); });

            var count = 0, unread = 0;
            for (var i = 0; i < entries.length; i++) {
                var notif = entries[i].data;
                var codes = notif.targetCodes || [];
                var isForMe = notif.targetType === 'all' ||
                    (notif.targetType === 'class' && notif.target === myClass) ||
                    (notif.targetType === 'student' && codes.indexOf(myCode) !== -1);
                if (!isForMe) continue;

                var time = new Date(notif.timestamp).toLocaleString();
                var isNew = (Date.now() - new Date(notif.timestamp).getTime()) < 86400000;
                if (isNew) unread++;

                var card = '<div class="notif-card ' + (isNew ? 'notif-new' : '') + '"><div class="notif-card-title">' + notif.title + '</div><div class="notif-card-body">' + notif.body + '</div><div class="notif-card-time"><i class="fas fa-clock"></i> ' + time + '</div></div>';
                allContainer.innerHTML += card;
                if (count < 3) recentContainer.innerHTML += card;
                count++;

                if (isNew && 'Notification' in window && Notification.permission === 'granted') {
                    var shownKey = 'notif_shown_' + entries[i].key;
                    if (!sessionStorage.getItem(shownKey)) {
                        new Notification(notif.title, { body: notif.body });
                        sessionStorage.setItem(shownKey, 'true');
                    }
                }
            }

            if (count === 0) {
                recentContainer.innerHTML = '<div class="empty-state"><i class="fas fa-bell-slash"></i>No notifications</div>';
                allContainer.innerHTML = '<div class="empty-state"><i class="fas fa-bell-slash"></i>No notifications</div>';
            }

            var badge = document.getElementById('notif-count');
            if (unread > 0) { badge.textContent = unread; badge.style.display = 'flex'; }
            else { badge.style.display = 'none'; }
        });

        // Calendar
        function changeMonth(delta) {
            currentMonth += delta;
            if (currentMonth > 11) { currentMonth = 0; currentYear++; }
            if (currentMonth < 0) { currentMonth = 11; currentYear--; }
            renderCalendar();
        }

        function renderCalendar() {
            var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            document.getElementById('cal-month').textContent = months[currentMonth] + ' ' + currentYear;
            var firstDay = new Date(currentYear, currentMonth, 1).getDay();
            var daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            var todayDate = new Date();
            var grid = document.getElementById('cal-days');
            grid.innerHTML = '';
            for (var i = 0; i < firstDay; i++) grid.innerHTML += '<div class="cal-day"></div>';
            for (var d = 1; d <= daysInMonth; d++) {
                var dateStr = currentYear + '-' + String(currentMonth + 1).padStart(2, '0') + '-' + String(d).padStart(2, '0');
                var isToday = todayDate.getDate() === d && todayDate.getMonth() === currentMonth && todayDate.getFullYear() === currentYear;
                var status = allMyAttendance[dateStr];
                var cls = 'cal-day';
                if (isToday) cls += ' today';
                if (status === 'P') cls += ' present';
                else if (status === 'A') cls += ' absent';
                else if (status === 'L') cls += ' late';
                grid.innerHTML += '<div class="' + cls + '">' + d + '</div>';
            }
        }

        function showTab(tab, el) {
            var panels = document.querySelectorAll('.tab-panel');
            var navs = document.querySelectorAll('.nav-item');
            for (var i = 0; i < panels.length; i++) panels[i].classList.remove('active');
            for (var i = 0; i < navs.length; i++) navs[i].classList.remove('active');
            document.getElementById('panel-' + tab).classList.add('active');
            if (el) el.classList.add('active');
        }

        if ('Notification' in window && Notification.permission === 'default') Notification.requestPermission();
    </script>
</body>
</html>