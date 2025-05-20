-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2016 at 09:43 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wisdom`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `sl_no` int(50) NOT NULL AUTO_INCREMENT,
  `blog_heading` varchar(250) NOT NULL,
  `blog_text` longtext NOT NULL,
  `image_name` varchar(250) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(100) NOT NULL,
  PRIMARY KEY (`sl_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`sl_no`, `blog_heading`, `blog_text`, `image_name`, `time_stamp`, `author`) VALUES
(6, 'Classroom Management', 'Hey everyone!  I hope you are having an awesome week so far, and today I thought it would be fun to talk about classroom management.  We talk about classroom management a lot, right? You know those years when you just have crazy kids in your classroom?  They''re awesome. All kids are awesome - we know that, but sometimes it takes a little bit more to get through to them that it''s not a big game, right? That you''re here to learn, you''re not helping others to learn when you''re acting crazy, and it really becomes a struggle sometimes.  Even if you have sometimes the best parent involvement, sometimes those kids just take a life of their own, that''s for sure.\r\n\r\nSomething that I have found that has worked in the past for me, I don''t know if it''ll work for you as every student and every classroom is different.  But if you''re at your wit''s end, you''re probably willing to try just about anything.  This was something that worked for one of my most challenging third grade students ever.\r\n\r\nI had a boy, we''ll just call him G, and G basically refused to do anything. G even fell asleep during, yes, the state standardized tests, but he was very, very bright and I knew that he was bright. He was just having trouble coming to grips with the fact that he was bright, I think.\r\n\r\nHe wasn''t sure how to react like that because he had always been the troublemaker, or the goofball, or the one who just didn''t listen.  He wanted a lot of attention, and not in a good way. I decided to give him some attention, but let''s do it in a good way so he realizes that he can be part of our classroom team.\r\n\r\nHe was part of the group, and every time that G did something awesome, I would say, "You know what? G did exactly what I wanted him to. Let''s give him a round of applause," and everybody would, "Yay, yay for G," and they got to the point where the other students were really cheering him on.  They wanted him to succeed as much as I wanted him to succeed.\r\nSuddenly, he realized, "Maybe it''s a good thing if I''m staying on task, if I''m doing what I need to be doing," and it came down to some basic peer pressure.  If we were in the hallway walking and G decided just to do his own thing or talking, whatever, you know how that goes, and the other students got to the point where they said, "Hey G, come on. You can do this. I know that you can stand in line here quietly, let''s get down this hall."   My class knew if they were talking whenever we were headed to a special, then guess what? We turned around and we walked back to our classroom and we turned around until we got ready again, and then we would walk back. Sometimes it would take 4 and 5 times if G was just acting silly. He just really wanted that attention, and he wanted to know he was in control, so guess what? We went back and started it over again.\r\n\r\nAfter a couple of times the students really wanted to get their special. They enjoy specials, so they would say, "G, quit, let''s do this. You can do this," and so they were his biggest cheerleaders, even more than I was, and that made a huge difference in G''s behavior.\r\n\r\nI really, really found that it was super effective, something I had never considered trying before, and maybe it won''t work for all of your students. Maybe it''ll work for 1 of your students.  Maybe it won''t work at all.  And to be perfectly honest, sometimes it didn''t work for G on certain days he just felt like doing his own thing.  But once I started it, it worked more than it didn''t.\r\n\r\nGood luck. I would love to hear how this strategy is, or maybe isn''t, working for you and your students.  Leave us a comment below to share!', 'classroom_management', '2016-12-02 21:18:36', 'Shamseer'),
(7, 'Positively Push for Good Behavior', 'The end of the year is quickly approaching! I am super excited, aren''t you? Well, so are the students, and their behavior is showing their excitement. The children are full of energy and struggling to sit still. Some teachers are pulling their hair out trying to keep structure in their classrooms. Anyone else noticing this? With 18 more days of school left here, we have to tighten up the reigns on behavior, and find a way to stay positive. My job as an inclusion special education teacher turns into a behavior therapist around this time of every school year, so I wanted to share some ideas that can be implemented to help throughout the end of the year.\r\n\r\n1. Fidgets - Give children an "approved" way to get their movement out. I don''t enjoy listening to tapping on the desk, but I am fine with them squeezing a stress ball or rubbing a Velcro strip on their desk. What can you handle?\r\n\r\n2. Praise, Praise, Praise - This becomes more and more difficult to do, but you will feel better if you focus on the positive and praise those that are doing correct. Try to praise 4 kids for every 1 that you have to redirect.\r\n\r\n3. Brain Breaks - Build in times to your schedule to allow children to get up and move. There are a lot of fun songs and dances online that can be done quickly in the classroom. The Just Dance ones on YouTube are my favorites.\r\n\r\n4. Celebrate - Have a class reward ceremony to celebrate the great things about your students. Many times we get caught up in rewarding just for academics and attendance, but I challenge you to find a reward for every child in your classroom. The students can even vote on peers for different rewards. Who has the best sense of humor? Who is in the most inquisitive? Roll out the red carpet (butcher paper works great!) and celebrate!\r\n\r\n5. Frequent Positive Reinforcement - Many children need more frequent positive reinforcement during this time of year. The end of the week Fun Friday use to be enough for some, but it may not be frequent enough now. Try to come up with ways to reinforce students even more frequently to keep them focused on the goals all the way to the end of the year.\r\n\r\nI could easily add more ideas, but these are my top 5. Focusing on these 5 have been very successful for me in getting through the final weeks in the past. It is definitely not an easy task, but it is something we must do. Don''t just fall into “survival mode”! Make the most of the rest of the school year, and you can have the best class all the way to the end. Have fun and good luck!\r\n\r\nHeather Salsman is a Special Education Inclusion Teacher from Indiana. She blogs at Teaching Through Turbulence about behavior management and differentiation.', 'positively_push', '2016-12-02 21:18:36', 'Prilna'),
(8, 'Managing the Extremely Challenging Student', 'All teachers have had or will have an experience with an extremely challenging student. No matter the reason why, it can make for a very challenging year. The year it happened to me, I was extremely stressed. I had several students who were giving me a run for my money anyway and was on my own with no teacher''s aide. I had some self-help strategies for myself but now, (of course hindsight is 20-20, right?) looking back, I realize which ones really helped me, and what I should have tried but didn''t.\r\n\r\nOf course, you will dedicate all you can to the helping your student but also you need to help yourself! First and foremost, seek all the assistance you can get at your school. Start with school resources like the IEP team if the student is already on an IEP. If not, do an immediate referral to the "Student Success Team" (or your school''s version of this). Get the guidance counselor involved and communicate with her on a regular basis. Do the same with your principal. The principal may be busy, but if this is an extremely problematic situation, keep her informed and let her know what kind of help and how much support you need.\r\n\r\nTake any help that peers offer you. I had several wonderful colleagues offer to do so. In the past I may have said, "That''s so sweet, but we''re okay," but that year, I took them all up on it. A first grade teacher gave me suggestions and materials, and invited me to send the student to visit her often. A specialist teacher offered to allow my student to come down daily to look through her books and borrow them. I resisted at first, but soon realized how helpful it was and she soon had daily visits from my buddy. Unless the suggestion is completely unusable, try it! If it helps you, it''s worth it. The less overwhelmed you are the better.\r\n\r\nAs a teacher, you always need to be flexible but if you have an extremely challenging situation, give yourself permission to be extra flexible. For example, you may need to start a math lesson late to address issues that arise. When your student is out of the room, you may need to skip handwriting in order to help your other students understand what is going on and answer any questions. My principal was supportive and understood that if it was a difficult week, I might not finish every single language arts lesson at the expected time or give a math quiz the same day as other teachers.\r\n\r\nRemind yourself that your student is not having these problems and causing stress intentionally. He or she may be dealing with an issue that they can''t solve themselves. I think in my situation I did try and remember this, but at times I could have done more. It will help keep your relationship with him or her healthy. Communicating this with your students could also help them deal with the challenges.\r\n\r\nAs women, teachers, and mothers, we are always taking care of others and we are always hearing that you need to do nice things for yourself. After a long, stressful day, I know I often just want to watch TV and go to sleep (for some, that''s not even an option!). That year was kind of a blur, but I know I tried occasionally to do nice things for myself outside of work. For example. I started getting those terrific shellac manicures once in a while. I made sure to occasionally meet up with girlfriends, some of whom were teachers, to go out to dinner or get a margarita, and to commiserate and support each other.\r\n\r\nFinally, something I remember from the end of the year is that I was feeling guilty and somewhat disappointed at the achievement test scores of my class, especially in math. I recall talking to the math specialist and feeling on the verge of tears. In retrospect I was being much too hard on myself! I realized the students who needed help had been getting help. I had brought them all up to the Student Success Team, they were being supported, and basically I needed to take some deep breaths and relax a bit. The message is don''t be hard on yourself.\r\n\r\nWe work so hard as teachers and we are under a lot of stress. Sometimes it is easy to forget to take care of our own needs. During those tough times, perhaps some of these things that helped me will help you, too. I''d love to hear any suggestions you have to, so please comment and let me know!', 'managing_the', '2016-12-02 21:28:46', 'Vipin');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `Sl_no` int(50) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Message` text NOT NULL,
  `Time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Sl_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`Sl_no`, `Name`, `Email`, `Message`, `Time_stamp`) VALUES
(1, 'sgdghdgh', 'dafsgh@sgdsdhl.com', 'ddsgdhgh', '2016-12-01 02:17:56'),
(2, 'ddfhb', 'ssdgd@gdfh.com', 'dgdfgshdjdhs', '2016-12-01 02:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `sl_no` int(100) NOT NULL AUTO_INCREMENT,
  `heading` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sl_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`sl_no`, `heading`, `text`, `time_stamp`) VALUES
(1, 'Workshop registration', 'If you missed the deadline and were not able to put in a proposal together in time for the Consortium for Language Teaching workshop CFP, but would still like to apply, the Consortium for Language Teaching and Learning has extended the deadline for the Call for Consortium Workshop Proposals. The new deadline is December 30th.', '2016-11-30 15:47:05'),
(2, 'Language Session', 'The Center for Language Education and Research, in collaboration with Langerba Center, invites you to take advantage of our summer professional development workshops in August. CLEAR has been offering workshops since 1997, and teachers from all over the country have come to Michigan State University''s.', '2016-11-30 15:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `sl_no` int(100) NOT NULL AUTO_INCREMENT,
  `heading` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sl_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`sl_no`, `heading`, `text`, `time_stamp`) VALUES
(1, 'New Student Orientation', 'New Student Orientation will introduce new undergraduate students to the wide array of academic experiences available at College. You will also have time to settle into your room and prepare for classes. Please communicate the same to all students in your group. The process will end by December.', '2016-11-30 15:49:04'),
(2, 'Vocal Competition', 'Six Wisdom College music students successfully competed at Singing 2016 auditions, advancing to semifinal and final rounds of competition. Students of our college competed in auditions against students from Auburn University, Florida State University, Georgia Southern University, and others.', '2016-11-30 15:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `sl_no` int(100) NOT NULL AUTO_INCREMENT,
  `heading` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sl_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`sl_no`, `heading`, `text`, `time_stamp`) VALUES
(1, 'Low cost afternoon courses!', 'Wisdom is bringing back the low-cost afternoon-only program of 8 hours a week for only 700.00! You can join General English program or study for IELTS - perfect for people looking to improve their English for work opportunities or academic purposes. Contact us to book a course while there are still places available!.', '2016-11-30 15:42:24'),
(2, 'Volleyball challenge', 'The Wisdom institute athletics Department will once again include an inter center women''s volleyball program. To celebrate this event, our students and their families are invited to opening of Wisdom invitational, including a conference with sports workshops in the date mentioned below.', '2016-11-30 15:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Full_name` varchar(100) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Access_level` varchar(100) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Username`, `Password`, `Full_name`, `Timestamp`, `Access_level`) VALUES
('Admin', '123', 'Administrator', '2016-11-30 15:56:00', 'Administrator'),
('Bijin', '123', 'Bijin Kumar P', '2016-12-03 07:28:28', ''),
('Jeemon', '123', 'Jeemon Puthusseri', '2016-12-03 07:27:45', ''),
('Prilna', '123', 'Prilna PV', '2016-12-03 07:27:12', ''),
('Shamseer', '123', 'Shamseer CH', '2016-12-03 07:27:12', ''),
('Suraj', '123', 'Suraj KV', '2016-12-03 07:28:28', ''),
('Vipin', '123', 'Vipin PV', '2016-12-03 07:27:45', '');
