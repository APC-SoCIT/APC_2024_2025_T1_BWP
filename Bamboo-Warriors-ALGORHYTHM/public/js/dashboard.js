// Sidebar toggle functionality
const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

// Theme toggle functionality
document.querySelector(".theme-toggle").addEventListener("click", () => {
    toggleLocalStorage();
    toggleRootClass();
    updateThemeIcon();
});

// Function to toggle the root class based on the current theme
function toggleRootClass() {
    const current = document.documentElement.getAttribute('data-bs-theme');
    const inverted = current === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-bs-theme', inverted);
}

// Function to toggle the theme state in localStorage
function toggleLocalStorage() {
    if (isLight()) {
        localStorage.removeItem("light");
    } else {
        localStorage.setItem("light", "set");
    }
}

// Function to check if the theme is light or not
function isLight() {
    return localStorage.getItem("light");
}

// Function to update the theme icon or button based on the current theme
function updateThemeIcon() {
    const icon = document.querySelector(".theme-toggle .fa");
    if (document.documentElement.getAttribute('data-bs-theme') === 'dark') {
        icon.classList.replace("fa-sun", "fa-moon");
    } else {
        icon.classList.replace("fa-moon", "fa-sun");
    }
}

// Set the correct theme on initial load based on localStorage
if (isLight()) {
    toggleRootClass(); // Set the theme to light
    updateThemeIcon(); // Set the icon to sun (light mode)
} else {
    updateThemeIcon(); // Set the icon to moon (dark mode)
}
