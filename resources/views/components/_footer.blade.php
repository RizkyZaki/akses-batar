<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span
          id="currentYear"></span
        > {{appSetting()->footer_text}}
      </div>
    </div>
  </footer>
  <!-- End of Footer -->
  <script>
    // Mendapatkan elemen dengan id 'currentYear'
    var currentYearElement = document.getElementById('currentYear');
    // Mendapatkan tahun saat ini
    var currentYear = new Date().getFullYear();
    // Menampilkan tahun saat ini di elemen tersebut
    currentYearElement.innerHTML = 'Copyright &copy;' + currentYear;
</script>
