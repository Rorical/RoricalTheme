<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div style="text-align:center">
    Copyright ©  <?php echo date('Y'); ?> Boxpaper. All Rights Reserved.  <a href="https://blog.boxpaper.club/">Rorical</a>版权所有<br>
    <?php _e('由 <a href="http://www.typecho.org">Typecho</a> 强力驱动'); ?>.
</div>

<?php $this->footer(); ?>
<script src="<?php $this->options->themeUrl('./assets/vendor/popper/popper.min.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('./assets/vendor/bootstrap/bootstrap.min.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('./assets/vendor/headroom/headroom.min.js'); ?>"></script>
  <!-- Optional JS -->
  <script src="<?php $this->options->themeUrl('./assets/vendor/onscreen/onscreen.min.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('./assets/vendor/nouislider/js/nouislider.min.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('./assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js'); ?>"></script>
  <!-- Argon JS -->
  <script src="<?php $this->options->themeUrl('./assets/js/argon.js?v=1.0.0'); ?>"></script>

  <script type="text/javascript">
		$(function() {
      $("img").lazyload({effect: "fadeIn", threshold :700});
  });
</script>
</body>
</html>
