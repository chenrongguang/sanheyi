<?php


namespace Home\Model;
use Think\Model;
class UserModel extends Model{
	//获取单个信息,参数为数组
	public function getSingle($paras){
		return $this->where($paras['where'])->find();
	}

	//获取列表信息 参数为数组
	public function getList($paras){


	}

}

?>