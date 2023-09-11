const forms = document.querySelectorAll(".delete-form");

forms.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
        const title = form.dataset.title;
        const isConfirmed = confirm(`Sei sicuro di voler cacellare ${title}`);
        if (isConfirmed) form.submit();
    });
});
