document.addEventListener("DOMContentLoaded", (event) => {
    const modalWindow = document.getElementById('editModal');
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    const token = getCookie('access_token');

    const headers = {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
        'X-CSRF-TOKEN': csrfToken,
    };

    document.getElementById('closeEditModal').addEventListener('click', () => {
        modalWindow.style.display = 'none';
    });

    function openModal(event) {
        const button = event.currentTarget;
        const id = button.getAttribute('data-id');
        modalWindow.style.display = 'block';
        getArticle(id);

    }

    const buttons = document.querySelectorAll('.editArticle');

    buttons.forEach(button => {
        button.addEventListener('click', openModal);
    });

    function getCookie(name) {
        const cookies = document.cookie.split(';');
        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i].trim();
            if (cookie.startsWith(name + '=')) {
                return cookie.substring(name.length + 1);
            }
        }

        return '';
    }

    function getArticle(id) {
        console.log(headers);
        fetch('/api/article/' + id, {
            method: 'GET',
            headers,
        })
            .then(response => {
                return response.json();
            })
            .then(data => {
                console.log(data)
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});
