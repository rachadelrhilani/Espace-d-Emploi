document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById("friend-action");
    if (!container) return;

    const userId = container.dataset.userId;
    const btn = document.getElementById("friend-btn");

    fetch(`/friends/status/${userId}`)
        .then(res => res.json())
        .then(data => {
            if (data.status === "friends") {
                btn.textContent = "Déjà amis";
                btn.className = "px-4 py-2 bg-green-500 text-white rounded-lg";
            }
            else if (data.status === "pending") {
                btn.textContent = "Invitation envoyée";
                btn.className = "px-4 py-2 bg-yellow-400 text-white rounded-lg";
            }
            else if (data.status === "rejected") {
                btn.textContent = "Invitation refuser";
                btn.className = "px-4 py-2 bg-red-600 text-white rounded-lg";
            }
            else {
                btn.textContent = "Ajouter en ami";
                btn.disabled = false;
                btn.className = "px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700";
                btn.onclick = () => sendFriendRequest(userId);
            }
        });
});
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
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .content,
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(() => {
        const card = document.getElementById(`invite-${id}`);
        if (!card) return;

        card.classList.add('opacity-0', 'scale-95');
        setTimeout(() => card.remove(), 300);
    });
}