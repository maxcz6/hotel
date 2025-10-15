// Funciones de utilidad
function $(selector) {
    return document.querySelector(selector);
}

function $$(selector) {
    return document.querySelectorAll(selector);
}

// Manejador de estados de habitación
const RoomManager = {
    statusColors: {
        available: 'status-available',
        occupied: 'status-occupied',
        cleaning: 'status-cleaning'
    },

    updateStatus(roomId, newStatus) {
        const statusBadge = $(`#room-${roomId} .status-badge`);
        if (statusBadge) {
            // Remover clases de estado anteriores
            Object.values(this.statusColors).forEach(className => {
                statusBadge.classList.remove(className);
            });
            // Agregar nueva clase de estado
            statusBadge.classList.add(this.statusColors[newStatus]);
            statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
        }
    }
};

// Manejador del formulario de reserva
const BookingForm = {
    init() {
        const form = $('#booking-form');
        if (!form) return;

        form.addEventListener('submit', this.handleSubmit.bind(this));
        
        // Inicializar cálculo de precios
        const checkInInput = $('#check_in');
        const checkOutInput = $('#check_out');
        
        if (checkInInput && checkOutInput) {
            checkInInput.addEventListener('change', this.updatePrice.bind(this));
            checkOutInput.addEventListener('change', this.updatePrice.bind(this));
            
            // Establecer fecha mínima como hoy
            const today = new Date().toISOString().split('T')[0];
            checkInInput.min = today;
            
            checkInInput.addEventListener('change', () => {
                checkOutInput.min = checkInInput.value;
            });
        }
    },

    calculateNights(checkIn, checkOut) {
        const start = new Date(checkIn);
        const end = new Date(checkOut);
        const diff = end - start;
        return Math.ceil(diff / (1000 * 60 * 60 * 24));
    },

    updatePrice() {
        const checkIn = $('#check_in').value;
        const checkOut = $('#check_out').value;
        const pricePerNight = parseFloat($('#room-price').dataset.price);
        const summaryElement = $('#price-summary');
        
        if (checkIn && checkOut && summaryElement) {
            const nights = this.calculateNights(checkIn, checkOut);
            if (nights > 0) {
                const total = nights * pricePerNight;
                summaryElement.innerHTML = `
                    <div class="price-details">
                        <p>Noches: ${nights}</p>
                        <p>Precio por noche: $${pricePerNight.toFixed(2)}</p>
                        <p class="total">Total: $${total.toFixed(2)}</p>
                    </div>
                `;
            } else {
                summaryElement.innerHTML = '<p class="error">Por favor seleccione fechas válidas</p>';
            }
        }
    },

    handleSubmit(event) {
        event.preventDefault();
        
        // Validación básica
        const required = ['name', 'email', 'check_in', 'check_out'];
        const errors = [];
        
        required.forEach(field => {
            const input = $(`#${field}`);
            if (!input.value) {
                errors.push(`El campo ${field} es requerido`);
                input.classList.add('error');
            }
        });

        if (errors.length > 0) {
            this.showErrors(errors);
            return;
        }

        // Si todo está bien, enviar el formulario
        event.target.submit();
    },

    showErrors(errors) {
        const errorContainer = $('#error-container');
        if (errorContainer) {
            errorContainer.innerHTML = `
                <div class="alert alert-error">
                    <ul>
                        ${errors.map(error => `<li>${error}</li>`).join('')}
                    </ul>
                </div>
            `;
        }
    }
};

// Manejador de detalles expandibles
const ExpandableDetails = {
    init() {
        $$('.room-card').forEach(card => {
            const detailsBtn = card.querySelector('.details-toggle');
            const details = card.querySelector('.room-details');
            
            if (detailsBtn && details) {
                detailsBtn.addEventListener('click', () => {
                    details.classList.toggle('show');
                    detailsBtn.textContent = details.classList.contains('show') ? 
                        'Ocultar detalles' : 'Ver detalles';
                });
            }
        });
    }
};

// Inicialización cuando el DOM está listo
document.addEventListener('DOMContentLoaded', () => {
    BookingForm.init();
    ExpandableDetails.init();
    
    // Agregar animación de entrada a las tarjetas
    $$('.room-card').forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('fade-in');
    });
});