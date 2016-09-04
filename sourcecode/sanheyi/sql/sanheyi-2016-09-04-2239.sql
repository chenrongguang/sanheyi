/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : sanheyi

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-09-04 22:39:51
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `t_admin`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '登陆名',
  `family_name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `pwd` varchar(100) NOT NULL COMMENT 'md5之后的密码',
  `use_yn` char(1) NOT NULL DEFAULT 'Y' COMMENT '否可用,默认Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='管理员';

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('1', 'admin', '管理员', 'e10adc3949ba59abbe56e057f20f883e', 'Y');

-- ----------------------------
-- Table structure for `t_community`
-- ----------------------------
DROP TABLE IF EXISTS `t_community`;
CREATE TABLE `t_community` (
  `community_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '社区名称',
  `pic_url` varchar(300) DEFAULT NULL COMMENT '社区图片url',
  `content` varchar(4000) DEFAULT NULL COMMENT '社区说明',
  `create_time` int(11) DEFAULT NULL COMMENT '发生时间',
  `create_user` int(11) DEFAULT NULL,
  `use_yn` char(1) DEFAULT 'Y' COMMENT '是否可用',
  `rate_round` int(11) DEFAULT '0' COMMENT '前N轮收益率,默认为0,表示所有轮次都是一个收益率,如果该值有设置,就表示前N轮',
  `get_rate_before` decimal(10,4) DEFAULT NULL COMMENT '该社区的收益率,这为前N轮的收益率',
  `get_rate_after` decimal(10,4) DEFAULT NULL COMMENT 'N轮之后的收益率,具体多少轮由字段rate_rond决定',
  `que_day_min` int(11) DEFAULT NULL COMMENT '排队天数,最小值',
  `que_day_max` int(11) DEFAULT NULL COMMENT '排队天数,最大值',
  `offer_money_min` decimal(10,4) DEFAULT NULL COMMENT '布施金额最小值',
  `offer_money_max` decimal(10,4) DEFAULT NULL COMMENT '布施金额最大值',
  `is_open` char(1) DEFAULT '0' COMMENT '是否开放自助交易，默认为0表示开放,1表示不开放，需要客服人工处理',
  PRIMARY KEY (`community_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='社区表';

-- ----------------------------
-- Records of t_community
-- ----------------------------
INSERT INTO `t_community` VALUES ('1', '特困社区', null, null, null, null, 'Y', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_community` VALUES ('2', '贫困社区', null, null, null, null, 'Y', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_community` VALUES ('3', '小康社区', null, null, null, null, 'Y', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_community` VALUES ('4', '富人社区', null, null, null, null, 'Y', '0', null, null, null, null, null, null, '0');
INSERT INTO `t_community` VALUES ('5', '德善社区', null, null, null, null, 'Y', '0', null, null, null, null, null, null, '1');
INSERT INTO `t_community` VALUES ('6', '大德社区', null, null, null, null, 'Y', '0', null, null, null, null, null, null, '1');

-- ----------------------------
-- Table structure for `t_currency`
-- ----------------------------
DROP TABLE IF EXISTS `t_currency`;
CREATE TABLE `t_currency` (
  `currency_id` int(11) NOT NULL COMMENT '货币 ,系统基础表',
  `name` varchar(50) NOT NULL COMMENT '货币名称',
  `use_yn` char(1) NOT NULL DEFAULT 'Y' COMMENT '是否可用'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='货币表,系统基础数据';

-- ----------------------------
-- Records of t_currency
-- ----------------------------
INSERT INTO `t_currency` VALUES ('1', '善种子', 'Y');
INSERT INTO `t_currency` VALUES ('2', '善心币', 'Y');
INSERT INTO `t_currency` VALUES ('3', '善心币', 'Y');
INSERT INTO `t_currency` VALUES ('4', '出局钱包', 'Y');
INSERT INTO `t_currency` VALUES ('5', '管理钱包', 'Y');

-- ----------------------------
-- Table structure for `t_message`
-- ----------------------------
DROP TABLE IF EXISTS `t_message`;
CREATE TABLE `t_message` (
  `message_d` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` bigint(20) NOT NULL COMMENT '公告标题',
  `content` varchar(4000) DEFAULT NULL COMMENT '公告内容',
  `type` smallint(6) NOT NULL DEFAULT '0' COMMENT '公告类型 ,0为系统公告,发送给所有人,1为审核公告,只发送给特定会员',
  `to_user_id` int(10) DEFAULT NULL COMMENT '发送给的特定会员id',
  `create_time` int(11) DEFAULT NULL COMMENT '发生时间',
  `create_user` int(11) DEFAULT NULL,
  `use_yn` char(1) DEFAULT 'Y' COMMENT '是否可用,默认Y',
  PRIMARY KEY (`message_d`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公告';

-- ----------------------------
-- Records of t_message
-- ----------------------------

-- ----------------------------
-- Table structure for `t_order_accept`
-- ----------------------------
DROP TABLE IF EXISTS `t_order_accept`;
CREATE TABLE `t_order_accept` (
  `accept_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '接受资助id',
  `user_id` int(11) NOT NULL COMMENT '该接受资助的创建人',
  `total_num` decimal(10,4) NOT NULL COMMENT '需要接受资助的总金额',
  `remail_num` decimal(10,4) NOT NULL COMMENT '剩余未匹配到的金额，一开始和total_num是一样的，如果该接受资助匹配到了自己要求的总金额，那么该字段值为0',
  `create_time` int(11) NOT NULL COMMENT '发生时间',
  `create_user` int(11) NOT NULL COMMENT '该接受资助的创建人',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '该资助的状态，1为可用，0为取消',
  `match_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '该接受资助目前的匹配状态，0为等待匹配，1为部分匹配,2为为已经全部匹配',
  `confirm_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '确认收款状态，0表示未确认，1表示部分确认，2表示全部确认',
  PRIMARY KEY (`accept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='接受资助表';

-- ----------------------------
-- Records of t_order_accept
-- ----------------------------

-- ----------------------------
-- Table structure for `t_order_match`
-- ----------------------------
DROP TABLE IF EXISTS `t_order_match`;
CREATE TABLE `t_order_match` (
  `match_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '匹配id',
  `offer_id` bigint(20) NOT NULL COMMENT '提供资助id',
  `accept_id` int(11) NOT NULL COMMENT '接受资助id',
  `match_num` decimal(10,4) NOT NULL COMMENT '本次匹配的金额',
  `match_time` int(11) NOT NULL COMMENT '匹配时间',
  `pay_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '付款状态,0为未付款，1为已付款',
  `pay_time` int(11) DEFAULT NULL COMMENT '付款时间',
  `confirm_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '确认收款状态，0表示未确认，1表示已确认',
  `confirm_time` int(11) DEFAULT NULL COMMENT '付款时间',
  `status` smallint(6) DEFAULT '1' COMMENT '该匹配记录是否可用,默认1可用,0 为不可用,用户不打款时或者打款超时)该记录状态为0',
  PRIMARY KEY (`match_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='匹配表';

-- ----------------------------
-- Records of t_order_match
-- ----------------------------

-- ----------------------------
-- Table structure for `t_order_offer`
-- ----------------------------
DROP TABLE IF EXISTS `t_order_offer`;
CREATE TABLE `t_order_offer` (
  `offer_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '提供资助id',
  `user_id` int(11) NOT NULL COMMENT '该资助的提供人',
  `community_id` int(11) NOT NULL COMMENT '提供资助的社区',
  `num` decimal(10,4) NOT NULL COMMENT '提供资助的金额',
  `remail_num` decimal(10,4) NOT NULL COMMENT '剩余可匹配金额，一开始没匹配之前就是等于num,如果完全匹配之后则该值为0',
  `create_time` int(11) NOT NULL COMMENT '发生时间',
  `create_user` int(11) NOT NULL COMMENT '该资助的创建人',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '该资助的状态，1为可用，0为取消',
  `match_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '该资助目前的匹配状态，0为等待匹配，1为部分匹配,2为为已经全部匹配',
  `pay_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '付款状态,0为未付款，1为部分付款，2为全部付款',
  `confirm_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '确认收款状态，0表示未确认，1表示部分确认，2表示全部确认',
  PRIMARY KEY (`offer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='提供资助表';

-- ----------------------------
-- Records of t_order_offer
-- ----------------------------

-- ----------------------------
-- Table structure for `t_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `uer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '登陆用户名',
  `pwd` varchar(100) NOT NULL COMMENT '密码',
  `high_pwd` varchar(100) DEFAULT NULL COMMENT '高级密码',
  `family_name` varchar(100) NOT NULL COMMENT '姓名',
  `mobile` varchar(15) NOT NULL COMMENT '手机号',
  `p_id` int(11) DEFAULT NULL COMMENT '推荐人id',
  `p_path` varchar(2000) DEFAULT NULL COMMENT '推荐人线路图,序列化之后存入,从上级网上推',
  `create_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `create_user` int(11) DEFAULT NULL COMMENT '注册人,如果是自己注册则为空',
  `address` varchar(300) DEFAULT NULL COMMENT '收货地址',
  `email` varchar(100) DEFAULT NULL COMMENT '电子邮箱',
  `city` varchar(50) DEFAULT NULL COMMENT '居住城市',
  `alipay_no` varchar(100) DEFAULT NULL COMMENT '支付宝帐号',
  `weixin_no` varchar(0) DEFAULT NULL COMMENT '微信帐号',
  `bank` varchar(100) DEFAULT NULL COMMENT '开户银行 ,例如 农业银行',
  `bank_no` varchar(50) DEFAULT NULL COMMENT '银行帐号',
  `card_no` varchar(50) DEFAULT NULL COMMENT '身份证号',
  `card_p_url` varchar(200) DEFAULT NULL COMMENT '身份证正面图片地址',
  `card_o_url` varchar(200) DEFAULT NULL COMMENT '身份证反面url',
  `card_h_url` varchar(200) DEFAULT NULL COMMENT '手持身份证图片url',
  `group` varchar(11) DEFAULT '0' COMMENT '会员分组信息,普通会员:0,特困会员:1',
  `act_status` smallint(6) DEFAULT '0' COMMENT '是否激活状态,默认0,未激活 ,1为激活',
  `act_time` int(11) DEFAULT NULL COMMENT '激活时间',
  `act_user` int(11) DEFAULT NULL COMMENT '激活人id',
  `confirm_status` smallint(6) DEFAULT '0' COMMENT '审核状态,0为未审核,1表示审核中,2表示审核通过,3表示审核不通过',
  `confirm_time` int(11) DEFAULT NULL COMMENT '审核时间',
  `confirm_user` int(11) DEFAULT NULL COMMENT '审核人id',
  `confirm_fail_reason` varchar(500) DEFAULT NULL COMMENT '审核不通过原因',
  PRIMARY KEY (`uer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of t_user
-- ----------------------------

-- ----------------------------
-- Table structure for `t_user_currency`
-- ----------------------------
DROP TABLE IF EXISTS `t_user_currency`;
CREATE TABLE `t_user_currency` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `num` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '该会员该货币拥有的可用数量',
  `frozen_num` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '该会员该货币的冻结数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员拥有的每种货币的数量-帐号汇总情况';

-- ----------------------------
-- Records of t_user_currency
-- ----------------------------

-- ----------------------------
-- Table structure for `t_user_currency_detail`
-- ----------------------------
DROP TABLE IF EXISTS `t_user_currency_detail`;
CREATE TABLE `t_user_currency_detail` (
  `detail_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '会员id',
  `currency_id` int(11) NOT NULL COMMENT '货币id',
  `detail_type` smallint(6) DEFAULT NULL COMMENT '是收入还是支出,0,是收入 ,1是支出',
  `detail_num` decimal(10,4) NOT NULL COMMENT '货币该发生的数量,可为正负数',
  `rel_user_id` int(11) DEFAULT '0' COMMENT '关系发生方用户id,可以是从这个用户来,也可以是发送给这个给这个用户,如果是管理员充值,则该值为-1,默认为0,表示没有关系方',
  `create_time` int(11) DEFAULT NULL COMMENT '发生时间',
  `remark` varchar(11) DEFAULT NULL COMMENT '备注,这里边有:激活会员,提供资助,管理员充值 等',
  PRIMARY KEY (`detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员货币发生变化的明细表';

-- ----------------------------
-- Records of t_user_currency_detail
-- ----------------------------
