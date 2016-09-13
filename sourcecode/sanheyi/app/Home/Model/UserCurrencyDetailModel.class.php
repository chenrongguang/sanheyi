<?php


namespace Home\Model;

use Think\Model;

class UserCurrencyDetailModel extends Model
{
    //获取单个信息,参数为数组
    public function getSingle($paras)
    {


    }

    //获取列表信息 参数为数组
    public function getList($paras)
    {

        $sql = "select A.*,B.name,C.name as user_name from t_user_currency_detail A
               inner join t_currency B on A.currency_id= B.currency_id
               inner join t_user  C on A.user_id= C.user_id
               where B.use_yn='Y'";
        if (!empty($paras['detail_type'])) {
            $sql = $sql . " and A.detail_type='" . $paras['detail_type'] . "'";
        }
        if (!empty($paras['user_id'])) {
            $sql = $sql . " and A.user_id='" . $paras['user_id'] . "'";
        }

        if (!empty($paras['currency_id'])) {
            $sql = $sql . " and A.currency_id='" . $paras['currency_id'] . "'";
        }

        $sql = $sql . " order by A.create_time desc ";

        if (!empty($paras['page'])) {
            $sql = $sql . " limit " . $paras['page']->firstRow . "," . $paras['page']->listRows;

        }

        return $this->query($sql);
    }

}

?>