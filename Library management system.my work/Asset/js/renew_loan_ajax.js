document.addEventListener("DOMContentLoaded", function () {
    const renewButtons = document.querySelectorAll(".renew-btn");

    renewButtons.forEach(button => {
        button.addEventListener("click", function () {
            const loanId = this.dataset.id;
            const row = document.getElementById("loan-" + loanId);
            const dueDateCell = row.querySelector(".due-date");
            const statusCell = row.querySelector(".status");

            const confirmRenew = confirm("Are you sure you want to renew this loan for 7 more days?");
            if (!confirmRenew) return;

            this.disabled = true;
            this.textContent = "Renewing...";

            fetch("../Controller/renew_loan_ajax.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "loan_id=" + encodeURIComponent(loanId)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    dueDateCell.textContent = data.new_due_date;
                    this.textContent = "Renewed";
                    this.style.backgroundColor = "#6c757d";
                    this.disabled = true;
                } else {
                    alert("Renewal failed: " + data.message);
                    this.textContent = "Renew";
                    this.disabled = false;
                }
            })
            .catch(() => {
                alert("Error processing request.");
                this.textContent = "Renew";
                this.disabled = false;
            });
        });
    });
});
