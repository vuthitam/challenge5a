-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 13, 2022 lúc 06:45 PM
-- Phiên bản máy phục vụ: 10.5.12-MariaDB
-- Phiên bản PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `id18726542_studentmanage`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `assignments`
--

CREATE TABLE `assignments` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacherId` int(5) UNSIGNED DEFAULT NULL,
  `author` text DEFAULT NULL COMMENT 'Tên người ra đề',
  `title` varchar(100) NOT NULL COMMENT 'Tiêu đề bài tập',
  `files` varchar(100) NOT NULL COMMENT 'link file bài tập',
  `dueto` datetime DEFAULT NULL COMMENT 'Hạn nộp',
  `createdAt` varchar(100) NOT NULL COMMENT 'Ngày tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `assignments`
--

INSERT INTO `assignments` (`id`, `teacherId`, `author`, `title`, `files`, `dueto`, `createdAt`) VALUES
(11, 1, 'teacher1', 'Assignment week 1.pdf', 'uploads/teacher_assignment/Assignment week 1.pdf', NULL, 'Thursday 14th April 2022 01:17:38 AM'),
(12, 1, 'teacher1', 'Đề-ôn-luyện-Tết.pdf', 'uploads/teacher_assignment/-ôn-luyện-Tết.pdf', NULL, 'Thursday 14th April 2022 01:17:52 AM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `challenges`
--

CREATE TABLE `challenges` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacherid` int(5) UNSIGNED NOT NULL,
  `title` text NOT NULL COMMENT 'Tên challenge',
  `files` varchar(100) NOT NULL COMMENT 'đường dẫn file',
  `goiy` text DEFAULT NULL,
  `createdAt` text DEFAULT NULL COMMENT 'Thời gian tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `challenges`
--

INSERT INTO `challenges` (`id`, `teacherid`, `title`, `files`, `goiy`, `createdAt`) VALUES
(6, 1, 'Thơ ca', 'uploads/challenge/banh troi nuoc.txt', 'Bài thơ nói lên thân phận người phụ nữ trong xã hội phong kiến xưa Việt Nam?', 'Thursday 14th April 2022 01:20:19 AM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `messages`
--

CREATE TABLE `messages` (
  `id` int(5) UNSIGNED NOT NULL,
  `content` text DEFAULT NULL,
  `idsend` int(5) UNSIGNED NOT NULL COMMENT 'ID người gửi',
  `idrec` int(5) UNSIGNED NOT NULL COMMENT 'ID người nhận',
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Thời gian tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `messages`
--

INSERT INTO `messages` (`id`, `content`, `idsend`, `idrec`, `createdAt`) VALUES
(24, 'hello teacher2 from teacher1', 1, 2, '2022-04-13 08:22:17'),
(25, 'hello ', 1, 3, '2022-04-13 09:15:57'),
(27, 'hello teacher2 from teacher nmq', 1, 2, '2022-04-13 10:37:58'),
(28, 'hello teacher from sv tamvt part 2', 3, 1, '2022-04-13 10:43:22'),
(29, 'good evening teacher', 3, 1, '2022-04-13 10:43:37'),
(31, 'hello Hồng Anh from Tâm Vt with love', 3, 4, '2022-04-13 18:23:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `submits`
--

CREATE TABLE `submits` (
  `id` int(10) UNSIGNED NOT NULL,
  `studentid` int(5) UNSIGNED NOT NULL COMMENT 'ID học sinh submit',
  `assignmentid` int(5) UNSIGNED NOT NULL COMMENT 'id của assignment',
  `title` varchar(256) NOT NULL COMMENT 'Tên đề bài',
  `link` text NOT NULL COMMENT 'Đường dẫn tệp',
  `updatedAt` varchar(100) NOT NULL DEFAULT current_timestamp() COMMENT 'Thời gian nộp lại'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `submits`
--

INSERT INTO `submits` (`id`, `studentid`, `assignmentid`, `title`, `link`, `updatedAt`) VALUES
(7, 3, 11, 'Bài tập submit.pdf', 'uploads/student_submit/Bài tập submit.pdf', 'Thursday 14th April 2022 01:36:54 AM'),
(8, 3, 12, 'Submit assignment.pdf', 'uploads/student_submit/Submit assignment.pdf', 'Thursday 14th April 2022 01:37:27 AM'),
(9, 4, 11, 'Slide_final.pdf', 'uploads/student_submit/Slide_final.pdf', 'Thursday 14th April 2022 01:39:41 AM'),
(10, 4, 12, 'Bao cao CK.pdf', 'uploads/student_submit/Bao cao CK.pdf', 'Thursday 14th April 2022 01:40:08 AM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL COMMENT 'Tên đăng nhập',
  `password` varchar(50) NOT NULL COMMENT 'Mật khẩu',
  `hoten` varchar(128) NOT NULL COMMENT 'Họ và tên',
  `email` varchar(128) DEFAULT NULL COMMENT 'Email cá nhân',
  `phone` int(16) UNSIGNED DEFAULT NULL COMMENT 'Số điện thoại',
  `avatar` varchar(512) DEFAULT NULL COMMENT 'Link ảnh đại diện',
  `role` varchar(10) NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `hoten`, `email`, `phone`, `avatar`, `role`, `updatedAt`) VALUES
(1, 'teacher1', '123456a@A', 'teacher1', 'teacher1@gmail.com', 123345, 'uploads/vip.jpg', 'teacher', '2022-04-13 18:13:26'),
(2, 'teacher2', '123456a@A', 'teacher2', 'teacher2@gmail.com', 19001800, '', 'teacher', '2022-04-13 09:32:01'),
(3, 'student1', '123456a@A', 'Vũ Thị Tâm', 'student1@gmail.com', 91821212, 'uploads/vip.jpg', 'student', '2022-04-13 18:35:01'),
(4, 'student2', '123456a@A', 'Nguyễn Hồng Anh', 'nha@gmail.com', 9871, '', 'student', '2022-04-13 10:39:23');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_teacher` (`teacherId`);

--
-- Chỉ mục cho bảng `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorid` (`teacherid`);

--
-- Chỉ mục cho bảng `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_fk_user_idsend` (`idsend`),
  ADD KEY `messages_fk_user_idrec` (`idrec`);

--
-- Chỉ mục cho bảng `submits`
--
ALTER TABLE `submits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignmentid` (`assignmentid`),
  ADD KEY `submits_ibfk_1` (`studentid`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_unique` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `submits`
--
ALTER TABLE `submits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`teacherId`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `challenges`
--
ALTER TABLE `challenges`
  ADD CONSTRAINT `challenges_ibfk_1` FOREIGN KEY (`teacherid`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_fk_user_idrec` FOREIGN KEY (`idrec`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_fk_user_idsend` FOREIGN KEY (`idsend`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `submits`
--
ALTER TABLE `submits`
  ADD CONSTRAINT `submits_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `submits_ibfk_2` FOREIGN KEY (`assignmentid`) REFERENCES `assignments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
