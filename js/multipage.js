document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.nav-link');
    const content = document.getElementById('page-content');
    const defaultPage = 'dashboard';

    function loadPage(page) {
        fetch(`${page}.html`)
            .then(response => response.text())
            .then(html => {
                content.innerHTML = html;
                setActiveLink(page);
            })
            .catch(error => {
                console.error('Error loading page:', error);
                content.innerHTML = '<p>Page not found.</p>';
            });
    }

    function setActiveLink(page) {
        links.forEach(link => {
            link.classList.remove('active');
            if (link.dataset.page === page) {
                link.classList.add('active');
            }
        });
    }

    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const page = this.dataset.page;
            window.location.hash = page;
            loadPage(page);
        });
    });

    window.addEventListener('hashchange', function() {
        const page = window.location.hash.substring(1) || defaultPage;
        loadPage(page);
    });

    const initialPage = window.location.hash.substring(1) || defaultPage;
    loadPage(initialPage);
});
