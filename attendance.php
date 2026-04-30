<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Mark Attendance - Wahid Tuition</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #0a0a1a; color: white; min-height: 100vh; }
        .page-header { background: linear-gradient(135deg, #1a1a3e, #2d1b69); padding: 15px 20px; display: flex; align-items: center; gap: 15px; position: sticky; top: 0; z-index: 100; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; box-shadow: 0 5px 30px rgba(0,0,0,0.5); }
        .back-btn { width: 40px; height: 40px; border-radius: 12px; background: rgba(255,255,255,0.1); border: none; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; }
        .page-title { font-size: 18px; font-weight: 700; flex: 1; }
        .content { padding: 20px; padding-bottom: 40px; }
        .date-picker-card { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 16px; margin-bottom: 15px; display: flex; align-items: center; gap: 12px; }
        .date-picker-card i { color: #667eea; font-size: 20px; }
        .date-picker-card input[type="date"] { flex: 1; background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1); border-radius: 12px; padding: 10px 14px; color: white; font-family: 'Poppins', sans-serif; font-size: 14px; outline: none; }
        .date-picker-card input[type="date"]:focus { border-color: #667eea; }
        .date-picker-card input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1); }
        .filter-bar { display: flex; gap: 8px; margin-bottom: 15px; overflow-x: auto; -webkit-overflow-scrolling: touch; padding-bottom: 5px; }
        .filter-chip { padding: 8px 16px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.6); white-space: nowrap; cursor: pointer; transition: all 0.3s; font-family: 'Poppins', sans-serif; }
        .filter-chip.active { background: rgba(102,126,234,0.2); border-color: #667eea; color: #667eea; }
        .search-wrapper { position: relative; margin-bottom: 15px; }
        .search-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.4); }
        .search-box { width: 100%; padding: 14px 16px 14px 44px; background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1); border-radius: 14px; color: white; font-family: 'Poppins', sans-serif; font-size: 14px; outline: none; }
        .search-box:focus { border-color: #667eea; }
        .attendance-card { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 14px 16px; display: flex; align-items: center; gap: 12px; margin-bottom: 10px; transition: all 0.3s; animation: slideUp 0.4s ease both; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .att-avatar { width: 44px; height: 44px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 700; flex-shrink: 0; }
        .att-info { flex: 1; }
        .att-info h4 { font-size: 13px; font-weight: 600; }
        .att-info p { font-size: 11px; color: rgba(255,255,255,0.5); }
        .att-buttons { display: flex; gap: 6px; }
        .att-btn { width: 38px; height: 38px; border-radius: 12px; border: 2px solid transparent; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 14px; font-weight: 800; transition: all 0.3s; font-family: 'Poppins', sans-serif; }
        .att-btn-p { background: rgba(46,213,115,0.15); color: #2ed573; border-color: rgba(46,213,115,0.3); }
        .att-btn-a { background: rgba(255,107,107,0.15); color: #ff6b6b; border-color: rgba(255,107,107,0.3); }
        .att-btn-l { background: rgba(255,165,2,0.15); color: #ffa502; border-color: rgba(255,165,2,0.3); }
        .att-btn.selected { transform: scale(1.15); }
        .att-btn-p.selected { background: #2ed573; color: white; box-shadow: 0 4px 15px rgba(46,213,115,0.5); }
        .att-btn-a.selected { background: #ff6b6b; color: white; box-shadow: 0 4px 15px rgba(255,107,107,0.5); }
        .att-btn-l.selected { background: #ffa502; color: white; box-shadow: 0 4px 15px rgba(255,165,2,0.5); }
        .save-btn { width: 100%; padding: 16px; background: linear-gradient(135deg, #667eea, #764ba2); border: none; border-radius: 14px; color: white; font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; cursor: pointer; margin-top: 20px; transition: all 0.3s; }
        .save-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(102,126,234,0.5); }
        .msg-box { padding: 12px 16px; border-radius: 12px; font-size: 13px; margin-bottom: 15px; display: none; }
        .msg-success { background: rgba(46,213,115,0.15); border: 1px solid rgba(46,213,115,0.3); color: #2ed573; }
        .msg-error { background: rgba(255,71,87,0.15); border: 1px solid rgba(255,71,87,0.3); color: #ff6b81; }
        .quick-action-bar { display: flex; gap: 8px; margin-bottom: 15px; }
        .quick-btn { flex: 1; padding: 10px; border-radius: 12px; border: none; font-family: 'Poppins', sans-serif; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
        .quick-btn-all-p { background: rgba(46,213,115,0.15); color: #2ed573; }
        .quick-btn-all-a { background: rgba(255,107,107,0.15); color: #ff6b6b; }
    </style>
</head>
<body>
    <div class="page-header">
        <button class="back-btn" onclick="location.href='admin.php'"><i class="fas fa-arrow-left"></i></button>
        <div class="page-title"><i class="fas fa-clipboard-check"></i> Mark Attendance</div>
    </div>
    <div class="content">
        <div class="date-picker-card"><i class="fas fa-calendar-day"></i><input type="date" id="att-date"></div>
        <div class="filter-bar" id="filter-bar"><div class="filter-chip active" onclick="filterClass('all', this)">All Classes</div></div>
        <div class="search-wrapper"><i class="fas fa-search"></i><input type="text" class="search-box" id="search-input" placeholder="Search student by name..."></div>
        <div class="quick-action-bar">
            <button class="quick-btn quick-btn-all-p" onclick="markAll('P')"><i class="fas fa-check-double"></i> All Present</button>
            <button class="quick-btn quick-btn-all-a" onclick="markAll('A')"><i class="fas fa-times"></i> All Absent</button>
        </div>
        <div id="msg-box" class="msg-box"></div>
        <div id="attendance-list"></div>
        <button class="save-btn" onclick="saveAttendance()"><i class="fas fa-save"></i> Save Attendance</button>
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

        if (sessionStorage.getItem('adminLoggedIn') !== 'true') window.location.href = 'index.php';

        var today = new Date().toISOString().split('T')[0];
        document.getElementById('att-date').value = today;

        var allStudents = {};
        var attendanceData = {};
        var currentFilter = 'all';

        db.ref('students').on('value', function(snapshot) {
            allStudents = snapshot.exists() ? snapshot.val() : {};
            buildFilterBar();
            loadAttendance();
        });

        function buildFilterBar() {
            var classes = {};
            for (var key in allStudents) classes[allStudents[key].class] = true;
            var bar = document.getElementById('filter-bar');
            bar.innerHTML = '<div class="filter-chip ' + (currentFilter === 'all' ? 'active' : '') + '" onclick="filterClass(\'all\', this)">All Classes</div>';
            var sorted = Object.keys(classes).sort();
            for (var i = 0; i < sorted.length; i++) {
                bar.innerHTML += '<div class="filter-chip ' + (currentFilter === sorted[i] ? 'active' : '') + '" onclick="filterClass(\'' + sorted[i] + '\', this)">' + sorted[i] + '</div>';
            }
        }

        function filterClass(cls, el) {
            currentFilter = cls;
            var chips = document.querySelectorAll('.filter-chip');
            for (var i = 0; i < chips.length; i++) chips[i].classList.remove('active');
            el.classList.add('active');
            renderList();
        }

        document.getElementById('att-date').addEventListener('change', loadAttendance);
        document.getElementById('search-input').addEventListener('input', renderList);

        function loadAttendance() {
            var date = document.getElementById('att-date').value;
            db.ref('attendance/' + date).once('value').then(function(snap) {
                attendanceData = {};
                if (snap.exists()) {
                    var data = snap.val();
                    for (var k in data) attendanceData[data[k].code] = data[k].status;
                }
                renderList();
            });
        }

        function renderList() {
            var container = document.getElementById('attendance-list');
            var search = document.getElementById('search-input').value.toLowerCase();
            container.innerHTML = '';
            var colors = ['#667eea','#2ed573','#ff6b6b','#ffa502','#3498db','#e056a0'];
            var i = 0;

            var entries = [];
            for (var key in allStudents) entries.push({ key: key, data: allStudents[key] });
            entries.sort(function(a, b) { return a.data.name.localeCompare(b.data.name); });

            for (var j = 0; j < entries.length; j++) {
                var stu = entries[j].data;
                if (currentFilter !== 'all' && stu.class !== currentFilter) continue;
                if (search && stu.name.toLowerCase().indexOf(search) === -1) continue;

                var color = colors[i % colors.length];
                var cs = attendanceData[stu.code] || '';

                container.innerHTML +=
                    '<div class="attendance-card" style="animation-delay:' + (i * 0.03) + 's">' +
                        '<div class="att-avatar" style="background:' + color + '25;color:' + color + '">' + stu.name.charAt(0).toUpperCase() + '</div>' +
                        '<div class="att-info"><h4>' + stu.name + '</h4><p>' + stu.code + ' • ' + stu.class + '</p></div>' +
                        '<div class="att-buttons">' +
                            '<button class="att-btn att-btn-p ' + (cs === 'P' ? 'selected' : '') + '" onclick="markStatus(\'' + stu.code + '\',\'P\',this)">P</button>' +
                            '<button class="att-btn att-btn-a ' + (cs === 'A' ? 'selected' : '') + '" onclick="markStatus(\'' + stu.code + '\',\'A\',this)">A</button>' +
                            '<button class="att-btn att-btn-l ' + (cs === 'L' ? 'selected' : '') + '" onclick="markStatus(\'' + stu.code + '\',\'L\',this)">L</button>' +
                        '</div>' +
                    '</div>';
                i++;
            }

            if (i === 0) container.innerHTML = '<div style="text-align:center;padding:40px;color:rgba(255,255,255,0.3);font-size:13px;"><i class="fas fa-users-slash" style="font-size:40px;display:block;margin-bottom:10px;"></i>No students found</div>';
        }

        function markStatus(code, status, btn) {
            attendanceData[code] = status;
            var card = btn.closest('.attendance-card');
            var btns = card.querySelectorAll('.att-btn');
            for (var i = 0; i < btns.length; i++) btns[i].classList.remove('selected');
            btn.classList.add('selected');
        }

        function markAll(status) {
            var entries = [];
            for (var key in allStudents) entries.push(allStudents[key]);
            for (var i = 0; i < entries.length; i++) {
                if (currentFilter !== 'all' && entries[i].class !== currentFilter) continue;
                attendanceData[entries[i].code] = status;
            }
            renderList();
        }

        function saveAttendance() {
            var date = document.getElementById('att-date').value;
            if (!date) { showMsg('Please select a date', 'error'); return; }

            var saveData = {};
            for (var key in allStudents) {
                var stu = allStudents[key];
                if (attendanceData[stu.code]) {
                    saveData[stu.code] = {
                        code: stu.code, name: stu.name,
                        class: stu.class, status: attendanceData[stu.code], date: date
                    };
                }
            }

            if (Object.keys(saveData).length === 0) { showMsg('Please mark at least one student', 'error'); return; }

            db.ref('attendance/' + date).set(saveData)
                .then(function() { showMsg('Attendance saved successfully!', 'success'); })
                .catch(function(err) { showMsg('Error: ' + err.message, 'error'); });
        }

        function showMsg(text, type) {
            var box = document.getElementById('msg-box');
            box.className = 'msg-box msg-' + type;
            box.innerHTML = '<i class="fas fa-' + (type === 'success' ? 'check' : 'exclamation') + '-circle"></i> ' + text;
            box.style.display = 'block';
            setTimeout(function() { box.style.display = 'none'; }, 3000);
        }
    </script>
</body>
</html>