<style>
    body {
        background: linear-gradient(135deg, #111827, #1f2937);
        font-family: 'Poppins', sans-serif;
    }

    /* 🔹 Navbar */
    .navbar {
        background-color: #111827 !important;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .navbar-brand {
        font-weight: 600;
        color: #fff !important;
    }
    .navbar .btn-outline-light {
        border-color: #9ca3af;
        color: #f9fafb;
    }
    .navbar .btn-outline-light:hover {
        background-color: #2563eb;
        border-color: #2563eb;
        color: #fff;
    }

    /* 🔹 Dashboard */
    .dashboard-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
        color: #f9fafb;
        text-align: center;
    }
    h1 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    p {
        color: #9ca3af;
        margin-bottom: 2rem;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        width: 90%;
        max-width: 900px;
    }

    .menu-card {
        background: #1f2937;
        border-radius: 16px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255,255,255,0.05);
        transition: 0.3s ease;
        overflow: hidden;
    }

    .menu-card:hover {
        transform: translateY(-8px);
        background: #374151;
        border-color: #2563eb;
    }

    .menu-link {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        padding: 2rem 1rem;
        width: 100%;
        height: 100%;
        text-decoration: none;
        color: #f9fafb;
    }

    .menu-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .menu-title {
        font-weight: 600;
        font-size: 1rem;
    }

    .menu-card small {
        display: block;
        color: #9ca3af;
        margin-top: 4px;
    }
</style>
