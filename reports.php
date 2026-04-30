<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Reports - Wahid Tuition</title>
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

        .tab-container {
            display: flex; background: rgba(255,255,255,0.08); border-radius: 14px;
            padding: 4px; margin-bottom: 20px;
        }

        .tab-btn {
            flex: 1; padding: 12px 8px; border: none; background: transparent;
            color: rgba(255,255,255,0.5); font-family: 'Poppins', sans-serif;
            font-size: 12px; font-weight: 600; border-radius: 10px;
            cursor: pointer; transition: all 0.3s;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white; box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }

        .tab-content { display: none; animation: fadeIn 0.4s ease; }
        .tab-content.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        .send-card {
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px; padding: 20px; margin-bottom: 20px;
        }

        .card-title {
            font-size: 15px; font-weight: 700; margin-bottom: 15px;
            display: flex; align-items: center; gap: 8px;
        }

        .card-title i { color: #667eea; }

        .input-group { margin-bottom: 14px; }
        .input-group label {
            display: block; font-size: 12px; color: rgba(255,255,255,0.6);
            margin-bottom: 6px; font-weight: 500;
        }

        .input-group input, .input-group select, .input-group textarea {
            width: 100%; padding: 12px 14px;
            background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1);
            border-radius: 12px; color: white; font-family: 'Poppins', sans-serif;
            font-size: 14px; outline: none; transition: all 0.3s;
        }

        .input-group input:focus, .input-group select:focus, .input-group textarea:focus { border-color: #667eea; }
        .input-group select option { background: #1a1a3e; }
        .input-group textarea { resize: vertical; min-height: 100px; }

        .send-btn {
            width: 100%; padding: 14px; border: none; border-radius: 14px;
            font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 600;
            cursor: pointer; transition: all 0.3s; color: white;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .send-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(102,126,234,0.5); }

        .notif-item {
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 14px; padding: 14px; margin-bottom: 10px;
            animation: slideUp 0.4s ease both;
        }

        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .notif-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;
        }

        .notif-target {
            padding: 3px 10px; border-radius: 8px; font-size: 10px; font-weight: 700;
        }

        .target-class { background: rgba(102,126,234,0.15); color: #667eea; }
        .target-student { background: rgba(46,213,115,0.15); color: #2ed573; }
        .target-all { background: rgba(255,165,2,0.15); color: #ffa502; }

        .notif-time { font-size: 10px; color: rgba(255,255,255,0.4); }
        .notif-title { font-size: 14px; font-weight: 600; margin-bottom: 4px; }
        .notif-body { font-size: 12px; color: rgba(255,255,255,0.6); }

        .msg-box {
            padding: 12px 16px; border-radius: 12px; font-size: 13px; margin-bottom: 15px; display: none;
            background: rgba(46,213,115,0.15); border: 1px solid rgba(46,213,115,0.3); color: #2ed573;
        }

        .empty-state {
            text-align: center; padding: 40px; color: rgba(255,255,255,0.3);
        }

        .empty-state i { font-size: 40px; display: block; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="page-header">
        <button class="back-btn" onclick="location.href='admin.php'"><i class="fas fa-arrow-left"></i></button>
        <div class="page-title"><i class="fas fa-paper-plane"></i> Reports & Messages</div>
    </div>

    <div class="content">
        <div class="tab-container">
            <button class="tab-btn active" onclick="switchTab('send', this)"><i class="fas fa-paper-plane"></i> Send</button>
            <button class="tab-btn" onclick="switchTab('history', this)"><i class="fas fa-history"></i> History</button>
        </div>

        <div id="msg-box" class="msg-box"></div>

        <!-- Send Tab -->
        <div class="tab-content active" id="tab-send">
            <div class="send-card">
                <div class="card-title"><i class="fas fa-bullhorn"></i> Send Notification</div>

                <div class="input-group">
                    <label>Send To</label>
                    <select id="send-to" onchange="updateSendTarget()">
                        <option value="all">All Students</option>
                        <option value="class">Specific Class</option>
                        <option value="student">Specific Student</option>
                    </select>
                </div>

                <div class="input-group" id="class-select-group" style="display:none;">
                    <label>Select Class</label>
                    <select id="target-class"></select>
                </div>

                <div class="input-group" id="student-select-group" style="display:none;">
                    <label>Select Student</label>
                    <select id="target-student"></select>
                </div>

                <div class="input-group">
                    <label>Title</label>
                    <input type="text" id="notif-title" placeholder="Notification title">
                </div>

                <div class="input-group">
                    <label>Message</label>
                    <textarea id="notif-body" placeholder="Write your message here..."></textarea>
                </div>

                <button class="send-btn" onclick="sendNotification()">
                    <i class="fas fa-paper-plane"></i> Send Notification
                </button>
            </div>
        </div>

        <!-- History Tab -->
        <div class="tab-content" id="tab-history">
            <div id="notif-history"></div>
        </div>
    </div>

    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.5.2/firebase-app.js";
        import { getDatabase, ref, set, push, onValue } from "https://www.gstatic.com/firebasejs/10.5.2/firebase-database.js";

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

        onValue(ref(db, 'students'), (snapshot) => {
            allStudents = snapshot.exists() ? snapshot.val() : {};
            populateSelects();
        });

        onValue(ref(db, 'notifications'), (snapshot) => {
            const container = document.getElementById('notif-history');
            container.innerHTML = '';
            if (!snapshot.exists()) {
                container.innerHTML = '<div class="empty-state"><i class="fas fa-bell-slash"></i>No notifications sent yet</div>';
                return;
            }

            const data = snapshot.val();
            const entries = Object.entries(data).sort((a, b) => new Date(b[1].timestamp) - new Date(a[1].timestamp));

            entries.forEach(([key, notif], idx) => {
                const targetClass = notif.targetType === 'class' ? 'target-class' : notif.targetType === 'student' ? 'target-student' : 'target-all';
                const targetLabel = notif.targetType === 'all' ? 'All Students' : notif.target;
                const time = new Date(notif.timestamp).toLocaleString();

                container.innerHTML += `
                    <div class="notif-item" style="animation-delay:${idx * 0.05}s">
                        <div class="notif-header">
                            <span class="notif-target ${targetClass}">${targetLabel}</span>
                            <span class="notif-time">${time}</span>
                        </div>
                        <div class="notif-title">${notif.title}</div>
                        <div class="notif-body">${notif.body}</div>
                    </div>
                `;
            });
        });

        function populateSelects() {
            const classSelect = document.getElementById('target-class');
            const studentSelect = document.getElementById('target-student');
            const classes = new Set();

            classSelect.innerHTML = '<option value="">Select Class</option>';
            studentSelect.innerHTML = '<option value="">Select Student</option>';

            for (let k in allStudents) {
                classes.add(allStudents[k].class);
                studentSelect.innerHTML += `<option value="${allStudents[k].code}">${allStudents[k].name} (${allStudents[k].code})</option>`;
            }

            [...classes].sort().forEach(c => {
                classSelect.innerHTML += `<option value="${c}">${c}</option>`;
            });
        }

        window.updateSendTarget = function() {
            const type = document.getElementById('send-to').value;
            document.getElementById('class-select-group').style.display = type === 'class' ? 'block' : 'none';
            document.getElementById('student-select-group').style.display = type === 'student' ? 'block' : 'none';
        };

        window.sendNotification = async function() {
            const type = document.getElementById('send-to').value;
            const title = document.getElementById('notif-title').value.trim();
            const body = document.getElementById('notif-body').value.trim();

            if (!title || !body) {
                alert('Please fill title and message');
                return;
            }

            let target = 'All Students';
            let targetType = 'all';
            let targetCodes = [];

            if (type === 'class') {
                target = document.getElementById('target-class').value;
                targetType = 'class';
                if (!target) { alert('Select a class'); return; }
                for (let k in allStudents) {
                    if (allStudents[k].class === target) targetCodes.push(allStudents[k].code);
                }
            } else if (type === 'student') {
                const code = document.getElementById('target-student').value;
                if (!code) { alert('Select a student'); return; }
                target = code;
                targetType = 'student';
                targetCodes.push(code);
            } else {
                for (let k in allStudents) targetCodes.push(allStudents[k].code);
            }

            const notifData = {
                title, body, target, targetType,
                targetCodes: targetCodes,
                timestamp: new Date().toISOString(),
                read: false
            };

            await push(ref(db, 'notifications'), notifData);

            document.getElementById('notif-title').value = '';
            document.getElementById('notif-body').value = '';
            showMsg('Notification sent successfully!');

            // Push notification (browser)
            if ('Notification' in window && Notification.permission === 'granted') {
                new Notification(title, { body: body, icon: '🎓' });
            }
        };

        window.switchTab = function(tab, el) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            document.getElementById('tab-' + tab).classList.add('active');
        };

        function showMsg(text) {
            const box = document.getElementById('msg-box');
            box.innerHTML = `<i class="fas fa-check-circle"></i> ${text}`;
            box.style.display = 'block';
            setTimeout(() => box.style.display = 'none', 3000);
        }

        // Request notification permission
        if ('Notification' in window) Notification.requestPermission();
    </script>
</body>
</html>