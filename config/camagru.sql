DROP DATABASE IF  EXISTS `camagru`;

CREATE DATABASE IF NOT EXISTS `camagru`;

USE `camagru`;

CREATE TABLE IF NOT EXISTS `user` (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(250),
    password VARCHAR(1000),
    email VARCHAR(250),
    login_status ENUM('0', '1') DEFAULT '0',
    send_mail INT(1) DEFAULT 1,
    date_log DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
   );


CREATE TABLE IF NOT EXISTS `image` (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT(10),
    value VARCHAR(250), -- link
    grayscale INT(3),
    brightness INT(3),
    contrast INT(3),
    sepia INT(3),
    invert INT(3),
    hue_rotate INT(3),
    opacity INT(3),
    filter VARCHAR(250),
    description VARCHAR(250),
    date_log DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(id)
   );


CREATE TABLE IF NOT EXISTS `comments` (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT(10),
    image_id INT(10),
    value VARCHAR(1000),
    date_log DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (image_id) REFERENCES image(id)
   );


CREATE TABLE IF NOT EXISTS `likes` (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT(10),
    image_id INT(10),
    value ENUM('0', '1', '-1'),
    date_log DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (image_id) REFERENCES image(id)
   );


CREATE TABLE IF NOT EXISTS `rating` (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT(10),
    image_id INT(10),
    value INT(1),
    date_log DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (image_id) REFERENCES image(id)
   );

INSERT INTO `user` (`name`, `password`, `email`, `login_status`, `send_mail`, `date_log`) VALUES
('Ssarkisi', '6152e7fd77247aa5f4ceb6a8d9f14e9d3dfc1e71d69601be5779de2c217807b8f9e3361ba044deb59819a1bee314a23087946380d9ccb9dee108ce5cbdcbf415', 'samvel@email.ua', '0', 1, '2018-08-17 14:48:28'),
('Samvel', '6152e7fd77247aa5f4ceb6a8d9f14e9d3dfc1e71d69601be5779de2c217807b8f9e3361ba044deb59819a1bee314a23087946380d9ccb9dee108ce5cbdcbf415', 'samvelsarkisian92@gmail.com', '0', 1, '2018-08-17 15:10:05');

-- --------------------------------------------------------

INSERT INTO `image` ( `user_id`, `value`, `grayscale`, `brightness`, `contrast`, `sepia`, `invert`, `hue_rotate`, `opacity`, `filter`, `description`, `date_log`) VALUES
(1, '5b76ba0424d01.png', 0, 134, 174, 0, 0, 0, 0, 'f5.png', '', '2018-08-17 15:05:24'),
(1, '5b76ba53c9c6d.png', 41, 72, 200, 83, 1, 0, 0, 'f6.png', '', '2018-08-17 15:06:43'),
(1, '5b76ba59c4191.png', 0, 100, 100, 0, 0, 0, 0, 'f2.png', '', '2018-08-17 15:06:50'),
(1, '5b76ba7179dff.png', 100, 192, 100, 100, 0, 0, 0, 'f1.png', '', '2018-08-17 15:07:13'),
(2, '5b76bb36af1b9.png', 0, 100, 100, 0, 0, 0, 0, 'f0.png', '', '2018-08-17 15:10:30');


INSERT INTO `comments` (`user_id`, `image_id`, `value`, `date_log`) VALUES
(1, 5, 'Test', '2018-08-17 15:11:48'),
(2, 3, 'message', '2018-08-17 15:14:00'),
(2, 5, 'Test 2', '2018-08-17 15:14:14'),
(2, 4, 'comment', '2018-08-17 15:15:30'),
(1, 5, 'test 3', '2018-08-17 15:21:15'),
(1, 5, 'test 4', '2018-08-17 15:21:59'),
(1, 5, 'test 5', '2018-08-17 15:22:31'),
(1, 5, 'test 6', '2018-08-17 15:22:48'),
(1, 3, 'message 2', '2018-08-17 15:23:30'),
(1, 3, 'test', '2018-08-17 15:26:12'),
(1, 5, 'test 7', '2018-08-17 15:26:29');



-- --------------------------------------------------------

INSERT INTO `likes` (`user_id`, `image_id`, `value`, `date_log`) VALUES
(1, 2, '0', '2018-08-17 15:09:37'),
(1, 3, '0', '2018-08-17 15:09:39'),
(1, 4, '0', '2018-08-17 15:09:41'),
(2, 4, '0', '2018-08-17 15:11:06'),
(2, 1, '0', '2018-08-17 15:11:09'),
(2, 3, '0', '2018-08-17 15:11:11'),
(2, 5, '0', '2018-08-17 15:11:29');

-- --------------------------------------------------------

INSERT INTO `rating` (`user_id`, `image_id`, `value`, `date_log`) VALUES
(1, 4, 5, '2018-08-17 15:09:25'),
(1, 3, 3, '2018-08-17 15:09:29'),
(1, 1, 5, '2018-08-17 15:09:32'),
(1, 2, 4, '2018-08-17 15:09:35'),
(2, 4, 1, '2018-08-17 15:10:47'),
(2, 3, 1, '2018-08-17 15:10:52'),
(2, 2, 1, '2018-08-17 15:10:56'),
(2, 1, 1, '2018-08-17 15:10:59'),
(2, 5, 5, '2018-08-17 15:11:25'),
(1, 5, 4, '2018-08-17 15:22:53');

-- --------------------------------------------------------


