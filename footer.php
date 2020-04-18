<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</div>

<footer class="footer shadow bg-white">
	<div class="container align-items-center justify-content-md-between">
		<div class="row">
    		<div class="col-md-6">
    			Copyright ©  <?php echo date('Y'); ?> <?php $this->options->title() ?>.
    		</div>
    		<div class="col-md-6">
            <ul class="nav nav-footer justify-content-end">
				<li class="nav-item">
					<a class="nav-link" href="<?php $this->options->siteUrl(); ?>">主页</a>
				</li>
				<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            	<?php while($pages->next()): ?>
            		<li class="nav-item">
						<a class="nav-link" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a>
					</li>
            	<?php endwhile; ?>
            </ul>
    		</div>
		</div>
	</div>
</footer>
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
  <script type="text/javascript"
    src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
	</script>
  <script type="text/javascript">
	let isMathjaxConfig = false; // 防止重复调用Config，造成性能损耗

	const initMathjaxConfig = () => {
	if (!window.MathJax) {
    	return;
	}
	window.MathJax.Hub.Config({
    	showProcessingMessages: false, //关闭js加载过程信息
    	messageStyle: "none", //不显示信息
    	jax: ["input/TeX", "output/HTML-CSS"],
    	tex2jax: {
    		inlineMath: [["$", "$"], ["\\(", "\\)"]], //行内公式选择符
    		displayMath: [["$$", "$$"], ["\\[", "\\]"]], //段内公式选择符
    		skipTags: ["script", "noscript", "style", "textarea", "pre", "code", "a"] //避开某些标签
    	},
    	"HTML-CSS": {
    	availableFonts: ["STIX", "TeX"], //可选字体
    		showMathMenu: false //关闭右击菜单显示
    	}
		});
		isMathjaxConfig = true; // 
		};
  function init(){
  	var pres = document.querySelectorAll('pre');
	var lineNumberClassName = 'line-numbers';
	pres.forEach(function (item, index) {
		item.className = item.className == '' ? lineNumberClassName : item.className + ' ' + lineNumberClassName;
	})
  	Prism.highlightAll(true, null);
	
	
	if(typeof emojify != "undefined") {
    	emojify.run();
	}
	
	
	if (isMathjaxConfig === false) { // 如果：没有配置MathJax
		initMathjaxConfig();
	}
	try{
		window.MathJax.Hub.Queue(["Typeset", MathJax.Hub, document.getElementById('main')]);
		window.onload()
	}catch{
		
	}
	
  }
</script>
	<script src="<?php $this->options->themeUrl('./assets/js/prism.js'); ?>"></script>
	<script src="<?php $this->options->themeUrl('./assets/js/clipboard.min.js'); ?>"></script>
  <script type="text/javascript">
  show()
  $('img[data-original]:not(img[no-viewer])').viewer({
			url: 'data-original'
		});
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
			var viewer = $('img[data-original]:not(img[no-viewer])').data('viewer');
			if(viewer){
				viewer.destroy()
			}
			
			show()
		}).on('pjax:complete',
		function() {
			$("img").lazyload({effect: "fadeIn", threshold :700});
			setTimeout(() => {
				$('img[data-original]:not(img[no-viewer])').viewer({
					url: 'data-original'
				});
			},300)
			
    		if(page==1){
    			$("#navbar-main").addClass("bg-info alpha-4")
    		}else{
    			$("#navbar-main").removeClass("bg-info alpha-4")
    		}
    		init()
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
			$("img").lazyload({effect: "fadeIn", threshold :700});
    		hide()
		})
				}
			}
			return false;
		});
		init()
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
<?php if($this->options->powermode=="able"): ?>
<script src="<?php $this->options->themeUrl('./assets/js/activate-power-mode.js'); ?>"></script>
<script>
$(document).ready(function(){
	POWERMODE.colorful = true; // make power mode colorful
	POWERMODE.shake = false; // turn off shake
	document.body.addEventListener('input', POWERMODE);
});
</script>
<?php endif; ?>

<?php if($this->options->clickanime=="able"): ?>
<canvas id="clickcanvas"></canvas>
<script src="<?php $this->options->themeUrl('./assets/js/click.js'); ?>"></script>
<?php endif; ?>

<a href="javascript:$('html,body').animate({ scrollTop: 0}, 500)"><button id="upbtn" class="btn btn-icon-only rounded-circle btn-info up-btn">
	<span class="btn-inner--icon"><i class="ni ni-bold-up" aria-hidden="true"></i></span>
</button></a>
<script>
$(window).scroll(function(){
	if($(window).scrollTop()>=500){
		if(!$("#upbtn").is(".upbtn-show")){
			$("#upbtn").addClass("upbtn-show");
		}
	}else{
		if($("#upbtn").is(".upbtn-show")){
			$("#upbtn").removeClass("upbtn-show");
		}
	}
});
</script>
</body>

</html>
