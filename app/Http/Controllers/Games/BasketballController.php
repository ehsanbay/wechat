<?php

namespace App\Http\Controllers\Games;

use App\Tools\UyghurCharUtilities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BasketballController extends Controller
{
    public function superStar()
    {
        return view('Games/SuperStar');
    }

    public function makeStar(Request $request)
    {
        header("Content-type: text/html; charset=utf-8");

        $uighur = new UyghurCharUtilities();
        $name = $this->reverse2($uighur->getUyPFStr($request->get('username')));

        $rand = rand(1,6);
        $dst_path = 'images/games/basketball/'.$rand.'.jpg' ;
        $src_path = 'images/games/basketball/code.png';

        $dst = imagecreatefromstring(file_get_contents($dst_path));
        $src = imagecreatefromstring(file_get_contents($src_path));

        $font = './fonts/AlpEkran.ttf';
        $black = imagecolorallocate($dst, 255, 255, 255);
        list($src_w, $src_h) = getimagesize($src_path);

        imagecopymerge($dst, $src, 45, 483, 0, 0, $src_w, $src_h, 100);
        $fontBox = imagettfbbox(45, 0, $font, $name);
        $x = ceil(($src_w - $fontBox[2]) / 2)-5;
        imagettftext($dst, 55, 0, 230 ,115, $black, $font, $name);

        list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
        switch ($dst_type) {
            case 1://GIF
                header('Content-Type: image/gif');
                imagegif($dst);
                break;
            case 2://JPG
                header('Content-Type: image/jpeg');
                imagejpeg($dst);
                break;
            case 3://PNG
                header('Content-Type: image/png');
                imagepng($dst);
                break;
            default:
                break;
        }
        imagedestroy($dst);
        imagedestroy($src);
    }

    /**
     * 转换成UTF8字体
     * @param $str 字符串
     * @return string
     */
    private function reverse2($str)
    {
        $len = mb_strlen($str, "utf-8");
        $reverse = "";
        for($i = 1; $i <= $len; $i++){
            $reverse .=mb_substr($str, -($i), 1 , "utf-8");
        }
        return $reverse;
    }
}




