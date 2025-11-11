document.addEventListener("DOMContentLoaded", () => {
  // 🔍 Search Filter
  document.getElementById("search").addEventListener("keyup", e => {
    const term = e.target.value.toLowerCase();
    document.querySelectorAll(".file-card").forEach(card => {
      card.style.display = card.dataset.name.toLowerCase().includes(term) ? "" : "none";
    });
  });

  // 🗂️ Type Filter
  document.getElementById("filter").addEventListener("change", e => {
    const type = e.target.value;
    document.querySelectorAll(".file-card").forEach(card => {
      const name = card.dataset.name;
      card.style.display = (type === "all" || name.endsWith(`.${type}`)) ? "" : "none";
    });
  });

  // 📤 AJAX Upload
  const form = document.getElementById("uploadForm");
  const btn = document.getElementById("uploadBtn");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    btn.disabled = true;
    btn.textContent = "Uploading... ⏳";

    const formData = new FormData(form);
    try {
      const res = await fetch("upload.php", { method: "POST", body: formData });
      const data = await res.json();
      alert(data.message);
      if (data.status === "success") location.reload();
    } catch (err) {
      alert("⚠️ Upload failed: invalid response.");
      console.error(err);
    } finally {
      btn.disabled = false;
      btn.textContent = "⬆️ Upload File";
    }
  });
});
