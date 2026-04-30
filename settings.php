<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Settings - Wahid Tuition</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #0a0a1a; color: white; min-height: 100vh; }
        .page-header { background: linear-gradient(135deg, #1a1a3e, #2d1b69); padding: 15px 20px; display: flex; align-items: center; gap: 15px; position: sticky; top: 0; z-index: 100; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; box-shadow: 0 5px 30px rgba(0,0,0,0.5); }
        .back-btn { width: 40px; height: 40px; border-radius: 12px; background: rgba(255,255,255,0.1); border: none; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 18px; }
        .page-title { font-size: 18px; font-weight: 700; }
        .content { padding: 20px; padding-bottom: 40px; }
        .settings-card { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08); border-radius: 20px; padding: 24px 20px; margin-bottom: 20px; animation: slideUp 0.5s ease both; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .card-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
        .card-title i { color: #667eea; }
        .input-group { margin-bottom: 16px; }
        .input-group label { display: block; font-size: 13px; color: rgba(255,255,255,0.6); margin-bottom: 8px; font-weight: 500; }
        .input-group input { width: 100%; padding: 14px 16px; background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1); border-radius: 14px; color: white; font-family: 'Poppins', sans-serif; font-size: 14px; outline: none; transition: all 0.3s; }
        .input-group input:focus { border-color: #667eea; }
        .save-btn { width: 100%; padding: 14px; border: none; border-radius: 14px; font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; color: white; background: linear-gradient(135deg, #667eea, #764ba2); }
        .save-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(102,126,234,0.5); }
        .danger-btn { width: 100%; padding: 14px; border: none; border-radius: 14px; font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 600; cursor: pointer; transition: all 0.3s; color: white; background: linear-gradient(135deg, #ff6b6b, #ee5a24); margin-top: 10px; }
        .msg-box { padding: 12px 16px; border-radius: 12px; font-size: 13px; margin-bottom: 15px; display: none; }
        .msg-success { background: rgba(46,213,115,0.15); border: 1px solid rgba(46,213,115,0.3); color: #2ed573; }
        .msg-error { background: rgba(255,71,87,0.15); border: 1px solid rgba(255,71,87,0.3); color: #ff6b81; }
        .info-item { display: flex; align-items: center; gap: 14px; padding: 14px; background: rgba(255,255,255,0.05); border-radius: 14px; margin-bottom: 10px; }
        .info-icon { width: 44px; height: 44px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
        .info-text { flex: 1; }
        .info-text h4 { font-size: 13px; font-weight: 600; }
        .info-text p { font-size: 11px; color: rgba(255,255,255,0.5); }
    </style>
</head>
<body>
    <div class="page-header">
        <button class="back-btn" onclick="location.href='admin.php'"><i class="fas fa-arrow-left"></i></button>
        <div class="page-title"><i class="fas fa-cog"></i> Settings</div>
    </div>
    <div class="content">
        <div id="msg-box" class="msg-box"></div>
        <div class="settings-card">
            <div class="card-title"><i class="fas fa-user-shield"></i> Admin Credentials</div>
            <div class="input-group"><label>Admin Email</label><input type="email" id="admin-email" placeholder="admin@gmail.com"></div>
            <div class="input-group"><label>Current Password</label><input type="password" id="current-pass" placeholder="Enter current password"></div>
            <div class="input-group"><label>New Password</label><input type="password" id="new-pass" placeholder="Enter new password"></div>
            <div class="input-group"><label>Confirm New Password</label><input type="password" id="confirm-pass" placeholder="Confirm new password"></div>
            <button class="save-btn" onclick="updateCredentials()"><i class="fas fa-save"></i> Update Credentials</button>
        </div>
        <div class="settings-card" style="animation-delay:0.2s;">
            <div class="card-title"><i class="fas fa-info-circle"></i> App Information</div>
            <div class="info-item"><div class="info-icon" style="background:rgba(102,126,234,0.2);color:#667eea;"><i class="fas fa-graduation-cap"></i></div><div class="info-text"><h4>Wahid Tuition Management App</h4><p>Version 1.0.0</p></div></div>
            <div class="info-item"><div class="info-icon" style="background:rgba(46,213,115,0.2);color:#2ed573;"><i class="fas fa-database"></i></div><div class="info-text"><h4>Firebase Realtime Database</h4><p>Cloud-based data storage</p></div></div>
            <div class="info-item"><div class="info-icon" style="background:rgba(255,165,2,0.2);color:#ffa502;"><i class="fas fa-code"></i></div><div class="info-text"><h4>Developer</h4><p>Towfik Mondal </p></div></div>
        </div>
        <div class="settings-card" style="animation-delay:0.3s;">
            <div class="card-title"><i class="fas fa-exclamation-triangle" style="color:#ff6b6b;"></i> Danger Zone</div>
            <button class="danger-btn" onclick="logout()"><i class="fas fa-sign-out-alt"></i> Logout</button>
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

        if (sessionStorage.getItem('adminLoggedIn') !== 'true') window.location.href = 'index.php';

        db.ref('admin/credentials').once('value').then(function(snapshot) {
            if (snapshot.exists()) {
                document.getElementById('admin-email').value = snapshot.val().email || 'admin@gmail.com';
            } else {
                document.getElementById('admin-email').value = 'admin@gmail.com';
            }
        });

        function updateCredentials() {
            var email = document.getElementById('admin-email').value.trim();
            var currentPass = document.getElementById('current-pass').value;
            var newPass = document.getElementById('new-pass').value;
            var confirmPass = document.getElementById('confirm-pass').value;

            if (!email) { showMsg('Email is required', 'error'); return; }

            db.ref('admin/credentials').once('value').then(function(snap) {
                var storedPass = '238890';
                if (snap.exists() && snap.val().password) storedPass = snap.val().password;

                if (currentPass && currentPass !== storedPass) {
                    showMsg('Current password is incorrect', 'error');
                    return;
                }

                var password = storedPass;
                if (newPass) {
                    if (newPass !== confirmPass) { showMsg('Passwords do not match', 'error'); return; }
                    if (newPass.length < 4) { showMsg('Password must be at least 4 characters', 'error'); return; }
                    password = newPass;
                }

                db.ref('admin/credentials').set({ email: email, password: password })
                    .then(function() {
                        showMsg('Credentials updated successfully!', 'success');
                        document.getElementById('current-pass').value = '';
                        document.getElementById('new-pass').value = '';
                        document.getElementById('confirm-pass').value = '';
                    })
                    .catch(function(err) { showMsg('Error: ' + err.message, 'error'); });
            });
        }

        function showMsg(text, type) {
            var box = document.getElementById('msg-box');
            box.className = 'msg-box msg-' + type;
            box.innerHTML = '<i class="fas fa-' + (type === 'success' ? 'check' : 'exclamation') + '-circle"></i> ' + text;
            box.style.display = 'block';
            setTimeout(function() { box.style.display = 'none'; }, 4000);
        }

        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                sessionStorage.clear();
                window.location.href = 'index.php';
            }
        }
    </script>
</body>
</html>