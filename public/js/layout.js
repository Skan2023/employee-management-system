// Sidebar Toggle
function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  const mainContent = document.getElementById("mainContent");
  sidebar.classList.toggle("collapsed");
  mainContent.classList.toggle("expanded");
  localStorage.setItem(
    "sidebarCollapsed",
    sidebar.classList.contains("collapsed"),
  );
}

// Mobile Sidebar
function toggleMobileSidebar() {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("mobileOverlay");
  sidebar.classList.add("mobile-open");
  overlay.classList.add("active");
}

function closeMobileSidebar() {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("mobileOverlay");
  sidebar.classList.remove("mobile-open");
  overlay.classList.remove("active");
}

// User Menu Toggle
function toggleUserMenu() {
  const menu = document.getElementById("userMenu");
  menu.style.display = menu.style.display === "none" ? "block" : "none";
}

// Close user menu when clicking outside
document.addEventListener("click", function (event) {
  const userProfile = document.querySelector(".user-profile");
  const userMenu = document.getElementById("userMenu");
  if (userMenu && !userProfile.contains(event.target)) {
    userMenu.style.display = "none";
  }
});

// Highlight active menu item
document.addEventListener("DOMContentLoaded", function () {
  const currentPage = window.location.pathname.split("/")[2] || "dashboard";
  document.querySelectorAll(".menu-item").forEach((item) => {
    if (item.getAttribute("data-page") === currentPage) {
      item.classList.add("active");
    }
  });

  // Restore sidebar state
  const sidebarCollapsed = localStorage.getItem("sidebarCollapsed") === "true";
  if (sidebarCollapsed) {
    document.getElementById("sidebar").classList.add("collapsed");
    document.getElementById("mainContent").classList.add("expanded");
  }
});
