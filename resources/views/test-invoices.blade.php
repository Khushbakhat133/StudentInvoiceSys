<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Invoice System</title>
    <link rel="preconnect" href="https://googleapis.com"><link rel="preconnect" href="https://gstatic.com" crossorigin><link href="https://googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg-primary: #f8fafc; --sidebar-bg: #0f172a; --sidebar-text: #94a3b8; --surface: #ffffff; --text-main: #0f172a; --text-muted: #64748b; --border: #e2e8f0; --primary: #4f46e5; --primary-light: #e0e7ff; --success: #16a34a; --success-bg: #dcfce7; --warning: #ca8a04; --warning-bg: #fef9c3; --danger: #dc2626; --danger-bg: #fee2e2; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-primary); color: var(--text-main); display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background-color: var(--sidebar-bg); color: white; display: flex; flex-direction: column; padding: 24px; flex-shrink: 0; }
        .sidebar .brand { font-size: 1.15rem; font-weight: 700; color: white; margin-bottom: 36px; display: flex; align-items: center; gap: 8px; }
        .sidebar .brand-dot { width: 10px; height: 10px; background-color: var(--primary); border-radius: 50%; }
        .nav-menu { list-style: none; display: flex; flex-direction: column; gap: 8px; }
        .nav-item a { color: var(--sidebar-text); text-decoration: none; font-size: 0.9rem; font-weight: 500; padding: 10px 14px; border-radius: 8px; display: block; }
        .nav-item.active a, .nav-item a:hover { background-color: rgba(255, 255, 255, 0.06); color: white; }
        .main-content { flex-grow: 1; padding: 40px; max-width: calc(100% - 260px); }
        .top-navbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; border-bottom: 1px solid var(--border); padding-bottom: 20px; }
        .header h2 { font-size: 1.5rem; font-weight: 700; color: var(--text-main); margin-bottom: 4px; letter-spacing: -0.02em; }
        .header p { color: var(--text-muted); font-size: 0.875rem; }
        .highlight-box { background-color: var(--primary-light); color: #3730a3; display: inline-block; padding: 2px 10px; border-radius: 6px; font-weight: 600; font-size: 0.8rem; }
        .user-profile { display: flex; align-items: center; gap: 12px; }
        .user-avatar { width: 40px; height: 40px; background: var(--primary-light); color: var(--primary); font-weight: 700; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; }
        .stats-grid { display: flex; flex-wrap: wrap; gap: 24px; margin-bottom: 32px; width: 100%; }
        .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.02); flex: 1; min-width: 240px; }
        .stat-label { font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: var(--text-muted); letter-spacing: 0.05em; margin-bottom: 6px; }
        .stat-value { font-size: 1.75rem; font-weight: 700; color: var(--text-main); letter-spacing: -0.02em; }
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; width: 100%; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.925rem; }
        th { background-color: #f1f5f9; color: #475569; font-weight: 600; padding: 16px 24px; text-transform: uppercase; font-size: 0.75rem; border-bottom: 1px solid var(--border); }
        td { padding: 18px 24px; border-bottom: 1px solid var(--border); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background-color: #f8fafc; }
        .badge { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; }
        .badge.paid { background-color: var(--success-bg); color: var(--success); }
        .badge.unpaid { background-color: var(--danger-bg); color: var(--danger); }
        .badge.pending { background-color: var(--warning-bg); color: var(--warning); }
        .payments-list { list-style: none; }
        .payments-list li { font-size: 0.875rem; margin-bottom: 4px; color: #334155; }
        .payment-method { color: var(--text-muted); font-size: 0.8rem; background: #f1f5f9; padding: 2px 6px; border-radius: 4px; margin-left: 4px; }
        .invoice-id { font-weight: 600; color: var(--primary); }
        .amount-text { font-weight: 600; color: var(--text-main); }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand"><div class="brand-dot"></div>Student Invoice System</div>
        <ul class="nav-menu">
            <li class="nav-item active"><a href="#">Dashboard</a></li>
            <!-- <li class="nav-item"><a href="#">Students Directory</a></li>
            <li class="nav-item"><a href="#">Invoices Ledger</a></li>
            <li class="nav-item"><a href="#">Payment History</a></li>
            <li class="nav-item"><a href="#">Settings Config</a></li> -->
        </ul>
    </aside>

    <main class="main-content">
        <div class="top-navbar">
            <div class="header">
                <h2>Billing Overview</h2>
                <p>System Monitor — <span class="highlight-box">Eager Loading Active</span></p>
            </div>
            <div class="user-profile">
                <div style="text-align: right;">
                    <div style="font-weight: 600; font-size: 0.9rem;">Admin Panel</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted);">Evaluation Mode</div>
                </div>
                <div class="user-avatar">AD</div>
            </div>
        </div>

        <!-- 3 Stats Cards Grouped Safely Inside the Stats Grid Row -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Invoiced</div>
                <div class="stat-value">${{ number_format($invoices->sum('total_amount'), 2) }}</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-label">Active Records</div>
                <div class="stat-value">{{ $invoices->count() }}</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-label">Collected Revenue</div>
                @php
                    $collectedAmount = $invoices->where('status', 'paid')->sum('total_amount');
                    $paidCount = $invoices->where('status', 'paid')->count();
                @endphp
                <div class="stat-value" style="color: var(--success);">${{ number_format($collectedAmount, 2) }}</div>
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">
                    Received from {{ $paidCount }} paid invoice{{ $paidCount != 1 ? 's' : '' }}
                </div>
            </div>
        </div>

        <!-- Data Table Container Renders Correctly Below the Scoreboard Row -->
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Student Name</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Payments Ledger</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td class="invoice-id">#INV-{{ str_pad($invoice->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div style="font-weight: 500;">{{ $invoice->student->name }}</div>
                                <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $invoice->student->email }}</div>
                            </td>
                            <td class="amount-text">${{ number_format($invoice->total_amount, 2) }}</td>
                            <td><span class="badge {{ strtolower($invoice->status) }}">{{ $invoice->status }}</span></td>
                            <td>
                                @if($invoice->payments->count() > 0)
                                    <ul class="payments-list">
                                        @foreach($invoice->payments as $payment)
                                            <li>
                                                <span style="font-weight: 500; color: var(--success);">${{ number_format($payment->amount, 2) }}</span>
                                                <span class="payment-method">{{ str_replace('_', ' ', $payment->payment_method) }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span style="color: var(--text-muted); font-size: 0.85rem; font-style: italic;">No payments recorded</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
