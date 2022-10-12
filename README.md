# Daydream ✨

![screenshot.png](./screenshot.png)

Daydream 是一个简洁轻盈的 Typecho 主题。

Demo：[blog.skywt.cn](https://blog.skywt.cn/)

## 特性 / Features

- 极简单栏设计。
- 使用 Pico.css 重构，轻盈快速。
- 全站 PJAX 无刷新，极速响应。
- 集成图片灯箱，代码高亮，KaTeX 数学公式，TOC，夜间模式，评论 UA、归属地显示等一大堆功能，all-in-one。

## 安装 / Installation

前往 Releases 下载源代码压缩包，解压后将文件夹重命名为 Daydream（注意首字母大写），并移动到 Typecho 主题目录，在 Typecho 后台启用主题。

也可以克隆 master 分支下的代码，将文件夹命名为 Daydream（注意首字母大写），并移动到 Typecho 主题目录，在 Typecho 后台启用主题。

## 使用 / Usage

**请在 Typecho 后台的「设置」-「评论」-「评论提交」中取消勾选「开启反垃圾保护」，否则将无法正常发表评论。**关闭该选项后 Typecho 评论区将会关闭 CSRF 防护，用户可以轻易使用脚本提交评论，建议结合其他反垃圾评论策略或插件。

建议在「控制台」-「外观」-「设置外观」中进行主题的相关设置。

### 关于 KaTeX

遵从常规的 Markdown 写法，在写作中单个美元符号 `$` 中的是行内公式，两个美元符号 `$$` 中的是单行公式。

### 关于字段（themeFields）

- 文章头图地址：填入一个图片 URL 地址, 就可以让文章加上头图。对页面无效。
- 文章发布地点：填入一个地址，会显示在文章标题下方。对页面无效。
- 页面 icon：为页面填入一个草莓图标库 icon 名，在菜单栏链接前会显示 icon。草莓图标库是 2.0.0 Free 版本。对文章无效。
- 重定向至：输入一个 URL，打开页面时会自动重定向到这个 URL，用于定制菜单栏。

### 兼容性建议

- 主题已引用 jQuery，插件无需再次引用。
- 集成了 KaTeX ，不建议使用其他数学公式插件。
- 集成了 Highlight.js，不建议使用其他代码高亮插件。
- 集成了 jQuery Fancybox 图片灯箱功能，不建议使用其他图片灯箱类插件。
- 自带了生成文章目录（Table of Contents）的代码，不建议使用其他 TOC 插件。
- 默认支持 Darkmode，不建议使用其他启用 Darkmode 插件。

## 协议 / License

[GNU GPL v3](https://choosealicense.com/licenses/gpl-3.0/)