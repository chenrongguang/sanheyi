<?php


namespace Home\Model;
use Think\Model;
class OrderAcceptModel extends Model{
	//获取单个信息,参数为数组
	public function getSingle($paras){


	}

	//获取列表信息 参数为数组
	public function getList($paras){
		$sql = "select A.*,B.name as cname from t_order_accept A
               inner join t_community B on A.community_id= B.community_id
               where B.use_yn='Y' and A.status=1" ;

		if (!empty($paras['user_id'])) {
			$sql = $sql . " and A.user_id=".$paras['user_id'];
		}

		$sql = $sql . " order by create_time desc ";

		if (!empty($paras['page'])) {
			$sql = $sql . " limit " . $paras['page']->firstRow . "," . $paras['page']->listRows;

		}

		return $this->query($sql);

	}

}

?>