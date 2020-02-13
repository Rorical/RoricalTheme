<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</div>

<div style="text-align:center">
    Copyright ©  <?php echo date('Y'); ?> Boxpaper. Theme <a href="https://blog.boxpaper.club/">Rorical</a> by <a href="https://www.boxpaper.club/">boxpaper</a> <br>
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
  show()
  $(document).ready(function(){ 
	hide()
	});
	$(function() {
		
		var header = document.querySelector("#navbar-main");
            var headroom = new Headroom(header, {
                tolerance: 5,
                offset: 210
            });
            headroom.init();
        if(page==1){
    			$("#navbar-main").addClass("bg-info alpha-4")
    		}else{
    			$("#navbar-main").removeClass("bg-info alpha-4")
    		}
      $("img").lazyload({effect: "fadeIn", threshold :700});
      $(document).pjax('a[href^="<?php Helper::options()->siteUrl()?>"]:not(a[target="_blank"], a[no-pjax])',
		{
    		container: '#main',
    		fragment: '#main',
    		timeout: 8000
		}).on('pjax:send', function() {
			show()
		}).on('pjax:complete',
		function() {
			$("img").lazyload({effect: "fadeIn", threshold :700});
    		if(page==1){
    			$("#navbar-main").addClass("bg-info alpha-4")
    		}else{
    			$("#navbar-main").removeClass("bg-info alpha-4")
    		}
    		hide()
		})
		$("#search").submit(function() {
			var att = $(this).serializeArray()
			for(var i in att){
				if(att[i].name=="s"){
					$.pjax({url: "<?php $this->options->siteUrl(); ?>search/"+att[i].value+"/", container: '#main',fragment: '#main',timeout:8000}).on('pjax:send', function() {
			show()
		}).on('pjax:complete',
		function() {
    		hide()
		})
				}
			}
			return false;
		});
		
	});
	
</script>
	<div class="loading blur-item" id="loading" style="display: none;">
	<div class="spinner-box center ">
  		<div class="pulse-container">  
    		<div class="pulse-bubble pulse-bubble-1"></div>
    		<div class="pulse-bubble pulse-bubble-2"></div>
    		<div class="pulse-bubble pulse-bubble-3"></div>
  		</div>
	</div>
</div>
</body>

</html>
