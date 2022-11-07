CREATE TABLE accounts (
    email varchar(255) NOT NULL,
    PASSWORD varchar(255) NOT NULL,
    PRIMARY KEY (email)
);

GO
    CREATE TABLE imgs (
        name varchar(255) NOT NULL,
        path varchar(255) NOT NULL,
        PRIMARY KEY (name)
    );

GO
    CREATE TABLE OWNERS (
        account_email varchar(255) NOT NULL,
        img_name varchar(255) NOT NULL,
        PRIMARY KEY (account_email, img_name)
    );

ALTER TABLE
    OWNERS
ADD
    CONSTRAINT FK_OWNERS_ACC FOREIGN KEY (account_email) REFERENCES accounts(email),
    CONSTRAINT FK_OWNERS_IMG FOREIGN KEY (img_name) REFERENCES imgs(name);

INSERT INTO
    accounts (email, PASSWORD)
VALUES
    ('caohonag@gmail.com', '1111111A'),
    ('caonhatduc1@gmail.com', '1111111A');

INSERT INTO
    imgs (name, path)
VALUES
    (
        'img1',
        'C:\Users\caoho\OneDrive\Desktop\img1.jpg'
    ),
    (
        'img2',
        'C:\Users\caoho\OneDrive\Desktop\img2.jpg'
    );

INSERT INTO
    OWNERS (account_email, img_name)
VALUES
    ('caohonag@gmail.com', 'img1'),
    ('caohonag@gmail.com', 'img2');

SELECT
    path
FROM
    accounts acc,
    imgs,
    owners
WHERE
    acc.email = owners.account_email
    AND owners.img_name = imgs.name;