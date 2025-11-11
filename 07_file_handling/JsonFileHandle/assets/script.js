function addNote() {
  let title = document.getElementById("title").value;
  let content = document.getElementById("content").value;

  fetch("note_action.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `action=add&title=${encodeURIComponent(title)}&content=${encodeURIComponent(content)}`
  })
  .then(res => res.json())
  .then(note => {
    let container = document.getElementById("notes-container");
    let div = document.createElement("div");
    div.className = "note-card";
    div.innerHTML = `
      <h3 contenteditable="true" class="note-title">${note.title}</h3>
      <p contenteditable="true" class="note-content">${note.content}</p>
      <button onclick="deleteNote('${note.id}')">🗑️</button>
    `;
    container.prepend(div);
  });
}

function deleteNote(id) {
  fetch("note_action.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `action=delete&id=${id}`
  }).then(() => {
    document.querySelector(`[data-id='${id}']`).remove();
  });
}
