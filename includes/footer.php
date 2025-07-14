  </div> <!-- /.container -->
  <!-- Scripts bootstrap -->
  <script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelector('.menu-toggle').addEventListener('click', () => {
      document.getElementById('userMenu').classList.toggle('open');
    });
  </script>

  
<!-- Chart.js PRIMERO -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>

<!-- Tus scripts que dependen de Chart.js -->
<script src="js/ferreteapp.js"></script>
<script src="components/reportes/assets/script.js"></script>
<script src="components/productos/assets/script.js"></script>

</body>
</html>
