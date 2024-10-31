USE PROJECT_PTH;
CREATE TABLE PhongThucHanh_CauHinhMayTinh (
	MaPhong INT PRIMARY KEY,
    TenPhong VARCHAR(100),
    SoLuongMay INT,
    CPU VARCHAR(100),
    RAM VARCHAR(100),
    BoNho VARCHAR(100),
    OS VARCHAR(100),
    ThongTin VARCHAR(255)
);
CREATE TABLE PhanMem (
    MaPhanMem VARCHAR(50) PRIMARY KEY,
    TenPhanMem VARCHAR(100)
);

CREATE TABLE hp_pm (
    MaHocPhan varchar(10),
    TenHocPhan VARCHAR(255),
    MaPhanMem VARCHAR(50),
    TenPhanMem VARCHAR(100),
    PRIMARY KEY (MaHocPhan, MaPhanMem), -- Composite primary key
    FOREIGN KEY (MaHocPhan) REFERENCES HocPhan(MaHocPhan),
    FOREIGN KEY (MaPhanMem) REFERENCES PhanMem(MaPhanMem)
);

CREATE TABLE HocPhan (
    MaHocPhan varchar(10) primary KEY ,
    TenHocPhan VARCHAR(255)
);

CREATE TABLE HocKy(
		MaHocKy char(5) PRIMARY KEY,
        TenHocKy varchar(255) 
);
select * from hocky;
INSERT INTO HocKy VALUES 
	('S1','Học Kỳ 1'),
    ('S2','Học Kỳ 2'),
    ('SH','Học Kỳ Hè');

CREATE TABLE GiangVien(
		STT INT PRIMARY KEY,
		MaGiangVien char(10) ,
        TenGiangVien varchar(255)
);
DROP TABLE GiangVien;

create table NhomHoc(
	MaNhom Char(10) primary Key,
    TenNhom VarChar(10)
);

insert into NhomHoc value
	('1','M01'),
    ('2','M02'),
    ('3','M03'),
    ('4','M04');
    
CREATE TABLE NhomHocPhan(
		MaNhom char(10) PRIMARY KEY,
		MaHocPhan char(10),
		FOREIGN KEY(MaHocPhan) REFERENCES HocPhan(MaHocPhan),
		MaHocKy char(5),
		TenGiangVien Varchar(255),
		FOREIGN KEY(MaHocKy) REFERENCES HocKy(MaHocKy)
);

CREATE TABLE LichThucHanh (
    MaLichThucHanh INT PRIMARY KEY,
    MaNhom char(10),
    ThoiGianBatDau DATETIME,
    ThoiGianKetThuc datetime,
    DiaDiem VARCHAR(255),
    TenGiangVien varchar(255),
    FOREIGN KEY (MaNhom) REFERENCES NhomHoc(MaNhom)
);
