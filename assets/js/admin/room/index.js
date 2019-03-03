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

const updateForms = document.querySelectorAll('.update-form');

updateForms.forEach((updateForm) => {
    updateForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const roomId = updateForm.dataset.updateRoom;
        const url = Routing.generate('admin_room_get', {id: roomId});

        (async (roomId) => {
            let response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'appication/json'
                },
                data: JSON.stringify(roomId)
            });
            if (response.ok) {
                let data = await response.json();
                console.log(data);
            }
        })();
    });
});