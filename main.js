// Toggle do menu dropdown no ícone do chevron
document.getElementById('dropdown-button').addEventListener('click', function(event) {
    event.stopPropagation();
    var dropdownMenu = document.getElementById('dropdown-menu');
    
    // Alterna a visibilidade do menu
    if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
        dropdownMenu.style.display = 'block';
    } else {
        dropdownMenu.style.display = 'none';
    }
});

// Fechar o menu se o usuário clicar fora
window.addEventListener('click', function(event) {
    var dropdownMenu = document.getElementById('dropdown-menu');
    
    // Verifica se o clique foi fora do dropdown e do botão de chevron
    if (!dropdownMenu.contains(event.target) && event.target.id !== 'dropdown-button') {
        dropdownMenu.style.display = 'none';
    }
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

// Fechar menu de notificações se clicar fora
window.addEventListener('click', function(event) {
    var menu = document.getElementById('notification-menu');
    if (!menu.contains(event.target) && event.target.id !== 'bell-button') {
        menu.style.display = 'none';
    }
});

document.getElementById('make-order-button').addEventListener('click', function() {
    window.location.href = 'create_order.php'; // Redirect to the order page
});

