# zip
超级简单的zip文件压缩，解压

### Install
```
composer require ssskit/zip
```

### Use
Zip 压缩文件
```
use EasyZip\ZipHandle;

$dir_name = '/dir'; // 需要压缩的目录或文件路径
$zip_name = '/test.zip'; // 压缩文件保存路径

ZipHandle::zip($dir_name,$zip_name);
```

UnZip 解压文件
```
use EasyZip\ZipHandle;

$zip_name = '/test.zip'; // 需要解压的压缩文件路径
$dir_name = '/dir'; // 解压后的目录路径

ZipHandle::unzip($zip_name,$dir_name);
```

### About me
Email：ssskit@qq.com<br>
个人博客：http://ssskit.cn