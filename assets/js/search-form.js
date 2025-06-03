document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("searchForm").addEventListener("submit", function (e) {
        let errors = [];

        // const input = document.getElementById('who');
        // input.addEventListener('input', () => {
        // if (input.value < 1) input.value = '';
        // });

        const destination = document.getElementById("where");
        const checkIn = document.getElementById("check-in");
        const checkOut = document.getElementById("check-out");
        const guests = document.getElementById("who");

        // Validatie
        if (destination.value.trim() === "") {
            errors.push("Please enter a destination.");
        }

        if (checkIn.value === "") {
            errors.push("Please select a check-in date.");
        }

        if (checkOut.value === "") {
            errors.push("Please select a check-out date.");
        }

        if (guests.value === "" || parseInt(guests.value) <= 0) {
            errors.push("Please enter a valid number of guests.");
        }

        if (errors.length > 0) {
            e.preventDefault(); // Formulier wordt niet verzonden
            alert(errors.join("\n")); // Toon foutmeldingen
        }
    });
});
