<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/upload'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
    //获取用户上传的内容
    $file = $request->file('Filedata');
    //判断目录是否存在

    // Validate the file type
    $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
    $fileParts = pathinfo($_FILES['Filedata']['name']);

    if (in_array($fileParts['extension'],$fileTypes)) {
        move_uploaded_file($tempFile,$targetFile);
        echo '1';
    } else {
        echo 'Invalid file type.';
    }

    $dir = $request->input('files');
    if (!file_exists("./upload/{$dir}")){
        mkdir("./upload/{$dir}");
    }
    //判断上传的文件是否有效
    if ($file->isValid()){
        //获取后缀
        $ext = $file->getClientOriginalExtension();
        //生成新的文件名
        $newFile=$dir.'_'.time().rand().+'.'.$ext;
        //移动到指定目录
        $file->move('./upload/'.$dir,$newFile);
        //文件路径
        $path = '/upload/'.$dir.'/'.$newFile;
        echo $path;
    }


}
?>