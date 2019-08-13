-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Jul-2019 às 22:52
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movies_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritemovies`
--

CREATE TABLE `favoritemovies` (
  `movieId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `moviePosterPath` varchar(100) NOT NULL,
  `movieTitle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `favoritemovies`
--

INSERT INTO `favoritemovies` (`movieId`, `userId`, `moviePosterPath`, `movieTitle`) VALUES
(157433, 4, '/7SPhr7Qj39vbnfF9O2qHRYaKHAL.jpg', 'Pet Sematary'),
(299534, 4, '/or06FN3Dka5tukK1e9sl16pB3iy.jpg', 'Avengers: Endgame'),
(399579, 4, '/xRWht48C2V8XNfzvPehyClOvDni.jpg', 'Alita: Battle Angel'),
(447404, 59, '/wgQ7APnFpf1TuviKHXeEe3KnsTV.jpg', 'PokÃ©mon Detective Pikachu'),
(542417, 4, '/7ryH8Noh6VKE4L42yhpR5jqIGsF.jpg', 'Skin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `favorites`
--

CREATE TABLE `favorites` (
  `User_ID` int(11) NOT NULL,
  `Car_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `favorites`
--

INSERT INTO `favorites` (`User_ID`, `Car_ID`) VALUES
(4, 3),
(5, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `movie_rating`
--

CREATE TABLE `movie_rating` (
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `movie_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `movie_rating`
--

INSERT INTO `movie_rating` (`user_id`, `movie_id`, `movie_rating`) VALUES
(4, 287947, 8),
(4, 299534, 10),
(4, 399579, 10),
(5, 299534, 5),
(5, 399579, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `Role_ID` int(11) NOT NULL,
  `Name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`Role_ID`, `Name`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `First_Name` varchar(25) NOT NULL,
  `Last_Name` varchar(25) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Salt` varchar(30) NOT NULL,
  `Role_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`User_ID`, `First_Name`, `Last_Name`, `Email`, `Username`, `Password`, `Salt`, `Role_ID`) VALUES
(4, 'sa', 'sa', 'sa@gmail.com', 'sa', '$2x$05$c12e01f2a13ff5587e1e9eEnjJ0Y3b88ZsWqHOO9ynejAnB5c.jQm', '$2x$05$c12e01f2a13ff5587e1e9e$', 2),
(5, 'demo', 'demo', 'demo@gmail.com', 'demo', '$2a$05$fe01ce2a7fbac8fafaed7Ox7.YZOJLWkeffuYjT8Oi6SQKQO0i.7m', '$2a$05$fe01ce2a7fbac8fafaed7c$', 2),
(59, 'leo', 'studart', 'leo@studart', 'zaz', '$2y$05$e7e6c2d753cd2e3b21528ux9C89KslOxw.FfJiUg4wS.sa6FaKk/e', '$2y$05$e7e6c2d753cd2e3b215282$', 2),
(61, 'Fran', 'Pinzon', 'Fran@Puzon', 'Fran', '$2a$05$f52b83f305727fb6bb319eq3Xkil/L/JjpMCBGyl/lvT1Zpo7juQy', '$2a$05$f52b83f305727fb6bb319f$', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favoritemovies`
--
ALTER TABLE `favoritemovies`
  ADD PRIMARY KEY (`movieId`,`userId`);

--
-- Indexes for table `movie_rating`
--
ALTER TABLE `movie_rating`
  ADD UNIQUE KEY `unique_index` (`user_id`,`movie_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Role_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `User_Role_ID_FK` (`Role_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `User_Role_ID_FK` FOREIGN KEY (`Role_ID`) REFERENCES `roles` (`Role_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
