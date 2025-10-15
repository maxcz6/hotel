// Funcionalidad del Formulario de Reserva

class BookingForm {
    constructor() {
        this.form = document.getElementById('booking-form');
        if (!this.form) return;

        this.checkInInput = document.getElementById('check_in');
        this.checkOutInput = document.getElementById('check_out');
        this.priceElement = document.getElementById('room-price');
        this.priceSummary = document.getElementById('price-summary');
        this.errorContainer = document.getElementById('error-container');

        this.initializeDateInputs();
        this.attachEventListeners();
    }

    initializeDateInputs() {
        // Establecer la fecha mínima como hoy
        const today = new Date().toISOString().split('T')[0];
        this.checkInInput.min = today;
        this.checkOutInput.min = today;

        // Establecer valores predeterminados si no están establecidos
        if (!this.checkInInput.value) {
            this.checkInInput.value = today;
        }
        if (!this.checkOutInput.value) {
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            this.checkOutInput.value = tomorrow.toISOString().split('T')[0];
        }
    }

    attachEventListeners() {
        // Actualizar fecha mínima de salida cuando cambia la fecha de entrada
        this.checkInInput.addEventListener('change', () => {
            const checkInDate = new Date(this.checkInInput.value);
            const minCheckOutDate = new Date(checkInDate);
            minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
            
            this.checkOutInput.min = minCheckOutDate.toISOString().split('T')[0];
            if (new Date(this.checkOutInput.value) <= checkInDate) {
                this.checkOutInput.value = minCheckOutDate.toISOString().split('T')[0];
            }
            
            this.updatePriceSummary();
        });

        // Actualizar resumen de precios cuando cambia la fecha de salida
        this.checkOutInput.addEventListener('change', () => {
            this.updatePriceSummary();
        });

        // Validar formulario antes de enviar
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    updatePriceSummary() {
        const checkIn = new Date(this.checkInInput.value);
        const checkOut = new Date(this.checkOutInput.value);
        const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
        const pricePerNight = parseFloat(this.priceElement.dataset.price);
        const totalPrice = nights * pricePerNight;

        this.priceSummary.innerHTML = `
            <div class="price-line">
                <span>Precio por noche:</span>
                <span>$${pricePerNight.toFixed(2)}</span>
            </div>
            <div class="price-line">
                <span>Número de noches:</span>
                <span>${nights}</span>
            </div>
            <div class="price-line price-total">
                <span>Total:</span>
                <span>$${totalPrice.toFixed(2)}</span>
            </div>
        `;
    }

    handleSubmit(e) {
        e.preventDefault();
        this.clearErrors();

        if (this.validateForm()) {
            this.form.submit();
        }
    }

    validateForm() {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const checkIn = new Date(this.checkInInput.value);
        const checkOut = new Date(this.checkOutInput.value);

        const errors = [];

        if (!name) {
            errors.push('El nombre es requerido');
        }

        if (!email && !phone) {
            errors.push('Debe proporcionar al menos un método de contacto (email o teléfono)');
        }

        if (email && !this.isValidEmail(email)) {
            errors.push('El email no es válido');
        }

        if (checkIn >= checkOut) {
            errors.push('La fecha de salida debe ser posterior a la fecha de entrada');
        }

        if (errors.length > 0) {
            this.showErrors(errors);
            return false;
        }

        return true;
    }

    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    showErrors(errors) {
        this.errorContainer.style.display = 'block';
        this.errorContainer.innerHTML = `
            <ul>
                ${errors.map(error => `<li>${error}</li>`).join('')}
            </ul>
        `;
    }

    clearErrors() {
        this.errorContainer.style.display = 'none';
        this.errorContainer.innerHTML = '';
    }
}

// Inicializar el formulario cuando el DOM está listo
document.addEventListener('DOMContentLoaded', () => {
    new BookingForm();
});