const apiURL = "http://localhost:8080/php_journey/10_api_json/User_API/api.php";

// Fetch all users
async function loadUsers() {
  const res = await fetch(apiURL);
  const users = await res.json();

  const container = document.getElementById("userList");
  container.innerHTML = "";

  users.forEach(user => {
    const div = document.createElement("div");
    div.className = "user-card";
    div.innerHTML = `
      <strong>${user.name}</strong> (${user.email})<br>
      <button onclick="editUser(${user.id}, '${user.name}', '${user.email}')">✏️ Edit</button>
      <button onclick="deleteUser(${user.id})">🗑️ Delete</button>
    `;
    container.appendChild(div);
  });
}

// Add new user
document.getElementById("addForm").addEventListener("submit", async e => {
  e.preventDefault();
  const data = {
    name: document.getElementById("name").value,
    email: document.getElementById("email").value
  };
  await fetch(apiURL, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  });
  e.target.reset();
  loadUsers();
});

// Edit user
async function editUser(id, oldName, oldEmail) {
  const name = prompt("Edit name:", oldName);
  const email = prompt("Edit email:", oldEmail);
  if (!name || !email) return;

  await fetch(apiURL, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id, name, email })
  });
  loadUsers();
}

// Delete user
async function deleteUser(id) {
  if (!confirm("Delete this user?")) return;
  await fetch(apiURL, {
    method: "DELETE",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ id })
  });
  loadUsers();
}

loadUsers();
