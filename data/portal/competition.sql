-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2014-11-17 09:08:28
-- 服务器版本： 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `competition`
--

-- --------------------------------------------------------

--
-- 表的结构 `ka_acceptions`
--

CREATE TABLE IF NOT EXISTS `ka_acceptions` (
  `id_acception` int(11) NOT NULL AUTO_INCREMENT,
  `id_competition` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `choose` int(11) NOT NULL DEFAULT '1' COMMENT '未选择1个人2团队3',
  `accept_time` datetime NOT NULL,
  PRIMARY KEY (`id_acception`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `ka_acceptions`
--

INSERT INTO `ka_acceptions` (`id_acception`, `id_competition`, `id_user`, `choose`, `accept_time`) VALUES
(2, 1, 1, 2, '2014-11-05 09:40:55'),
(3, 1, 2, 3, '2014-11-05 09:58:22'),
(4, 2, 1, 2, '2014-11-05 10:02:30'),
(5, 2, 2, 1, '2014-11-05 10:10:51'),
(6, 4, 1, 1, '2014-11-05 10:13:27'),
(7, 5, 1, 1, '2014-11-05 10:20:57'),
(8, 5, 2, 1, '2014-11-05 10:21:51'),
(9, 1, 3, 2, '2014-11-05 16:54:08'),
(10, 1, 5, 2, '2014-11-10 16:57:59'),
(11, 1, 6, 2, '2014-11-10 17:01:39'),
(12, 2, 6, 2, '2014-11-10 17:10:45'),
(13, 1, 9, 2, '2014-11-11 08:39:58'),
(14, 1, 7, 1, '2014-11-12 11:38:46');

-- --------------------------------------------------------

--
-- 表的结构 `ka_competitions`
--

CREATE TABLE IF NOT EXISTS `ka_competitions` (
  `id_competition` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name_competition` varchar(100) NOT NULL COMMENT '名称',
  `type` varchar(20) NOT NULL DEFAULT 'playground' COMMENT '类型',
  `enterable` int(11) NOT NULL DEFAULT '1' COMMENT '是否可参与',
  `in_class` int(11) NOT NULL DEFAULT '0' COMMENT '是否学习',
  `introduce` text NOT NULL COMMENT '说明',
  `description` text NOT NULL COMMENT '描述',
  `data` text NOT NULL COMMENT '数据说明',
  `evaluation` text NOT NULL COMMENT '评价',
  `rule` text NOT NULL COMMENT '规则',
  `prize` text NOT NULL COMMENT '奖励描述',
  `prize_1` int(11) NOT NULL COMMENT '1等奖',
  `prize_2` int(11) NOT NULL COMMENT '2等奖',
  `prize_3` int(11) NOT NULL COMMENT '3等奖',
  `start_time` datetime NOT NULL COMMENT '开始时间',
  `end_time` datetime NOT NULL COMMENT '结束时间',
  PRIMARY KEY (`id_competition`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `ka_competitions`
--

INSERT INTO `ka_competitions` (`id_competition`, `name_competition`, `type`, `enterable`, `in_class`, `introduce`, `description`, `data`, `evaluation`, `rule`, `prize`, `prize_1`, `prize_2`, `prize_3`, `start_time`, `end_time`) VALUES
(1, 'APEC会议放假机构统计', 'featured', 1, 0, '亚太经济合作组织（Asia-Pacific Economic Cooperation，简称APEC）是亚太地区最具影响的经济合作官方论坛。', '<div><b>原标题：迎来近8年最好走的一天</b><br></div><div><br></div><div><div>&nbsp; &nbsp; &nbsp; &nbsp; 11月7日是APEC调休放假首日，机动车单双号限行，往日繁忙的道路立刻调整到假期状态，全天道路畅通。路面上比2008年北京奥运会期间还好走，交通拥堵指数探底8年来最低。</div><div>　　交通委表示，APEC会议期间本市交通的畅通，除了采取的一系列管控措施和保障措施外，也离不开每一位市民的支持。</div></div><div><br></div><div><b><br></b></div><div><b>早高峰“消灭”严重拥堵</b><br></div><div><br></div><div><div>&nbsp; &nbsp; &nbsp; &nbsp; 每天9时，北京交通发展研究中心会出一份即时交通运行监测快报，昨天也不例外。但不同的是，严重拥堵没有出现过。</div><div>　　报告中提到，7日城市路网早高峰平均交通指数为1.1，远远低于上周同期的5.7；峰值也仅为1.4，和动辄逾8甚至破9的峰值相比，简直称不上高峰。市民孙小姐说：“开车上路找到了春节时的感觉。”</div><div>　　如今市民已经耳熟能详的交通拥堵指数是从2007年开始在本市出现的，收集至今从未间断过一天。昨天的路况算是最好等级。交研中心工作人员耿松麟说：“这种畅通状态甚至好过北京奥运会期间，当时虽然也是单双号临时限行，但是社会没有连续调休，所以指数略高于现在。”</div><div>　　往日即使过了高峰期仍会拥堵的中心城区昨日也一路飘绿。以西城区为例，早高峰平均交通指数仅为1.6，而上周同期这里指数破8的严重拥堵时间达到90分钟。二环内，平均交通指数为1.3，峰值也没有突破2，维持在畅通范畴内，而上周这里严重拥堵了105分钟。</div><div><br></div></div>', '<b>为何还有个别地方堵车？</b><div><b><br></b></div><div><div>虽然拥堵指数一路走低，但是路面上依然出现了部分拥堵路段。比如7日早高峰，西四东大街、珠市口西大街、西四南大街等路段交通压力较大。</div><div>　　耿松麟分析，有一些路段属于常规车流量大，比如天宁寺桥到复兴门桥区、京藏高速三环到四环段、京通高速进京方向等；还有一些拥堵段是因为假日旅游出行量增加，比如潭柘寺附近路段出现车流量大，主要是假日去赏红叶的自驾族增多。</div><div>　　记者梳理发现，虽然有拥堵，不过与工作日拥堵连成片相比，7日的拥堵路段相对分散，且不连贯。耿松麟解释，虽然交通保障均参照“十一”黄金周配备，但是部分市民出游，加上高速路并未免费，道路还实行单双号管控，所以城市整体出行量下降了六到七成。即使是拥堵，持续时间和范围也不会太长、太大。</div></div>', '', '<div><b>地铁客流下降25%</b><br></div><div><b><br></b></div><div><div>地铁客流也相对下降。7日截止到9时，北京地铁全路网进出站量约为213万人次，比上周同期下降了约25%。市民唐先生在朋友圈里晒起了满足：“坐八通线居然有空位。”</div><div>　　不过，也有一些地铁站的客流直逼春运，其中大部分都是火车站周边车站。地铁2号线北京站的出站客流从平日的三四万人次增长到11万人次左右。而每年春运高峰期，这里的出站量为12万人次左右。</div><div>　　该站所属建国门站区书记王殷说，与春运期间相似，每天站里都会加派10名左右的站务员疏导客流。为了加快出站速度，站里还设专人在刷卡闸机口人工收单程票。一旦出现客流返程高峰，车站将开启全部6个售票窗口，减少乘客购票排队时间。</div><div>　　北京地铁提示，遇到突然大客流，一些车站因为站内空间有限，可能会出现临时限行，希望乘客配合。虽然正值调休放假阶段，但北京地铁所辖线路仍按照平日行程图组织运营，乘客候车时间不会延长。</div><div>　　地面公交每小时能跑31公里</div></div>', '', 5000, 0, 0, '2014-10-12 08:34:33', '2015-03-31 14:22:34'),
(2, '秋菊种类价格统计', 'research', 1, 0, '菊花（拉丁学名：Dendranthema morifolium（Ramat. ）Tzvel.）：在植物分类学中是菊科、菊属的多年生宿根草本植物。', '<div>菊花是中国十大名花之三，花中四君子（梅兰竹菊）之一，也是世界四大切花（菊花、月季、康乃馨、唐菖蒲）之一，产量居首。</div><div><br></div><div>因菊花具有清寒傲雪的品格，才有陶渊明的“采菊东篱下，悠悠见南山”的名句。</div><div><br></div><div>中国人有重阳节赏菊和饮菊花酒的习俗。唐·孟浩然《过故人庄》：“待到重阳日，还来就菊花。”在古神话传说中菊花还被赋予了吉祥、长寿的含义。</div><div><br></div><div>菊花是经长期人工选择培育的名贵观赏花卉，公元八世纪前后，作为观赏的菊花由中国传至日本。17世纪末叶荷兰商人将中国菊花引入欧洲，18世纪传入法国，19世纪中期引入北美。此后中国菊花遍及全球。</div><div><br></div>', '', '', '成功是相对的，短暂的，人大多数时间都是走在铺满失败的奋斗之路上。<div><br></div><div>&nbsp;成功只是漆黑的铺满失败的奋斗之路上的驿站，给人希望，愉悦和休整，却不是终点，不是家。你还要收拾心情继续摸黑在失败的路上，直到死亡。 即使成功了，不寻找新的奋斗目标，一直沉溺于成功所带来的胜利果实之中，则等于堕落。</div><div><br></div><div>如果不想堕落，则寻找新的目标，重新走在铺满失败的奋斗之路上。</div><div><br></div><div><br></div><div>&nbsp;能够享受地走在铺满失败的奋斗之路上，才是最高的境界。</div><div><br></div><div><br></div><div>&nbsp;无论是要成为社会中所谓的成功者，还是广义上的成功者，都所必须有的境界。</div><div><br></div><div>&nbsp;PS：达到这种境界是一种自虐倾向，对于一般人感觉是痛苦的事情，对于他们来说没那么难以忍受，甚至是享受，SO成功者都有这种自虐倾向。 能够享受充满失败的奋斗之路上的人=有这种自虐倾向的人=未来的成功者（无论金钱还是广义）</div>', '', 15000, 7000, 3000, '2014-10-10 18:32:36', '2015-03-31 09:35:26'),
(3, '河北省土地沙漠化地区统计', 'research', 1, 0, '狭义的荒漠化（即：沙漠化）乃是指在脆弱的生态系统下，由于人为过度的经济活动，破坏其平衡，使原非沙漠的地区出现了类似沙漠景观的环境变化过程。\r\n', '<div>土地沙漠化简单地说就是指土地退化，也叫“荒漠化”。</div><div><br></div><div>[1] 1992年联合国环境与发展大会对荒漠化的概念作了这样的定义：荒漠化是由于气候变化和人类不合理的经济活动等因素，使干旱、半干旱和具有干旱灾害的半湿润地区的土地发生了退化。1996年6月17日第二个世界防治荒漠化和干旱日，联合国防治荒漠化公约秘书处发表公报指出：当前世界荒漠化现象仍在加剧。全球现有12亿多人受到荒漠化的直接威胁，其中有1.35亿人在短期内有失去土地的危险。荒漠化已经不再是一个单纯的生态环境问题，而且演变为经济问题和社会问题，它给人类带来贫困和社会不稳定。</div><div><br></div><div>到1996年为止，全球荒漠化的土地已达到3600万平方公里，占到整个地球陆地面积的1/4，相当于俄罗斯、加拿大、中国和美国国土面积的总和。全世界受荒漠化影响的国家有100多个，尽管各国人民都在进行着同荒漠化的抗争，但荒漠化却以每年5～7万平方公里的速度扩大，相当于爱尔兰的面积。到二十世纪末，全球将损失约1/3的耕地。在人类当今诸多的环境问题中，荒漠化是最为严重的灾难之一。对于受荒漠化威胁的人们来说，荒漠化意味着他们将失去最基本的生存基础--有生产能力的土地的消失。[1]&nbsp;</div><div><br></div><div>从世界范围来看，在1994年通过的《联合国关于在发生严重干旱和/或荒漠化的国家特别是在非洲防治荒漠化的公约》中，荒漠化是指包括气候变异和人类活动在内的种种因素造成的干旱（arid）、半干旱（semi-arid ）和亚湿润干旱（dry subhumid）地区的土地退化。</div><div><br></div><div>该定义明确了3个问题：①“荒漠化”是在包括气候变异和人类活动在内的多种因素的作用下产生和发展的； ②“荒漠化”发生在干旱、半干旱及亚湿润干旱区（指年降水量与可能蒸散量（potential evapotranspiration）之比在0.05至0.65之间的地区，但不包括极区和副极区），这就给出了荒漠化产生的背景条件和分布范围；③“荒漠化”是发生在干旱、半干旱及亚湿润干旱区的土地退化，将荒漠化置于宽广的全球土地退化的框架内，从而界定了其区域范围。 [1]&nbsp;</div><div><br></div>', '病毒病毒病毒病毒病毒病毒病毒病毒病毒病毒病毒病毒', '一般一般', '88888888888888', '奖励说明：奖励是人民币，当面交易，请联系作者，电话156666666666', 5000, 2000, 1000, '2014-10-14 16:16:31', '2015-02-28 19:25:31'),
(4, '八仙花种植情况统计', 'playground', 1, 0, '八仙花（学名：Hydrangea macrophylla）又名绣球、紫阳花，为虎耳草科八仙花属植物。八仙花花洁白丰满，大而美丽，其花色能红能蓝，令人悦目怡神，是常见的盆栽观赏花木。', '八仙花为落叶灌木，小枝粗壮，皮孔明显。叶大而稍厚，对生，倒卵形，边缘有粗锯齿，叶面鲜绿色，叶背黄绿色，叶柄粗壮。花大型，由许多不孕花组成顶生伞房花序。<div><br></div><div>花色多变，初时白色，渐转蓝色或粉红色。高1-4米；茎常于基部发出多数放射枝而形成一圆形灌丛；枝圆柱形，粗壮，无毛，具少数长形皮孔。</div><div><br></div><div>叶纸质或近革质，近圆形或阔卵形，长1.4-2.4厘米，宽1-2.4厘米，粉红色、淡蓝色或白色；孕性花极少数，具2-4毫米长的花梗；萼筒倒圆锥状，长1.5-2毫米，与花梗疏被卷曲短柔毛，萼齿卵状三角形，长约1毫米；花瓣长圆形，长3-3.5毫米；雄蕊10枚，近等长，不突出或稍突出，花药长圆形，长约1毫米；子房大半下位，花柱3，结果时长约1.5毫米，柱头稍扩大，半环状。蒴果未成熟，长陀螺状，连花柱长约4.5毫米，顶端突出部分长约1毫米，约等于蒴果长度的1/3；种子未熟。花期6-8月。</div>', '', '很好，很NB', '叶纸质或近革质，近圆形或阔卵形，长1.4-2.4厘米，宽1-2.4厘米，粉红色、淡蓝色或白色；孕性花极少数，具2-4毫米长的花梗；萼筒倒圆锥状，长1.5-2毫米，与花梗疏被卷曲短柔毛，萼齿卵状三角形，长约1毫米；花瓣长圆形，长3-3.5毫米；雄蕊10枚，近等长，不突出或稍突出，花药长圆形，长约1毫米；子房大半下位，花柱3，结果时长约1.5毫米，柱头稍扩大，半环状。蒴果未成熟，长陀螺状，连花柱长约4.5毫米，顶端突出部分长约1毫米，约等于蒴果长度的1/3；种子未熟。花期6-8月。', '', 0, 0, 0, '2014-10-21 12:24:23', '2014-12-25 16:44:24'),
(5, '软体类水产养殖统计', 'playground', 1, 0, '水母，是水生环境[1] 中重要的浮游生物，属于刺丝胞动物。水母寿命很短，平均只有数个月的生命。水母是无脊椎动物，属于腔肠动物门中的一员。', '<div>水母，是水生环境[1] 中重要的浮游生物，属于刺丝胞动物。水母寿命很短，平均只有数个月的生命。</div><div><br></div><div>水母是无脊椎动物，属于腔肠动物门中的一员。全世界的水域中有超过两百种的水母，它们分布于全球各地的水域里。</div><div><br></div><div>水母的形状大小各不相同，最大的水母的触手可以延伸约十米远。 在分类上有些属于水螅纲，有些属于钵水母纲，其生活史中，几乎所有种类都有两型，即水螅型和水母型，并有两型在有性生殖与无性生殖之间的世代交现象，而我们常见到的水母，即是有性的水母型。</div><div><br></div>', '', '', '11111111111', '', 0, 0, 0, '2014-10-16 13:34:34', '2014-11-29 08:00:22'),
(6, '大众速腾断轴车主区域统计', 'playground', 1, 1, '大众汽车的一纸召回措施，并没能消除速腾后悬架断裂危机，随着速腾车主维权活动规模的持续扩大和展开，一场风暴已经悄然来袭。', '<div>近日，一部分新速腾车主决定通过其代理律师，以“行政不作为”为由将国家质检总局告上法庭，诉状日前已递交北京市第一中级人民法院[微博]。联名诉讼的车主请求法院判令国家质检总局履行法定监督职责对速腾召回措施组织专家进行评估，并将评估报告进行公示。</div><div><br></div><div>　　这意味着车主的不满情绪已经开始激化，并正在向着对抗的方向演变。“事情演变至此，这次速腾的召回已经成为了一场媒体、律师和非大众车主娱乐的盛宴。而大众用户、质检总局及大众汽车都成为了被消遣的对象。” 曾参与起草汽车召回法案的资深媒体人于童对理财周报记者说。</div><div><br></div><div>　　于是，在这样的“危急形势”下，一直被质疑沟通力度不够的大众中国开始走到前台，以空前规模几乎同时在全国各地召开沟通会，试图力证速腾产品的安全性，并从企业的角度给出了速腾车型之所以会发生断轴的原因。</div><div><br></div><div>　　“我们承认，在我们的售后服务检测流程当中，确实存在不完善的地方。”大众汽车集团(中国)公关传播部副总裁彭菲莉说，“由于先前的检修流程没有明确提示经销商要注意检测耦合杆式后悬架的纵臂，我们的经销商可能由此忽略对于经过撞击以后，可能发生弯曲的纵臂进行检测。因此消费者可能继续驾驶纵臂已经弯曲的车辆上路行驶，从而导致纵臂最终断裂。这才是我们这次召回的最主要的原因。”</div><div><br></div><div>　　大众汽车希望，通过这种强补“沟通课”的形式，在关于速腾召回一事的各种漫天讨论中，将属于自己的声音传播出去，从而达到“拨乱反正”的效果。</div>', '', '垃圾，狗屎', '<div>车主状告质检总局</div><div><br></div><div>　　就在本文进行撰写的时候，全国各地速腾车主的维权行动还在轰轰烈烈的上演着。据悉，近日，全国多个城市的速腾车主都自发组织了维权行动。目前，维权活动已波及潍坊、镇江、西安、沈阳、大连、成都、扬州等多个省市，这些车主均采用了围堵一汽大众总部、集结4S店门前、拉着横幅讨说法的做法，车主群情激昂、维权事件逐渐发酵。</div><div><br></div><div>　　据了解，速腾车主之所以会如此维权，与其不信任大众所提出的召回解决方案息息相关。根据大众汽车的召回措施，从2015年2月2日开始，大众在中国将为所有装配了耦合杆式后悬架的速腾车辆安装金属衬板。大众强调，该金属衬板的作用在于：安装金属衬板后，如果纵臂发生意外断裂，金属衬板可以保证车辆的行驶稳定性，并会发出持续的警示噪音，车主可继续将车辆安全驾驶至经销商处。“安装金属衬板是我们提供的全球统一的解决方案，不管在美国、中国还是其他国家，该方案都会实施。”大众强调。但是这一方案却没有得到消费者的普遍认可，被外界戏称为“打补丁”。</div><div><br></div>', '', 0, 0, 0, '2014-10-29 00:00:00', '2015-01-12 10:48:09'),
(7, '学挖掘机哪家强', 'getting-started', 1, 0, '蓝翔', 'Classify handwritten digits using the famous MNIST data', '', '', '1111111111111', '', 0, 0, 0, '2014-10-07 14:29:31', '2014-11-08 14:35:32'),
(8, '高级宠物用户养殖情况', 'getting-started', 0, 0, '树袋熊，又称考拉，是澳大利亚的国宝，也是澳大利亚奇特的珍贵原始树栖动物。英文名Koala bear来源于古代土著文字，意思是“no drink”。', '<div>澳大利亚是野生动物的天堂，成千上万的动物们在这里栖息和繁衍着，不管走到哪里都可以看到人与动物和谐相处的情景，可以说整个澳大利亚就是一个巨大的自然保护区和动植物博物馆。澳洲最具代表性的动物非袋鼠莫属，作为澳洲的标志，这种食草的有袋类动物成为了澳大利亚国徽上不可分割的组成部分。<br></div><div><br></div><div><br></div><div><br></div><div>树袋熊，又称考拉，是澳大利亚的国宝，也是澳大利亚奇特的珍贵原始树栖动物。英文名Koala bear来源于古代土著文字，意思是“no drink”。因为树袋熊从他们取食的桉树叶中获得所需的90%的水分，只在生病和干旱的时候喝水，当地人称它“克瓦勒”，意思也是“不喝水”。</div>', '', '', 'sdfdf', '', 0, 0, 0, '2014-10-16 12:20:35', '2014-11-21 16:32:36');

-- --------------------------------------------------------

--
-- 表的结构 `ka_files`
--

CREATE TABLE IF NOT EXISTS `ka_files` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `id_submission` int(11) NOT NULL,
  `name_file` varchar(100) NOT NULL,
  `size` int(11) NOT NULL,
  `description` text NOT NULL,
  `upload_time` datetime NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `ka_files`
--

INSERT INTO `ka_files` (`id_file`, `id_submission`, `name_file`, `size`, `description`, `upload_time`) VALUES
(10, 1, 'Linux培训.rar', 3950649, '', '2014-10-21 16:17:46'),
(9, 1, 'workspace.zip', 395533, '司的法规司的和法规和', '2014-10-21 16:18:23'),
(8, 1, 'jquery-ui-1.11.1.custom.zip', 409286, 'sdfgdsfghfgh', '2014-10-21 16:14:43'),
(11, 1, '购买页2.zip', 996090, '', '2014-10-21 16:20:25'),
(12, 9, '云平台2.rar', 603675, '', '2014-10-21 17:28:25'),
(13, 9, '云平台4.rar', 628711, 'asdgfsdghdf', '2014-10-21 17:28:41');

-- --------------------------------------------------------

--
-- 表的结构 `ka_submissions`
--

CREATE TABLE IF NOT EXISTS `ka_submissions` (
  `id_submission` int(11) NOT NULL AUTO_INCREMENT,
  `id_competition` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `checked` int(11) NOT NULL,
  `score` float NOT NULL,
  `description` text NOT NULL,
  `submission_time` datetime NOT NULL,
  PRIMARY KEY (`id_submission`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `ka_submissions`
--

INSERT INTO `ka_submissions` (`id_submission`, `id_competition`, `id_user`, `checked`, `score`, `description`, `submission_time`) VALUES
(1, 1, 1, 0, 60, '', '2014-11-04 13:27:33'),
(2, 1, 1, 0, 100, '阿萨德风格豆腐干', '2014-11-04 13:27:52'),
(3, 1, 3, 0, 60, '44444444444444444', '2014-11-05 16:54:25'),
(4, 1, 3, 0, 0, '', '2014-11-05 17:10:00'),
(5, 1, 5, 0, 20, '八个雅鹿', '2014-11-10 16:58:18'),
(6, 1, 6, 0, 50, '星条旗永不落', '2014-11-10 17:02:20'),
(7, 2, 6, 0, 0, '', '2014-11-10 17:10:51'),
(8, 1, 2, 0, 55, '', '2014-11-10 17:17:19'),
(9, 1, 9, 0, 89, '第一次结果提交', '2014-11-11 08:41:16'),
(10, 1, 1, 0, 0, '', '2014-11-17 10:13:09'),
(11, 1, 1, 0, 0, '', '2014-11-17 10:13:23'),
(12, 1, 1, 1, 0, '', '2014-11-17 15:03:07'),
(13, 1, 1, 1, 0, '', '2014-11-17 15:03:15'),
(14, 1, 1, 0, 0, '', '2014-11-17 15:03:21'),
(15, 1, 1, 0, 0, '', '2014-11-17 15:03:28'),
(16, 1, 1, 0, 0, '', '2014-11-17 15:10:04'),
(17, 1, 1, 0, 0, '', '2014-11-17 15:10:52'),
(18, 1, 1, 0, 0, '', '2014-11-17 15:11:08'),
(19, 1, 1, 0, 0, '', '2014-11-17 15:11:13'),
(20, 2, 1, 0, 0, '', '2014-11-17 15:21:47');

-- --------------------------------------------------------

--
-- 表的结构 `ka_teams`
--

CREATE TABLE IF NOT EXISTS `ka_teams` (
  `id_team` int(11) NOT NULL AUTO_INCREMENT,
  `name_team` varchar(100) NOT NULL,
  PRIMARY KEY (`id_team`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `ka_teams`
--

INSERT INTO `ka_teams` (`id_team`, `name_team`) VALUES
(1, '晓'),
(2, '十刃'),
(3, '护庭十三队');

-- --------------------------------------------------------

--
-- 表的结构 `ka_users`
--

CREATE TABLE IF NOT EXISTS `ka_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(100) NOT NULL,
  `is_leader` int(11) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  `name_user` varchar(100) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `legal_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rank` varchar(20) NOT NULL DEFAULT 'novice',
  `bio` text NOT NULL,
  `skill` text NOT NULL,
  `regist_time` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `ka_users`
--

INSERT INTO `ka_users` (`id_user`, `team`, `is_leader`, `email`, `name_user`, `display_name`, `legal_name`, `password`, `rank`, `bio`, `skill`, `regist_time`) VALUES
(1, '', 0, '267109925@qq.com', 'admin', '米克·艾格', '李沛新', '21585c6859d78f6313421b0defd6e29b', 'master', 'PHP程序员', 'PHP，汽车，篮球，自行车', '2014-11-01 00:00:00'),
(2, '木叶第七班', 1, 'mingren@huoying.com', 'mingren', '鸣人', '漩涡鸣人', '5d0a01776f9b42dee2edcf71fec6a047', 'novice', '拯救木叶', '螺旋丸', '2014-11-05 09:57:23'),
(3, '', 0, 'yihu@sishen.com', 'yihu', '一护', '黑崎一护', '5d0a01776f9b42dee2edcf71fec6a047', 'kaggler', '打败恋次，剑八，白哉，拯救露琪亚<br>\n打败格里姆乔，乌尔奇奥拉，拯救井上<br>\n打败蓝染，拯救空座市', '斩月\n卐解\n虚化\n月牙天冲', '2014-11-05 16:52:53'),
(4, '', 0, 'asdf@sdfd.csdf', 'asdf', 'adsf', '', '6a204bd89f3c8348afd5c77c717a097a', 'novice', '', '', '2014-11-07 12:29:56'),
(5, '', 0, 'anbei@riben.com', 'anbei', '安倍晋三', '', '5d0a01776f9b42dee2edcf71fec6a047', 'novice', '日本头目', '群嘲', '2014-11-10 16:56:30'),
(6, '', 0, 'aobama@usa.com', 'aobama', '奥巴马', '', '5d0a01776f9b42dee2edcf71fec6a047', 'novice', '美国皇帝', '', '2014-11-10 17:01:31'),
(7, '木叶第七班', 0, 'zuozhu@huoying.com', 'zuozhu', '佐助', '', '5d0a01776f9b42dee2edcf71fec6a047', 'novice', '', '', '2014-11-10 17:12:33'),
(8, '木叶第七班', 0, 'xiaoying@huoying.com', 'xiaoying', '小樱', '', '5d0a01776f9b42dee2edcf71fec6a047', 'novice', '', '', '2014-11-10 17:13:01'),
(9, '测试团队', 1, 'zouxu@longcredit.com', 'blesszou', '邹栩', '', '4016d6f4ff5dbd4a3f25b9d50643c838', 'novice', '', '', '2014-11-11 08:38:33'),
(10, '', 0, 'liushuhui@safe.longcredit.com', 'liushuhui', 'shuhui', '', '25d55ad283aa400af464c76d713c07ad', 'novice', '', '', '2014-11-11 09:31:14');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
