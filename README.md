# branch-sdk

php sdk of myhayo/branch-server

Usage
---

- 首先确保安装好了laravel

```
composer require myhayo/branch-sdk
```

- 然后运行下面的命令来发布资源：

```
php artisan vendor:publish --provider="Myhayo\Branch\Providers\BranchServiceProvider"
```

- 修改对应的env配置：

```
BRANCH_SKD_SERVICE:分支服务器域名
BRANCH_SKD_ACCESS_ID:此项目对应的 Access Id
BRANCH_SKD_ACCESS_KEY:此项目对应的 Access Key
```

最后，就可以愉快的使用了

### 设备信息字段
```
 字段         类型   说明
 os          int    系统类型: 1 Android, 2 iOS
 android_id  string Android ID
 oaid        string OAID
 imei1       string IMEI1
 imei2       string IMEI2
 mac         string MAC
 idfa        string idfa
 ua          string user agent
 model       string 机型
 ip          string 设备的本地 IP 地址
 app_version string APP版本名称
 os_version  string 系统版本
 brand       string 手机品牌
 ch          string 渠道
```

FUNCTIONS
---

- 初始化:

```
$branch = new BranchService();
$ret_init = $branch->init($device);  
```

- 上报
```
$branch = new BranchService();
$ret_init = $branch->report(
    $uuid, // 上报返回的uuid
    BranchService::DEVICE_ACTION_ACTIVATE_APP, // 设备行为
    [], // 设备行为参数
    $device 
    );  
```

- 行为上报成功回调处理
```
$branch = new BranchService();
$branch->callback(request(), function ($uuid, $action, $channel) {
    // TODO 处理
    
});

```


