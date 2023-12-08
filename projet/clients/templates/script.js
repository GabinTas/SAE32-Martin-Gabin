document.addEventListener('DOMContentLoaded', function () {
    var items = document.querySelectorAll('.item');

    items.forEach(function (item) {
        var detailsButton = item.querySelector('.details-button');
        var deliverButton = item.querySelector('.deliver-button');
        var details = item.querySelector('.details');

        detailsButton.addEventListener('click', function () {
            // Toggle visibility of details when the button is clicked
            details.style.display = details.style.display === 'none' ? 'block' : 'none';
        });

        deliverButton.addEventListener('click', function () {
            // Add your delivery action here
            alert('Colis livré!');
        });
    });
});
