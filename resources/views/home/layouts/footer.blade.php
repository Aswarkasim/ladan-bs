

<!-- FOOTER -->
<footer class="footer mt-5 py-3 bg-light">
  <div class="container">
    <a href="https://www.vecteezy.com/free-vector/isometric">Isometric Vectors by Vecteezy</a>
    <span class="text-muted">Place sticky footer content here.</span>
  </div>
</footer>





    </main>


<!-- Bootstrap 4 -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/vendor/sweetalert/sweetalert2.all.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  AOS.init();
</script>

<script>
    // Tommbol hapus
  $('.tombol-hapus').on('click', function (e) {
    // Mematikan href
    e.preventDefault();
    // const href = $(this).attr('href');
    // const action = $(this).attr('action');

    let id = $(this).data('id');

    Swal({
      title: 'Apakah anda yakin ingin menghapus?',
      text: "data akan dihapus",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus Data!'
    }).then((result) => {
      if (result.value) {
        // document.location.href = href;
        // document.location.action = action;
        // document.getElementById("#delete").setValue('Adakah');
        // console.log(result);
        $('#form-delete').submit();
      }
    })
})
</script>


</body>
</html>
