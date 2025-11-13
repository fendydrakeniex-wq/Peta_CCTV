<style>
/* Navbar Background */
.main-navbar {
  background: linear-gradient(90deg, #1f2a8a, #262982);
  border-bottom: 1px solid #333;
  min-height: 60px;
}

/* Tombol menu */
.menu-btn {
  color: #fff;
  font-weight: 500;
  padding: 7px 15px;
  margin: 5px 6px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  transition: 0.2s ease;
}
.menu-btn:hover {
  background: rgba(255, 255, 255, 0.12);
  transform: translateY(-1px);
}

/* Warna border per tombol */
.border-blue   { border: 1px solid #287bff; }
.border-purple { border: 1px solid #7e5bef; }
.border-green  { border: 1px solid #28d47b; }
.border-orange { border: 1px solid #ffb020; }
.border-cyan   { border: 1px solid #00c8ff; }
.border-pink { border: 1px solid #ff66b2; }

/* Tombol Logout */
.btn-logout {
  background: transparent;
  border: 1px solid rgba(255, 255, 255, 0.6);
  color: #fff;
  padding: 5px 12px;
  border-radius: 6px;
  font-size: 14px;
  transition: 0.2s ease;
}
.btn-logout:hover {
  background: rgba(255, 255, 255, 0.2);
}

/* Nama user */
.username {
  font-weight: 500;
}
/* ===== ACTIVE STATE ===== */
.menu-btn.active {
  background: rgba(255, 0, 0, 0.15);
  box-shadow: 0 0 6px rgba(9, 255, 0, 0.3);
  transform: translateY(-1px);
}
/* Responsif */
@media (max-width: 768px) {
  .main-navbar {
    flex-direction: column;
    align-items: flex-start;
    padding: 10px 15px;
  }
  .menu-buttons {
    flex-direction: column;
    width: 100%;
  }
  .menu-btn {
    width: 100%;
    text-align: left;
  }
  .navbar-right {
    width: 100%;
    justify-content: space-between;
    margin-top: 10px;
  }
}
</style>
