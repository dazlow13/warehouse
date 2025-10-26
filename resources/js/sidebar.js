// Toggle dropdown
window.toggleDropdown = function () {
    const submenu = document.getElementById('submenu');
    const arrow = document.getElementById('arrow');

    if (!submenu || !arrow) return;

    submenu.classList.toggle('d-none');  // Ẩn / hiện bằng Bootstrap utility
    arrow.classList.toggle('rotate-180'); // Xoay mũi tên (css tự tạo dưới đây)
};

// Click ra ngoài thì ẩn dropdown
document.addEventListener('click', function (event) {
    const submenu = document.getElementById('submenu');
    const arrow = document.getElementById('arrow');
    const button = document.querySelector('button[onclick="toggleDropdown()"]');

    if (!submenu || !arrow || !button) return;

    if (!submenu.contains(event.target) && !button.contains(event.target)) {
        submenu.classList.add('d-none');
        arrow.classList.remove('rotate-180');
    }
});

