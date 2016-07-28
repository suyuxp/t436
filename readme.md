##使用说明
docker环境变量有: 
- DB_TYPE: 数据库类型

- DB_HOST: 数据库地址

- DB_DATABASE: 数据库名

- DB_USERNAME: 数据库用户名

- DB_PASSWORD: 数据库密码

```
// docker打包
docker build -t t436 .

// 运行单元测试
docker run -it -e "DB_TYPE=mysql DB_HOST=127.0.0.1 DB_DATABASE=t436 DB_USERNAME=root DB_PASSWORD=123456" t436 /phptest.sh

// 部署
docker run -d -P -e "DB_TYPE=mysql DB_HOST=127.0.0.1 DB_DATABASE=t436 DB_USERNAME=root DB_PASSWORD=123456" t436
```