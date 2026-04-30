<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Student Profile - Wahid Tuition</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #0a0a1a; color: white; min-height: 100vh; }

        .page-header {
            background: linear-gradient(135deg, #1a1a3e, #2d1b69);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
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

        .profile-hero {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 24px;
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }

        .profile-hero::before {
            content: ''; position: absolute; top: -50px; right: -50px;
            width: 150px; height: 150px; border-radius: 50%;
            background: rgba(255,255,255,0.1);
        }

        .profile-avatar {
            width: 80px; height: 80px; border-radius: 50%;
            background: rgba(255,255,255,0.25); margin: 0 auto 15px;
            display: flex; align-items: center; justify-content: center;
            font-size: 32px; font-weight: 800; border: 3px solid rgba(255,255,255,0.3);
        }

        .profile-name { font-size: 22px; font-weight: 700; }
        .profile-code { font-size: 14px; opacity: 0.8; margin-top: 5px; }
        .profile-class-badge {
            display: inline-block; padding: 6px 20px; background: rgba(255,255,255,0.2);
            border-radius: 20px; font-size: 13px; font-weight: 600; margin-top: 10px;
        }

        .info-grid {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 10px; margin-bottom: 20px;
        }

        .info-card {
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 16px 10px; text-align: center;
            animation: slideUp 0.5s ease both;
        }

        .info-card:nth-child(1) { animation-delay: 0.1s; }
        .info-card:nth-child(2) { animation-delay: 0.2s; }
        .info-card:nth-child(3) { animation-delay: 0.3s; }

        .info-value { font-size: 22px; font-weight: 800; }
        .info-label { font-size: 10px; color: rgba(255,255,255,0.5); margin-top: 4px; font-weight: 500; }

        .info-card:nth-child(1) .info-value { color: #2ed573; }
        .info-card:nth-child(2) .info-value { color: #ff6b6b; }
        .info-card:nth-child(3) .info-value { color: #ffa502; }

        .section-title {
            font-size: 15px; font-weight: 700; margin: 20px 0 12px;
            display: flex; align-items: center; gap: 8px;
        }

        .section-title i { color: #667eea; }

        .fees-item {
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px; padding: 14px; display: flex;
            align-items: center; justify-content: space-between; margin-bottom: 8px;
        }

        .fees-month { font-size: 13px; font-weight: 600; }
        .fees-status { padding: 4px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; }
        .paid { background: rgba(46,213,115,0.15); color: #2ed573; }
        .due { background: rgba(255,107,107,0.15); color: #ff6b6b; }

        .search-box {
            width: 100%; padding: 14px 16px 14px 44px;
            background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1);
            border-radius: 14px; color: white; font-family: 'Poppins', sans-serif;
            font-size: 14px; outline: none; margin-bottom: 15px;
        }

        .search-box:focus { border-color: #667eea; }
        .search-wrapper { position: relative; }
        .search-wrapper i {
            position: absolute; left: 16px; top: 50%; transform: translateY(-50%);
            color: rgba(255,255,255,0.4);
        }

        .student-list-item {
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 14px 16px; display: flex;
            align-items: center; gap: 14px; margin-bottom: 10px;
            cursor: pointer; transition: all 0.3s ease;
        }

        .student-list-item:hover {
            background: rgba(102,126,234,0.1); border-color: rgba(102,126,234,0.3);
        }

        .stu-avatar {
            width: 44px; height: 44px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 700; flex-shrink: 0;
        }

        .stu-info { flex: 1; }
        .stu-info h4 { font-size: 14px; font-weight: 600; }
        .stu-info p { font-size: 11px; color: rgba(255,255,255,0.5); }
        .stu-code { padding: 4px 10px; background: rgba(102,126,234,0.15); color: #667eea; border-radius: 8px; font-size: 10px; font-weight: 700; }

        /* Profile detail view hidden by default */
        #profile-detail { display: none; }
        #student-list-view { display: block; }

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

        .filter-chip.active {
            background: rgba(102,126,234,0.2); border-color: #667eea; color: #667eea;
        }
    </style>
</head>
<body>
    <div class="page-header">
        <button class="back-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
        <div class="page-title"><i class="fas fa-id-badge"></i> Student Profile</div>
    </div>

    <div class="content">
        <!-- Student List View -->
        <div id="student-list-view">
            <div class="search-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" class="search-box" id="search-input" placeholder="Search student by name...">
            </div>
            <div class="filter-bar" id="filter-bar">
                <div class="filter-chip active" onclick="filterClass('all', this)">All</div>
            </div>
            <div id="students-container"></div>
        </div>

        <!-- Profile Detail View -->
        <div id="profile-detail">
            <div class="profile-hero">
                <div class="profile-avatar" id="p-avatar">S</div>
                <div class="profile-name" id="p-name">Student Name</div>
                <div class="profile-code" id="p-code">STU001</div>
                <div class="profile-class-badge" id="p-class">Class 1</div>
            </div>

            <div class="info-grid">
                <div class="info-card">
                    <div class="info-value" id="p-present">0</div>
                    <div class="info-label">Present</div>
                </div>
                <div class="info-card">
                    <div class="info-value" id="p-absent">0</div>
                    <div class="info-label">Absent</div>
                </div>
                <div class="info-card">
                    <div class="info-value" id="p-late">0</div>
                    <div class="info-label">Late</div>
                </div>
            </div>

            <div class="section-title"><i class="fas fa-money-bill-wave"></i> Fees History</div>
            <div id="p-fees"></div>
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

        if (sessionStorage.getItem('adminLoggedIn') !== 'true') {
            window.location.href = 'index.php';
        }

        let allStudents = {};
        let currentFilter = 'all';

        // Check URL param
        const urlParams = new URLSearchParams(window.location.search);
        const viewKey = urlParams.get('key');

        onValue(ref(db, 'students'), (snapshot) => {
            allStudents = snapshot.exists() ? snapshot.val() : {};
            buildFilterBar();

            if (viewKey && allStudents[viewKey]) {
                showProfile(viewKey);
            } else {
                renderList();
            }
        });

        function buildFilterBar() {
            const classes = new Set();
            for (let key in allStudents) classes.add(allStudents[key].class);
            const bar = document.getElementById('filter-bar');
            bar.innerHTML = `<div class="filter-chip ${currentFilter === 'all' ? 'active' : ''}" onclick="filterClass('all', this)">All</div>`;
            [...classes].sort().forEach(c => {
                bar.innerHTML += `<div class="filter-chip ${currentFilter === c ? 'active' : ''}" onclick="filterClass('${c}', this)">${c}</div>`;
            });
        }

        window.filterClass = function(cls, el) {
            currentFilter = cls;
            document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            renderList();
        };

        function renderList() {
            const container = document.getElementById('students-container');
            const search = document.getElementById('search-input').value.toLowerCase();
            container.innerHTML = '';
            const colors = ['#667eea', '#2ed573', '#ff6b6b', '#ffa502', '#3498db', '#e056a0'];
            let i = 0;

            const entries = Object.entries(allStudents).sort((a, b) => a[1].name.localeCompare(b[1].name));

            for (let [key, stu] of entries) {
                if (currentFilter !== 'all' && stu.class !== currentFilter) continue;
                if (search && !stu.name.toLowerCase().includes(search)) continue;
                const color = colors[i % colors.length];
                container.innerHTML += `
                    <div class="student-list-item" onclick="showProfile('${key}')">
                        <div class="stu-avatar" style="background:${color}25; color:${color}">${stu.name.charAt(0).toUpperCase()}</div>
                        <div class="stu-info">
                            <h4>${stu.name}</h4>
                            <p>${stu.class}</p>
                        </div>
                        <span class="stu-code">${stu.code}</span>
                    </div>
                `;
                i++;
            }

            if (i === 0) {
                container.innerHTML = '<div style="text-align:center;padding:40px;color:rgba(255,255,255,0.3);"><i class="fas fa-user-slash" style="font-size:40px;display:block;margin-bottom:10px;"></i>No students found</div>';
            }
        }

        document.getElementById('search-input').addEventListener('input', renderList);

        window.showProfile = async function(key) {
            const stu = allStudents[key];
            if (!stu) return;

            document.getElementById('student-list-view').style.display = 'none';
            document.getElementById('profile-detail').style.display = 'block';

            document.getElementById('p-avatar').textContent = stu.name.charAt(0).toUpperCase();
            document.getElementById('p-name').textContent = stu.name;
            document.getElementById('p-code').textContent = stu.code;
            document.getElementById('p-class').textContent = stu.class;

            // Attendance stats
            const attSnap = await get(child(ref(db), 'attendance'));
            let present = 0, absent = 0, late = 0;
            if (attSnap.exists()) {
                const attData = attSnap.val();
                for (let date in attData) {
                    for (let stuKey in attData[date]) {
                        if (attData[date][stuKey].code === stu.code) {
                            const s = attData[date][stuKey].status;
                            if (s === 'P') present++;
                            else if (s === 'A') absent++;
                            else if (s === 'L') late++;
                        }
                    }
                }
            }
            document.getElementById('p-present').textContent = present;
            document.getElementById('p-absent').textContent = absent;
            document.getElementById('p-late').textContent = late;

            // Fees
            const feesSnap = await get(child(ref(db), 'fees/' + stu.code));
            const feesContainer = document.getElementById('p-fees');
            feesContainer.innerHTML = '';
            const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];

            if (feesSnap.exists()) {
                const feesData = feesSnap.val();
                for (let m in feesData) {
                    const status = feesData[m].status;
                    feesContainer.innerHTML += `
                        <div class="fees-item">
                            <span class="fees-month">${m}</span>
                            <span class="fees-status ${status === 'Paid' ? 'paid' : 'due'}">${status}</span>
                        </div>
                    `;
                }
            } else {
                feesContainer.innerHTML = '<div style="text-align:center; padding:20px; color:rgba(255,255,255,0.3); font-size:13px;">No fees records</div>';
            }

            window.currentViewKey = key;
        };

        window.goBack = function() {
            if (document.getElementById('profile-detail').style.display === 'block') {
                document.getElementById('profile-detail').style.display = 'none';
                document.getElementById('student-list-view').style.display = 'block';
                history.replaceState(null, '', 'student_profile.php');
            } else {
                location.href = 'admin.php';
            }
        };
    </script>
</body>
</html>