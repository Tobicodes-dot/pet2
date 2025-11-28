document.getElementById("adoptionForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    fetch("./submit_form.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            form.style.display = "none";
            document.getElementById("successMessage").style.display = "block";
        } else {
            alert("Submission error: " + data.message);
        }
    })
});

