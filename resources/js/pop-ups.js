document.addEventListener("DOMContentLoaded", (event) => {
    const closeButtons = document.querySelectorAll("[data-dismiss-target]");

    closeButtons.forEach((closeButton) => {
        const targetId = closeButton.getAttribute("data-dismiss-target");
        const targetElement = document.querySelector(targetId);

        closeButton.addEventListener("click", () => {
            targetElement.style.display = "none";
        });

        setTimeout(() => {
            targetElement.style.display = "none";
        }, 5000);
    });
});
