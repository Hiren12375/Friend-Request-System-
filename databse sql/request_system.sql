-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 10, 2021 at 06:35 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `request_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id_c` int(11) NOT NULL AUTO_INCREMENT,
  `chat_from_id` int(11) NOT NULL,
  `chat_to_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_c`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id_c`, `chat_from_id`, `chat_to_id`, `message`, `time`, `status`) VALUES
(74, 16, 8, 'hey', '2021-07-10 06:30:58', 0),
(73, 16, 11, 'hello', '2021-07-10 06:30:49', 0),
(72, 14, 16, 'hello', '2021-07-10 05:46:07', 0),
(65, 13, 10, 'hello harsha', '2021-07-09 07:47:48', 0),
(66, 16, 13, 'what Are You Doing?', '2021-07-09 09:07:45', 0),
(63, 13, 16, 'hello Good Mornnig....', '2021-07-09 07:02:48', 0),
(62, 16, 13, 'hello Harsha', '2021-07-09 06:44:49', 0),
(70, 16, 13, 'hello', '2021-07-09 11:42:36', 0),
(69, 16, 13, 'Good Mornnig..', '2021-07-09 11:41:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `from_id`, `to_id`, `status`) VALUES
(32, 16, 13, 1),
(36, 16, 11, 1),
(31, 16, 15, 1),
(37, 16, 11, 0),
(30, 16, 8, 1),
(29, 16, 10, 1),
(39, 16, 14, 1),
(38, 13, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` bigint(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `bio` varchar(200) NOT NULL,
  `profile_pic` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `mobile`, `gender`, `bio`, `profile_pic`) VALUES
(10, 'neem', '6aa345cb15e1c771c821cbd0e30e3959', 'neem@gmail.com', 9856234712, 'Male', 'Employ', 'gettyimages-615462576-170667a.jpg'),
(9, 'kiran', 'b1a5b64256e27fa5ae76d62b95209ab3', 'kiran@gmail.com', 8521478529, 'Male', 'Worker', 'unnamed.jpg'),
(8, 'Hiren', '202cb962ac59075b964b07152d234b70', 'hiren@gmail.com', 7418529631, 'Male', 'Student ', 'download.jpg'),
(11, 'neha', '262f5bdd0af9098e7443ab1f8e435290', 'neha@gmail.com', 7412589632, 'Female', 'Sociyologist', 'WhatsApp Image 2021-06-22 at 4.32.45 PM.jpeg'),
(12, 'kamlesh', 'fca5abd59b385e783b5c896c851372ab', 'kamlesg@gmail.com', 7418529635, 'Male', 'student', 'download.jpg'),
(13, 'harsha', '226280c5dd9b1bd4e67c72ff2c94bf1b', 'harsha@gmail.com', 8412568974, 'Female', 'student', 'download.jpg'),
(14, 'neel', 'eac22cf37128b00063a8b2be2589d933', 'neel@gmail.com', 7418529635, 'Male', 'Business', 'unnamed.jpg'),
(15, 'rutvi', '21733d2b96db325a9cea2871a3de6ec3', 'rutvi@gmail.com', 9638527415, 'Female', 'Business', 'unnamed.jpg'),
(16, 'rutvik', '7619beac5f020e818e7ae5b3979a5f17', 'rutvik@gmail.com', 741529632, 'Male', 'Android Devloper', 'download.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
