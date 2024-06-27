function redirectToSearch() {
    const searchValue = document.getElementById('searchInput').value;
    const url = `../scripts/product.php?search=${searchValue}`;
    window.location.href = url;
}