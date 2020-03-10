create database analog;

use analog;

create table subject1(
	id int auto_increment,
	genre char(1) not null,
	category char(4) not null,
	question text not null,
	analyse text not null,
	rA nvarchar(120) default null,
	rB nvarchar(120) default null,
	rC nvarchar(120) default null,
	rD nvarchar(120) default null,
	answer char(1) default null,
	urlImg varchar(80) default null,
	urlVideo varchar(80) default null,
	primary key(id)
)engine=INNODB auto_increment=1 default charset=UTF8;

create table subject4(
	id int auto_increment,
	genre char(1) not null,
	category char(4) not null,
	question text not null,
	analyse text not null,
	rA nvarchar(120) default null,
	rB nvarchar(120) default null,
	rC nvarchar(120) default null,
	rD nvarchar(120) default null,
	answer char(1) default null,
	urlImg varchar(80) default null,
	urlVideo varchar(80) default null,
	primary key(id)
)engine=INNODB auto_increment=1 default charset=UTF8;

create table userinfo(
	userid int auto_increment,
	username varchar(30) not null,
	password varchar(24) not null,
	identification char(32) not null,
	email varchar(28) not null,
	orderNum1 int default 0,
	topScore1 int default 0,
	orderNum4 int default 0,
	topScore4 int default 0,
	primary key(userId)
)engine=INNODB auto_increment=2019000001 default charset=UTF8;

create table examinfo(
    examid int auto_increment,
    subject char(1) default null,
	userid int default null,
	score int default 0,
	examTime date default null,
	useTime date default null,
	tNum int default 0,
	fNum int default 0,
	itemids text default null
	primary key(examid)
)engine=INNODB auto_increment=1 default charset=UTF8;

create table itemInfo(
	totalSub1 int default 0,
	totalSub4 int default 0,
	cat1Sub1 int default 0,
	cat2Sub1 int default 0,
	cat3Sub1 int default 0,
	cat4Sub1 int default 0,
	cat5Sub1 int default 0,
	cat6Sub1 int default 0,
	cat7Sub1 int default 0,
	cat8Sub1 int default 0,
	cat9Sub1 int default 0,
	cat10Sub1 int default 0,
	cat1Sub4 int default 0,
	cat2Sub4 int default 0,
	cat3Sub4 int default 0,
	cat4Sub4 int default 0,
	cat5Sub4 int default 0,
	cat6Sub4 int default 0,
	cat7Sub4 int default 0,
	cat8Sub4 int default 0,
	cat9Sub4 int default 0,
	cat10Sub4 int default 0
)engine=INNODB default charset=UTF8;