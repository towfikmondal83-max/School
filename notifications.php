<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Notifications - Wahid Tuition</title>
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

        .page-title { font-size: 18px; font-weight: 700; flex: 1; }

        .header-action { display: flex; gap: 8px; }

        .header-icon-btn {
            width: 40px; height: 40px; border-radius: 12px;
            background: rgba(255,255,255,0.1); border: none; color: white;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 16px; position: relative;
        }

        .header-icon-btn .badge {
            position: absolute; top: -3px; right: -3px;
            width: 18px; height: 18px; border-radius: 50%;
            background: #ff6b6b; font-size: 9px; font-weight: 800;
            display: none; align-items: center; justify-content: center;
            border: 2px solid #1a1a3e;
        }

        .content { padding: 20px; padding-bottom: 100px; }

        /* Permission Banner */
        .permission-banner {
            border-radius: 16px; padding: 16px; margin-bottom: 20px; display: none;
            animation: slideDown 0.4s ease;
        }

        @keyframes slideDown { from { opacity: 0; transform: translateY(-15px); } to { opacity: 1; transform: translateY(0); } }

        .perm-warning {
            background: linear-gradient(135deg, rgba(255,165,2,0.12), rgba(255,165,2,0.04));
            border: 1px solid rgba(255,165,2,0.25);
        }

        .perm-success {
            background: linear-gradient(135deg, rgba(46,213,115,0.12), rgba(46,213,115,0.04));
            border: 1px solid rgba(46,213,115,0.25);
        }

        .perm-error {
            background: linear-gradient(135deg, rgba(255,71,87,0.12), rgba(255,71,87,0.04));
            border: 1px solid rgba(255,71,87,0.25);
        }

        .perm-top { display: flex; align-items: center; gap: 12px; margin-bottom: 10px; }

        .perm-icon {
            width: 40px; height: 40px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; flex-shrink: 0;
        }

        .perm-warning .perm-icon { background: rgba(255,165,2,0.2); color: #ffa502; }
        .perm-success .perm-icon { background: rgba(46,213,115,0.2); color: #2ed573; }
        .perm-error .perm-icon { background: rgba(255,71,87,0.2); color: #ff6b6b; }

        .perm-text h4 { font-size: 13px; font-weight: 700; }
        .perm-warning .perm-text h4 { color: #ffa502; }
        .perm-success .perm-text h4 { color: #2ed573; }
        .perm-error .perm-text h4 { color: #ff6b6b; }

        .perm-text p { font-size: 11px; color: rgba(255,255,255,0.5); }

        .perm-btn {
            width: 100%; padding: 12px; border: none; border-radius: 12px;
            color: white; font-family: 'Poppins', sans-serif;
            font-size: 13px; font-weight: 700; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }

        .perm-btn-enable { background: linear-gradient(135deg, #ffa502, #e67e22); }
        .perm-btn-enable:hover { box-shadow: 0 5px 20px rgba(255,165,2,0.4); }

        /* Summary */
        .notif-summary { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 20px; }

        .notif-sum-card {
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 14px 8px; text-align: center;
            animation: cardPop 0.5s ease both;
        }

        .notif-sum-card:nth-child(1) { animation-delay: 0.1s; }
        .notif-sum-card:nth-child(2) { animation-delay: 0.2s; }
        .notif-sum-card:nth-child(3) { animation-delay: 0.3s; }

        @keyframes cardPop { from { opacity: 0; transform: scale(0.8); } to { opacity: 1; transform: scale(1); } }

        .notif-sum-icon {
            width: 38px; height: 38px; border-radius: 12px;
            margin: 0 auto 8px; display: flex; align-items: center;
            justify-content: center; font-size: 16px;
        }

        .notif-sum-card:nth-child(1) .notif-sum-icon { background: rgba(102,126,234,0.2); color: #667eea; }
        .notif-sum-card:nth-child(2) .notif-sum-icon { background: rgba(46,213,115,0.2); color: #2ed573; }
        .notif-sum-card:nth-child(3) .notif-sum-icon { background: rgba(255,165,2,0.2); color: #ffa502; }

        .notif-sum-value { font-size: 22px; font-weight: 800; }
        .notif-sum-card:nth-child(1) .notif-sum-value { color: #667eea; }
        .notif-sum-card:nth-child(2) .notif-sum-value { color: #2ed573; }
        .notif-sum-card:nth-child(3) .notif-sum-value { color: #ffa502; }

        .notif-sum-label { font-size: 9px; color: rgba(255,255,255,0.5); font-weight: 600; text-transform: uppercase; }

        /* Tabs */
        .tab-container {
            display: flex; background: rgba(255,255,255,0.06);
            border-radius: 16px; padding: 4px; margin-bottom: 20px;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .tab-btn {
            flex: 1; padding: 12px 6px; border: none; background: transparent;
            color: rgba(255,255,255,0.45); font-family: 'Poppins', sans-serif;
            font-size: 11px; font-weight: 600; border-radius: 12px;
            cursor: pointer; display: flex; align-items: center;
            justify-content: center; gap: 5px; transition: all 0.3s;
        }

        .tab-btn.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white; box-shadow: 0 5px 20px rgba(102,126,234,0.4);
        }

        .tab-btn .tab-count { background: rgba(255,255,255,0.2); padding: 1px 7px; border-radius: 10px; font-size: 10px; }

        .tab-panel { display: none; }
        .tab-panel.active { display: block; animation: fadeIn 0.4s ease; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        /* Filter & Search */
        .filter-bar { display: flex; gap: 8px; margin-bottom: 15px; overflow-x: auto; -webkit-overflow-scrolling: touch; padding-bottom: 5px; }

        .filter-chip {
            padding: 7px 14px; background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08); border-radius: 20px;
            font-size: 11px; font-weight: 600; color: rgba(255,255,255,0.5);
            white-space: nowrap; cursor: pointer; font-family: 'Poppins', sans-serif;
        }

        .filter-chip.active { background: rgba(102,126,234,0.15); border-color: rgba(102,126,234,0.4); color: #667eea; }

        .search-wrapper { position: relative; margin-bottom: 15px; }
        .search-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.3); }

        .search-box {
            width: 100%; padding: 13px 16px 13px 44px;
            background: rgba(255,255,255,0.06); border: 2px solid rgba(255,255,255,0.08);
            border-radius: 14px; color: white; font-family: 'Poppins', sans-serif;
            font-size: 13px; outline: none;
        }

        .search-box:focus { border-color: #667eea; }
        .search-box::placeholder { color: rgba(255,255,255,0.25); }

        /* Notification Cards */
        .notif-card {
            background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06);
            border-radius: 18px; padding: 16px; margin-bottom: 12px;
            animation: slideUp 0.4s ease both; position: relative; overflow: hidden;
        }

        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .notif-card.unread { border-left: 3px solid #667eea; background: rgba(102,126,234,0.04); }

        .notif-top { display: flex; align-items: flex-start; gap: 12px; margin-bottom: 10px; }

        .notif-icon-circle {
            width: 42px; height: 42px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; flex-shrink: 0;
        }

        .notif-icon-all { background: rgba(255,165,2,0.15); color: #ffa502; }
        .notif-icon-class { background: rgba(102,126,234,0.15); color: #667eea; }
        .notif-icon-student { background: rgba(46,213,115,0.15); color: #2ed573; }

        .notif-header-info { flex: 1; }
        .notif-title { font-size: 14px; font-weight: 700; margin-bottom: 2px; }
        .notif-meta { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        .notif-target-badge { padding: 3px 10px; border-radius: 8px; font-size: 9px; font-weight: 700; text-transform: uppercase; }
        .badge-all { background: rgba(255,165,2,0.15); color: #ffa502; }
        .badge-class { background: rgba(102,126,234,0.15); color: #667eea; }
        .badge-student { background: rgba(46,213,115,0.15); color: #2ed573; }
        .notif-time { font-size: 10px; color: rgba(255,255,255,0.3); display: flex; align-items: center; gap: 4px; }

        .notif-body {
            font-size: 13px; color: rgba(255,255,255,0.6); line-height: 1.5;
            padding: 10px 14px; background: rgba(255,255,255,0.03);
            border-radius: 12px; margin-bottom: 10px; word-break: break-word;
        }

        .notif-footer { display: flex; justify-content: space-between; align-items: center; }
        .notif-recipients { font-size: 10px; color: rgba(255,255,255,0.3); display: flex; align-items: center; gap: 5px; }
        .notif-actions { display: flex; gap: 6px; }

        .notif-action-btn {
            width: 32px; height: 32px; border-radius: 10px;
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.4); cursor: pointer;
            display: flex; align-items: center; justify-content: center; font-size: 12px;
        }

        .notif-action-btn:hover { background: rgba(255,71,87,0.15); color: #ff6b6b; }
        .notif-action-btn.resend:hover { background: rgba(102,126,234,0.15); color: #667eea; }

        .unread-dot { width: 8px; height: 8px; border-radius: 50%; background: #667eea; flex-shrink: 0; animation: pulse 2s infinite; }
        @keyframes pulse { 0%,100% { opacity: 1; } 50% { opacity: 0.4; } }

        /* Compose */
        .compose-card {
            background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 22px; padding: 22px 18px; margin-bottom: 20px;
        }

        .compose-title { font-size: 16px; font-weight: 700; margin-bottom: 18px; display: flex; align-items: center; gap: 10px; }
        .compose-title i { color: #667eea; }

        .input-group { margin-bottom: 14px; }
        .input-group label { display: flex; align-items: center; gap: 6px; font-size: 12px; color: rgba(255,255,255,0.55); margin-bottom: 7px; font-weight: 600; }
        .input-group label i { color: #667eea; font-size: 12px; }

        .input-group input, .input-group select, .input-group textarea {
            width: 100%; padding: 13px 16px; background: rgba(255,255,255,0.06);
            border: 2px solid rgba(255,255,255,0.08); border-radius: 14px;
            color: white; font-family: 'Poppins', sans-serif; font-size: 13px; outline: none;
        }

        .input-group input:focus, .input-group select:focus, .input-group textarea:focus { border-color: #667eea; }
        .input-group select option { background: #1a1a3e; color: white; }
        .input-group textarea { resize: vertical; min-height: 110px; line-height: 1.6; }
        .input-group input::placeholder, .input-group textarea::placeholder { color: rgba(255,255,255,0.2); }

        .char-count { text-align: right; font-size: 10px; color: rgba(255,255,255,0.25); margin-top: 4px; }

        .template-chips { display: flex; gap: 6px; margin-bottom: 14px; overflow-x: auto; padding-bottom: 5px; }

        .template-chip {
            padding: 6px 14px; background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08); border-radius: 20px;
            font-size: 10px; font-weight: 600; color: rgba(255,255,255,0.5);
            white-space: nowrap; cursor: pointer; font-family: 'Poppins', sans-serif;
        }

        .template-chip:hover { background: rgba(102,126,234,0.1); color: #667eea; }

        .send-btn {
            width: 100%; padding: 16px; border: none; border-radius: 16px;
            font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 700;
            cursor: pointer; color: white; background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }

        .send-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(102,126,234,0.5); }
        .send-btn.loading { pointer-events: none; opacity: 0.7; }
        .send-btn.loading .btn-text { display: none; }
        .send-btn .btn-loader { display: none; width: 22px; height: 22px; }
        .send-btn.loading .btn-loader { display: block; border: 3px solid rgba(255,255,255,0.3); border-top-color: white; border-radius: 50%; animation: spin 0.8s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Msg */
        .msg-box { padding: 14px 18px; border-radius: 14px; font-size: 13px; margin-bottom: 15px; font-weight: 600; gap: 10px; }
        .msg-success { background: rgba(46,213,115,0.12); border: 1px solid rgba(46,213,115,0.25); color: #2ed573; display: none; }
        .msg-error { background: rgba(255,71,87,0.12); border: 1px solid rgba(255,71,87,0.25); color: #ff6b81; display: none; }

        .connection-status { padding: 8px 16px; border-radius: 10px; font-size: 11px; font-weight: 600; margin-bottom: 15px; display: flex; align-items: center; gap: 8px; }
        .status-connected { background: rgba(46,213,115,0.1); border: 1px solid rgba(46,213,115,0.2); color: #2ed573; }
        .status-disconnected { background: rgba(255,71,87,0.1); border: 1px solid rgba(255,71,87,0.2); color: #ff6b6b; }
        .status-dot { width: 8px; height: 8px; border-radius: 50%; animation: pulse 2s infinite; }
        .status-connected .status-dot { background: #2ed573; }
        .status-disconnected .status-dot { background: #ff6b6b; }

        .empty-state { text-align: center; padding: 50px 20px; color: rgba(255,255,255,0.25); }
        .empty-state .empty-icon { width: 80px; height: 80px; border-radius: 24px; background: rgba(255,255,255,0.04); margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; font-size: 32px; }
        .empty-state h3 { font-size: 16px; color: rgba(255,255,255,0.4); margin-bottom: 6px; }

        .date-header { font-size: 12px; font-weight: 700; color: rgba(255,255,255,0.3); padding: 8px 5px; margin: 10px 0 5px; display: flex; align-items: center; gap: 8px; text-transform: uppercase; letter-spacing: 1px; }
        .date-header::after { content: ''; flex: 1; height: 1px; background: rgba(255,255,255,0.06); }

        /* In-App Push Banner */
        .push-banner {
            position: fixed; top: 0; left: 0; right: 0;
            background: linear-gradient(135deg, #1e1e50, #2a1a5e);
            border-bottom: 1px solid rgba(102,126,234,0.3);
            padding: 16px 20px; z-index: 500;
            transform: translateY(-100%); transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 40px rgba(0,0,0,0.6);
        }

        .push-banner.show { transform: translateY(0); }

        .push-banner-content { display: flex; align-items: flex-start; gap: 12px; }

        .push-banner-icon {
            width: 44px; height: 44px; border-radius: 14px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }

        .push-banner-text { flex: 1; }
        .push-banner-text h4 { font-size: 14px; font-weight: 700; margin-bottom: 2px; }
        .push-banner-text p { font-size: 12px; color: rgba(255,255,255,0.6); line-height: 1.4; }
        .push-banner-text .push-time { font-size: 10px; color: rgba(255,255,255,0.3); margin-top: 4px; }

        .push-banner-close {
            width: 30px; height: 30px; border-radius: 8px;
            background: rgba(255,255,255,0.1); border: none; color: white;
            cursor: pointer; display: flex; align-items: center;
            justify-content: center; font-size: 12px; flex-shrink: 0;
        }

        /* Vibration animation for banner */
        .push-banner.show .push-banner-icon {
            animation: bellRing 0.6s ease;
        }

        @keyframes bellRing {
            0% { transform: rotate(0); }
            15% { transform: rotate(15deg); }
            30% { transform: rotate(-15deg); }
            45% { transform: rotate(10deg); }
            60% { transform: rotate(-10deg); }
            75% { transform: rotate(5deg); }
            100% { transform: rotate(0); }
        }

        /* Confirm */
        .confirm-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.8); z-index: 300; display: none; align-items: center; justify-content: center; padding: 20px; }
        .confirm-overlay.active { display: flex; }
        .confirm-card { background: #1e1e4a; border-radius: 22px; padding: 28px 22px; width: 100%; max-width: 340px; text-align: center; }
        .confirm-icon { width: 60px; height: 60px; border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 26px; background: rgba(255,71,87,0.15); color: #ff6b6b; }
        .confirm-title { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
        .confirm-text { font-size: 13px; color: rgba(255,255,255,0.5); margin-bottom: 20px; }
        .confirm-btns { display: flex; gap: 10px; }
        .confirm-btn { flex: 1; padding: 13px; border: none; border-radius: 14px; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600; cursor: pointer; }
        .confirm-cancel { background: rgba(255,255,255,0.1); color: white; }
        .confirm-danger { background: linear-gradient(135deg, #ff6b6b, #ee5a24); color: white; }

        /* Audio notification sound indicator */
        .sound-indicator {
            position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%);
            background: rgba(102,126,234,0.9); padding: 8px 20px;
            border-radius: 20px; font-size: 12px; font-weight: 600;
            display: none; z-index: 200; box-shadow: 0 5px 20px rgba(102,126,234,0.4);
        }

        .sound-indicator.show { display: flex; align-items: center; gap: 8px; animation: slideUp 0.3s ease; }
    </style>
</head>
<body>

    <!-- In-App Push Banner (replaces browser notifications) -->
    <div class="push-banner" id="push-banner">
        <div class="push-banner-content">
            <div class="push-banner-icon">🔔</div>
            <div class="push-banner-text">
                <h4 id="push-title">New Notification</h4>
                <p id="push-body">You have a new message</p>
                <div class="push-time" id="push-time">Just now</div>
            </div>
            <button class="push-banner-close" onclick="closePushBanner()"><i class="fas fa-times"></i></button>
        </div>
    </div>

    <div class="page-header">
        <button class="back-btn" id="back-button"><i class="fas fa-arrow-left"></i></button>
        <div class="page-title"><i class="fas fa-bell"></i> Notifications</div>
        <div class="header-action">
            <button class="header-icon-btn" id="unread-badge-btn">
                <i class="fas fa-envelope"></i>
                <span class="badge" id="unread-count">0</span>
            </button>
        </div>
    </div>

    <div class="content">
        <div class="connection-status status-disconnected" id="conn-status">
            <div class="status-dot"></div>
            <span id="conn-text">Connecting...</span>
        </div>

        <!-- Permission Banner -->
        <div class="permission-banner" id="perm-banner">
            <div class="perm-top">
                <div class="perm-icon"><i class="fas fa-bell"></i></div>
                <div class="perm-text">
                    <h4 id="perm-title">Enable Notifications</h4>
                    <p id="perm-desc">Get alerts when new messages arrive</p>
                </div>
            </div>
            <button class="perm-btn perm-btn-enable" id="perm-btn" onclick="requestNotifPermission()">
                <i class="fas fa-bell"></i> <span id="perm-btn-text">Enable Now</span>
            </button>
        </div>

        <!-- Summary -->
        <div class="notif-summary">
            <div class="notif-sum-card"><div class="notif-sum-icon"><i class="fas fa-paper-plane"></i></div><div class="notif-sum-value" id="sum-total">0</div><div class="notif-sum-label">Total</div></div>
            <div class="notif-sum-card"><div class="notif-sum-icon"><i class="fas fa-calendar-day"></i></div><div class="notif-sum-value" id="sum-today">0</div><div class="notif-sum-label">Today</div></div>
            <div class="notif-sum-card"><div class="notif-sum-icon"><i class="fas fa-envelope-open"></i></div><div class="notif-sum-value" id="sum-unread">0</div><div class="notif-sum-label">New</div></div>
        </div>

        <!-- Tabs -->
        <div class="tab-container" id="tab-container">
            <button class="tab-btn active" onclick="switchTab('compose', this)"><i class="fas fa-pen"></i> Compose</button>
            <button class="tab-btn" onclick="switchTab('inbox', this)"><i class="fas fa-inbox"></i> All <span class="tab-count" id="tab-all-count">0</span></button>
            <button class="tab-btn" onclick="switchTab('sent', this)"><i class="fas fa-paper-plane"></i> Sent</button>
        </div>

        <div id="msg-box-success" class="msg-box msg-success"><i class="fas fa-check-circle"></i> <span id="msg-success-text"></span></div>
        <div id="msg-box-error" class="msg-box msg-error"><i class="fas fa-exclamation-circle"></i> <span id="msg-error-text"></span></div>

        <!-- COMPOSE -->
        <div class="tab-panel active" id="panel-compose">
            <div class="compose-card">
                <div class="compose-title"><i class="fas fa-bullhorn"></i> New Notification</div>
                <div class="input-group">
                    <label><i class="fas fa-users"></i> Send To</label>
                    <select id="send-to" onchange="updateSendTarget()">
                        <option value="all">📢 All Students</option>
                        <option value="class">🏫 Specific Class</option>
                        <option value="student">👤 Specific Student</option>
                    </select>
                </div>
                <div class="input-group" id="class-group" style="display:none;"><label><i class="fas fa-school"></i> Class</label><select id="target-class"><option value="">-- Select --</option></select></div>
                <div class="input-group" id="student-group" style="display:none;"><label><i class="fas fa-user-graduate"></i> Student</label><select id="target-student"><option value="">-- Select --</option></select></div>
                <div class="input-group"><label><i class="fas fa-heading"></i> Title</label><input type="text" id="notif-title" placeholder="Notification title..." maxlength="100"><div class="char-count"><span id="title-count">0</span>/100</div></div>
                <label style="font-size:12px;color:rgba(255,255,255,0.4);margin-bottom:8px;display:block;font-weight:600;"><i class="fas fa-magic" style="color:#667eea;margin-right:4px;"></i> Templates</label>
                <div class="template-chips">
                    <div class="template-chip" onclick="useTemplate('exam')">📝 Exam</div>
                    <div class="template-chip" onclick="useTemplate('holiday')">🏖️ Holiday</div>
                    <div class="template-chip" onclick="useTemplate('fee')">💰 Fee</div>
                    <div class="template-chip" onclick="useTemplate('meeting')">🤝 Meeting</div>
                    <div class="template-chip" onclick="useTemplate('event')">🎉 Event</div>
                </div>
                <div class="input-group"><label><i class="fas fa-align-left"></i> Message</label><textarea id="notif-body" placeholder="Write message..." maxlength="500"></textarea><div class="char-count"><span id="body-count">0</span>/500</div></div>
                <button class="send-btn" id="send-button" onclick="sendNotification()"><span class="btn-text"><i class="fas fa-paper-plane"></i> Send Notification</span><div class="btn-loader"></div></button>
            </div>
        </div>

        <!-- INBOX -->
        <div class="tab-panel" id="panel-inbox">
            <div class="filter-bar" id="inbox-filter">
                <div class="filter-chip active" onclick="inboxFilter('all', this)"><i class="fas fa-globe"></i> All</div>
                <div class="filter-chip" onclick="inboxFilter('today', this)"><i class="fas fa-calendar-day"></i> Today</div>
                <div class="filter-chip" onclick="inboxFilter('broadcast', this)"><i class="fas fa-bullhorn"></i> Broadcast</div>
                <div class="filter-chip" onclick="inboxFilter('classwise', this)"><i class="fas fa-school"></i> Class</div>
                <div class="filter-chip" onclick="inboxFilter('individual', this)"><i class="fas fa-user"></i> Student</div>
            </div>
            <div class="search-wrapper"><i class="fas fa-search"></i><input type="text" class="search-box" id="inbox-search" placeholder="Search..."></div>
            <div id="inbox-list"></div>
        </div>

        <!-- SENT -->
        <div class="tab-panel" id="panel-sent">
            <div class="search-wrapper"><i class="fas fa-search"></i><input type="text" class="search-box" id="sent-search" placeholder="Search sent..."></div>
            <div id="sent-list"></div>
        </div>
    </div>

    <!-- Sound indicator -->
    <div class="sound-indicator" id="sound-indicator">🔔 New notification received</div>

    <!-- Confirm -->
    <div class="confirm-overlay" id="confirm-dialog"><div class="confirm-card"><div class="confirm-icon"><i class="fas fa-trash"></i></div><div class="confirm-title">Delete?</div><div class="confirm-text">Cannot be undone.</div><div class="confirm-btns"><button class="confirm-btn confirm-cancel" onclick="closeConfirm()">Cancel</button><button class="confirm-btn confirm-danger" id="confirm-action-btn">Delete</button></div></div></div>

    <!-- Notification Sound -->
    <audio id="notif-sound" preload="auto">
        <source src="data:audio/wav;base64,UklGRiQAAABXQVZFZm10IBAAAAABAAEAESsAABErAAABAAgAZGF0YQAAAAA=" type="audio/wav">
    </audio>

    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-database.js"></script>

    <script>
        // ==========================================
        // FIREBASE
        // ==========================================
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

        db.ref('.info/connected').on('value', function(snap) {
            var el = document.getElementById('conn-status');
            var txt = document.getElementById('conn-text');
            if (snap.val() === true) {
                el.className = 'connection-status status-connected';
                txt.textContent = 'Connected';
                setTimeout(function() { el.style.display = 'none'; }, 2000);
            } else {
                el.style.display = 'flex';
                el.className = 'connection-status status-disconnected';
                txt.textContent = 'Reconnecting...';
            }
        });

        // ==========================================
        // ★ SMART NOTIFICATION SYSTEM ★
        // Works on ALL hosting including InfinityFree
        // ==========================================
        var swReg = null;
        var notifMethod = 'banner'; // Default: in-app banner

        // Detect best notification method
        function initNotificationSystem() {
            // Try registering service worker
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('sw.js')
                    .then(function(reg) {
                        swReg = reg;
                        console.log('SW registered');
                        notifMethod = 'sw';
                    })
                    .catch(function(err) {
                        console.log('SW failed (expected on InfinityFree):', err.message);
                        notifMethod = 'api';
                    });
            }

            // Check Notification API availability
            if ('Notification' in window) {
                if (Notification.permission === 'granted') {
                    notifMethod = swReg ? 'sw' : 'api';
                }
            }

            checkPermBanner();
        }

        // Show notification using best available method
        function showSmartNotification(title, body) {
            // Method 1: ServiceWorker (if registered)
            if (notifMethod === 'sw' && swReg) {
                try {
                    swReg.showNotification(title, {
                        body: body,
                        vibrate: [100, 50, 100],
                        tag: 'wahid-' + Date.now(),
                        renotify: true
                    });
                    return;
                } catch (e) {
                    console.log('SW notify failed:', e.message);
                }
            }

            // Method 2: Notification API (desktop browsers)
            if ('Notification' in window && Notification.permission === 'granted') {
                try {
                    var n = new Notification(title, { body: body });
                    setTimeout(function() { try { n.close(); } catch(e) {} }, 6000);
                    return;
                } catch (e) {
                    console.log('Notification API failed:', e.message);
                }
            }

            // Method 3: In-App Push Banner (ALWAYS works - our main method)
            showPushBanner(title, body);
        }

        // ★ In-App Push Banner - Works on ALL browsers/hosting ★
        function showPushBanner(title, body) {
            var banner = document.getElementById('push-banner');
            document.getElementById('push-title').textContent = title;
            document.getElementById('push-body').textContent = body;
            document.getElementById('push-time').textContent = 'Just now';

            banner.classList.add('show');

            // Play sound
            playNotifSound();

            // Vibrate if supported
            if (navigator.vibrate) {
                navigator.vibrate([100, 50, 100, 50, 100]);
            }

            // Show sound indicator
            var indicator = document.getElementById('sound-indicator');
            indicator.classList.add('show');
            setTimeout(function() { indicator.classList.remove('show'); }, 2000);

            // Auto hide after 6 seconds
            setTimeout(function() {
                closePushBanner();
            }, 6000);
        }

        function closePushBanner() {
            document.getElementById('push-banner').classList.remove('show');
        }

        // Play notification sound
        function playNotifSound() {
            try {
                // Create audio context for notification beep
                var AudioContext = window.AudioContext || window.webkitAudioContext;
                if (AudioContext) {
                    var ctx = new AudioContext();
                    var osc = ctx.createOscillator();
                    var gain = ctx.createGain();

                    osc.connect(gain);
                    gain.connect(ctx.destination);

                    osc.frequency.value = 800;
                    osc.type = 'sine';
                    gain.gain.value = 0.3;

                    osc.start();
                    gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.3);
                    osc.stop(ctx.currentTime + 0.3);

                    // Second beep
                    setTimeout(function() {
                        var ctx2 = new AudioContext();
                        var osc2 = ctx2.createOscillator();
                        var gain2 = ctx2.createGain();
                        osc2.connect(gain2);
                        gain2.connect(ctx2.destination);
                        osc2.frequency.value = 1000;
                        osc2.type = 'sine';
                        gain2.gain.value = 0.3;
                        osc2.start();
                        gain2.gain.exponentialRampToValueAtTime(0.001, ctx2.currentTime + 0.2);
                        osc2.stop(ctx2.currentTime + 0.2);
                    }, 150);
                }
            } catch (e) {
                console.log('Audio failed:', e.message);
            }
        }

        // Permission banner
        function checkPermBanner() {
            var banner = document.getElementById('perm-banner');
            var permTitle = document.getElementById('perm-title');
            var permDesc = document.getElementById('perm-desc');
            var permBtn = document.getElementById('perm-btn');

            if (!('Notification' in window)) {
                // Browser doesn't support - use in-app banners
                banner.style.display = 'block';
                banner.className = 'permission-banner perm-success';
                permTitle.textContent = '✅ In-App Notifications Active';
                permDesc.textContent = 'You will see alerts as banners in the app';
                permBtn.style.display = 'none';
                setTimeout(function() { banner.style.display = 'none'; }, 3000);
                return;
            }

            if (Notification.permission === 'granted') {
                banner.style.display = 'block';
                banner.className = 'permission-banner perm-success';
                permTitle.textContent = '✅ Notifications Enabled';
                permDesc.textContent = 'You will receive push notifications';
                permBtn.style.display = 'none';
                setTimeout(function() { banner.style.display = 'none'; }, 3000);
            } else if (Notification.permission === 'denied') {
                banner.style.display = 'block';
                banner.className = 'permission-banner perm-error';
                permTitle.textContent = '🔕 Blocked - Using In-App Alerts';
                permDesc.textContent = 'You will still see notification banners in the app';
                permBtn.style.display = 'none';
                setTimeout(function() { banner.style.display = 'none'; }, 4000);
            } else {
                banner.style.display = 'block';
                banner.className = 'permission-banner perm-warning';
            }
        }

        function requestNotifPermission() {
            if (!('Notification' in window)) {
                showPushBanner('✅ Ready', 'In-app notifications are active!');
                return;
            }

            if (Notification.permission === 'granted') {
                showSmartNotification('🎓 Wahid Tuition', 'Notifications are working!');
                return;
            }

            if (Notification.permission === 'denied') {
                showPushBanner('🔕 Blocked', 'Using in-app alerts instead. Go to browser settings to enable push.');
                return;
            }

            Notification.requestPermission().then(function(perm) {
                if (perm === 'granted') {
                    showSmartNotification('🎓 Wahid Tuition', 'Push notifications enabled!');
                    checkPermBanner();
                } else {
                    showPushBanner('Using In-App Alerts', 'You will see notification banners here');
                    checkPermBanner();
                }
            });
        }

        // Init
        initNotificationSystem();

        // ==========================================
        // AUTH
        // ==========================================
        var urlParams = new URLSearchParams(window.location.search);
        var userType = urlParams.get('type') || 'admin';
        var isAdmin = userType === 'admin';

        if (isAdmin && sessionStorage.getItem('adminLoggedIn') !== 'true') window.location.href = 'index.php';
        if (!isAdmin && sessionStorage.getItem('studentLoggedIn') !== 'true') window.location.href = 'index.php';

        document.getElementById('back-button').onclick = function() {
            window.location.href = isAdmin ? 'admin.php' : 'student.php';
        };

        var myCode = sessionStorage.getItem('studentCode') || '';
        var myClass = sessionStorage.getItem('studentClass') || '';

        if (!isAdmin) {
            document.getElementById('tab-container').style.display = 'none';
            document.getElementById('panel-compose').classList.remove('active');
            document.getElementById('panel-compose').style.display = 'none';
            document.getElementById('panel-inbox').classList.add('active');
            document.getElementById('panel-inbox').style.display = 'block';
        }

        // ==========================================
        // DATA
        // ==========================================
        var allStudents = {};
        var allNotifications = {};
        var inboxCurrentFilter = 'all';
        var trackedKeys = {};
        var firstLoad = true;

        db.ref('students').on('value', function(snap) {
            allStudents = snap.exists() ? snap.val() : {};
            populateSelects();
        });

        db.ref('notifications').on('value', function(snap) {
            var oldKeys = trackedKeys;
            allNotifications = snap.exists() ? snap.val() : {};

            // Detect NEW notifications
            if (!firstLoad) {
                for (var key in allNotifications) {
                    if (!oldKeys[key]) {
                        var n = allNotifications[key];

                        // Check if for this user
                        var isForMe = true;
                        if (!isAdmin) {
                            var codes = n.targetCodes || [];
                            isForMe = n.targetType === 'all' ||
                                (n.targetType === 'class' && n.target === myClass) ||
                                codes.indexOf(myCode) !== -1;
                        }

                        // Only if < 60 seconds old
                        var age = Date.now() - new Date(n.timestamp).getTime();
                        if (isForMe && age < 60000) {
                            var shown = 'notif_push_' + key;
                            if (!sessionStorage.getItem(shown)) {
                                sessionStorage.setItem(shown, '1');
                                // Show notification!
                                showSmartNotification(
                                    n.title || '🔔 New Notification',
                                    n.body || 'You have a new message'
                                );
                                // Also always show in-app banner as backup
                                showPushBanner(
                                    n.title || '🔔 New Notification',
                                    (n.body || 'You have a new message').substring(0, 80)
                                );
                            }
                        }
                    }
                }
            }

            firstLoad = false;
            trackedKeys = {};
            for (var k in allNotifications) trackedKeys[k] = true;

            renderInbox();
            renderSent();
            updateSummary();
        });

        // ==========================================
        // SELECTS
        // ==========================================
        function populateSelects() {
            var cs = document.getElementById('target-class');
            var ss = document.getElementById('target-student');
            var classes = {};
            cs.innerHTML = '<option value="">-- Select --</option>';
            ss.innerHTML = '<option value="">-- Select --</option>';

            var arr = [];
            for (var k in allStudents) { arr.push(allStudents[k]); classes[allStudents[k].class] = true; }
            arr.sort(function(a, b) { return a.name.localeCompare(b.name); });

            for (var i = 0; i < arr.length; i++)
                ss.innerHTML += '<option value="' + arr[i].code + '">' + arr[i].name + ' (' + arr[i].code + ')</option>';

            var sc = Object.keys(classes).sort();
            for (var i = 0; i < sc.length; i++)
                cs.innerHTML += '<option value="' + sc[i] + '">' + sc[i] + '</option>';
        }

        function updateSendTarget() {
            var t = document.getElementById('send-to').value;
            document.getElementById('class-group').style.display = t === 'class' ? 'block' : 'none';
            document.getElementById('student-group').style.display = t === 'student' ? 'block' : 'none';
        }

        // ==========================================
        // TEMPLATES
        // ==========================================
        function useTemplate(type) {
            var t = {
                exam: { title: '📝 Exam Notice', body: 'Dear Students,\n\nExam schedule announced. Prepare accordingly.\n\nBest of luck!' },
                holiday: { title: '🏖️ Holiday', body: 'Dear Students,\n\nHoliday announced. Classes resume on schedule.' },
                fee: { title: '💰 Fee Reminder', body: 'Dear Parents,\n\nFees are due. Please pay soon.\n\nThank you!' },
                meeting: { title: '🤝 Meeting', body: 'Dear Parents,\n\nParent-Teacher meeting scheduled.' },
                event: { title: '🎉 Event', body: 'Dear Students,\n\nSpecial event coming up!' }
            }[type];
            if (t) {
                document.getElementById('notif-title').value = t.title;
                document.getElementById('notif-body').value = t.body;
                updateCharCounts();
            }
        }

        document.getElementById('notif-title').addEventListener('input', updateCharCounts);
        document.getElementById('notif-body').addEventListener('input', updateCharCounts);
        function updateCharCounts() {
            document.getElementById('title-count').textContent = document.getElementById('notif-title').value.length;
            document.getElementById('body-count').textContent = document.getElementById('notif-body').value.length;
        }

        // ==========================================
        // ★ SEND NOTIFICATION ★
        // ==========================================
        function sendNotification() {
            var type = document.getElementById('send-to').value;
            var title = document.getElementById('notif-title').value.trim();
            var body = document.getElementById('notif-body').value.trim();
            var btn = document.getElementById('send-button');

            if (!title) { showMsg('Enter a title', 'error'); return; }
            if (!body) { showMsg('Enter a message', 'error'); return; }

            var target = 'All Students', targetType = 'all', targetCodes = [];

            if (type === 'class') {
                target = document.getElementById('target-class').value;
                targetType = 'class';
                if (!target) { showMsg('Select a class', 'error'); return; }
                for (var k in allStudents) if (allStudents[k].class === target) targetCodes.push(allStudents[k].code);
            } else if (type === 'student') {
                var code = document.getElementById('target-student').value;
                if (!code) { showMsg('Select a student', 'error'); return; }
                targetType = 'student'; targetCodes.push(code);
                for (var k in allStudents) if (allStudents[k].code === code) { target = allStudents[k].name + ' (' + code + ')'; break; }
            } else {
                for (var k in allStudents) targetCodes.push(allStudents[k].code);
            }

            btn.classList.add('loading');

            db.ref('notifications').push().set({
                title: title, body: body, target: target, targetType: targetType,
                targetCodes: targetCodes, recipientCount: targetCodes.length,
                timestamp: new Date().toISOString(), read: false, sentBy: 'admin'
            }).then(function() {
                btn.classList.remove('loading');
                showMsg('✅ Sent to ' + targetCodes.length + ' student(s)!', 'success');
                showPushBanner('📤 Sent Successfully!', '"' + title + '" delivered to ' + targetCodes.length + ' students');

                document.getElementById('notif-title').value = '';
                document.getElementById('notif-body').value = '';
                document.getElementById('send-to').value = 'all';
                updateSendTarget(); updateCharCounts();
            }).catch(function(err) {
                btn.classList.remove('loading');
                showMsg('❌ Failed: ' + err.message, 'error');
            });
        }

        // ==========================================
        // TABS & FILTERS
        // ==========================================
        function switchTab(tab, el) {
            var tabs = document.querySelectorAll('.tab-btn');
            var panels = document.querySelectorAll('.tab-panel');
            for (var i = 0; i < tabs.length; i++) tabs[i].classList.remove('active');
            for (var i = 0; i < panels.length; i++) panels[i].classList.remove('active');
            el.classList.add('active');
            document.getElementById('panel-' + tab).classList.add('active');
        }

        function inboxFilter(filter, el) {
            inboxCurrentFilter = filter;
            var chips = document.querySelectorAll('#inbox-filter .filter-chip');
            for (var i = 0; i < chips.length; i++) chips[i].classList.remove('active');
            el.classList.add('active');
            renderInbox();
        }

        document.getElementById('inbox-search').addEventListener('input', renderInbox);
        document.getElementById('sent-search').addEventListener('input', renderSent);

        // ==========================================
        // RENDER INBOX
        // ==========================================
        function renderInbox() {
            var c = document.getElementById('inbox-list');
            var search = document.getElementById('inbox-search').value.toLowerCase();
            c.innerHTML = '';

            var entries = [];
            for (var k in allNotifications) entries.push({ key: k, data: allNotifications[k] });
            entries.sort(function(a, b) { return new Date(b.data.timestamp) - new Date(a.data.timestamp); });

            var count = 0, now = Date.now(), todayStr = new Date().toISOString().split('T')[0], lastDate = '';

            for (var i = 0; i < entries.length; i++) {
                var key = entries[i].key, n = entries[i].data;

                if (!isAdmin) {
                    var codes = n.targetCodes || [];
                    if (!(n.targetType === 'all' || (n.targetType === 'class' && n.target === myClass) || codes.indexOf(myCode) !== -1)) continue;
                }

                var nd = new Date(n.timestamp), nds = nd.toISOString().split('T')[0];
                if (inboxCurrentFilter === 'today' && nds !== todayStr) continue;
                if (inboxCurrentFilter === 'broadcast' && n.targetType !== 'all') continue;
                if (inboxCurrentFilter === 'classwise' && n.targetType !== 'class') continue;
                if (inboxCurrentFilter === 'individual' && n.targetType !== 'student') continue;
                if (search && ((n.title || '') + ' ' + (n.body || '') + ' ' + (n.target || '')).toLowerCase().indexOf(search) === -1) continue;

                var isNew = (now - nd.getTime()) < 86400000;
                var dg = nd.toLocaleDateString('en-IN', { day: 'numeric', month: 'long', year: 'numeric' });
                if (dg !== lastDate) { c.innerHTML += '<div class="date-header">' + dg + '</div>'; lastDate = dg; }

                var ic = n.targetType === 'all' ? 'notif-icon-all' : n.targetType === 'class' ? 'notif-icon-class' : 'notif-icon-student';
                var is = n.targetType === 'all' ? 'fa-bullhorn' : n.targetType === 'class' ? 'fa-school' : 'fa-user';
                var bc = n.targetType === 'all' ? 'badge-all' : n.targetType === 'class' ? 'badge-class' : 'badge-student';
                var bl = n.targetType === 'all' ? 'All' : (n.target || '');
                var rc = n.recipientCount || (n.targetCodes || []).length;
                var actions = isAdmin ? '<div class="notif-actions"><button class="notif-action-btn resend" onclick="resendNotification(\'' + key + '\')"><i class="fas fa-redo"></i></button><button class="notif-action-btn" onclick="confirmDelete(\'' + key + '\')"><i class="fas fa-trash"></i></button></div>' : '';

                c.innerHTML += '<div class="notif-card ' + (isNew ? 'unread' : '') + '" style="animation-delay:' + (count * 0.03) + 's"><div class="notif-top"><div class="notif-icon-circle ' + ic + '"><i class="fas ' + is + '"></i></div><div class="notif-header-info"><div class="notif-title">' + (n.title || '') + '</div><div class="notif-meta"><span class="notif-target-badge ' + bc + '">' + bl + '</span><span class="notif-time"><i class="fas fa-clock"></i> ' + getTimeAgo(nd) + '</span></div></div>' + (isNew ? '<div class="unread-dot"></div>' : '') + '</div><div class="notif-body">' + (n.body || '').replace(/\n/g, '<br>') + '</div><div class="notif-footer"><div class="notif-recipients"><i class="fas fa-users"></i> ' + rc + '</div>' + actions + '</div></div>';
                count++;
            }

            document.getElementById('tab-all-count').textContent = count;
            if (count === 0) c.innerHTML = '<div class="empty-state"><div class="empty-icon"><i class="fas fa-bell-slash"></i></div><h3>No Notifications</h3></div>';
        }

        // ==========================================
        // RENDER SENT
        // ==========================================
        function renderSent() {
            var c = document.getElementById('sent-list');
            var search = document.getElementById('sent-search').value.toLowerCase();
            c.innerHTML = '';

            var entries = [];
            for (var k in allNotifications) entries.push({ key: k, data: allNotifications[k] });
            entries.sort(function(a, b) { return new Date(b.data.timestamp) - new Date(a.data.timestamp); });

            var count = 0;
            for (var i = 0; i < entries.length; i++) {
                var key = entries[i].key, n = entries[i].data;
                if (search && ((n.title || '') + ' ' + (n.body || '')).toLowerCase().indexOf(search) === -1) continue;

                var fd = new Date(n.timestamp).toLocaleDateString('en-IN', { day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' });
                var ic = n.targetType === 'all' ? 'notif-icon-all' : n.targetType === 'class' ? 'notif-icon-class' : 'notif-icon-student';
                var is = n.targetType === 'all' ? 'fa-bullhorn' : n.targetType === 'class' ? 'fa-school' : 'fa-user';
                var bc = n.targetType === 'all' ? 'badge-all' : n.targetType === 'class' ? 'badge-class' : 'badge-student';
                var rc = n.recipientCount || (n.targetCodes || []).length;

                c.innerHTML += '<div class="notif-card" style="animation-delay:' + (count * 0.03) + 's"><div class="notif-top"><div class="notif-icon-circle ' + ic + '"><i class="fas ' + is + '"></i></div><div class="notif-header-info"><div class="notif-title">' + (n.title || '') + '</div><div class="notif-meta"><span class="notif-target-badge ' + bc + '">' + (n.target || '') + '</span><span class="notif-time"><i class="fas fa-paper-plane"></i> ' + fd + '</span></div></div></div><div class="notif-body">' + (n.body || '').replace(/\n/g, '<br>') + '</div><div class="notif-footer"><div class="notif-recipients"><i class="fas fa-check-circle" style="color:#2ed573;"></i> ' + rc + ' delivered</div><div class="notif-actions"><button class="notif-action-btn resend" onclick="resendNotification(\'' + key + '\')"><i class="fas fa-redo"></i></button><button class="notif-action-btn" onclick="confirmDelete(\'' + key + '\')"><i class="fas fa-trash"></i></button></div></div></div>';
                count++;
            }

            if (count === 0) c.innerHTML = '<div class="empty-state"><div class="empty-icon"><i class="fas fa-paper-plane"></i></div><h3>No Messages</h3></div>';
        }

        // ==========================================
        // SUMMARY
        // ==========================================
        function updateSummary() {
            var now = Date.now(), todayStr = new Date().toISOString().split('T')[0];
            var total = 0, today = 0, unread = 0;

            for (var k in allNotifications) {
                var n = allNotifications[k];
                if (!isAdmin) {
                    var codes = n.targetCodes || [];
                    if (!(n.targetType === 'all' || (n.targetType === 'class' && n.target === myClass) || codes.indexOf(myCode) !== -1)) continue;
                }
                total++;
                if (new Date(n.timestamp).toISOString().split('T')[0] === todayStr) today++;
                if ((now - new Date(n.timestamp).getTime()) < 86400000) unread++;
            }

            document.getElementById('sum-total').textContent = total;
            document.getElementById('sum-today').textContent = today;
            document.getElementById('sum-unread').textContent = unread;

            var badge = document.getElementById('unread-count');
            if (unread > 0) { badge.textContent = unread; badge.style.display = 'flex'; }
            else badge.style.display = 'none';
        }

        // ==========================================
        // DELETE & RESEND
        // ==========================================
        var deleteKey = null;

        function confirmDelete(key) {
            deleteKey = key;
            document.getElementById('confirm-dialog').classList.add('active');
        }

        document.getElementById('confirm-action-btn').onclick = function() {
            if (deleteKey) db.ref('notifications/' + deleteKey).remove().then(function() { showMsg('Deleted', 'success'); });
            closeConfirm();
        };

        function closeConfirm() { document.getElementById('confirm-dialog').classList.remove('active'); deleteKey = null; }

        function resendNotification(key) {
            var n = allNotifications[key];
            if (!n) return;
            var d = {};
            for (var p in n) d[p] = n[p];
            d.timestamp = new Date().toISOString();
            d.read = false;
            db.ref('notifications').push().set(d).then(function() {
                showMsg('✅ Resent!', 'success');
                showPushBanner('📤 Resent', d.title || 'Notification resent');
            });
        }

        // ==========================================
        // UTILITIES
        // ==========================================
        function getTimeAgo(d) {
            var diff = Date.now() - d.getTime();
            var m = Math.floor(diff / 60000), h = Math.floor(diff / 3600000), dy = Math.floor(diff / 86400000);
            if (m < 1) return 'Now';
            if (m < 60) return m + 'm';
            if (h < 24) return h + 'h';
            if (dy < 7) return dy + 'd';
            return d.toLocaleDateString('en-IN', { day: 'numeric', month: 'short' });
        }

        function showMsg(text, type) {
            var s = document.getElementById('msg-box-success'), e = document.getElementById('msg-box-error');
            if (type === 'success') {
                document.getElementById('msg-success-text').textContent = text;
                s.style.display = 'flex'; e.style.display = 'none';
                setTimeout(function() { s.style.display = 'none'; }, 4000);
            } else {
                document.getElementById('msg-error-text').textContent = text;
                e.style.display = 'flex'; s.style.display = 'none';
                setTimeout(function() { e.style.display = 'none'; }, 5000);
            }
        }
    </script>
</body>
</html>