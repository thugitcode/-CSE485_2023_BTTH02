--a 
SELECT * FROM baiviet
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
WHERE theloai.ten_tloai = "Nhạc trữ tình";

--b
SELECT * FROM baiviet
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
WHERE tacgia.ten_tgia = "Nhacvietplus";

--c
SELECT * FROM theloai 
JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai
WHERE baiviet.ma_bviet IS NULL;

--d
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, tacgia.ten_tgia, theloai.ten_tloai, baiviet.ngayviet
FROM baiviet
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
JOIN theloai ON theloai.ma_tloai = baiviet.ma_tloai;

--e

SELECT theloai.ma_tloai,theloai.ten_tloai, COUNT(baiviet.ma_bviet) AS soluong
FROM theloai
JOIN baiviet ON baiviet.ma_tloai = theloai.ma_tloai
GROUP BY theloai.ma_tloai, theloai.ten_tloai
ORDER BY soluong DESC;

--f
SELECT tacgia.ma_tgia, tacgia.ten_tgia, COUNT(baiviet.ma_bviet) 
AS soluong FROM tacgia
JOIN baiviet ON baiviet.ma_tgia = tacgia.ma_tgia
GROUP BY tacgia.ma_tgia, tacgia.ten_tgia
ORDER BY soluong DESC LIMIT 2

--g
SELECT * FROM baiviet
WHERE baiviet.ten_bhat 
LIKE '%yêu%' OR baiviet.ten_bhat 
LIKE '%thương%' OR baiviet.ten_bhat 
LIKE '%anh%' OR baiviet.ten_bhat LIKE '%em%';

--h
SELECT * FROM baiviet
WHERE ten_bhat LIKE '%yêu%' OR ten_bhat LIKE '%thương%' OR
ten_bhat LIKE '%anh%' OR ten_bhat LIKE '%em%'
OR tieude LIKE '%yêu%' OR tieude LIKE '%thương%' OR
tieude LIKE '%anh%' OR tieude LIKE '%em%';

--i
CREATE VIEW vw_Music AS
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, theloai.ten_tloai, tacgia.ten_tgia FROM baiviet
JOIN tacgia ON tacgia.ma_tgia = baiviet.ma_tgia
JOIN theloai ON theloai.ma_tloai = baiviet.ma_tloai;

--j
DELIMITER //

CREATE PROCEDURE sp_DSBaiViet(IN TenTheLoai VARCHAR(100))
BEGIN
    DECLARE dem INT;

    SELECT COUNT(*) INTO dem FROM theloai WHERE ten_tloai = TenTheLoai;

    IF dem > 0 THEN
        SELECT bv.ma_bviet, bv.tieude, bv.ten_bhat, tl.ten_tloai, tg.ten_tgia
        FROM baiviet bv
        JOIN theloai tl ON bv.ma_tloai = tl.ma_tloai
        JOIN tacgia tg ON bv.ma_tgia = tg.ma_tgia
        WHERE tl.ten_tloai = TenTheLoai;
    ELSE
        SELECT 'Thể loại không tồn tại.' AS message;
    END IF;
END //

DELIMITER ;

--k
ALTER TABLE theloai
ADD COLUMN SLBaiViet INT DEFAULT 0;

DELIMITER //

CREATE TRIGGER tg_CapNhatTheLoai AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END;
//

CREATE TRIGGER tg_CapNhatTheLoai_AfterUpdate AFTER UPDATE ON baiviet
FOR EACH ROW
BEGIN
    IF OLD.ma_tloai <> NEW.ma_tloai THEN
        UPDATE theloai
        SET SLBaiViet = SLBaiViet - 1
        WHERE ma_tloai = OLD.ma_tloai;

        UPDATE theloai
        SET SLBaiViet = SLBaiViet + 1
        WHERE ma_tloai = NEW.ma_tloai;
    END IF;
END;
//

CREATE TRIGGER tg_CapNhatTheLoai_Delete AFTER DELETE ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai
    SET SLBaiViet = SLBaiViet - 1
    WHERE ma_tloai = OLD.ma_tloai;
END;
//

DELIMITER ;

--l
CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Role ENUM('admin', 'user') DEFAULT 'user'
);
