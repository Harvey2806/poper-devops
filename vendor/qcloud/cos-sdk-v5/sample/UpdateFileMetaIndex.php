<?php

require dirname(__FILE__, 2) . '/vendor/autoload.php';

$secretId = "SECRETID"; //替换为用户的 secretId，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
$secretKey = "SECRETKEY"; //替换为用户的 secretKey，请登录访问管理控制台进行查看和管理，https://console.cloud.tencent.com/cam/capi
$region = "ap-beijing"; //替换为用户的 region，已创建桶归属的region可以在控制台查看，https://console.cloud.tencent.com/cos5/bucket
$cosClient = new Qcloud\Cos\Client(
    array(
        'region' => $region,
        'scheme' => 'https', // 审核时必须为https
        'credentials'=> array(
            'secretId'  => $secretId ,
            'secretKey' => $secretKey)));
try {
    //更新数据集内已索引的一个文件的部分元数据。并非所有的元数据都允许您自定义更新，在您发起更新请求时需要填写数据集，默认会根据该数据集的算子进行元数据重新提取并更新已存在的索引，此外您也可以更新部分自定义的元数据索引，如CustomTags、CustomId等字段，具体请参考请求参数一节。
    $result = $cosClient->UpdateFileMetaIndex(array(
        'AppId' => 'AppId', // 其中 APPID 获取参考 https://console.cloud.tencent.com/developer
		'Headers' => array(
			'Accept' => 'application/json',
			'Content-Type' => 'application/json',
		),
		'DatasetName'=> 'test001', // 数据集名称，同一个账户下唯一。;是否必传：是
		'Callback'=> 'http://www.callback.com', // 元数据索引结果（以回调形式发送至您的回调地址，支持以 http:// 或者 https:// 开头的地址，例如： http://www.callback.com;是否必传：是
		// 用于建立索引的文件信息。;是否必传：是
		'File'=> array(
		  'CustomId'=> '001', // 自定义ID。该文件索引到数据集后，作为该行元数据的属性存储，用于和您的业务系统进行关联、对应。您可以根据业务需求传入该值，例如将某个URI关联到您系统内的某个ID。推荐传入全局唯一的值。在查询时，该字段支持前缀查询和排序，详情请见字段和操作符的支持列表。   ;是否必传：否
		  'CustomLabels'=> array('age' => '18','level' => '18',)
, // 自定义标签。您可以根据业务需要自定义添加标签键值对信息，用于在查询时可以据此为筛选项进行检索，详情请见字段和操作符的支持列表。  ;是否必传：否
		  'MediaType'=> 'image', // 可选项，文件媒体类型，枚举值： image：图片。  other：其他。 document：文档。 archive：压缩包。 video：视频。  audio：音频。  ;是否必传：否
		  'ContentType'=> 'image/jpeg', // 可选项，文件内容类型（MIME Type），如image/jpeg。  ;是否必传：否
		  'URI'=> 'cos://examplebucket-1250000000/test1/img.jpg', // 资源标识字段，表示需要建立索引的文件地址，当前仅支持COS上的文件，字段规则：cos:///，其中BucketName表示COS存储桶名称，ObjectKey表示文件完整路径，例如：cos://examplebucket-1250000000/test1/img.jpg。 注意： 1、仅支持本账号内的COS文件 2、不支持HTTP开头的地址;是否必传：是
		),

    ));
    // 请求成功
    print_r($result);
} catch (\Exception $e) {
    // 请求失败
    echo($e);
}
