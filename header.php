<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('%s下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <!-- Analytics -->
    <?php $this->options->Analytic() ?>
	
    <script src="<?php $this->options->themeUrl('./assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('./assets/js/jquery.pjax.js'); ?>"></script>
    
    <link href="<?php $this->options->logoUrl() ?>" rel="icon" type="image/png" />
    <!-- Fonts -->
    <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">-->
    <!-- Icons -->
    <link href="<?php $this->options->themeUrl('./assets/vendor/nucleo/css/nucleo.css'); ?>" rel="stylesheet" />
    <link href="<?php $this->options->themeUrl('./assets/vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" />
    <!-- Argon CSS -->
    <link type="text/css" href="<?php $this->options->themeUrl('./assets/css/argon.css?v=1.0.0'); ?>" rel="stylesheet" />
    <!-- Docs CSS -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('./assets/css/index.css'); ?>" />
    <link rel="stylesheet" href="<?php $this->options->themeUrl('./assets/css/style.css'); ?>" />
    <link rel="stylesheet" href="<?php $this->options->themeUrl('./assets/css/csshake.min.css'); ?>" />
    <link rel="stylesheet" href="<?php $this->options->themeUrl('./assets/css/viewer.min.css'); ?>" />
    <link href="<?php $this->options->themeUrl('./assets/css/font.css'); ?>" rel="stylesheet" />
    <script src="<?php $this->options->themeUrl('./assets/js/lazyload.js'); ?>" charset="utf-8"></script>
    <script src="<?php $this->options->themeUrl('./assets/js/functions.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('./assets/js/md5.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('./assets/js/viewer.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('./assets/js/jquery-viewer.min.js'); ?>"></script>
    <!--[if lt IE 9]>
    <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<link rel="stylesheet" href="<?php $this->options->themeUrl('./assets/css/okaikia.css'); ?>" />
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>
<body>

<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->

<header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light">
      <div class="container">
        <?php if ($this->options->logoUrl): ?>
<a id="logo" href="<?php $this->options->siteUrl(); ?>" class="navbar-brand mr-lg-5">
  <img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>">
</a>
<?php else: ?>
<a id="logo" class="text-white" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a>
<?php endif; ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-6 collapse-brand">
              <?php if ($this->options->logoUrl): ?>
<a id="logo" href="<?php $this->options->siteUrl(); ?>">
  <img src="<?php $this->options->logoUrl() ?>" alt="<?php $this->options->title() ?>">
</a>
<?php else: ?>
<a id="logo" href="<?php $this->options->siteUrl(); ?>" class="display-3"><?php $this->options->title() ?></a>
<?php endif; ?>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
          	<?php if($this->options->navbar=="able"): ?>
            <li class="nav-item dropdown">
            	
              <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                <i class="ni ni-ui-04 d-lg-none"></i>
                <span class="nav-link-inner--text">页面</span>
              </a>
              <div class="dropdown-menu dropdown-menu-xl">
                <div class="dropdown-menu-inner">
                	<a href="<?php $this->options->siteUrl(); ?>"   class="media d-flex align-items-center">
                    <div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
            <i class="ni ni-spaceship"></i>
                    </div>
                    <div class="media-body ml-3">
                      <h6 class="heading text-primary mb-md-1">主页</h6><!--<?php if($this->is('index')): ?>text-danger<?php else: ?>text-primary<?php endif; ?>-->
                    </div>
            </a>
            
            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            <?php while($pages->next()): ?>
            <a href="<?php $pages->permalink(); ?>"   class="media d-flex align-items-center">
                    <div class="icon icon-shape <? echo(isset($pages->fields->color) ? "":$pages->fields->color)?> rounded-circle text-white ">
            <i class="ni <? echo(isset($pages->fields->icon) ? "":$pages->fields->icon)?>"></i>
                    </div>
                    <div class="media-body ml-3">
                      <h6 class="heading text-primary mb-md-1"><?php $pages->title(); ?></h6><!--<?php if($this->is('page', $pages->slug)): ?>text-danger<?php else: ?>text-primary<?php endif; ?>-->
                    </div>
            </a>
            <?php endwhile; ?>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link" data-toggle="dropdown" role="button">
                <i class="ni ni-collection d-lg-none"></i>
                <span class="nav-link-inner--text">分类</span>
              </a>
              <div class="dropdown-menu">
              <?php $this->widget('Widget_Metas_Category_List')->to($category); ?>
                <?php while($category->next()): ?>
                    <a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>" class="dropdown-item <?php if($this->is('category', $category->slug)): ?>current<?php endif; ?>"><?php $category->name(); ?></a>                
                <?php endwhile; ?>
  
              </div>
            </li>
            <?php else: ?>
            	<li class="nav-item">
            		<a href="<?php $this->options->siteUrl(); ?>" class="nav-link">
                		<span class="nav-link-inner--text">主页</span>
            		</a>
            	</li>
            	<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
            	<?php while($pages->next()): ?>
            		<li class="nav-item">
            			<a href="<?php $pages->permalink(); ?>" class="nav-link">
                			<span class="nav-link-inner--text"><?php $pages->title(); ?></span>
            			</a>
            		</li>
            	<?php endwhile; ?>
            <?php endif; ?>
            
          </ul>
          <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          	<?php $icons = explode("\n",$this->options->navbarIcons) ?>
          	<? for($i=0;$i<count($icons);$i++): ?>
          	<? $icon = explode("$$",$icons[$i]) ?>
          	<li class="nav-item d-none d-lg-block ml-lg-4">
          		<a class="nav-link nav-link-icon" href="<?php echo $icon[2]; ?>" target="_blank" data-toggle="tooltip" title="" data-original-title="<? echo $icon[1]; ?>">
                <i class="<? echo $icon[0]; ?>"></i>
                <span class="nav-link-inner--text d-lg-none"><? echo $icon[1]; ?></span>
              </a>
          	</li>
        	<?php endfor; ?>
            
            <li class="nav-item d-none d-lg-block ml-lg-4">
              <a no-pjax class="nav-link nav-link-icon" href="<?php $this->options->feedUrl(); ?>" target="_blank" data-toggle="tooltip" title="" data-original-title="文章RSS">
                <i class="fa fa-rss"></i>
                <span class="nav-link-inner--text d-lg-none">RSS</span>
              </a>
            </li>
            <li class="nav-item d-none d-lg-block ml-lg-4">
              <a no-pjax class="nav-link nav-link-icon" href="<?php $this->options->commentsFeedUrl(); ?>" target="_blank" data-toggle="tooltip" title="" data-original-title="评论RSS">
                <i class="fa fa-rss-square"></i>
                <span class="nav-link-inner--text d-lg-none">RSS</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    </header>
<div id="main">
<style>
	:root{
		--main-bg-image: url( <?php if($this->is('page') or $this->is('post')){ echo($this->fields->pic ? $this->fields->pic:$this->options->randompicUrl() . "?_=" . mt_rand());}else{echo($this->options->pcbackgroundUrl());} ?>) center center / cover no-repeat fixed;
    
    	--phone-bg-image: url(<?php if($this->is('page') or $this->is('post')){ echo($this->fields->pic ? $this->fields->pic:$this->options->randompicUrl() . "?_=" . mt_rand());}else{echo($this->options->mobilebackgroundUrl());} ?>) center center / cover no-repeat fixed;
	}
    .banner::before{background-image: url(<?php $this->options->themeUrl('./assets/css/ground.png'); ?>);}
    .shape-background{
    	background: var(--main-bg-image);
    	height: 100%; width: 100%; overflow: hidden;
    }
    @media(max-width: 678px){
    	.shape-background{background: var(--phone-bg-image);}
    	
    }
</style>