<?php
session_start();
getCode(4,60,20);

function getCode($num, $w, $h) {
    // ȥ���� 0 1 O l ��
    $str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ";
    $code = '';
    for ($i = 0; $i < $num; $i++) {
        $code .= $str[mt_rand(0, strlen($str)-1)];
    }
    //�����ɵ���֤��д��session������֤ҳ��ʹ��
    $_SESSION["helloweba_char"] = $code;
    //����ͼƬ��������ɫֵ
    Header("Content-type: image/PNG");
    $im = imagecreate($w, $h);
    $black = imagecolorallocate($im, mt_rand(0, 200), mt_rand(0, 120), mt_rand(0, 120));
    $gray = imagecolorallocate($im, 118, 151, 199);
    $bgcolor = imagecolorallocate($im, 235, 236, 237);

    //������
    imagefilledrectangle($im, 0, 0, $w, $h, $bgcolor);
    //���߿�
    imagerectangle($im, 0, 0, $w-1, $h-1, $gray);
    //imagefill($im, 0, 0, $bgcolor);



    //�ڻ�����������ɴ����㣬���������;
    for ($i = 0; $i < 40; $i++) {
        imagesetpixel($im, rand(0, $w), rand(0, $h), $black);
    }
    //���ַ������ʾ�ڻ�����,�ַ���ˮƽ����λ�ö���һ��������Χ�������
    $strx = rand(3, 8);
    for ($i = 0; $i < $num; $i++) {
        $strpos = rand(1, 6);
        imagestring($im, 5, $strx, $strpos, substr($code, $i, 1), $black);
        $strx += rand(8, 14);
    }
    imagepng($im);
    imagedestroy($im);
}
?>