<?php
/**
 * Daydream 是一个简洁轻盈的 Typecho 主题。
 * 
 * @package Daydream
 * @author SkyWT
 * @version 1.0
 * @link https://blog.skywt.cn/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
    $this->need('header.php');
?>

<?php if ($this->options->notification !=''): ?>
    <div class="alert">
        <?php $this->options->notification(); ?>
    </div>
<?php endif; ?>

<?php while ($this->next()): ?>
    <section itemscope itemtype="http://schema.org/BlogPosting">
        <?php if ($this->fields->headPic !=''): ?>
            <a data-fancybox="gallery" href="<?php $this->fields->headPic(); ?>" data-caption="<?php $this->title(); ?>">
                <img src=<?php $this->fields->headPic();?> class="shadow rounded" alt="<?php $this->title(); ?>" title="<?php $this->title(); ?>">
            </a>
        <?php endif; ?>
        <a itemprop="url" href="<?php $this->permalink();?>">
            <h1 itemprop="name headline"><?php $this->title();?></h1>
        </a>
        <div class="summary" itemprop="articleBody">
    		<?php $this->content('More...'); ?>
        </div>
    </section>
    <hr>
<?php endwhile; ?>

<nav>
    <?php $this->pageNav('&laquo;', '&raquo;', 3, '...', array(
        'wrapTag' => 'ul',
        'wrapClass' => '',
        'itemTag' => 'li',
        'currentClass' => 'active',
    )); ?>
</nav>

<?php $this->need('footer.php'); ?>
