<?php 
function encode_url($string, $key="", $url_safe=TRUE)
{
      $CI =& get_instance();
      $CI->load->library('encrypt');
    $ret = $CI->encrypt->encode($string);

    if ($url_safe)
    {
        $ret = strtr(
                $ret,
                array(
                    '+' => '.',
                    '=' => '-',
                    '/' => '~'
                )
            );
    }

    return $ret;
}
  function decode_url($string, $key="")
{
        $CI =& get_instance();
        $CI->load->library('encrypt');
    $string = strtr(
            $string,
            array(
                '.' => '+',
                '-' => '=',
                '~' => '/'
            )
        );

    return $CI->encrypt->decode($string);
}
