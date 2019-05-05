<?php
header("Content-type: text/html; charset=utf-8");
  $array=array(array(1,2,3),array(2,3,4),array(3,4,5),array(4,5,6));
  foreach ($array as $key => $value) {
    foreach ($value as $k => $v) {

          $vs[]=$v;

      }
      

  }
 
  if(in_array('10',$vs)){
      echo "存在";
  }else{
    echo "不存在";
  }



  $str="we are hap py";
  $str2=str_replace(' ', '%20', $str);
  echo $str2;
?>