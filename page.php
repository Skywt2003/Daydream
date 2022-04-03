<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<?php if ($this->fields->linkTo): ?>
    <script type='text/javascript'>window.location.href = '<?php echo $this->fields->linkTo ?>';</script>
<?php endif; ?>

<h1><?php $this->title(); ?></h1>
<hr>
<div class="post-content">
    <?php echo exContent($this->content); ?>
</div>

<?php $this->need('comments.php'); ?>

<?php $this->need('footer.php'); ?>
