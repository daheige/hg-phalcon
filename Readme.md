# phalcon7-demo
    基于phalcon7拓展开发
# 目录结构
```
├── app
│   ├── AppBoot.php
│   ├── bootstrap
│   ├── common
│   ├── config
│   ├── controllers
│   ├── functions
│   ├── library
│   ├── logics
│   ├── models
│   ├── plugins
│   ├── routes
│   ├── services
│   ├── tasks
│   └── views
├── bin
│   └── app-init.sh
├── composer.json
├── composer.lock
├── docs
│   ├── helper.md
│   └── phalcon-demo.md
├── public
│   └── index.php
├── Readme.md
├── storage
│   └── logs
└── vendor
    ├── autoload.php
    └── composer
```

# apache设置
    public目录下.htaccess 将全部的URI重定向到public/index.php文件
        AddDefaultCharset UTF-8
        <IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^(.*)$ index.php?_url=/$1 [QSA,L]
        </IfModule>
    网站根目录.htaccess 用于隐藏应用转发全部请求到对应文档根目录（public/）的相关代码
        <IfModule mod_rewrite.c>
            RewriteEngine on
            RewriteRule  ^$ public/    [L]
            RewriteRule  ((?s).*) public/$1 [L]
        </IfModule>
    虚拟主机：
        <VirtualHost *:80>
            #ServerAdmin admin@example.host
            DocumentRoot "/web/hg-phalcon/public"
            DirectoryIndex index.php
            ServerName hgphalcon.com
            ServerAlias www.hgphalcon.com

            <Directory "/web/hg-phalcon/public">
                Options All
                AllowOverride All
                Allow from all
            </Directory>
        </VirtualHost>
# nginx配置(请根据具体情况调整)
    使用 $_SERVER[‘REQUEST_URI’] 作为 URLs的源：

        server {
        listen      80;
        server_name www.hgphalcon.com *.hgphalcon.com;
        root        /web/hg-phalcon/public;
        index       index.php index.html index.htm;
        charset     utf-8;

        location / {
                try_files $uri $uri/ /index.php?_url=$uri&$args;
        }

        location ~ \.php$ {
            try_files     $uri =404;

            fastcgi_pass  127.0.0.1:9000;
            fastcgi_index /index.php;

            include fastcgi_params;
            fastcgi_split_path_info       ^(.+\.php)(/.+)$;
            fastcgi_param PATH_INFO       $fastcgi_path_info;
            fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param APP_ENV "Testing";
        }

        location ~ /\.ht {
            deny all;
        }

        location ~ .*\.(xml|gif|jpg|jpeg|png|bmp|swf|woff|woff2|ttf|js|css|mp3|mp4|ico)$ {
                expires 30d;
        }

        error_log /var/log/nginx/logs/hg-phalcon-error.log;
        access_log /var/log/nginx/logs/hg-phalcon-access.log;
    }


# 参考文档:
    1. https://www.w3cschool.cn/phalcon7/phalcon7-module.html
    2. http://www.myleftstudio.com/#id4
    3. http://phalcon.ipanta.com/1.3/install.html#requirements 3.1版本
    4. http://www.myleftstudio.com/reference/tutorial.html
    5. http://www.myleftstudio.com/reference/mvc.html mvc 参考

# 版权说明
    采用MIT

