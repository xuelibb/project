<?php
$path='basic/slideshow.txt';
//查询轮播图数据
if(file_exists($path)){
    $arr=json_decode(file_get_contents($path),true);
    foreach($arr as $k=>$v){
        if($v['is_show']==0){
            unset($arr['$k']);
        }
    }
}else{
    $arr=[];
}
//查询网站基本设置
if(file_exists("basic/settings.txt")){
    $settings=json_decode(file_get_contents("basic/settings.txt"),true);
}
//查询导航栏
if(file_exists('basic/nav.txt')){
    $nav=json_decode(file_get_contents('basic/nav.txt'),true);
}
?>
<div class="footer-section">
    <div class="ofh">
        <?=$settings['scopyright']?>
    </div>
</div>