/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Modal/Dialog
--------------------------------------------------------------*/


// 1.0 - Modal/Dialog
export function dialogModal() {
    const modals    = document.querySelectorAll('.js-modal-parent');

    if(modals) {
        modals.forEach((modal) => {
            const target = modal.querySelector('.js-modal-target');
            const source  = modal.querySelector('.js-modal-source');
            const close   = modal.querySelector('#closeModalBtn');

            // Open the modal
            target.addEventListener('click', () => {
                source.showModal();
                document.body.classList.add('modal-open'); // Lock the body
            });

            // Close the modal
            close.addEventListener('click', () => {
                source.close();
                document.body.classList.remove('modal-open'); // Unlock the body
            });

            // Close the modal when clicking outside of it
            source.addEventListener('click', (event) => {
                if (event.target === source) {
                    source.close();
                    document.body.classList.remove('modal-open'); // Unlock the body
                }
            });
        });
    }
}