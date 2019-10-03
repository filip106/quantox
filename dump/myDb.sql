SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `school_board` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `students` (`name`, `school_board`) VALUES
('William', 'CSM'),
('Marc', 'CSM'),
('John', 'CSMB');

CREATE TABLE `student_grades` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `student_id` INT NOT NULL,
 `grade` INT NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO `student_grades` (`student_id`, `grade`) VALUES
(1, 10),
(1, 1),
(2, 6),
(2, 3),
(3, 3),
(3, 3);
