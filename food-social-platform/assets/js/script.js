function shareRecipe() {
    const recipeUrl = window.location.href;

    if (navigator.share) {
        // Mobile native share
        navigator.share({
            title: 'Check out this recipe!',
            url: recipeUrl
        }).then(() => {
            alert('Thanks for sharing!');
        }).catch(err => console.error(err));
    } else {
        // Desktop fallback: copy URL
        navigator.clipboard.writeText(recipeUrl).then(() => {
            alert('Recipe URL copied to clipboard!');
        }).catch(err => {
            alert('Could not copy URL. Please copy manually: ' + recipeUrl);
        });
    }
}