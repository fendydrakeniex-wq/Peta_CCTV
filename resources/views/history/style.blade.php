<style>
    body {
        background: linear-gradient(135deg, #0f172a, #1e293b);
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
    .card {
        background: #1e293b;
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    h3, h2, h5 {
        font-weight: 700;
        text-align: center;
        color: #f1f5f9;
        margin: 0;
    }
    .table-container {
        overflow-x: auto;
    }

    table {
        border-collapse: separate !important;
        border-spacing: 0;
        width: 100%;
    }

    thead th {
        background-color: #334155 !important;
        color: #e2e8f0 !important;
        font-weight: 600;
        border-bottom: 2px solid #475569;
    }

    tbody tr:hover td {
        background-color: #273549 !important;
        transition: 0.2s ease;
    }

    td {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .btn-back {
        background-color: #2563eb;
        color: white;
        border-radius: 8px;
        padding: 6px 14px;
        text-decoration: none;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-back:hover {
        background-color: #1d4ed8;
    }

    .pagination {
        justify-content: center;
    }

    .pagination .page-link {
        background-color: #1e293b;
        color: #f8fafc;
        border: none;
        margin: 0 2px;
        border-radius: 6px;
    }

    .pagination .page-link:hover {
        background-color: #334155;
    }

    .pagination .active .page-link {
        background-color: #2563eb;
        border-color: #2563eb;
    }
</style>
