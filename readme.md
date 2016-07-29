##使用说明
docker环境变量有: 
- DB_CONNECTION: 数据库类型

- DB_HOST: 数据库地址

- DB_DATABASE: 数据库名

- DB_USERNAME: 数据库用户名

- DB_PASSWORD: 数据库密码

```
// docker打包
docker build -t t436 .

// 运行单元测试
docker run -it -P -e 'DB_CONNECTION=mysql' -e 'DB_HOST=192.168.1.101' -e 'DB_DATABASE=t436' -e 'DB_USERNAME=root' -e 'DB_PASSWORD=Aixiangfei!@#$5' t436 /phptest.sh

// 部署
docker run -it -P -e 'DB_CONNECTION=mysql' -e 'DB_HOST=192.168.1.101' -e 'DB_DATABASE=t436' -e 'DB_USERNAME=root' -e 'DB_PASSWORD=Aixiangfei!@#$5' t436
```