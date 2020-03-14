<?php
namespace app\modules\lottery\models\ar;

use Yii;
//--xw--2016.03.24
class HelperFun{
	private $middle;//球的中间值
	private $which_ball;//要进行计算的是那个球
	private $lists;//原始数据
	private $ball;//球的个数
	private	$counts=array('0'=>0,'1'=>0);//0：偶数个数，1：奇数个数
	private	$sizes=array('0'=>0,'1'=>0);//0：小数个数，1：大数
	private $width;//二维数组最大长度(横向)
	private $height;//二维数组最大高度(纵向)
	private $type;//0：统计单双(默认),非0：统计大小
	//list:数组
	//which:第几个球
	//cmax：球的最大值
	//ball:中奖号码的个数
	public function __construct($list,$which=1,$cmax=10,$ball=10,$type=0){
		if(is_array($list)){
			krsort($list);
			$this->lists=array_values($list);
		}
		$this->middle=((float)$cmax)/2;
		$this->which_ball='ball_'.$which;
		$this->type=$type;
		$this->ball=$ball;
	}
	public function ball_num(){//露珠图数据处理
		if(!is_array($this->lists)||(count($this->lists)==0)){
			$arr=array();
			for($i=0;$i<6;$i++){
				for($j=0;$j<35;$j++){
					$arr[$i][$j]=array();
				}
			}
			$return=array(
				'0'=>array('single'=>0,'double'=>0,'small'=>0,'big'=>0),
				'1'=>$arr
			);
			return $return;
		}
		//横向列表
		$m_arr=array();
		$s_arr=array();
		$list=$this->lists;
		$isSingle=$list[0][$this->which_ball];
		$str=array();
		$max=count($list)-1;
		foreach($list as $k=>$v){
			$cilent_s=$v[$this->which_ball];
			$str[]=$cilent_s;
			if($isSingle==$cilent_s){
				$s_arr[]=$v;
			}else{
				$m_arr[]=$s_arr;
				$s_arr=array($v);
				$isSingle=$cilent_s;
			}

			if($max==$k){//最后的一组别忘了存入数组,不然会莫名丢了一组
				$m_arr[]=$s_arr;
			}
		}
		$n_arr=$this->mid($m_arr);
		return $this->modify($n_arr);
	}
	public function cout(){//露珠图数据处理
	    if(!is_array($this->lists)||(count($this->lists)==0)){
			$arr=array();
			for($i=0;$i<6;$i++){
				for($j=0;$j<35;$j++){
					$arr[$i][$j]=array();
				}
			}
			$return=array(
				'0'=>array('single'=>0,'double'=>0,'small'=>0,'big'=>0),
				'1'=>$arr
			);
			return $return;
		}
		//横向列表
		$m_arr=array();
		$s_arr=array();
		$list=$this->lists;
		$isSingle=$list[0][$this->which_ball]%2;
		$isBig=($list[0][$this->which_ball]-$this->middle>0)?1:0;
		$str=array();
		$max=count($list)-1;
		foreach($list as $k=>$v){
			$cilent_s=$v[$this->which_ball]%2;
			$str[]=$cilent_s;
			$m=$v[$this->which_ball]-$this->middle;
			$cilent_b=($m>0)?1:0;
			$this->counts[$cilent_s]++;
			$this->sizes[$cilent_b]++;
			if($this->type==0){//单双
				if($isSingle==$cilent_s){
					$s_arr[]=$v;
				}else{
					$m_arr[]=$s_arr;
					$s_arr=array($v);
					$isSingle=$cilent_s;
				}
			}else if($this->type==1){//大小
				if($isBig==$cilent_b){
					$s_arr[]=$v;
				}else{
					$m_arr[]=$s_arr;
					$s_arr=array($v);
					$isBig=$cilent_b;
				}
			}
			if($max==$k){//最后的一组别忘了存入数组,不然会莫名丢了一组
				$m_arr[]=$s_arr;
			}
		}

		$n_arr=$this->mid($m_arr);
		return $this->modify($n_arr);
	}
//---------以下是辅助函数----------------------------------------------
	private function mid($m_arr){//翻转弯曲函数——核心函数
		//纵向列表
		$s_arr=array();
		$n_arr=array();
		$size=$this->size($m_arr);
		for($i=0;$i<$size['w'];$i++){
			for($j=0;$j<$size['h'];$j++){
				if(array_key_exists($i,$m_arr[$j])){
					$n_arr[$i][]=$m_arr[$j][$i];
				}else{
					$n_arr[$i][]=array();
				}
			}
		}
		$size=$this->size($n_arr);
		$tmp_arr=$n_arr;
		if($size['h']>5){
			//路径弯曲
			for($i=$size['h']-1;$i>5;$i--){
				for($j=0;$j<$size['w']+10;$j++){//右边界10点溢出扫描(溢出扫描的值越大容错能量越强,但是过大会影响速度)
					if(isset($n_arr[$i][$j])&&$n_arr[$i][$j]){
						for($k=$size['h']-6;$k>=0;$k--){
							if($i-$k>5){
								if(isset($n_arr[$i-$k][$j+$k])&&$n_arr[$i-$k][$j+$k]){
									$n_arr[$i-$k-1][$j+$k+1]=$n_arr[$i-$k][$j+$k];
								}
							}
						}
						$n_arr[$i-1][$j+1]=$n_arr[$i][$j];
						$n_arr[$i][$j]=array();
					}
				}
			}	
		}else{
			//过短填满
			for($i=$size['h'];$i<6;$i++){
				for($j=0;$j<$size['w'];$j++){
					$n_arr[$i][$j]=array();
					$tmp_arr[$i][$j]=array();
				}
			}
		}
		//边缘奇偶校验
		$sign=-1;
		$size=$this->size($n_arr);
		for($i=5;$i>4;$i--){
			for($j=0;$j<$size['w'];$j++){
				if(isset($n_arr[$i][$j])&&$n_arr[$i][$j]){
					if($this->type==0){//单双
						$cilent=$n_arr[$i][$j][$this->which_ball]%2;
					}else{//大小
						$cilent=($n_arr[$i][$j][$this->which_ball]-$this->middle>0)?1:0;
					}
					if($sign==-1){
						$sign=$cilent;
					}else{
						if($sign!=$cilent){
							if($tmp_arr[$i][$j]&&($n_arr[$i][$j]!=$tmp_arr[$i][$j])){//防止无故偏移
								$n_arr[$i-1][$j+1]=$n_arr[$i][$j];
								$n_arr[$i][$j]=array();
							}
						}
					}
				}else{
					$sign=-1;
				}
				if(isset($tmp_arr[$i][$j])&&$tmp_arr[$i][$j]){
					if($n_arr[$i][$j]!=$tmp_arr[$i][$j]){
						$n_arr[$i-1][$j+1]=$tmp_arr[$i][$j];
					}
				}
			}
		}
		//占位偏移
		for($i=5;$i>3;$i--){
			for($j=0;$j<$size['w'];$j++){
				if(isset($tmp_arr[$i][$j])&&$tmp_arr[$i][$j]){
					if($n_arr[$i][$j]!=$tmp_arr[$i][$j]){
						$n_arr[$i-1][$j+1]=$tmp_arr[$i][$j];
					}
				}
			}
		}
		return $n_arr;
	}
	//修改对齐矩阵，保留6x35的固定尺寸
	private function modify($arr){//固定输出6x35矩阵函数
		$arr=array_slice($arr,0,6);//截取掉多余尾部
		$size=$this->size($arr);
		$length=($size['w']<35)?35:$size['w'];
		$tmp_arr=array();
		foreach($arr as $k=>$v){
			$tmp_arr[$k]=array_pad($v,$length,array());
		}
		$n_arr=array();
		foreach($tmp_arr as $k=>$v){
			$n_arr[$k]=array_slice($v,-35,35);
		}
		$size=$this->size($n_arr);
		$k_arr=array();
		for($i=0;$i<6;$i++){
			for($j=0;$j<$size['w'];$j++){
				$v=$n_arr[$i][$j];
				if($v){
					$k_arr[$i][$j]['issingle']=$v[$this->which_ball]%2;
					$m=$v[$this->which_ball]-$this->middle;
					$k_arr[$i][$j]['isbig']=($m>0)?1:0;
					$title='';
					for($k=1;$k<=$this->ball;$k++){
						if(array_key_exists('ball_'.$k,$v)){
							if($title!='') $title.=',';
							$title.=$v['ball_'.$k];
						}
					}
					$title='第'.$v['qishu'].'期:'.$title;
					$k_arr[$i][$j]['title']=$title;
					$k_arr[$i][$j]['ball_num'] = $v[$this->which_ball];
				}else{
					$k_arr[$i][$j]=array();
				}
			}
		}
		$return=array(
			'0'=>array('single'=>$this->counts[1],'double'=>$this->counts[0],'small'=>$this->sizes[0],'big'=>$this->sizes[1]),
			'1'=>$k_arr
		);
		return $return;
	}
	private function size($arr){//计算二维数组横向和纵向最大维度
		$this->height=count($arr);
		$length=0;
		foreach($arr as $v){
		    if(count($v)>$length) $length=count($v);
			foreach($v as $k=>$v2){//由于存在孤点,有必要进行遍历
				if($k>$length){
					$length=$k;
				}
			}
		}
		$this->width=$length;
		return array('0'=>$this->width,'1'=>$this->height,'w'=>$this->width,'h'=>$this->height);
	}

	//广西十分
	public function gxklsf(){//露珠图数据处理
		if(!is_array($this->lists)||(count($this->lists)==0)){
			$arr=array();
			for($i=0;$i<6;$i++){
				for($j=0;$j<35;$j++){
					$arr[$i][$j]=array();
				}
			}
			$return=array(
				'0'=>array('single'=>0,'double'=>0,'small'=>0,'big'=>0),
				'1'=>$arr
			);
			return $return;
		}
		//横向列表
		$m_arr=array();
		$s_arr=array();
		$list=$this->lists;
		$isSingle=$list[0][$this->which_ball]%2;
		$isBig=($list[0][$this->which_ball]-$this->middle>0)?1:0;
		$str=array();
		$max=count($list)-1;
		foreach($list as $k=>$v){
			$cilent_s=$v[$this->which_ball]%2;
			$str[]=$cilent_s;
			$m=$v[$this->which_ball]-$this->middle;
			$cilent_b=($m>0)?1:0;
			$this->counts[$cilent_s]++;
			$this->sizes[$cilent_b]++;
			if($this->type==0){//单双
				if($isSingle==$cilent_s){
					$s_arr[]=$v;
				}else{
					$m_arr[]=$s_arr;
					$s_arr=array($v);
					$isSingle=$cilent_s;
				}
			}else if($this->type==1){//大小
				if($isBig==$cilent_b){
					$s_arr[]=$v;
				}else{
					$m_arr[]=$s_arr;
					$s_arr=array($v);
					$isBig=$cilent_b;
				}
			}
			if($max==$k){//最后的一组别忘了存入数组,不然会莫名丢了一组
				$m_arr[]=$s_arr;
			}
		}

		$n_arr=$this->mid($m_arr);
		return $this->gx_6_35($n_arr);
	}
	//广西十分  6x35的固定尺寸
	private function gx_6_35($arr){//固定输出6x35矩阵函数
		$arr=array_slice($arr,0,6);//截取掉多余尾部
		$size=$this->size($arr);
		$length=($size['w']<35)?35:$size['w'];
		$tmp_arr=array();
		foreach($arr as $k=>$v){
			$tmp_arr[$k]=array_pad($v,$length,array());
		}
		$n_arr=array();
		foreach($tmp_arr as $k=>$v){
			$n_arr[$k]=array_slice($v,-35,35);
		}
		$size=$this->size($n_arr);
		$k_arr=array();
		for($i=0;$i<6;$i++){
			for($j=0;$j<$size['w'];$j++){
				$v=$n_arr[$i][$j];
				if($v){
					if($v[$this->which_ball] == 21){
						$k_arr[$i][$j]['issingle'] = 2;
					}else{
						$k_arr[$i][$j]['issingle']=$v[$this->which_ball]%2;
					}
					if($v[$this->which_ball] == 21){
						$k_arr[$i][$j]['isbig'] = 2;
					}else{
						$m=$v[$this->which_ball]-$this->middle;
						$k_arr[$i][$j]['isbig']=($m>0)?1:0;
					}
					$title='';
					for($k=1;$k<=$this->ball;$k++){
						if(array_key_exists('ball_'.$k,$v)){
							if($title!='') $title.=',';
							$title.=$v['ball_'.$k];
						}
					}
					$title='第'.$v['qishu'].'期:'.$title;
					$k_arr[$i][$j]['title']=$title;
					$k_arr[$i][$j]['ball_num'] = $v[$this->which_ball];
				}else{
					$k_arr[$i][$j]=array();
				}
			}
		}
		$return=array(
			'0'=>array('single'=>$this->counts[1],'double'=>$this->counts[0],'small'=>$this->sizes[0],'big'=>$this->sizes[1]),
			'1'=>$k_arr
		);
		return $return;
	}
}
?>