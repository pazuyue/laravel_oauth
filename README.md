# laravel_oauth
####Master这代码啥也没有，就一个laravel的代码
####DEV分支里面的是OAuth2的授权框架合适的拿去


####第一步：部署数据库文件：php artisan migrate
####第二步：创建生成安全访问令牌php artisan passport:install
#######部署详情参考Laravel的文档
#######路径：http://laravelacademy.org/post/8909.html#toc_3


####框架的运行测试：
#####第一步：执行welcome.blade.php视图，该视图有个js的方法会创建一个客户端客户端的 name 和 redirect URL， redirect URL 是用户授权请求通过或拒绝后重定向到的位置。
#####第二步：/api/redirect 调用授权路径授权