-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2021 at 08:42 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progweb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `idalbums` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `releasedate` date NOT NULL,
  `producers` varchar(100) NOT NULL,
  `artists_idartists` int(11) NOT NULL,
  `cover` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`idalbums`, `title`, `releasedate`, `producers`, `artists_idartists`, `cover`) VALUES
(1, 'Remember', '2008-11-05', 'Yang Hyun-Suk', 3, ''),
(2, 'The Boys', '2011-10-19', 'Leeo Soo-Man', 1, ''),
(3, 'Sorry, Sorry', '2009-03-12', 'Lee Soo-Man', 2, ''),
(4, 'Mr. Simple', '2011-09-19', 'Lee Soo-Man', 2, ''),
(6, 'Aku bukan boneka', '1970-01-01', 'WR Supratman', 20, ''),
(7, 'Attitude', '2019-10-02', 'EMI Records', 22, 'Attitude.jpg'),
(8, 'Ensemble', '2018-04-18', 'EMI Records', 22, ''),
(24, 'Don\'t Smile at me', '2020-10-09', 'WR Supratman', 24, 'Don\'t Smile at me.png'),
(25, 'I will Always love you', '2020-11-12', 'Endahhh', 26, 'I will Always love you.png'),
(26, '5', '2020-11-07', 'EMI Records', 22, '5.jpg'),
(35, 'I will Always love youuuu', '2020-10-12', '88rising', 1, 'I will Always love youuuu.jpg'),
(36, 'Kumenangis', '2020-10-09', 'Rosso', 29, 'Kumenangis.png'),
(37, 'AKu bukan boneka', '2020-12-04', 'Kevin', 3, NULL),
(38, 'Binatang', '2020-10-02', 'EMI Records', 31, 'Binatang.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `idartists` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `debut` date NOT NULL,
  `company` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`idartists`, `name`, `debut`, `company`) VALUES
(1, 'Girls Generation', '2007-08-05', 'SM Entertainment'),
(2, 'Super Junior', '2005-11-06', 'SM Entertainment'),
(3, 'Big Bang', '2006-08-19', 'YG Entertainment'),
(20, 'Kekeyi', '2020-09-04', '88rising'),
(22, 'Mrs. GREEN APPLE', '2013-06-12', 'EMI Records'),
(23, 'Rossa', '2012-10-04', 'Aquarius'),
(24, 'Billie Eilish', '2018-10-10', 'Vivo'),
(26, 'Mariah Karey', '2008-11-05', 'Sony'),
(29, 'Blackpink', '2018-01-01', 'YG Entertainment'),
(30, 'Mimi pery', '2020-02-01', 'Oppo'),
(31, 'Maroon lima', '2020-12-11', 'Apa aja'),
(32, 'Agnes Monica', '2021-03-12', 'Sony'),
(40, 'Dua kali', '2021-03-11', 'SM Entertainment'),
(41, 'tes', '2020-01-01', 'sony');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`) VALUES
(1, 'Edward', 'edw', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`idalbums`),
  ADD KEY `fk_albums_artists_idx` (`artists_idartists`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`idartists`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `idalbums` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `idartists` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `fk_albums_artists` FOREIGN KEY (`artists_idartists`) REFERENCES `artists` (`idartists`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
