document.addEventListener('DOMContentLoaded', () => {
    // Alert auto-dismiss
    const autoAlert = document.querySelector('.alert-auto-dismiss');
    if (autoAlert) {
        setTimeout(() => {
            autoAlert.classList.add('fade');
            autoAlert.addEventListener('transitionend', () => {
                autoAlert.remove();
            });
        }, 4000);
    }

    // Validación básica del formulario de contacto
    const formContacto = document.querySelector('#form-contacto');
    if (formContacto) {
        formContacto.addEventListener('submit', (e) => {
            const nombre = formContacto.querySelector('input[name="nombre"]');
            const email = formContacto.querySelector('input[name="email"]');
            const mensaje = formContacto.querySelector('textarea[name="mensaje"]');

            if (!nombre.value.trim() || !email.value.trim() || !mensaje.value.trim()) {
                e.preventDefault();
                alert('Por favor, complete todos los campos antes de enviar.');
            }
        });
    }
});
