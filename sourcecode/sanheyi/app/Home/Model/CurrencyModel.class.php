<?php


namespace Home\Model;
use Think\Model;
class CurrencyModel extends Model{
	//获取单个信息,参数为数组
	public function getSingle($paras){


	}

	//获取列表信息 参数为数组
	public function getList($paras){

		$sql = "select A.*,B.name as cname,C.name as name from t_recharge A
               inner join t_currency B on A.currency_id= B.currency_id
               inner join t_user C on A.user_id= C.user_id
               where 1=1 " ;

		$sql = $sql . " order by A.create_time desc ";

		if (!empty($paras['page'])) {
			$sql = $sql . " limit " . $paras['page']->firstRow . "," . $paras['page']->listRows;

		}

		return $this->query($sql);

	}

}

?>