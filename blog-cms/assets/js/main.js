// assets/js/main.js

document.addEventListener("DOMContentLoaded", () => {
    
    // ===== 1️⃣ Alert welcome message =====
    console.log("main.js loaded successfully");
    // alert("Welcome to Blog CMS!");

    // ===== 2️⃣ AJAX Comment Submission =====
    const commentForm = document.querySelector("form[action='add_comment.php']");
    if(commentForm){
        commentForm.addEventListener("submit", (e) => {
            e.preventDefault(); // prevent page reload

            const postData = new FormData(commentForm);

            fetch("add_comment.php", {
                method: "POST",
                body: postData
            })
            .then(res => res.text())
            .then(() => {
                // reload the page to show new comment
                location.reload();
            })
            .catch(err => console.error("Comment Error:", err));
        });
    }

    // ===== 3️⃣ Live Search (index & search page) =====
    const searchInput = document.querySelector("input[name='q']");
if(searchInput){
    searchInput.addEventListener("keyup", () => {
        const query = searchInput.value.trim();
        const resultsDiv = document.querySelector("#search-results");

        if(query.length > 0){
            fetch(`search_ajax.php?q=${encodeURIComponent(query)}`)
                .then(res => res.text())
                .then(html => {
                    if(resultsDiv) resultsDiv.innerHTML = html;
                })
                .catch(err => console.error("Search Error:", err));
        } else {
            if(resultsDiv) resultsDiv.innerHTML = "";
        }
    });

    }

    // ===== 4️⃣ Toggle Post Content (View more/less) =====
    const toggleButtons = document.querySelectorAll(".toggle-content");
    toggleButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const postId = btn.dataset.postId;
            const postContent = document.querySelector(`#post-content-${postId}`);
            if(postContent){
                postContent.classList.toggle("expanded");
                btn.textContent = postContent.classList.contains("expanded") ? "Show Less" : "Read More";
            }
        });
    });

});
