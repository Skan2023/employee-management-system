<?php if (isset($_SESSION['user_id'])): ?>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <div class="sidebar-logo">
        <img src="<?php echo BASE_URL; ?>assets/images/logo.png" alt="logo">
      </div>
      <div class="sidebar-brand">EMS</div>
    </div>

    <div class="sidebar-toggle" onclick="toggleSidebar()">
      <i class="bi bi-chevron-left"></i>
    </div>

    <div class="sidebar-menu">
      <?php if ($_SESSION['role'] === 'admin'): ?>
        <div class="menu-section">
          <div class="menu-label">Main Menu</div>
          <a href="<?php echo BASE_URL; ?>dashboard" class="menu-item" data-page="dashboard">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>
          <a href="<?php echo BASE_URL; ?>employee" class="menu-item" data-page="employee">
            <i class="bi bi-people-fill"></i>
            <span>Employees</span>
          </a>
        </div>
        <div class="menu-section">
          <div class="menu-label">Management</div>
          <a href="<?php echo BASE_URL; ?>department" class="menu-item" data-page="department">
            <i class="bi bi-diagram-3-fill"></i>
            <span>Departments</span>
          </a>
          <a href="<?php echo BASE_URL; ?>position" class="menu-item" data-page="position">
            <i class="bi bi-briefcase-fill"></i>
            <span>Positions</span>
          </a>
          <a href="<?php echo BASE_URL; ?>salary" class="menu-item" data-page="salary">
            <i class="bi bi-cash-coin"></i>
            <span>Salaries</span>
          </a>
        </div>
        <div class="menu-section">
          <div class="menu-label">Time & Leave</div>
          <a href="<?php echo BASE_URL; ?>leaverequest" class="menu-item" data-page="leaverequest">
            <i class="bi bi-calendar-event-fill"></i>
            <span>Leave Requests</span>
            <?php if (isset($pendingLeaves) && $pendingLeaves > 0): ?>
              <span class="menu-badge"><?php echo $pendingLeaves; ?></span>
            <?php endif; ?>
          </a>
        </div>
      <?php elseif ($_SESSION['role'] === 'employee'): ?>
        <div class="menu-section">
          <div class="menu-label">Main Menu</div>
          <a href="<?php echo BASE_URL; ?>dashboard" class="menu-item" data-page="dashboard">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>
        </div>
        <div class="menu-section">
          <div class="menu-label">Time & Leave</div>
          <a href="<?php echo BASE_URL; ?>leaverequest" class="menu-item" data-page="leaverequest">
            <i class="bi bi-calendar-event-fill"></i>
            <span>Leave Requests</span>
            <?php if (isset($pendingLeaves) && $pendingLeaves > 0): ?>
              <span class="menu-badge"><?php echo $pendingLeaves; ?></span>
            <?php endif; ?>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Mobile Overlay -->
  <div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileSidebar()"></div>

<?php endif; ?>