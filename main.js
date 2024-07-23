document.addEventListener("DOMContentLoaded", function() {
    const ticketList = document.getElementById("ticket-list");
    const filterButton = document.getElementById("filter-button");
    const filterDate = document.getElementById("filter-date");

    // Função para buscar pedido
    async function fetchTickets(date = '') {
        try {
            const response = await fetch(`fetch_tickets.php?date=${date}`);
            const tickets = await response.json();
            updateTicketList(tickets);
        } catch (error) {
            console.error("Erro ao buscar pedidos:", error);
        }
    }

    // Função para atualizar a lista de tickets
    function updateTicketList(tickets) {
        ticketList.innerHTML = '';
        tickets.forEach(ticket => {
            const li = document.createElement('li');
            li.innerHTML = `
                <span>Pedido #${ticket.id}</span>
                <span class="ticket-status ${ticket.status}">${ticket.status}</span>
            `;
            ticketList.appendChild(li);
        });
    }

    // Botão de filtrar
    filterButton.addEventListener('click', function() {
        const date = filterDate.value;
        fetchTickets(date);
    });

    fetchTickets();
});
