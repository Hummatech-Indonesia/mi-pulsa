<script>
    function formatCurrency(input) {
    // Hapus semua karakter yang bukan digit atau titik desimal
    let value = input.replace(/[^\d.]/g, '');

    // Pisahkan menjadi bagian sebelum dan sesudah titik desimal
    let parts = value.split('.');
    let integerPart = parts[0];
    let decimalPart = parts.length > 1 ? '.' + parts[1].substring(0, 2) : '';

    // Tambahkan koma sebagai pemisah ribuan
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

    // Gabungkan kembali bagian integer dan desimal
    return integerPart + decimalPart;
}
</script>