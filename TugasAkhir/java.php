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

      const option = document.querySelectorAll('select');
      M.FormSelect.init(option);
                    
    </script>
  </body>

</html>