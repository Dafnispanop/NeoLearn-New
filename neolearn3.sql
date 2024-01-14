-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 14 Ιαν 2024 στις 20:47:41
-- Έκδοση διακομιστή: 10.4.32-MariaDB
-- Έκδοση PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `neolearn3`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `lessons`
--

INSERT INTO `lessons` (`id`, `teacher_id`, `name`, `course`) VALUES
(1, 11, 'Αντικειμενοστρεφής Προγραμματισμός', 'DAI124'),
(5, 11, 'Διαδικαστικός Προγραμματισμός', 'AIC130'),
(6, 11, 'Υπολογιστική Σκέψη και Λογισμικό', 'MLI0102'),
(7, 11, 'Τεχνητή Νοημοσύνη', 'PL0905'),
(8, 11, 'Θεωρία Παιγνίων', 'AIE806');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `pdfs`
--

CREATE TABLE `pdfs` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `week` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `pdfs`
--

INSERT INTO `pdfs` (`id`, `lesson_id`, `teacher_id`, `name`, `img`, `week`) VALUES
(10, 1, 11, 'Hello Programmers', 'Ειδικά Θέματα Προγρ 2324.pdf', 1),
(11, 1, 1, 'hello', 'Metas και HTML5.pdf', 4),
(12, 1, 1, 'Hello Programmers', 'Ειδικά Θέματα Προγρ 2324.pdf', 1),
(14, 1, 1, 'Hello Programmers', 'Ειδικά Θέματα Προγρ 2324.pdf', 1),
(24, 8, 2, 'second upload', 'Εργαλεία του Chrome για προγραμματιστές.pdf', 1),
(25, 8, 11, '', 'impatient-js-preview-book.pdf', 12),
(27, 8, 11, '', 'impatient-js-preview-book.pdf', 12),
(28, 8, 11, '', 'impatient-js-preview-book.pdf', 12);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `subscriptions`
--

CREATE TABLE `subscriptions` (
  `student_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `subscriptions`
--

INSERT INTO `subscriptions` (`student_id`, `lesson_id`) VALUES
(0, 8),
(12, 1),
(12, 5);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `verify_token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `role`, `verify_token`) VALUES
(1, 'xatzi@uom.edu.gr', '1234', 'xatzi', '0', ''),
(2, 'refanidis@uom.edu.gr', '1234', 'refanidis', '0', ''),
(5, 'koloniari@uom.edu.gr', '1234', 'koloniari', '0', ''),
(6, 'kmarg@uom.edu.gr', '1234', 'kmarg', '0', ''),
(11, 'dafnispanop@gmail.com', '$2y$10$WO2jGwr.2S3Zki/FSoEhJ.ClN3XW2sMBFtpDkNGROl.2cTaJwCwgO', 'dafni', 'teacher', '1a304d13eb5f71337980b12e156828d5'),
(12, 'ics20093@uom.edu.gr', '$2y$10$uK.Ewau1Hlz8SUOPaUUvQeP8oeE6AqTueMkyDMhUAFSYOFpV5IQhC', 'thomas', 'student', 'bacf094113a623212b541e8f93673d9f');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `lesson_id` int(10) UNSIGNED NOT NULL,
  `week` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `location` varchar(160) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `videos`
--

INSERT INTO `videos` (`id`, `lesson_id`, `week`, `name`, `location`) VALUES
(12, 1, 3, 'hello', 'https://www.youtube.com/watch?v=Dufg-UfP2II'),
(13, 1, 1, 'test', 'https://www.youtube.com/watch?v=Dufg-UfP2II'),
(14, 1, 1, 'another tes', 'https://www.youtube.com/watch?v=WmV7SoGjHxk'),
(18, 1, 2, 'test', 'https://www.youtube.com/watch?v=4P6biEHqgS8'),
(19, 8, 1, 'Blockchain', 'https://www.youtube.com/watch?v=KjvqfHyrJVQ');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lesson_has_teacher` (`teacher_id`);

--
-- Ευρετήρια για πίνακα `pdfs`
--
ALTER TABLE `pdfs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pdf_has_lesson` (`lesson_id`),
  ADD KEY `pdf_has_teacher` (`teacher_id`);

--
-- Ευρετήρια για πίνακα `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`student_id`,`lesson_id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT για πίνακα `pdfs`
--
ALTER TABLE `pdfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT για πίνακα `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lesson_has_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);

--
-- Περιορισμοί για πίνακα `pdfs`
--
ALTER TABLE `pdfs`
  ADD CONSTRAINT `pdf_has_lesson` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`),
  ADD CONSTRAINT `pdf_has_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
