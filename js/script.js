document.addEventListener('DOMContentLoaded', function() {
    const themeSwitch = document.getElementById('theme-switch');

    // Apply theme on page load
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        themeSwitch.checked = true;
    } else {
        document.body.classList.remove('dark-mode');
        themeSwitch.checked = false;
    }

    // Listen for theme changes
    themeSwitch.addEventListener('change', function() {
        if (this.checked) {
            document.body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    });
});

        // JavaScript untuk modal popup
        var modal = document.getElementById('imageModal');
        var modalImg = document.getElementById('modalImage');
        var images = document.querySelectorAll('.img-tr');
        var closeModal = document.getElementsByClassName('close')[0];

        images.forEach(function(img) {
            img.onclick = function() {
                modal.style.display = 'block';
                modalImg.src = this.src;
            }
        });

        closeModal.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }


        