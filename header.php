<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php $this->archiveTitle(array(
            'category'  =>  '分类 %s 下的文章',
            'search'    =>  '包含关键字 %s 的文章',
            'tag'       =>  '标签 %s 下的文章',
            'author'    =>  '%s 发布的文章'
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <link rel="apple-touch-icon" href="<?php $this->options->logoUrl() ?>">
    <link rel="shortcut icon" href="<?php $this->options->themeUrl('/assets/favicon.ico')?>" />
    <link rel="bookmark" href="<?php $this->options->themeUrl('/assets/favicon.ico')?>" type="image/x-icon"/>

	<!-- Pico.css -->
	<link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/css/pico.min.css');?>">
    <!-- Daydream CSS -->
    <link type="text/css" href="<?php $this->options->themeUrl('/assets/css/style.css')?>" rel="stylesheet">
    <!-- Animate.css -->
    <link type="text/css" href="<?php $this->options->themeUrl('/assets/css/animate.min.css')?>" rel="stylesheet">
    <!-- Fancybox.css -->
    <link type="text/css" href="<?php $this->options->themeUrl('/assets/css/jquery.fancybox.min.css')?>" rel="stylesheet">
    <!-- KaTeX.css -->
    <link type="text/css" href="<?php $this->options->themeUrl('/assets/css/katex.min.css')?>" rel="stylesheet">
    <!-- Highlight.js CSS -->
    <link type="text/css" href="<?php $this->options->themeUrl('/assets/css/atom-one-dark.min.css')?>" rel="stylesheet">
    <!-- Caomei Icons CSS -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('/assets/css/caomei.css')?>">
    <!-- Google Fonts -->
    <link href="https://fonts.loli.net/css2?family=Noto+Serif+SC:wght@200;300;400;500;600;700;900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style><?php $this->options->cutsomCSS(); ?></style>

    <!-- jQuery.js -->
    <script src="<?php $this->options->themeUrl('/assets/js/jquery.min.js');?>"></script>
    <!-- jQuery.pjax.js -->
    <script src="<?php $this->options->themeUrl('/assets/js/jquery.pjax.js');?>"></script>
    <!-- Highlight.js -->
    <script src="<?php $this->options->themeUrl('/assets/js/highlight.min.js');?>"></script>
    <!-- Fancybox.js -->
    <script src="<?php $this->options->themeUrl('/assets/js/jquery.fancybox.min.js');?>"></script>
    <!-- KaTeX.js -->
    <script src="<?php $this->options->themeUrl('/assets/js/katex/katex.min.js');?>"></script>
    <script src="<?php $this->options->themeUrl('/assets/js/katex/auto-render.min.js');?>"></script>

    <?php $this->options->headerCode(); ?>

    <?php $this->header(); ?>
</head>
<!--[if lt IE 8]>
    当前网页不支持你正在使用的浏览器。为了正常访问, 请升级你的浏览器！
<![endif]-->
<body>

<header class="container">
    <img class="headpic shadow" src="<?php $this->options->logoUrl()?>" alt="<?php $this->options->title() ?>" width=128 height=128>
    <hgroup>
        <h1><?php $this->options->title()?></h1>
        <h4><?php $this->options->description()?></h4>
    </hgroup>
</header>

<nav class="navbar">
    <ul>
        <?php if ($this->options->realHomepage): ?>
            <li><a href="<?php $this->options->realHomepage();?>"><i class="czs-home"></i> 首页 </a></li>
        <?php endif; ?>
        <?php if (strpos($this->options->frontPage, 'file') !== FALSE):?>
            <li>
                <a class="<?php echo ($this->is('index'))?'active':'';?>" href="<?php $this->options->siteUrl();?>"><i class="czs-home"></i> 首页 </a>
            </li>
            <li>
                <a class="<?php echo ($this->is('archive'))?'active':'';?>" href="<?php echo $this->options->siteUrl.$this->options->routingTable['archive']['url']; ?>"><i class="czs-book"></i> 文章 </a>
            </li>
        <?php else: ?>
            <li>
                <a class="<?php echo ($this->is('index'))?'active':'';?>" href="<?php $this->options->siteUrl();?>"><i class="czs-paper"></i> 博客 </a>
            </li>
        <?php endif; ?>
        <?php $this->widget('Widget_Contents_Page_List')->to($pagelist); ?>
        <?php while ($pagelist->next()): ?>
            <li>
                <a class="<?php echo ($this->is('page', $pagelist->slug))?'active':'';?>" href="<?php echo $pagelist->permalink; ?>">
                    <?php if ($pagelist->fields->pageIcon != ''): ?>
                        <i class="<?php echo $pagelist->fields->pageIcon; ?>"></i>
                    <?php endif; ?>
                    <?php echo $pagelist->title; ?>
                </a>
            </li>
        <?php endwhile;?>
    </ul>
</nav>

<!-- Add shadow for navbar when fixed. -->
<script>
    const stickyElm = document.querySelector('.navbar')
    const observer = new IntersectionObserver( 
      ([e]) => e.target.classList.toggle('shadow', e.intersectionRatio < 1),
      {threshold: [1]}
    );
    observer.observe(stickyElm);
</script>

<main class="container" id="pjax-container">