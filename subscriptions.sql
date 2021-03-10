-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2021 at 03:57 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `subscriptions`
--

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `email_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`email_id`, `email`, `date`) VALUES
(1, 'wbernhard@gmail.com', '2015-05-16 20:15:32'),
(3, 'gibson.rubye@hotmail.com', '1981-02-10 05:46:11'),
(5, 'dejon95@yahoo.com', '2014-04-03 21:34:32'),
(6, 'collier.albin@yahoo.com', '1970-08-06 00:47:37'),
(7, 'roy.jacobi@gmail.com', '2017-06-02 12:25:49'),
(8, 'khamill@hotmail.com', '1984-05-27 17:38:23'),
(22, 'dsmith@pacocha.com', '1997-08-05 15:02:38'),
(28, 'tester123@gmail.com', '2021-03-08 12:17:41'),
(67, 'qstoltenberg@oconnerherzog.com', '2017-04-05 10:13:19'),
(74, 'kling.fannie@doyle.com', '1979-01-09 06:27:38'),
(80, 'gabriella.price@yahoo.com', '2006-05-02 08:51:00'),
(83, 'jordan.cartwright@mohr.org', '1988-12-19 14:33:39'),
(89, 'schiller.malcolm@orn.net', '2015-09-05 12:14:28'),
(120, 'norris.dicki@hotmail.com', '1992-02-16 08:09:35'),
(215, 'habbott@yahoo.com', '1985-06-07 08:35:02'),
(242, 'antonina39@torphy.com', '1987-03-09 03:05:50'),
(250, 'julia51@kunzebarton.com', '1990-02-13 07:24:45'),
(270, 'qstoltenberg@emmerich.info', '2008-09-18 10:03:28'),
(281, 'cbatz@daniel.com', '1999-02-16 11:07:42'),
(393, 'cierra81@gmail.com', '2001-02-06 09:59:08'),
(563, 'jaycee82@leschchristiansen.com', '2006-08-25 15:55:24'),
(609, 'gmurphy@stromandibbert.com', '2009-08-31 06:31:15'),
(699, 'ekutch@lockmanpfannerstill.com', '2013-10-21 02:21:19'),
(766, 'marcelle.murazik@gmail.com', '2013-12-16 21:01:03'),
(807, 'qhudson@wyman.com', '1998-03-03 20:02:00'),
(836, 'cristina47@hotmail.com', '2007-07-19 20:56:49'),
(876, 'ewest@hotmail.com', '2002-01-14 20:26:08'),
(920, 'eulah10@yahoo.com', '2013-04-17 06:05:41'),
(952, 'sunny31@hintzgottlieb.biz', '2018-03-28 09:47:37'),
(1351, 'purdy.sally@reichert.com', '2017-04-27 13:26:26'),
(1825, 'mckenna89@ferry.biz', '1976-09-03 11:15:11'),
(2304, 'ayla44@hotmail.com', '2020-01-20 11:09:23'),
(2306, 'noble23@goodwin.org', '2020-04-24 19:34:15'),
(2670, 'cronin.alaina@hotmail.com', '1979-05-02 19:58:20'),
(4096, 'franco38@yahoo.com', '1978-02-04 12:51:08'),
(5192, 'windler.leon@hotmail.com', '2004-05-27 00:42:08'),
(7091, 'grayce.schneider@hagenes.com', '2004-12-11 01:50:13'),
(12455, 'fritsch.olga@wyman.org', '2009-05-16 22:33:43'),
(20468, 'yweissnat@yahoo.com', '1994-03-22 17:07:52'),
(24245, 'erich.gulgowski@sporerbins.com', '1995-12-10 19:09:40'),
(28360, 'kathlyn44@greendurgan.com', '1979-10-30 11:29:03'),
(28984, 'bashirian.martine@schumm.com', '1989-01-13 03:46:24'),
(32352, 'idonnelly@yahoo.com', '1992-02-28 23:07:13'),
(32578, 'runolfsson.kaela@king.com', '2012-09-26 03:23:53'),
(46506, 'hlubowitz@langoshwiegand.net', '1985-12-01 04:59:41'),
(60207, 'turcotte.mustafa@gmail.com', '2014-05-04 18:33:18'),
(62919, 'genoveva.hoppe@yahoo.com', '2014-09-17 13:49:15'),
(67545, 'wdickinson@macejkovic.com', '2017-12-12 13:52:54'),
(83181, 'elliott.ondricka@gmail.com', '1975-09-28 14:53:37'),
(84218, 'lehner.brooks@gmail.com', '2019-04-25 02:13:30'),
(96773, 'bode.rick@yahoo.com', '1972-07-12 15:09:10'),
(98955, 'sincere.fisher@hilll.com', '2012-12-01 05:11:10'),
(99469, 'bartoletti.sophia@bechtelar.com', '2018-01-14 16:46:50'),
(191368, 'francesco92@lang.com', '2013-05-13 15:28:23'),
(236398, 'kelsi55@hotmail.com', '1996-03-06 00:07:42'),
(291211, 'kassulke.shemar@gmail.com', '1983-07-13 20:50:14'),
(302191, 'walker.murl@kuphalorn.net', '1998-10-14 08:45:31'),
(385422, 'jadon.hand@gerhold.com', '2012-03-27 06:48:34'),
(496177, 'violet76@walker.com', '1982-06-03 03:25:52'),
(536224, 'eden.haley@gottlieb.com', '2020-05-24 05:50:46'),
(676659, 'rosendo.lehner@yahoo.com', '1999-07-05 07:31:54'),
(765784, 'caesar80@gmail.com', '2020-11-07 03:14:40'),
(777938, 'wturcotte@will.com', '2005-09-26 19:47:26'),
(797888, 'kay.aufderhar@osinski.com', '1975-08-22 11:36:59'),
(831635, 'thomas98@ferry.com', '2012-11-13 11:18:02'),
(971204, 'hauck.reece@ebert.info', '1975-04-25 09:19:19'),
(1518196, 'crunolfsson@hotmail.com', '1980-05-21 04:43:14'),
(2189158, 'zratke@hotmail.com', '1998-01-23 04:00:41'),
(2574262, 'kenyatta89@gmail.com', '1971-07-09 13:08:08'),
(3585791, 'cbernier@hotmail.com', '2008-03-08 10:37:54'),
(4650000, 'melissa73@terryparker.com', '1993-05-24 23:27:26'),
(5405899, 'predovic.luigi@yahoo.com', '2012-04-12 04:59:14'),
(5511958, 'greenholt.dana@zemlak.net', '1990-11-25 16:37:56'),
(5631226, 'rboyle@wolfwisozk.com', '1983-10-19 23:40:09'),
(6792200, 'ro\keefe@hotmail.com', '1982-10-20 12:55:21'),
(7981847, 'murphy.mauricio@yahoo.com', '2009-08-28 19:07:10'),
(16926026, 'smith.rico@blanda.net', '2013-11-20 00:10:29'),
(28185609, 'dyundt@hagenessawayn.com', '1989-11-29 23:15:06'),
(33294232, 'vickie95@kling.com', '1983-07-06 05:55:57'),
(56734810, 'darrel54@cole.com', '2009-04-07 09:54:59'),
(91674294, 'ghuel@yahoo.com', '1972-09-01 09:30:40'),
(94109030, 'luettgen.abraham@hotmail.com', '1997-11-30 23:39:57'),
(98141328, 'destiny.mitchell@hotmail.com', '2019-08-04 15:22:38'),
(98978792, 'boehm.joe@gmail.com', '1984-08-14 02:38:29'),
(597355938, 'judah.ondricka@brakuskassulke.net', '2013-05-07 05:48:48'),
(633966905, 'bkautzer@bartoletti.com', '1977-02-11 16:43:43'),
(708531425, 'lkreiger@walsh.net', '2009-04-16 21:48:08'),
(719207445, 'wkulas@hotmail.com', '1971-01-10 23:07:57'),
(910862057, 'uboyer@nikolaus.com', '1996-11-17 14:27:16'),
(930405707, 'jacobi.rowan@gmail.com', '1999-02-16 11:06:43'),
(948539807, 'kirlin.agnes@mayert.com', '1994-03-24 07:31:56'),
(959238980, 'jones.heather@gmail.com', '2000-12-28 11:41:17'),
(983400829, 'fadel.icie@hotmail.com', '2010-11-03 01:57:35'),
(983400930, 'maryse.schamberger@yahoo.com', '2000-03-28 19:54:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`email_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=983400931;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
