-- mysql dump 10.13  distrib 5.6.14, for osx10.7 (x86_64)
--
-- host: localhost    database: musiclib
-- ------------------------------------------------------
-- server version 5.6.14

/*!40101 set @old_character_set_client=@@character_set_client */;
/*!40101 set @old_character_set_results=@@character_set_results */;
/*!40101 set @old_collation_connection=@@collation_connection */;
/*!40101 set names utf8 */;
/*!40103 set @old_time_zone=@@time_zone */;
/*!40103 set time_zone='+00:00' */;
/*!40014 set @old_unique_checks=@@unique_checks, unique_checks=0 */;
/*!40014 set @old_foreign_key_checks=@@foreign_key_checks, foreign_key_checks=0 */;
/*!40101 set @old_sql_mode=@@sql_mode, sql_mode='no_auto_value_on_zero' */;
/*!40111 set @old_sql_notes=@@sql_notes, sql_notes=0 */;

--
-- table structure for table `album`
--

drop table if exists `album`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `album` (
  `id` bigint(20) not null auto_increment,
  `name` varchar(64) not null,
  `disc` int(2) unsigned not null,
  `releaseDate` bigint(20) not null,
  `artwork` varchar(128) not null,
  `uploadDate` bigint(20) not null,
  `uploadUser` bigint(20) not null,
  `type` int(11) not null,
  primary key (`id`)
) engine=innodb auto_increment=2 default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `albumtype`
--

drop table if exists `albumType`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `albumType` (
  `id` int(11) not null auto_increment,
  `label` varchar(32) not null,
  `description` varchar(256) not null,
  primary key (`id`)
) engine=innodb auto_increment=10 default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `artist`
--

drop table if exists `artist`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `artist` (
  `id` bigint(20) not null auto_increment,
  `name` varchar(128) not null,
  `biography` text not null,
  `uploadDate` bigint(20) not null,
  `uploadUser` bigint(20) not null,
  `picture` varchar(128) not null,
  primary key (`id`)
) engine=innodb auto_increment=2 default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `belong`
--

drop table if exists `belong`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `belong` (
  `song` bigint(20) not null,
  `genre` int(11) not null,
  key `song` (`song`),
  key `genre` (`genre`)
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `cause`
--

drop table if exists `cause`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `cause` (
  `id` int(11) not null auto_increment,
  `cause` varchar(128) not null,
  primary key (`id`)
) engine=innodb auto_increment=7 default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `comment`
--

drop table if exists `comment`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `comment` (
  `user` bigint(20) not null,
  `song` bigint(20) not null,
  `text` varchar(256) not null,
  `date` bigint(20) not null
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `compose`
--

drop table if exists `compose`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `compose` (
  `artist` bigint(20) not null,
  `song` bigint(20) not null
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `connection`
--

drop table if exists `connection`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `connection` (
  `id` bigint(20) not null auto_increment,
  `user` bigint(20) not null,
  `ip` varchar(16) not null,
  `date` bigint(20) not null,
  primary key (`id`)
) engine=innodb auto_increment=7 default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `genre`
--

drop table if exists `genre`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `genre` (
  `id` int(11) not null auto_increment,
  `label` varchar(64) not null,
  primary key (`id`)
) engine=innodb auto_increment=21 default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `gradecomment`
--

drop table if exists `gradecomment`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `gradecomment` (
  `user` bigint(20) not null,
  `comment` bigint(20) not null,
  `agreement` tinyint(1) not null
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `include`
--

drop table if exists `include`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `include` (
  `album` bigint(20) not null,
  `song` bigint(20) not null,
  `track` int(10) unsigned not null
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `know`
--

drop table if exists `know`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `know` (
  `user` bigint(20) not null,
  `song` bigint(20) not null,
  `owned` tinyint(1) not null
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `notarizealbum`
--

drop table if exists `notarizealbum`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `notarizealbum` (
  `user` bigint(20) not null,
  `album` bigint(20) not null,
  `agreement` tinyint(1) not null,
  `cause` int(11) not null
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `notarizeartist`
--

drop table if exists `notarizeartist`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `notarizeartist` (
  `user` bigint(20) not null,
  `artist` bigint(20) not null,
  `agreement` tinyint(1) not null,
  `cause` int(11) not null
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `perform`
--

drop table if exists `perform`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `perform` (
  `artist` bigint(20) not null,
  `song` bigint(20) not null
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `rate`
--

drop table if exists `rate`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `rate` (
  `user` bigint(20) not null,
  `song` bigint(20) not null,
  `grade` tinyint(3) unsigned not null comment 'between 0 and 10',
  `date` bigint(20) not null
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `release`
--

drop table if exists `release`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `release` (
  `artist` bigint(20) not null,
  `album` bigint(20) not null
) engine=innodb default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `song`
--

drop table if exists `song`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `song` (
  `id` bigint(20) not null auto_increment,
  `title` varchar(128) not null,
  `duration` int(10) unsigned not null comment 'seconds',
  `lyrics` text not null,
  primary key (`id`)
) engine=innodb auto_increment=14 default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;

--
-- table structure for table `user`
--

drop table if exists `user`;
/*!40101 set @saved_cs_client     = @@character_set_client */;
/*!40101 set character_set_client = utf8 */;
create table `user` (
  `id` bigint(20) not null auto_increment,
  `username` varchar(32) not null,
  `email` varchar(256) not null,
  `password` text not null,
  `publicEmail` tinyint(1) not null default '0',
  `picture` varchar(64) not null default '',
  `active` tinyint(1) not null default '0',
  primary key (`id`)
) engine=innodb auto_increment=7849 default charset=latin1;
/*!40101 set character_set_client = @saved_cs_client */;
/*!40103 set time_zone=@old_time_zone */;

/*!40101 set sql_mode=@old_sql_mode */;
/*!40014 set foreign_key_checks=@old_foreign_key_checks */;
/*!40014 set unique_checks=@old_unique_checks */;
/*!40101 set character_set_client=@old_character_set_client */;
/*!40101 set character_set_results=@old_character_set_results */;
/*!40101 set collation_connection=@old_collation_connection */;
/*!40111 set sql_notes=@old_sql_notes */;

-- dump completed on 2013-12-02 18:11:50
