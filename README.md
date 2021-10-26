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

### 设备行为

```
// 设备行为 - 激活
const DEVICE_ACTION_ACTIVATE_APP = 0;
// 设备行为 - 注册
const DEVICE_ACTION_PURCHASE = 1;
// 设备行为 - 次日留存
const DEVICE_ACTION_START_APP = 2;
```

FUNCTIONS
---

- 初始化:

```
$branch = new BranchService();
$ret_init = $branch->init($device);
// $ret_init 数组 ['uuid' => 设备uuid]   
```

- 渠道:

```
$branch = new BranchService();
$channel = $branch->channel($uuid);
// $channel 数组 ['channel' => ['channel_id' => 渠道id, 'channel_key'=> 渠道标识]]
```

- 上报

```
$branch = new BranchService();
$ret = $branch->report(
    $uuid, // 上报返回的uuid
    BranchService::DEVICE_ACTION_ACTIVATE_APP, // 设备行为
    [], // 设备行为参数
    $device 
    ); 
// $ret null|array 目前为一个空数组 标识上报成功    
     
```

- 行为上报成功回调处理

```
$branch = new BranchService();
$branch->callback(request(), function (string $uuid, array $action, array $channel) {
    // TODO 处理
    $uuid 设备uuid
    $action 行为数据 ['action_type' => 行为类型, 'action_param'=> 行为参数]
    $channel 渠道信息 ['channel_id' => 渠道id, 'channel_key'=> 渠道标识, 'channel_name' => 渠道名称]
    
});

```


