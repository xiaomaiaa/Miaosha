# 秒杀系统-2001210644-麦辉煜
互联网软件开发技术与实践大作业。该网站已经上线，可以通过以下方式访问:

- **用户端**

  可以访问 http://final.qadgztv.cn/index.html。注册之后登陆，也可以使用： 

  用户名：user4

  密码：xiaomai1998

- **后台管理端**

  可以访问<http://project.qadgztv.cn/admin/login/index.html>。用户名和密码分别为：

  - 超级管理员

    用户名：admin

    密码：xiaomai1998

  - 普通管理员

    用户名：worker

    密码：xiaomai1998

  - 普通用户

    用户名：user

    密码：xiaomai1998

# 文件介绍

当前目录下有三个文件夹和一个文件。

final文件夹是用户端的网页源文件。

project文件夹是后台管理端的网页源文件。

rabbit文件夹是订单处理程序的代码文件。

project.sql是数据库的数据文件。

# 用户端部署说明

### 所需环境

- Linux Server
- Apache 2.4.46
- PHP-7.4
- Python
- Redis
- RabbitMQ
- MySQL

### 创建数据库环境

首先，您需要创建project数据库，将project.sql中的数据导入，以让代码可以进行访问。同时，您还需要创建用户。

首先连接到数据库（使用root），并且创建用户。在linux终端下：

```
mysql -u root -p您的密码
```

在进入mysql后，执行以下代码

```
use mysql;
create user 'mhy'@'%' identified by 'xiaomai';
```

这样就创建了用户，然后继续执行

```
CREATE DATABASE project;
use project;
source project.sql;
```

这样就将project.sql文件中的数据导入到project数据库中了，之后就可以连接了。

### 执行rabbitMQ订单处理程序

在根目录下，分别执行以下命令，就可以让订单处理程序开始活动，等待订单到来。

```
nohup python -u rabbit/send.py > send 2>&1 &
nohup python -u rabbit/receive.py > receive 2>&1 &
```

### 部署客户端

1. 基于PHP-7.4创建一个站点（可以使用宝塔工具进行创建）
2. 用final文件夹下的文件覆盖该站点下的文件
3. 使用对应`域名/index.html`进行访问

# 后台管理端部署说明

### 所需环境

- Linux Server
- Apache 2.4.46
- PHP-7.2
- MySQL
- ThinkPHP-5.0

### 部署

1. 基于ThinkPHP-5.0和PHP-7.2部署一个站点
2. 将该站点下所有文件删除
3. 将project文件夹下的文件复制到该站点下
4. 使用对应`域名/admin/login/index.html`进行访问

