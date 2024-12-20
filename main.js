document.addEventListener('DOMContentLoaded', () => {
    // Toggle do menu dropdown no ícone do chevron
    document.getElementById('dropdown-button').addEventListener('click', function(event) {
        event.stopPropagation();
        var dropdownMenu = document.getElementById('dropdown-menu');
        
        // Alterna a visibilidade do menu
        dropdownMenu.style.display = (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') ? 'block' : 'none';
    });

    // Toggle notification menu on bell-icon click
    document.getElementById('bell-button').addEventListener('click', function(event) {
        event.stopPropagation();
        var menu = document.getElementById('notification-menu');
        
        // Se o menu estiver escondido, mostrar e carregar notificações
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'block';
            loadNotifications();
        } else {
            menu.style.display = 'none';
        }
    });

    // Fechar menus se o usuário clicar fora
    window.addEventListener('click', function(event) {
        const dropdownMenu = document.getElementById('dropdown-menu');
        const menu = document.getElementById('notification-menu');

        // Fechar o dropdown
        if (!dropdownMenu.contains(event.target) && event.target.id !== 'dropdown-button') {
            dropdownMenu.style.display = 'none';
        }

        // Fechar notificações
        if (!menu.contains(event.target) && event.target.id !== 'bell-button') {
            menu.style.display = 'none';
        }
    });

    // Função para carregar notificações via AJAX
    function loadNotifications() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_notifications.php', true);
        
        xhr.onload = function() {
            if (this.status === 200) {
                var notifications = JSON.parse(this.responseText);
                var notificationList = document.getElementById('notification-list');
                notificationList.innerHTML = ''; // Limpa as notificações antigas
                
                if (notifications.length > 0) {
                    notifications.forEach(function(notification) {
                        var li = document.createElement('li');
                        li.textContent = notification.message;
                        notificationList.appendChild(li);
                    });
                } else {
                    notificationList.innerHTML = '<li>Sem novas notificações.</li>';
                }
            }
        };
        
        xhr.send();
    }

    // Redireciona para a página de criar pedidos
    document.getElementById('make-order-button').addEventListener('click', function() {
        window.location.href = 'create_order.php'; // Redirect to the order page
    });

    // Redireciona com filtro de data
    document.getElementById('filter-button').addEventListener('click', function() {
        const selectedDate = document.getElementById('filter-date').value;
        window.location.href = `main.php?date=${selectedDate}`;
    });

    // Redireciona com pesquisa
    document.getElementById('search-button').addEventListener('click', function() {
        const searchTerm = document.getElementById('search-ticket').value;
        window.location.href = `main.php?search=${searchTerm}`;
    });

    // Oculta o card de permissão
    const goArrow = document.querySelector('.go-arrow');
    if (goArrow) {
        goArrow.addEventListener('click', function() {
            document.getElementById('permission-card').style.display = 'none';
            localStorage.setItem('permissionCardHidden', 'true'); // Armazena que o card foi ocultado
        });
    }
    const goCorner = document.querySelector('.go-corner');
    if (goCorner) {
        goCorner.addEventListener('click', function() {
            document.getElementById('permission-card').style.display = 'none';
            localStorage.setItem('permissionCardHidden', 'true'); // Armazena que o card foi ocultado
        });
    }
    

    // Reexibe o card após 30 segundos
    setTimeout(() => {
        permissionCard.style.display = 'block';
        localStorage.removeItem('permissionCardHidden'); // Remove a flag após reexibir
    }, 10000); // 30000 ms = 30 segundos

    // Verifica se o card deve estar oculto ao carregar a página
const permissionCard = document.getElementById('permission-card');
if (localStorage.getItem('permissionCardHidden') === 'true') {
    permissionCard.style.display = 'none';
}
});
