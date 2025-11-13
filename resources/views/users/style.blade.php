{{-- resources/views/users/style.blade.php --}}
<style>
    body {
        background: linear-gradient(145deg, #0f172a, #1e293b);
        color: #f8fafc;
        font-family: 'Poppins', sans-serif;
    }

    .header {
        position: relative;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        padding: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        border-radius: 12px;
        margin-bottom: 24px;
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(6px);
    }

    #backBtn {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: #2563eb;
        color: white;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }
    #backBtn:hover { background: #1d4ed8; }

    h3, h2, h5 {
        font-weight: 700;
        text-align: center;
        color: #f1f5f9;
        margin: 0;
    }

    .card {
        background: rgba(30, 41, 59, 0.9);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255,255,255,0.05);
        backdrop-filter: blur(8px);
    }

    table {
        color: #f8fafc;
        border-collapse: separate;
        width: 100%;
        border-spacing: 0 10px;
    }

    thead tr { background: #2563eb; color: white; }
    tbody tr { background: #334155; transition: 0.3s; }
    tbody tr:hover { background: #475569; transform: scale(1.01); }

    tbody td, thead th {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .table-container {
        overflow-x: auto;
        border-radius: 12px;
    }

    .pagination { justify-content: center; }

    .btn { border: none; border-radius: 8px; padding: 8px 14px; font-weight: 600; transition: 0.2s; }
    .btn-primary { background: #2563eb; }
    .btn-primary:hover { background: #1e40af; }
    .btn-warning { background: #f59e0b; color: #fff; }
    .btn-danger { background: #dc2626; color: #fff; }
    .btn-success { background: #16a34a; color: #fff; }

    .badge { border-radius: 6px; padding: 5px 10px; font-size: 0.85rem; }
    .badge-admin { background-color: #2563eb; color: white; }
    .badge-user { background-color: #64748b; color: white; }
</style>
