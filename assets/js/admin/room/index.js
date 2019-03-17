import '../../../css/admin/room/index.css';

const deleteForms = document.querySelectorAll('.delete-form');

deleteForms.forEach((deleteForm) => {
    deleteForm.addEventListener('submit', (e) => {
        e.preventDefault();
    
        const roomId = deleteForm.dataset.deleteRoom;
        const url = Routing.generate('admin_room_delete', {id: roomId});
        
        (async (roomId) => {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'appication/json'
                },
                data: JSON.stringify(roomId)
            });
            if (response.ok) {
                const currentTr = deleteForm.parentNode.parentNode;
                currentTr.parentNode.removeChild(currentTr);
            }
        })();
    });
});


function hydrateForm(inputs, roomProps, room) {
    inputs.forEach((input) => {
        
        // includes() equals php in_array() function
        if (input.nodeName === 'select' && roomProps.includes(input.id)) {
            const select = document.getElementById(input.id);
            select.options[select.selectedIndex].value = room[input.id];
        } else if (roomProps.includes(input.id)) {
            document.getElementById(input.id).value = room[input.id];
        }
    });
}

const updateForms = document.querySelectorAll('.update-form');

updateForms.forEach((updateForm) => {
    updateForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const roomId = updateForm.dataset.updateRoom;
        const url = Routing.generate('admin_room_get', {id: roomId});

        (async (roomId) => {
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'appication/json'
                },
                data: JSON.stringify(roomId)
            });
            if (response.ok) {
                const room = JSON.parse(await response.json());
                const inputs = document.querySelectorAll('input');
                const roomProps = Object.keys(room);
                const areas = document.querySelectorAll('textarea');
                const selects = document.querySelectorAll('select');

                hydrateForm(inputs, roomProps, room);
                hydrateForm(areas, roomProps, room);
                hydrateForm(selects, roomProps, room);
                
                document.querySelector('#persist-submit').textContent = "Modifier";

                // Add a create button to create again
            }
        })();
    });
});
