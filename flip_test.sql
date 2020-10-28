-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base',	1603787612),
('m201027_075132_create_seller_disburse_table',	1603787780);

DROP TABLE IF EXISTS `seller_disburse`;
CREATE TABLE `seller_disburse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_disburse` bigint(20) DEFAULT NULL,
  `bank_code` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `amount` bigint(20) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `beneficiary_name` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `time_served` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `seller_disburse` (`id`, `id_disburse`, `bank_code`, `account_number`, `status`, `amount`, `fee`, `beneficiary_name`, `remark`, `receipt`, `timestamp`, `time_served`) VALUES
(1,	1376040027,	'bni',	'1234567890',	'PENDING',	10000,	4000,	'PT FLIP',	'sample remark',	'https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg',	'2020-10-28 12:55:59',	'2020-10-28 12:57:26'),
(2,	9343563541,	'bni',	'1234567890',	'SUCCESS',	10000,	4000,	'PT FLIP',	'sample remark',	'https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg',	'2020-10-28 12:56:01',	'2020-10-28 12:57:27'),
(3,	9695596851,	'bni',	'1234567890',	'SUCCESS',	10000,	4000,	'PT FLIP',	'sample remark',	'https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg',	'2020-10-28 12:56:02',	'2020-10-28 12:55:32'),
(4,	6444689697,	'bni',	'1234567890',	'SUCCESS',	10000,	4000,	'PT FLIP',	'sample remark',	'https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg',	'2020-10-28 12:56:05',	'2020-10-28 12:57:29'),
(5,	2920588959,	'bni',	'1234567890',	'SUCCESS',	10000,	4000,	'PT FLIP',	'sample remark',	'https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg',	'2020-10-28 12:56:06',	'2020-10-28 12:57:30'),
(7,	7712677864,	'bni',	'1234567890',	'PENDING',	10000,	4000,	'PT FLIP',	'sample remark',	'https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg',	'2020-10-28 12:56:07',	'2020-10-28 12:57:31'),
(8,	5481996189,	'bni',	'1234567890',	'PENDING',	10000,	4000,	'PT FLIP',	'oct 2020',	'https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg',	'2020-10-28 12:58:18',	'2020-10-28 12:57:33');

-- 2020-10-28 08:52:50
