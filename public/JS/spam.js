        document.addEventListener('DOMContentLoaded', function () {
            var formSubmitted = false;
    
            document.getElementById('submitButton').addEventListener('click', function (event) {
                if (formSubmitted) {
                    event.preventDefault(); // Prevents form submission if already submitted
                } else {
                    formSubmitted = true;
                }
            });
        });
