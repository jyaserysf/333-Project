-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 01:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surveysphere`
--

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `MCQID` int(11) NOT NULL,
  `choice1` varchar(200) NOT NULL,
  `choice2` varchar(200) NOT NULL,
  `choice3` varchar(200) NOT NULL,
  `choice4` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`MCQID`, `choice1`, `choice2`, `choice3`, `choice4`) VALUES
(12, 'A1', 'A2', 'A3', 'A4');

-- --------------------------------------------------------

--
-- Table structure for table `participate`
--

CREATE TABLE `participate` (
  `participateID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `surveyID` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `questionID` int(11) NOT NULL,
  `content` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `SurveyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`questionID`, `content`, `type`, `SurveyID`) VALUES
(12, 'Who are you?', 'mcq', 5),
(13, 'Really?', 'yes_no', 5),
(14, 'Really?', 'short_answer', 5),
(15, 'Rate?', 'scale', 5);

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `responseID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `surveyID` int(11) NOT NULL,
  `numQuestions` int(11) NOT NULL,
  `numResponses` int(11) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`surveyID`, `numQuestions`, `numResponses`, `date`, `title`, `description`, `category`) VALUES
(5, 0, 4, '2023-05-24', 'SurveyOne', 'This is a survey after the editing', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneCode` varchar(10) DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `name`, `email`, `phoneCode`, `phoneNumber`, `role`, `password`) VALUES
(1, 'sahmed', 'Ahmed Khalaf', 'abc@gmail.com', '', '', 'admin', '$2y$10$dnd54a5uXsZstLRejJH8T.ohSOPzwUbXmvHQS61wVcc2z72c6eZtm'),
(2, 'jood', 'Jood Yaser', 'jood@gmail.com', '', '', 'user', '$2y$10$XAH92dl.sdyeFhc3wQ4B1.huxr8oD3qw.QNceiqTj09tyXYFRvtG.'),
(3, 'ali1', 'Ali Majeed', 'ali@gmail.com', '', '', 'user', '$2y$10$Lf/ZHlhf0as.rjPkm9TNjOFTKmHzvPmKG0AWVsBMqaIqxICcZQf/m'),
(4, 'muntadher', 'Muntadher', '202002103@stu.uob.edu.bh', '+973', '33000001', 'admin', '$2y$10$gmZuqBZ4xLNCSBZVWYlkHeBCt/Lk3BGP5prJCDNyJ8SrFneIdTqyW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`MCQID`);

--
-- Indexes for table `participate`
--
ALTER TABLE `participate`
  ADD PRIMARY KEY (`participateID`),
  ADD KEY `surveyID` (`surveyID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionID`),
  ADD KEY `SurveyID` (`SurveyID`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`responseID`),
  ADD KEY `questionID` (`questionID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`surveyID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `MCQID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `participate`
--
ALTER TABLE `participate`
  MODIFY `participateID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `responseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `surveyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`MCQID`) REFERENCES `questions` (`questionID`);

--
-- Constraints for table `participate`
--
ALTER TABLE `participate`
  ADD CONSTRAINT `participate_ibfk_1` FOREIGN KEY (`surveyID`) REFERENCES `surveys` (`surveyID`),
  ADD CONSTRAINT `participate_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`SurveyID`) REFERENCES `surveys` (`surveyID`);

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `questions` (`questionID`),
  ADD CONSTRAINT `responses_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
