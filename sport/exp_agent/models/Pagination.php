<?php
 namespace app\models;
 //页面分页类——2016.07.09(xw)
 class Pagination{
	 private $page;//当前页面
	 private $total;//总条数
	 private $limit;//每个分页的条数(pageSize)
	 private $offset;//页面偏移量
	 private $totalPage;//总页面数
	 
	 public function __construct($arr){
		 $this->total=(int)$arr['totalCount'];
		 $this->offset=0;
		 $this->limit=(int)$arr['pagesize'];
		 $this->page=1;
		 $this->totalPage=ceil( $this->total/$this->limit);
	 }
	 
	 public function __call($funName,$arg){
		 return $this->links();
	 }
	 
	 public function __get($propertyName=NULL){
		 if(isset($this->$propertyName)){
			 return $this->$propertyName;
		 }else{
			 return NULL;
		 }
	 }
	 public function __set($propertyName=NULL,$value=NULL){
		 if($propertyName=='page'){
			 $value=(int)$value;
			 $value=is_numeric($value)?abs($value):1;
			 $this->page=$value;
			 $this->offset=($this->page-1)*$this->limit;//页面偏移量
			 return true;
		 }else{
		 	 return false;
		 }
	 }
	 public function links(){
		 $html='<div><p class="pagelist">';
		 if($this->page==1){
			$html.='<span class="disabled">《</span>'; 
			$html.='<span class="disabled">&lt;</span>'; 
		 }elseif($this->page<=$this->totalPage){
			$html.='<span class="enabled" onClick="page(1)">《</span>';
		 	$html.='<span class="enabled" onClick="page('.($this->page-1).')">&lt;</span>';
		 }
		 for($i=$this->page-2;$i<=$this->page+2;$i++){
			if($i==$this->page){
				$html.='<span class="disabled">'.$i.'</span>'; 
			}else{
				if($i>0&&$i<=$this->totalPage){
					$html.='<span class="enabled" onClick="page('.$i.')">'.$i.'</span>';
				}
			}
		 }
		 if($this->page>=$this->totalPage){
			$html.='<span class="disabled">&gt;</span>'; 
			$html.='<span class="disabled">》</span>'; 
		 }else{
		 	$html.='<span class="enabled" onClick="page('.($this->page+1).')">&gt;</span>';
			$html.='<span class="enabled" onClick="page('.$this->totalPage.')">》</span>';
		 }
		 $html.='</p></div>';
/*		 $style='<script src="/public/common/js/page.js"></script>';
		 $style='<link href="/public/common/css/page.css" rel="stylesheet" type="text/css"/>';*/
		 return $html;
	 }
 }