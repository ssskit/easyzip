<?php
namespace EasyZip;

class ZipHandle{
    /**
     * 解压文件
     * @param string $inputFile 压缩包路径
     * @param string $outputFile 解压保存路径
     * @return mixed
     */
    public static function unzip($inputFile,$outputFile)
    {
        $zipFile = new ZipFile();
        try{
            //先创建对应的文件夹
            $dir_name = $outputFile;
            if(!file_exists($dir_name)){
                self::createFloder($dir_name);
                $zipFile
                    ->openFile($inputFile) // 打开待解压的文件
                    ->extractTo($outputFile);// 该文件夹必须已经存在
            }else{
                $dir_name = $outputFile;
            }

            return $dir_name; // 返回解压后的文件夹名
        } catch(\EasyZip\Exception\ZipException $e){
            // handle exception
            echo $e->getMessage();
        } finally{
            $zipFile->close();
        }

    }

    /**
     * 压缩文件
     * @param string $inputFile 目录路径
     * @param string $outputFile 压缩包保存路径
     */
    public static function zip($inputFile,$outputFile)
    {
        $zipFile = new ZipFile();
        //判断是否有后缀名
        $check = strrchr($outputFile,'/');
        $check = strrchr($check,'.');
        if(empty($check)){
            $outputFile .= '.zip';
        }

        try{
            $zipFile
                ->addDirRecursive($inputFile,'', \EasyZip\Constants\ZipCompressionMethod::DEFLATED) // Deflate compression
                ->saveAsFile($outputFile) // save the archive to a file
                ->close(); // close archive
        }
        catch(\EasyZip\Exception\ZipException $e){
            // handle exception
            echo $e->getMessage();
        }
        finally{
            $zipFile->close();
        }
    }

    /**
     * 创建文件夹
     * @param $createpath
     * @return mixed
     */
    private static function createFloder($createpath)
    {
        $_createpath = iconv('utf-8', 'gb2312', $createpath);
        if (file_exists($_createpath) == false)
        {
            //检查是否有该文件夹，如果没有就创建，并给予最高权限
            if (mkdir($_createpath, 0700, true)) {
                $value['file'] ='文件夹创建成功';
                $value['success']='success';
            } else {
                $value['file'] ='文件夹创建失败';
                $value['fail']='fail';
            }
        }
        else
        {
            $value['file'] ='文件夹已存在';
            $value['fail']='fail';
        }
        return $value;
    }
}