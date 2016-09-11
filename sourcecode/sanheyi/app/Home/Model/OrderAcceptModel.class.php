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

	//获取列表信息 参数为数组 ,给后台管理员使用
	public function getList_for_admin($paras){

		$sql = "select A.*,B.name as cname,C.name  as user_name, C.family_name as family_name from t_order_accept A
               inner join t_community B on A.community_id= B.community_id
               inner join t_user C on A.user_id= C.user_id
               where B.use_yn='Y' and A.status=1" ;

		//匹配状态
		if ($paras['match_status']==1) {
			$sql = $sql . " and A.match_status<=1";
		}
		else if($paras['match_status']==2){
			$sql = $sql . " and A.match_status =2 ";
		}

		if (!empty($paras['community_id'])) {
			$sql = $sql . " and A.community_id=".$paras['community_id'];
		}

		$sql = $sql . " order by queue_time asc "; //按排队时间,越小的时间 越排队靠前

		if (!empty($paras['page'])) {
			$sql = $sql . " limit " . $paras['page']->firstRow . "," . $paras['page']->listRows;

		}

		return $this->query($sql);

	}


}

?>