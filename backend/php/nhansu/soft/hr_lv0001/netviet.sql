/*
Navicat MySQL Data Transfer
Source Host     : localhost:3306
Source Database : test
Target Host     : localhost:3306
Target Database : test
Date: 2012-03-08 13:56:20
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for hr_lv0001
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0001`;
CREATE TABLE `hr_lv0001` (
  `lv001` char(10) NOT NULL DEFAULT '',
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` varchar(50) DEFAULT NULL,
  `lv006` varchar(100) DEFAULT NULL,
  `lv007` varchar(50) DEFAULT NULL,
  `lv008` varchar(20) DEFAULT NULL,
  `lv009` varchar(255) DEFAULT NULL,
  `lv010` char(10) DEFAULT NULL,
  `lv011` int(4) DEFAULT NULL,
  `lv012` char(6) DEFAULT NULL,
  `lv013` char(6) DEFAULT NULL,
  `lv014` varchar(32) DEFAULT NULL,
  `lv015` varchar(255) DEFAULT NULL,
  `lv016` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hr_lv0002
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0002`;
CREATE TABLE `hr_lv0002` (
  `lv001` char(10) NOT NULL DEFAULT '',
  `lv002` varchar(10) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0002
-- ----------------------------


-- ----------------------------
-- Table structure for hr_lv0003
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0003`;
CREATE TABLE `hr_lv0003` (
  `lv001` char(10) NOT NULL DEFAULT '',
  `lv002` date DEFAULT NULL,
  `lv003` date DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0003
-- ----------------------------
INSERT INTO `hr_lv0003` VALUES ('CYP001', '2008-12-12', '2009-04-30', 'Đánh giá lần 1');
INSERT INTO `hr_lv0003` VALUES ('CYP002', '2009-04-08', '2009-04-30', 'LE MINH');
INSERT INTO `hr_lv0003` VALUES ('CYP003', '2009-04-08', '2009-04-30', 'LE QUANG VINH');
INSERT INTO `hr_lv0003` VALUES ('CYP004', '2009-04-01', '2009-04-30', 'LE QUANG VINH');

-- ----------------------------
-- Table structure for hr_lv0004
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0004`;
CREATE TABLE `hr_lv0004` (
  `lv001` char(4) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0004
-- ----------------------------
INSERT INTO `hr_lv0004` VALUES ('ST01', 'Bán thời gian', 'Chỉ làm 1 buổi 4 tiếng');
INSERT INTO `hr_lv0004` VALUES ('ST02', 'Toàn thời gian', 'Làm việc 8 tiếng 1 ngày');
INSERT INTO `hr_lv0004` VALUES ('ST03', 'Làm theo vụ', 'Làm việc ký hợp đồng ngắn hạn');

-- ----------------------------
-- Table structure for hr_lv0005
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0005`;
CREATE TABLE `hr_lv0005` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0005
-- ----------------------------
INSERT INTO `hr_lv0005` VALUES ('JC0002', 'KHỐI NHÂN SỰ TIỀN LƯƠNG');
INSERT INTO `hr_lv0005` VALUES ('JC0001', 'KHỐI TÀI CHÍNH');
INSERT INTO `hr_lv0005` VALUES ('JC0003', 'KHỐI XƯỞNG SẢN XUẤT');
INSERT INTO `hr_lv0005` VALUES ('JC0004', 'KHỐI QUẢN TRỊ SẢN XUẤT');
INSERT INTO `hr_lv0005` VALUES ('JC0005', 'MÔI TRƯỜNG VÀ VỆ SINH');
INSERT INTO `hr_lv0005` VALUES ('JC0006', 'BẢO VỆ VÀ AN TOÀN');
INSERT INTO `hr_lv0005` VALUES ('JC0007', 'BẢO TRÌ VÀ SỬA CHỮA');
INSERT INTO `hr_lv0005` VALUES ('JC0008', 'LÁI XE VÀ BẢO QUẢN XE');
INSERT INTO `hr_lv0005` VALUES ('JC0009', 'ĐÓNG GÓI SẢN PHẨM HOÀN TẤT');

-- ----------------------------
-- Table structure for hr_lv0006
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0006`;
CREATE TABLE `hr_lv0006` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(50) DEFAULT NULL,
  `lv004` decimal(28,1) DEFAULT NULL,
  `lv005` decimal(28,1) DEFAULT NULL,
  `lv006` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0006
-- ----------------------------
INSERT INTO `hr_lv0006` VALUES ('SL0001', 'MỨC LƯƠNG 2', 'CUR001', '1200000.0', '3000000.0', '10.00');
INSERT INTO `hr_lv0006` VALUES ('SL0002', 'Mức lương 1', 'CUR002', '1800000.0', '2800000.0', '10.00');

-- ----------------------------
-- Table structure for hr_lv0007
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0007`;
CREATE TABLE `hr_lv0007` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  `lv004` varchar(500) DEFAULT NULL,
  `lv005` char(6) DEFAULT NULL,
  `lv006` char(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0007
-- ----------------------------
INSERT INTO `hr_lv0007` VALUES ('JB0001', 'QUẢN LÝ NHÂN SỰ', 'TUYỂN NHÂN SỰ VÀ GIẢI QUYẾT CHÍNH SÁCH CÔNG TY VỀ THUẾ VÀ LƯƠNG.', 'TEST', 'SL0001', 'ST01,ST02');
INSERT INTO `hr_lv0007` VALUES ('JB0002', 'KẾ HOẠCH SẢN XUẤT', '', '', 'SL0001', 'ST02');
INSERT INTO `hr_lv0007` VALUES ('JB0003', 'QUẢN LÝ IT', 'LÀM CÔNG VIỆC NGHIÊN CỨU VÀ PHÁT TRIỂN PHẦN MỀM', '', 'SL0001', 'ST01,ST02,ST03');
INSERT INTO `hr_lv0007` VALUES ('JB0004', 'TẠP VỤ', 'LAO DỌN NHÀ XƯỞNG VÀ KHU VỰC HÀNH LANG CÔNG TY.', '', '', 'ST01,ST02');
INSERT INTO `hr_lv0007` VALUES ('JB0005', 'BẢO VỆ VÀ KIỂM TRA RA VÀO', 'BẢO VỆ AN TOÀN CÔNG TY, KIỂM TRA RA VÀO NHÂN VIÊN VÀ TÀI RIÊNG CÁ NHÂN VÀ TÀI SẢN CHUNG CÔNG TY.\r\nCHỊU TRÁCH NHIỆM TRƯỚC CÔNG TY VỀ AN TOÀN CÔNG TY', '', 'SL0002', 'ST02');
INSERT INTO `hr_lv0007` VALUES ('JB0006', 'BẢO TRÌ & SỬA CHỮA MÁY MÓC THIẾT BỊ', 'ĐẢM BẢO VIỆC KHẮC PHỤ SỰ CỐ MÁY MÓC NHANH CHÓNG. SỬA CHỬA CHUYÊN MÔN.', '', '', 'ST01,ST02');
INSERT INTO `hr_lv0007` VALUES ('JB0007', 'TÀI XẾ LÁI XE', 'CHỊU TRÁCH NHIỆM LÁI XE VÀ ĐẢM BẢO AN TOÀN CHO NGƯỜI VÀ XE', '', 'SL0002', 'ST02');
INSERT INTO `hr_lv0007` VALUES ('JB0008', 'SẢN XUẤT THEO CHUYỀN', '', '', 'SL0002', 'ST02');
INSERT INTO `hr_lv0007` VALUES ('JB0009', 'KẾ TOÁN KHO', 'QUẢN LÝ KHO XUẤT NHẬP VA KIỂM KÊ KHO BÁO CÁO TỪ THỦ KHO', 'QUẢN LÝ KHO XUẤT NHẬP VA KIỂM KÊ KHO BÁO CÁO TỪ THỦ KHO', '', 'ST02');
INSERT INTO `hr_lv0007` VALUES ('JB0010', 'KẾ TOÁN TỔNG HỢP', '', '', '', 'ST02');
INSERT INTO `hr_lv0007` VALUES ('JB0011', 'QUẢN LÝ PHÒNG KẾ TOÁN', 'ĐIỀU PHỐI CÔNG VIỆC CỦA NHÂN VIÊN DƯỚI QUYỀN, CHỊU TRÁCH NHIỆM TOÀN BỘ VỀ KẾ TOÁN CÔNG TY', 'ĐIỀU PHỐI CÔNG VIỆC CỦA NHÂN VIÊN DƯỚI QUYỀN, CHỊU TRÁCH NHIỆM TOÀN BỘ VỀ KẾ TOÁN CÔNG TY', '', 'ST02');
INSERT INTO `hr_lv0007` VALUES ('JB0012', ' ', '', '', 'SL0002', 'ST02');

-- ----------------------------
-- Table structure for hr_lv0008
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0008`;
CREATE TABLE `hr_lv0008` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0008
-- ----------------------------
INSERT INTO `hr_lv0008` VALUES ('LC0001', 'Cử nhân 4 năm');
INSERT INTO `hr_lv0008` VALUES ('LC0002', 'Giấy phép lái xe');
INSERT INTO `hr_lv0008` VALUES ('LC0003', 'Cử nhân 3 năm');
INSERT INTO `hr_lv0008` VALUES ('LC0004', 'Bằng nghề');
INSERT INTO `hr_lv0008` VALUES ('LC0005', 'Tốt nghiệp 12/12');
INSERT INTO `hr_lv0008` VALUES ('LC0006', 'Dưới 12/12');
INSERT INTO `hr_lv0008` VALUES ('LC0007', 'Trung cấp');
INSERT INTO `hr_lv0008` VALUES ('LC0008', 'Chứng chỉ');
INSERT INTO `hr_lv0008` VALUES ('LC0009', 'Tin học A');
INSERT INTO `hr_lv0008` VALUES ('LC0010', 'Tin học B');
INSERT INTO `hr_lv0008` VALUES ('LC0011', 'Anh Văn B');
INSERT INTO `hr_lv0008` VALUES ('LC0012', 'Anh Văn C');
INSERT INTO `hr_lv0008` VALUES ('LC0013', 'Anh Văn A');

-- ----------------------------
-- Table structure for hr_lv0009
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0009`;
CREATE TABLE `hr_lv0009` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  `lv004` varchar(50) DEFAULT NULL,
  `lv005` varchar(50) DEFAULT NULL,
  `lv006` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0009
-- ----------------------------
INSERT INTO `hr_lv0009` VALUES ('ED0001', 'ĐẠI HỌC CÔNG NGHIỆP TP HCM', '12 Nguyễn Văn Bảo Go Vấp, TP HCM', '08.5443243-(08.54354333)', '08.3535435', 'Chú ý');
INSERT INTO `hr_lv0009` VALUES ('ED0002', 'CAO ĐẲNG ĐẠI HỌC KINH TẾ TP HCM', 'NGUYỄN ĐÌNH CHIỂU-Q2-TP. HCM', '08.6546546', '08.8686645', '');
INSERT INTO `hr_lv0009` VALUES ('ED0003', 'ĐẠI HỌC KINH TẾ QUỐC DÂN', '12 TEST', '231231', '1212432123', 'Chú ý');
INSERT INTO `hr_lv0009` VALUES ('ED0004', 'ĐẠI HỌC MARKETING TP.HCM', 'Số 306 Nguyễn Trọng Tuyển, P.1, Q.Tân Bình. TP.HCM', '08.9970941', '08.9971065', 'phongqldt@vnmu.edu.vn -- DT:9970940- 8457401');
INSERT INTO `hr_lv0009` VALUES ('ED0005', 'CAO ĐẲNG TÀI CHÍNH HẢI QUAN', 'B2/1A Đường 385 - Phường Tăng Nhơn Phú A - Quận 9 - TP.HCM', '(08)37307573', '(08)37307567 ', 'Email: upload@tchq.edu.vn website: http://www.tchq');
INSERT INTO `hr_lv0009` VALUES ('ED0006', 'Trường Cao đẳng Công thương TP. Hồ Chí Minh', 'Số 20 Tăng Nhơn Phú, phường Phước Long B, Q.9, TP. Hồ Chí Minh', '(08)37312370', '', '');
INSERT INTO `hr_lv0009` VALUES ('ED0007', 'CAO ĐẲNG KINH TẾ TP HCM', '', '', '', '');
INSERT INTO `hr_lv0009` VALUES ('ED0008', 'ĐẠI HỌC TÀI CHÍNH KẾ TOÁN TPHCM', '', '', '', '');
INSERT INTO `hr_lv0009` VALUES ('ED0009', 'ĐẠI HỌC GIAO THÔNG VẬN TẢI TP HCM', ' 2 đường D3, Văn Thánh Bắc, P. 25, Q. Bình Thạnh, Tp. HCM.', '(08)38992862', '(08)38980456 ', ' ut-hcmc@hcmutrans.edu.vn ');
INSERT INTO `hr_lv0009` VALUES ('ED0010', 'ĐẠI HỌC CÔNG NGHIỆP THỰC PHẨM', '140 Lê Trọng Tấn, P. Tây Thạnh, Q. Tân Phú, Tp. HCM', '08.38161673', '', 'cntp@cntp.edu.vn');
INSERT INTO `hr_lv0009` VALUES ('ED0011', 'ĐẠI HỌC DUY TÂN', 'Đà Nẳng', '', '', '');
INSERT INTO `hr_lv0009` VALUES ('ED0012', 'ĐẠI HỌC NGOẠI NGỮ TIN HỌC THÀNH PHỐ HỒ CHÍ MINH', '155 Sư Vạn Hạnh (nd), phường 13, Quận 10, TP. HCM', '(848)38632052', '(848)38650991', '');

-- ----------------------------
-- Table structure for hr_lv0010
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0010`;
CREATE TABLE `hr_lv0010` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0010
-- ----------------------------
INSERT INTO `hr_lv0010` VALUES ('SK0001', 'ĐÁNH MÁY');

-- ----------------------------
-- Table structure for hr_lv0011
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0011`;
CREATE TABLE `hr_lv0011` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0011
-- ----------------------------
INSERT INTO `hr_lv0011` VALUES ('LG0001', 'TIẾNG ANH');
INSERT INTO `hr_lv0011` VALUES ('LG0002', 'Tiếng Pháp');
INSERT INTO `hr_lv0011` VALUES ('LG0003', 'Hoa');

-- ----------------------------
-- Table structure for hr_lv0012
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0012`;
CREATE TABLE `hr_lv0012` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0012
-- ----------------------------
INSERT INTO `hr_lv0012` VALUES ('ME0001', 'Chính phủ');
INSERT INTO `hr_lv0012` VALUES ('ME0002', 'Tôn giáo');
INSERT INTO `hr_lv0012` VALUES ('ME0003', 'Thể thao');
INSERT INTO `hr_lv0012` VALUES ('ME0004', 'Khoa học');

-- ----------------------------
-- Table structure for hr_lv0013
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0013`;
CREATE TABLE `hr_lv0013` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0013
-- ----------------------------
INSERT INTO `hr_lv0013` VALUES ('MS0001', 'Bóng đá', 'ME0003');

-- ----------------------------
-- Table structure for hr_lv0014
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0014`;
CREATE TABLE `hr_lv0014` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0014
-- ----------------------------
INSERT INTO `hr_lv0014` VALUES ('NL0001', 'VIỆT NAM');
INSERT INTO `hr_lv0014` VALUES ('NL0002', 'AFGHANISTAN');
INSERT INTO `hr_lv0014` VALUES ('NL0003', 'ALBANIA');
INSERT INTO `hr_lv0014` VALUES ('NL0004', 'ALGERIA');
INSERT INTO `hr_lv0014` VALUES ('NL0005', 'AMERICAN SAMOA');
INSERT INTO `hr_lv0014` VALUES ('NL0006', 'ANDORRA');
INSERT INTO `hr_lv0014` VALUES ('NL0007', 'ANGOLA');
INSERT INTO `hr_lv0014` VALUES ('NL0008', 'ANGUILLA');
INSERT INTO `hr_lv0014` VALUES ('NL0009', 'ANTARCTICA');
INSERT INTO `hr_lv0014` VALUES ('NL0010', 'ANTIGUA AND BARBUDA');
INSERT INTO `hr_lv0014` VALUES ('NL0011', 'ARGENTINA');
INSERT INTO `hr_lv0014` VALUES ('NL0012', 'ARMENIA');
INSERT INTO `hr_lv0014` VALUES ('NL0013', 'ARUBA');
INSERT INTO `hr_lv0014` VALUES ('NL0014', 'AUSTRALIA');
INSERT INTO `hr_lv0014` VALUES ('NL0015', 'AUSTRIA');
INSERT INTO `hr_lv0014` VALUES ('NL0016', 'AZERBAIJAN');
INSERT INTO `hr_lv0014` VALUES ('NL0017', 'BAHAMAS');
INSERT INTO `hr_lv0014` VALUES ('NL0018', 'BAHRAIN');
INSERT INTO `hr_lv0014` VALUES ('NL0019', 'BANGLADESH');
INSERT INTO `hr_lv0014` VALUES ('NL0020', 'BARBADOS');
INSERT INTO `hr_lv0014` VALUES ('NL0021', 'BELARUS');
INSERT INTO `hr_lv0014` VALUES ('NL0022', 'B���');
INSERT INTO `hr_lv0014` VALUES ('NL0023', 'BELIZE');
INSERT INTO `hr_lv0014` VALUES ('NL0024', 'BENIN');
INSERT INTO `hr_lv0014` VALUES ('NL0025', 'BERMUDA');
INSERT INTO `hr_lv0014` VALUES ('NL0026', 'BHUTAN');
INSERT INTO `hr_lv0014` VALUES ('NL0027', 'BOLIVIA');
INSERT INTO `hr_lv0014` VALUES ('NL0028', 'BOSNIA AND HERZEGOWINA');
INSERT INTO `hr_lv0014` VALUES ('NL0029', 'BOTSWANA');
INSERT INTO `hr_lv0014` VALUES ('NL0030', 'BOUVET ISLAND');
INSERT INTO `hr_lv0014` VALUES ('NL0031', 'BRAZIL');
INSERT INTO `hr_lv0014` VALUES ('NL0032', 'BRITISH INDIAN OCEAN TERRITORY');
INSERT INTO `hr_lv0014` VALUES ('NL0033', 'BRUNEI DARUSSALAM');
INSERT INTO `hr_lv0014` VALUES ('NL0034', 'BULGARIA');
INSERT INTO `hr_lv0014` VALUES ('NL0035', 'BURKINA FASO');
INSERT INTO `hr_lv0014` VALUES ('NL0036', 'BURUNDI');
INSERT INTO `hr_lv0014` VALUES ('NL0037', 'CAMBODIA');
INSERT INTO `hr_lv0014` VALUES ('NL0038', 'CAMEROON');
INSERT INTO `hr_lv0014` VALUES ('NL0039', 'CANADA');
INSERT INTO `hr_lv0014` VALUES ('NL0040', 'CAPE VERDE');
INSERT INTO `hr_lv0014` VALUES ('NL0041', 'CAYMAN ISLANDS');
INSERT INTO `hr_lv0014` VALUES ('NL0042', 'CENTRAL AFRICAN REPUBLIC');
INSERT INTO `hr_lv0014` VALUES ('NL0043', 'CHAD');
INSERT INTO `hr_lv0014` VALUES ('NL0044', 'CHILE');
INSERT INTO `hr_lv0014` VALUES ('NL0045', 'CHINA');
INSERT INTO `hr_lv0014` VALUES ('NL0046', 'CHRISTMAS ISLAND');
INSERT INTO `hr_lv0014` VALUES ('NL0047', 'COCOS (KEELING) ISLANDS');
INSERT INTO `hr_lv0014` VALUES ('NL0048', 'COLOMBIA');
INSERT INTO `hr_lv0014` VALUES ('NL0049', 'COMOROS');
INSERT INTO `hr_lv0014` VALUES ('NL0050', 'CONGO');
INSERT INTO `hr_lv0014` VALUES ('NL0051', 'COOK ISLANDS');
INSERT INTO `hr_lv0014` VALUES ('NL0052', 'COSTA RICA');
INSERT INTO `hr_lv0014` VALUES ('NL0053', 'COTE D\'IVOIRE');
INSERT INTO `hr_lv0014` VALUES ('NL0054', 'CROATIA');
INSERT INTO `hr_lv0014` VALUES ('NL0055', 'CUBA');
INSERT INTO `hr_lv0014` VALUES ('NL0056', 'CYPRUS');
INSERT INTO `hr_lv0014` VALUES ('NL0057', 'CZECH REPUBLIC');
INSERT INTO `hr_lv0014` VALUES ('NL0058', 'DENMARK');
INSERT INTO `hr_lv0014` VALUES ('NL0059', 'DJIBOUTI');
INSERT INTO `hr_lv0014` VALUES ('NL0060', 'DOMINICA');
INSERT INTO `hr_lv0014` VALUES ('NL0061', 'DOMINICAN REPUBLIC');

-- ----------------------------
-- Table structure for hr_lv0015
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0015`;
CREATE TABLE `hr_lv0015` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0015
-- ----------------------------
INSERT INTO `hr_lv0015` VALUES ('ETH001', 'DA VÀNG');
INSERT INTO `hr_lv0015` VALUES ('ETH002', 'DA TRẮNG');
INSERT INTO `hr_lv0015` VALUES ('ETH003', 'DA ĐEN');

-- ----------------------------
-- Table structure for hr_lv0016
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0016`;
CREATE TABLE `hr_lv0016` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0016
-- ----------------------------
INSERT INTO `hr_lv0016` VALUES ('NA0002', 'TÀY');
INSERT INTO `hr_lv0016` VALUES ('NA0001', 'KINH');
INSERT INTO `hr_lv0016` VALUES ('NA0003', 'THÁI');
INSERT INTO `hr_lv0016` VALUES ('NA0004', 'MƯỜNG');
INSERT INTO `hr_lv0016` VALUES ('NA0005', 'HOA');
INSERT INTO `hr_lv0016` VALUES ('NA0006', 'KHƠ-ME');
INSERT INTO `hr_lv0016` VALUES ('NA0007', 'NÙNG');
INSERT INTO `hr_lv0016` VALUES ('NA0008', 'MÔNG');
INSERT INTO `hr_lv0016` VALUES ('NA0009', 'DAO');
INSERT INTO `hr_lv0016` VALUES ('NA0010', 'GIA-RAI');
INSERT INTO `hr_lv0016` VALUES ('NA0011', 'Ê-ĐÊ');
INSERT INTO `hr_lv0016` VALUES ('NA0012', 'BA-NA');
INSERT INTO `hr_lv0016` VALUES ('NA0013', 'SÁN CHAY');
INSERT INTO `hr_lv0016` VALUES ('NA0014', 'CHĂM');
INSERT INTO `hr_lv0016` VALUES ('NA0015', 'XƠ-ĐĂNG');
INSERT INTO `hr_lv0016` VALUES ('NA0016', 'SÁN DÌU');
INSERT INTO `hr_lv0016` VALUES ('NA0017', 'HRE');
INSERT INTO `hr_lv0016` VALUES ('NA0018', 'CO-HO');
INSERT INTO `hr_lv0016` VALUES ('NA0019', 'GA-GLAI');
INSERT INTO `hr_lv0016` VALUES ('NA0020', 'MNÔNG');
INSERT INTO `hr_lv0016` VALUES ('NA0021', 'THỔ');
INSERT INTO `hr_lv0016` VALUES ('NA0022', 'XTIÊNG');
INSERT INTO `hr_lv0016` VALUES ('NA0023', 'KHƠMÚ');
INSERT INTO `hr_lv0016` VALUES ('NA0024', 'BRU-VÂN KIỀU');
INSERT INTO `hr_lv0016` VALUES ('NA0025', 'GIÁY');
INSERT INTO `hr_lv0016` VALUES ('NA0026', 'CƠ-TU');
INSERT INTO `hr_lv0016` VALUES ('NA0027', 'GIÉ-TRIÊNG');
INSERT INTO `hr_lv0016` VALUES ('NA0028', 'TA-ÔI');
INSERT INTO `hr_lv0016` VALUES ('NA0029', 'MẠ');
INSERT INTO `hr_lv0016` VALUES ('NA0030', 'CO');
INSERT INTO `hr_lv0016` VALUES ('NA0031', 'CHƠ-RO');
INSERT INTO `hr_lv0016` VALUES ('NA0032', 'HÀ NHI');
INSERT INTO `hr_lv0016` VALUES ('NA0033', 'XINH-MUN');
INSERT INTO `hr_lv0016` VALUES ('NA0034', 'CHU-RU');
INSERT INTO `hr_lv0016` VALUES ('NA0035', 'LÀO');
INSERT INTO `hr_lv0016` VALUES ('NA0036', 'LA-CHÍ');
INSERT INTO `hr_lv0016` VALUES ('NA0037', 'PHÙ LÁ');
INSERT INTO `hr_lv0016` VALUES ('NA0038', 'LA HỦ');
INSERT INTO `hr_lv0016` VALUES ('NA0039', 'KHÁNG');
INSERT INTO `hr_lv0016` VALUES ('NA0040', 'LỰ');
INSERT INTO `hr_lv0016` VALUES ('NA0041', 'PÀ THẺN');
INSERT INTO `hr_lv0016` VALUES ('NA0042', 'LÔLÔ');
INSERT INTO `hr_lv0016` VALUES ('NA0043', 'CHỨT');
INSERT INTO `hr_lv0016` VALUES ('NA0044', 'MẢNG');
INSERT INTO `hr_lv0016` VALUES ('NA0045', 'CỜ LAO');
INSERT INTO `hr_lv0016` VALUES ('NA0046', 'BỐ Y');
INSERT INTO `hr_lv0016` VALUES ('NA0047', 'LA HA');
INSERT INTO `hr_lv0016` VALUES ('NA0048', 'CỐNG');
INSERT INTO `hr_lv0016` VALUES ('NA0049', 'NGÁI');
INSERT INTO `hr_lv0016` VALUES ('NA0050', 'SI LA');
INSERT INTO `hr_lv0016` VALUES ('NA0051', 'PU PÉO');
INSERT INTO `hr_lv0016` VALUES ('NA0052', 'BRÂU');
INSERT INTO `hr_lv0016` VALUES ('NA0053', 'RƠ-MĂM');
INSERT INTO `hr_lv0016` VALUES ('NA0054', 'Ơ-ĐU');

-- ----------------------------
-- Table structure for hr_lv0017
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0017`;
CREATE TABLE `hr_lv0017` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0017
-- ----------------------------
INSERT INTO `hr_lv0017` VALUES ('REL003', 'ĐẠO THIÊN CHÚA');
INSERT INTO `hr_lv0017` VALUES ('REL002', 'ĐẠO PHẬT');
INSERT INTO `hr_lv0017` VALUES ('REL001', 'KHÔNG');
INSERT INTO `hr_lv0017` VALUES ('REL004', 'ĐẠO TIN LÀNH');
INSERT INTO `hr_lv0017` VALUES ('REL005', 'ĐẠO HỒI');
INSERT INTO `hr_lv0017` VALUES ('REL006', 'ĐẠO HÒA HẢO');
INSERT INTO `hr_lv0017` VALUES ('REL007', 'ĐẠO CAO ĐÀI');
INSERT INTO `hr_lv0017` VALUES ('REL008', 'CÔNG GIÁO');

-- ----------------------------
-- Table structure for hr_lv0018
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0018`;
CREATE TABLE `hr_lv0018` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` decimal(18,1) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0018
-- ----------------------------
INSERT INTO `hr_lv0018` VALUES ('VND', 'VNĐ', '1.0');
INSERT INTO `hr_lv0018` VALUES ('USD', '$', '20800.0');

-- ----------------------------
-- Table structure for hr_lv0019
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0019`;
CREATE TABLE `hr_lv0019` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  `lv004` varchar(50) DEFAULT NULL,
  `lv005` varchar(50) DEFAULT NULL,
  `lv006` varchar(255) DEFAULT NULL,
  `lv007` char(6) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0019
-- ----------------------------
INSERT INTO `hr_lv0019` VALUES ('446', 'PHÒNG KHÁM ĐA KHOA MINH ĐỨC\r\n', '34 - 35 đường số 11 khu dân cư Bình Phú – Phường 10 – Quận 6', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('054', 'BỆNH VIỆN QUẬN TÂN PHÚ', '34 Trần Văn Giáp – P. Hiệp Tân - Quận Tân Phú', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('051', 'Bệnh viện quận 1 - cơ sở 1', '338 Hai bà trưng, P Tân định, Quận 1', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('004', 'Bệnh viện quận1 - Cơ sở 2', '29A Cao Bá Nhạ - Quận 1', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('075', 'Bệnh viện quận 2', '130 Lê Văn Thịnh - P. Bình Hưng Tây - Quận 2', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('009', 'Bệnh viện quận 3', '114-116 Trần quốc Thảo, phường 7, Quận 3', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('010', 'Bệnh viện quận 4', '65 Bến Vân Đồn - P.12 - Quận 4', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('015', 'Bệnh viện quận 5', '644 Nguyễn Trãi - P.11 - Quận 5', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('017', 'Bệnh viện quận 6', 'A14/1 Cư xá Phú Lâm - P13 - Quận 6', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('019', 'Bệnh viện quận 7', '101 Nguyễn Thị Thập - Tân Phú - Quận 7', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('021', 'Bệnh viện quận 8', '82 Cao Lỗ - Phường 4 - Quận 8', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('053', 'bệnh viện quận 8 - phòng khám xóm cuỉ', '379 Tùng Thiện Vương, p 12, Quận 8', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('052', 'Bệnh viện quận 8 ( phòng khám Rạch Cát)', '160 Mễ Cốc, P15, Quận 8', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('022', 'Bệnh viện quận 9', 'Lê Văn Việt, Khu phố 2, P. Tăng Nhơn Phú - Quận9', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('027', 'Bệnh viện quận 10', '115/C5 Sư vạn Hạnh nôí dài, Phường 13, Quận 10 ', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('028', 'Bệnh viện quận 11', '72 đường số 5, phường 8, quận 11', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('029', 'Bệnh viện quận 12', 'Ngã Ba Bầu, Tân Chánh Hiệp, Quận 12', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('031', 'Bệnh viện quận Bình thạnh', '112 Đinh Tiên Hoàng, Phường 11, Quận Bình Thạnh', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('035', 'Bệnh viện quận Gò Vấp', '212 Lê Đức Thọ, P 15, Quận Gò Vấp', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('032', 'Bệnh viện quận Phú Nhuận', '250 Nguyễn Trọng Tuyển, Phường 8, Quận Phú Nhuận', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('033', 'Bệnh viện quận Tân Bình', '605 Hoàng Văn Thụ, p4, Quận Tân Bình', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('037', 'Bệnh viện Quận Thủ Đức', '29 Phú Châu, Tam Bình, Q. Thủ Đức', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('460', 'Bệnh viện FV', '06 Nguyễn Lương Bằng, P Tân Phú, Quận 7', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('465', 'Phòng Khám Đa Khoa Thánh Mẫu', '25/2 Bành văn Trân, P7, Quận Tân Bình', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('467', 'phòng khám Đa khoa An Khang', '87A Cách Mạng tháng 8 - Phường Bến Thành, Quận 1', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('466', 'Phòng khám Đa Khoa Khu Công Nghiệp Tân Bình', 'Lô II 6 cụm 02 Lê Trọng Tấn, P. Tây Thạnh, Quận Tân Phú ', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('059', 'Phòng khám đa khoa Sài Gòn', '3A 35tỉnh lộ 10 (Bà hom nôí dài) xã phạm văn Hai, H. Bình Chánh', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('060', 'Phòng khám đa khoa Phước An (cơ sở 1)', '473 Sư Vạn Hạnh (nôí dài) - P12 - Quận 10', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('457', 'Phòng khám đa khoa Phước an ( cơ sở 2)', '441-443 Nguyễn thị Tú, Phường Bình Hưng Hoà B, Quận Bình Tân', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('456', 'Phòng khám Đa khoa Minh Đức', '34-35 Đường số 11 khu Dân Cư Bình Phú, P 10, Quận 6', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('459', 'Phòng khám đa khoa Lạc Long Quân', '928 Lạc Long Quân, Phường 8, QuậnTân Bình', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('548', 'Phòng khám Đa khoa Triệu Phước', '116-117-118 Lô K đường số 6 cư xá Bình Thới, phường 8, Quận 11', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('481', 'Phòng khám đa khoa Net Vạn Phúc ', '282 Phú Thọ Hoà, P. Phú Thọ Hoà, Quận Tân Phú', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('005', 'Phòng khám đa khoa Hồng Châu II ', '87 Quốc lộ 13, P Hiệp Bình Chánh, Quận thủ Đức', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('006', 'Phòng khám đa khoa Phước Sơn II', '258 Tô Ngọc Vân - P. Linh Đông, Quận Thủ Đức', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('007', 'Phòng khám đa khoa Liên Tâm', '67 Liên Tỉnh 5 - Phường 5 - Quận 8', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('002', 'Phòng khám TTYK Kỳ Hoà', '266-268 Đường 3/2 - Phường 12 - Quận 10', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('003', 'Phòng Khám Đa khoa Cộng Hoà', '63 Lê Trọng Tấn - P. Sơn Kỳ, Quận Tân Phú', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('047', 'Phòng khám đa khoa Kiều Tiên', '323-325 Lê Quang Định - Phường 5 - Quận Bình Thạnh', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('562', 'phòng Khám Đa khoa Vì Dân', '11 Bis Đinh Bộ Lĩnh, P 24, Quận BìnhThạnh', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('462', 'Bệnh viện đa khoa Vạnh Hạnh', '72-74 Sư Vạn Hạnh ( nối) - P12 Quận 10', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('046', 'Phòng khám đa khoa KCN Lê Minh Xuân', 'khu CN Lê Minh Xuân, Tân tạo, Huyện Bình Chánh', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('050', 'Phòng khám ĐK KCN Tân Tạo', 'Lô 16-02 KHu Công Nghiệp Tân tạo, Huyện Bình Chánh', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('018', 'Phòng khám đa khoa KCX Tân Thuận', 'Phường tân thuận Đông, Quận 7', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('012', 'Bệnh viện An Bình', '146 An Bình, P7, Quận 5', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('030', 'Bệnh Viện Nhân dân Gia Định', '01 Nơ Trang Long - phường 14 - Quận BìnhThạnh', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('013', 'Bệnh viện Nguyễn Tri Phương', '468 Nguyễn Trãi, Phường 8 - Quận 5', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('026', 'Bệnh Viện Cấp Cưú Trưng Vương', '266 Lý Thường Kiệt, P14, Quận 10', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('001', 'Bệnh viện đa khoa Sài Gòn', '125 Lê Lợi - Phường bến Thành, Quận 1 ', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('020', 'Bệnh viện Điều Dưỡng PHCN Điều Trị Bệnh Nghề Nghiệp', '125/61 Âu Dương Lân, Phường 2, Quận 8', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('034', 'Bệnh Viện 175', '786 Nguyễn Kiệm , P 3. Quận Gò Vấp', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('	\r\n\r\n0', 'Bệnh viện 30-4 ', '09 Sư Vạn Hạnh - P.9 - Quận 5', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('014', 'Bệnh viện Nguyễn Trãi', '314 NGuyễn Trãi, Phường 8, Quận 5', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('024', 'Bệnh viện Nhân Viên 115', '88 Thành Thái, Phường 12, Quận 10', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('016', 'Bệnh Viện quân Y 7A', '466 Nguyễn Trãi, Phường 8, Quận 5', '', '', '', 'PR028');
INSERT INTO `hr_lv0019` VALUES ('025', 'Bệnh viện Thống Nhất', '01 Lý Thường Kiệt, Phường 7, Quận Tân Bình', '', '', '', 'PR028');

-- ----------------------------
-- Table structure for hr_lv0020
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0020`;
CREATE TABLE `hr_lv0020` (
  `lv001` char(20) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` varchar(50) DEFAULT NULL,
  `lv006` varchar(100) DEFAULT NULL,
  `lv007` varchar(50) DEFAULT NULL,
  `lv008` varchar(20) DEFAULT NULL,
  `lv009` char(10) DEFAULT NULL,
  `lv010` char(15) DEFAULT NULL,
  `lv011` date DEFAULT NULL,
  `lv012` varchar(50) DEFAULT NULL,
  `lv013` varchar(500) DEFAULT NULL,
  `lv014` varchar(500) DEFAULT NULL,
  `lv015` date DEFAULT NULL,
  `lv016` varchar(255) DEFAULT NULL,
  `lv017` char(6) DEFAULT NULL,
  `lv018` tinyint(1) DEFAULT NULL,
  `lv019` tinyint(1) DEFAULT NULL,
  `lv020` varchar(15) DEFAULT NULL,
  `lv021` date DEFAULT NULL,
  `lv022` char(6) DEFAULT NULL,
  `lv023` char(6) DEFAULT NULL,
  `lv024` char(6) DEFAULT NULL,
  `lv025` char(6) DEFAULT NULL,
  `lv026` char(6) DEFAULT NULL,
  `lv027` char(6) DEFAULT NULL,
  `lv028` char(6) DEFAULT NULL,
  `lv029` char(10) DEFAULT NULL,
  `lv030` date DEFAULT NULL,
  `lv031` char(6) DEFAULT NULL,
  `lv032` char(6) DEFAULT NULL,
  `lv033` varchar(50) DEFAULT NULL,
  `lv034` varchar(500) DEFAULT NULL,
  `lv035` varchar(500) DEFAULT NULL,
  `lv036` varchar(10) DEFAULT NULL,
  `lv037` varchar(50) DEFAULT NULL,
  `lv038` varchar(50) DEFAULT NULL,
  `lv039` varchar(20) DEFAULT NULL,
  `lv040` varchar(100) DEFAULT NULL,
  `lv041` varchar(100) DEFAULT NULL,
  `lv042` varchar(500) DEFAULT NULL,
  `lv043` varchar(255) DEFAULT NULL,
  `lv044` date DEFAULT NULL,
  `lv045` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0020
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0021
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0021`;
CREATE TABLE `hr_lv0021` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0021
-- ----------------------------
INSERT INTO `hr_lv0021` VALUES ('MS001', 'Đã có gia đình');
INSERT INTO `hr_lv0021` VALUES ('MS002', 'Độc thân');
INSERT INTO `hr_lv0021` VALUES ('MS003', 'Đã ly dị');
INSERT INTO `hr_lv0021` VALUES ('MS004', 'Khác');

-- ----------------------------
-- Table structure for hr_lv0022
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0022`;
CREATE TABLE `hr_lv0022` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0022
-- ----------------------------
INSERT INTO `hr_lv0022` VALUES ('3', 'Nhân viên nghỉ từ thử việc không đạt');
INSERT INTO `hr_lv0022` VALUES ('2', 'Nhân viên nghỉ việc');
INSERT INTO `hr_lv0022` VALUES ('1', 'Nhân viên thử việc');
INSERT INTO `hr_lv0022` VALUES ('0', 'Nhân viên chính thức');

-- ----------------------------
-- Table structure for hr_lv0023
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0023`;
CREATE TABLE `hr_lv0023` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` char(6) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0023
-- ----------------------------
INSERT INTO `hr_lv0023` VALUES ('PR001', '...', null);
INSERT INTO `hr_lv0023` VALUES ('PR002', 'An Giang', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR003', 'Bà Rịa', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR004', 'Bắc Cạn', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR005', 'Bắc Giang', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR006', 'Bạc Liêu', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR007', 'Bắc Ninh', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR008', 'Bến Tre', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR009', 'Bình Định', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR010', 'Bình Dương', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR011', 'Bình Phước', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR012', 'Bình Thuận', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR013', 'Cà Mau', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR014', 'Cần Thơ', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR015', 'Cao Bằng', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR016', 'Đà Nẵng', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR017', 'Đắc Lắc', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR018', 'Đồng Nai', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR019', 'Đồng Tháp', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR020', 'Gia Lai', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR021', 'Hà Giang', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR022', 'Hà Nam', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR023', 'Hà Nội', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR024', 'Hà Tây', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR025', 'Hà Tĩnh', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR026', 'Hải Dương', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR027', 'Hải Phòng', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR028', 'Hồ Chí Minh', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR029', 'Hòa Bình', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR030', 'Huế', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR031', 'Hưng Yên', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR032', 'Khánh Hòa', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR033', 'KomTum', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR034', 'Lai Châu', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR035', 'Lâm Đồng', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR036', 'Lạng Sơn', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR037', 'Lào Cai', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR038', 'Long An', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR039', 'Nam Định', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR040', 'Nghệ An', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR041', 'Ninh Bình', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR042', 'Ninh Thuận', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR043', 'Phụ Thọ', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR044', 'Phú Yên', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR045', 'Quảng Bình', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR046', 'Quảng Nam', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR047', 'Quảng Ngãi', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR048', 'Quảng Ninh', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR049', 'Quảng Trị', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR050', 'Sóc Trăng', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR051', 'Sơn La', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR052', 'Tây Ninh', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR053', 'Thái Bình', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR054', 'Thái Nguyên', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR055', 'Thanh Hóa', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR056', 'Thừa Thiên - Huế', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR057', 'Tiền Giang', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR058', 'Trà Vinh', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR059', 'Tuyên Quang', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR060', 'Kiên Giang', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR061', 'Vĩnh Long', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR062', 'Vĩnh Phúc', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR063', 'Vũng Tàu', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR064', 'Yên Bái', 'NL0001');
INSERT INTO `hr_lv0023` VALUES ('PR065', 'Hậu Giang', 'NL0001');

-- ----------------------------
-- Table structure for hr_lv0024
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0024`;
CREATE TABLE `hr_lv0024` (
  `lv001` bigint(32) NOT NULL,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(50) DEFAULT NULL,
  `lv005` varchar(50) DEFAULT NULL,
  `lv006` varchar(20) DEFAULT NULL,
  `lv007` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0024
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0025
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0025`;
CREATE TABLE `hr_lv0025` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0025
-- ----------------------------
INSERT INTO `hr_lv0025` VALUES ('CDE001', 'Cha');
INSERT INTO `hr_lv0025` VALUES ('CDE002', 'Mẹ');
INSERT INTO `hr_lv0025` VALUES ('CDE003', 'Vợ');
INSERT INTO `hr_lv0025` VALUES ('CDE004', 'Con');
INSERT INTO `hr_lv0025` VALUES ('CDE005', 'Anh');
INSERT INTO `hr_lv0025` VALUES ('CDE006', 'Chị');
INSERT INTO `hr_lv0025` VALUES ('CDE007', 'Ông nội');
INSERT INTO `hr_lv0025` VALUES ('CDE008', 'Bà nội');
INSERT INTO `hr_lv0025` VALUES ('CDE009', 'Ông ngoại');
INSERT INTO `hr_lv0025` VALUES ('CDE010', 'Bà ngoại');
INSERT INTO `hr_lv0025` VALUES ('CDE011', 'Chồng');
INSERT INTO `hr_lv0025` VALUES ('CDE012', 'Em trai');
INSERT INTO `hr_lv0025` VALUES ('CDE013', 'Em gái');

-- ----------------------------
-- Table structure for hr_lv0026
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0026`;
CREATE TABLE `hr_lv0026` (
  `lv001` int(28) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(32) DEFAULT NULL,
  `lv003` char(30) DEFAULT NULL,
  `lv004` char(6) DEFAULT NULL,
  `lv005` date DEFAULT NULL,
  `lv006` char(32) DEFAULT NULL,
  `lv007` varchar(255) DEFAULT NULL,
  `lv008` decimal(28,2) DEFAULT NULL,
  `lv009` varchar(255) DEFAULT NULL,
  `lv010` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

-- ----------------------------
-- Records of hr_lv0026
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0027
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0027`;
CREATE TABLE `hr_lv0027` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` tinyint(1) DEFAULT NULL,
  `lv004` varchar(50) DEFAULT NULL,
  `lv005` char(6) DEFAULT NULL,
  `lv006` date DEFAULT NULL,
  `lv007` date DEFAULT NULL,
  `lv008` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0027
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0028
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0028`;
CREATE TABLE `hr_lv0028` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(6) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` decimal(18,1) DEFAULT NULL,
  `lv006` decimal(18,2) DEFAULT NULL,
  `lv007` date DEFAULT NULL,
  `lv008` date DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0028
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0029
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0029`;
CREATE TABLE `hr_lv0029` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` tinyint(1) DEFAULT NULL,
  `lv006` date DEFAULT NULL,
  `lv007` date DEFAULT NULL,
  `lv008` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0029
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0030
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0030`;
CREATE TABLE `hr_lv0030` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(6) DEFAULT NULL,
  `lv004` decimal(18,1) DEFAULT NULL,
  `lv005` text,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0030
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0031
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0031`;
CREATE TABLE `hr_lv0031` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(6) DEFAULT NULL,
  `lv004` char(6) DEFAULT NULL,
  `lv005` varchar(100) DEFAULT NULL,
  `lv006` date DEFAULT NULL,
  `lv007` date DEFAULT NULL,
  `lv008` varchar(255) DEFAULT NULL,
  `lv009` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0031
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0032
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0032`;
CREATE TABLE `hr_lv0032` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0032
-- ----------------------------
INSERT INTO `hr_lv0032` VALUES ('CDE001', 'Viết');
INSERT INTO `hr_lv0032` VALUES ('CDE002', 'Đọc');
INSERT INTO `hr_lv0032` VALUES ('CDE003', 'Nói');
INSERT INTO `hr_lv0032` VALUES ('CDE004', 'Nghe');

-- ----------------------------
-- Table structure for hr_lv0033
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0033`;
CREATE TABLE `hr_lv0033` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(6) DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` date DEFAULT NULL,
  `lv006` varchar(255) DEFAULT NULL,
  `lv007` char(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0033
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0034
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0034`;
CREATE TABLE `hr_lv0034` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(6) DEFAULT NULL,
  `lv004` varchar(50) DEFAULT NULL,
  `lv005` varchar(255) DEFAULT NULL,
  `lv006` decimal(18,2) DEFAULT NULL,
  `lv007` date DEFAULT NULL,
  `lv008` date DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0034
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0035
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0035`;
CREATE TABLE `hr_lv0035` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0035
-- ----------------------------
INSERT INTO `hr_lv0035` VALUES ('RUP001', 'Rất tốt');
INSERT INTO `hr_lv0035` VALUES ('RUP002', 'Tốt');
INSERT INTO `hr_lv0035` VALUES ('RUP003', 'Khá');
INSERT INTO `hr_lv0035` VALUES ('RUP004', 'Chăm chỉ');
INSERT INTO `hr_lv0035` VALUES ('RUP005', 'Không hiệu quả');

-- ----------------------------
-- Table structure for hr_lv0036
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0036`;
CREATE TABLE `hr_lv0036` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(6) DEFAULT NULL,
  `lv004` char(6) DEFAULT NULL,
  `lv005` text,
  `lv006` date DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0036
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0037
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0037`;
CREATE TABLE `hr_lv0037` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0037
-- ----------------------------
INSERT INTO `hr_lv0037` VALUES ('101', 'Lương căn bản-cố định', '0');
INSERT INTO `hr_lv0037` VALUES ('111', 'Phụ cấp chức vụ', '0');
INSERT INTO `hr_lv0037` VALUES ('112', 'Phụ cấp khác', '1');
INSERT INTO `hr_lv0037` VALUES ('113', 'Phụ cấp độc hại', '1');
INSERT INTO `hr_lv0037` VALUES ('114', 'Phụ cấp tiền điện thoại', '1');
INSERT INTO `hr_lv0037` VALUES ('115', 'Phụ cấp tiền xăng', '1');
INSERT INTO `hr_lv0037` VALUES ('116', 'TN VK', '0');
INSERT INTO `hr_lv0037` VALUES ('117', 'TN nghề', '0');
INSERT INTO `hr_lv0037` VALUES ('118', 'Lương thưởng', '2');
INSERT INTO `hr_lv0037` VALUES ('119', 'Khoản lương trừ hàng tháng', '3');
INSERT INTO `hr_lv0037` VALUES ('120', 'Khoản lương trừ cho người phụ thuộc', '4');
INSERT INTO `hr_lv0037` VALUES ('1121', 'Phụ cấp trách nhiệm', '2');

-- ----------------------------
-- Table structure for hr_lv0038
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0038`;
CREATE TABLE `hr_lv0038` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(6) DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` date DEFAULT NULL,
  `lv006` varchar(255) DEFAULT NULL,
  `lv007` decimal(18,1) DEFAULT NULL,
  `lv008` text,
  `lv009` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0038
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0039
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0039`;
CREATE TABLE `hr_lv0039` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0039
-- ----------------------------
INSERT INTO `hr_lv0039` VALUES ('1', 'Có thời hạn');
INSERT INTO `hr_lv0039` VALUES ('2', 'Hợp đồng thử việc');
INSERT INTO `hr_lv0039` VALUES ('3', 'Vô thời hạn');

-- ----------------------------
-- Table structure for hr_lv0040
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0040`;
CREATE TABLE `hr_lv0040` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0040
-- ----------------------------
INSERT INTO `hr_lv0040` VALUES ('CV', 'Sơ yếu lý lịch');
INSERT INTO `hr_lv0040` VALUES ('CMND', 'Giấy CMND');
INSERT INTO `hr_lv0040` VALUES ('FAMILY', 'Sổ hậu khẩu');
INSERT INTO `hr_lv0040` VALUES ('PIC', 'Hình ảnh');
INSERT INTO `hr_lv0040` VALUES ('QUO', 'Tài liệu chào giá');
INSERT INTO `hr_lv0040` VALUES ('CUS', 'Tài liệu khách hàng');
INSERT INTO `hr_lv0040` VALUES ('CON', 'Hợp đồng');
INSERT INTO `hr_lv0040` VALUES ('CALEND', 'LỊCH TRÌNH TRIỂN KHAI');

-- ----------------------------
-- Table structure for hr_lv0041
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0041`;
CREATE TABLE `hr_lv0041` (
  `lv001` bigint(28) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(32) DEFAULT NULL,
  `lv003` char(6) NOT NULL DEFAULT '',
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` datetime DEFAULT NULL,
  `lv006` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`lv001`,`lv003`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; InnoDB free: 7168 kB; InnoDB free: 102';

-- ----------------------------
-- Records of hr_lv0041
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0042
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0042`;
CREATE TABLE `hr_lv0042` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(6) DEFAULT NULL,
  `lv004` char(32) DEFAULT NULL,
  `lv005` decimal(28,2) DEFAULT NULL,
  `lv006` char(6) DEFAULT NULL,
  `lv007` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0042
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0043
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0043`;
CREATE TABLE `hr_lv0043` (
  `lv001` char(6) NOT NULL DEFAULT '',
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` text,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0043
-- ----------------------------
INSERT INTO `hr_lv0043` VALUES ('TEM001', 'Hợp đồng lao động', '<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"2\">\r\n<td width=\"75\">&nbsp;</td>\r\n<td width=\"15\">&nbsp;</td>\r\n<td width=\"57\">&nbsp;</td>\r\n<td width=\"53\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"63\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div style=\"text-align: center;\"><strong>CỘNG H&Ograve;A X&Atilde; HỘI CHỦ NGHĨA VIỆT </strong><strong> NAM</strong></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div style=\"text-align: center;\"><strong>Độc lập &ndash; Tự do &ndash; Hạnh ph&uacute;c</strong></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div style=\"text-align: center;\">***</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>T&ecirc;n đơn vị</strong></td>\r\n<td><strong>:</strong></td>\r\n<td colspan=\"8\"><strong>C&Ocirc;NG TY TNHH VĨ AN</strong><strong></strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Số</strong></td>\r\n<td><strong>:</strong></td>\r\n<td colspan=\"8\"><strong>____/2010-HDLD</strong></td>\r\n</tr>\r\n<tr height=\"2\">\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<p align=\"center\"><strong><span style=\"font-size: large;\">HỢP ĐỒNG LAO ĐỘNG</span></strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div><em>(Ban h&agrave;nh theo Th&ocirc;ng tư số 21/2003/TT &ndash; BLĐTBXH  ng&agrave;y </em><em>22/09/2003</em><em> của Bộ Lao động &ndash; Thương binh v&agrave; X&atilde; hội)</em></div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"162\">Ch&uacute;ng t&ocirc;i, một b&ecirc;n l&agrave; &Ocirc;ng</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"250\"><strong>T&Ocirc; QUẢNG HUY</strong></td>\r\n<td width=\"69\">Quốc tịch</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"82\"><strong>Mỹ</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Chức vụ</td>\r\n<td>:</td>\r\n<td><strong>Tổng GĐ<br /></strong></td>\r\n<td>Điện thoại</td>\r\n<td>:</td>\r\n<td>08.38163228</td>\r\n</tr>\r\n<tr>\r\n<td>Đại diện cho (1)</td>\r\n<td>:</td>\r\n<td><strong>C&Ocirc;NG TY TNHH VĨ AN</strong></td>\r\n<td>Fax</td>\r\n<td>:</td>\r\n<td>08.38163229</td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ</td>\r\n<td>:</td>\r\n<td colspan=\"4\">L&ocirc; 3/21, đường 19/5A , Q. T&acirc;n B&igrave;nh, Tp. HCM, Vi&ecirc;̣t Nam</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"4\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>V&agrave; một b&ecirc;n l&agrave;<strong> @#01</strong></td>\r\n<td>:</td>\r\n<td><strong>@#02</strong></td>\r\n<td>Quốc tịch</td>\r\n<td>:</td>\r\n<td><strong>@#03</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Sinh ng&agrave;y</td>\r\n<td>:</td>\r\n<td>Năm <strong>@#11</strong> tại <strong>@#12</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ thường tr&uacute;</td>\r\n<td>:</td>\r\n<td colspan=\"4\"><strong>@#13</strong>, <strong>@#14</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Số CMND</td>\r\n<td>:</td>\r\n<td colspan=\"4\"><strong>@#15</strong> Cấp ng&agrave;y <strong>@#16</strong>&nbsp; tại <strong>@#17</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Số sổ lao động(nếu c&oacute;)</td>\r\n<td>:</td>\r\n<td colspan=\"4\"><strong>@#18</strong> Cấp  ng&agrave;y <strong>@#19</strong> tại <strong>@#20</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"6\">Thỏa thuận k&yacute; kết hợp đồng lao động v&agrave; cam kết  l&agrave;m đ&uacute;ng những điều khoản sau đ&acirc;y:</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"2\">\r\n<td width=\"54\">&nbsp;</td>\r\n<td width=\"6\">&nbsp;</td>\r\n<td width=\"185\">&nbsp;</td>\r\n<td width=\"77\">&nbsp;</td>\r\n<td width=\"16\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n<td width=\"89\">&nbsp;</td>\r\n<td width=\"24\">&nbsp;</td>\r\n<td width=\"48\">&nbsp;</td>\r\n<td width=\"53\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điều 1:</strong></td>\r\n<td colspan=\"9\"><strong>Thời hạn v&agrave; c&ocirc;ng việc hợp đồng</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td>Loại hợp đồng lao động (3):</td>\r\n<td colspan=\"7\">C&oacute; thời hạn.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\">Từ ng&agrave;y <strong>@#22</strong> th&aacute;ng <strong>@#23</strong> năm <strong>@#24</strong> đến ng&agrave;y <strong>@#25</strong> th&aacute;ng <strong>@#26</strong> năm <strong>@#27</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"8\">Địa điểm l&agrave;m việc (4):<strong> </strong>L&ocirc; III-21 đường 19/5A, nh&oacute;m CN III, KCN T&acirc;n b&igrave;nh,T&acirc;n ph&uacute;, TPHCM</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"8\">Chức vụ (nếu c&oacute;):<strong>@#30</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điều 2:</strong></td>\r\n<td colspan=\"9\"><strong>Chế độ l&agrave;m việc</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td>Thời gian l&agrave;m việc (6):</td>\r\n<td colspan=\"7\"><strong>h&agrave;nh ch&aacute;nh</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td><br /></td>\r\n<td style=\"padding-left: 30px;\" colspan=\"8\">\r\n<p>+ S&aacute;ng từ : 07h30</p>\r\n<p>+Chiều từ : 13h00</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"8\">Được cấp ph&aacute;t những dụng cụ l&agrave;m việc gồm: c&ocirc;ng cụ phục vụ c&ocirc;ng việc.</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điều 3</strong><strong>:</strong></td>\r\n<td colspan=\"9\"><strong>Nghĩa vụ v&agrave; quyền lợi của người lao động</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"12\">&nbsp;</td>\r\n<td width=\"13\"><strong><em>1.</em></strong></td>\r\n<td colspan=\"3\"><strong><em>Quyền lợi:</em></strong></td>\r\n<td width=\"111\">&nbsp;</td>\r\n<td width=\"3\">&nbsp;</td>\r\n<td width=\"132\">&nbsp;</td>\r\n<td width=\"72\">&nbsp;</td>\r\n<td width=\"87\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"6\">-</td>\r\n<td colspan=\"7\">Phương tiện đi lại l&agrave;m việc (7): Tự t&uacute;c.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"3\">Mức lương cơ bản (8):</td>\r\n<td>:</td>\r\n<td colspan=\"3\"><strong>@#33</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"3\">H&igrave;nh thức trả lương</td>\r\n<td>:</td>\r\n<td colspan=\"3\">lương th&aacute;ng theo ng&agrave;y c&ocirc;ng thực tế</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td><br /></td>\r\n<td style=\"padding-left: 30px;\" colspan=\"7\">\r\n<p>- Phụ cấp gồm: 1 suất cơm / ng&agrave;y/ca, phụ cấp ng&ograve;ai giờ (nếu c&oacute;) .<br />- Được trả lương v&agrave;o ng&agrave;y 15 th&aacute;ng sau.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tiền thưởng : theo qui chế thưởng của c&ocirc;ng ty<br />&nbsp;&nbsp; &nbsp;&nbsp; Chế độ n&acirc;ng lương: t&ugrave;y thuộc v&agrave;o năng lực v&agrave; hiệu quả c&ocirc;ng việc được x&eacute;t theo qui chế<br />&nbsp;n&acirc;ng lương của c&ocirc;ng ty.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Được trang bị bảo hộ lao động gồm : &hellip;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Chế độ nghỉ ngơi: (h&agrave;ng tuần , ph&eacute;p năm, lễ , tết &hellip;&hellip;&hellip;): theo luật định <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; +&nbsp; Ph&eacute;p năm: 12 ng&agrave;y / năm<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + 9 ng&agrave;y lễ, tết</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Bảo hiểm x&atilde; hội bảo hiểm y tế &amp; BHTN : Nộp theo quy định của luật Lao Đ&ocirc;ng Việt Nam<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Người sử dụng lao động nộp : 20% tiền lương<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Người lao động nộp &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 8.5% tiền lương&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Chế độ đ&agrave;o tạo : được tổ chức đ&agrave;o tạo t&ugrave;y thuộc v&agrave;o vị tr&iacute; c&ocirc;ng việc.</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<!--                        \r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Được trang bị bảo hộ lao động gồm: Một năm   được cấp trước 02 bộ đồng phục (6 th&aacute;ng /1 bộ)  nếu l&agrave;m kh&ocirc;ng đủ thời gian tr&ecirc;n th&igrave; phải trả lại tiền đồng phục cho c&ocirc;ng ty.</td>\r\n</tr>\r\n-->                          \r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"5\">Những thỏa thuận kh&aacute;c (13):</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"9\" valign=\"top\">+</td>\r\n<td colspan=\"6\"><strong>@#45</strong><strong> @#46</strong> phải chấp h&agrave;nh sự điều động v&agrave; thực hiện đ&uacute;ng theo nội quy của c&ocirc;ng ty.</td>\r\n</tr>\r\n<tr height=\"2\">\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"108\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td><strong><em>2.</em></strong></td>\r\n<td colspan=\"8\"><strong><em>Nghĩa vụ:</em></strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"7\">Ho&agrave;n th&agrave;nh những c&ocirc;ng việc đ&atilde; cam kết trong hợp  đồng lao động.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"7\">Chấp h&agrave;nh lệnh điều h&agrave;nh sản xuất &ndash; kinh doanh,  nội quy kỷ luật lao động, an to&agrave;n lao động.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Bồi thường vi phạm v&agrave; vật chất (14): Trong qu&aacute; tr&igrave;nh l&agrave;m việc nếu g&acirc;y thiệt hại đến t&agrave;i sản của C&ocirc;ng ty th&igrave; phải bồi thường theo quy định của ph&aacute;p luật.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Điều 4:</strong></td>\r\n<td colspan=\"9\"><strong>Nghĩa vụ v&agrave; quyền hạn của người sử dụng lao động</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"13\">&nbsp;</td>\r\n<td width=\"15\"><strong><em>1.</em></strong></td>\r\n<td colspan=\"8\"><strong><em>Nghĩa vụ:</em></strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"6\">-</td>\r\n<td colspan=\"7\">Đảm bảo việc l&agrave;m v&agrave; thực hiện đầy đủ những điều đ&atilde; cam kết trong hợp đồng lao động.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Thanh to&aacute;n đầy đủ, đ&uacute;ng thời hạn c&aacute;c chế độ v&agrave; quyền lợi của người lao động theo hợp đồng lao động, thỏa ước lao động tập thể.<br /></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td><strong><em>2.</em></strong></td>\r\n<td colspan=\"8\"><strong><em>Quyền hạn:</em></strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Điều h&agrave;nh người lao động ho&agrave;n th&agrave;nh c&ocirc;ng việc theo hợp đồng lao động ( bố tr&iacute;, điều chuyển, tạm ngừng c&ocirc;ng việc &hellip;&hellip;&hellip;).</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Tạm ho&atilde;n, chấm dứt hợp đồng lao động, kỹ luật người lao động theo quy định của ph&aacute;p luật, thỏa ước lao động tập thể&nbsp; v&agrave; nội qui lao động của doanh nghiệp.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"56\"><strong>Điều 5:</strong></td>\r\n<td width=\"497\"><strong>Điều khoản thi h&agrave;nh</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"31\">&nbsp;</td>\r\n<td width=\"10\" valign=\"top\">-</td>\r\n<td colspan=\"8\">Những vấn đề về lao đ&ocirc;ng kh&ocirc;ng ghi trong hợp đồng n&agrave;y th&igrave; &aacute;p dụng quy định của thỏa ước lao động tập thể, trường hợp chưa c&oacute; thỏa ước lao động tập thể th&igrave; &aacute;p dụng quy định của ph&aacute;p luật lao động.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\">Hợp đồng lao động được l&agrave;m th&agrave;nh 02 bản c&oacute; gi&aacute;  trị ngang nhau, mỗi b&ecirc;n giữ một bản v&agrave; c&oacute; hiệu lực từ ng&agrave;y <strong>@#47</strong> th&aacute;ng <strong>@#48</strong> năm  <strong>@#49</strong>. Khi hai b&ecirc;n k&yacute; kết phụ lục hợp đồng lao động th&igrave; nội dung của phụ lục hợp  đồng lao động cũng c&oacute; gi&aacute; trị như c&aacute;c nội dung của bản hợp đồng lao động n&agrave;y.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"9\">Hợp đồng n&agrave;y l&agrave;m tại C&ocirc;ng ty TNHH Vĩ An, k&yacute; ng&agrave;y <strong>@#50</strong> th&aacute;ng <strong>@#51</strong> năm <strong>@#52</strong>.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"5\">\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><strong>NGƯỜI LAO ĐỘNG</strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><strong>NGƯỜI SỬ DỤNG LAO ĐỘNG</strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><em>(K&yacute; t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><em>(K&yacute; t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><em>Ghi r&otilde; họ v&agrave; t&ecirc;n</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><em>Ghi r&otilde; họ v&agrave; t&ecirc;n</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\">......................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\">..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>');
INSERT INTO `hr_lv0043` VALUES ('TEM002', 'Hợp đồng thử việc', '<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"2\">\r\n<td width=\"75\">&nbsp;</td>\r\n<td width=\"15\">&nbsp;</td>\r\n<td width=\"57\">&nbsp;</td>\r\n<td width=\"53\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"63\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div style=\"text-align: center;\"><strong>CỘNG H&Ograve;A X&Atilde; HỘI CHỦ NGHĨA VIỆT </strong><strong> NAM</strong></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div style=\"text-align: center;\"><strong>Độc lập &ndash; Tự do &ndash; Hạnh ph&uacute;c</strong></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div style=\"text-align: center;\">***</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>T&ecirc;n đơn vị</strong></td>\r\n<td><strong>:</strong></td>\r\n<td colspan=\"8\"><strong>@#01</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Số</strong></td>\r\n<td><strong>:</strong></td>\r\n<td colspan=\"8\"><strong>123456789</strong></td>\r\n</tr>\r\n<tr height=\"2\">\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<p align=\"center\"><strong><span style=\"font-size: large;\">HỢP ĐỒNG THỬ VIỆC<br /></span></strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div><em>(Ban h&agrave;nh theo Th&ocirc;ng tư số 21/2003/TT &ndash; BLĐTBXH  ng&agrave;y </em><em>22/09/2003</em><em> của Bộ Lao động &ndash; Thương binh v&agrave; X&atilde; hội)</em></div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"162\">Ch&uacute;ng t&ocirc;i, một b&ecirc;n l&agrave; &Ocirc;ng</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"250\"><strong>T&Ocirc; QUẢNG HUY</strong></td>\r\n<td width=\"69\">Quốc tịch</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"82\"><strong>Mỹ</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Chức vụ</td>\r\n<td>:</td>\r\n<td><strong>Tổng GĐ</strong></td>\r\n<td>Điện thoại</td>\r\n<td>:</td>\r\n<td>08.38163228</td>\r\n</tr>\r\n<tr>\r\n<td>Đại diện cho (1)</td>\r\n<td>:</td>\r\n<td><strong>C&Ocirc;NG TY TNHH VĨ AN</strong></td>\r\n<td>Fax</td>\r\n<td>:</td>\r\n<td>08.38163229</td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ</td>\r\n<td>:</td>\r\n<td colspan=\"4\">L&ocirc; 3/21, đường 19/5A , Q. T&acirc;n Bình, Tp. HCM, Vi&ecirc;̣t Nam</td>\r\n</tr>\r\n<tr>\r\n<td>V&agrave; một b&ecirc;n l&agrave;<strong> @#01</strong></td>\r\n<td>:</td>\r\n<td><strong>@#02</strong></td>\r\n<td>Quốc tịch</td>\r\n<td>:</td>\r\n<td><strong>@#03</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Sinh ng&agrave;y</td>\r\n<td>:</td>\r\n<td>Năm <strong>@#11</strong> tại <strong>@#12</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ thường tr&uacute;</td>\r\n<td>:</td>\r\n<td colspan=\"4\"><strong>@#13</strong>, <strong>@#14</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Số CMND</td>\r\n<td>:</td>\r\n<td colspan=\"4\"><strong>@#15</strong> Cấp ng&agrave;y <strong>@#16</strong>&nbsp; tại <strong>@#17</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"6\">Thỏa thuận k&yacute; kết hợp đồng thử việc v&agrave; cam kết  l&agrave;m đ&uacute;ng những điều khoản sau đ&acirc;y:</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"2\">\r\n<td width=\"54\">&nbsp;</td>\r\n<td width=\"6\">&nbsp;</td>\r\n<td width=\"185\">&nbsp;</td>\r\n<td width=\"77\">&nbsp;</td>\r\n<td width=\"16\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n<td width=\"89\">&nbsp;</td>\r\n<td width=\"24\">&nbsp;</td>\r\n<td width=\"48\">&nbsp;</td>\r\n<td width=\"53\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điều 1:</strong></td>\r\n<td colspan=\"9\"><strong>Thời hạn v&agrave; c&ocirc;ng việc hợp đồng</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td>Loại hợp đồng lao động (3):</td>\r\n<td colspan=\"7\">C&oacute; thời hạn <strong>@#21</strong> th&aacute;ng.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\">Từ ng&agrave;y <strong>@#22</strong> th&aacute;ng <strong>@#23</strong> năm <strong>@#24</strong> đến ng&agrave;y <strong>@#25</strong> th&aacute;ng <strong>@#26</strong> năm <strong>@#27</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"8\">Địa điểm l&agrave;m việc (4):<strong>@#28</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"4\">Ph&ograve;ng ban:<strong>@#29</strong></td>\r\n<td colspan=\"2\">Chức vụ (nếu c&oacute;):</td>\r\n<td colspan=\"2\"><strong>@#30</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"8\">C&ocirc;ng việc phải l&agrave;m (5):<strong>@#31</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điều 2:</strong></td>\r\n<td colspan=\"9\"><strong>Chế độ l&agrave;m việc</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td>Thời gian l&agrave;m việc (6):</td>\r\n<td colspan=\"7\"><strong>@#32</strong> giờ/ng&agrave;y.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"8\">Được cấp ph&aacute;t những dụng cụ l&agrave;m việc gồm: ph&ugrave; hợp theo từng vị tr&iacute; v&agrave; bộ phận l&agrave;m việc.</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điều 3</strong><strong>:</strong></td>\r\n<td colspan=\"9\"><strong>Nghĩa vụ v&agrave; quyền lợi của người lao động</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"12\">&nbsp;</td>\r\n<td width=\"13\"><strong><em>1.</em></strong></td>\r\n<td colspan=\"3\"><strong><em>Quyền lợi:</em></strong></td>\r\n<td width=\"111\">&nbsp;</td>\r\n<td width=\"3\">&nbsp;</td>\r\n<td width=\"132\">&nbsp;</td>\r\n<td width=\"72\">&nbsp;</td>\r\n<td width=\"87\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"6\">-</td>\r\n<td colspan=\"7\">Phương tiện đi lại l&agrave;m việc (7): Tự t&uacute;c.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"3\">Tổng lương (8)</td>\r\n<td>:</td>\r\n<td colspan=\"3\"><strong>@#33đồng</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Phụ cấp kh&aacute;c tr&ecirc;n  bao gồm c&aacute;c phụ cấp sau: phụ cấp ca, phụ cấp đi lại, phụ cấp nh&agrave; ở, phụ cấp chuy&ecirc;n cần.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"3\">H&igrave;nh thức trả lương</td>\r\n<td>:</td>\r\n<td colspan=\"3\">Theo thời gian</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"7\">Được trả lương mỗi th&aacute;ng một lần v&agrave;o&nbsp;ng&agrave;y <strong>@#38</strong> h&agrave;ng  th&aacute;ng.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Tiền thưởng v&agrave; chế độ n&acirc;ng lương: T&ugrave;y theo t&igrave;nh h&igrave;nh hoạt động kinh doanh của c&ocirc;ng ty.</td>\r\n</tr>\r\n<!--      \r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Được trang bị bảo hộ lao động gồm: Một năm   được cấp trước 02 bộ đồng phục (6 th&aacute;ng /1 bộ)  nếu l&agrave;m kh&ocirc;ng đủ thời gian tr&ecirc;n th&igrave; phải trả lại tiền đồng phục cho c&ocirc;ng ty.</td>\r\n</tr>\r\n-->        \r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"7\">Chế độ nghỉ ngơi (nghỉ h&agrave;ng tuần, ph&eacute;p năm, lễ  tết..): Theo qui định của Bộ luật lao động.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"7\">Chế độ đ&agrave;o tạo  (9): <strong>@#44</strong>.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"5\">Những thỏa thuận kh&aacute;c (10):</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"9\" valign=\"top\">+</td>\r\n<td colspan=\"6\">Trong thời gian thử việc, c&ocirc;ng ty v&agrave; người lao động c&oacute; thể chấm dứt hợp đồng thử việc bất kỳ l&uacute;c n&agrave;o.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"9\" valign=\"top\">+</td>\r\n<td colspan=\"6\">Sau thời gian thử việc, nếu người lao động đạt y&ecirc;u cầu c&ocirc;ng ty sẽ tiến h&agrave;nh k&yacute; hợp đồng lao động c&oacute; thời hạn v&agrave; trả lương ch&iacute;nh thức như đ&atilde; thỏa thuận, nếu người lao động kh&ocirc;ng đạt y&ecirc;u cầu, c&ocirc;ng ty sẽ chấm dứt hợp đồng thử việc. Ngo&agrave;i ra trong trường hợp người lao động chưa đ&aacute;p ứng được y&ecirc;u cầu c&ocirc;ng việc, tuy nhi&ecirc;n c&oacute; cố gắng học hỏi th&igrave; c&ocirc;ng ty sẽ tạo điều kiện để người lao động được gia hạn hợp đồng thử việc<br /> Trong thời gian thử việc, nếu người lao động l&agrave;m việc &iacute;t hơn 7 ng&agrave;y c&ocirc;ng ty sẽ kh&ocirc;ng trả lương.</td>\r\n</tr>\r\n<tr height=\"2\">\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"108\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td><strong><em>2.</em></strong></td>\r\n<td colspan=\"8\"><strong><em>Nghĩa vụ:</em></strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"7\">Ho&agrave;n th&agrave;nh những c&ocirc;ng việc đ&atilde; cam kết trong hợp  đồng thử việc.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"7\">Chấp h&agrave;nh lệnh điều h&agrave;nh sản xuất &ndash; kinh doanh,  nội quy kỷ luật lao động, an to&agrave;n lao động.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"7\">Đ&atilde; đọc r&otilde; v&agrave; đồng &yacute; chấp h&agrave;nh nghi&ecirc;m chỉnh nội qui kỷ luật lao động của c&ocirc;ng ty.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Bồi thường vi phạm v&agrave; vật chất (11): Trong qu&aacute; tr&igrave;nh l&agrave;m việc nếu g&acirc;y thiệt hại đến t&agrave;i sản của C&ocirc;ng ty th&igrave; phải bồi thường theo quy định của ph&aacute;p luật.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Kh&ocirc;ng được l&agrave;m th&ecirc;m cho bất kỳ c&ocirc;ng ty n&agrave;o trong c&ugrave;ng lĩnh vực c&ocirc;ng việc hoặc c&oacute; c&ugrave;ng ngh&agrave;nh nghề với c&ocirc;ng ty.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Điều 4:</strong></td>\r\n<td colspan=\"9\"><strong>Nghĩa vụ v&agrave; quyền hạn của người sử dụng lao động</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"13\">&nbsp;</td>\r\n<td width=\"15\"><strong><em>1.</em></strong></td>\r\n<td colspan=\"8\"><strong><em>Nghĩa vụ:</em></strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"6\">-</td>\r\n<td colspan=\"7\">Bảo đảm việc l&agrave;m v&agrave; thực hiện đầy đủ những điều  đ&atilde; cam kết trong hợp đồng thử việc.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Thanh to&aacute;n đầy đủ, đ&uacute;ng thời hạn c&aacute;c chế độ v&agrave;  quyền lợi cho người lao động theo hợp đồng thử việc, thỏa ước lao động tập thể  (nếu c&oacute;).</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td><strong><em>2.</em></strong></td>\r\n<td colspan=\"8\"><strong><em>Quyền hạn:</em></strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Điều h&agrave;nh người lao động ho&agrave;n th&agrave;nh c&ocirc;ng việc  theo hợp đồng (bố tr&iacute;, điều chuyển, tạm ngừng việc ...).</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Tạm ho&atilde;n, chấm dứt hợp đồng lao động, kỷ luật  người lao động theo quy định của ph&aacute;p luật, thỏa ước lao động tập thể (nếu c&oacute;)  v&agrave; nội quy lao động của doanh nghiệp.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">To&agrave;n quyền sở hữu v&agrave; sử dụng những sản phẩm, ph&aacute;t minh, s&aacute;ng kiến của người lao động tạo ra trong qu&aacute; tr&igrave;nh l&agrave;m việc tại c&ocirc;ng ty.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"56\"><strong>Điều 5:</strong></td>\r\n<td width=\"497\"><strong>Điều khoản thi h&agrave;nh</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"31\">&nbsp;</td>\r\n<td width=\"10\" valign=\"top\">-</td>\r\n<td colspan=\"8\">Những vấn đề về lao động kh&ocirc;ng ghi trong hợp  đồng lao động n&agrave;y thi &aacute;p dụng quy định của thỏa ước tập thể, trường hợp chưa c&oacute;  thỏa thuận tập thể th&igrave; &aacute;p dụng quy định của ph&aacute;p luật lao động.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\">Hợp đồng thử việc được l&agrave;m th&agrave;nh 02 bản c&oacute; gi&aacute;  trị ngang nhau, mỗi b&ecirc;n giữ một bản v&agrave; c&oacute; hiệu lực từ ng&agrave;y <strong>@#47</strong> th&aacute;ng <strong>@#48</strong> năm  <strong>@#49. </strong>Khi hai b&ecirc;n k&yacute; kết phụ lục hợp đồng thử việc th&igrave; nội dung của phụ lục hợp  đồng thử việc cũng c&oacute; gi&aacute; trị như c&aacute;c nội dung của bản hợp đồng thử việc n&agrave;y.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"9\">Hợp đồng n&agrave;y l&agrave;m tại C&ocirc;ng ty ng&agrave;y <strong>@#50</strong> th&aacute;ng <strong>@#51</strong> năm <strong>@#52</strong>.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"5\">\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>NGƯỜI LAO ĐỘNG</strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>NGƯỜI SỬ DỤNG LAO ĐỘNG</strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute; t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute; t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>Ghi r&otilde; họ v&agrave; t&ecirc;n</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>Ghi r&otilde; họ v&agrave; t&ecirc;n</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>......................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>');
INSERT INTO `hr_lv0043` VALUES ('TEM003', 'Tờ Khai', '<table style=\"width: 720px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"2\">\r\n<td width=\"75\">&nbsp;</td>\r\n<td width=\"15\">&nbsp;</td>\r\n<td width=\"57\">&nbsp;</td>\r\n<td width=\"53\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"63\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<table style=\"width: 100%;\" border=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"266\" align=\"center\"><span style=\"font-size: medium;\"><strong>BẢO HIỂM X&Atilde; HỘI VIỆT NAM</strong></span></td>\r\n<td width=\"326\" align=\"center\">CỘNG H&Ograve;A X&Atilde; HỘI CHỦ NGHĨA VIỆT  NAM</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td align=\"center\">Độc Lập &ndash; Tự Do &ndash; Hạnh Ph&uacute;c</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td align=\"center\"><strong>***</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td align=\"center\">Mẫu số 01/TBH</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td align=\"center\">(Ban h&agrave;nh k&egrave;m theo cv số 1615/BHXH-CSXH           <br /> ng&agrave;y 02/06/2009 của BHXH VN)</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div style=\"text-align: center;\"><span style=\"font-size: large;\"><strong>TỜ KHAI</strong></span></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div style=\"text-align: center;\"><span style=\"font-size: medium;\"><strong>THAM GIA BẢO HIỂM X&Atilde; HỘI, BẢO HIỂM Y TẾ, BẢO HIỂM THẤT NGHIỆP </strong></span></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\" align=\"center\">\r\n<table style=\"width: 359px; height: 40px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Số sổ :</strong></td>\r\n<td>@#60</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr height=\"2\">\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\"><span style=\"text-decoration: underline;\"><strong>A-NGƯỜI LAO ĐỘNG:</strong></span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 720px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"166\">1. Họ v&agrave; t&ecirc;n</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"146\">@#01</td>\r\n<td width=\"269\">Nam                          <input name=\"checkbox\" type=\"checkbox\" value=\"@#94\" /> , Nữ     <input name=\"checkbox2\" type=\"checkbox\" value=\"@#95\" /></td>\r\n</tr>\r\n<tr>\r\n<td>2. Ng&agrave;y th&aacute;ng năm sinh</td>\r\n<td>:</td>\r\n<td>@#02</td>\r\n<td>D&acirc;n tộc: KINH , Quốc Tịch: VIỆT NAM<br /></td>\r\n</tr>\r\n<tr>\r\n<td>3. Nguy&ecirc;n qu&aacute;n</td>\r\n<td>:</td>\r\n<td colspan=\"2\">@#05</td>\r\n</tr>\r\n<tr>\r\n<td>4. Nợi cư tr&uacute;(Nơi thường tr&uacute; hoặc tạm tr&uacute;)</td>\r\n<td>:</td>\r\n<td colspan=\"2\">@#06, @#07</td>\r\n</tr>\r\n<tr>\r\n<td>5. Chứng minh thư số</td>\r\n<td>:</td>\r\n<td colspan=\"2\">@#08 nơi cấp: @#09, cấp ng&agrave;y @#10</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"4\">6. Hợp đồng lao động (hoặc hợp đồng l&agrave;m việc): Số @#41 ng&agrave;y @#42 / th&aacute;ng @#43 / năm @#44 c&oacute; hiệu lực từ ng&agrave;y @#45 th&aacute;ng @#46 năm @#47 . Loại hợp đồng @#48. <br /></td>\r\n</tr>\r\n<tr>\r\n<td>7. Chức vụ, chức danh nghề<br /></td>\r\n<td>:</td>\r\n<td colspan=\"4\">@#49<br /></td>\r\n</tr>\r\n<tr>\r\n<td>8. Cơ quan, đơn vị</td>\r\n<td>:</td>\r\n<td colspan=\"4\">@#50</td>\r\n</tr>\r\n<tr>\r\n<td>9. Địa chỉ</td>\r\n<td>:</td>\r\n<td colspan=\"4\">@#51 đồng<br /></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"4\">10. Nơi đang k&yacute; kh&aacute;m chữa bệnh ban đầu : @#11</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"4\">11.Đối tượng hưởng BHYT mức <br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 720px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td colspan=\"10\">12. Qu&aacute; tr&igrave;nh đ&oacute;ng, chưa hưởng BHXH một lần v&agrave; BH thất nghiệp:</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<table style=\"width: 100%;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td rowspan=\"2\" align=\"center\">Từ Th&aacute;ng năm</td>\r\n<td rowspan=\"2\" align=\"center\">Đến Th&aacute;ng năm</td>\r\n<td rowspan=\"2\" align=\"center\">Cấp bậc, chức vụ, chức danh nghề, c&ocirc;ng việc, nơi l&agrave;m việc (t&ecirc;n cơ quan, đơn vị, địa chỉ)</td>\r\n<td rowspan=\"2\" width=\"13%\" align=\"center\">Tiền lương, tiền c&ocirc;ng</td>\r\n<td colspan=\"4\" align=\"center\">Phụ cấp</td>\r\n<td width=\"10%\" align=\"center\">Ghi ch&uacute;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"6%\" align=\"center\">Chức vụ</td>\r\n<td width=\"5%\" align=\"center\">TN VK</td>\r\n<td width=\"6%\" align=\"center\">TN nghề</td>\r\n<td width=\"5%\" align=\"center\">Kh&aacute;c</td>\r\n<td align=\"center\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"8%\" align=\"center\">1</td>\r\n<td width=\"8%\" align=\"center\">2</td>\r\n<td width=\"39%\" align=\"center\">3</td>\r\n<td align=\"center\">4</td>\r\n<td align=\"center\">5</td>\r\n<td align=\"center\">6</td>\r\n<td align=\"center\">7</td>\r\n<td align=\"center\">8</td>\r\n<td align=\"center\">9</td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\">@#12</td>\r\n<td align=\"center\">@#13</td>\r\n<td align=\"center\"><span>@#14</span></td>\r\n<td align=\"center\">@#15</td>\r\n<td>@#16</td>\r\n<td>@#17</td>\r\n<td>@#18</td>\r\n<td>@#19</td>\r\n<td><span>@#20</span></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<p><span style=\"text-decoration: underline;\">Cam kết:</span>Những nội dung k&ecirc; khai tr&ecirc;n l&agrave; ho&agrave;n to&agrave;n đ&uacute;ng sự thật, nếu sai tr&aacute;i t&ocirc;i xin chịu tr&aacute;ch nhiệm trước ph&aacute;p luật</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 720px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"5\">\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td colspan=\"2\" width=\"55\">\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ng&agrave;y....Th&aacute;ng ...Năm</p>\r\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>Người khai&nbsp; </strong><br /></td>\r\n<td width=\"28\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p>&nbsp;</p>\r\n</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><span style=\"text-decoration: underline;\">B. X&Aacute;C NHẬN CỦA NGƯỜI SỬ DỤNG LAO ĐỘNG&nbsp;</span></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">Cơ quan đơn vị tổ chức:C&ocirc;ng ty TNHH Vĩ An<br /></td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">\r\n<p>sau khi kiểm tra, đối chiếu hồ sơ gốc của (&ocirc;ng) b&agrave;: @#01</p>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">X&aacute;c nhận c&aacute;c nội dung k&ecirc; khai l&agrave; đ&uacute;ng.</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TP HCM.Ng&agrave;y... Th&aacute;ng .....năm</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Người sử dụng lao động</strong></td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (K&yacute; v&agrave; đ&oacute;ng dấu)</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\"><span style=\"text-decoration: underline;\">C. X&Aacute;C NHẬN CỦA CƠ QUAN BẢO HIỂM X&Atilde; HỘI:</span></td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">Bảo hiểm x&atilde; hội..........................................sau khi kiểm tra , đối chiếu với hồ sơ gốc của c&aacute; nh&acirc;n (&ocirc;ng)b&agrave;:</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">nh&acirc;n (&ocirc;ng)b&agrave;:............................................x&aacute;c nhận c&aacute;c nội dung k&ecirc; khai tr&ecirc;n l&agrave; đ&uacute;ng.<br /></td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"9\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; .......Ng&agrave;y... Th&aacute;ng .....năm 20..<br /></td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: left;\"><strong>C&aacute;n bộ thẩm định</strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><strong>Gi&aacute;m đốc BHXH</strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">(K&yacute; v&agrave; ghi r&otilde; họ t&ecirc;n)</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td style=\"text-align: center;\" colspan=\"3\">(K&yacute; v&agrave; đ&oacute;ng dấu)</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\"><br /></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\"><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>');
INSERT INTO `hr_lv0043` VALUES ('TEM004', 'Biểu mẫu đau ốm', '<table style=\"width: 1000px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"112\">&nbsp;</td>\r\n<td width=\"33\">&nbsp;</td>\r\n<td width=\"3\">&nbsp;</td>\r\n<td width=\"185\">&nbsp;</td>\r\n<td width=\"79\">&nbsp;</td>\r\n<td width=\"87\">&nbsp;</td>\r\n<td width=\"87\">&nbsp;</td>\r\n<td width=\"87\">&nbsp;</td>\r\n<td width=\"87\">&nbsp;</td>\r\n<td width=\"3\">&nbsp;</td>\r\n<td width=\"191\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">T&ecirc;n cơ quan (đơn vị)</td>\r\n<td width=\"3\">:</td>\r\n<td colspan=\"4\">@#01</td>\r\n<td width=\"87\">&nbsp;</td>\r\n<td width=\"87\"><em><strong>Mẫu số </strong></em></td>\r\n<td width=\"3\"><em><strong>:</strong></em></td>\r\n<td width=\"191\"><em><strong>C66a - HD </strong></em></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\">M&atilde; đơn vị</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"185\">A 4585</td>\r\n<td width=\"79\">&nbsp;</td>\r\n<td width=\"87\">&nbsp;</td>\r\n<td width=\"87\">&nbsp;</td>\r\n<td width=\"87\">&nbsp;</td>\r\n<td width=\"87\">&nbsp;</td>\r\n<td width=\"3\">&nbsp;</td>\r\n<td width=\"191\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td class=\"CaptionT\" colspan=\"11\">\r\n<div style=\"text-align: center;\"><strong>DANH S&Aacute;CH NGƯỜI LAO ĐỘNG ĐỀ NGHỊ HƯỞNG CHẾ ĐỘ ỐM ĐAU </strong></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td class=\"CaptionT\" colspan=\"11\">\r\n<div style=\"text-align: center;\"><strong>Th&aacute;ng @#02 qu&yacute; @#03 năm @#04 </strong></div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"2\">\r\n<td width=\"142\">&nbsp;</td>\r\n<td width=\"3\">&nbsp;</td>\r\n<td width=\"2\">&nbsp;</td>\r\n<td width=\"52\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"114\">&nbsp;</td>\r\n<td width=\"6\">&nbsp;</td>\r\n<td width=\"60\">&nbsp;</td>\r\n<td width=\"73\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>T&agrave;i khoản số</td>\r\n<td>:</td>\r\n<td colspan=\"4\">100014851075850</td>\r\n<td>Tại ng&acirc;n h&agrave;ng</td>\r\n<td>:</td>\r\n<td colspan=\"2\">EXIMBANK.TPHCM</td>\r\n</tr>\r\n<tr>\r\n<td>Tổng số lao động</td>\r\n<td>:</td>\r\n<td colspan=\"4\">@#05</td>\r\n<td>Trong đ&oacute; nữ</td>\r\n<td>:</td>\r\n<td colspan=\"2\">@#06</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">Tổng quỹ lương trong (th&aacute;ng) qu&yacute; : @#07</td>\r\n</tr>\r\n<tr>\r\n<td>T&ecirc;n đơn vị</td>\r\n<td>:</td>\r\n<td colspan=\"8\">@#08</td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ</td>\r\n<td>:</td>\r\n<td colspan=\"4\">@#09</td>\r\n<td>Điện thoại</td>\r\n<td>:</td>\r\n<td colspan=\"2\">@#10</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 1000px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td align=\"right\">Số :..................</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 1000px;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td rowspan=\"3\" width=\"6%\" align=\"center\"><strong>Số TT </strong></td>\r\n<td rowspan=\"3\" width=\"17%\" align=\"center\"><strong>Họ v&agrave; t&ecirc;n </strong></td>\r\n<td rowspan=\"3\" width=\"7%\" align=\"center\"><strong>Số sổ BHXH </strong></td>\r\n<td rowspan=\"3\" width=\"8%\" align=\"center\"><strong>Điều kiện t&iacute;nh hưởng </strong></td>\r\n<td rowspan=\"3\" width=\"8%\" align=\"center\"><strong>Tiền lương t&iacute;nh hưởng BHXH </strong></td>\r\n<td rowspan=\"3\" width=\"12%\" align=\"center\"><strong>Thời gian đ&oacute;ng BHXH </strong></td>\r\n<td colspan=\"3\" align=\"center\"><strong>Số đơn vị đề nghị </strong></td>\r\n<td rowspan=\"3\" width=\"8%\" align=\"center\"><strong>Ghi ch&uacute; </strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\" align=\"center\"><strong>Số ng&agrave;y nghỉ </strong></td>\r\n<td rowspan=\"2\" width=\"8%\" align=\"center\"><strong>Số tiền </strong></td>\r\n</tr>\r\n<tr>\r\n<td width=\"10%\" align=\"center\"><strong>Trong kỳ </strong></td>\r\n<td width=\"8%\" align=\"center\"><strong>Lũy kết từ đầu năm </strong></td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\"><strong>A</strong></td>\r\n<td align=\"center\"><strong>B</strong></td>\r\n<td align=\"center\"><strong>C</strong></td>\r\n<td align=\"center\"><strong>D</strong></td>\r\n<td align=\"center\"><strong>1</strong></td>\r\n<td align=\"center\"><strong>2</strong></td>\r\n<td align=\"center\"><strong>3</strong></td>\r\n<td align=\"center\"><strong>4</strong></td>\r\n<td align=\"center\"><strong>5</strong></td>\r\n<td align=\"center\"><strong>E</strong></td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\"><strong>I</strong></td>\r\n<td><strong>Bản th&acirc;n ốm ngắn ng&agrave;y </strong></td>\r\n<td>&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"right\">&nbsp;</td>\r\n<td align=\"right\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<!--@#20--> \r\n<tr>\r\n<td align=\"center\"><strong>II</strong></td>\r\n<td><strong>Bản th&acirc;n ốm d&agrave;i ng&agrave;y </strong></td>\r\n<td>&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"right\">&nbsp;</td>\r\n<td align=\"right\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<!--@#21--> \r\n<tr>\r\n<td align=\"center\"><strong>III</strong></td>\r\n<td><strong>Con ốm </strong></td>\r\n<td>&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"right\">&nbsp;</td>\r\n<td align=\"right\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<!--@#22-->\r\n</tbody>\r\n</table>\r\n<table style=\"width: 1000px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"5\">\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\" align=\"center\">Tp. HCM, Ng&agrave;y @#12 th&aacute;ng @#13 năm  @#14</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><strong>C&aacute;n bộ thu </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><strong>Người lập </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><strong>Kế to&aacute;n trưởng </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><strong>Thủ trưởng đơn vị </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\">......................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td style=\"text-align: center;\" colspan=\"3\">......................................</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\">..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\">..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>');
INSERT INTO `hr_lv0043` VALUES ('TEM005', 'Biểu mẫu 03a - Danh sách điều chỉnh lao động và mức đóng BHXH, BHYT, BHTN', '<table style=\"width: 1060px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td rowspan=\"3\" width=\"302\">\r\n<table style=\"width: 302px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"2\">\r\n<td width=\"103\">&nbsp;</td>\r\n<td width=\"3\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n<td width=\"35\">&nbsp;</td>\r\n<td width=\"39\">&nbsp;</td>\r\n<td width=\"39\">&nbsp;</td>\r\n<td width=\"78\">&nbsp;</td>\r\n<td width=\"4\">&nbsp;</td>\r\n<td width=\"40\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>M&atilde; đơn vị</td>\r\n<td>:</td>\r\n<td colspan=\"8\">A4585</td>\r\n</tr>\r\n<tr>\r\n<td>T&ecirc;n đơn vị</td>\r\n<td>:</td>\r\n<td colspan=\"8\">@#01</td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ</td>\r\n<td>:</td>\r\n<td colspan=\"8\">@#02</td>\r\n</tr>\r\n<tr>\r\n<td>Điện thoại</td>\r\n<td>:</td>\r\n<td colspan=\"8\">08.38163228</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\" align=\"center\">\r\n<h2><strong>DANH S&Aacute;CH ĐỀ NGHỊ ĐIỀU CHỈNH LAO ĐỘNG V&Agrave; MỨC Đ&Oacute;NG BHXH, BHYT, BHTN</strong></h2>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td width=\"56\"><strong>Mẫu số : </strong></td>\r\n<td width=\"53\"><strong>03a-TBH</strong></td>\r\n<td width=\"89\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\" align=\"center\"><strong>(Số ..................Th&aacute;ng @#03 năm @#04 ) </strong></td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\"><br /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"5\">&nbsp;</td>\r\n<td width=\"103\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"93\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 1060px;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td rowspan=\"4\" width=\"2%\" align=\"center\">Số TT</td>\r\n<td rowspan=\"4\" width=\"17%\" align=\"center\">Họ v&agrave; t&ecirc;n</td>\r\n<td rowspan=\"4\" width=\"4%\" align=\"center\">M&atilde; số BHXH</td>\r\n<td rowspan=\"4\" width=\"10%\" align=\"center\">Ng&agrave;y th&aacute;ng năm sinh</td>\r\n<td colspan=\"10\" align=\"center\">Tiền lương v&agrave; phụ cấp</td>\r\n<td colspan=\"2\" align=\"center\">&nbsp;</td>\r\n<td rowspan=\"4\" width=\"8%\" align=\"center\">Tỷ lệ đ&oacute;ng<br /></td>\r\n<td rowspan=\"4\">Thay đổi chức danh</td>\r\n<td colspan=\"2\" rowspan=\"3\" align=\"center\">Ghi ch&uacute;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\" align=\"center\">Mức lương cũ</td>\r\n<td colspan=\"5\" align=\"center\">Mức lương mới</td>\r\n<td colspan=\"2\" align=\"center\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"4%\" align=\"center\">&nbsp;</td>\r\n<td colspan=\"4\" align=\"center\">Phụ cấp</td>\r\n<td width=\"4%\" align=\"center\">&nbsp;</td>\r\n<td colspan=\"4\" align=\"center\">Phụ cấp</td>\r\n<td colspan=\"2\" align=\"center\">Thời gian điều chỉnh</td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\">Tiền lương, tiền c&ocirc;ng</td>\r\n<td width=\"3%\" align=\"center\">Chức vụ</td>\r\n<td width=\"3%\" align=\"center\">Th&acirc;m ni&ecirc;n VK</td>\r\n<td width=\"3%\" align=\"center\">Th&acirc;m ni&ecirc;n nghề</td>\r\n<td width=\"3%\" align=\"center\">kh&aacute;c</td>\r\n<td align=\"center\">Tiền lương, tiền c&ocirc;ng</td>\r\n<td width=\"3%\" align=\"center\">Chức vụ</td>\r\n<td width=\"3%\" align=\"center\">Th&acirc;m ni&ecirc;n VK</td>\r\n<td width=\"3%\" align=\"center\">Th&acirc;m ni&ecirc;n nghề</td>\r\n<td width=\"3%\" align=\"center\">kh&aacute;c</td>\r\n<td width=\"3%\" align=\"center\">Từ th&aacute;ng</td>\r\n<td width=\"3%\" align=\"center\">Đến th&aacute;ng</td>\r\n<td width=\"6%\" align=\"center\">Trả thẻ</td>\r\n<td width=\"15%\" align=\"center\">N&ocirc;i dung</td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\">1</td>\r\n<td align=\"center\">2</td>\r\n<td align=\"center\">3</td>\r\n<td align=\"center\">4</td>\r\n<td align=\"center\">5</td>\r\n<td align=\"center\">6</td>\r\n<td align=\"center\">7</td>\r\n<td align=\"center\">8</td>\r\n<td align=\"center\">9</td>\r\n<td align=\"center\">10</td>\r\n<td align=\"center\">11</td>\r\n<td align=\"center\">12</td>\r\n<td align=\"center\">13</td>\r\n<td align=\"center\">14</td>\r\n<td align=\"center\">15</td>\r\n<td align=\"center\">16</td>\r\n<td align=\"center\">17</td>\r\n<td style=\"text-align: center;\">18</td>\r\n<td align=\"center\">19</td>\r\n<td align=\"center\">20</td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\"><strong>A</strong></td>\r\n<td><strong>Đ/c lao động, tiền lương đ&oacute;ng BHXH, BHYT </strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center;\"><em><strong>I</strong></em></td>\r\n<td><strong>Lao động tăng</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<!--@#70--> \r\n<tr>\r\n<td align=\"center\"><em><strong>II</strong></em></td>\r\n<td><strong>Giảm lao động </strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<!--@#20--> \r\n<tr>\r\n<td align=\"center\"><em><strong>III</strong></em></td>\r\n<td><strong>Thay đổi lương, chức danh c&ocirc;ng việc</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<!--@#21--> \r\n<tr>\r\n<td align=\"center\"><em><strong>IV</strong></em></td>\r\n<td><strong>Bổ sung BHYT</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<!--@#22--> \r\n<tr>\r\n<td align=\"center\"><em><strong>V</strong></em></td>\r\n<td><strong>Bổ sung BH thất nghiệp</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<!--@#50-->\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<table style=\"width: 1060px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td><strong>TỔNG HỢP CHUNG: </strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 1060px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 70%;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: left;\" rowspan=\"2\"><strong>A. Ph&aacute;t sinh kỳ n&agrave;y</strong></td>\r\n<td colspan=\"2\" align=\"center\">Bảo hiểm y tế</td>\r\n<td colspan=\"2\" align=\"center\">Bảo hiểm thất nghiệp</td>\r\n<td colspan=\"2\" align=\"center\">Bảo hiểm x&atilde; hội</td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\">Tăng</td>\r\n<td align=\"center\">Giảm</td>\r\n<td align=\"center\">Tăng</td>\r\n<td align=\"center\">Giảm</td>\r\n<td align=\"center\">Tăng</td>\r\n<td align=\"center\">Giảm</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">1.Số lao động</td>\r\n<td align=\"center\">@#13</td>\r\n<td align=\"center\">@#16</td>\r\n<td align=\"center\">@#19</td>\r\n<td align=\"center\">@#32</td>\r\n<td align=\"center\">@#07</td>\r\n<td align=\"center\">@#10</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">2.Quỹ lương</td>\r\n<td align=\"center\">@#14</td>\r\n<td align=\"center\">@#17</td>\r\n<td align=\"center\">@#30</td>\r\n<td align=\"center\">@#33</td>\r\n<td align=\"center\">@#08</td>\r\n<td align=\"center\">@#11</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">3.Số phải nộp</td>\r\n<td align=\"center\">@#15</td>\r\n<td align=\"center\">@#18</td>\r\n<td align=\"center\">@#31</td>\r\n<td align=\"center\">@#34</td>\r\n<td align=\"center\">@#09</td>\r\n<td align=\"center\">@#12</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">4.Điều chỉnh số phải nộp</td>\r\n<td align=\"center\">@#51</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">@#52</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"width: 1060px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<table style=\"width: 70%;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: left;\" rowspan=\"2\"><strong>B. Tổng hợp cuối kỳ</strong></td>\r\n<td colspan=\"2\" align=\"center\">Bảo hiểm y tế</td>\r\n<td colspan=\"2\" align=\"center\">Bảo hiểm thất nghiệp</td>\r\n<td colspan=\"2\" align=\"center\">Bảo hiểm x&atilde; hội</td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\">Kỳ trước</td>\r\n<td align=\"center\">Kỳ n&agrave;y</td>\r\n<td align=\"center\">Kỳ trước</td>\r\n<td align=\"center\">Kỳ n&agrave;y</td>\r\n<td align=\"center\">Kỳ trước</td>\r\n<td align=\"center\">Kỳ n&agrave;y</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">1.Số lao động</td>\r\n<td align=\"center\">@#77</td>\r\n<td align=\"center\">@#80</td>\r\n<td align=\"center\">@#83</td>\r\n<td align=\"center\">@#86</td>\r\n<td align=\"center\">@#71</td>\r\n<td align=\"center\">@#74</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">2.Quỹ lương</td>\r\n<td align=\"center\">@#78</td>\r\n<td align=\"center\">@#81</td>\r\n<td align=\"center\">@#84</td>\r\n<td align=\"center\">@#87</td>\r\n<td align=\"center\">@#72</td>\r\n<td align=\"center\">@#75</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">3.Số phải nộp</td>\r\n<td align=\"center\">@#79</td>\r\n<td align=\"center\">@#82</td>\r\n<td align=\"center\">@#85</td>\r\n<td align=\"center\">@#88</td>\r\n<td align=\"center\">@#73</td>\r\n<td align=\"center\">@#76</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<table style=\"width: 1060px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"5\">\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\" align=\"center\">Tp. HCM, Ng&agrave;y  @#35 th&aacute;ng @#36 năm @#37</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>C&aacute;n bộ thu BHXH </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>Phụ tr&aacute;ch thu BHXH </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>Người lập biểu </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>Người sử dụng lao động </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>......................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div id=\"_mcePaste\" style=\"overflow: hidden; position: absolute; left: -10000px; top: 391px; width: 1px; height: 1px;\">\r\n<table style=\"width: 70%;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td rowspan=\"2\" align=\"center\">Ph&aacute;t sinh</td>\r\n<td colspan=\"2\" align=\"center\">Bảo hiểm x&atilde; hội</td>\r\n<td colspan=\"2\" align=\"center\">Bảo hiểm y tế</td>\r\n<td colspan=\"2\" align=\"center\">Bảo hiểm thất nghiệp</td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\">Tăng</td>\r\n<td align=\"center\">Giảm</td>\r\n<td align=\"center\">Tăng</td>\r\n<td align=\"center\">Giảm</td>\r\n<td align=\"center\">Tăng</td>\r\n<td align=\"center\">Giảm</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">1.Số lao động</td>\r\n<td align=\"center\">@#07</td>\r\n<td align=\"center\">@#10</td>\r\n<td align=\"center\">@#13</td>\r\n<td align=\"center\">@#16</td>\r\n<td align=\"center\">@#19</td>\r\n<td align=\"center\">@#32</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">2.Quỹ lương</td>\r\n<td align=\"center\">@#08</td>\r\n<td align=\"center\">@#11</td>\r\n<td align=\"center\">@#14</td>\r\n<td align=\"center\">@#17</td>\r\n<td align=\"center\">@#30</td>\r\n<td align=\"center\">@#33</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">3.Số phải nộp</td>\r\n<td align=\"center\">@#09</td>\r\n<td align=\"center\">@#12</td>\r\n<td align=\"center\">@#15</td>\r\n<td align=\"center\">@#18</td>\r\n<td align=\"center\">@#31</td>\r\n<td align=\"center\">@#34</td>\r\n</tr>\r\n<tr>\r\n<td align=\"left\">4.Điều chỉnh số phải nộp</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>');
INSERT INTO `hr_lv0043` VALUES ('TEM006', 'Biểu mẫu 02a - tham gia bảo hiểm', '<table style=\"width: 1060px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td rowspan=\"3\" width=\"302\">\r\n<table style=\"width: 302px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"2\">\r\n<td width=\"103\">&nbsp;</td>\r\n<td width=\"3\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n<td width=\"35\">&nbsp;</td>\r\n<td width=\"39\">&nbsp;</td>\r\n<td width=\"39\">&nbsp;</td>\r\n<td width=\"78\">&nbsp;</td>\r\n<td width=\"4\">&nbsp;</td>\r\n<td width=\"40\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>T&ecirc;n đơn vị</td>\r\n<td>:</td>\r\n<td colspan=\"8\">@#01</td>\r\n</tr>\r\n<tr>\r\n<td>M&atilde; đơn vị</td>\r\n<td>:</td>\r\n<td colspan=\"8\">A4585</td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ</td>\r\n<td>:</td>\r\n<td colspan=\"8\">@#02</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\" align=\"center\">\r\n<h2><strong>DANH S&Aacute;CH LAO ĐỘNG THAM GIA BHXH, BHYT </strong></h2>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td width=\"56\"><strong>Mẫu số : </strong></td>\r\n<td width=\"53\"><strong>02a-TBH</strong></td>\r\n<td width=\"89\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\" align=\"center\"><strong>(K&egrave;m c&ocirc;ng văn số .....................................Th&aacute;ng @#03 năm @#04 ) </strong></td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">Ban h&agrave;nh kềm theo QĐ số..........QĐ-</td>\r\n</tr>\r\n<tr>\r\n<td width=\"5\">&nbsp;</td>\r\n<td width=\"103\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"93\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n<td colspan=\"3\">BHXH ng&agrave;y..../12/2007 của BHXH VN</td>\r\n</tr>\r\n<tr>\r\n<td class=\"CaptionT\" colspan=\"14\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td class=\"CaptionT\" colspan=\"14\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 1060px;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td rowspan=\"2\" width=\"2%\" align=\"center\">Số TT</td>\r\n<td rowspan=\"2\" width=\"14%\" align=\"center\">Họ v&agrave; t&ecirc;n</td>\r\n<td rowspan=\"2\" width=\"4%\" align=\"center\">Số sổ BHXH</td>\r\n<td rowspan=\"2\" width=\"4%\" align=\"center\">Số thẻ BHYT</td>\r\n<td rowspan=\"2\" width=\"3%\" align=\"center\">Ng&agrave;y, th&aacute;ng, năm sinh</td>\r\n<td rowspan=\"2\" width=\"2%\" align=\"center\">Nữ</td>\r\n<td rowspan=\"2\" width=\"4%\" align=\"center\">Số chứng minh thư</td>\r\n<td rowspan=\"2\" width=\"2%\" align=\"center\">Địa chỉ</td>\r\n<td colspan=\"2\" align=\"center\">Nơi đăng k&yacute; KCB ban đầu</td>\r\n<td rowspan=\"2\" width=\"5%\" align=\"center\">Tiền lương tiền c&ocirc;ng</td>\r\n<td colspan=\"4\" align=\"center\">Phụ cấp</td>\r\n<td rowspan=\"2\" width=\"6%\" align=\"center\">Bảo hiểm thất nghiệp</td>\r\n<td rowspan=\"2\" width=\"6%\" align=\"center\">Đ&oacute;ng từ th&aacute;ng,năm</td>\r\n<td rowspan=\"2\" width=\"14%\" align=\"center\">Ghi ch&uacute;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"4%\" align=\"center\">Tỉnh</td>\r\n<td width=\"18%\" align=\"center\">Bệnh viện</td>\r\n<td width=\"4%\" align=\"center\">Chức vụ</td>\r\n<td width=\"5%\" align=\"center\">Th&acirc;m niện VK</td>\r\n<td width=\"4%\" align=\"center\">Th&acirc;m ni&ecirc;n nghề</td>\r\n<td width=\"5%\" align=\"center\">Khu vực</td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\">1</td>\r\n<td align=\"center\">2</td>\r\n<td align=\"center\">3</td>\r\n<td align=\"center\">4</td>\r\n<td align=\"center\">5</td>\r\n<td align=\"center\">6</td>\r\n<td align=\"center\">7</td>\r\n<td align=\"center\">8</td>\r\n<td align=\"center\">9</td>\r\n<td align=\"center\">10</td>\r\n<td align=\"center\">11</td>\r\n<td align=\"center\">12</td>\r\n<td align=\"center\">13</td>\r\n<td align=\"center\">14</td>\r\n<td align=\"center\">15</td>\r\n<td align=\"center\">16</td>\r\n<td align=\"center\">17</td>\r\n<td align=\"center\">18</td>\r\n</tr>\r\n<!--@20--> \r\n<tr>\r\n<td colspan=\"2\" align=\"center\"><strong>Tổng cộng </strong></td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"right\">@#05</td>\r\n<td align=\"right\">@#20</td>\r\n<td align=\"right\">@#21</td>\r\n<td align=\"right\">@#22</td>\r\n<td align=\"right\">@#23</td>\r\n<td align=\"right\">@#05</td>\r\n<td align=\"right\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<table style=\"width: 1060px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"604\">&nbsp;</td>\r\n<td width=\"456\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"width: 96%;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td><strong>* Phần d&agrave;nh cho cơ quan BHXH ghi:</strong></td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"2%\">&nbsp;</td>\r\n<td width=\"95%\">- Số sổ BHXH được cấp:.....................................số, Từ số:..................................Đến số:.......................................</td>\r\n<td width=\"3%\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>- Số thẻ BHYT được cấp: @#15 thẻ, trong đ&oacute; cấp ngo&agrave;i tỉnh: @#16  thẻ</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>- Thời hạn sử dụng của thẻ BHYT: Từ ng&agrave;y  ........../............/....................Đến ng&agrave;y ........../............/......................</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td align=\"right\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<table style=\"width: 1060px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"5\">\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\" align=\"center\">Tp. HCM, Ng&agrave;y @#19 th&aacute;ng @#18 năm @#17</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>C&aacute;n bộ thu BHXH </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>Gi&aacute;m đốc BHXH </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>Người lập biểu </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>Người sử dụng lao động </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>......................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"19\">Ghi ch&uacute;: Mẫu 02a-TBH đơn vị sử dụng lập khi tham gia BHXH, BHYT lần đầu hoặc khi c&oacute; lao động tăng mới để cấp thẻ BHYT, số BHXH.</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div id=\"_mcePaste\" style=\"overflow: hidden; position: absolute; left: -10000px; top: 168px; width: 1px; height: 1px;\">* Phần d&agrave;nh cho cơ quan BHXH ghi:</div>');
INSERT INTO `hr_lv0043` VALUES ('TEM007', 'Biểu mẫu 01a - tham gia bảo hiểm', '<table style=\"width: 1060px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td rowspan=\"3\" width=\"302\">\r\n<table style=\"width: 302px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"2\">\r\n<td width=\"103\">&nbsp;</td>\r\n<td width=\"3\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n<td width=\"35\">&nbsp;</td>\r\n<td width=\"39\">&nbsp;</td>\r\n<td width=\"39\">&nbsp;</td>\r\n<td width=\"78\">&nbsp;</td>\r\n<td width=\"4\">&nbsp;</td>\r\n<td width=\"40\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>M&atilde; đơn vị</td>\r\n<td>:</td>\r\n<td colspan=\"8\">TV1527V&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; M&atilde; KCB: C8821</td>\r\n</tr>\r\n<tr>\r\n<td>T&ecirc;n đơn vị</td>\r\n<td>:</td>\r\n<td colspan=\"8\">@#01</td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ</td>\r\n<td>:</td>\r\n<td colspan=\"8\">@#02</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\" align=\"center\">\r\n<h2><strong>DANH S&Aacute;CH LAO ĐỘNG THAM GIA BHXH, BHYT </strong></h2>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td width=\"56\"><strong>Mẫu số : </strong></td>\r\n<td width=\"53\"><strong>01a-TBH</strong></td>\r\n<td width=\"89\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\" align=\"center\"><strong>(K&egrave;m c&ocirc;ng văn số .....................................Th&aacute;ng @#03 năm @#04 ) </strong></td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\"><br /></td>\r\n</tr>\r\n<tr>\r\n<td width=\"5\">&nbsp;</td>\r\n<td width=\"103\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"50\">&nbsp;</td>\r\n<td width=\"93\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n<td colspan=\"3\"><br /></td>\r\n</tr>\r\n<tr>\r\n<td class=\"CaptionT\" colspan=\"14\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td class=\"CaptionT\" colspan=\"14\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 1060px;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td rowspan=\"2\" width=\"2%\" align=\"center\">Số TT</td>\r\n<td rowspan=\"2\" width=\"14%\" align=\"center\">Họ v&agrave; t&ecirc;n</td>\r\n<td rowspan=\"2\" width=\"4%\" align=\"center\">Số sổ BHXH</td>\r\n<td rowspan=\"2\" width=\"4%\" align=\"center\">Số thẻ BHYT</td>\r\n<td rowspan=\"2\" width=\"3%\" align=\"center\">Ng&agrave;y, th&aacute;ng, năm sinh</td>\r\n<td rowspan=\"2\" width=\"2%\" align=\"center\">Nữ</td>\r\n<td colspan=\"3\" align=\"center\">Số chứng minh thư</td>\r\n<td rowspan=\"2\" width=\"2%\" align=\"center\">Nguy&ecirc;n qu&aacute;n</td>\r\n<td rowspan=\"2\" width=\"2%\" align=\"center\">Chức danh c&ocirc;ng việc</td>\r\n<td rowspan=\"2\" width=\"20%\" align=\"center\">Địa chỉ</td>\r\n<td colspan=\"2\" align=\"center\">Nơi đăng k&yacute; KCB ban đầu</td>\r\n<td rowspan=\"2\" width=\"14%\" align=\"center\">Ghi ch&uacute;</td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\">Số</td>\r\n<td align=\"center\">Ng&agrave;y cấp</td>\r\n<td align=\"center\">Nơi cấp</td>\r\n<td width=\"4%\" align=\"center\">Tỉnh</td>\r\n<td style=\"width: 6%;\" align=\"center\">Bệnh viện</td>\r\n</tr>\r\n<tr>\r\n<td align=\"center\">1</td>\r\n<td align=\"center\">2</td>\r\n<td align=\"center\">3</td>\r\n<td align=\"center\">4</td>\r\n<td align=\"center\">5</td>\r\n<td align=\"center\">6</td>\r\n<td width=\"4%\" align=\"center\">7</td>\r\n<td width=\"4%\" align=\"center\">8</td>\r\n<td width=\"4%\" align=\"center\">9</td>\r\n<td align=\"center\">10</td>\r\n<td align=\"center\">11</td>\r\n<td align=\"center\">12</td>\r\n<td align=\"center\">13</td>\r\n<td align=\"center\">14</td>\r\n<td align=\"center\">15</td>\r\n</tr>\r\n<!--@20--> \r\n<tr>\r\n<td colspan=\"2\" align=\"center\"><strong>Tổng cộng </strong></td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td align=\"center\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<table style=\"width: 1060px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"604\">&nbsp;</td>\r\n<td width=\"456\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<table style=\"width: 96%;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td width=\"2%\">&nbsp;</td>\r\n<td width=\"95%\">- Số sổ BHXH được cấp:.....................................số, Từ số:..................................Đến số:.......................................</td>\r\n<td width=\"3%\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>- Số thẻ BHYT được cấp: @#15 thẻ, trong đ&oacute; cấp ngo&agrave;i tỉnh: @#16  thẻ</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>- Thời hạn sử dụng của thẻ BHYT: Từ ng&agrave;y  ........../............/....................Đến ng&agrave;y ........../............/......................</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td align=\"right\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<table style=\"width: 1060px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"5\">\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\" align=\"center\">Tp. HCM, Ng&agrave;y @#19 th&aacute;ng @#18 năm @#17</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>C&aacute;n bộ thu BHXH </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>Phụ tr&aacute;ch thu BHXH </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>Người lập biểu </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>Người sử dụng lao động </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute;, họ t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>......................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"19\">Ghi ch&uacute;: Mẫu 02a-TBH đơn vị sử dụng lập khi tham gia BHXH, BHYT lần đầu hoặc khi c&oacute; lao động tăng mới để cấp thẻ BHYT, số BHXH.</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>');
INSERT INTO `hr_lv0043` VALUES ('TEM008', 'Biểu mẫu 3b- DANH SÁCH ĐỀ NGHỊ ĐIỀU CHỈNH HỒ SƠ CẤP SỔ BHXH, THẺ BHYT', '<table style=\"width: 100%;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<col width=\"34\"></col> <col width=\"162\"></col> <col span=\"2\" width=\"122\"></col> <col width=\"171\"></col> <col width=\"161\"></col> <col width=\"158\"></col> <col width=\"157\"></col> \r\n<tbody>\r\n<tr>\r\n<td style=\"white-space:nowrap\" colspan=\"3\" width=\"318\">M&atilde;&nbsp; đơn    vị: TV1527V&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; M&atilde; KCB: C8821</td>\r\n<td width=\"122\">&nbsp;</td>\r\n<td style=\"white-space:nowrap\" width=\"171\" align=\"center\">&nbsp;&nbsp;<strong>DANH S&Aacute;CH ĐỀ NGHỊ ĐIỀU CHỈNH HỒ SƠ CẤP SỔ BHXH, THẺ BHYT</strong></td>\r\n<td width=\"161\">&nbsp;</td>\r\n<td width=\"158\">&nbsp;</td>\r\n<td style=\"white-space:nowrap\" width=\"157\">Mẫu số 03b-TBH</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"3\">T&ecirc;n    đơn vị:&nbsp; @#01</td>\r\n<td>&nbsp;</td>\r\n<td>(K&egrave;m c&ocirc;ng văn số &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip; ng&agrave;y &hellip; th&aacute;ng <strong>@#03 </strong>năm <strong>@#04 </strong>)</td>\r\n<td width=\"161\">&nbsp;</td>\r\n<td width=\"158\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"4\">Địa chỉ: @#02</td>\r\n<td>&nbsp;</td>\r\n<td width=\"161\">&nbsp;</td>\r\n<td width=\"158\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"2\" height=\"19\">Đi&ecirc;̣n    Thoại&nbsp; :8150268</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"161\">&nbsp;</td>\r\n<td width=\"158\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 646px; height: 139px;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"122\">&nbsp;</td>\r\n<td width=\"171\">&nbsp;</td>\r\n<td width=\"161\">&nbsp;</td>\r\n<td width=\"158\">&nbsp;</td>\r\n<td width=\"157\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"34\">\r\n<div>STT</div>\r\n</td>\r\n<td width=\"162\">\r\n<div>Họ t&ecirc;n</div>\r\n</td>\r\n<td width=\"122\">\r\n<div>Số sổ BHXH</div>\r\n</td>\r\n<td width=\"122\">\r\n<div>Số thẻ KCB</div>\r\n</td>\r\n<td width=\"171\">\r\n<div>Nội dung thay    đổi <br /> (điều chỉnh)</div>\r\n</td>\r\n<td width=\"161\">\r\n<div>Cũ</div>\r\n</td>\r\n<td width=\"158\">\r\n<div>Mới</div>\r\n</td>\r\n<td width=\"157\">\r\n<div>L&yacute; do điều    chỉnh</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>1</td>\r\n<td>2</td>\r\n<td>3</td>\r\n<td>4</td>\r\n<td>5</td>\r\n<td>6</td>\r\n<td>7</td>\r\n<td>8</td>\r\n</tr>\r\n<!--@#20--> \r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 100%;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"2\" align=\"left\"><strong>ĐỀ NGHỊ GIA    HẠN THẺ BHYT:</strong></td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\" align=\"left\">-    Số thẻ BHYT gia hạn:.............. thẻ; Trong đ&oacute; ngoại    tỉnh:............... thẻ.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\" align=\"left\">Thời hạn sử    dụng của thẻ BHYT từ ng&agrave;y __/__/____ đến ng&agrave;y __/__/____</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>Ng&agrave;y..... th&aacute;ng...... năm..........</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>Tp. HCM, Ng&agrave;y  @#35 th&aacute;ng @#36 năm @#37</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div><strong>C&aacute;n bộ thu</strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div><strong>Gi&aacute;m đốc BHXH&nbsp;</strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>\r\n<div><strong>Người lập biểu</strong></div>\r\n</td>\r\n<td>\r\n<div><strong>Người sử dụng lao động</strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>');
INSERT INTO `hr_lv0043` VALUES ('TEM009', 'HỢP ĐỒNG LAO ĐỒNG THỜI VỤ', '<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"2\">\r\n<td width=\"75\">&nbsp;</td>\r\n<td width=\"15\">&nbsp;</td>\r\n<td width=\"57\">&nbsp;</td>\r\n<td width=\"53\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"58\">&nbsp;</td>\r\n<td width=\"63\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div style=\"text-align: center;\"><strong>CỘNG H&Ograve;A X&Atilde; HỘI CHỦ NGHĨA VIỆT </strong><strong> NAM</strong></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div style=\"text-align: center;\"><strong>Độc lập &ndash; Tự do &ndash; Hạnh ph&uacute;c</strong></div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div style=\"text-align: center;\">***</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><strong>T&ecirc;n đơn vị</strong></td>\r\n<td><strong>:</strong></td>\r\n<td colspan=\"8\"><strong>C&Ocirc;NG TY TNHH VĨ AN</strong><strong></strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Số</strong></td>\r\n<td><strong>:</strong></td>\r\n<td colspan=\"8\"><strong>____/2010-HDLD</strong></td>\r\n</tr>\r\n<tr height=\"2\">\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<p align=\"center\"><strong><span style=\"font-size: large;\">HỢP ĐỒNG LAO ĐỘNG</span></strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\">\r\n<div><em>(Ban h&agrave;nh theo Th&ocirc;ng tư số 21/2003/TT &ndash; BLĐTBXH  ng&agrave;y </em><em>22/09/2003</em><em> của Bộ Lao động &ndash; Thương binh v&agrave; X&atilde; hội)</em></div>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"162\">Ch&uacute;ng t&ocirc;i, một b&ecirc;n l&agrave; &Ocirc;ng</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"250\"><strong>T&Ocirc; QUẢNG HUY</strong></td>\r\n<td width=\"69\">Quốc tịch</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"82\"><strong>Mỹ</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Chức vụ</td>\r\n<td>:</td>\r\n<td><strong>Tổng GĐ<br /></strong></td>\r\n<td>Điện thoại</td>\r\n<td>:</td>\r\n<td>08.38163228</td>\r\n</tr>\r\n<tr>\r\n<td>Đại diện cho (1)</td>\r\n<td>:</td>\r\n<td><strong>C&Ocirc;NG TY TNHH VĨ AN</strong></td>\r\n<td>Fax</td>\r\n<td>:</td>\r\n<td>08.38163229</td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ</td>\r\n<td>:</td>\r\n<td colspan=\"4\">L&ocirc; 3/21, đường 19/5A , Q. T&acirc;n B&igrave;nh, Tp. HCM, Vi&ecirc;̣t Nam</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"4\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>V&agrave; một b&ecirc;n l&agrave;<strong> @#01</strong></td>\r\n<td>:</td>\r\n<td><strong>@#02</strong></td>\r\n<td>Quốc tịch</td>\r\n<td>:</td>\r\n<td><strong>@#03</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Sinh ng&agrave;y</td>\r\n<td>:</td>\r\n<td>Năm <strong>@#11</strong> tại <strong>@#12</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ thường tr&uacute;</td>\r\n<td>:</td>\r\n<td colspan=\"4\"><strong>@#13</strong>, <strong>@#14</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Số CMND</td>\r\n<td>:</td>\r\n<td colspan=\"4\"><strong>@#15</strong> Cấp ng&agrave;y <strong>@#16</strong>&nbsp; tại <strong>@#17</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Số sổ lao động(nếu c&oacute;)</td>\r\n<td>:</td>\r\n<td colspan=\"4\"><strong>@#18</strong> Cấp  ng&agrave;y <strong>@#19</strong> tại <strong>@#20</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"6\">Thỏa thuận k&yacute; kết hợp đồng lao động v&agrave; cam kết  l&agrave;m đ&uacute;ng những điều khoản sau đ&acirc;y:</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"2\">\r\n<td width=\"54\">&nbsp;</td>\r\n<td width=\"6\">&nbsp;</td>\r\n<td width=\"185\">&nbsp;</td>\r\n<td width=\"77\">&nbsp;</td>\r\n<td width=\"16\">&nbsp;</td>\r\n<td width=\"1\">&nbsp;</td>\r\n<td width=\"89\">&nbsp;</td>\r\n<td width=\"24\">&nbsp;</td>\r\n<td width=\"48\">&nbsp;</td>\r\n<td width=\"53\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điều 1:</strong></td>\r\n<td colspan=\"9\"><strong>Thời hạn v&agrave; c&ocirc;ng việc hợp đồng</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td>Loại hợp đồng lao động (3):</td>\r\n<td colspan=\"7\">C&oacute; thời hạn.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\">Từ ng&agrave;y <strong>@#22</strong> th&aacute;ng <strong>@#23</strong> năm <strong>@#24</strong> đến ng&agrave;y <strong>@#25</strong> th&aacute;ng <strong>@#26</strong> năm <strong>@#27</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"8\">Địa điểm l&agrave;m việc (4):<strong> </strong>L&ocirc; III-21 đường 19/5A, nh&oacute;m CN III, KCN T&acirc;n b&igrave;nh,T&acirc;n ph&uacute;, TPHCM</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"8\">Chức vụ (nếu c&oacute;):<strong>@#30</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điều 2:</strong></td>\r\n<td colspan=\"9\"><strong>Chế độ l&agrave;m việc</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td>Thời gian l&agrave;m việc (6):</td>\r\n<td colspan=\"7\"><strong>h&agrave;nh ch&aacute;nh</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td><br /></td>\r\n<td style=\"padding-left: 30px;\" colspan=\"8\">\r\n<p>+ S&aacute;ng từ : 7h30</p>\r\n<p>+Chiều từ : 12h</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"8\">Được cấp ph&aacute;t những dụng cụ l&agrave;m việc gồm: c&ocirc;ng cụ phục vụ c&ocirc;ng việc.</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Điều 3</strong><strong>:</strong></td>\r\n<td colspan=\"9\"><strong>Nghĩa vụ v&agrave; quyền lợi của người lao động</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"12\">&nbsp;</td>\r\n<td width=\"13\"><strong><em>1.</em></strong></td>\r\n<td colspan=\"3\"><strong><em>Quyền lợi:</em></strong></td>\r\n<td width=\"111\">&nbsp;</td>\r\n<td width=\"3\">&nbsp;</td>\r\n<td width=\"132\">&nbsp;</td>\r\n<td width=\"72\">&nbsp;</td>\r\n<td width=\"87\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"6\">-</td>\r\n<td colspan=\"7\">Phương tiện đi lại l&agrave;m việc (7): Tự t&uacute;c.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"3\">Mức lương cơ bản (8):</td>\r\n<td>:</td>\r\n<td colspan=\"3\"><strong>@#33</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"3\">H&igrave;nh thức trả lương</td>\r\n<td>:</td>\r\n<td colspan=\"3\">lương th&aacute;ng theo ng&agrave;y c&ocirc;ng thực tế</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td><br /></td>\r\n<td style=\"padding-left: 30px;\" colspan=\"7\">\r\n<p>- Phụ cấp gồm: 1 suất cơm / ng&agrave;y/ca, phụ cấp ng&ograve;ai giờ (nếu c&oacute;) .<br />- Được trả lương v&agrave;o ng&agrave;y 15 th&aacute;ng sau.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tiền thưởng : theo qui chế thưởng của c&ocirc;ng ty<br />&nbsp;&nbsp; &nbsp;&nbsp; Chế độ n&acirc;ng lương: t&ugrave;y thuộc v&agrave;o năng lực v&agrave; hiệu quả c&ocirc;ng việc được x&eacute;t theo qui chế<br />&nbsp;n&acirc;ng lương của c&ocirc;ng ty.<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Được trang bị bảo hộ lao động gồm : &hellip;<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Chế độ nghỉ ngơi: (h&agrave;ng tuần , ph&eacute;p năm, lễ , tết &hellip;&hellip;&hellip;): theo luật định <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; +&nbsp; Ph&eacute;p năm: 12 ng&agrave;y / năm<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + 9 ng&agrave;y lễ, tết</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Bảo hiểm x&atilde; hội bảo hiểm y tế &amp; BHTN : Nộp theo quy định của luật Lao Đ&ocirc;ng Việt Nam<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Người sử dụng lao động nộp : 20% tiền lương<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Người lao động nộp &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 8.5% tiền lương&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - Chế độ đ&agrave;o tạo : được tổ chức đ&agrave;o tạo t&ugrave;y thuộc v&agrave;o vị tr&iacute; c&ocirc;ng việc.</p>\r\n<p>&nbsp;</p>\r\n</td>\r\n</tr>\r\n<!--                         \r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Được trang bị bảo hộ lao động gồm: Một năm   được cấp trước 02 bộ đồng phục (6 th&aacute;ng /1 bộ)  nếu l&agrave;m kh&ocirc;ng đủ thời gian tr&ecirc;n th&igrave; phải trả lại tiền đồng phục cho c&ocirc;ng ty.</td>\r\n</tr>\r\n-->                           \r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"5\">Những thỏa thuận kh&aacute;c (13):</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"9\" valign=\"top\">+</td>\r\n<td colspan=\"6\"><strong>@#45</strong><strong> @#46</strong> phải chấp h&agrave;nh sự điều động v&agrave; thực hiện đ&uacute;ng theo nội quy của c&ocirc;ng ty.</td>\r\n</tr>\r\n<tr height=\"2\">\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"108\">&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td><strong><em>2.</em></strong></td>\r\n<td colspan=\"8\"><strong><em>Nghĩa vụ:</em></strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"7\">Ho&agrave;n th&agrave;nh những c&ocirc;ng việc đ&atilde; cam kết trong hợp  đồng lao động.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>-</td>\r\n<td colspan=\"7\">Chấp h&agrave;nh lệnh điều h&agrave;nh sản xuất &ndash; kinh doanh,  nội quy kỷ luật lao động, an to&agrave;n lao động.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Bồi thường vi phạm v&agrave; vật chất (14): Trong qu&aacute; tr&igrave;nh l&agrave;m việc nếu g&acirc;y thiệt hại đến t&agrave;i sản của C&ocirc;ng ty th&igrave; phải bồi thường theo quy định của ph&aacute;p luật.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Điều 4:</strong></td>\r\n<td colspan=\"9\"><strong>Nghĩa vụ v&agrave; quyền hạn của người sử dụng lao động</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"13\">&nbsp;</td>\r\n<td width=\"15\"><strong><em>1.</em></strong></td>\r\n<td colspan=\"8\"><strong><em>Nghĩa vụ:</em></strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td width=\"6\">-</td>\r\n<td colspan=\"7\">Đảm bảo việc l&agrave;m v&agrave; thực hiện đầy đủ những điều đ&atilde; cam kết trong hợp đồng lao động.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Thanh to&aacute;n đầy đủ, đ&uacute;ng thời hạn c&aacute;c chế độ v&agrave; quyền lợi của người lao động theo hợp đồng lao động, thỏa ước lao động tập thể.<br /></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td><strong><em>2.</em></strong></td>\r\n<td colspan=\"8\"><strong><em>Quyền hạn:</em></strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Điều h&agrave;nh người lao động ho&agrave;n th&agrave;nh c&ocirc;ng việc theo hợp đồng lao động ( bố tr&iacute;, điều chuyển, tạm ngừng c&ocirc;ng việc &hellip;&hellip;&hellip;).</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"7\">Tạm ho&atilde;n, chấm dứt hợp đồng lao động, kỹ luật người lao động theo quy định của ph&aacute;p luật, thỏa ước lao động tập thể&nbsp; v&agrave; nội qui lao động của doanh nghiệp.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"56\"><strong>Điều 5:</strong></td>\r\n<td width=\"497\"><strong>Điều khoản thi h&agrave;nh</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"31\">&nbsp;</td>\r\n<td width=\"10\" valign=\"top\">-</td>\r\n<td colspan=\"8\">Những vấn đề về lao đ&ocirc;ng kh&ocirc;ng ghi trong hợp đồng n&agrave;y th&igrave; &aacute;p dụng quy định của thỏa ước lao động tập thể, trường hợp chưa c&oacute; thỏa ước lao động tập thể th&igrave; &aacute;p dụng quy định của ph&aacute;p luật lao động.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\">Hợp đồng lao động được l&agrave;m th&agrave;nh 02 bản c&oacute; gi&aacute;  trị ngang nhau, mỗi b&ecirc;n giữ một bản v&agrave; c&oacute; hiệu lực từ ng&agrave;y <strong>@#47</strong> th&aacute;ng <strong>@#48</strong> năm  <strong>@#49</strong>. Khi hai b&ecirc;n k&yacute; kết phụ lục hợp đồng lao động th&igrave; nội dung của phụ lục hợp  đồng lao động cũng c&oacute; gi&aacute; trị như c&aacute;c nội dung của bản hợp đồng lao động n&agrave;y.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"9\">Hợp đồng n&agrave;y l&agrave;m tại C&ocirc;ng ty TNHH sợi ASF, k&yacute; ng&agrave;y <strong>@#50</strong> th&aacute;ng <strong>@#51</strong> năm <strong>@#52</strong>.</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 610px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr height=\"5\">\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><strong>NGƯỜI LAO ĐỘNG</strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><strong>NGƯỜI SỬ DỤNG LAO ĐỘNG</strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><em>(K&yacute; t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><em>(K&yacute; t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><em>Ghi r&otilde; họ v&agrave; t&ecirc;n</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\"><em>Ghi r&otilde; họ v&agrave; t&ecirc;n</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\">......................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div style=\"text-align: center;\">..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>');

-- ----------------------------
-- Table structure for hr_lv0044
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0044`;
CREATE TABLE `hr_lv0044` (
  `lv001` char(6) NOT NULL DEFAULT '',
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` char(32) DEFAULT NULL,
  `lv005` date DEFAULT NULL,
  `lv006` tinyint(1) DEFAULT NULL,
  `lv007` text,
  `lv008` text,
  `lv009` text,
  `lv010` text,
  `lv011` char(6) DEFAULT NULL,
  `lv012` decimal(28,2) DEFAULT '0.00',
  `lv013` decimal(28,2) DEFAULT '0.00',
  `lv014` decimal(28,2) DEFAULT '0.00',
  `lv015` text,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0044
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0045
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0045`;
CREATE TABLE `hr_lv0045` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` varchar(50) DEFAULT NULL,
  `lv005` char(6) DEFAULT NULL,
  `lv006` varchar(50) DEFAULT NULL,
  `lv007` decimal(28,2) DEFAULT NULL,
  `lv008` tinyint(1) DEFAULT NULL,
  `lv009` varchar(255) DEFAULT NULL,
  `lv010` decimal(28,1) DEFAULT NULL,
  `lv011` decimal(28,1) DEFAULT NULL,
  `lv012` decimal(28,1) DEFAULT NULL,
  `lv013` decimal(28,1) DEFAULT NULL,
  `lv014` char(6) DEFAULT NULL,
  `lv015` decimal(28,2) DEFAULT '22.00',
  `lv016` decimal(28,2) DEFAULT '4.50',
  `lv017` decimal(28,2) DEFAULT '2.00',
  `lv018` date DEFAULT NULL,
  `lv019` int(11) DEFAULT '1',
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0045
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0046
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0046`;
CREATE TABLE `hr_lv0046` (
  `lv001` bigint(38) NOT NULL,
  `lv002` char(6) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` decimal(28,1) DEFAULT NULL,
  `lv005` tinyint(1) DEFAULT NULL,
  `lv006` date DEFAULT NULL,
  `lv007` varchar(255) DEFAULT NULL,
  `lv008` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0046
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0047
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0047`;
CREATE TABLE `hr_lv0047` (
  `lv001` bigint(28) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(32) DEFAULT NULL,
  `lv003` char(6) NOT NULL DEFAULT '',
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` datetime DEFAULT NULL,
  `lv006` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`lv001`,`lv003`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; InnoDB free: 7168 kB; InnoDB free: 102';

-- ----------------------------
-- Records of hr_lv0047
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0048
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0048`;
CREATE TABLE `hr_lv0048` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` varchar(50) DEFAULT NULL,
  `lv005` char(6) DEFAULT NULL,
  `lv006` varchar(50) DEFAULT NULL,
  `lv007` decimal(28,2) DEFAULT NULL,
  `lv008` tinyint(1) DEFAULT NULL,
  `lv009` varchar(255) DEFAULT NULL,
  `lv010` decimal(28,1) DEFAULT NULL,
  `lv011` decimal(28,1) DEFAULT NULL,
  `lv012` decimal(28,1) DEFAULT NULL,
  `lv013` decimal(28,1) DEFAULT NULL,
  `lv014` char(6) DEFAULT NULL,
  `lv015` decimal(28,2) DEFAULT '22.00',
  `lv016` decimal(28,2) DEFAULT '4.50',
  `lv017` decimal(28,2) DEFAULT '2.00',
  `lv018` date DEFAULT NULL,
  `lv019` int(4) DEFAULT '1',
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0048
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0076
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0076`;
CREATE TABLE `hr_lv0076` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` char(32) DEFAULT NULL,
  `lv005` varchar(255) DEFAULT NULL,
  `lv006` int(11) DEFAULT NULL,
  `lv007` date DEFAULT NULL,
  `lv008` date DEFAULT NULL,
  `lv009` char(32) DEFAULT NULL,
  `lv010` char(32) DEFAULT NULL,
  `lv011` decimal(18,2) DEFAULT NULL,
  `lv012` decimal(28,0) DEFAULT NULL,
  `lv013` varchar(4096) DEFAULT NULL,
  `lv014` tinyint(1) DEFAULT NULL,
  `lv015` char(32) DEFAULT NULL,
  `lv016` datetime DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0076
-- ----------------------------
-- ----------------------------
-- Table structure for hr_lv0077
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0077`;
CREATE TABLE `hr_lv0077` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0077
-- ----------------------------
INSERT INTO `hr_lv0077` VALUES ('INT1', 'VÒNG PHỎNG VẤN I', 'YÊU CẦU NHẬP THÔNG TIN NGƯỜI PHỎNG VẤN - PHỎNG VẤN SƠ LƯỢT');
INSERT INTO `hr_lv0077` VALUES ('INT2', 'VÒNG PHỎNG VẤN II', 'PHỎNG VẤN CHI TIẾT VÀ ĐÁNH GIÁ KẾT QUẢ');
INSERT INTO `hr_lv0077` VALUES ('INT3', 'VÒNG PHỎNG VẤN III', 'CẦN XÁC NHẬN THÊM VỀ NGƯỜI PHỎNG TRƯỚC KHI QUYẾT ĐỊNH TUYỂN DỤNG');

-- ----------------------------
-- Table structure for hr_lv0078
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0078`;
CREATE TABLE `hr_lv0078` (
  `lv001` char(32) NOT NULL,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(50) DEFAULT NULL,
  `lv004` varchar(50) DEFAULT NULL,
  `lv005` varchar(50) DEFAULT NULL,
  `lv006` varchar(50) DEFAULT NULL,
  `lv007` char(15) DEFAULT NULL,
  `lv008` date DEFAULT NULL,
  `lv009` varchar(255) DEFAULT NULL,
  `lv010` date DEFAULT NULL,
  `lv011` varchar(255) DEFAULT NULL,
  `lv012` tinyint(1) DEFAULT NULL,
  `lv013` char(6) DEFAULT NULL,
  `lv014` char(6) DEFAULT NULL,
  `lv015` char(6) DEFAULT NULL,
  `lv016` char(6) DEFAULT NULL,
  `lv017` char(6) DEFAULT NULL,
  `lv018` char(5) DEFAULT NULL,
  `lv019` varchar(500) DEFAULT NULL,
  `lv020` varchar(500) DEFAULT NULL,
  `lv021` varchar(50) DEFAULT NULL,
  `lv022` varchar(50) DEFAULT NULL,
  `lv023` varchar(20) DEFAULT NULL,
  `lv024` varchar(100) DEFAULT NULL,
  `lv025` varchar(100) DEFAULT NULL,
  `lv026` decimal(28,0) DEFAULT NULL,
  `lv027` decimal(28,0) DEFAULT NULL,
  `lv028` char(32) DEFAULT NULL,
  `lv029` varchar(1024) DEFAULT NULL,
  `lv030` varchar(1024) DEFAULT NULL,
  `lv031` varchar(1024) DEFAULT NULL,
  `lv032` varchar(500) DEFAULT NULL,
  `lv033` varchar(255) DEFAULT NULL,
  `lv034` varchar(255) DEFAULT NULL,
  `lv035` varchar(255) DEFAULT NULL,
  `lv036` varchar(1024) DEFAULT NULL,
  `lv037` varchar(4096) DEFAULT NULL,
  `lv038` varchar(500) DEFAULT NULL,
  `lv039` char(32) DEFAULT NULL,
  `lv040` datetime DEFAULT NULL,
  `lv041` tinyint(1) DEFAULT NULL,
  `lv042` datetime DEFAULT NULL,
  `lv043` char(32) DEFAULT NULL,
  `lv044` char(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for hr_lv0079
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0079`;
CREATE TABLE `hr_lv0079` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` time DEFAULT NULL,
  `lv006` time DEFAULT NULL,
  `lv007` varchar(500) DEFAULT NULL,
  `lv008` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0079
-- ----------------------------

-- ----------------------------
-- Table structure for hr_lv0081
-- ----------------------------
DROP TABLE IF EXISTS `hr_lv0081`;
CREATE TABLE `hr_lv0081` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hr_lv0081
-- ----------------------------
INSERT INTO `hr_lv0081` VALUES ('1', 'ĐỢI PHỎNG VẤN', 'ĐỢI PHỎNG VẤN');
INSERT INTO `hr_lv0081` VALUES ('2', 'CHẤP NHẬN TUYỂN', 'CHẤP NHẬN TUYỂN');
INSERT INTO `hr_lv0081` VALUES ('0', 'KHÔNG ĐẠT VÀ HỦY HỒ SƠ', 'KHÔNG ĐẠT VÀ HỦY HỒ SƠ');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `ID` bigint(38) NOT NULL AUTO_INCREMENT,
  `UserID` varchar(32) NOT NULL,
  `LoginDate` date DEFAULT NULL,
  `LoginTime` time DEFAULT NULL,
  `State` tinyint(1) DEFAULT NULL,
  `Ip` varchar(32) DEFAULT NULL,
  `Mac` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 3072 kB; InnoDB free: 3072 kB; InnoDB free: 112';

-- ----------------------------
-- Records of log
-- ----------------------------

-- ----------------------------
-- Table structure for logemp
-- ----------------------------
DROP TABLE IF EXISTS `logemp`;
CREATE TABLE `logemp` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `EmployeeID` varchar(32) NOT NULL,
  `LoginDate` varchar(20) DEFAULT NULL,
  `LoginTime` varchar(20) DEFAULT NULL,
  `State` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 11264 kB; InnoDB free: 11264 kB; InnoDB free: 1';

-- ----------------------------
-- Records of logemp
-- ----------------------------

-- ----------------------------
-- Table structure for lv_lv0001
-- ----------------------------
DROP TABLE IF EXISTS `lv_lv0001`;
CREATE TABLE `lv_lv0001` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(32) DEFAULT NULL,
  `lv003` datetime DEFAULT NULL,
  `lv004` varchar(32) DEFAULT NULL,
  `lv005` text,
  `lv006` varchar(32) DEFAULT NULL,
  `lv007` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lv_lv0001
-- ----------------------------

-- ----------------------------
-- Table structure for lv_lv0002
-- ----------------------------
DROP TABLE IF EXISTS `lv_lv0002`;
CREATE TABLE `lv_lv0002` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(32) DEFAULT NULL,
  `lv003` varchar(32) DEFAULT NULL,
  `lv004` varchar(500) DEFAULT NULL,
  `lv005` int(8) DEFAULT NULL,
  `lv006` int(11) DEFAULT NULL,
  `lv007` varchar(500) DEFAULT NULL,
  `lv008` tinyint(1) DEFAULT '0',
  `lv009` varchar(4096) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lv_lv0004
-- ----------------------------
DROP TABLE IF EXISTS `lv_lv0004`;
CREATE TABLE `lv_lv0004` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lv_lv0004
-- ----------------------------
INSERT INTO `lv_lv0004` VALUES ('GU0001', 'Sales');
INSERT INTO `lv_lv0004` VALUES ('GU0002', 'Director');
INSERT INTO `lv_lv0004` VALUES ('GU0003', 'Manager');
INSERT INTO `lv_lv0004` VALUES ('GU0004', 'Employee');

-- ----------------------------
-- Table structure for lv_lv0005
-- ----------------------------
DROP TABLE IF EXISTS `lv_lv0005`;
CREATE TABLE `lv_lv0005` (
  `lv001` varchar(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` tinyint(4) NOT NULL DEFAULT '0',
  `lv005` tinyint(1) DEFAULT NULL,
  `lv006` varchar(6) DEFAULT NULL,
  `lv007` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`lv001`,`lv004`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 11264 kB; InnoDB free: 11264 kB; InnoDB free: 6';

-- ----------------------------
-- Records of lv_lv0005
-- ----------------------------
INSERT INTO `lv_lv0005` VALUES ('Ac0088', 'Income Employee Salary', 'ac_lv0088/ac_lv0088.php', '8', '0', 'Tc0037', '2');
INSERT INTO `lv_lv0005` VALUES ('Ac0089', 'Outcome Employee Salary', 'ac_lv0089/ac_lv0089.php', '8', '0', 'Tc0037', '2');
INSERT INTO `lv_lv0005` VALUES ('Ac0090', 'Check In_OutCome Salary Account', 'ac_lv0090/ac_lv0090.php', '8', '0', 'Tc0037', '2');
INSERT INTO `lv_lv0005` VALUES ('Ac0091', 'Quickly Income Employee Salary', 'ac_lv0091/ac_lv0091.php', '8', '0', 'Ac0088', '3');
INSERT INTO `lv_lv0005` VALUES ('Ac0092', 'Income Temp Salary Account', 'ac_lv0092/ac_lv0092.php', '8', '1', 'Ac0091', '4');
INSERT INTO `lv_lv0005` VALUES ('Ac0093', 'Quickly Outcome Employee Salary', 'ac_lv0093/ac_lv0093.php', '8', '0', 'Ac0089', '3');
INSERT INTO `lv_lv0005` VALUES ('Ac0094', 'Outcome Temp Salary Account', 'ac_lv0094/ac_lv0094.php', '8', '1', 'Ac0066', '4');
INSERT INTO `lv_lv0005` VALUES ('Ac0095', 'InCome Detail', 'ac_lv0095/ac_lv0095.php', '8', '0', 'Ac0088', '3');
INSERT INTO `lv_lv0005` VALUES ('Ac0096', 'OutCome Detail', 'ac_lv0096/ac_lv0096.php', '8', '0', 'Ac0089', '3');
INSERT INTO `lv_lv0005` VALUES ('Ac0097', 'In_OutCome detail', 'ac_lv0097/ac_lv0097.php', '8', '0', 'Ac0090', '3');
INSERT INTO `lv_lv0005` VALUES ('Ac0098', 'Report Income/Outcome', '', '8', '0', 'Tc0037', '2');
INSERT INTO `lv_lv0005` VALUES ('Ac0099', 'Report from sum', 'ac_lv0099/ac_lv0099.php', '8', '0', 'Ac0098', '3');
INSERT INTO `lv_lv0005` VALUES ('Ac0100', 'Report from condition', 'ac_lv0100/ac_lv0100.php', '8', '0', 'Ac0098', '3');
INSERT INTO `lv_lv0005` VALUES ('Ad0001', 'Right for company', 'hr_lv0001/hr_lv0001.php', '10', '0', 'Ad0036', '1');
INSERT INTO `lv_lv0005` VALUES ('Ad0002', 'Right for department', 'hr_lv0002/hr_lv0002.php', '10', '0', 'Ad0036', '1');
INSERT INTO `lv_lv0005` VALUES ('Ad0003', 'Right for employee', 'hr_lv0020/hr_lv0020.php', '5', '0', 'Ad0105', '1');
INSERT INTO `lv_lv0005` VALUES ('Ad0005', 'Right for usergroup', 'lv_lv0004/lv_lv0004.php', '1', '0', 'Ad0118', '1');
INSERT INTO `lv_lv0005` VALUES ('Ad0009', 'Right for rights', 'lv_lv0005/lv_lv0005.php', '1', '1', 'Ad0118', '1');
INSERT INTO `lv_lv0005` VALUES ('Ad0011', 'Right for RightControl', 'lv_lv0006/lv_lv0006.php', '1', '1', 'Ad0118', '1');
INSERT INTO `lv_lv0005` VALUES ('Ad0012', 'Right for User', 'lv_lv0007/lv_lv0007.php', '1', '0', 'Ad0118', '1');
INSERT INTO `lv_lv0005` VALUES ('Ad0013', 'Right for Permission Config', 'security/securitylist.php', '1', '1', '', null);
INSERT INTO `lv_lv0005` VALUES ('Ad0014', 'Right for Log', '', '1', '1', '', null);
INSERT INTO `lv_lv0005` VALUES ('Ad0018', 'Right for Human Resource', '', '0', '1', '', null);
INSERT INTO `lv_lv0005` VALUES ('Ad0033', 'Right for Images', 'images/imageslist.php', '1', '0', 'Ad0118', '1');
INSERT INTO `lv_lv0005` VALUES ('Ad0036', 'Module Public', '', '10', '1', 'Ad0036', '0');
INSERT INTO `lv_lv0005` VALUES ('Ad0037', 'Right for kind of user ', 'usercategory/usercategorylist.php', '1', '1', '', null);
INSERT INTO `lv_lv0005` VALUES ('Ad0102', 'Right for Mail Management', '', '102', '1', 'Ad0102', '0');
INSERT INTO `lv_lv0005` VALUES ('Ad0105', 'Right for Control Employee HR', '', '5', '1', 'Ad0105', '0');
INSERT INTO `lv_lv0005` VALUES ('Ad0114', 'Module Public Maketing', '', '22', '1', 'Ad0114', '0');
INSERT INTO `lv_lv0005` VALUES ('Ad0118', 'Module Admin', '', '1', '1', 'Ad0118', '0');
INSERT INTO `lv_lv0005` VALUES ('Ad0119', 'Module Timecard & salary', '', '8', '1', 'Ad0119', '0');
INSERT INTO `lv_lv0005` VALUES ('Hr0002', 'Categories/Cycles info', '', '5', '0', 'Ad0105', '1');
INSERT INTO `lv_lv0005` VALUES ('Hr0003', 'Job', '', '5', '0', 'Ad0105', '1');
INSERT INTO `lv_lv0005` VALUES ('Hr0006', 'Qualification', '', '5', '0', 'Ad0105', '1');
INSERT INTO `lv_lv0005` VALUES ('Hr0007', 'Skills', '', '5', '0', 'Ad0105', '1');
INSERT INTO `lv_lv0005` VALUES ('Hr0008', 'Memberships', '', '5', '0', 'Ad0105', '1');
INSERT INTO `lv_lv0005` VALUES ('Hr0009', 'Nationality & Race', '', '5', '0', 'Ad0105', '1');
INSERT INTO `lv_lv0005` VALUES ('Hr0021', 'Employment Status', 'hr_lv0004/hr_lv0004.php', '5', '0', 'Hr0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0022', 'Job Category', 'hr_lv0005/hr_lv0005.php', '5', '0', 'Hr0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0023', 'Job Title', 'hr_lv0007/hr_lv0007.php', '5', '0', 'Hr0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0025', 'Licenses', 'hr_lv0008/hr_lv0008.php', '5', '0', 'Hr0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0026', 'Education', 'hr_lv0009/hr_lv0009.php', '5', '0', 'Hr0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0027', 'Skills', 'hr_lv0010/hr_lv0010.php', '5', '0', 'Hr0007', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0028', 'Membership Type', 'hr_lv0012/hr_lv0012.php', '5', '0', 'Hr0008', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0029', 'Membership', 'hr_lv0013/hr_lv0013.php', '5', '0', 'Hr0008', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0030', 'Nationality', 'hr_lv0014/hr_lv0014.php', '5', '0', 'Hr0009', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0031', 'Ethnic Race', 'hr_lv0015/hr_lv0015.php', '5', '0', 'Hr0009', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0032', 'Pay Grade', 'hr_lv0006/hr_lv0006.php', '5', '0', 'Hr0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0033', 'Salary Currency', '', '5', '1', 'Hr0032', '3');
INSERT INTO `lv_lv0005` VALUES ('Hr0035', 'Languages', 'hr_lv0011/hr_lv0011.php', '5', '0', 'Hr0007', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0036', 'Performance Cycles', 'hr_lv0003/hr_lv0003.php', '5', '0', 'Hr0002', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0037', 'Currency', 'hr_lv0018/hr_lv0018.php', '10', '0', 'Ad0036', '1');
INSERT INTO `lv_lv0005` VALUES ('Hr0042', 'Nation', 'hr_lv0016/hr_lv0016.php', '5', '0', 'Hr0009', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0043', 'Religion', 'hr_lv0017/hr_lv0017.php', '5', '0', 'Hr0009', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0044', 'Employee\'s Basic salary', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0045', 'Employee\'s Childrens', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0046', 'Employee\'s Contracts', 'hr_lv0038/hr_lv0038.php', '5', '0', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0047', 'Employee\'s Dependents', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0048', 'Employee\'s Educations', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0049', 'Employee\'s Emergency Contracts', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0050', 'Employee\'s Experiences', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0051', 'Employee\'s Languages', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0052', 'Employee\'s Licenses', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0053', 'Employee\'s Membership', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0054', 'Employee\'s Passports', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0055', 'Employee\'s Performances', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0056', 'Employee\'s Skills', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0057', 'Employee\'s Documents', '', '5', '1', 'Ad0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0058', 'Control Insurances', '', '5', '0', 'Ad0105', '1');
INSERT INTO `lv_lv0005` VALUES ('Hr0059', 'Hospital', 'hr_lv0019/hr_lv0019.php', '5', '0', 'Hr0058', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0060', 'Make issurances', 'hr_lv0044/hr_lv0044.php', '5', '0', 'Hr0058', '3');
INSERT INTO `lv_lv0005` VALUES ('Hr0061', 'Married status', 'hr_lv0021/hr_lv0021.php', '5', '0', 'Hr0009', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0062', 'Employee status ', 'hr_lv0022/hr_lv0022.php', '5', '0', 'Hr0009', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0063', 'Province Or State', 'hr_lv0023/hr_lv0023.php', '5', '0', 'Hr0009', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0064', 'Category dependents', 'hr_lv0025/hr_lv0025.php', '5', '0', 'Hr0009', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0065', 'Skills Language', 'hr_lv0032/hr_lv0032.php', '5', '0', 'Hr0007', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0066', 'Performance Cycles', 'hr_lv0035/hr_lv0035.php', '5', '0', 'Hr0002', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0067', 'Divide Salary ', 'hr_lv0037/hr_lv0037.php', '5', '0', 'Hr0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0068', 'Type Salary ', 'hr_lv0039/hr_lv0039.php', '5', '0', 'Hr0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0069', 'Type Documents', 'hr_lv0040/hr_lv0040.php', '5', '0', 'Hr0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0070', 'Template Labour Contract', 'hr_lv0043/hr_lv0043.php', '10', '0', 'Pu0001', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0071', 'Input insurance', 'hr_lv0045/hr_lv0045.php', '10', '0', 'Hr0060', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0072', 'Input rest pregnancy', 'hr_lv0046/hr_lv0046.php', '10', '0', 'Hr0060', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0073', 'Save document', 'hr_lv0047/hr_lv0047.php', '10', '0', 'Hr0060', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0075', 'Recruitment Management', '', '5', '0', 'Ad0105', '1');
INSERT INTO `lv_lv0005` VALUES ('Hr0076', 'Recuitment Position', 'hr_lv0076/hr_lv0076.php', '5', '0', 'Hr0075', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0077', 'Interview circle', 'hr_lv0077/hr_lv0077.php', '5', '0', 'Hr0075', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0078', 'List of candidates', 'hr_lv0078/hr_lv0078.php', '5', '0', 'Hr0076', '3');
INSERT INTO `lv_lv0005` VALUES ('Hr0079', 'Times to Interview', 'hr_lv0079/hr_lv0079.php', '5', '0', 'Hr0078', '4');
INSERT INTO `lv_lv0005` VALUES ('Hr0080', 'Save document candidate', 'hr_lv0080/hr_lv0080.php', '5', '1', 'Hr0078', '4');
INSERT INTO `lv_lv0005` VALUES ('Hr0081', 'Result Candidate', 'hr_lv0081/hr_lv0081.php', '5', '0', 'Hr0075', '2');
INSERT INTO `lv_lv0005` VALUES ('Hr0082', 'Save email candidate', 'hr_lv0082/hr_lv0082.php', '5', '1', 'Hr0078', '4');
INSERT INTO `lv_lv0005` VALUES ('Ml0001', 'Mail Inbox Manager', 'ml_lv0001/ml_lv0001.php', '102', '0', 'Ad0102', '1');
INSERT INTO `lv_lv0005` VALUES ('Ml0002', 'Mail Outbox Manager', 'ml_lv0002/ml_lv0002.php', '102', '0', 'Ad0102', '1');
INSERT INTO `lv_lv0005` VALUES ('Ml0003', 'Mail Delete Box Manager', 'ml_lv0003/ml_lv0003.php', '102', '0', 'Ad0102', '1');
INSERT INTO `lv_lv0005` VALUES ('Ml0004', 'Mail Send Box Manager', 'ml_lv0004/ml_lv0004.php', '102', '0', 'Ad0102', '1');
INSERT INTO `lv_lv0005` VALUES ('Ml0005', 'Mail Send/Reciept Mail', 'ml_lv0005/ml_lv0005.php', '102', '0', 'Ad0102', '1');
INSERT INTO `lv_lv0005` VALUES ('Ml0006', 'Address Contact Mail', 'ml_lv0006/ml_lv0006.php', '102', '0', 'Pu0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Ml0007', 'Self Information attach mail', 'ml_lv0007/ml_lv0007.php', '102', '0', 'Pu0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Ml0008', 'User config mail', 'ml_lv0008/ml_lv0008.php', '102', '0', 'Pu0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Ml0009', 'System config mail', 'ml_lv0009/ml_lv0009.php', '102', '0', 'Pu0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Ml0010', 'Attach mail', 'ml_lv0010/ml_lv0010.php', '102', '1', 'Ml0002', '2');
INSERT INTO `lv_lv0005` VALUES ('Ml0011', 'View all mail', 'ml_lv0011/ml_lv0011.php', '102', '0', 'Pu0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Ml0013', 'Template marketing', 'ml_lv0013/ml_lv0013.php', '102', '0', 'Pu0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Pu0001', 'Template', '', '10', '0', 'Ad0036', '1');
INSERT INTO `lv_lv0005` VALUES ('Pu0004', 'Information timecard', '', '8', '0', 'Ad0119', '1');
INSERT INTO `lv_lv0005` VALUES ('Pu0005', 'Paramater salary', '', '8', '0', 'Ad0119', '1');
INSERT INTO `lv_lv0005` VALUES ('Pu0006', 'Mail config', '', '102', '0', 'Ad0102', '1');
INSERT INTO `lv_lv0005` VALUES ('Rp0001', 'Salary', '', '25', '0', 'Ad0117', '1');
INSERT INTO `lv_lv0005` VALUES ('Rp0002', 'Salary Monthly', 'rp_lv0002/rp_lv0002.php', '25', '0', 'Rp0001', '2');
INSERT INTO `lv_lv0005` VALUES ('Rp0003', 'Time Card', '', '25', '0', 'Ad0117', '1');
INSERT INTO `lv_lv0005` VALUES ('Rp0004', 'View Time In-Out', 'rp_lv0004/rp_lv0004.php', '25', '0', 'Rp0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Rp0005', 'Come late & leave early day', 'rp_lv0005/rp_lv0005.php', '25', '0', 'Rp0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Rp0006', 'Come late & leave early month', 'rp_lv0006/rp_lv0006.php', '25', '0', 'Rp0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Rp0011', 'Come late & leave early year', 'rp_lv0011/rp_lv0011.php', '25', '0', 'Rp0003', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0001', 'Customer', 'sl_lv0001/sl_lv0001.php', '22', '0', 'Ad0114', '1');
INSERT INTO `lv_lv0005` VALUES ('Sl0002', 'Documents customer', 'sl_lv0002/sl_lv0002.php', '22', '0', 'Sl0001', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0003', 'Historys customer', 'sl_lv0003/sl_lv0003.php', '22', '0', 'Sl0001', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0004', 'Products Customer', 'sl_lv0004/sl_lv0004.php', '22', '0', 'Sl0001', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0005', 'Items control', '', '22', '0', 'Ad0114', '1');
INSERT INTO `lv_lv0005` VALUES ('Sl0006', 'Units', 'sl_lv0005/sl_lv0005.php', '10', '0', 'Ad0036', '1');
INSERT INTO `lv_lv0005` VALUES ('Sl0007', 'Item categorys', 'sl_lv0006/sl_lv0006.php', '22', '0', 'Sl0005', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0008', 'Items', 'sl_lv0007/sl_lv0007.php', '22', '0', 'Sl0005', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0009', 'Methods', '', '22', '0', 'Ad0114', '1');
INSERT INTO `lv_lv0005` VALUES ('Sl0010', 'Shipping', 'sl_lv0008/sl_lv0008.php', '22', '0', 'Sl0009', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0011', 'Payment', 'sl_lv0009/sl_lv0009.php', '22', '0', 'Sl0009', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0012', 'Quotation\'s Customer', 'sl_lv0010/sl_lv0010.php', '22', '0', 'Sl0001', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0013', 'Quotation Detail', 'sl_lv0011/sl_lv0011.php', '22', '0', 'Sl0012', '3');
INSERT INTO `lv_lv0005` VALUES ('Sl0014', 'Quotation document', 'sl_lv0012/sl_lv0012.php', '22', '1', 'Sl0012', '3');
INSERT INTO `lv_lv0005` VALUES ('Sl0015', 'Contract\'s Customer', 'sl_lv0013/sl_lv0013.php', '22', '0', 'Sl0001', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0016', 'Contract Detail', 'sl_lv0014/sl_lv0014.php', '22', '0', 'Sl0015', '3');
INSERT INTO `lv_lv0005` VALUES ('Sl0017', 'Contract document', 'sl_lv0015/sl_lv0015.php', '22', '1', 'Sl0015', '3');
INSERT INTO `lv_lv0005` VALUES ('Sl0018', 'Template contracts', 'sl_lv0016/sl_lv0016.php', '10', '0', 'Pu0001', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0019', 'Standards', 'sl_lv0017/sl_lv0017.php', '22', '1', 'Sl0007', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0021', 'OutStock of Contract', '', '22', '1', 'Sl0015', '1');
INSERT INTO `lv_lv0005` VALUES ('Sl0022', 'Return Recieption of Contract', '', '22', '1', 'Sl0015', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0023', 'Return OutStock of Contract', '', '22', '1', 'Sl0015', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0024', 'Sale Retail', 'sl_lv0024/sl_lv0024.php', '22', '0', 'Ad0114', '1');
INSERT INTO `lv_lv0005` VALUES ('Sl0025', 'Sale Retail Detail', 'sl_lv0025/sl_lv0025.php', '22', '0', 'Sl0024', '2');
INSERT INTO `lv_lv0005` VALUES ('Sl0026', 'Sale Retail Quickly', 'sl_lv0026/sl_lv0026.php', '22', '0', 'Sl0024', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0001', 'Projects', 'tc_lv0001/tc_lv0001.php', '8', '0', 'Pu0004', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0002', 'CodeTime', 'tc_lv0002/tc_lv0002.php', '8', '0', 'Pu0004', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0003', 'Special holiday', 'tc_lv0003/tc_lv0003.php', '8', '0', 'Pu0004', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0004', 'Shift', 'tc_lv0004/tc_lv0004.php', '8', '0', 'Pu0004', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0005', 'TaxIncome Rate', 'tc_lv0005/tc_lv0005.php', '8', '0', 'Pu0004', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0006', 'Time Card', 'tc_lv0006/tc_lv0006.php', '8', '0', 'Ad0119', '1');
INSERT INTO `lv_lv0005` VALUES ('Tc0007', 'Manage Time Sheet', 'tc_lv0007/tc_lv0007.php', '8', '1', 'Tc0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0008', 'Information year', 'tc_lv0008/tc_lv0008.php', '8', '1', 'Tc0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0009', 'Information month', 'tc_lv0009/tc_lv0009.php', '8', '1', 'Tc0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0010', 'Calandar', 'tc_lv0010/tc_lv0010.php', '8', '1', 'Tc0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0011', 'Control Create Calendar', 'tc_lv0011/tc_lv0011.php', '8', '1', 'Tc0010', '3');
INSERT INTO `lv_lv0005` VALUES ('Tc0012', 'Enter TimeSheet', 'tc_lv0012/tc_lv0012.php', '8', '1', 'Tc0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0013', 'Set Salary Monthly', 'tc_lv0013/tc_lv0013.php', '8', '0', 'Pu0005', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0014', 'Set TimeCode ', 'tc_lv0014/tc_lv0014.php', '8', '1', 'Tc0013', '3');
INSERT INTO `lv_lv0005` VALUES ('Tc0015', 'Set Item Price', 'tc_lv0015/tc_lv0015.php', '8', '1', 'Tc0013', '3');
INSERT INTO `lv_lv0005` VALUES ('Tc0017', 'Expensive', 'tc_lv0017/tc_lv0017.php', '8', '0', 'Tc0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0018', 'CategoryExpensive', 'tc_lv0018/tc_lv0018.php', '8', '0', 'Pu0005', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0019', 'Salary', 'tc_lv0019/tc_lv0019.php', '8', '0', 'Ad0119', '1');
INSERT INTO `lv_lv0005` VALUES ('Tc0020', 'Calculate Salary', 'tc_lv0020/tc_lv0020.php', '8', '1', 'Tc0019', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0021', 'List Salary All', 'tc_lv0021/tc_lv0021.php', '8', '0', 'Tc0019', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0022', 'Expensive', 'tc_lv0022/tc_lv0022.php', '8', '1', 'Tc0019', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0023', 'Used Cost', 'tc_lv0023/tc_lv0023.php', '8', '0', 'Tc0019', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0024', 'Category costs of temporary', 'tc_lv0024/tc_lv0024.php', '8', '0', 'Pu0005', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0026', 'TimeSheetProduct', 'tc_lv0026/tc_lv0026.php', '8', '1', 'Tc0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0027', 'View TimeCard All', 'tc_lv0027/tc_lv0027.php', '8', '0', 'Tc0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0028', 'View Sheet Product All', 'tc_lv0028/tc_lv0028.php', '8', '0', 'Tc0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0029', 'Load data timecard', 'tc_lv0029/tc_lv0029.php', '8', '0', 'Tc0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0030', 'Calculate TimeWork of Day', 'tc_lv0030/tc_lv0030.php', '8', '0', 'Tc0006', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0031', 'Set total revenue department', 'tc_lv0031/tc_lv0031.php', '8', '1', 'Tc0013', '3');
INSERT INTO `lv_lv0005` VALUES ('Tc0032', 'Type Payroll', 'tc_lv0032/tc_lv0032.php', '8', '0', 'Tc0019', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0033', 'Cost Enter Multi', 'tc_lv0033/tc_lv0033.php', '8', '1', 'Tc0023', '3');
INSERT INTO `lv_lv0005` VALUES ('Tc0034', 'Multi Calculate Salary', 'tc_lv0034/tc_lv0034.php', '8', '0', 'Tc0019', '2');
INSERT INTO `lv_lv0005` VALUES ('Tc0035', 'Line salary of product', 'tc_lv0035/tc_lv0035.php', '8', '1', 'Tc0013', '3');
INSERT INTO `lv_lv0005` VALUES ('Tc0037', 'Salary Income/Outcome', '', '8', '0', 'Ad0119', '1');
INSERT INTO `lv_lv0005` VALUES ('Tc0038', 'Category Income/Outcome', 'tc_lv0038/tc_lv0038.php', '8', '0', 'Tc0037', '2');

-- ----------------------------
-- Table structure for lv_lv0006
-- ----------------------------
DROP TABLE IF EXISTS `lv_lv0006`;
CREATE TABLE `lv_lv0006` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lv_lv0006
-- ----------------------------
INSERT INTO `lv_lv0006` VALUES ('', 'AddNew a object');
INSERT INTO `lv_lv0006` VALUES ('UnApr', 'Un locked');
INSERT INTO `lv_lv0006` VALUES ('Apr', 'Locked');
INSERT INTO `lv_lv0006` VALUES ('Del', 'Delete');
INSERT INTO `lv_lv0006` VALUES ('Edit', 'Edit a object');
INSERT INTO `lv_lv0006` VALUES ('Rpt', 'Report');
INSERT INTO `lv_lv0006` VALUES ('View', 'View a object');

-- ----------------------------
-- Table structure for lv_lv0007
-- ----------------------------
DROP TABLE IF EXISTS `lv_lv0007`;
CREATE TABLE `lv_lv0007` (
  `lv001` varchar(32) NOT NULL,
  `lv002` varchar(8) DEFAULT NULL,
  `lv003` varchar(10) DEFAULT NULL,
  `lv004` varchar(30) DEFAULT NULL,
  `lv005` varchar(50) DEFAULT NULL,
  `lv006` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 11264 kB; InnoDB free: 11264 kB; InnoDB free: 1';

-- ----------------------------
-- Records of lv_lv0007
-- ----------------------------
INSERT INTO `lv_lv0007` VALUES ('admin', 'GU0001', 'admin', 'Administrator', '7d06e8d2348d1b98c1a0d63816a3abda', null);

-- ----------------------------
-- Table structure for lv_lv0008
-- ----------------------------
DROP TABLE IF EXISTS `lv_lv0008`;
CREATE TABLE `lv_lv0008` (
  `lv001` int(11) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(32) DEFAULT NULL,
  `lv003` varchar(6) DEFAULT NULL,
  `lv004` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`lv001`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;



-- ----------------------------
-- Table structure for lv_lv0009
-- ----------------------------
DROP TABLE IF EXISTS `lv_lv0009`;
CREATE TABLE `lv_lv0009` (
  `lv001` int(11) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(6) NOT NULL,
  `lv003` int(11) NOT NULL,
  `lv004` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;



-- ----------------------------
-- Table structure for lv_menu1
-- ----------------------------
DROP TABLE IF EXISTS `lv_menu1`;
CREATE TABLE `lv_menu1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_vn` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `action` char(255) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `typeview` int(4) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lv_menu1
-- ----------------------------
INSERT INTO `lv_menu1` VALUES ('7', 'Trang ch?', 'Home', '', '1', '0', '');
INSERT INTO `lv_menu1` VALUES ('8', 'Gi�p d?', 'Help', 'help', '2', '0', '');
INSERT INTO `lv_menu1` VALUES ('9', 'Li�n h?', 'Contact', 'contact', '3', '0', '');

-- ----------------------------
-- Table structure for lv_menu2
-- ----------------------------
DROP TABLE IF EXISTS `lv_menu2`;
CREATE TABLE `lv_menu2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_vn` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `action` char(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lv_menu2
-- ----------------------------

-- ----------------------------
-- Table structure for lv_menu3
-- ----------------------------
DROP TABLE IF EXISTS `lv_menu3`;
CREATE TABLE `lv_menu3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_vn` varchar(255) DEFAULT NULL,
  `name_en` varchar(255) DEFAULT NULL,
  `action` char(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lv_menu3
-- ----------------------------

-- ----------------------------
-- Table structure for messages
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` varchar(32) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Description` text,
  `UserFrom` varchar(32) NOT NULL,
  `SendDate` date DEFAULT NULL,
  `SendTime` time DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 11264 kB; InnoDB free: 11264 kB; InnoDB free: 1';

-- ----------------------------
-- Records of messages
-- ----------------------------
INSERT INTO `messages` VALUES ('449', 'guest', 'ery', 'yeryre', 'duong', '2006-08-15', '15:34:20');
INSERT INTO `messages` VALUES ('450', 'ha', 'ery', 'yeryre', 'duong', '2006-08-15', '15:34:20');
INSERT INTO `messages` VALUES ('451', 'long', 'ery', 'yeryre', 'duong', '2006-08-15', '15:34:20');
INSERT INTO `messages` VALUES ('453', 'thao', 'ery', 'yeryre', 'duong', '2006-08-15', '15:34:20');
INSERT INTO `messages` VALUES ('456', 'duong', 'test', 'Web\r\nApplication', 'tai', '2006-08-16', '09:27:51');
INSERT INTO `messages` VALUES ('457', 'guest', 'test', 'Web\r\nApplication', 'tai', '2006-08-16', '09:27:51');
INSERT INTO `messages` VALUES ('458', 'ha', 'test', 'Web\r\nApplication', 'tai', '2006-08-16', '09:27:51');
INSERT INTO `messages` VALUES ('459', 'long', 'test', 'Web\r\nApplication', 'tai', '2006-08-16', '09:27:51');
INSERT INTO `messages` VALUES ('460', 'thao', 'test', 'Web\r\nApplication', 'tai', '2006-08-16', '09:27:51');

-- ----------------------------
-- Table structure for ml_lv0001
-- ----------------------------
DROP TABLE IF EXISTS `ml_lv0001`;
CREATE TABLE `ml_lv0001` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` varchar(500) DEFAULT NULL,
  `lv006` varchar(500) DEFAULT NULL,
  `lv007` varchar(500) DEFAULT NULL,
  `lv008` varchar(500) DEFAULT NULL,
  `lv009` char(38) DEFAULT NULL,
  `lv010` varchar(500) DEFAULT NULL,
  `lv011` varchar(1) DEFAULT NULL,
  `lv012` varchar(1) DEFAULT NULL,
  `lv013` varchar(500) DEFAULT NULL,
  `lv014` time DEFAULT NULL,
  `lv015` char(38) DEFAULT NULL,
  `lv016` varchar(500) DEFAULT NULL,
  `lv017` varchar(500) DEFAULT NULL,
  `lv018` tinyint(1) DEFAULT '0',
  `lv019` char(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_lv0001
-- ----------------------------

-- ----------------------------
-- Table structure for ml_lv0001_
-- ----------------------------
DROP TABLE IF EXISTS `ml_lv0001_`;
CREATE TABLE `ml_lv0001_` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv009` mediumtext,
  `lv015` longtext,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_lv0001_
-- ----------------------------

-- ----------------------------
-- Table structure for ml_lv0006
-- ----------------------------
DROP TABLE IF EXISTS `ml_lv0006`;
CREATE TABLE `ml_lv0006` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` varchar(500) DEFAULT NULL,
  `lv006` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_lv0006
-- ----------------------------

-- ----------------------------
-- Table structure for ml_lv0007
-- ----------------------------
DROP TABLE IF EXISTS `ml_lv0007`;
CREATE TABLE `ml_lv0007` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(500) DEFAULT NULL,
  `lv005` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for ml_lv0008
-- ----------------------------
DROP TABLE IF EXISTS `ml_lv0008`;
CREATE TABLE `ml_lv0008` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` tinyint(1) DEFAULT NULL,
  `lv006` tinyint(1) DEFAULT NULL,
  `lv007` tinyint(1) DEFAULT NULL,
  `lv008` tinyint(1) DEFAULT '0',
  `lv009` char(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ml_lv0009
-- ----------------------------
DROP TABLE IF EXISTS `ml_lv0009`;
CREATE TABLE `ml_lv0009` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` varchar(255) DEFAULT NULL,
  `lv006` tinyint(1) DEFAULT NULL,
  `lv007` tinyint(1) DEFAULT NULL,
  `lv008` char(255) DEFAULT NULL,
  `lv009` varchar(255) DEFAULT NULL,
  `lv010` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_lv0009
-- ----------------------------
INSERT INTO `ml_lv0009` VALUES ('1', 'mail.sof.vn', '25', 'SMTP', '', '1', '0', 'vinhlq@sof.vn', '', 'sof.vn');
INSERT INTO `ml_lv0009` VALUES ('2', 'mail.sof.vn', '143', 'IMAP', '', '0', '0', 'vinhlq@sof.vn', '', 'sof.vn');
INSERT INTO `ml_lv0009` VALUES ('3', 'mail.sof.vn', '110', 'POP3', '', '1', '0', 'vinhlq@sof.vn', '', 'sof.vn');

-- ----------------------------
-- Table structure for ml_lv0010
-- ----------------------------
DROP TABLE IF EXISTS `ml_lv0010`;
CREATE TABLE `ml_lv0010` (
  `lv001` bigint(28) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(32) DEFAULT NULL,
  `lv003` decimal(28,2) NOT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` varchar(255) DEFAULT NULL,
  `lv006` datetime DEFAULT NULL,
  PRIMARY KEY (`lv001`,`lv003`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; InnoDB free: 7168 kB; InnoDB free: 102';

-- ----------------------------
-- Records of ml_lv0010
-- ----------------------------

-- ----------------------------
-- Table structure for ml_lv0012
-- ----------------------------
DROP TABLE IF EXISTS `ml_lv0012`;
CREATE TABLE `ml_lv0012` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` varchar(500) DEFAULT NULL,
  `lv006` tinyint(1) DEFAULT NULL,
  `lv007` bigint(38) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_lv0012
-- ----------------------------

-- ----------------------------
-- Table structure for ml_lv0013
-- ----------------------------
DROP TABLE IF EXISTS `ml_lv0013`;
CREATE TABLE `ml_lv0013` (
  `lv001` char(6) NOT NULL DEFAULT '',
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` text,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_lv0013
-- ----------------------------
INSERT INTO `ml_lv0013` VALUES ('PASS', 'MẪU THƯ TRÚNG TUYỂN', '<p style=\"text-align: center;\"><span style=\"font-family: arial,helvetica,sans-serif;\"><strong><span style=\"font-size: x-large;\">THƯ TRÚNG TUY&Ecirc;̉N<br /></span></strong></span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-family: arial,helvetica,sans-serif;\">***</span></p>\r\n<p style=\"text-align: left;\"><span style=\"font-family: arial,helvetica,sans-serif;\"><strong>@#01</strong></span></p>\r\n<p style=\"text-align: left;\"><span style=\"font-family: arial,helvetica,sans-serif;\">Địa chỉ: @#02</span></p>\r\n<p style=\"text-align: left;\"><span style=\"font-family: arial,helvetica,sans-serif;\">Đi&ecirc;̣n thoại:@#03 Fax: @#04</span></p>\r\n<p style=\"text-align: left;\"><span style=\"font-family: arial,helvetica,sans-serif;\">Email:@#05</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: left;\"><span style=\"font-family: arial,helvetica,sans-serif;\">Người trúng tuy&ecirc;̉n: @#06</span></p>\r\n<p style=\"text-align: left;\"><span style=\"font-family: arial,helvetica,sans-serif;\">Địa chỉ: @#07</span></p>\r\n<p style=\"text-align: left;\"><span style=\"font-family: arial,helvetica,sans-serif;\">Đi&ecirc;̣n thoại: @#08</span></p>\r\n<p style=\"text-align: left;\"><span style=\"font-family: arial,helvetica,sans-serif;\">Email: @#09</span></p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\"><strong><span style=\"text-decoration: underline;\">Y&ecirc;u cầu đối với ứng vi&ecirc;n trúng tuy&ecirc;̉n:</span></strong></span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\"><strong>1. Vi trí tuy&ecirc;̉n dụng:</strong></span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + M</strong></span>&atilde; tuyển dụng:&nbsp;<span style=\"font-family: arial,helvetica,sans-serif;\"><strong> </strong></span><strong><span style=\"font-family: arial,helvetica,sans-serif;\">@#20</span></strong></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Ch</strong></span>ủ đề tuyển dụng:&nbsp;<span style=\"font-family: arial,helvetica,sans-serif;\"><strong> </strong></span><strong><span style=\"font-family: arial,helvetica,sans-serif;\">@#21</span></strong><span style=\"font-family: arial,helvetica,sans-serif;\"><strong><br /></strong></span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\"><strong>2.&nbsp;&nbsp;&nbsp; </strong><strong>Ho&agrave;n thiện Hồ sơ:</strong></span></p>\r\n<ol> </ol>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span><span style=\"font-family: arial,helvetica,sans-serif;\"><strong></strong><strong>Thời gian hoàn thành h&ocirc;̀ sơ trước ngày :</strong> @#12</span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>Danh mục Hồ sơ cần ho&agrave;n thiện bao gồm:</strong></span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Sơ yếu l&yacute; lịch c&oacute; x&aacute;c nhận của ch&iacute;nh quyền địa phương (kh&ocirc;ng qu&aacute; 3 th&aacute;ng)</span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Bản sao giấy khai sinh</span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + 03 Bản sao Chứng minh nh&acirc;n d&acirc;n (c&oacute; c&ocirc;ng chứng)</span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Bảo sao sổ hộ khẩu (kh&ocirc;ng cần c&ocirc;ng chứng)</span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Giấy chứng nhận sức khỏe</span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Bản sao c&aacute;c văn bằng chứng chỉ li&ecirc;n quan (c&oacute; c&ocirc;ng chứng)</span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + 4 ảnh 3&nbsp; x&nbsp; 4</span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Giấy bảo l&atilde;nh tr&aacute;ch nhiệm d&acirc;n sự (<strong>download tại đ&acirc;y</strong>)</span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\">&nbsp;3<strong>.&nbsp;&nbsp;&nbsp; </strong><strong>Nhận việc:</strong></span></p>\r\n<ol> </ol>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + </strong><strong>Thời gian:</strong> 8h ng</span>&agrave;y <span style=\"font-family: arial,helvetica,sans-serif;\">@#12</span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + </strong><strong>Địa điểm:</strong> @#13</span></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\">Chú ý: Ứng vi&ecirc;n phải phản h&ocirc;̀i lại thư trong vòng 1 tu&acirc;̀n đ&ecirc;̉ ch&acirc;́p nh&acirc;n trúng tuy&ecirc;̉n.</span></p>');
INSERT INTO `ml_lv0013` VALUES ('INTER', 'THƯ PHỎNG VẤN', '<p style=\"text-align: center;\"><span style=\"font-family: arial,helvetica,sans-serif;\"><strong><span style=\"font-size: x-large;\">THƯ PHỎNG V&Acirc;́N<br /></span></strong></span></p>\r\n<p style=\"text-align: center;\">***</p>\r\n<p style=\"text-align: left; padding-left: 30px;\"><strong>@#01</strong></p>\r\n<p style=\"text-align: left; padding-left: 30px;\">Địa chỉ: @#02</p>\r\n<p style=\"text-align: left; padding-left: 30px;\">Đi&ecirc;̣n thoại:@#03 Fax: @#04</p>\r\n<p style=\"text-align: left; padding-left: 30px;\">Email:@#05</p>\r\n<p style=\"text-align: left;\">&nbsp;</p>\r\n<hr />\r\n<p style=\"text-align: left; padding-left: 30px;\">Người trúng tuy&ecirc;̉n: @#06</p>\r\n<p style=\"text-align: left; padding-left: 30px;\">Địa chỉ: @#07</p>\r\n<p style=\"text-align: left; padding-left: 30px;\">Đi&ecirc;̣n thoại: @#08</p>\r\n<p style=\"text-align: left; padding-left: 30px;\">Email: @#09</p>\r\n<p style=\"text-align: left; padding-left: 30px;\">&nbsp;</p>\r\n<hr />\r\n<p>&nbsp;</p>\r\n<p><strong><span style=\"text-decoration: underline;\">Y&ecirc;u cầu đối với ứng vi&ecirc;n dự tuy&ecirc;̉n:</span></strong></p>\r\n<p><strong>1. &nbsp; Vi trí tuy&ecirc;̉n dụng:</strong></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + M</strong></span>&atilde; tuyển dụng:&nbsp;<span style=\"font-family: arial,helvetica,sans-serif;\"><strong> </strong></span><strong><span style=\"font-family: arial,helvetica,sans-serif;\">@#20</span></strong></p>\r\n<p><span style=\"font-family: arial,helvetica,sans-serif;\"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Ch</strong></span>ủ đề tuyển dụng:&nbsp;<span style=\"font-family: arial,helvetica,sans-serif;\"><strong> </strong></span><strong><span style=\"font-family: arial,helvetica,sans-serif;\">@#21</span></strong></p>\r\n<p><strong>2.&nbsp;&nbsp;&nbsp; </strong><strong>Ho&agrave;n thiện Hồ sơ:</strong></p>\r\n<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Danh mục Hồ sơ cần bao gồm:</strong></p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Sơ yếu l&yacute; lịch c&oacute; x&aacute;c nhận của ch&iacute;nh quyền địa phương (kh&ocirc;ng qu&aacute; 3 th&aacute;ng)</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + 01 Bản sao giấy khai sinh</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + 03 Bản sao Chứng minh nh&acirc;n d&acirc;n (c&oacute; c&ocirc;ng chứng)</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Bảo sao sổ hộ khẩu (kh&ocirc;ng cần c&ocirc;ng chứng)</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Giấy chứng nhận sức khỏe</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Bản sao c&aacute;c văn bằng chứng chỉ li&ecirc;n quan (c&oacute; c&ocirc;ng chứng)</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + 4 ảnh 3&nbsp; x&nbsp; 4</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + Giấy bảo l&atilde;nh tr&aacute;ch nhiệm d&acirc;n sự (<strong>download tại đ&acirc;y</strong>)</p>\r\n<p>&nbsp;3<strong>.&nbsp;&nbsp;&nbsp; </strong><strong>Phỏng v&acirc;́n:</strong></p>\r\n<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; </strong>+ <strong>Thời gian:</strong> @#12</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; + <strong>Địa điểm:</strong> @#13</p>\r\n<p>Chú ý: Ứng vi&ecirc;n phải phản h&ocirc;̀i lại thư trong vòng 1 tu&acirc;̀n đ&ecirc;̉ ch&acirc;́p nh&acirc;n dự tuy&ecirc;̉n.</p>');

-- ----------------------------
-- Table structure for ml_lv0015
-- ----------------------------
DROP TABLE IF EXISTS `ml_lv0015`;
CREATE TABLE `ml_lv0015` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ml_lv0015
-- ----------------------------

-- ----------------------------
-- Table structure for scaletax
-- ----------------------------
DROP TABLE IF EXISTS `scaletax`;
CREATE TABLE `scaletax` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `From` decimal(28,2) DEFAULT NULL,
  `To` decimal(28,2) DEFAULT NULL,
  `PerCal` decimal(28,2) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 11264 kB';

-- ----------------------------
-- Records of scaletax
-- ----------------------------
INSERT INTO `scaletax` VALUES ('5', '0.00', '5000000.00', '0.00');
INSERT INTO `scaletax` VALUES ('6', '5000000.00', '10000000.00', '10.00');
INSERT INTO `scaletax` VALUES ('7', '15000000.00', '25000000.00', '20.00');
INSERT INTO `scaletax` VALUES ('8', '25000000.00', '40000000.00', '30.00');
INSERT INTO `scaletax` VALUES ('9', '40000000.00', '1000000000000.00', '40.00');

-- ----------------------------
-- Table structure for sl_lv0001
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0001`;
CREATE TABLE `sl_lv0001` (
  `lv001` char(10) NOT NULL DEFAULT '',
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(100) DEFAULT NULL,
  `lv004` varchar(100) DEFAULT NULL,
  `lv005` varchar(100) DEFAULT NULL,
  `lv006` varchar(255) DEFAULT NULL,
  `lv007` char(6) DEFAULT NULL,
  `lv008` char(6) DEFAULT NULL,
  `lv009` varchar(20) DEFAULT NULL,
  `lv010` varchar(50) DEFAULT NULL,
  `lv011` varchar(50) DEFAULT NULL,
  `lv012` varchar(50) DEFAULT NULL,
  `lv013` varchar(30) DEFAULT NULL,
  `lv014` varchar(255) DEFAULT NULL,
  `lv015` varchar(255) DEFAULT NULL,
  `lv016` varchar(500) DEFAULT NULL,
  `lv017` varchar(255) DEFAULT NULL,
  `lv018` varchar(32) DEFAULT NULL,
  `lv019` varchar(1000) DEFAULT NULL,
  `lv020` varchar(50) DEFAULT NULL,
  `lv021` varchar(255) DEFAULT NULL,
  `lv022` varchar(32) DEFAULT NULL,
  `lv023` int(11) DEFAULT '1',
  `lv024` datetime DEFAULT NULL,
  `lv025` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0001
-- ----------------------------
INSERT INTO `sl_lv0001` VALUES ('CUS0000001', 'CTY TNHH VIAN', '', '', '', 'Khu Công Nghiệp Tân Binh', 'PR001', 'NL0001', '', '', '', '', '', '', '', '', '', 'NL0001', '', '', '', '', '0', '2012-02-29 09:40:42', '');

-- ----------------------------
-- Table structure for sl_lv0002
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0002`;
CREATE TABLE `sl_lv0002` (
  `lv001` bigint(28) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(32) DEFAULT NULL,
  `lv003` char(6) NOT NULL DEFAULT '',
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` datetime DEFAULT NULL,
  `lv006` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`lv001`,`lv003`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; InnoDB free: 7168 kB; InnoDB free: 102';

-- ----------------------------
-- Records of sl_lv0002
-- ----------------------------

-- ----------------------------
-- Table structure for sl_lv0003
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0003`;
CREATE TABLE `sl_lv0003` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` varchar(50) DEFAULT NULL,
  `lv006` date DEFAULT NULL,
  `lv007` date DEFAULT NULL,
  `lv008` text,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0003
-- ----------------------------

-- ----------------------------
-- Table structure for sl_lv0004
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0004`;
CREATE TABLE `sl_lv0004` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(50) DEFAULT NULL,
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` varchar(255) DEFAULT NULL,
  `lv006` varchar(255) DEFAULT NULL,
  `lv007` char(32) DEFAULT NULL,
  `lv008` text,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0004
-- ----------------------------

-- ----------------------------
-- Table structure for sl_lv0005
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0005`;
CREATE TABLE `sl_lv0005` (
  `lv001` char(6) NOT NULL DEFAULT '',
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0005
-- ----------------------------
INSERT INTO `sl_lv0005` VALUES ('year', 'Năm', '1.00');
INSERT INTO `sl_lv0005` VALUES ('month', 'Tháng', '1.00');

-- ----------------------------
-- Table structure for sl_lv0006
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0006`;
CREATE TABLE `sl_lv0006` (
  `lv001` char(6) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0006
-- ----------------------------


-- ----------------------------
-- Table structure for sl_lv0007
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0007`;
CREATE TABLE `sl_lv0007` (
  `lv001` char(10) NOT NULL DEFAULT '',
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` char(6) DEFAULT NULL,
  `lv004` char(6) DEFAULT NULL,
  `lv005` varchar(255) DEFAULT NULL,
  `lv006` varchar(255) DEFAULT NULL,
  `lv007` decimal(28,2) DEFAULT NULL,
  `lv008` char(6) DEFAULT NULL,
  `lv009` varchar(255) DEFAULT NULL,
  `lv010` text,
  `lv011` decimal(28,1) DEFAULT NULL,
  `lv012` char(6) DEFAULT NULL,
  `lv013` char(32) DEFAULT NULL,
  `lv014` char(32) DEFAULT NULL,
  `lv015` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for sl_lv00072
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv00072`;
CREATE TABLE `sl_lv00072` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` char(6) DEFAULT NULL,
  `lv004` char(6) DEFAULT NULL,
  `lv005` varchar(255) DEFAULT NULL,
  `lv006` varchar(255) DEFAULT NULL,
  `lv007` decimal(28,2) DEFAULT NULL,
  `lv008` char(6) DEFAULT NULL,
  `lv009` varchar(255) DEFAULT NULL,
  `lv010` text,
  `lv011` decimal(28,1) DEFAULT NULL,
  `lv012` char(6) DEFAULT NULL,
  `lv013` char(32) DEFAULT NULL,
  `lv014` char(32) DEFAULT NULL,
  `lv015` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sl_lv0008
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0008`;
CREATE TABLE `sl_lv0008` (
  `lv001` char(6) NOT NULL DEFAULT '',
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0008
-- ----------------------------
INSERT INTO `sl_lv0008` VALUES ('EXW', 'Giao tại xưởng', 'Ex Works');
INSERT INTO `sl_lv0008` VALUES ('FCA', 'Giao cho người chuyên chở', 'Free Carrier');
INSERT INTO `sl_lv0008` VALUES ('FAS', 'Giao doc mạn tàu', 'Free Alongside Ship');
INSERT INTO `sl_lv0008` VALUES ('FOB', 'Giao trên tàu', 'Free On Board');
INSERT INTO `sl_lv0008` VALUES ('CFR', 'Tiền hàng và cước phí', 'Cost and Freight');
INSERT INTO `sl_lv0008` VALUES ('CIF', 'Tiền hàng, chi phí bảo phiểm và cước phí', 'Cost Insurance and Freight');

-- ----------------------------
-- Table structure for sl_lv0009
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0009`;
CREATE TABLE `sl_lv0009` (
  `lv001` char(6) NOT NULL DEFAULT '',
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0009
-- ----------------------------
INSERT INTO `sl_lv0009` VALUES ('PAY001', 'Tiền mặt', 'Cash');
INSERT INTO `sl_lv0009` VALUES ('PAY002', 'Chuyển khoản', 'Telegraphic transfer - T/T');
INSERT INTO `sl_lv0009` VALUES ('PAY003', 'NET 60', '');

-- ----------------------------
-- Table structure for sl_lv0010
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0010`;
CREATE TABLE `sl_lv0010` (
  `lv001` varchar(38) NOT NULL,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` date DEFAULT NULL,
  `lv006` decimal(18,2) DEFAULT NULL,
  `lv007` char(6) DEFAULT NULL,
  `lv008` char(6) DEFAULT NULL,
  `lv009` text,
  `lv010` char(32) DEFAULT NULL,
  `lv011` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0010
-- ----------------------------

-- ----------------------------
-- Table structure for sl_lv0011
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0011`;
CREATE TABLE `sl_lv0011` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(38) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` decimal(28,2) DEFAULT NULL,
  `lv005` char(6) DEFAULT NULL,
  `lv006` decimal(28,2) DEFAULT NULL,
  `lv007` char(6) DEFAULT NULL,
  `lv008` decimal(18,2) DEFAULT NULL,
  `lv009` varchar(255) DEFAULT NULL,
  `lv010` varchar(255) DEFAULT NULL,
  `lv011` varchar(255) DEFAULT NULL,
  `lv012` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0011
-- ----------------------------

-- ----------------------------
-- Table structure for sl_lv0012
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0012`;
CREATE TABLE `sl_lv0012` (
  `lv001` bigint(28) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(32) DEFAULT NULL,
  `lv003` char(6) NOT NULL DEFAULT '',
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` datetime DEFAULT NULL,
  `lv006` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`lv001`,`lv003`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; InnoDB free: 7168 kB; InnoDB free: 102';

-- ----------------------------
-- Records of sl_lv0012
-- ----------------------------
INSERT INTO `sl_lv0012` VALUES ('1', '1', 'CV', 'Chào giá', '2009-05-23 20:03:30', 'bang_gia.doc');

-- ----------------------------
-- Table structure for sl_lv0013
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0013`;
CREATE TABLE `sl_lv0013` (
  `lv001` varchar(38) NOT NULL,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` date DEFAULT NULL,
  `lv006` decimal(18,2) DEFAULT NULL,
  `lv007` char(6) DEFAULT NULL,
  `lv008` char(6) DEFAULT NULL,
  `lv009` mediumtext,
  `lv010` char(32) DEFAULT NULL,
  `lv011` tinyint(1) DEFAULT NULL,
  `lv012` char(38) DEFAULT NULL,
  `lv013` mediumtext,
  `lv014` varchar(255) DEFAULT NULL,
  `lv015` tinyint(1) DEFAULT '0',
  `lv016` varchar(255) DEFAULT NULL,
  `lv017` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0013
-- ----------------------------

-- ----------------------------
-- Table structure for sl_lv0014
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0014`;
CREATE TABLE `sl_lv0014` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(38) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` decimal(28,2) DEFAULT NULL,
  `lv005` char(6) DEFAULT NULL,
  `lv006` decimal(28,2) DEFAULT NULL,
  `lv007` char(6) DEFAULT NULL,
  `lv008` decimal(18,2) DEFAULT NULL,
  `lv009` varchar(255) DEFAULT NULL,
  `lv010` varchar(255) DEFAULT NULL,
  `lv011` varchar(255) DEFAULT NULL,
  `lv012` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0014
-- ----------------------------

-- ----------------------------
-- Table structure for sl_lv0015
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0015`;
CREATE TABLE `sl_lv0015` (
  `lv001` bigint(28) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(32) DEFAULT NULL,
  `lv003` char(6) NOT NULL DEFAULT '',
  `lv004` varchar(255) DEFAULT NULL,
  `lv005` datetime DEFAULT NULL,
  `lv006` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`lv001`,`lv003`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='InnoDB free: 7168 kB; InnoDB free: 7168 kB; InnoDB free: 102';

-- ----------------------------
-- Records of sl_lv0015
-- ----------------------------

-- ----------------------------
-- Table structure for sl_lv0016
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0016`;
CREATE TABLE `sl_lv0016` (
  `lv001` char(6) NOT NULL DEFAULT '',
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` text,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0016
-- ----------------------------
INSERT INTO `sl_lv0016` VALUES ('TEM001', 'Purchase', '<table style=\"width: 700px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"211\"><strong><span style=\"text-decoration: underline;\">Part A</span></strong></td>\r\n<td width=\"3\">:</td>\r\n<td colspan=\"4\">VIAN INC<br /></td>\r\n</tr>\r\n<tr>\r\n<td>Address</td>\r\n<td>:</td>\r\n<td colspan=\"4\" align=\"justify\">19/5A STREET, GROUP III-21, TAN BINH INDUSTRIAL PARK, TAY THANH WARD, TAN PHU DISTRICT, HCMC, VIETNAM<br /></td>\r\n</tr>\r\n<tr>\r\n<td>Tel</td>\r\n<td>:</td>\r\n<td width=\"181\">84838163228</td>\r\n<td width=\"72\">Fax</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"99\">84838163229</td>\r\n</tr>\r\n<tr>\r\n<td>Tax code</td>\r\n<td>:</td>\r\n<td colspan=\"4\">0301774670</td>\r\n</tr>\r\n<tr>\r\n<td>Account No</td>\r\n<td>:</td>\r\n<td colspan=\"4\" align=\"justify\">EXIMBANK CONG HOA BRANCH HCMC <br /></td>\r\n</tr>\r\n<tr>\r\n<td>Represented by</td>\r\n<td>:</td>\r\n<td>TO QUANG HUY<br /></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td><strong> GM</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"6\">Hereinafter called as \"PARTY A\"</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"6\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"211\"><strong><span style=\"text-decoration: underline;\">Party B</span></strong></td>\r\n<td width=\"3\">:</td>\r\n<td colspan=\"4\" align=\"justify\"><strong>@01</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Address</td>\r\n<td>:</td>\r\n<td colspan=\"4\" align=\"justify\">@02</td>\r\n</tr>\r\n<tr>\r\n<td>Tel</td>\r\n<td>:</td>\r\n<td width=\"181\">@03</td>\r\n<td width=\"72\">Fax</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"99\">@04</td>\r\n</tr>\r\n<tr>\r\n<td>Tax code</td>\r\n<td>:</td>\r\n<td colspan=\"4\">@05</td>\r\n</tr>\r\n<tr>\r\n<td>Account No</td>\r\n<td>:</td>\r\n<td colspan=\"4\" align=\"justify\">@06</td>\r\n</tr>\r\n<tr>\r\n<td>Represented by</td>\r\n<td>:</td>\r\n<td><strong>@07</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td><strong>@08</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"6\">Hereinafter called as \"PARTY B\"</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"4\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"6\" align=\"justify\"><em>We agree mutually to sign this sales contract on the following terms and conditions:</em></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 700px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"103\">&nbsp;</td>\r\n<td width=\"6\">&nbsp;</td>\r\n<td width=\"132\">&nbsp;</td>\r\n<td width=\"13\">&nbsp;</td>\r\n<td width=\"147\">&nbsp;</td>\r\n<td width=\"8\">&nbsp;</td>\r\n<td width=\"100\">&nbsp;</td>\r\n<td width=\"29\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"65\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong><span style=\"text-decoration: underline;\">ARTICLE I:</span></strong></td>\r\n<td colspan=\"9\"><strong>COMMODITY, QUANTITY, PRICE.</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\"><!--strAttack--></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td>Origin</td>\r\n<td colspan=\"7\" align=\"justify\">: Vietname.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td>Specification, quality</td>\r\n<td colspan=\"7\" align=\"justify\">: As sample.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td>Tolerance of quantity and amount</td>\r\n<td colspan=\"7\" align=\"justify\">: &plusmn; 10% accepted.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong><span style=\"text-decoration: underline;\">ARTICLE II:</span></strong></td>\r\n<td colspan=\"9\"><strong>SHIPMENT - DELIVERY.</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td>Shipment</td>\r\n<td colspan=\"7\" align=\"justify\">: By sea from Hochiminh City port, Vietnam to Singapore port.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td>Packing</td>\r\n<td colspan=\"7\" align=\"justify\">: By export standard packing as we agreed.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td>Delivery</td>\r\n<td colspan=\"7\" align=\"justify\">: Not later than 31 December 2007.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong><span style=\"text-decoration: underline;\">ARTICLE III:</span></strong></td>\r\n<td colspan=\"9\"><strong>PAYMENT TERM .</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">Payment:   T/T in advance value of this contract in U.S. Dollars, through account no. 2000.1485.1075864, VIETNAME EXIMBANK-MAIN TRANSACTION OFFICE 1, 7 Le Thi Hong Gam Street, District 1, Hochiminh City, Vietnam.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">Documents required</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"8\">\r\n<table style=\"width: 100%;\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\r\n<tbody>\r\n<tr>\r\n<td width=\"3%\">&nbsp;</td>\r\n<td width=\"2%\">+</td>\r\n<td width=\"95%\" align=\"justify\">Bill of Lading &ndash; Freight prepaid &ndash; Full set</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>+</td>\r\n<td align=\"justify\">Signed Commercial Invoice &ndash; Triplicate</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>+</td>\r\n<td align=\"justify\">Detailed Packing List &ndash; Triplicate</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong><span style=\"text-decoration: underline;\">ARTICLE IV:</span></strong></td>\r\n<td colspan=\"9\"><strong>GENERAL TERM.</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">Both Parties undertake themselves to carry out this  contract firmly.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">\r\n<p>This contract is into effect from the signing date  till the end of 31 December 2008.</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">This contract is made into 05 original copies, party A  holds 03 and party B holds 02.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 700px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"41\">&nbsp;</td>\r\n<td width=\"69\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"79\">&nbsp;</td>\r\n<td width=\"31\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>FOR THE PARTY B<br /> </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>FOR THE PARTY A<br /> </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>&nbsp;</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>&nbsp;</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>&nbsp;</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>&nbsp;</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>......................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>ấp</p>');
INSERT INTO `sl_lv0016` VALUES ('TEM002', 'Hợp đồng mua bán', '<table style=\"width: 700px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"189\"><strong><span style=\"text-decoration: underline;\">B&Ecirc;N A (B&ecirc;n b&aacute;n)</span></strong></td>\r\n<td width=\"3\">:</td>\r\n<td colspan=\"4\"><strong>&Ocirc;ng L&Ecirc; QUANG VINH</strong></td>\r\n</tr>\r\n<tr>\r\n<td>S&ocirc;́ CMND</td>\r\n<td>:</td>\r\n<td colspan=\"4\">341081518 C&acirc;́p ngày:01-11-1997 tại CA Đ&ocirc;̀ng Tháp</td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ</td>\r\n<td>:</td>\r\n<td colspan=\"4\">167 ấp Ph&uacute; B&igrave;nh, Ph&uacute; Long, Ch&acirc;u Th&agrave;nh, Đồng Th&aacute;p<br /></td>\r\n</tr>\r\n<tr>\r\n<td>Điện thoại</td>\r\n<td>:</td>\r\n<td width=\"203\">0167973549</td>\r\n<td width=\"72\">Fax</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"99\"><br /></td>\r\n</tr>\r\n<tr>\r\n<td>M&atilde; số thuế</td>\r\n<td>:</td>\r\n<td colspan=\"4\">0167973549</td>\r\n</tr>\r\n<tr>\r\n<td>Số t&agrave;i khoản</td>\r\n<td>:</td>\r\n<td colspan=\"4\" align=\"justify\">6688-9900-1824-8029- tại Ng&acirc;n Hàng Đ&acirc;̀u Tư Và Phát Tri&ecirc;̉n Vi&ecirc;̣t Nam<br /></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td width=\"189\"><strong><span style=\"text-decoration: underline;\">B&Ecirc;N B (B&ecirc;n mua)</span></strong></td>\r\n<td width=\"3\">:</td>\r\n<td colspan=\"4\"><strong> @01 </strong></td>\r\n</tr>\r\n<tr>\r\n<td>Địa chỉ</td>\r\n<td>:</td>\r\n<td colspan=\"4\" align=\"justify\">@02</td>\r\n</tr>\r\n<tr>\r\n<td>Điện thoại</td>\r\n<td>:</td>\r\n<td width=\"203\">@03</td>\r\n<td width=\"72\">Fax</td>\r\n<td width=\"3\">:</td>\r\n<td width=\"99\">@04</td>\r\n</tr>\r\n<tr>\r\n<td>M&atilde; số thuế</td>\r\n<td>:</td>\r\n<td colspan=\"4\">@05</td>\r\n</tr>\r\n<tr>\r\n<td>Số t&agrave;i khoản</td>\r\n<td>:</td>\r\n<td colspan=\"4\" align=\"justify\">@06</td>\r\n</tr>\r\n<tr>\r\n<td>Người đại diện</td>\r\n<td>:</td>\r\n<td><strong>@07</strong></td>\r\n<td>Chức danh</td>\r\n<td>:</td>\r\n<td>@08</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"4\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"6\" align=\"justify\"><em>Sau khi b&agrave;n bạc, hai b&ecirc;n đồng &yacute; k&yacute; hợp đồng mua b&aacute;n với c&aacute;c điều khoản v&agrave; điều kiện như sau:</em></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 700px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"68\">&nbsp;</td>\r\n<td width=\"6\">&nbsp;</td>\r\n<td width=\"116\">&nbsp;</td>\r\n<td width=\"178\">&nbsp;</td>\r\n<td width=\"21\">&nbsp;</td>\r\n<td width=\"5\">&nbsp;</td>\r\n<td width=\"108\">&nbsp;</td>\r\n<td width=\"31\">&nbsp;</td>\r\n<td width=\"59\">&nbsp;</td>\r\n<td width=\"66\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong><span style=\"text-decoration: underline;\">ĐIỀU 1:</span></strong></td>\r\n<td colspan=\"9\"><strong>T&Ecirc;N H&Agrave;NG&nbsp; - SỐ LƯỢNG - ĐƠN GI&Aacute;.</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"10\"><!--strAttack--></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong><span style=\"text-decoration: underline;\">ĐIỀU 2:</span></strong></td>\r\n<td colspan=\"9\" align=\"justify\"><strong>CHẤT LƯỢNG &ndash; Đ&Oacute;NG G&Oacute;I.</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td>Chất lượng</td>\r\n<td colspan=\"7\" align=\"justify\">: Đảm bảo y&ecirc;u cầu chung về t&iacute;nh năng v&agrave; b&aacute;o c&aacute;o.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td>Đ&oacute;ng g&oacute;i</td>\r\n<td colspan=\"7\" align=\"justify\">: Theo mẫu của B&ecirc;n A.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong><span style=\"text-decoration: underline;\">ĐIỀU 3:</span></strong></td>\r\n<td colspan=\"9\"><strong>GIAO H&Agrave;NG.</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">B&ecirc;n A chịu tr&aacute;ch nhiệm lấy h&agrave;ng từ kho B&ecirc;n B đến kho của B&ecirc;n A.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">Thời gian giao h&agrave;ng từ ng&agrave;y k&yacute; hợp đồng đến hết ng&agrave;y 20/10/2007.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong><span style=\"text-decoration: underline;\">ĐIỀU 4:</span></strong></td>\r\n<td colspan=\"9\"><strong>THANH TO&Aacute;N.</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">Thanh to&aacute;n bằng tiền mặt hoặc chuyển khoản.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong><span style=\"text-decoration: underline;\">ĐIỀU 5:</span></strong></td>\r\n<td colspan=\"9\"><strong>ĐIỀU KHOẢN CHUNG.</strong></td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">Hai b&ecirc;n cam kết thực hiện nghi&ecirc;m chỉnh c&aacute;c điều khoản ghi trong hợp đồng n&agrave;y. B&ecirc;n n&agrave;o vi phạm hợp đồng m&agrave; g&acirc;y thiệt hại cho b&ecirc;n kia phải chịu phạt bồi thường theo luật định. Mọi tu chỉnh của hợp đồng chỉ c&oacute; gi&aacute; trị khi được lập th&agrave;nh văn bản v&agrave; c&oacute; chữ k&yacute; của cả hai b&ecirc;n. C&aacute;c văn bản, phụ kiện n&oacute;i tr&ecirc;n l&agrave; một bộ phận kh&ocirc;ng thể t&aacute;ch rời của hợp đồng.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">Trong qu&aacute; tr&igrave;nh thực hiện nếu c&oacute; kh&oacute; khăn, hai b&ecirc;n sẽ c&ugrave;ng nhau b&agrave;n bạc v&agrave; t&igrave;m biện ph&aacute;p giải quyết. Nếu kh&ocirc;ng thống nhất, vụ việc sẽ do T&ograve;a Kinh tế T&ograve;a &aacute;n nh&acirc;n d&acirc;n TPHCM giải quyết. Ph&aacute;n quyết của to&agrave; l&agrave; quyết định cuối c&ugrave;ng bắt buộc hai b&ecirc;n phải thực hiện nghi&ecirc;m chỉnh. &Aacute;n ph&iacute; do b&ecirc;n thua kiện chịu.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">Hợp đồng n&agrave;y c&oacute; hiệu lực kể từ ng&agrave;y k&yacute; đến hết ng&agrave;y 20 th&aacute;ng 10 năm 2007.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td valign=\"top\">-</td>\r\n<td colspan=\"8\" align=\"justify\">Hợp đồng n&agrave;y được lập th&agrave;nh 02 bản, mỗi b&ecirc;n giữ 01 bản v&agrave; c&oacute; gi&aacute; trị ph&aacute;p l&yacute; như nhau.</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 700px;\" border=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"30\">&nbsp;</td>\r\n<td width=\"80\">&nbsp;</td>\r\n<td width=\"55\">&nbsp;</td>\r\n<td width=\"85\">&nbsp;</td>\r\n<td width=\"28\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>ĐẠI DIỆN B&Ecirc;N B<br /> </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><strong>ĐẠI DIỆN B&Ecirc;N A<br /> </strong></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute; t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>(K&yacute; t&ecirc;n)</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>Ghi r&otilde; họ v&agrave; t&ecirc;n</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div><em>Ghi r&otilde; họ v&agrave; t&ecirc;n</em></div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>......................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td colspan=\"3\">\r\n<div>..............................................</div>\r\n</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<div id=\"_mcePaste\" style=\"overflow: hidden; position: absolute; left: -10000px; top: 0px; width: 1px; height: 1px;\">&Ocirc;</div>');

-- ----------------------------
-- Table structure for sl_lv0017
-- ----------------------------
DROP TABLE IF EXISTS `sl_lv0017`;
CREATE TABLE `sl_lv0017` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` varchar(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sl_lv0017
-- ----------------------------


-- ----------------------------
-- Table structure for tc_lv0001
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0001`;
CREATE TABLE `tc_lv0001` (
  `lv001` char(32) NOT NULL,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` varchar(500) DEFAULT NULL,
  `lv005` date DEFAULT NULL,
  `lv006` date DEFAULT NULL,
  `lv007` decimal(28,0) DEFAULT NULL,
  `lv008` tinyint(1) DEFAULT NULL,
  `lv009` datetime DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0001
-- ----------------------------
INSERT INTO `tc_lv0001` VALUES ('PRJ000001', 'VANPHONG', 'DỰ ÁN CHUNG TỚI NĂM 2015', '', '2010-04-01', '2015-12-31', '0', '0', '2010-04-11 15:05:10');

-- ----------------------------
-- Table structure for tc_lv0002
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0002`;
CREATE TABLE `tc_lv0002` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  `lv004` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0002
-- ----------------------------
INSERT INTO `tc_lv0002` VALUES ('1', 'GIỜ LÀM VIỆC THƯỜNG', 'GIỜI LÀM VIỆC THƯỜNG NGÀY. DO CÔNG TY VÀ NGƯỜI LAO ĐỘNG THẢO THUẬN. ĂN LƯƠNG THÔNG THƯỜNG', '0');
INSERT INTO `tc_lv0002` VALUES ('PN', 'PHÉP NĂM', 'Mỗi tháng được hưởng một phép năm. Mỗi năm được 12 phép năm', '0');
INSERT INTO `tc_lv0002` VALUES ('NL', 'NGHỈ LỄ', 'TẤT CẢ NHỮNG NGÀY NGHỈ THEO QUI ĐỊNH CỦA NHÀ NƯỚC(NGÀY TẾT TÂY 01-01,NGÀY GIẢI PHÓNG MIỀN NAM 30-4, NGÀY QUỐC TẾ LAO ĐỘNG 01-05, NGÀY GIỔ TỔ HÙNG VƯƠNG 10-03 ÂM LỊCH, NGÀY QUỐC KHÁNH 02-09)', '0');
INSERT INTO `tc_lv0002` VALUES ('NKP', 'NGHỈ KHÔNG PHÉP', 'KHÔNG ĐƯỢC HƯỞNG LƯƠNG', '0');
INSERT INTO `tc_lv0002` VALUES ('TCBT', 'TĂNG CA BÌNH THƯỜNG', 'ĐƯỢC HƯỞNG LƯƠNG THEO QUI ĐỊNH CỦA NHÀ NƯỚC(1.5 LẦN LƯƠNG THÔNG THƯỜNG)', '1');
INSERT INTO `tc_lv0002` VALUES ('TCCN', 'TĂNG CA CHỦ NHẬT', 'ĐƯỢC HƯỞNG LƯƠNG THEO QUI ĐỊNH PHÁP LUẬT (2 LẦN LƯƠNG THÔNG THƯỜNG)', '1');
INSERT INTO `tc_lv0002` VALUES ('TCNL', 'TĂNG CA NGÀY LỄ', 'ĐƯỢC HƯỞNG LƯƠNG THEO QUI ĐỊNH NHÀ NƯỚC( GẤP 3 LẦN LƯƠNG THÔNG THƯỜNG)', '1');
INSERT INTO `tc_lv0002` VALUES ('NCP', 'NGHỈ CÓ PHÉP KHÔNG HƯỞNG LƯƠNG', 'KHÔNG CÓ LƯƠNG', '0');
INSERT INTO `tc_lv0002` VALUES ('NKC', 'NGHỈ KHẨN CẤP', 'NGHỈ ĐƯỢC HƯỞNG MỘT PHẦN LƯƠNG ĐÃ LÀM(DO BỆNH, CÔNG VIỆC NHÀ, HOẶC DO BẤT KHẢ KHÁN)', '0');
INSERT INTO `tc_lv0002` VALUES ('TCBT-1', 'TĂNG CA BÌNH THƯỜNG CHUYỀN', 'ĐƯỢC HƯỞNG LƯƠNG TĂNG CA CHUYỀN 0.5*THỜI GIAN TĂNG CA', '1');
INSERT INTO `tc_lv0002` VALUES ('TCCN-1', 'TĂNG CA CHỦ NHẬT THEO CHUYỀN', 'ĐƯỢC HƯỞNG LƯƠNG TĂNG CA CN THEO CHUYỀN 1*THỜI GIAN TĂNG CA', '1');
INSERT INTO `tc_lv0002` VALUES ('TCNL-1', 'TĂNG CA NGÀY LỄ THEO CHUYỀN', 'ĐƯỢC HƯỞNG LƯƠNG TĂNG CA CHUYỀN 1*THỜI GIAN TĂNG CA', '1');
INSERT INTO `tc_lv0002` VALUES ('CA3', 'LÀM CA 3', 'LÀM VIỆC CA 3', '0');

-- ----------------------------
-- Table structure for tc_lv0003
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0003`;
CREATE TABLE `tc_lv0003` (
  `lv001` char(32) NOT NULL,
  `lv002` date DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  `lv004` char(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0003
-- ----------------------------
INSERT INTO `tc_lv0003` VALUES ('1', '2009-09-02', 'Ngày quốc khánh Việt Nam', 'NL');
INSERT INTO `tc_lv0003` VALUES ('2', '2010-01-01', 'Tết tây 2010.', 'NL');
INSERT INTO `tc_lv0003` VALUES ('3', '2010-04-30', 'NGÀY GIẢI PHÓNG MIỀN NAM', 'NL');
INSERT INTO `tc_lv0003` VALUES ('4', '2010-05-01', 'NGÀY QUỐC TẾ LAO ĐỘNG', 'NL');
INSERT INTO `tc_lv0003` VALUES ('5', '2010-04-23', 'NGÀY GIỔ TỔ HÙNG VƯƠNG', 'NL');
INSERT INTO `tc_lv0003` VALUES ('6', '2010-09-02', 'Ngày quốc khánh Việt Nam', 'NL');
INSERT INTO `tc_lv0003` VALUES ('7', '2011-01-01', 'TẾT TÂY 2011', 'NL');
INSERT INTO `tc_lv0003` VALUES ('8', '2011-02-03', 'NGHỈ MỪNG 1 TẾT ÂM LỊCH', 'NL');
INSERT INTO `tc_lv0003` VALUES ('9', '2011-02-04', 'NGHỈ MÙNG 2 TẾT ÂM LỊCH', 'NL');
INSERT INTO `tc_lv0003` VALUES ('10', '2011-02-05', 'NGHỈ MÙNG 3 TẾT ÂM LỊCH', 'NL');
INSERT INTO `tc_lv0003` VALUES ('11', '2011-04-30', 'NGÀY GIẢI PHÓNG MIỀN NAM', 'NL');
INSERT INTO `tc_lv0003` VALUES ('12', '2011-05-01', 'NGÀY QUỐC TẾ LAO ĐỘNG', 'NL');

-- ----------------------------
-- Table structure for tc_lv0004
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0004`;
CREATE TABLE `tc_lv0004` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` time DEFAULT NULL,
  `lv004` time DEFAULT NULL,
  `lv005` time DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0004
-- ----------------------------
INSERT INTO `tc_lv0004` VALUES ('SHIFT01', 'Tạp vụ', '07:00:00', '16:00:00', '01:00:00');
INSERT INTO `tc_lv0004` VALUES ('SHIFT02', 'Tài xế xc', '07:00:00', '18:00:00', '03:00:00');
INSERT INTO `tc_lv0004` VALUES ('SHIFT03', 'Bv ca 1', '06:30:00', '14:30:00', '00:00:00');
INSERT INTO `tc_lv0004` VALUES ('SHIFT04', 'CA HÀNH CHÁNH', '07:30:00', '16:30:00', '01:00:00');
INSERT INTO `tc_lv0004` VALUES ('SHIFT05', 'Bv ca 2', '14:30:00', '22:30:00', '00:00:00');
INSERT INTO `tc_lv0004` VALUES ('SHIFT06', 'Bv ca 3', '22:30:00', '06:30:00', '00:00:00');
INSERT INTO `tc_lv0004` VALUES ('SHIFT07', 'CA HANH CHINH CHO TANG CA', '07:30:00', '21:00:00', '01:00:00');

-- ----------------------------
-- Table structure for tc_lv0005
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0005`;
CREATE TABLE `tc_lv0005` (
  `lv001` char(32) NOT NULL,
  `lv002` decimal(28,2) DEFAULT NULL,
  `lv003` decimal(28,2) DEFAULT NULL,
  `lv004` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0005
-- ----------------------------
INSERT INTO `tc_lv0005` VALUES ('1', '1.00', '5000000.00', '5.00');
INSERT INTO `tc_lv0005` VALUES ('2', '5000000.00', '10000000.00', '10.00');
INSERT INTO `tc_lv0005` VALUES ('3', '10000000.00', '18000000.00', '15.00');
INSERT INTO `tc_lv0005` VALUES ('4', '18000000.00', '32000000.00', '20.00');
INSERT INTO `tc_lv0005` VALUES ('5', '32000000.00', '52000000.00', '25.00');
INSERT INTO `tc_lv0005` VALUES ('6', '52000000.00', '80000000.00', '30.00');
INSERT INTO `tc_lv0005` VALUES ('7', '80000000.00', '10000000000.00', '35.00');

-- ----------------------------
-- Table structure for tc_lv0008
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0008`;
CREATE TABLE `tc_lv0008` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` int(28) DEFAULT NULL,
  `lv004` int(28) DEFAULT NULL,
  `lv005` int(32) DEFAULT NULL,
  `lv006` time DEFAULT NULL,
  `lv007` char(32) DEFAULT NULL,
  `lv008` int(4) DEFAULT '0',
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0008
-- ----------------------------


-- ----------------------------
-- Table structure for tc_lv0009
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0009`;
CREATE TABLE `tc_lv0009` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` int(28) DEFAULT NULL,
  `lv004` int(18) DEFAULT NULL,
  `lv005` tinyint(1) DEFAULT '0',
  `lv006` char(32) DEFAULT NULL,
  `lv007` decimal(28,4) DEFAULT '0.0000',
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for tc_lv0010
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0010`;
CREATE TABLE `tc_lv0010` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` date DEFAULT NULL,
  `lv006` tinyint(1) DEFAULT NULL,
  `lv007` tinyint(28) DEFAULT NULL,
  `lv008` char(32) DEFAULT NULL,
  `lv009` datetime DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0010
-- ----------------------------

-- ----------------------------
-- Table structure for tc_lv0011
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0011`;
CREATE TABLE `tc_lv0011` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` int(11) DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` time DEFAULT NULL,
  `lv006` time DEFAULT NULL,
  `lv007` char(32) DEFAULT NULL,
  `lv008` varchar(255) DEFAULT NULL,
  `lv009` char(32) DEFAULT NULL,
  `lv010` char(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0011
-- ----------------------------

-- ----------------------------
-- Table structure for tc_lv0012
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0012`;
CREATE TABLE `tc_lv0012` (
  `lv001` char(32) NOT NULL DEFAULT '',
  `lv002` date NOT NULL DEFAULT '0000-00-00',
  `lv003` time NOT NULL DEFAULT '00:00:00',
  `lv004` varchar(32) DEFAULT NULL,
  `lv005` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`,`lv002`,`lv003`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0012
-- ----------------------------

-- ----------------------------
-- Table structure for tc_lv0013
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0013`;
CREATE TABLE `tc_lv0013` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` int(32) DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` date NOT NULL,
  `lv006` int(11) DEFAULT NULL,
  `lv007` int(1) DEFAULT NULL,
  `lv008` char(32) DEFAULT NULL,
  `lv009` char(32) DEFAULT NULL,
  `lv010` varchar(255) DEFAULT NULL,
  `lv011` tinyint(1) DEFAULT NULL,
  `lv012` decimal(28,2) DEFAULT NULL,
  `lv013` decimal(28,2) DEFAULT NULL,
  `lv014` decimal(28,2) DEFAULT NULL,
  `lv015` decimal(28,2) DEFAULT NULL,
  `lv016` decimal(28,2) DEFAULT NULL,
  `lv017` decimal(28,2) DEFAULT NULL,
  `lv018` decimal(28,2) DEFAULT NULL,
  `lv019` decimal(28,2) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0013
-- ----------------------------
INSERT INTO `tc_lv0013` VALUES ('TIMES0001', 'CHẤM CÔNG THÁNG 01 NĂM 2012', '1', '2012-01-01', '2012-01-31', '1', '2012', '111', '111', '', '1', '6.00', '1.50', '1.00', '4000000.00', '10.00', '16.00', '3.50', '1.00');

-- ----------------------------
-- Table structure for tc_lv0014
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0014`;
CREATE TABLE `tc_lv0014` (
  `lv001` bigint(28) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) NOT NULL DEFAULT '',
  `lv003` char(32) NOT NULL DEFAULT '',
  `lv004` decimal(28,2) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0014
-- ----------------------------
INSERT INTO `tc_lv0014` VALUES ('38', 'TIMES0001', 'NKC', '100.00');
INSERT INTO `tc_lv0014` VALUES ('37', 'TIMES0001', 'NCP', '0.00');
INSERT INTO `tc_lv0014` VALUES ('36', 'TIMES0001', 'TCNL', '100.00');
INSERT INTO `tc_lv0014` VALUES ('35', 'TIMES0001', 'TCCN', '100.00');
INSERT INTO `tc_lv0014` VALUES ('34', 'TIMES0001', 'TCBT', '100.00');
INSERT INTO `tc_lv0014` VALUES ('33', 'TIMES0001', 'NKP', '0.00');
INSERT INTO `tc_lv0014` VALUES ('32', 'TIMES0001', 'NL', '100.00');
INSERT INTO `tc_lv0014` VALUES ('31', 'TIMES0001', 'PN', '100.00');
INSERT INTO `tc_lv0014` VALUES ('30', 'TIMES0001', '1', '100.00');
-- ----------------------------
-- Table structure for tc_lv0015
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0015`;
CREATE TABLE `tc_lv0015` (
  `lv001` bigint(28) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) NOT NULL,
  `lv003` char(32) NOT NULL,
  `lv004` decimal(28,2) DEFAULT NULL,
  `lv005` char(6) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0015
-- ----------------------------

-- ----------------------------
-- Table structure for tc_lv0017
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0017`;
CREATE TABLE `tc_lv0017` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` char(32) DEFAULT NULL,
  `lv005` decimal(28,2) DEFAULT NULL,
  `lv006` char(32) DEFAULT NULL,
  `lv007` varchar(255) DEFAULT NULL,
  `lv008` tinyint(1) DEFAULT NULL,
  `lv009` char(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0017
-- ----------------------------

-- ----------------------------
-- Table structure for tc_lv0018
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0018`;
CREATE TABLE `tc_lv0018` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0018
-- ----------------------------
INSERT INTO `tc_lv0018` VALUES ('CEXP001', 'CHI PHÍ XĂNG DẦU', 'TẤT CẢ CHI PHÍ VỀ ĐI LẠI');
INSERT INTO `tc_lv0018` VALUES ('CEXP002', 'CHI PHÍ TIỀN CƠM', 'LIÊN QUAN ĐẾN ĂN UỐNG TRONG VÀ NGOÀI CÔNG TY');
INSERT INTO `tc_lv0018` VALUES ('CEXP003', 'CHI PHÍ XE & GIAO THÔNG', 'LIÊN QUAN TẤT CẢ CHI PHÍ PHƯƠNG TIỆN ĐI LẠI VÀ VÉ THU PHÍ GIAO THÔNG');
INSERT INTO `tc_lv0018` VALUES ('CEXP004', 'KHOẢN  CỘNG TRÁCH NHIỆM KHI NGHỈ DƯỚI 23 CÔNG ', 'NGÀY CÔNG X KHOẢN TRÁCH NHIỆM / TỔNG CÔNG');
INSERT INTO `tc_lv0018` VALUES ('CEXP005', 'TIỀN NGHỈ PHÉP THEO LƯƠNG HỢP ĐỒNG', 'TIỀN NGHỈ PHÉP THEO LƯƠNG HỢP ĐỒNG');

-- ----------------------------
-- Table structure for tc_lv0021
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0021`;
CREATE TABLE `tc_lv0021` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(255) DEFAULT NULL,
  `lv003` date DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` date DEFAULT NULL,
  `lv006` decimal(28,2) DEFAULT NULL,
  `lv007` decimal(28,2) DEFAULT NULL,
  `lv008` decimal(28,2) DEFAULT NULL,
  `lv009` decimal(28,2) DEFAULT NULL,
  `lv010` decimal(28,2) DEFAULT NULL,
  `lv011` decimal(28,2) DEFAULT NULL,
  `lv012` decimal(28,2) DEFAULT NULL,
  `lv013` decimal(28,2) DEFAULT NULL,
  `lv014` decimal(28,2) DEFAULT NULL,
  `lv015` decimal(28,2) DEFAULT NULL,
  `lv016` decimal(28,2) DEFAULT NULL,
  `lv017` decimal(28,2) DEFAULT NULL,
  `lv018` decimal(28,2) DEFAULT NULL,
  `lv019` decimal(28,2) DEFAULT NULL,
  `lv020` char(32) DEFAULT NULL,
  `lv021` char(32) DEFAULT NULL,
  `lv022` decimal(28,2) DEFAULT NULL,
  `lv023` tinyint(1) DEFAULT NULL,
  `lv024` decimal(28,2) DEFAULT NULL,
  `lv025` decimal(28,2) DEFAULT NULL,
  `lv026` decimal(28,2) DEFAULT NULL,
  `lv027` decimal(28,2) DEFAULT NULL,
  `lv028` decimal(28,2) DEFAULT NULL,
  `lv029` decimal(28,2) DEFAULT NULL,
  `lv030` int(4) DEFAULT '0',
  `lv031` char(32) DEFAULT NULL,
  `lv032` decimal(28,0) DEFAULT '0',
  `lv033` decimal(28,0) DEFAULT '0',
  `lv034` decimal(28,0) DEFAULT '0',
  `lv035` decimal(28,0) DEFAULT '0',
  `lv036` decimal(28,2) DEFAULT '0.00',
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0021
-- ----------------------------

-- ----------------------------
-- Table structure for tc_lv0022
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0022`;
CREATE TABLE `tc_lv0022` (
  `lv001` bigint(32) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` date DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` date DEFAULT NULL,
  `lv006` decimal(28,2) DEFAULT NULL,
  `lv007` decimal(28,2) DEFAULT NULL,
  `lv008` decimal(28,2) DEFAULT NULL,
  `lv009` decimal(28,2) DEFAULT NULL,
  `lv010` decimal(28,2) DEFAULT NULL,
  `lv011` decimal(28,2) DEFAULT NULL,
  `lv012` decimal(28,2) DEFAULT NULL,
  `lv013` decimal(28,2) DEFAULT NULL,
  `lv014` decimal(28,2) DEFAULT NULL,
  `lv015` decimal(28,2) DEFAULT NULL,
  `lv016` decimal(28,2) DEFAULT NULL,
  `lv017` char(32) DEFAULT NULL,
  `lv018` char(32) DEFAULT NULL,
  `lv019` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0022
-- ----------------------------

-- ----------------------------
-- Table structure for tc_lv0023
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0023`;
CREATE TABLE `tc_lv0023` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` char(32) DEFAULT NULL,
  `lv005` decimal(28,2) DEFAULT NULL,
  `lv006` char(32) DEFAULT NULL,
  `lv007` varchar(255) DEFAULT NULL,
  `lv008` tinyint(1) DEFAULT NULL,
  `lv009` char(32) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0023
-- ----------------------------

-- ----------------------------
-- Table structure for tc_lv0024
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0024`;
CREATE TABLE `tc_lv0024` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0024
-- ----------------------------
INSERT INTO `tc_lv0024` VALUES ('COST001', 'TIỀN TẠM ỨNG', 'TẠM ỨNG LƯƠNG, TẠM ỨNG TIỀN CHO TRƯỜNG HỢP CÔNG TÁC');
INSERT INTO `tc_lv0024` VALUES ('COST002', 'CÔNG TY CHI TRƯỚC', 'BAO GỒM CÁC KHOẢN CÔNG ĐOÀN, HOẶC ĐÓNG QUỶ, TIỀN ĐÓNG GÓP MA CHAI,VUI CHƠI, CÁC KHOẢN ĐÓNG GÓP TỪ THIỆN');
INSERT INTO `tc_lv0024` VALUES ('COST003', 'KHOẢN TRỪ TRÁCH NHIỆM KHI NGHỈ DƯỚI 23 CÔNG ', 'TRỪ TOÀN BỘ TRÁCH NHIỆM');

-- ----------------------------
-- Table structure for tc_lv0025
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0025`;
CREATE TABLE `tc_lv0025` (
  `lv001` bigint(28) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` varchar(255) DEFAULT NULL,
  `lv004` decimal(28,2) DEFAULT NULL,
  `lv005` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0025
-- ----------------------------
INSERT INTO `tc_lv0025` VALUES ('33', 'TIMES0001', 'D', '50.00', 'CHỈ ĐẠT >50% VÀ <60% YÊU CẦU ĐƯA RA');
INSERT INTO `tc_lv0025` VALUES ('34', 'TIMES0001', 'E', '20.00', 'KHÔNG ĐƯỢC TÍNH TIỀN <50% YÊU CẦU CHẤT LƯỢNG ĐƯA RA');
INSERT INTO `tc_lv0025` VALUES ('32', 'TIMES0001', 'C', '70.00', 'CHỈ ĐẠT >60% VÀ <80% YÊU CẦU');
INSERT INTO `tc_lv0025` VALUES ('31', 'TIMES0001', 'B', '85.00', 'NHỮNG SẢN PHẨM ĐẠT >80% VA <90% TẤT CẢ YÊU CẦU TỐT NHẤT CỦA CHUẨN SẢN XUẤT ĐƯA RA');
INSERT INTO `tc_lv0025` VALUES ('30', 'TIMES0001', 'A', '100.00', 'NHỮNG SẢN PHẨM ĐẠT TẤT CẢ YÊU CẦU TỐT NHẤT CỦA CHUẨN SẢN XUẤT ĐƯA RA');

-- ----------------------------
-- Table structure for tc_lv0026
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0026`;
CREATE TABLE `tc_lv0026` (
  `lv001` bigint(38) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) DEFAULT NULL,
  `lv003` char(32) DEFAULT NULL,
  `lv004` date DEFAULT NULL,
  `lv005` char(32) DEFAULT NULL,
  `lv006` decimal(28,2) DEFAULT NULL,
  `lv007` char(255) DEFAULT NULL,
  `lv008` varchar(255) DEFAULT NULL,
  `lv009` char(32) DEFAULT NULL,
  `lv010` char(32) DEFAULT NULL,
  `lv011` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0026
-- ----------------------------

-- ----------------------------
-- Table structure for tc_lv0031
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0031`;
CREATE TABLE `tc_lv0031` (
  `lv001` bigint(28) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) NOT NULL,
  `lv003` char(32) NOT NULL,
  `lv004` decimal(28,2) DEFAULT NULL,
  `lv005` char(6) DEFAULT NULL,
  `lv006` decimal(28,2) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0031
-- ----------------------------

-- ----------------------------
-- Table structure for tc_lv0032
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0032`;
CREATE TABLE `tc_lv0032` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0032
-- ----------------------------
INSERT INTO `tc_lv0032` VALUES ('1', 'Tính lương làm theo thời gian', 'Tính lương nhân viên văn phòng làm việc chính thức theo thời gian.');
INSERT INTO `tc_lv0032` VALUES ('2', 'Tính lương làm theo sản phẩm', 'Áp dụng tính lương theo sản phẩm hoàn thành. ');
INSERT INTO `tc_lv0032` VALUES ('3', 'Lương công nhân chuyền & lương đóng gói', 'Tính sản phẩm công đoạn.\r\nLương tăng ca=(tổng lương SP/Tổng công)*Công tăng ca * 0.5\r\nLương tăng ca CN=(tổng sản SP/Tổng công)*Công tăng ca * 1');
INSERT INTO `tc_lv0032` VALUES ('4', 'Lương CN cắt', 'Doanh thu cắt/Tổng công=1 công\r\nLương 1 CN= 1 công x tổng công từng cn x hệ số từng công nhân');
INSERT INTO `tc_lv0032` VALUES ('5', 'Lương KCS', 'Doanh thu chuyền x 3% + luong tgian');
INSERT INTO `tc_lv0032` VALUES ('6', 'Lương tổ phó', 'Doanh thu chuyền x 10%47,5%+ lương thời gian');
INSERT INTO `tc_lv0032` VALUES ('7', 'Lương tổ trưởng', 'Doanh thu chuyền x 10%52,5%+ lương thời gian');
INSERT INTO `tc_lv0032` VALUES ('8', 'Lương công nhân chuyền & lương đóng gói', 'Tính sản phẩm công đoạn. Lương tăng ca tính theo tăng ca thường');

-- ----------------------------
-- Table structure for tc_lv0035
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0035`;
CREATE TABLE `tc_lv0035` (
  `lv001` bigint(28) NOT NULL AUTO_INCREMENT,
  `lv002` char(32) NOT NULL,
  `lv003` char(32) NOT NULL,
  `lv004` decimal(28,2) DEFAULT NULL,
  `lv005` char(6) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for tc_lv0038
-- ----------------------------
DROP TABLE IF EXISTS `tc_lv0038`;
CREATE TABLE `tc_lv0038` (
  `lv001` char(32) NOT NULL,
  `lv002` varchar(255) DEFAULT NULL,
  `lv003` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`lv001`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tc_lv0038
-- ----------------------------
INSERT INTO `tc_lv0038` VALUES ('salary', 'Lương', 'Các khoản liên quan đến trả lương');
INSERT INTO `tc_lv0038` VALUES ('insurance', 'Bảo hiểm bắt buộc', 'Các khoản bảo hiểm xã hội, y tế và thất nghiệp');
INSERT INTO `tc_lv0038` VALUES ('taxperson', 'Thuế thu nhập cá nhân', 'Các khoản thuế thu nhập phải đóng cho nhà nước theo thang luỹ tiến');
INSERT INTO `tc_lv0038` VALUES ('other', 'Các khoản khác', 'Tất cả các khoản phát sinh ngoài các khoản trên');
INSERT INTO `tc_lv0038` VALUES ('netviet', 'Phí NetViet', 'Phí NetViet thu khách hàng');
