<?php
namespace app\modules\six\helpers;
class Zodiac{
   public $year=0;
   public function __construct(){
	   $this->year=(int)date("Y",time());
   }
   public function getArr($key=''){
		 if(file_exists('file/current.txt')){
			 $current=(int)trim(file_get_contents('file/current.txt'));
			 if($current!=$this->year){
				$this->_year();
			 }
		 }else{
             //年份处理
             $year_list = $this->getYearList();
             $time = time();
             $this->year = date('Y', $time);
             asort($year_list);
             foreach ($year_list as $key => $y) {
                 if (($time >= strtotime($y)) && ($time < strtotime($year_list[$key + 1]))) {
                     $this->year = substr($y, 0, 4);
                     break;
                 }
             }
			  $this->_write('file/current.txt',$this->year);
			  $this->_zoadiacList($this->year);
		 }
		  if(!file_exists('file/zodiac.txt')){
			 $lists=$this->_zoadiacList($this->year);
		  }else{
			 $str=file_get_contents('file/zodiac.txt');
			 $lists=unserialize($str);
		  }
		  if(is_numeric($key)&&abs($key)<12){//返回单个生肖列表
		      $key=(int)abs($key);
			  if(array_key_exists($key,$lists)){
			   	 return $lists[$key];
			  }else{
			   	 return '';
			  }
		  }else{//返回十二生肖列表
			  return $lists;
		  }
	 }

	public function getLetterArr(){//格式Array('A1'=>'01,13,25,37,49',...,'AC'=>'02,14,26,38');
		$letterArr = array();
		$noLetterArr = $this->getArr();
		if($noLetterArr){
			foreach ($noLetterArr as $key=>$val){
				$letterArr['A'.($key>8?chr($key+56):$key+1)][] = $val;
			}
		}
		return $letterArr;
	}
	public function getLetterArr2(){//格式Array('A1'=>Array('01','13','25','37','49'),...,'AC'=>Array('02','14','26','38'));
		$arr=$this->getLetterArr();
		foreach($arr as $k=>$v){
			$arr[$k]=explode(',',$v[0]);
		}
		return $arr;
	}
	 //---------------分------割---------线-----------------
     private function _year(){
		 if(file_exists('file/year.txt')){
			 $str=file_get_contents('file/year.txt');
			 $str=str_replace(',','',$str);
			 $str=preg_replace('/[\r|\n]+/',',',$str);
			 $arr=explode(',',$str);
			 foreach($arr as $v){
				 $year=@(int)substr($v,0,4);
				 if($this->year==$year){
					 $t=strtotime(trim($v)." 00:00:00");
					 if(time()>=$t){
						 $this->_write('file/current.txt',$year);
						 $this->_zoadiacList($year);
					 }
					 break;
				 }
			 }
		 }else {
                 $this->_write('file/current.txt', $this->year);
                 $this->_zoadiacList($this->year);//当前年份
         }
      }
	 private function _zoadiacList($year){
		  $lists=array();
		  for($i=0;$i<49;$i++){
			   $k=($year-1948-$i)%12;
			   if(isset($lists[$k])){ 
					$lists[$k].=', ';
			   }else{
					$lists[$k]='';
			   }
			   $lists[$k].=str_pad($i+1,2,'0',STR_PAD_LEFT);
		  }
		  ksort($lists);
          $this->_write('file/zodiac.txt',serialize($lists));
		  return $lists;
	 }
	 private function _write($file,$content){//写入txt文件
		  $h=fopen($file,'w');
		  if($h){
			fputs($h,$content);
			fclose($h);
		  }
	 }

    /**
     * 获取年份
     * @return false|int|string|void
     */
	 public function getYeay(){
         if(file_exists('file/current.txt')){
             $current=(int)trim(file_get_contents('file/current.txt'));
             if($current!=$this->year){
                 $this->year = $current;
             }
         }
         return $this->year;
     }

    /**
     * 获取配置的年份列表
     * @return array|bool
     */
     public function getYearList(){
         if(file_exists('file/year.txt')){
             $str=file_get_contents('file/year.txt');
             $str=str_replace(',','',$str);
             $str=preg_replace('/[\r|\n]+/',',',$str);
             $arr=explode(',',$str);
             return $arr;
         }else{
             return false;
         }
     }

    /**
     * 获取新年第一天的时间
     */
     public function getNewYearTime(){
         $yearList = $this->getYearList();
         $year = $this->getYeay();
         $new_time = '';
         foreach ($yearList as $list){
             $time = substr($list,0,4);
             if($year==$time){
                 $new_time=$list.' 00:00:00';
                 return $new_time;
             }
         }
     }
}