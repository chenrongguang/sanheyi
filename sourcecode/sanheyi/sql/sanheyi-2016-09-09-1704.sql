/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : sanheyi

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2016-09-09 17:04:52
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
  `que_day_max` int(11) DEFAULT NULL COMMENT '排队天数,最大值,该值+匹配时间 可计算出最晚打款时间',
  `offer_money_min` decimal(10,4) DEFAULT '0.0000' COMMENT '布施金额最小值',
  `offer_money_max` decimal(10,4) DEFAULT '0.0000' COMMENT '布施金额最大值',
  `must_mult` int(11) DEFAULT '100' COMMENT '必须是该数的整数倍',
  `confirm_day_min` int(11) DEFAULT '0' COMMENT '最早确认收款时间',
  `confirm_day_max` int(11) DEFAULT '0' COMMENT '最晚确认收款时间 ,该值+匹配时间,可计算出最晚确认收款时间',
  `is_open` char(1) DEFAULT '1' COMMENT '是否开放自助交易，默认为1表示开放,0表示不开放，需要客服人工处理',
  `offer_need_sxb` int(11) DEFAULT '1' COMMENT '提供帮助需要的善心币数量',
  PRIMARY KEY (`community_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='社区表';

-- ----------------------------
-- Records of t_community
-- ----------------------------
INSERT INTO `t_community` VALUES ('1', '特困社区', null, null, null, null, 'Y', '0', null, null, null, null, null, null, null, null, null, '0', null);
INSERT INTO `t_community` VALUES ('2', '贫困社区', null, null, null, null, 'Y', '0', '0.3000', null, '1', '10', '1000.0000', '3000.0000', '100', '1', '7', '1', '1');
INSERT INTO `t_community` VALUES ('3', '小康社区', null, null, null, null, 'Y', '5', '0.2000', '0.1500', '3', '15', '10000.0000', '30000.0000', '1000', '3', '9', '1', '2');
INSERT INTO `t_community` VALUES ('4', '富人社区', null, null, null, null, 'Y', '0', '0.1000', null, '3', '15', '50000.0000', '100000.0000', '10000', '1', '30', '1', '3');
INSERT INTO `t_community` VALUES ('5', '德善社区', null, null, null, null, 'Y', '0', '0.3000', null, null, null, null, null, null, null, null, '0', null);
INSERT INTO `t_community` VALUES ('6', '大德社区', null, null, null, null, 'Y', '0', '0.3000', null, null, null, null, null, null, null, null, '0', null);

-- ----------------------------
-- Table structure for `t_config`
-- ----------------------------
DROP TABLE IF EXISTS `t_config`;
CREATE TABLE `t_config` (
  `key` varchar(32) NOT NULL,
  `value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统配置参数';

-- ----------------------------
-- Records of t_config
-- ----------------------------
INSERT INTO `t_config` VALUES ('title', '麒麟币交易网站~~~');
INSERT INTO `t_config` VALUES ('keywords', '虚拟币比特币麒麟币');
INSERT INTO `t_config` VALUES ('desc', '友情提示：请控制风险，不要投入超过您风险承受能力的资金，不要投资您所不了解的数字货币，拒绝传销组织，警惕虚假宣传。');
INSERT INTO `t_config` VALUES ('logo', '/Uploads/Public/Uploads/2016-04-12/570c8f8fc65d4.png');
INSERT INTO `t_config` VALUES ('copyright', 'Copyright 2013-2016 数据库 All Rights Reserved. Powered by 大连仟源科技有限公司');
INSERT INTO `t_config` VALUES ('record', 'ICP备13052038号-1');
INSERT INTO `t_config` VALUES ('tel', '4008-367-667');
INSERT INTO `t_config` VALUES ('email', 'ybw@yuanbao.com');
INSERT INTO `t_config` VALUES ('qqcode', '2522');
INSERT INTO `t_config` VALUES ('business_email', 'contact@yuanbao.com');
INSERT INTO `t_config` VALUES ('name', '虚拟币');
INSERT INTO `t_config` VALUES ('address', '地址地址地址地址地址地址地址地址地址地址');
INSERT INTO `t_config` VALUES ('qq', '4008367667');
INSERT INTO `t_config` VALUES ('qqqun2', '12345678');
INSERT INTO `t_config` VALUES ('qqqun3', '123456789');
INSERT INTO `t_config` VALUES ('qqqun1', '1234567');
INSERT INTO `t_config` VALUES ('pay_min_money', '500');
INSERT INTO `t_config` VALUES ('pay_max_money', '1000000');
INSERT INTO `t_config` VALUES ('pay_fee', '10');
INSERT INTO `t_config` VALUES ('pay_get_name', '大连仟源科技有限公司');
INSERT INTO `t_config` VALUES ('pay_get_card', '1100 1042 1000 5302 8052');
INSERT INTO `t_config` VALUES ('pay_get_bank', '中国建设银行北京电子城科技园区支行');
INSERT INTO `t_config` VALUES ('xnb', 'JMBd');
INSERT INTO `t_config` VALUES ('xnb_name', '进盟币');
INSERT INTO `t_config` VALUES ('bili', '0.01');
INSERT INTO `t_config` VALUES ('weixin', '/Uploads/Public/Uploads/2016-03-19/56ecc75e1312d.jpg');
INSERT INTO `t_config` VALUES ('weibo', 'ybcoin');
INSERT INTO `t_config` VALUES ('time_limit', '20');
INSERT INTO `t_config` VALUES ('localhost', 'www.shujuku.comdsafds');
INSERT INTO `t_config` VALUES ('worktime', '工作日:9-19时 节假日:9-18时');
INSERT INTO `t_config` VALUES ('qqqun_url', 'http://shang.qq.com/wpa/qunwpa?\r\n\r\nidkey=6df577b6412b273c9171e0c204c633c0baa5c6e4301b2cc6171d10c3bcdc7c28');
INSERT INTO `t_config` VALUES ('fee', '0.3');
INSERT INTO `t_config` VALUES ('CODE_USER_NAME', 'way_xuan');
INSERT INTO `t_config` VALUES ('CODE_USER_PASS', 'xu1234xu');
INSERT INTO `t_config` VALUES ('CODE_NAME', '测试');
INSERT INTO `t_config` VALUES ('', 'friendship_tips');
INSERT INTO `t_config` VALUES ('', 'risk_warning');
INSERT INTO `t_config` VALUES ('friendship_tips', '阿达撒范德萨');
INSERT INTO `t_config` VALUES ('risk_warning', '发俺的沙发十大');
INSERT INTO `t_config` VALUES ('biaoge_url', '/Uploads/Public/Uploads/2016-03-31/新币申请表');
INSERT INTO `t_config` VALUES ('jiedong_bili', '100');
INSERT INTO `t_config` VALUES ('withdraw_warning', '爱的色放阿萨德');
INSERT INTO `t_config` VALUES ('invite_rule', '<p>\r\n	<span style=\"color:#333333;font-family:tahoma, arial, 宋体, sans-serif;font-size:14px;line-height:40px;background-color:#FFFFFF;\">邀请规则</span>\r\n</p>');
INSERT INTO `t_config` VALUES ('tcoin_fee', '0.1');
INSERT INTO `t_config` VALUES ('jiaoyi_over_hour', '24');
INSERT INTO `t_config` VALUES ('jiaoyi_start_minute', '0');
INSERT INTO `t_config` VALUES ('jiaoyi_start_hour', '0');
INSERT INTO `t_config` VALUES ('jiaoyi_over_minute', '0');
INSERT INTO `t_config` VALUES ('zibenfen_bili', '100');
INSERT INTO `t_config` VALUES ('VAP_rule', '爱的色放');
INSERT INTO `t_config` VALUES ('transaction_false', '500000');
INSERT INTO `t_config` VALUES ('ZC_AWARDS_CURRENCY_ID', '26');
INSERT INTO `t_config` VALUES ('ZC_AWARDS_ONE_RATIO', '100');
INSERT INTO `t_config` VALUES ('ZC_AWARDS_TWO_RATIO', '50');
INSERT INTO `t_config` VALUES ('ZC_AWARDS_STATUS', '1');
INSERT INTO `t_config` VALUES ('qq2', '2033126020');
INSERT INTO `t_config` VALUES ('qq3', '262109334');
INSERT INTO `t_config` VALUES ('qq1', '738636185');
INSERT INTO `t_config` VALUES ('FWTK', '爱的色放打算');
INSERT INTO `t_config` VALUES ('disclaimer', '阿德分手大师');
INSERT INTO `t_config` VALUES ('EMAIL_USERNAME', 'mail@koumang.com');
INSERT INTO `t_config` VALUES ('EMAIL_PASSWORD', 'xiaowei7758258');
INSERT INTO `t_config` VALUES ('EMAIL_HOST', 'smtp.qq.com');
INSERT INTO `t_config` VALUES ('zhuce_jiangli', '100');
INSERT INTO `t_config` VALUES ('new_coin_up', '<span><span>  若您是加密数字货币开发者或者官方团队成员，有意向将您开发的币种上线聚币网，欢迎您通过以下方式和流程递交申请。</span> \r\n<p>\r\n	申请流程：\r\n</p>\r\n<ol>\r\n	<li>\r\n		下载 <a href=\"http://www.jubi.com/newcoin-sheet.docx\" target=\"_blank\">“新币上线申请表”</a>，按要求填写并发送至邮箱market@jubi.com。\r\n	</li>\r\n	<li>\r\n		若申请资料填写齐全并符合聚币上线条件，我们将和申请人或官方团队联系并确定币种上线可行性。\r\n	</li>\r\n	<li>\r\n		确定上线币种后，聚币会安排技术进行钱包、交易相关开发，我们将至少提前1天通知上线新币 。\r\n	</li>\r\n</ol>\r\n<p>\r\n	另：若在聚币已上线的币种出现下列情况之一，聚币将考虑下线该币种。\r\n</p>\r\n<ol>\r\n	<li>\r\n		官方团队解散或者不再有正常维护更新，导致该币种不能进行正常挖矿、转币、区块查询等；\r\n	</li>\r\n	<li>\r\n		该币种已经没有用户进行交易或者使用、持有；\r\n	</li>\r\n	<li>\r\n		该币种出现重大技术故障，影响到区块查询、挖矿转币等正常功能；\r\n	</li>\r\n	<li>\r\n		官方团队涉嫌恶意预挖、传销诈骗、坐庄圈钱等欺诈行为。\r\n	</li>\r\n</ol>\r\n<p>\r\n	<a>为了维护广大用户的财产安全我们将尽量避免币种下线。</a> \r\n</p>\r\n</span>');

-- ----------------------------
-- Table structure for `t_currency`
-- ----------------------------
DROP TABLE IF EXISTS `t_currency`;
CREATE TABLE `t_currency` (
  `currency_id` int(11) NOT NULL COMMENT '货币 ,系统基础表',
  `name` varchar(50) NOT NULL COMMENT '货币名称',
  `use_yn` char(1) NOT NULL DEFAULT 'Y' COMMENT '是否可用',
  PRIMARY KEY (`currency_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='货币表,系统基础数据';

-- ----------------------------
-- Records of t_currency
-- ----------------------------
INSERT INTO `t_currency` VALUES ('1', '善种子', 'Y');
INSERT INTO `t_currency` VALUES ('2', '善心币', 'Y');
INSERT INTO `t_currency` VALUES ('3', '善心币', 'Y');
INSERT INTO `t_currency` VALUES ('5', '出局钱包', 'Y');
INSERT INTO `t_currency` VALUES ('4', '管理钱包', 'Y');

-- ----------------------------
-- Table structure for `t_message`
-- ----------------------------
DROP TABLE IF EXISTS `t_message`;
CREATE TABLE `t_message` (
  `message_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` bigint(20) NOT NULL COMMENT '公告标题',
  `content` varchar(4000) DEFAULT NULL COMMENT '公告内容',
  `type` smallint(6) NOT NULL DEFAULT '0' COMMENT '公告类型 ,0为系统公告,发送给所有人,1为审核公告,只发送给特定会员',
  `to_user_id` int(10) DEFAULT NULL COMMENT '发送给的特定会员id',
  `create_time` int(11) DEFAULT NULL COMMENT '发生时间',
  `create_user` int(11) DEFAULT NULL,
  `use_yn` char(1) DEFAULT 'Y' COMMENT '是否可用,默认Y',
  PRIMARY KEY (`message_id`),
  KEY `ct` (`create_time`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='公告';

-- ----------------------------
-- Records of t_message
-- ----------------------------
INSERT INTO `t_message` VALUES ('1', '1', '11111', '0', null, '1462545069', null, 'Y');
INSERT INTO `t_message` VALUES ('2', '2', '222222', '0', null, '1462545069', null, 'Y');
INSERT INTO `t_message` VALUES ('3', '3', '333333', '0', null, '1462545069', null, 'Y');
INSERT INTO `t_message` VALUES ('4', '4', '444444', '1', '1', '1462545069', null, 'Y');
INSERT INTO `t_message` VALUES ('5', '5', '555555', '0', null, '1462545069', null, 'Y');
INSERT INTO `t_message` VALUES ('6', '6', '666666', '0', null, '1462545069', null, 'Y');
INSERT INTO `t_message` VALUES ('7', '7', '77777', '1', '1', '1462545069', null, 'Y');
INSERT INTO `t_message` VALUES ('8', '8', '88888', '0', null, '1462545069', null, 'Y');
INSERT INTO `t_message` VALUES ('9', '9', '99999', '0', null, '1462545069', null, 'Y');
INSERT INTO `t_message` VALUES ('10', '10', '100000', '1', '1', '1462545069', null, 'Y');
INSERT INTO `t_message` VALUES ('11', '11', '1111111', '0', null, '1462545069', null, 'Y');
INSERT INTO `t_message` VALUES ('12', '12', '121212', '0', null, null, null, 'Y');
INSERT INTO `t_message` VALUES ('13', '13', '1313', '0', null, null, null, 'Y');
INSERT INTO `t_message` VALUES ('14', '14', '1414', '0', null, null, null, 'Y');

-- ----------------------------
-- Table structure for `t_order_accept`
-- ----------------------------
DROP TABLE IF EXISTS `t_order_accept`;
CREATE TABLE `t_order_accept` (
  `accept_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '接受资助id',
  `user_id` int(11) NOT NULL COMMENT '该接受资助的创建人',
  `community_id` int(11) NOT NULL COMMENT '社区id',
  `total_num` decimal(10,4) NOT NULL COMMENT '需要接受资助的总金额',
  `remain_num` decimal(10,4) NOT NULL COMMENT '剩余未匹配到的金额，一开始和total_num是一样的，如果该接受资助匹配到了自己要求的总金额，那么该字段值为0',
  `create_time` int(11) NOT NULL COMMENT '发生时间',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '该资助的状态，1为可用，0为取消',
  `match_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '该接受资助目前的匹配状态，0为等待匹配，1为部分匹配,2为为已经全部匹配',
  `confirm_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '确认收款状态，0表示未确认，1表示部分确认，2表示全部确认',
  `queue_time` int(11) NOT NULL COMMENT '排队时间,一开始等于create_time,管理员可以修改该值,匹配按照这个字段的先后来匹配',
  PRIMARY KEY (`accept_id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='接受资助表';

-- ----------------------------
-- Records of t_order_accept
-- ----------------------------
INSERT INTO `t_order_accept` VALUES ('1', '1', '1', '1000.0000', '1000.0000', '1462545069', '1', '2', '2', '0');
INSERT INTO `t_order_accept` VALUES ('2', '7', '2', '2000.0000', '1000.0000', '1462545069', '1', '1', '0', '0');
INSERT INTO `t_order_accept` VALUES ('3', '8', '3', '3000.0000', '0.0000', '1462545069', '1', '2', '2', '0');
INSERT INTO `t_order_accept` VALUES ('4', '1', '3', '23000.0000', '0.0000', '1473410855', '1', '0', '0', '1473410855');

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
  `pay_time` int(11) DEFAULT NULL COMMENT '实际付款时间',
  `max_pay_time` int(11) DEFAULT NULL COMMENT '最晚付款时间-根据该社区的参数计算出该字段',
  `confirm_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '确认收款状态，0表示未确认，1表示已确认',
  `confirm_time` int(11) DEFAULT NULL COMMENT '确认收款时间',
  `max_confirm_time` int(11) DEFAULT NULL COMMENT '最晚确认收款时间-根据付款时间和该社区的参数设定来计算该值',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '该匹配记录是否可用,默认1可用,0 为不可用,用户不打款时或者打款超时)该记录状态为0',
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
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '该资助的状态，1为可用，0为取消',
  `match_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '该资助目前的匹配状态，0为等待匹配，1为部分匹配,2为为已经全部匹配',
  `pay_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '付款状态,0为未付款，1为部分付款，2为全部付款',
  `confirm_status` smallint(6) NOT NULL DEFAULT '0' COMMENT '确认收款状态，0表示未确认，1表示部分确认，2表示全部确认',
  `queue_time` int(11) NOT NULL COMMENT '排队时间,一开始等于create_time,管理员可以修改该值,匹配按照这个字段的先后来匹配',
  `min_match_time` int(11) NOT NULL COMMENT '最早可匹配时间,创建时根据该社区的配置来计算并存储该时间',
  `max_match_time` int(11) DEFAULT NULL COMMENT '最晚必须匹配时间,创建时根据该社区的配置来计算并存储该时间',
  PRIMARY KEY (`offer_id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='提供资助表';

-- ----------------------------
-- Records of t_order_offer
-- ----------------------------
INSERT INTO `t_order_offer` VALUES ('1', '1', '1', '1000.0000', '1000.0000', '1462545069', '1', '0', '0', '0', '1462545069', '0', null);
INSERT INTO `t_order_offer` VALUES ('2', '1', '2', '2000.0000', '1000.0000', '1462545099', '1', '1', '0', '0', '0', '0', null);
INSERT INTO `t_order_offer` VALUES ('3', '1', '2', '3000.0000', '0.0000', '1462545199', '1', '2', '0', '0', '0', '0', null);
INSERT INTO `t_order_offer` VALUES ('4', '1', '3', '4000.0000', '0.0000', '1462545299', '1', '0', '1', '0', '0', '0', null);
INSERT INTO `t_order_offer` VALUES ('5', '1', '3', '5000.0000', '0.0000', '1462545399', '1', '2', '2', '2', '0', '0', null);
INSERT INTO `t_order_offer` VALUES ('6', '1', '2', '2000.0000', '2000.0000', '1473406757', '1', '0', '0', '0', '1473406757', '0', null);

-- ----------------------------
-- Table structure for `t_rebate`
-- ----------------------------
DROP TABLE IF EXISTS `t_rebate`;
CREATE TABLE `t_rebate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_1_rate` decimal(10,4) NOT NULL COMMENT '第1代上级的返佣比例 ,例如5%就是 0.05',
  `level_2_rate` decimal(10,4) NOT NULL COMMENT '第2代上级的返佣比例 ,例如5%就是 0.05',
  `level_3_rate` decimal(10,4) NOT NULL COMMENT '第3代上级的返佣比例 ,例如5%就是 0.05',
  `level_4_rate` decimal(10,4) NOT NULL COMMENT '第4代上级的返佣比例 ,例如5%就是 0.05',
  `level_5_rate` decimal(10,4) NOT NULL COMMENT '第5代上级的返佣比例 ,例如5%就是 0.05',
  `level_6_rate` decimal(10,4) NOT NULL COMMENT '第6代上级的返佣比例 ,例如5%就是 0.05',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='各级返佣设置-系统基础数据';

-- ----------------------------
-- Records of t_rebate
-- ----------------------------
INSERT INTO `t_rebate` VALUES ('1', '0.0800', '0.0600', '0.0500', '0.0400', '0.0300', '0.0200');

-- ----------------------------
-- Table structure for `t_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '登陆用户名',
  `pwd` varchar(100) NOT NULL COMMENT '密码',
  `high_pwd` varchar(100) DEFAULT NULL COMMENT '高级密码',
  `family_name` varchar(100) NOT NULL COMMENT '姓名',
  `mobile` varchar(15) NOT NULL COMMENT '手机号',
  `p_id` int(11) DEFAULT '-1' COMMENT '推荐人id',
  `p_path` varchar(2000) DEFAULT NULL COMMENT '推荐人线路图,序列化之后存入,从上级网上推',
  `create_time` int(11) DEFAULT NULL COMMENT '注册时间',
  `create_user` int(11) DEFAULT NULL COMMENT '注册人,如果是自己注册则为空',
  `address` varchar(300) DEFAULT NULL COMMENT '收货地址',
  `email` varchar(100) DEFAULT NULL COMMENT '电子邮箱',
  `city` varchar(50) DEFAULT NULL COMMENT '居住城市',
  `alipay_no` varchar(100) DEFAULT NULL COMMENT '支付宝帐号',
  `weixin_no` varchar(100) DEFAULT NULL COMMENT '微信帐号',
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
  `last_ip` varchar(100) DEFAULT NULL COMMENT '上次登陆ip',
  `use_yn` char(1) DEFAULT 'Y' COMMENT '是否可用,封号,用该字段',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('1', '1', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', '1', '1', '-1', null, '1473144269', null, 'a', 'b', 'c', 'd', '琐琐碎碎', '非凡方法', 'g', '23423424', 'http://local.sanheyi.com/Uploads/2016/09/08/57d15c10141a1.jpg', 'http://local.sanheyi.com/Uploads/2016/09/08/57d15c13cb79a.jpg', 'http://local.sanheyi.com/Uploads/2016/09/08/57d15c16adf29.jpg', '0', '1', '1473343361', '1', '1', null, null, null, null, 'Y');
INSERT INTO `t_user` VALUES ('3', '3333', 'c4ca4238a0b923820dcc509a6f75849b', 'c4ca4238a0b923820dcc509a6f75849b', 'c', '123', '-1', null, '1473144244', null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', null, null, '0', null, null, null, null, 'Y');
INSERT INTO `t_user` VALUES ('4', '4444', 'c81e728d9d4c2f636f067f89cc14862c', '665f644e43731ff9db3d341da5c827e1', '2', '2', '1', null, '1473206305', null, null, null, null, null, null, null, null, null, null, null, null, '0', '1', '1473398180', '1', '0', null, null, null, null, 'Y');
INSERT INTO `t_user` VALUES ('5', '5555', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '38026ed22fc1a91d92b5d2ef93540f20', '3', '3', '-1', null, '1473206356', null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', null, null, '0', null, null, null, null, 'Y');
INSERT INTO `t_user` VALUES ('6', '6666', 'a87ff679a2f3e71d9181a67b7542122c', '011ecee7d295c066ae68d4396215c3d0', '4', '4', '7', null, '1473206499', null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', null, null, '0', null, null, null, null, 'Y');
INSERT INTO `t_user` VALUES ('7', '7777', 'e4da3b7fbbce2345d7772b0674a318d5', '4e44f1ac85cd60e3caa56bfd4afb675e', '5', '5', '1', null, '1473206547', null, null, null, null, null, null, null, null, null, null, null, null, '0', '1', '1473343361', '1', '0', null, null, null, null, 'Y');
INSERT INTO `t_user` VALUES ('8', '8888', 'c4ca4238a0b923820dcc509a6f75849b', '28c8edde3d61a0411511d3b1866f0636', '1', '1', '-1', null, '1473206595', null, null, null, null, null, null, null, null, null, null, null, null, '0', '0', null, null, '0', null, null, null, null, 'Y');
INSERT INTO `t_user` VALUES ('9', '9999', 'bcbe3365e6ac95ea2c0343a2395834dd', 'be8fe4c12c4e43217c06098a2595a950', '22', '22', '1', null, '1473206612', null, null, null, null, null, null, null, null, null, null, null, null, '0', '1', '1473206612', null, '0', null, null, null, null, 'Y');
INSERT INTO `t_user` VALUES ('11', '克看看', 'c4ca4238a0b923820dcc509a6f75849b', '28c8edde3d61a0411511d3b1866f0636', '琐碎对方', '12312', '1', null, '1473339544', null, null, null, null, null, null, null, null, null, null, null, null, '0', '1', '1473390434', '1', '0', null, null, null, null, 'Y');
INSERT INTO `t_user` VALUES ('12', '鹅鹅鹅', 'c81e728d9d4c2f636f067f89cc14862c', 'c81e728d9d4c2f636f067f89cc14862c', '46464', '177777', '1', null, '1473339845', null, null, null, null, null, null, null, null, null, null, null, null, '0', '1', '1473343207', '1', '0', null, null, null, null, 'Y');

-- ----------------------------
-- Table structure for `t_user_currency`
-- ----------------------------
DROP TABLE IF EXISTS `t_user_currency`;
CREATE TABLE `t_user_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `num` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '该会员该货币拥有的可用数量',
  `frozen_num` decimal(10,4) NOT NULL DEFAULT '0.0000' COMMENT '该会员该货币的冻结数量',
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_u` (`user_id`,`currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='会员拥有的每种货币的数量-帐号汇总情况';

-- ----------------------------
-- Records of t_user_currency
-- ----------------------------
INSERT INTO `t_user_currency` VALUES ('1', '1', '1', '49.0000', '0.0000');
INSERT INTO `t_user_currency` VALUES ('2', '1', '2', '89.0000', '0.0000');
INSERT INTO `t_user_currency` VALUES ('3', '1', '3', '200.0000', '0.0000');
INSERT INTO `t_user_currency` VALUES ('4', '1', '4', '300.0000', '0.0000');
INSERT INTO `t_user_currency` VALUES ('5', '1', '5', '80000.0000', '0.0000');
INSERT INTO `t_user_currency` VALUES ('6', '9', '1', '2.0000', '0.0000');
INSERT INTO `t_user_currency` VALUES ('7', '6', '2', '10.0000', '0.0000');
INSERT INTO `t_user_currency` VALUES ('8', '4', '1', '0.0000', '0.0000');
INSERT INTO `t_user_currency` VALUES ('9', '4', '2', '0.0000', '0.0000');
INSERT INTO `t_user_currency` VALUES ('10', '4', '3', '0.0000', '0.0000');
INSERT INTO `t_user_currency` VALUES ('11', '4', '4', '0.0000', '0.0000');
INSERT INTO `t_user_currency` VALUES ('12', '4', '5', '0.0000', '0.0000');

-- ----------------------------
-- Table structure for `t_user_currency_detail`
-- ----------------------------
DROP TABLE IF EXISTS `t_user_currency_detail`;
CREATE TABLE `t_user_currency_detail` (
  `detail_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '会员id',
  `currency_id` int(11) NOT NULL COMMENT '货币id',
  `detail_type` smallint(6) DEFAULT '1' COMMENT '是收入还是支出,1,是收入 ,2是支出',
  `detail_num` decimal(10,4) NOT NULL COMMENT '货币该发生的数量,可为正负数',
  `rel_user_id` int(11) DEFAULT '0' COMMENT '发生方的帐号id,可以使管理员,管理员用0',
  `rel_user` varchar(50) DEFAULT '管理员' COMMENT '关系发生方用户id,可以是从这个用户来,也可以是发送给这个给这个用户,可以是管理员,正常时对方的帐号名称',
  `create_time` int(11) DEFAULT NULL COMMENT '发生时间',
  `handle_type` varchar(100) DEFAULT NULL COMMENT '操作类型,这里有:支出善心币,扣除出局钱包,支出善种子,管理钱包转为出局钱包',
  `remark` varchar(11) DEFAULT NULL COMMENT '备注,这里边有:激活会员,提供资助,管理员充值 等',
  PRIMARY KEY (`detail_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='会员货币发生变化的明细表';

-- ----------------------------
-- Records of t_user_currency_detail
-- ----------------------------
INSERT INTO `t_user_currency_detail` VALUES ('1', '1', '1', '2', '5.0000', '0', '管理员', '1462545069', '支出善种子', '激活会员');
INSERT INTO `t_user_currency_detail` VALUES ('2', '1', '2', '2', '2.0000', '0', '管理员', '1462545069', '支出善心币', '提供资助');
INSERT INTO `t_user_currency_detail` VALUES ('3', '1', '2', '2', '10.0000', '3', 'crg', '1462545069', '转出善心币', '转出善心币');
INSERT INTO `t_user_currency_detail` VALUES ('4', '1', '4', '1', '500.0000', '3', 'crg', '1462545069', '收入管理钱包', '下级人员出局钱包奖励');
INSERT INTO `t_user_currency_detail` VALUES ('5', '1', '1', '1', '20.0000', '3', 'crg', '1462545069', '收入善种子', '其他会员转给你');
INSERT INTO `t_user_currency_detail` VALUES ('6', '1', '1', '2', '-1.0000', '0', '管理员', '1473343204', '支出善种子', '激活会员');
INSERT INTO `t_user_currency_detail` VALUES ('7', '1', '1', '2', '-1.0000', '0', '管理员', '1473343361', '支出善种子', '激活会员');
INSERT INTO `t_user_currency_detail` VALUES ('8', '1', '1', '2', '-2.0000', '9', '9999', '1473378362', '支出善种子', 'uuuu');
INSERT INTO `t_user_currency_detail` VALUES ('9', '9', '1', '1', '2.0000', '1', '1', '1473378365', '收入善种子', 'uuuu');
INSERT INTO `t_user_currency_detail` VALUES ('12', '1', '2', '2', '-10.0000', '6', '6666', '1473379050', '支出善心币', '地方官地方官 ');
INSERT INTO `t_user_currency_detail` VALUES ('13', '6', '2', '1', '10.0000', '1', '1', '1473379054', '收入善心币', '地方官地方官 ');
INSERT INTO `t_user_currency_detail` VALUES ('14', '1', '1', '2', '-1.0000', '0', '管理员', '1473390434', '支出善种子', '激活会员');
INSERT INTO `t_user_currency_detail` VALUES ('15', '1', '1', '2', '-1.0000', '0', '管理员', '1473398180', '支出善种子', '激活会员');
INSERT INTO `t_user_currency_detail` VALUES ('16', '1', '2', '2', '-1.0000', '0', '管理员', '1473406770', '支出善心币', '提供资助');
