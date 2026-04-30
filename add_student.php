<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Add Student - Wahid Tuition</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #0a0a1a; color: white; min-height: 100vh; }
        .page-header { background: linear-gradient(135deg, #1a1a3e, #2d1b69); padding: 15px 20px; display: flex; align-items: center; gap: 15px; position: sticky; top: 0; z-index: 100; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; box-shadow: 0 5px 30px rgba(0,0,0,0.5); }
        .back-btn { width: 40px; height: 40px; border-radius: 12px; background: rgba(255,255,255,0.1); border: none; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; }
        .page-title { font-size: 18px; font-weight: 700; }
        .content { padding: 20px; padding-bottom: 100px; }
        .add-form-card { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 24px 20px; margin-bottom: 25px; animation: slideUp 0.5s ease-out; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .form-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .form-title i { color: #667eea; }
        .input-group { margin-bottom: 18px; }
        .input-group label { display: block; font-size: 13px; color: rgba(255,255,255,0.7); margin-bottom: 8px; font-weight: 500; }
        .input-group input, .input-group select { width: 100%; padding: 14px 16px; background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1); border-radius: 14px; color: white; font-family: 'Poppins', sans-serif; font-size: 14px; outline: none; transition: all 0.3s; }
        .input-group input:focus, .input-group select:focus { border-color: #667eea; background: rgba(102,126,234,0.1); }
        .input-group select option { background: #1a1a3e; color: white; }
        .submit-btn { width: 100%; padding: 16px; background: linear-gradient(135deg, #667eea, #764ba2); border: none; border-radius: 14px; color: white; font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; }
        .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(102,126,234,0.5); }
        .msg-box { padding: 12px 16px; border-radius: 12px; font-size: 13px; margin-bottom: 15px; display: none; }
        .msg-success { background: rgba(46,213,115,0.15); border: 1px solid rgba(46,213,115,0.3); color: #2ed573; }
        .msg-error { background: rgba(255,71,87,0.15); border: 1px solid rgba(255,71,87,0.3); color: #ff6b81; }
        .student-list-title { font-size: 16px; font-weight: 700; margin-bottom: 15px; display: flex; align-items: center; justify-content: space-between; }
        .student-count { font-size: 12px; background: rgba(102,126,234,0.2); color: #667eea; padding: 4px 12px; border-radius: 20px; font-weight: 600; }
        .student-item { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08); border-radius: 16px; padding: 14px 16px; display: flex; align-items: center; gap: 14px; margin-bottom: 10px; transition: all 0.3s; cursor: pointer; }
        .student-item:hover { background: rgba(102,126,234,0.1); border-color: rgba(102,126,234,0.3); }
        .student-avatar { width: 46px; height: 46px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 700; flex-shrink: 0; }
        .student-details { flex: 1; }
        .student-details h4 { font-size: 14px; font-weight: 600; }
        .student-details p { font-size: 11px; color: rgba(255,255,255,0.5); }
        .student-code-badge { padding: 5px 12px; background: rgba(102,126,234,0.15); color: #667eea; border-radius: 10px; font-size: 11px; font-weight: 700; }
        .delete-btn { width: 36px; height: 36px; border-radius: 10px; background: rgba(255,71,87,0.15); border: none; color: #ff6b81; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .filter-bar { display: flex; gap: 8px; margin-bottom: 15px; overflow-x: auto; -webkit-overflow-scrolling: touch; padding-bottom: 5px; }
        .filter-chip { padding: 8px 16px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; font-size: 12px; font-weight: 600; color: rgba(255,255,255,0.6); white-space: nowrap; cursor: pointer; transition: all 0.3s; font-family: 'Poppins', sans-serif; }
        .filter-chip.active { background: rgba(102,126,234,0.2); border-color: #667eea; color: #667eea; }
        .empty-state { text-align: center; padding: 40px 20px; color: rgba(255,255,255,0.3); }
        .empty-state i { font-size: 50px; margin-bottom: 15px; display: block; }
    </style>
</head>
<body>
    <div class="page-header">
        <button class="back-btn" onclick="location.href='admin.php'"><i class="fas fa-arrow-left"></i></button>
        <div class="page-title"><i class="fas fa-user-plus"></i> Add Student</div>
    </div>
    <div class="content">
        <div class="add-form-card">
            <div class="form-title"><i class="fas fa-user-graduate"></i> New Student Registration</div>
            <div id="msg-box" class="msg-box"></div>
            <div class="input-group">
                <label>Student Name</label>
                <input type="text" id="stu-name" placeholder="Enter full name">
            </div>
            <div class="input-group">
                <label>Class</label>
                <select id="stu-class">
                    <option value="">Select Class</option>
                    <option>Class 1</option><option>Class 2</option><option>Class 3</option>
                    <option>Class 4</option><option>Class 5</option><option>Class 6</option>
                    <option>Class 7</option><option>Class 8</option><option>Class 9</option>
                    <option>Class 10</option><option>Class 11</option><option>Class 12</option>
                </select>
            </div>
            <div class="input-group">
                <label>Phone (Optional)</label>
                <input type="tel" id="stu-phone" placeholder="Guardian phone number">
            </div>
            <button class="submit-btn" onclick="addStudent()"><i class="fas fa-plus-circle"></i> Add Student</button>
        </div>
        <div class="student-list-title">
            <span><i class="fas fa-list" style="color:#667eea;margin-right:8px;"></i>Student List</span>
            <span class="student-count" id="student-count">0 Students</span>
        </div>
        <div class="filter-bar" id="filter-bar"><div class="filter-chip active" onclick="filterClass('all', this)">All</div></div>
        <div id="student-list"></div>
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

        var allStudents = {};
        var currentFilter = 'all';

        function addStudent() {
            var name = document.getElementById('stu-name').value.trim();
            var stuClass = document.getElementById('stu-class').value;
            var phone = document.getElementById('stu-phone').value.trim();

            if (!name || !stuClass) { showMsg('Please fill name and class', 'error'); return; }

            db.ref('students').once('value').then(function(snapshot) {
                var maxNum = 0;
                if (snapshot.exists()) {
                    var data = snapshot.val();
                    for (var key in data) {
                        var code = data[key].code || '';
                        var num = parseInt(code.replace('STU', ''));
                        if (num > maxNum) maxNum = num;
                    }
                }
                var newCode = 'STU' + String(maxNum + 1).padStart(3, '0');

                return db.ref('students').push().set({
                    name: name,
                    class: stuClass,
                    phone: phone,
                    code: newCode,
                    createdAt: new Date().toISOString()
                }).then(function() {
                    showMsg('Student added! Code: ' + newCode, 'success');
                    document.getElementById('stu-name').value = '';
                    document.getElementById('stu-class').value = '';
                    document.getElementById('stu-phone').value = '';
                });
            }).catch(function(error) {
                showMsg('Error: ' + error.message, 'error');
            });
        }

        function showMsg(text, type) {
            var box = document.getElementById('msg-box');
            box.className = 'msg-box msg-' + type;
            box.innerHTML = '<i class="fas fa-' + (type === 'success' ? 'check' : 'exclamation') + '-circle"></i> ' + text;
            box.style.display = 'block';
            setTimeout(function() { box.style.display = 'none'; }, 4000);
        }

        db.ref('students').on('value', function(snapshot) {
            allStudents = snapshot.exists() ? snapshot.val() : {};
            buildFilterBar();
            renderStudents();
        });

        function buildFilterBar() {
            var classes = {};
            for (var key in allStudents) classes[allStudents[key].class] = true;
            var bar = document.getElementById('filter-bar');
            bar.innerHTML = '<div class="filter-chip ' + (currentFilter === 'all' ? 'active' : '') + '" onclick="filterClass(\'all\', this)">All</div>';
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
            renderStudents();
        }

        function renderStudents() {
            var container = document.getElementById('student-list');
            container.innerHTML = '';
            var count = 0;
            var colors = ['#667eea','#2ed573','#ff6b6b','#ffa502','#3498db','#e056a0','#1abc9c','#9b59b6'];

            var entries = [];
            for (var key in allStudents) entries.push({ key: key, data: allStudents[key] });
            entries.sort(function(a, b) { return a.data.name.localeCompare(b.data.name); });

            for (var i = 0; i < entries.length; i++) {
                var key = entries[i].key;
                var stu = entries[i].data;
                if (currentFilter !== 'all' && stu.class !== currentFilter) continue;
                var color = colors[count % colors.length];
                container.innerHTML +=
                    '<div class="student-item" onclick="location.href=\'student_profile.php?key=' + key + '\'">' +
                        '<div class="student-avatar" style="background:' + color + '25;color:' + color + '">' + stu.name.charAt(0).toUpperCase() + '</div>' +
                        '<div class="student-details"><h4>' + stu.name + '</h4><p>' + stu.class + (stu.phone ? ' • ' + stu.phone : '') + '</p></div>' +
                        '<span class="student-code-badge">' + stu.code + '</span>' +
                        '<button class="delete-btn" onclick="event.stopPropagation();deleteStudent(\'' + key + '\')"><i class="fas fa-trash"></i></button>' +
                    '</div>';
                count++;
            }

            document.getElementById('student-count').textContent = count + ' Students';
            if (count === 0) container.innerHTML = '<div class="empty-state"><i class="fas fa-user-slash"></i>No students found</div>';
        }

        function deleteStudent(key) {
            if (confirm('Delete this student?')) {
                db.ref('students/' + key).remove();
            }
        }
    </script>
</body>
</html>