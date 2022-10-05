<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<script>
    hljs.highlightAll();
    $(document).ready(function(){
        $("main .post-content img").addClass("img-fluid shadow rounded");
        $("main blockquote").addClass("shadow rounded");
        $("main pre").addClass("shadow rounded");
        $(".aplayer").addClass("shadow rounded");
    });
    /*
     * Fancybox settings
     * https://web.archive.org/web/20210325170940/https://fancyapps.com/fancybox/3/docs
     */
    $('[data-fancybox="gallery"]').fancybox({
        buttons: ["zoom", "slideShow", "fullScreen", "download", "thumbs", "close"],
        clickContent: function(current, event) {
            return "close";
        }
    });
    renderMathInElement(
        document.body,
        {
            delimiters: [
                {left: "$$", right: "$$", display: true},
                {left: "$", right: "$", display: false},
            ]
        }
    );
</script>

</main>

<script>
    $(document).pjax('a[href^="<?php $this->options->siteUrl()?>"]:not(a[target="_blank"])', {
        container: '#pjax-container',
        fragment: '#pjax-container'
    });
    $(document).on('pjax:send',function() {
        // alert('开始加载');
    });
    $(document).on('pjax:complete', function() {   
        // alert('加载完成');
        // Aplayer 插件代码
        var len = APlayerOptions.length;
        for(var i=0;i<len;i++){
            APlayers[i] = new APlayer({
                element: document.getElementById('player' + APlayerOptions[i]['id']),
                narrow: false,
                preload: APlayerOptions[i]['preload'],
                mutex: APlayerOptions[i]['mutex'],
                autoplay: APlayerOptions[i]['autoplay'],
                showlrc: APlayerOptions[i]['showlrc'],
                music: APlayerOptions[i]['music'],
                theme: APlayerOptions[i]['theme']
            });
            APlayers[i].init();
        }
    });
</script>

<footer>
    <div class="container">
        <hr>
        <p>
            <?php if ($this->options->nisInfo != ""): ?>
            <a id="nis" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php echo mb_substr($this->options->nisInfo, 5, 14) ?>" target="_blank">
                <?php echo $this->options->nisInfo ?>
            </a> | <?php endif; ?>
            <?php if ($this->options->icpInfo != ""): ?>
            <a href="https://beian.miit.gov.cn/" target="_blank"><?php echo $this->options->icpInfo ?></a>
            <?php endif; ?>
        </p>
        <p>&copy; <?php echo date('Y');?> <?php $this->options->title();?> <i class="czs-heart"></i> <?php Typecho_Widget::widget('Widget_Stat')->to($stat); ?><?php $stat->publishedPostsNum() ?> Posts <?php allOfCharacters();?> Words crafted</p>
        <p>Powered by <a href="https://www.typecho.org">Typecho</a> | Theme <a href="https://github.com/Skywt2003/Daydream">Daydream</a> by <a href="https://skywt.cn/">SkyWT</a></p>
        <?php $this->options->footerCode(); ?>
    </div>
</footer>

<?php $this->footer(); ?>

</body>
</html>
