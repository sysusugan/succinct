succinct
========
A php MVC framework

1、系统目录介绍：
app:目录为web应用的源码，其中：
    controller: 控制器文件夹，控制器要继承系统控制器基类，命名格式遵循约定 文件名（类名）+'_Controller'后缀
    model:Model文件夹，自定义Model要继承系统Model基类,命名格式遵循约定 文件名（类名）+'_Model'后缀
    view:视图文件夹（或称模板文件夹），使用方式见helloword示例
    widgets:widgets文件夹 ，存放可复用的页面挂件，使用方法见msgboard示例

conf: 全局配置，见里面注释
static：静态文件（js/css/图片）等存放目录
system: 框架的系统文件，包括路由，自加载处理，系统基类，外部库文件，helper函数等

2、如何部署：
    对于蛋疼的留言板作业，只需要修改conf/config.php里面的配置即可，框架十分简陋，很多东西还没完善