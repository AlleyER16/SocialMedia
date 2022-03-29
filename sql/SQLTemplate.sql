CREATE TABLE users(
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    FullName VARCHAR(100) NOT NULL,
    Gender ENUM("Male", "Female") NOT NULL,
    DateOfBirth DATE NOT NULL,
    Telephone VARCHAR(20) UNIQUE NOT NULL,
    Username VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(100) NOT NULL,
    ProfilePicture VARCHAR(200) NULL,
    CoverPhoto VARCHAR(200) NULL,
    OnlineStatus Enum("0", "1") NOT NULL,
    Timestamp INT NOT NULL
)Engine=INNODB;

CREATE TABLE friends(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    User1 INT NOT NULL,
    User2 INT NOT NULL,
    Status ENUM("0", "1") NOT NULL,
    Timestamp INT NOT NULL,
    LastMessageTimestamp INT NULL,
    FOREIGN KEY (User1) REFERENCES users(UserID),
    FOREIGN KEY (User2) REFERENCES users(UserID)
)Engine=INNODB;

CREATE TABLE friendrequests(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    User INT NOT NULL,
    RequestedBy INT NOT NULL,
    Timestamp INT NOT NULL,
    FOREIGN KEY (User) REFERENCES users(UserID),
    FOREIGN KEY (RequestedBy) REFERENCES users(UserID),
    UNIQUE(User, RequestedBy)
)Engine=INNODB;

CREATE TABLE removed(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    User INT NOT NULL,
    UserRemoved INT NOT NULL,
    Timestamp INT NOT NULL,
    FOREIGN KEY (User) REFERENCES users(UserID),
    FOREIGN KEY (UserRemoved) REFERENCES users(UserID),
    UNIQUE(User, UserRemoved)
)Engine=INNODB;

CREATE TABLE posts(
    PostID INT PRIMARY KEY AUTO_INCREMENT,
    PostTitle VARCHAR(50)  NOT NULL,
    PostBody VARCHAR(1000) NOT NULL,
    MediaType ENUM("Image", "Video", "Audio") NULL,
    Media VARCHAR(100) NULL,
    Timestamp INT NOT NULL,
    CreatedBy INT NOT NULL,
    FOREIGN KEY (CreatedBy) REFERENCES users(UserID)
)Engine=INNODB;

CREATE TABLE postloves(
    Post INT NOT NULL,
    LovedBy INT NOT NULL,
    Timestamp INT NOT NULL,
    FOREIGN KEY (Post) REFERENCES posts(PostID),
    FOREIGN KEY (LovedBy) REFERENCES users(UserID),
    PRIMARY KEY (Post, LovedBy)
)Engine=INNODB;

CREATE TABLE postcomments(
    Post INT NOT NULL,
    CommentBy INT NOT NULL,
    Comment VARCHAR(200) NOT NULL,
    Timestamp INT NOT NULL,
    FOREIGN KEY (Post) REFERENCES posts(PostID),
    FOREIGN KEY (CommentBy) REFERENCES users(UserID),
    PRIMARY KEY (Post, CommentBy)
)Engine=INNODB;

CREATE TABLE chat(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    FriendID INT NOT NULL,
    MessageFrom INT NOT NULL,
    MessageTo INT NOT NULL,
    Message VARCHAR(500) NOT NULL,
    ReadStatus ENUM("0", "1") NOT NULL,
    Timestamp INT NOT NULL,
    FOREIGN KEY (FriendID) REFERENCES friends(ID),
    FOREIGN KEY (MessageFrom) REFERENCES users(UserID),
    FOREIGN KEY (MessageTo) REFERENCES users(UserID)
)Engine=INNODB;
