# my_frame
我的框架

nginx配置:

```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```