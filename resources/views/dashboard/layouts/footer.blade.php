<!--  Import Js Files -->
<script src="{{ asset('dashboard_assets/dist/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<!--  core files -->
<script src="{{ asset('dashboard_assets/dist/js/app.min.js') }}"></script>
<!-- <script src="{{ asset('dashboard_assets/dist/js/app.init.js') }}"></script> -->
<script src="{{ asset('dashboard_assets/dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('dashboard_assets/dist/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dashboard_assets/dist/js/custom.js') }}"></script>
<!--  current page js files -->
<!-- <script src="{{ asset('dashboard_assets/dist/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script> -->
<script src="{{ asset('dashboard_assets/dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('dashboard_assets/dist/js/dashboard.js') }}"></script>

{{-- cdn --}}
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>


<script>
    $(document).ready(function() {
        function calculateMD5Hash(username, developmentKey) {
            var message = username + developmentKey + 'depo';
            return CryptoJS.MD5(message).toString();
        }

        function postDataToAPI() {
            var username = '{{ env('DIGIFLAZZ_USERNAME') }}';
            var developmentKey = '{{ env('DIGIFLAZZ_DEVELOPMENT_KEY') }}';

            var hash = calculateMD5Hash(username, developmentKey);

            var postData = {
                "cmd": "deposit",
                "username": username,
                "sign": hash
            };

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '/digi-flazz/cek-saldo',
                type: 'POST',
                contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: JSON.stringify(postData),
                success: function(response) {
                    $('#saldoDigiFlazz').html(formatRupiah(response.data.deposit));
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return ribuan;
        }

        postDataToAPI();
    });
</script>
