<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Fees Management - Wahid Tuition</title>
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
        .content { padding: 20px; padding-bottom: 40px; }

        /* Summary Cards */
        .fee-summary {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 10px; margin-bottom: 20px;
        }

        .fee-sum-card {
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px; padding: 14px 8px; text-align: center;
            animation: cardPop 0.5s ease both;
        }

        .fee-sum-card:nth-child(1) { animation-delay: 0.1s; }
        .fee-sum-card:nth-child(2) { animation-delay: 0.2s; }
        .fee-sum-card:nth-child(3) { animation-delay: 0.3s; }

        @keyframes cardPop { from { opacity: 0; transform: scale(0.8); } to { opacity: 1; transform: scale(1); } }

        .fee-sum-icon {
            width: 38px; height: 38px; border-radius: 12px;
            margin: 0 auto 8px; display: flex; align-items: center;
            justify-content: center; font-size: 16px;
        }

        .fee-sum-card:nth-child(1) .fee-sum-icon { background: rgba(46,213,115,0.2); color: #2ed573; }
        .fee-sum-card:nth-child(2) .fee-sum-icon { background: rgba(255,107,107,0.2); color: #ff6b6b; }
        .fee-sum-card:nth-child(3) .fee-sum-icon { background: rgba(102,126,234,0.2); color: #667eea; }

        .fee-sum-value { font-size: 20px; font-weight: 800; }
        .fee-sum-card:nth-child(1) .fee-sum-value { color: #2ed573; }
        .fee-sum-card:nth-child(2) .fee-sum-value { color: #ff6b6b; }
        .fee-sum-card:nth-child(3) .fee-sum-value { color: #667eea; }

        .fee-sum-label { font-size: 9px; color: rgba(255,255,255,0.5); margin-top: 2px; font-weight: 600; }

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

        .search-wrapper { position: relative; margin-bottom: 15px; }
        .search-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: rgba(255,255,255,0.4); }

        .search-box {
            width: 100%; padding: 14px 16px 14px 44px;
            background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1);
            border-radius: 14px; color: white; font-family: 'Poppins', sans-serif;
            font-size: 14px; outline: none;
        }

        .search-box:focus { border-color: #667eea; }

        /* Student Fee Card */
        .student-fee-card {
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px; padding: 16px; margin-bottom: 14px;
            cursor: pointer; transition: all 0.3s; animation: slideUp 0.4s ease both;
            overflow: hidden;
        }

        @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .student-fee-card:hover {
            background: rgba(102,126,234,0.08); border-color: rgba(102,126,234,0.2);
            transform: translateY(-2px);
        }

        .fee-card-top {
            display: flex; align-items: center; gap: 12px; margin-bottom: 14px;
        }

        .fee-avatar {
            width: 48px; height: 48px; border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 20px; flex-shrink: 0;
        }

        .fee-info { flex: 1; }
        .fee-info h4 { font-size: 15px; font-weight: 700; }
        .fee-info p { font-size: 11px; color: rgba(255,255,255,0.5); }

        .fee-info-right { text-align: right; }
        .fee-info-right .paid-count {
            font-size: 13px; font-weight: 700; color: #2ed573;
        }
        .fee-info-right .due-count {
            font-size: 11px; color: #ff6b6b; font-weight: 600;
        }

        /* Month Grid - ENHANCED */
        .month-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 8px;
        }

        .month-cell {
            text-align: center; padding: 10px 4px; border-radius: 12px;
            font-size: 11px; font-weight: 700; cursor: pointer; transition: all 0.3s;
            position: relative; overflow: hidden;
        }

        .month-cell .month-label {
            display: block; font-size: 11px; font-weight: 700;
            position: relative; z-index: 2;
        }

        .month-cell .month-amount {
            display: block; font-size: 9px; opacity: 0.8;
            position: relative; z-index: 2; margin-top: 2px;
        }

        .month-cell .month-status-icon {
            position: relative; z-index: 2;
            font-size: 14px; margin-bottom: 2px;
        }

        /* PAID - Green with glow */
        .month-paid {
            background: linear-gradient(135deg, rgba(46,213,115,0.25), rgba(46,213,115,0.15));
            color: #2ed573;
            border: 1.5px solid rgba(46,213,115,0.4);
            box-shadow: 0 2px 10px rgba(46,213,115,0.15);
        }

        .month-paid::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(46,213,115,0.1), transparent);
            border-radius: 12px;
        }

        .month-paid:hover {
            background: linear-gradient(135deg, rgba(46,213,115,0.4), rgba(46,213,115,0.25));
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(46,213,115,0.3);
        }

        /* DUE - Red */
        .month-due {
            background: linear-gradient(135deg, rgba(255,107,107,0.25), rgba(255,107,107,0.15));
            color: #ff6b6b;
            border: 1.5px solid rgba(255,107,107,0.4);
            box-shadow: 0 2px 10px rgba(255,107,107,0.1);
        }

        .month-due::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(255,107,107,0.1), transparent);
            border-radius: 12px;
        }

        .month-due:hover {
            background: linear-gradient(135deg, rgba(255,107,107,0.4), rgba(255,107,107,0.25));
            transform: scale(1.05);
        }

        /* NONE - Grey */
        .month-none {
            background: rgba(255,255,255,0.04);
            color: rgba(255,255,255,0.25);
            border: 1.5px dashed rgba(255,255,255,0.1);
        }

        .month-none:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.5);
            transform: scale(1.05);
        }

        /* Year selector */
        .year-selector {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 15px; justify-content: center;
        }

        .year-btn {
            width: 36px; height: 36px; border-radius: 10px;
            background: rgba(255,255,255,0.1); border: none; color: white;
            cursor: pointer; font-size: 14px; transition: all 0.3s;
        }

        .year-btn:hover { background: rgba(102,126,234,0.3); }
        .year-display { font-size: 18px; font-weight: 800; color: #667eea; min-width: 60px; text-align: center; }

        /* Legend */
        .fee-legend {
            display: flex; gap: 12px; justify-content: center;
            margin-bottom: 20px; flex-wrap: wrap;
        }

        .legend-item {
            display: flex; align-items: center; gap: 6px;
            font-size: 11px; color: rgba(255,255,255,0.5);
        }

        .legend-dot {
            width: 14px; height: 14px; border-radius: 5px;
        }

        /* Modal */
        .modal-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.85); z-index: 200;
            display: none; align-items: flex-end; justify-content: center;
            padding: 0;
        }

        .modal-overlay.active { display: flex; }

        .modal-card {
            background: linear-gradient(180deg, #1e1e4a, #151535);
            border-radius: 28px 28px 0 0; padding: 28px 22px;
            width: 100%; max-width: 480px; max-height: 92vh; overflow-y: auto;
            animation: modalSlideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes modalSlideUp { from { transform: translateY(100%); } to { transform: translateY(0); } }

        .modal-handle {
            width: 40px; height: 4px; background: rgba(255,255,255,0.2);
            border-radius: 2px; margin: 0 auto 20px;
        }

        .modal-title {
            font-size: 18px; font-weight: 700; margin-bottom: 20px;
            display: flex; justify-content: space-between; align-items: center;
        }

        .close-modal {
            width: 36px; height: 36px; border-radius: 12px;
            background: rgba(255,255,255,0.1); border: none; color: white;
            cursor: pointer; font-size: 16px; transition: all 0.3s;
        }

        .close-modal:hover { background: rgba(255,71,87,0.3); }

        .modal-student-card {
            background: linear-gradient(135deg, rgba(102,126,234,0.15), rgba(118,75,162,0.15));
            border: 1px solid rgba(102,126,234,0.2);
            border-radius: 16px; padding: 16px; margin-bottom: 20px;
            display: flex; align-items: center; gap: 14px;
        }

        .modal-stu-avatar {
            width: 50px; height: 50px; border-radius: 16px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; font-weight: 800;
        }

        .modal-stu-info h3 { font-size: 16px; font-weight: 700; }
        .modal-stu-info p { font-size: 12px; color: rgba(255,255,255,0.5); }

        .input-group { margin-bottom: 14px; }
        .input-group label {
            display: block; font-size: 12px; color: rgba(255,255,255,0.6);
            margin-bottom: 6px; font-weight: 600;
        }

        .modal-input, .modal-select {
            width: 100%; padding: 14px 16px;
            background: rgba(255,255,255,0.08); border: 2px solid rgba(255,255,255,0.1);
            border-radius: 14px; color: white; font-family: 'Poppins', sans-serif;
            font-size: 14px; outline: none; transition: all 0.3s;
        }

        .modal-input:focus, .modal-select:focus { border-color: #667eea; background: rgba(102,126,234,0.08); }
        .modal-select option { background: #1a1a3e; color: white; }

        .modal-btn {
            width: 100%; padding: 16px; border: none; border-radius: 16px;
            font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 700;
            cursor: pointer; transition: all 0.3s; color: white;
            background: linear-gradient(135deg, #2ed573, #17a05e);
            margin-top: 6px;
        }

        .modal-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(46,213,115,0.4); }
        .modal-btn:active { transform: scale(0.98); }

        /* Receipt - Premium */
        .receipt-container {
            background: linear-gradient(180deg, #ffffff, #f8f9ff);
            border-radius: 20px; padding: 0; color: #333; display: none;
            margin-top: 20px; overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .receipt-top-bar {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 20px; text-align: center; color: white;
        }

        .receipt-top-bar h2 { font-size: 20px; font-weight: 800; }
        .receipt-top-bar p { font-size: 11px; opacity: 0.8; }

        .receipt-body { padding: 20px; }

        .receipt-row {
            display: flex; justify-content: space-between; padding: 10px 0;
            font-size: 13px; border-bottom: 1px solid #eee;
        }

        .receipt-row:last-child { border-bottom: none; }
        .receipt-row .r-label { color: #888; font-weight: 500; }
        .receipt-row .r-value { font-weight: 700; color: #333; }

        .receipt-total-row {
            display: flex; justify-content: space-between; padding: 14px 0;
            font-size: 18px; font-weight: 800; color: #2ed573;
            border-top: 2px dashed #ddd; margin-top: 5px;
        }

        .receipt-status-badge {
            display: inline-block; padding: 6px 20px; border-radius: 20px;
            font-size: 13px; font-weight: 700; margin: 10px auto;
            text-align: center;
        }

        .receipt-paid-badge { background: #e8f8f0; color: #2ed573; }
        .receipt-due-badge { background: #ffe8e8; color: #ff6b6b; }

        .receipt-footer {
            text-align: center; padding: 15px; font-size: 10px; color: #aaa;
            border-top: 1px solid #eee; background: #f8f9ff;
        }

        .receipt-footer p { margin-bottom: 3px; }

        .download-btn {
            width: 100%; padding: 14px; background: linear-gradient(135deg, #3498db, #2980b9);
            border: none; border-radius: 14px; color: white; font-family: 'Poppins', sans-serif;
            font-size: 14px; font-weight: 600; cursor: pointer; margin-top: 14px;
            transition: all 0.3s;
        }

        .download-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(52,152,219,0.4); }

        .msg-box {
            padding: 14px 18px; border-radius: 14px; font-size: 13px;
            margin-bottom: 15px; display: none; font-weight: 600;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

        .msg-success { background: rgba(46,213,115,0.15); border: 1px solid rgba(46,213,115,0.3); color: #2ed573; }
        .msg-error { background: rgba(255,71,87,0.15); border: 1px solid rgba(255,71,87,0.3); color: #ff6b81; }

        .empty-state {
            text-align: center; padding: 40px 20px; color: rgba(255,255,255,0.3);
        }

        .empty-state i { font-size: 50px; display: block; margin-bottom: 15px; }
        .empty-state p { font-size: 13px; }
    </style>
</head>
<body>
    <div class="page-header">
        <button class="back-btn" onclick="location.href='admin.php'"><i class="fas fa-arrow-left"></i></button>
        <div class="page-title"><i class="fas fa-money-bill-wave"></i> Fees Management</div>
    </div>

    <div class="content">
        <div id="msg-box" class="msg-box"></div>

        <!-- Summary Cards -->
        <div class="fee-summary">
            <div class="fee-sum-card">
                <div class="fee-sum-icon"><i class="fas fa-check-circle"></i></div>
                <div class="fee-sum-value" id="total-paid">0</div>
                <div class="fee-sum-label">TOTAL PAID</div>
            </div>
            <div class="fee-sum-card">
                <div class="fee-sum-icon"><i class="fas fa-exclamation-circle"></i></div>
                <div class="fee-sum-value" id="total-due">0</div>
                <div class="fee-sum-label">TOTAL DUE</div>
            </div>
            <div class="fee-sum-card">
                <div class="fee-sum-icon"><i class="fas fa-users"></i></div>
                <div class="fee-sum-value" id="total-stu">0</div>
                <div class="fee-sum-label">STUDENTS</div>
            </div>
        </div>

        <!-- Year Selector -->
        <div class="year-selector">
            <button class="year-btn" onclick="changeYear(-1)"><i class="fas fa-chevron-left"></i></button>
            <div class="year-display" id="year-display">2025</div>
            <button class="year-btn" onclick="changeYear(1)"><i class="fas fa-chevron-right"></i></button>
        </div>

        <!-- Legend -->
        <div class="fee-legend">
            <div class="legend-item">
                <div class="legend-dot" style="background:linear-gradient(135deg, rgba(46,213,115,0.4), rgba(46,213,115,0.2)); border:1px solid rgba(46,213,115,0.5);"></div>
                Paid
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:linear-gradient(135deg, rgba(255,107,107,0.4), rgba(255,107,107,0.2)); border:1px solid rgba(255,107,107,0.5);"></div>
                Due
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background:rgba(255,255,255,0.04); border:1px dashed rgba(255,255,255,0.15);"></div>
                Not Set
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-bar" id="filter-bar">
            <div class="filter-chip active" onclick="filterClass('all', this)">All</div>
        </div>

        <!-- Search -->
        <div class="search-wrapper">
            <i class="fas fa-search"></i>
            <input type="text" class="search-box" id="search-input" placeholder="Search student by name...">
        </div>

        <div id="students-fees-list"></div>
    </div>

    <!-- Payment Modal -->
    <div class="modal-overlay" id="payment-modal">
        <div class="modal-card">
            <div class="modal-handle"></div>
            <div class="modal-title">
                <span><i class="fas fa-receipt" style="color:#667eea;margin-right:8px;"></i>Fee Payment</span>
                <button class="close-modal" onclick="closeModal()"><i class="fas fa-times"></i></button>
            </div>

            <div class="modal-student-card" id="modal-student-info">
                <!-- Dynamic -->
            </div>

            <div class="input-group">
                <label><i class="fas fa-calendar-alt" style="margin-right:5px;color:#667eea;"></i>Month</label>
                <select class="modal-select" id="fee-month">
                    <option value="">Select Month</option>
                    <option>January</option><option>February</option><option>March</option>
                    <option>April</option><option>May</option><option>June</option>
                    <option>July</option><option>August</option><option>September</option>
                    <option>October</option><option>November</option><option>December</option>
                </select>
            </div>

            <div class="input-group">
                <label><i class="fas fa-calendar" style="margin-right:5px;color:#667eea;"></i>Year</label>
                <input type="number" class="modal-input" id="fee-year" value="2025">
            </div>

            <div class="input-group">
                <label><i class="fas fa-money-bill" style="margin-right:5px;color:#2ed573;"></i>Amount (৳)</label>
                <input type="number" class="modal-input" id="fee-amount" placeholder="Enter amount" value="500">
            </div>

            <div class="input-group">
                <label><i class="fas fa-tag" style="margin-right:5px;color:#ffa502;"></i>Status</label>
                <select class="modal-select" id="fee-status">
                    <option value="Paid">✅ Paid</option>
                    <option value="Due">❌ Due</option>
                </select>
            </div>

            <button class="modal-btn" onclick="saveFee()">
                <i class="fas fa-save"></i> Save & Generate Receipt
            </button>

            <!-- Premium Receipt -->
            <div class="receipt-container" id="receipt">
                <div class="receipt-top-bar">
                    <h2>🎓 Wahid Tuition</h2>
                    <p>Management App • Payment Receipt</p>
                </div>
                <div class="receipt-body">
                    <div style="text-align:center; margin-bottom:12px;">
                        <span class="receipt-status-badge" id="r-status-badge">PAID</span>
                    </div>
                    <div class="receipt-row"><span class="r-label">Student Name</span><span class="r-value" id="r-name"></span></div>
                    <div class="receipt-row"><span class="r-label">Student Code</span><span class="r-value" id="r-code"></span></div>
                    <div class="receipt-row"><span class="r-label">Class</span><span class="r-value" id="r-class"></span></div>
                    <div class="receipt-row"><span class="r-label">Fee Month</span><span class="r-value" id="r-month"></span></div>
                    <div class="receipt-row"><span class="r-label">Payment Date</span><span class="r-value" id="r-date"></span></div>
                    <div class="receipt-row"><span class="r-label">Receipt No.</span><span class="r-value" id="r-receipt-no"></span></div>
                    <div class="receipt-total-row"><span>Total Amount</span><span id="r-amount">৳0</span></div>
                </div>
                <div class="receipt-footer">
                    <p>✅ This is a computer-generated receipt</p>
                    <p>Wahid Tuition Management App © 2025</p>
                </div>
            </div>

            <button class="download-btn" id="download-btn" style="display:none;" onclick="downloadReceipt()">
                <i class="fas fa-download"></i> Download Receipt as Image
            </button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.5.2/firebase-app.js";
        import { getDatabase, ref, set, get, child, onValue } from "https://www.gstatic.com/firebasejs/10.5.2/firebase-database.js";

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
        let allFees = {};
        let currentFilter = 'all';
        let selectedStudent = null;
        let selectedYear = new Date().getFullYear();

        document.getElementById('year-display').textContent = selectedYear;

        window.changeYear = function(delta) {
            selectedYear += delta;
            document.getElementById('year-display').textContent = selectedYear;
            document.getElementById('fee-year').value = selectedYear;
            renderFeesList();
        };

        onValue(ref(db, 'students'), (snapshot) => {
            allStudents = snapshot.exists() ? snapshot.val() : {};
            const classes = new Set();
            for (let k in allStudents) classes.add(allStudents[k].class);
            const bar = document.getElementById('filter-bar');
            bar.innerHTML = `<div class="filter-chip active" onclick="filterClass('all', this)">All</div>`;
            [...classes].sort().forEach(c => {
                bar.innerHTML += `<div class="filter-chip" onclick="filterClass('${c}', this)">${c}</div>`;
            });
            renderFeesList();
        });

        onValue(ref(db, 'fees'), (snapshot) => {
            allFees = snapshot.exists() ? snapshot.val() : {};
            renderFeesList();
        });

        window.filterClass = function(cls, el) {
            currentFilter = cls;
            document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
            el.classList.add('active');
            renderFeesList();
        };

        document.getElementById('search-input').addEventListener('input', renderFeesList);

        const monthNames = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        const monthFull = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        function renderFeesList() {
            const container = document.getElementById('students-fees-list');
            const search = document.getElementById('search-input').value.toLowerCase();
            container.innerHTML = '';
            const colors = ['#667eea','#2ed573','#ff6b6b','#ffa502','#3498db','#e056a0','#1abc9c','#9b59b6'];
            let i = 0;
            let totalPaidCount = 0, totalDueCount = 0;

            const entries = Object.entries(allStudents).sort((a, b) => a[1].name.localeCompare(b[1].name));

            for (let [key, stu] of entries) {
                if (currentFilter !== 'all' && stu.class !== currentFilter) continue;
                if (search && !stu.name.toLowerCase().includes(search)) continue;

                const color = colors[i % colors.length];
                const stuFees = allFees[stu.code] || {};

                let paidMonths = 0, dueMonths = 0;
                let monthsHtml = '';

                monthFull.forEach((m, idx) => {
                    const feeKey = m + '_' + selectedYear;
                    const feeData = stuFees[feeKey];
                    const status = feeData ? feeData.status : 'none';
                    const amount = feeData ? feeData.amount : '';

                    let cellClass = 'month-none';
                    let statusIcon = '<i class="fas fa-minus month-status-icon"></i>';
                    let amountDisplay = '';

                    if (status === 'Paid') {
                        cellClass = 'month-paid';
                        statusIcon = '<i class="fas fa-check-circle month-status-icon"></i>';
                        amountDisplay = `<span class="month-amount">৳${amount}</span>`;
                        paidMonths++;
                        totalPaidCount++;
                    } else if (status === 'Due') {
                        cellClass = 'month-due';
                        statusIcon = '<i class="fas fa-exclamation-circle month-status-icon"></i>';
                        amountDisplay = `<span class="month-amount">৳${amount}</span>`;
                        dueMonths++;
                        totalDueCount++;
                    }

                    monthsHtml += `
                        <div class="month-cell ${cellClass}" onclick="event.stopPropagation(); openModal('${stu.code}', '${m}')">
                            ${statusIcon}
                            <span class="month-label">${monthNames[idx]}</span>
                            ${amountDisplay}
                        </div>
                    `;
                });

                container.innerHTML += `
                    <div class="student-fee-card" style="animation-delay:${i * 0.05}s">
                        <div class="fee-card-top">
                            <div class="fee-avatar" style="background:${color}20; color:${color}">${stu.name.charAt(0).toUpperCase()}</div>
                            <div class="fee-info">
                                <h4>${stu.name}</h4>
                                <p>${stu.code} • ${stu.class}</p>
                            </div>
                            <div class="fee-info-right">
                                <div class="paid-count"><i class="fas fa-check-circle"></i> ${paidMonths}/12</div>
                                ${dueMonths > 0 ? `<div class="due-count"><i class="fas fa-exclamation-triangle"></i> ${dueMonths} due</div>` : ''}
                            </div>
                        </div>
                        <div class="month-grid">${monthsHtml}</div>
                    </div>
                `;
                i++;
            }

            document.getElementById('total-paid').textContent = totalPaidCount;
            document.getElementById('total-due').textContent = totalDueCount;
            document.getElementById('total-stu').textContent = i;

            if (i === 0) {
                container.innerHTML = '<div class="empty-state"><i class="fas fa-user-slash"></i><p>No students found</p></div>';
            }
        }

        window.openModal = function(code, month) {
            let stu = null;
            for (let k in allStudents) {
                if (allStudents[k].code === code) { stu = allStudents[k]; break; }
            }
            if (!stu) return;

            selectedStudent = stu;
            document.getElementById('modal-student-info').innerHTML = `
                <div class="modal-stu-avatar">${stu.name.charAt(0).toUpperCase()}</div>
                <div class="modal-stu-info">
                    <h3>${stu.name}</h3>
                    <p>${stu.code} • ${stu.class}</p>
                </div>
            `;

            if (month) document.getElementById('fee-month').value = month;
            document.getElementById('fee-year').value = selectedYear;

            // Pre-fill if data exists
            const feeKey = (month || '') + '_' + selectedYear;
            const existing = allFees[stu.code] && allFees[stu.code][feeKey];
            if (existing) {
                document.getElementById('fee-amount').value = existing.amount || 500;
                document.getElementById('fee-status').value = existing.status || 'Paid';
            } else {
                document.getElementById('fee-amount').value = 500;
                document.getElementById('fee-status').value = 'Paid';
            }

            document.getElementById('receipt').style.display = 'none';
            document.getElementById('download-btn').style.display = 'none';
            document.getElementById('payment-modal').classList.add('active');
        };

        window.closeModal = function() {
            document.getElementById('payment-modal').classList.remove('active');
        };

        window.saveFee = async function() {
            if (!selectedStudent) return;
            const month = document.getElementById('fee-month').value;
            const year = document.getElementById('fee-year').value;
            const amount = document.getElementById('fee-amount').value;
            const status = document.getElementById('fee-status').value;

            if (!month || !year || !amount) {
                showMsg('Please fill all fields', 'error');
                return;
            }

            const feeKey = month + '_' + year;
            const receiptNo = 'WTM-' + Date.now().toString(36).toUpperCase();

            await set(ref(db, 'fees/' + selectedStudent.code + '/' + feeKey), {
                month, year: parseInt(year), amount: parseFloat(amount),
                status, date: new Date().toISOString(), receiptNo
            });

            // Show receipt
            document.getElementById('r-name').textContent = selectedStudent.name;
            document.getElementById('r-code').textContent = selectedStudent.code;
            document.getElementById('r-class').textContent = selectedStudent.class;
            document.getElementById('r-month').textContent = month + ' ' + year;
            document.getElementById('r-date').textContent = new Date().toLocaleDateString('en-IN', { day:'numeric', month:'long', year:'numeric' });
            document.getElementById('r-receipt-no').textContent = receiptNo;
            document.getElementById('r-amount').textContent = '৳' + amount;

            const statusBadge = document.getElementById('r-status-badge');
            statusBadge.textContent = status === 'Paid' ? '✅ PAID' : '❌ DUE';
            statusBadge.className = 'receipt-status-badge ' + (status === 'Paid' ? 'receipt-paid-badge' : 'receipt-due-badge');

            document.getElementById('receipt').style.display = 'block';
            document.getElementById('download-btn').style.display = 'block';

            showMsg('Fee recorded successfully!', 'success');
        };

        window.downloadReceipt = function() {
            const receipt = document.getElementById('receipt');
            html2canvas(receipt, { scale: 3, backgroundColor: '#ffffff', useCORS: true }).then(canvas => {
                const link = document.createElement('a');
                link.download = `Receipt_${selectedStudent.code}_${document.getElementById('fee-month').value}_${selectedYear}.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
            });
        };

        function showMsg(text, type) {
            const box = document.getElementById('msg-box');
            box.className = 'msg-box msg-' + type;
            box.innerHTML = `<i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle"></i> ${text}`;
            box.style.display = 'block';
            setTimeout(() => box.style.display = 'none', 3000);
        }
    </script>
</body>
</html>