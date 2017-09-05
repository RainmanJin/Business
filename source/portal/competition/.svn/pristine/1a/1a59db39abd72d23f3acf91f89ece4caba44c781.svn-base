<?php 
class Page{
	private $nums;
	private $page;
	private $pagesize;
	private $pages;
	
	public function __construct($nums,$page,$pagesize,$index){
		//获取记录数
		$this->nums=$nums;
		
		//设定每页的记录数
		if($pagesize){
			$this->pagesize=$pagesize;
		}else{
			$this->pagesize=10;
		}
		
		//获取页数
		$pages=ceil($this->nums/$this->pagesize);
		
		//设定总页数至少1页
		if($pages<1){
			$this->pages=1;
		}else{
			$this->pages=$pages;
		}
		
		//如果传递过来的页数比总页数还大，就让它等于总页数，如果传递过来的页数小于1，就让他等于1
		if($page>$this->pages){
			$this->page=$this->pages;
		}elseif($page<1){
			$this->page=1;
		}else{
			$this->page=$page;
		}
		
		//索引页名称
		$this->index=$index;
	}
	
	public function Page_limit(){
		//为下一步做准备，limit的初始记录
		$kaishi=($this->page-1)*$this->pagesize;//为下一步做准备，limit的初始记录
		
		//return " limit ".$kaishi.",".$this->pagesize;
		return $kaishi;
	}
	
	public function Page_bottom(){
		$page_bottom="";
		if($this->page==1){
			$page_bottom.="<a href='javascript:;'><</a>";
		}else{
			$page_bottom.="<a href='javascript:;' onclick=url_change('replace','".$this->index."','pg',".($this->page-1).")><</a>";
		}
		
		$first_page=$this->page-3;
		$last_page=$this->page+3;
		if($first_page<1){
			$first_page=1;
		}
		if($last_page>$this->pages){
			$last_page=$this->pages;
		}
		for($i=$first_page;$i<=$last_page;$i++){
			if($this->page==$i){
				$page_bottom.="<span class='current'>".$i."</span>";
			}else{
				$page_bottom.="<a href='javascript:;' onclick=url_change('replace','".$this->index."','pg',".$i.")>".$i."</a>";
			}
		}
		
		if($this->page==$this->pages){
			$page_bottom.="<a href='javascript:;'>></a>";
		}else{
			$page_bottom.="<a href='javascript:;' onclick=url_change('replace','".$this->index."','pg',".($this->page+1).")>></a>";
		}

		return $page_bottom;
	}
}
?>