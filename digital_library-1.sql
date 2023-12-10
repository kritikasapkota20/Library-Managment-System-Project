-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2023 at 07:26 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'Amish Malla', 'admin', 'mallaamish12@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `books_name` varchar(255) NOT NULL,
  `books_image` varchar(255) DEFAULT NULL,
  `catid` int(11) DEFAULT NULL,
  `books_author_name` varchar(255) DEFAULT NULL,
  `books_publication_name` varchar(255) DEFAULT NULL,
  `books_purchase_date` date DEFAULT NULL,
  `books_price` decimal(10,2) DEFAULT NULL,
  `books_quantity` int(11) DEFAULT NULL,
  `books_availability` varchar(10) DEFAULT NULL,
  `books_rent` decimal(10,2) DEFAULT NULL,
  `isbn_number` varchar(20) DEFAULT NULL,
  `librarian_username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `books_name`, `books_image`, `catid`, `books_author_name`, `books_publication_name`, `books_purchase_date`, `books_price`, `books_quantity`, `books_availability`, `books_rent`, `isbn_number`, `librarian_username`) VALUES
(1, 'The Great Gatsby', 'https://thissplendidshambles.com/wp-content/uploads/2012/07/396094.jpg', 1, 'F. Scott Fitzgerald', 'Penguin Books', '2022-01-01', '25.99', 10, '9', '0.00', '9780141920226', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookrequest`
--

CREATE TABLE `bookrequest` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `bookname` varchar(100) NOT NULL,
  `actype` varchar(20) NOT NULL,
  `issuesdays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE `fine` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `fine_amount` decimal(10,2) NOT NULL,
  `paid_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `issuebook`
--

CREATE TABLE `issuebook` (
  `id` int(11) NOT NULL,
  `bookid` int(11) NOT NULL,
  `actype` varchar(20) NOT NULL,
  `userid` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `issuebook` varchar(100) DEFAULT NULL,
  `issuename` varchar(50) DEFAULT NULL,
  `fine_amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issuebook`
--

INSERT INTO `issuebook` (`id`, `bookid`, `actype`, `userid`, `issue_date`, `due_date`, `return_date`, `status`, `issuebook`, `issuename`, `fine_amount`) VALUES
(1, 1, 'student', 1, '2023-06-21', '2023-07-21', NULL, 'Issued', 'The Great Gatsby', 'Ram Shrestha', NULL);
-- (2, 1, 'student', 1, '2023-07-09', '2023-07-12', NULL, 'Issued', 'The Great Gatsby', 'Ram Shrestha', '0.00'),
-- (3, 1, 'student', 1, '2023-07-09', '2023-07-22', NULL, 'Issued', 'The Great Gatsby', 'Ram Shrestha', '0.00'),
-- (4, 1, 'student', 1, '2023-07-09', '2023-07-27', NULL, 'Issued', 'The Great Gatsby', 'Ram Shrestha', '0.00'),
-- (5, 1, 'student', 1, '2023-07-09', '2023-07-29', NULL, 'Issued', 'The Great Gatsby', 'Ram Shrestha', '0.00'),
-- (6, 1, 'student', 1, '2023-07-09', '2023-08-25', NULL, 'Issued', 'The Great Gatsby', 'Ram Shrestha', '0.00'),
-- (7, 1, 'student', 1, '2023-07-09', '2023-08-25', NULL, 'Issued', 'The Great Gatsby', 'Ram Shrestha', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(150) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `categoryName`, `status`, `creationDate`, `updationDate`) VALUES
(1, 'Fiction', 1, '2023-06-19 06:15:00', '2023-06-19 06:15:00'),
(2, 'Romantic', 1, '2023-07-09 00:13:46', '2023-07-09 03:58:46'),
(3, 'Science', 1, '2023-07-09 22:18:44', '2023-07-10 02:03:44');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `actype` varchar(20) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `email`, `actype`, `registration_date`, `last_login_date`) VALUES
(1, 'Ram Shrestha', 'ramshrestha', 'admin123', 'ram@gmail.com', 'student', '2023-06-20 04:15:00', '2023-06-20 04:15:00'),
(2, 'Kritika Sapkota', 'kritika', 'admin123', 'kritika@gmai.com', 'teacher', '2023-07-09 21:53:03', '2023-07-09 21:53:03'),
(3, 'Test User', 'testuser', 'test123', 'test@gmail.com', 'teacher', '2023-07-09 22:00:08', '2023-07-09 22:00:08'),
(5, 'Sushan Thapa', 'sushan', 'sushan123', 'sushan@gmail.com', 'student', '2023-07-09 23:37:03', '2023-07-09 23:37:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookrequest`
--
ALTER TABLE `bookrequest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `bookid` (`bookid`);

--
-- Indexes for table `fine`
--
ALTER TABLE `fine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `bookid` (`bookid`);

--
-- Indexes for table `issuebook`
--
ALTER TABLE `issuebook`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookid` (`bookid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  -- MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  -- MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookrequest`
--
ALTER TABLE `bookrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fine`
--
ALTER TABLE `fine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issuebook`
--
ALTER TABLE `issuebook`
  -- MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  -- MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  -- MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookrequest`
--
ALTER TABLE `bookrequest`
  ADD CONSTRAINT `bookrequest_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `bookrequest_ibfk_2` FOREIGN KEY (`bookid`) REFERENCES `book` (`id`);

--
-- Constraints for table `fine`
--
ALTER TABLE `fine`
  ADD CONSTRAINT `fine_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `fine_ibfk_2` FOREIGN KEY (`bookid`) REFERENCES `book` (`id`);

--
-- Constraints for table `issuebook`
--
ALTER TABLE `issuebook`
  ADD CONSTRAINT `issuebook_ibfk_1` FOREIGN KEY (`bookid`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `issuebook_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);
  CREATE TABLE approved_requests (
    request_id INT PRIMARY KEY
);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
