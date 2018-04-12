 <?php
  
httpcopy('https://raw.githubusercontent.com/txthinking/google-hosts/master/hosts');

function httpcopy($url, $file="", $timeout=60) {
    $file = empty($file) ? pathinfo($url,PATHINFO_BASENAME) : $file;
    $dir = pathinfo($file,PATHINFO_DIRNAME);
    !is_dir($dir) && @mkdir($dir,0755,true);
    $url = str_replace(" "," ",$url);

    if(function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        
      
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $temp = curl_exec($ch);

        if(@file_put_contents($file, $temp) && !curl_error($ch)) {
            return $file;
        } else {
            return false;
        }
    } else {
        $opts = array(
            "http"=>array(
            "method"=>"GET",
            "header"=>"",
            "timeout"=>$timeout)
        );
        $context = stream_context_create($opts);
        if(@copy($url, $file, $context)) {
            //$http_response_header
            return $file;
        } else {
            return false;
        }
    }
}



$data = httpcopy('https://www.tianyancha.com/reportContent/30792384/2016');  
print_r ($data);  