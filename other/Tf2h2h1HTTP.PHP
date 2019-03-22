<?php
class Tf2h2h1HTTP
{
    public function http_base($url, $data = '', $header = '', $proxy = '')
    {
        $ch = curl_init();
        if (!empty($proxy))
            curl_setopt ($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if ('https' === substr($url, 0, 5)) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // https请求不验证证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // https请求不验证hosts
        }
        if (!empty($header))
            curl_setopt($ch,CURLOPT_HTTPHEADER, $header);
        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $output = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        return $output;
    }
    public function http_get($url, $data = '', $header = '')
    {
        if (!empty($data)) {
            $data = @http_build_query($data);
            $pattern = '/\?/i';
            preg_match($pattern, $url, $matches);
            if (0 < count($matches)) {
                $url = $url."&".$data;
            } else {
                $url = $url."?".$data;
            }
        }
        return $this->http_base($url, '', $header);
    }
    public function http_post($url, $data = '', $header = '')
    {
        return $this->http_base($url, $data, $header);
    }
    public function http_upload($url, $filepath = '', $header = '')
    {
        $data = array();
        if (is_array($filepath)) {
            $data['file'] = array();
            foreach ($filepath as $key => $value) {
                $data['file'][$key] = new \CURLFile($value);
            }
        } else {
            $data['file'] = new \CURLFile($filepath);
        }
        return $this->http_base($url, $data, $header);
    }
}
class uTEST extends uHTTP
{
    private $return_type;
    private $web;
    function __construct($return_type = 'json', $web = 0)
    {
        $this->$return_type = $return_type;
        $this->$web = $web;
    }
    public function http_get($url, $data = '', $header = '')
    {
        $this->printline($url);
        $this->printline($data);
        $output = parent::http_get($url, $data, $header);
        $this->printline($output);
        $return_data = $this->return_decode($output);
        $this->printline($return_data);
        return $return_data;
    }
    public function http_post($url, $data = '', $header = '')
    {
        $this->printline($url);
        $this->printline($data);
        $output = parent::http_post($url, $data, $header);
        $this->printline($output);
        $return_data = $this->return_decode($output);
        $this->printline($return_data);
        return $return_data;
    }
    public function http_upload($url, $filepath = '', $header = '')
    {
        $this->printline($url);
        $this->printline($filepath);
        $output = parent::http_upload($url, $filepath, $header);
        $this->printline($output);
        $return_data = $this->return_decode($output);
        $this->printline($return_data);
        return $return_data;
    }
    public function printline($output, $web = 0)
    {
        if ($output == null)return;
        if (is_array($output)) {
            print_r($output);
        } else {
            $str = $output;
            $web = empty($this->$web)?$web:$this->$web;
            if ($web) {
                $str .= "<br>";
            } else {
                $str .= "\n";
            }
            echo $str;
        }
    }
    public function return_decode($output, $return_type = 'json')
    {
        if ($return_type == 'json') {
            $return_data = json_decode($output, true);
            if ($return_data == null) {
                return $output;
            }
            return $return_data;
        } else if ($return_type == 'jsonp') {
            $pattern = '/\((.*)\)/i';
            preg_match($pattern, $output, $matches);
            $output = $matches[1];
            $this->return_decode($output);
        }
    }
}
