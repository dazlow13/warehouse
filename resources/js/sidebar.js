// Toggle dropdown
window.toggleDropdown = function () {
    const submenu = document.getElementById('submenuProducts'); // sửa id
    const arrow = document.getElementById('arrow');
    if (!submenu || !arrow) return;

    submenu.classList.toggle('d-none');
    arrow.classList.toggle('rotate-180');
};

// Click ra ngoài thì ẩn
document.addEventListener('click', function (event) {
    const submenu = document.getElementById('submenuProducts'); // sửa id
    const arrow = document.getElementById('arrow');
    const button = document.querySelector('button[onclick="toggleDropdown()"]');

    if (!submenu || !arrow || !button) return;

    const isClickInside = submenu.contains(event.target) || 
                          button.contains(event.target) || 
                          event.target === button;

    if (!isClickInside) {
        submenu.classList.add('d-none');
        arrow.classList.remove('rotate-180');
    }
});