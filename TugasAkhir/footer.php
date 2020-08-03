<style>
  body{
    display: flex;
    min-height: 100vh;
    flex-direction: column;
  }
  main {
    flex: 1 0 auto;
  }
</style>
    <!-- FOOTER -->
    <footer class="page-footer blue darken-4">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Sistem Informasi</h5>
                <p class="grey-text text-lighten-4">Penggajian Karyawan Mini Market</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Kontak</h5>
                <ul>
                  <li>Email &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <a class="grey-text text-lighten-3" href="www.gmail.com" target="_blank">juliarianto0202@gmail.com</a></li>
                  <li>Instagram &nbsp: <a class="grey-text text-lighten-3" href="www.instagram.com/juliarianto0" target="_blank">juliarianto0</a></li>
                  <li>Facebook &nbsp&nbsp: <a class="grey-text text-lighten-3" href="www.facebook.com/juli.arianto.50" target="_blank">Juli Arianto</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2020 Copyright SI Penggajian
            <a class="grey-text text-lighten-4 right" href="www.github.com/juliarianto">My Github</a>
            </div>
          </div>
        </footer>
    <!-- END FOOTER -->


    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="assets/js/materialize.min.js"></script>

    <script>
      const sideNav = document.querySelectorAll('.sidenav');
      M.Sidenav.init(sideNav);

      const slider = document.querySelectorAll('.slider');
      M.Slider.init(slider, {
        indicators: false,
        height: 500,
        transition: 600,
        interval: 5000
      });

      const parallax = document.querySelectorAll('.parallax');
      M.Parallax.init(parallax);

      const materialbox = document.querySelectorAll('.materialboxed');
      M.Materialbox.init(materialbox);

      const scroll = document.querySelectorAll('.scrollspy');
      M.ScrollSpy.init(scroll, {
        scrollOffset: 50
      });

      const drop = document.querySelectorAll('.dropdown-trigger');
      M.Dropdown.init(drop);
    </script>
  </body>

</html>