<?php
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600 * 24 * 7) . ' GMT');

header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

$req = GetEnv('REQUEST_URI');
define('CHACHE_IMG_PATH', './pics/cache/');
define('CHACHE_IMG_PATH2', './pics/cache/');
define('SITE_TEMPLATE_PATH', '../bitrix/templates/main');
define("BX_FILE_PERMISSIONS", 0644);
define("BX_DIR_PERMISSIONS", 0775);
//CheckDirPath($_SERVER["DOCUMENT_ROOT"].CHACHE_IMG_PATH2);

preg_match('/\/thumb\/([0-9]{1,4})x([0-9]{1,4})x([^\/]*)\/(.*)\.(gif|jpg|png|jpeg)/i', $req, $p);
$temp = preg_replace("/\//", '_', $req);
if (is_file (CHACHE_IMG_PATH.$temp) == true)
{
   switch (strtolower ($p[5])) {
      case 'gif':
         $im = ImageCreateFromGif (CHACHE_IMG_PATH.$temp);
         header("Content-type: image/gif");
         imageGif($im);
      break;
      case 'jpg' : case 'jpeg':
         $im = ImageCreateFromJpeg (CHACHE_IMG_PATH.$temp);
         header("Content-type: image/jpeg");
         imageJpeg($im, null, 100);
      break;
      case 'png':
         $im = ImageCreateFromPng (CHACHE_IMG_PATH.$temp);
         header("Content-type: image/png");
         imagePng($im);
      break;
   }
   readfile(CHACHE_IMG_PATH.$temp);
   exit ();
}
preg_match('/\/thumb\/([0-9]{1,4})x([0-9]{1,4})x([^\/]*)\/(.*)\.(gif|jpg|png|jpeg)/i', $req, $p);
if (!file_exists("./{$p[4]}.{$p[5]}"))
	die;
$i = getImageSize("./{$p[4]}.{$p[5]}");
if ($p[3] != 'sq' && $p[2] > 0 && $p[1] > 0) {
	if ($p[1] == 0)
	   $p[1] = $p[2] / $i[1] * $i[0];
	if ($p[2] == 0)
	   $p[2] = $p[1] / $i[0] * $i[1];
	   
	if ($p[1] > $i[0])
	{
	   $p[1] = $i[0];
	}
	if ($p[2] > $i[1]) {
		$p[2] = $i[1];	
	}
}

$im = ImageCreateTrueColor($p[1], $p[2]);
switch (strtolower ($p[5]))
{
   case 'gif' :
      $i0 = ImageCreateFromGif ("./{$p[4]}.{$p[5]}");
   break;
   case 'jpg' : case 'jpeg' :
      $i0 = ImageCreateFromJpeg ("./{$p[4]}.{$p[5]}");
   break;
   case 'png' :
      $i0 = ImageCreateFromPng ("./{$p[4]}.{$p[5]}");
   break;
}

$icolor = imagecolorallocate ($im,237,237,237);
imagefill ($im,0,0,$icolor);

switch (strtolower ($p[3]))
{
   case 'cut' :
      $k_x = $i [0] / $p [1];
      $k_y = $i [1] / $p [2];
      if ($k_x > $k_y)
         $k = $k_y;
      else
         $k = $k_x;
      $pn [1] = $i [0] / $k;
      $pn [2] = $i [1] / $k;
      $x = ($p [1] - $pn [1]) / 2;
      $y = ($p [2] - $pn [2]) / 2;
      
      $img2 = SITE_TEMPLATE_PATH.'/images/img_put.png';   
      
      $ii = getImageSize($img2);      
      
      $i2 = ImageCreateFromPng($img2);
      
      $im2_w = ceil(($p[1] * 30) / 100 );
      $im2_h = $im2_w / 4;      
      
      imageCopyResampled ($im, $i0, $x, $y, 0, 0, $pn[1], $pn[2], $i[0], $i[1]);
      
      ImageCopyResampled ($im, $i2, 0, 0 , 0, 0, $im2_w, $im2_h, $ii[0], $ii[1]);
      
   break;
   case 'in' :
      $k_x = $i [0] / $p [1];
      $k_y = $i [1] / $p [2];
      if ($k_x < $k_y)
         $k = $k_y;
      else
         $k = $k_x;
      $pn [1] = $i [0] / $k;
      $pn [2] = $i [1] / $k;
      $x = ($p [1] - $pn [1]) / 2;
      $y = ($p [2] - $pn [2]) / 2;
      imageCopyResampled ($im, $i0, $x, $y, 0, 0, $pn[1], $pn[2], $i[0], $i[1]);
   break;
   case 'ns' :
      $k_x = $i [0] / $p [1];
      $k_y = $i [1] / $p [2];
      if ($k_x < $k_y)
         $k = $k_y;
      else
         $k = $k_x;
      $pn [1] = round($i [0] / $k);
      $pn [2] = round($i [1] / $k);

		imagedestroy($im);
		$im = ImageCreateTrueColor($pn[1], $pn[2]);
		$icolor = imagecolorallocate ($im,255,255,255);
		imagefill ($im,0,0,$icolor);
	  
      imageCopyResampled ($im, $i0, 0, 0, 0, 0, $pn[1], $pn[2], $i[0], $i[1]);
   break;
   case 'sq' :
		imagedestroy($im);
		$im = ImageCreateTrueColor($p[1], $p[2]);
		$icolor = imagecolorallocate ($im,255,255,255);
		imagefill ($im,0,0,$icolor);
		
		if ($i[0] < $p[1] && $i[1] < $p[2]) {
			$x = ($p[1] - $i[0]) / 2;
			$y = ($p[2] - $i[1]) / 2;
			imageCopyResampled ($im, $i0, $x, $y, 0, 0, $i[0], $i[1], $i[0], $i[1]);
		} else {
			$k_x = $i [0] / $p [1];
			$k_y = $i [1] / $p [2];
			if ($k_x < $k_y)
				$k = $k_y;
			else
				$k = $k_x;
			$pn [1] = $i [0] / $k;
			$pn [2] = $i [1] / $k;
			$x = ($p [1] - $pn [1]) / 2;
			$y = ($p [2] - $pn [2]) / 2;
			imageCopyResampled ($im, $i0, $x, $y, 0, 0, $pn[1], $pn[2], $i[0], $i[1]);
		}
		
	header("Content-type: image/jpeg");
   imageJpeg($im, null, 100);
	  die;
   break;
   default : imageCopyResampled ($im, $i0, 0, 0, 0, 0, $p[1], $p[2], $i[0], $i[1]); break;
}
fclose(fopen(CHACHE_IMG_PATH.$temp, 'w'));
switch (strtolower ($p[5])) {
   case 'gif' : header("Content-type: image/gif");
   imageGif($im, CHACHE_IMG_PATH.$temp);
   imageGif($im); break;
   case 'jpg' : case 'jpeg' : 
header("Content-type: image/jpeg");
   imageJpeg($im, CHACHE_IMG_PATH.$temp, 95);
   imageJpeg($im, null, 95); break;
   case 'png' : header("Content-type: image/png");
   imagePng($im, CHACHE_IMG_PATH.$temp);
   imagePng($im); break;
}
?>