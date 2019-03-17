import '../../../css/admin/room/persist.css';

const form = document.querySelector('persist-room');

const formData = new FormData(form);

form.addEventListener('submit', (e) => {
    e.preventDefault();

    const url = Routing.generate('admin_persist_room');

    (async () => {
        let response = await fetch(url, {

        });
    })();
});