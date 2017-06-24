# Begin

读取文档之前，首先你要对[微信官方文档](https://mp.weixin.qq.com/wiki)有一定的了解，结合微信官方文档读取本项目文档会更容易理解。

##文档相关代码说明

1.所有返回信息经过了Collection类处理，Collection是一个继承了ArrayAccess的类，例如结果返回有access_token字段，你可以使用```$result['access_token']```或```$result->access_token```获取access_token，推荐使用```$result->access_token```。
2.被动回复消息和客服发送消息，请使用辅助消息类来传递参数，参数为字符串则默认Text类，创建卡券信息传递参数请使用辅助卡券类
