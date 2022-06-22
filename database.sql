
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Table structure for table `users`
--
-- CREATE DATABASE `mydatabase`;


CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'member',
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(8, 'Fani man', 'fantahunfekadu1@gmail.com', '0139a3c5cf42394be982e766c93f5ed0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- Table structure for table `comments`
--
 
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `fromuser` varchar(255) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- mysql> alter table comments add `from` varchar(255) NOT NULL;
-- mysql> ALTER TABLE `comments` CHANGE COLUMN `from` `fromuser` varchar(255) NOT NULL;
-- mysql> delete from users where id=11;
-- mysql> alter table users add `role` varchar(255) NOT NULL DEFAULT 'member';
-- INSERT INTO users (username, email, password, role) VALUES ('Admin', 'admin@gmail.com', '9c1ad00a16a7c67e2727b471ac969e96', 'admin');
-- 9c1ad00a16a7c67e2727b471ac969e96 = adminn


	-- SELECT * FROM users WHERE email='admin@gmail.com' AND password='9c1ad00a16a7c67e2727b471ac969e96';
-- ALTER TABLE "users" DROP "status";
-- mysql> alter table users add `status` tinyint(1) NOT NULL DEFAULT 1;




-- mysql> UPDATE users SET status=0 WHERE id=17;
