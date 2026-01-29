function sendFriendRequest(userId) {
    const btn = document.getElementById('friend-btn');

    btn.disabled = true;
    btn.innerText = '⏳ Envoi...';

    fetch(`/amis/${userId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'pending') {
            btn.classList.remove('bg-indigo-600');
            btn.classList.add('bg-gray-400');
            btn.innerText = '⏳ Demande envoyée';
        } else if (data.status === 'accepted') {
            btn.classList.remove('bg-indigo-600');
            btn.classList.add('bg-green-600');
            btn.innerText = '✅ Amis';
        }
    })
    .catch(() => {
        btn.disabled = false;
        btn.innerText = '➕ Ajouter en ami';
        alert('Erreur, réessayez');
    });
}
function respondInvitation(id, action) {
    fetch(`/amis/${id}/${action}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(() => {
        const card = document.getElementById(`invite-${id}`);
        card.classList.add('opacity-0', 'scale-95');
        setTimeout(() => card.remove(), 300);
    });
}