<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Wahid Tuition Management App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh; display: flex;
            justify-content: center; align-items: center;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            overflow: hidden;
        }

        .particles { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 0; }
        .particle {
            position: absolute; width: 6px; height: 6px;
            background: rgba(255,255,255,0.3); border-radius: 50%;
            animation: float linear infinite;
        }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 1; } 90% { opacity: 1; }
            100% { transform: translateY(-10vh) rotate(720deg); opacity: 0; }
        }

        .login-container { width: 100%; max-width: 420px; padding: 20px; position: relative; z-index: 10; }

        .app-logo { text-align: center; margin-bottom: 30px; animation: slideDown 0.8s ease-out; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-50px); } to { opacity: 1; transform: translateY(0); } }

        .logo-icon {
            width: 90px; height: 90px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 25px; display: flex; align-items: center;
            justify-content: center; margin: 0 auto 15px;
            box-shadow: 0 15px 35px rgba(102,126,234,0.4);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }
        .logo-icon i { font-size: 40px; color: white; }
        .app-name { font-size: 22px; font-weight: 800; color: white; text-transform: uppercase; letter-spacing: 1px; }
        .app-subtitle { font-size: 12px; color: rgba(255,255,255,0.6); letter-spacing: 3px; text-transform: uppercase; margin-top: 5px; }

        .login-card {
            background: rgba(255,255,255,0.08); backdrop-filter: blur(30px);
            border: 1px solid rgba(255,255,255,0.12); border-radius: 24px;
            padding: 35px 25px; animation: slideUp 0.8s ease-out 0.2s both;
        }

        @keyframes slideUp { from { opacity: 0; transform: translateY(50px); } to { opacity: 1; transform: translateY(0); } }

        .tab-container {
            display: flex; background: rgba(255,255,255,0.08);
            border-radius: 16px; padding: 5px; margin-bottom: 30px;
        }

        .tab-btn {
            flex: 1; padding: 12px; border: none; background: transparent;
            color: rgba(255,255,255,0.5); font-family: 'Poppins', sans-serif;
            font-size: 14px; font-weight: 600; border-radius: 12px;
            cursor: pointer; transition: all 0.3s ease;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white; box-shadow: 0 5px 20px rgba(102,126,234,0.4);
        }

        .tab-btn i { margin-right: 6px; }
        .form-section { display: none; }
        .form-section.active { display: block; animation: fadeIn 0.4s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        .input-group { margin-bottom: 20px; position: relative; }
        .input-group label { display: block; color: rgba(255,255,255,0.7); font-size: 13px; font-weight: 500; margin-bottom: 8px; }
        .input-wrapper { position: relative; display: flex; align-items: center; }

        .input-wrapper .icon-left {
            position: absolute; left: 16px; color: rgba(255,255,255,0.4);
            font-size: 16px; z-index: 2; pointer-events: none; transition: color 0.3s;
        }

        .input-wrapper input {
            width: 100%; padding: 14px 16px 14px 48px;
            background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1);
            border-radius: 14px; color: white; font-family: 'Poppins', sans-serif;
            font-size: 14px; outline: none; transition: all 0.3s;
        }

        .input-wrapper input::placeholder { color: rgba(255,255,255,0.3); }
        .input-wrapper input:focus { border-color: #667eea; background: rgba(102,126,234,0.1); }

        .toggle-password {
            position: absolute; right: 16px; cursor: pointer;
            color: rgba(255,255,255,0.4); z-index: 2;
        }

        .login-btn {
            width: 100%; padding: 16px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none; border-radius: 14px; color: white;
            font-family: 'Poppins', sans-serif; font-size: 16px;
            font-weight: 600; cursor: pointer; transition: all 0.3s;
            margin-top: 10px;
        }

        .login-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(102,126,234,0.5); }
        .login-btn:active { transform: translateY(0); }
        .login-btn.loading .btn-text { display: none; }
        .login-btn .btn-loader { display: none; }
        .login-btn.loading .btn-loader {
            display: inline-block; width: 22px; height: 22px;
            border: 3px solid rgba(255,255,255,0.3); border-top-color: white;
            border-radius: 50%; animation: spin 0.8s linear infinite;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        .error-msg {
            background: rgba(255,71,87,0.15); border: 1px solid rgba(255,71,87,0.3);
            color: #ff6b81; padding: 12px 16px; border-radius: 12px;
            font-size: 13px; margin-bottom: 15px; display: none;
            animation: shake 0.5s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .success-msg {
            background: rgba(46,213,115,0.15); border: 1px solid rgba(46,213,115,0.3);
            color: #2ed573; padding: 12px 16px; border-radius: 12px;
            font-size: 13px; margin-bottom: 15px; display: none;
        }

        .footer-text {
            text-align: center; margin-top: 25px;
            color: rgba(255,255,255,0.3); font-size: 11px;
        }

        .footer-text span { color: #667eea; }

        .shape { position: fixed; border-radius: 50%; opacity: 0.1; z-index: 0; }
        .shape-1 { width: 300px; height: 300px; background: #667eea; top: -100px; right: -100px; animation: floatShape 6s ease-in-out infinite; }
        .shape-2 { width: 200px; height: 200px; background: #764ba2; bottom: -50px; left: -50px; animation: floatShape 8s ease-in-out infinite reverse; }

        @keyframes floatShape {
            0%, 100% { transform: translate(0,0) rotate(0deg); }
            33% { transform: translate(30px,-30px) rotate(120deg); }
            66% { transform: translate(-20px,20px) rotate(240deg); }
        }
    </style>
</head>
<body>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="particles" id="particles"></div>

    <div class="login-container">
        <div class="app-logo">
            <div class="logo-icon"><i class="fas fa-graduation-cap"></i></div>
            <div class="app-name">Wahid Tuition</div>
            <div class="app-subtitle">Management App</div>
        </div>

        <div class="login-card">
            <div class="tab-container">
                <button class="tab-btn active" onclick="switchTab('admin', this)">
                    <i class="fas fa-user-shield"></i>Admin
                </button>
                <button class="tab-btn" onclick="switchTab('student', this)">
                    <i class="fas fa-user-graduate"></i>Student
                </button>
            </div>

            <div id="error-box" class="error-msg">
                <i class="fas fa-exclamation-circle"></i> <span id="error-text"></span>
            </div>
            <div id="success-box" class="success-msg">
                <i class="fas fa-check-circle"></i> <span id="success-text"></span>
            </div>

            <!-- Admin Login -->
            <div id="admin-form" class="form-section active">
                <div class="input-group">
                    <label>Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope icon-left"></i>
                        <input type="email" id="admin-email" placeholder="Enter admin email">
                    </div>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock icon-left"></i>
                        <input type="password" id="admin-password" placeholder="Enter password">
                        <i class="fas fa-eye toggle-password" onclick="togglePass('admin-password', this)"></i>
                    </div>
                </div>
                <button class="login-btn" id="admin-login-btn" onclick="adminLogin()">
                    <span class="btn-text"><i class="fas fa-sign-in-alt"></i> Login as Admin</span>
                    <div class="btn-loader"></div>
                </button>
            </div>

            <!-- Student Login -->
            <div id="student-form" class="form-section">
                <div class="input-group">
                    <label>Student Code</label>
                    <div class="input-wrapper">
                        <i class="fas fa-id-card icon-left"></i>
                        <input type="text" id="student-code" placeholder="e.g. STU001" style="text-transform:uppercase;">
                    </div>
                </div>
                <div class="input-group">
                    <label>Student Name</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user icon-left"></i>
                        <input type="text" id="student-name" placeholder="Enter your full name">
                    </div>
                </div>
                <button class="login-btn" id="student-login-btn" onclick="studentLogin()">
                    <span class="btn-text"><i class="fas fa-sign-in-alt"></i> Login as Student</span>
                    <div class="btn-loader"></div>
                </button>
            </div>
        </div>

        <div class="footer-text">Powered by <span>Wahid Tuition</span> &copy; 2025</div>
    </div>

    <!-- Firebase v8 Compat -->
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

        // Particles
        function createParticles() {
            var container = document.getElementById('particles');
            for (var i = 0; i < 30; i++) {
                var p = document.createElement('div');
                p.classList.add('particle');
                p.style.left = Math.random() * 100 + '%';
                p.style.animationDuration = (Math.random() * 10 + 5) + 's';
                p.style.animationDelay = (Math.random() * 5) + 's';
                p.style.width = (Math.random() * 4 + 2) + 'px';
                p.style.height = p.style.width;
                container.appendChild(p);
            }
        }
        createParticles();

        function switchTab(tab, el) {
            var tabs = document.querySelectorAll('.tab-btn');
            var forms = document.querySelectorAll('.form-section');
            for (var i = 0; i < tabs.length; i++) tabs[i].classList.remove('active');
            for (var i = 0; i < forms.length; i++) forms[i].classList.remove('active');
            el.classList.add('active');
            document.getElementById(tab + '-form').classList.add('active');
            hideMessages();
        }

        function togglePass(id, el) {
            var inp = document.getElementById(id);
            if (inp.type === 'password') {
                inp.type = 'text';
                el.classList.remove('fa-eye');
                el.classList.add('fa-eye-slash');
            } else {
                inp.type = 'password';
                el.classList.remove('fa-eye-slash');
                el.classList.add('fa-eye');
            }
        }

        function showError(msg) {
            document.getElementById('error-text').textContent = msg;
            document.getElementById('error-box').style.display = 'block';
            document.getElementById('success-box').style.display = 'none';
        }

        function showSuccess(msg) {
            document.getElementById('success-text').textContent = msg;
            document.getElementById('success-box').style.display = 'block';
            document.getElementById('error-box').style.display = 'none';
        }

        function hideMessages() {
            document.getElementById('error-box').style.display = 'none';
            document.getElementById('success-box').style.display = 'none';
        }

        function adminLogin() {
            var email = document.getElementById('admin-email').value.trim();
            var password = document.getElementById('admin-password').value.trim();
            var btn = document.getElementById('admin-login-btn');

            if (!email || !password) { showError('Please fill in all fields'); return; }

            btn.classList.add('loading');

            db.ref('admin/credentials').once('value')
                .then(function(snapshot) {
                    var adminEmail = 'admin@gmail.com';
                    var adminPass = '238890';

                    if (snapshot.exists()) {
                        var data = snapshot.val();
                        adminEmail = data.email || adminEmail;
                        adminPass = data.password || adminPass;
                    }

                    if (email === adminEmail && password === adminPass) {
                        showSuccess('Login Successful! Redirecting...');
                        sessionStorage.setItem('adminLoggedIn', 'true');
                        setTimeout(function() { window.location.href = 'admin.php'; }, 1000);
                    } else {
                        showError('Invalid email or password');
                        btn.classList.remove('loading');
                    }
                })
                .catch(function(error) {
                    if (email === 'admin@gmail.com' && password === '238890') {
                        showSuccess('Login Successful! Redirecting...');
                        sessionStorage.setItem('adminLoggedIn', 'true');
                        setTimeout(function() { window.location.href = 'admin.php'; }, 1000);
                    } else {
                        showError('Invalid email or password');
                        btn.classList.remove('loading');
                    }
                });
        }

        function studentLogin() {
            var code = document.getElementById('student-code').value.trim().toUpperCase();
            var name = document.getElementById('student-name').value.trim();
            var btn = document.getElementById('student-login-btn');

            if (!code || !name) { showError('Please fill in all fields'); return; }

            btn.classList.add('loading');

            db.ref('students').once('value')
                .then(function(snapshot) {
                    if (snapshot.exists()) {
                        var students = snapshot.val();
                        var found = false;
                        for (var key in students) {
                            if (students[key].code === code && students[key].name.toLowerCase() === name.toLowerCase()) {
                                found = true;
                                showSuccess('Login Successful! Redirecting...');
                                sessionStorage.setItem('studentLoggedIn', 'true');
                                sessionStorage.setItem('studentCode', code);
                                sessionStorage.setItem('studentName', students[key].name);
                                sessionStorage.setItem('studentKey', key);
                                sessionStorage.setItem('studentClass', students[key].class);
                                setTimeout(function() { window.location.href = 'student.php'; }, 1000);
                                break;
                            }
                        }
                        if (!found) {
                            showError('Invalid student code or name');
                            btn.classList.remove('loading');
                        }
                    } else {
                        showError('No students registered yet');
                        btn.classList.remove('loading');
                    }
                })
                .catch(function(error) {
                    showError('Connection error: ' + error.message);
                    btn.classList.remove('loading');
                });
        }

        document.getElementById('admin-password').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') adminLogin();
        });
        document.getElementById('student-name').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') studentLogin();
        });
    </script>
</body>
</html>