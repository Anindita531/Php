document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.event-card');

    cards.forEach(card => {
        const id = parseInt(card.dataset.id);
        const title = card.querySelector('.title');
        const date = card.querySelector('.date');
        const location = card.querySelector('.location');
        const description = card.querySelector('.description');
        const deleteBtn = card.querySelector('.delete-btn');

        [title, date, location, description].forEach(input => {
            input?.addEventListener('change', () => {
                fetch('update_event.php', {
                    method: 'POST',
                    headers: {'Content-Type':'application/json'},
                    body: JSON.stringify({
                        id: id,
                        title: title.value,
                        date: date.value,
                        location: location.value,
                        description: description.value
                    })
                });
            });
        });

        deleteBtn?.addEventListener('click', () => {
            if(confirm('Are you sure to delete this event?')){
                fetch('delete_event.php', {
                    method: 'POST',
                    headers: {'Content-Type':'application/json'},
                    body: JSON.stringify({id:id})
                }).then(()=> card.remove());
            }
        });
    });
});

  const toggle = document.getElementById('themeToggle');
  toggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    toggle.textContent = 
      document.body.classList.contains('dark-mode') 
      ? '☀️ Light Mode' 
      : '🌙 Dark Mode';
  });

