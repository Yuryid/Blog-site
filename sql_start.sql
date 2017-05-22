CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(10) NOT NULL AUTO_INCREMENT UNIQUE,
    `name` VARCHAR(50) NOT NULL UNIQUE,
    `pass` VARCHAR(32) NOT NULL,
    `datastamp` DATETIME,
    `admin` TINYINT(1),
    PRIMARY KEY (`id`),
    INDEX(`name`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `articles` (
    `id` INT(10) NOT NULL AUTO_INCREMENT UNIQUE,
    `title` VARCHAR(255),
    `shortdesc` TEXT,
    `text` TEXT,
    `datastamp` DATETIME,
    `user_id` INT(10),
    `allow_comments` TINYINT(1), 
    PRIMARY KEY (`id`),
    INDEX(`datastamp`),
    INDEX(`user_id`),
    FOREIGN KEY (`user_id`)
    REFERENCES users(`id`)
    ON UPDATE CASCADE ON DELETE SET NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `comments` (
    `id` INT(10) NOT NULL AUTO_INCREMENT UNIQUE,
    `text` TEXT,
    `datastamp` DATETIME,
    `rate` INT,
    `user_id` INT(10),
    `art_id` INT(10),
    PRIMARY KEY (`id`),
    INDEX(`datastamp`),
    INDEX(`user_id`),
    INDEX(`art_id`),
    FOREIGN KEY (`user_id`)
    REFERENCES users(`id`)
    ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (`art_id`)
    REFERENCES articles(`id`)
    ON UPDATE CASCADE ON DELETE SET NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO users(id, name, pass, datastamp, admin ) VALUES(NULL, 'admin', '202cb962ac59075b964b07152d234b70', '2017-05-13 21:04:46', 1);-- pass 123
INSERT INTO users(id, name, pass, datastamp, admin ) VALUES(NULL, 'user', '827ccb0eea8a706c4c34a16891f84e7b', '2017-05-15 00:02:17', 0);-- pass 12345
INSERT INTO articles(id, title, shortdesc, text, datastamp, user_id, allow_comments)
 VALUES(NULL, 'Title 1', 'Sample description 1', 'Sample text 1', '2017-05-13 21:04:46', 1, 1);
INSERT INTO articles(id, title, shortdesc, text, datastamp, user_id, allow_comments)
 VALUES(NULL, 'Title 2', 'Sample description 2', 'Sample text 2', '2017-05-13 21:05:46', 1, 1);
INSERT INTO articles(id, title, shortdesc, text, datastamp, user_id, allow_comments)
 VALUES(NULL, 'Title 3', 'Sample description 3', 'Sample text 3', '2017-05-13 21:06:46', 1, 0);
INSERT INTO comments(id, text, datastamp, rate, user_id, art_id) 
VALUES(NULL, 'Comment example1. awesome article!','2017-05-13 21:07:46',0,2,2);
INSERT INTO comments(id, text, datastamp, rate, user_id, art_id) 
VALUES(NULL, 'Comment example2. good article!','2017-05-14 21:07:46',0,1,2);
INSERT INTO comments(id, text, datastamp, rate, user_id, art_id) 
VALUES(NULL, 'Comment example3. bad article!','2017-05-15 21:07:46',0,2,1);
