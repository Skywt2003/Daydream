<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<h1 style="margin-bottom: 0;">404 Not Found.</h1>

<blockquote id="hitokoto">虚无。</blockquote>
<script>
	fetch('https://v1.hitokoto.cn')
		.then(response => response.json())
		.then(data => {
			const hitokoto = document.getElementById('hitokoto')
			hitokoto.innerHTML = "<bold>" + data.hitokoto + "</bold>" + "<br><footer style='text-align: right'>——" + data.from + "</footer>"
		})
		.catch(console.error)
</script>
<a href="<?php $this->options->siteUrl();?>">返回首页</a>

<?php $this->need('footer.php'); ?>
