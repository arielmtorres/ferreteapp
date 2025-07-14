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

<!-- Tus scripts que dependen de Chart.js -->
<script src="js/ferreteapp.js"></script>
<script src="components/reportes/assets/script.js"></script>
<script src="components/ventas/ventas.js"></script>
<script src="components/ventas/nueva/ventas-nueva.js"></script>
<script src="components/ventas/imprimir/imprimir.js"></script>



</body>
</html>
