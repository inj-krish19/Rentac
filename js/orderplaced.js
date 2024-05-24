
window.onload = function () {
    var message = document.getElementById('orderMessageWrapper');
    // Add inline styles to trigger the transition
    setTimeout(function () {
        message.style.opacity = '1';
        message.style.transform = 'translateY(0)';

        setTimeout(function () {
            window.location.href = "../scripts/product.php";
        }, 3000);

    }, 1500); // Delay to ensure the transition applies
};