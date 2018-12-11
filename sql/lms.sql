-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2018 at 03:31 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `books` int(10) NOT NULL,
  `isbn_no` varchar(100) DEFAULT NULL,
  `book_title` varchar(200) DEFAULT NULL,
  `book_type` int(10) UNSIGNED DEFAULT NULL,
  `author_name` varchar(100) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `edition` varchar(40) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `pages` int(11) DEFAULT NULL,
  `publisher` varchar(140) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`books`, `isbn_no`, `book_title`, `book_type`, `author_name`, `purchase_date`, `edition`, `price`, `pages`, `publisher`, `status`) VALUES
(1, '62781733', 'River  Between', 1, 'Ngugi wa Thiongo', '2018-02-24', '1', '300.00', 120, 'Longhorn', 0),
(2, '978-9966-111-32-6', 'Who is Jesus', 2, 'Greg Gilbert', '2018-02-24', NULL, '800.00', 138, 'ekklesia afrika', 1),
(3, '978-0-8308-5810-1', 'Pauls Prison Letters', 1, 'Smith', '2018-02-24', NULL, '450.00', 133, 'IVP cONNECT', 1),
(4, '122-21-223-3222-1', 'The Midnight Star', 1, 'Marie Liu', '0000-00-00', '1', '0.00', 122223, 'BLC', 1),
(5, '233-12-245-6666-3', 'The Golden Compass', 1, 'Michael Liem', '0000-00-00', '1', '0.00', 111111, 'FCH', 1),
(6, '122-22-214-1241-2', '14124fsfsfa', 1, 'sfsdgsdgsdg', '2018-03-19', 'sdg', '0.00', 111111, 'sdgsdgsdg', 1),
(7, '979-97-979-6769-8', 'Test', 1, 'Test', '2018-03-07', '1', NULL, 111111, 'test', 1),
(8, '889-77-687-7695-8', 'The Alchemist', 1, 'Michael Scott', '0000-00-00', '1', '0.00', 456575, 'Harry Publishing', 0),
(9, '122-32-235-2079-0', 'The Homecoming', 1, 'Sidney Sheldon', '2018-03-19', '1', '3444.22', 353464, 'GRAND', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_issued`
--

CREATE TABLE `book_issued` (
  `book_issued` int(10) NOT NULL,
  `members` int(10) NOT NULL,
  `books` int(10) NOT NULL,
  `isbn_no` varchar(100) DEFAULT NULL,
  `issued_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` varchar(40) DEFAULT NULL,
  `issued_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book_issued`
--

INSERT INTO `book_issued` (`book_issued`, `members`, `books`, `isbn_no`, `issued_date`, `return_date`, `due_date`, `status`, `issued_by`) VALUES
(4, 1, 3, '978-0-8308-5810-1', '2018-12-07', NULL, '2018-12-10', '1', 1),
(7, 1, 6, '122-22-214-1241-2', '2018-12-07', NULL, '2018-12-10', '1', 1),
(8, 1, 5, '233-12-245-6666-3', '2018-12-08', NULL, '2018-12-07', '1', 1),
(9, 1, 7, '979-97-979-6769-8', '2018-12-08', NULL, '2018-12-10', '1', 1),
(12, 1, 2, '978-9966-111-32-6', '2018-12-08', NULL, '2018-12-10', '1', 1),
(13, 2, 4, '122-21-223-3222-1', '2018-12-08', NULL, '2018-03-19', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `community`
--

CREATE TABLE `community` (
  `community` int(10) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `description` text,
  `allowSignup` tinyint(4) DEFAULT NULL,
  `needsApproval` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `community`
--

INSERT INTO `community` (`community`, `name`, `description`, `allowSignup`, `needsApproval`) VALUES
(1, 'KKD', 'Group from KKD friends', 0, 0),
(2, 'STK ', 'Group from STK pepz', 0, 0),
(3, 'BTC', 'Banila Town Center', 0, 0),
(4, 'CCP', 'Cebu City People', 0, 0),
(5, 'TYC', 'Talisay Youth Club', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `magazines`
--

CREATE TABLE `magazines` (
  `magazines` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date_of_receipt` date DEFAULT NULL,
  `date_published` date DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `publisher` varchar(140) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `magazines`
--

INSERT INTO `magazines` (`magazines`, `name`, `date_of_receipt`, `date_published`, `pages`, `price`, `publisher`) VALUES
(1, 'Elle', '2018-12-11', '2018-12-04', 5, '12.33', 'The Elle'),
(2, 'Magz', '2018-12-11', '2018-12-11', 7, '21.31', 'The Magz');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `members` int(10) NOT NULL,
  `name` varchar(140) DEFAULT NULL,
  `contact` varchar(40) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `signup_date` date DEFAULT NULL,
  `community` int(10) NOT NULL,
  `is_banned` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`members`, `name`, `contact`, `email`, `signup_date`, `community`, `is_banned`) VALUES
(1, 'Janice Nonay', '2563894', 'janice@gmail.com', '2018-12-08', 1, 0),
(2, 'Daniel Padilla', '2563894', 'daniel@gmail.com', '2018-12-08', 2, 0),
(3, 'Enrique Gil', '526382', 'EnriqueGil@gmail.com', '2018-12-08', 3, 0),
(4, 'Theo James', '526843', 'TheTheoJames@gmail.com', '2018-12-08', 3, 0),
(5, 'Gigi Hadid', '568134', 'gigiHadid@gmail.com', '2018-12-07', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `newspapers`
--

CREATE TABLE `newspapers` (
  `newspapers` int(10) NOT NULL,
  `language` varchar(40) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date_of_receipt` date DEFAULT NULL,
  `date_published` date DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT '0.00',
  `publisher` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newspapers`
--

INSERT INTO `newspapers` (`newspapers`, `language`, `name`, `date_of_receipt`, `date_published`, `pages`, `price`, `publisher`) VALUES
(1, 'English', 'The Daily Planet', '2018-02-24', '2018-02-24', 35, '100.00', 'Standard Group Media'),
(2, 'English', 'The Standard', '2018-02-24', '2018-02-24', 35, '100.00', 'Standard Group Media'),
(3, 'English', 'The Inquirer', '2018-12-05', '2018-12-05', 10, '12.88', 'Inquirer'),
(4, 'English', 'Sunstar', '2018-12-05', '2018-12-05', 9, '12.54', 'The Sunstar');

-- --------------------------------------------------------

--
-- Table structure for table `return_book`
--

CREATE TABLE `return_book` (
  `return_book` int(10) NOT NULL,
  `members` int(10) NOT NULL,
  `books` int(10) NOT NULL,
  `issued_date` date DEFAULT NULL,
  `due_date` int(10) UNSIGNED DEFAULT '1',
  `return_date` date DEFAULT NULL,
  `fine_paid` decimal(10,2) DEFAULT '0.00',
  `cleared_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `return_book`
--

INSERT INTO `return_book` (`return_book`, `members`, `books`, `issued_date`, `due_date`, `return_date`, `fine_paid`, `cleared_by`) VALUES
(1, 2, 4, '2018-12-08', 2018, NULL, NULL, NULL),
(2, 2, 4, '2018-12-08', 2018, NULL, NULL, NULL),
(3, 1, 3, '1970-01-01', 2018, NULL, NULL, NULL),
(4, 2, 4, '2018-12-08', 2018, '2018-12-11', '53.40', 1),
(5, 2, 4, '2018-12-08', 2018, '2018-12-11', '53.40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(10) NOT NULL,
  `name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Novel'),
(2, 'Short Stories'),
(3, 'Fiction'),
(4, 'Non Fiction'),
(5, 'Sci-Fi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users` int(10) NOT NULL,
  `membership_number` varchar(40) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(140) DEFAULT NULL,
  `contact` varchar(40) DEFAULT NULL,
  `id_number` int(11) DEFAULT NULL,
  `role` int(1) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users`, `membership_number`, `username`, `password`, `email`, `name`, `contact`, `id_number`, `role`, `is_active`) VALUES
(1, '1231', 'admin', '3b050565d6df7d07652e642972d899c5d0057a358fad57413d010ad2abd24acd', '', 'Kelvin Guma', '0708344101', 99239183, 1, 1),
(2, '2000', 'user', '75c4f7ac78353f698b9841fcb5a37b67d987663f8588ed5422bfa814a7ee716a', '', 'Dennis Amadi', '079822271', 33432113, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`books`);

--
-- Indexes for table `book_issued`
--
ALTER TABLE `book_issued`
  ADD PRIMARY KEY (`book_issued`),
  ADD KEY `fk_book_issued_members` (`members`),
  ADD KEY `fk_book_issued_by` (`issued_by`),
  ADD KEY `fk_book_issued_book` (`books`);

--
-- Indexes for table `community`
--
ALTER TABLE `community`
  ADD PRIMARY KEY (`community`);

--
-- Indexes for table `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`magazines`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`members`),
  ADD KEY `fk_members_community` (`community`);

--
-- Indexes for table `newspapers`
--
ALTER TABLE `newspapers`
  ADD PRIMARY KEY (`newspapers`);

--
-- Indexes for table `return_book`
--
ALTER TABLE `return_book`
  ADD PRIMARY KEY (`return_book`),
  ADD KEY `fk_return_book_members` (`members`),
  ADD KEY `fk_return_book_book` (`books`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `books` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `book_issued`
--
ALTER TABLE `book_issued`
  MODIFY `book_issued` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `community`
--
ALTER TABLE `community`
  MODIFY `community` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `magazines`
--
ALTER TABLE `magazines`
  MODIFY `magazines` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `members` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `newspapers`
--
ALTER TABLE `newspapers`
  MODIFY `newspapers` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `return_book`
--
ALTER TABLE `return_book`
  MODIFY `return_book` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_issued`
--
ALTER TABLE `book_issued`
  ADD CONSTRAINT `fk_book_issued_book` FOREIGN KEY (`books`) REFERENCES `books` (`books`),
  ADD CONSTRAINT `fk_book_issued_by` FOREIGN KEY (`issued_by`) REFERENCES `users` (`users`),
  ADD CONSTRAINT `fk_book_issued_members` FOREIGN KEY (`members`) REFERENCES `members` (`members`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `fk_members_community` FOREIGN KEY (`community`) REFERENCES `community` (`community`);

--
-- Constraints for table `return_book`
--
ALTER TABLE `return_book`
  ADD CONSTRAINT `fk_return_book_book` FOREIGN KEY (`books`) REFERENCES `books` (`books`),
  ADD CONSTRAINT `fk_return_book_members` FOREIGN KEY (`members`) REFERENCES `members` (`members`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
