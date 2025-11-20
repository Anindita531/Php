// Add JS functionality here if needed
console.log("Bug Tracker Lite JS loaded");
document.addEventListener("DOMContentLoaded", () => {
    const btn = document.createElement("button");
    btn.textContent = "Toggle Dark Mode";
    btn.className = "dark-mode-toggle";
    document.querySelector(".navbar").appendChild(btn);

    btn.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");
        localStorage.setItem("darkMode", document.body.classList.contains("dark-mode"));
    });

    if(localStorage.getItem("darkMode") === "true"){
        document.body.classList.add("dark-mode");
    }
});
