-- ====== HÀM TẠO BIỂN SỐ ======
DROP FUNCTION IF EXISTS random_plate;
DELIMITER $$
CREATE FUNCTION random_plate() RETURNS VARCHAR(20)
DETERMINISTIC
BEGIN
  DECLARE plate VARCHAR(20);
  DECLARE num1 INT; DECLARE num2 INT; DECLARE num3 INT;
  DECLARE letter1 CHAR(1); DECLARE letter2 CHAR(1);
  DECLARE city_code VARCHAR(5);
  SET city_code = ELT(FLOOR(RAND()*11)+1,'51','52','59','60','61','29','30','31','32','43','50');
  SET letter1 = ELT(FLOOR(RAND()*21)+1,'A','B','C','D','E','F','G','H','K','L','M','N','P','R','S','T','U','V','X','Y','Z');
  SET letter2 = ELT(FLOOR(RAND()*21)+1,'A','B','C','D','E','F','G','H','K','L','M','N','P','R','S','T','U','V','X','Y','Z');
  SET num1 = FLOOR(RAND()*10);
  SET num2 = FLOOR(RAND()*900)+100;
  SET num3 = FLOOR(RAND()*90)+10;
  SET plate = CONCAT(city_code, letter1, num1, '-', num2, '.', num3);
  RETURN plate;
END$$
DELIMITER ;

-- ====== PROCEDURE TẠO DỮ LIỆU ======
DROP PROCEDURE IF EXISTS generate_parking_data;
DELIMITER $$
CREATE PROCEDURE generate_parking_data()
BEGIN
  DECLARE curr_date DATE DEFAULT '2025-01-01';
  DECLARE end_date  DATE DEFAULT '2025-08-21';
  DECLARE day_counter INT DEFAULT 1;

  DECLARE j INT;
  DECLARE daily_sessions INT;
  DECLARE session_id INT;
  DECLARE plate_number VARCHAR(20);
  DECLARE parking_spot VARCHAR(10);
  DECLARE policy_id VARCHAR(20);
  DECLARE entry_gate VARCHAR(10);
  DECLARE exit_gate VARCHAR(10);
  DECLARE entry_time DATETIME;
  DECLARE exit_time DATETIME;
  DECLARE parking_minutes INT;
  DECLARE fee DECIMAL(12,2);
  DECLARE discount DECIMAL(12,2);
  DECLARE payment_method VARCHAR(20);
  DECLARE entry_hour INT;
  DECLARE rnd FLOAT;
  DECLARE table_name VARCHAR(64);
  DECLARE date_suffix VARCHAR(16);

  WHILE curr_date <= end_date DO
    SET date_suffix = DATE_FORMAT(curr_date,'%d%m%Y');

    IF curr_date <> CURDATE() THEN
      SET table_name = CONCAT('pm_nc0009_', date_suffix);
      SET @sql := CONCAT('CREATE TABLE IF NOT EXISTS ', table_name, ' LIKE pm_nc0009');
      PREPARE s FROM @sql; EXECUTE s; DEALLOCATE PREPARE s;
      SET @sql := CONCAT('DELETE FROM ', table_name);
      PREPARE s FROM @sql; EXECUTE s; DEALLOCATE PREPARE s;
    ELSE
      SET table_name = 'pm_nc0009';
    END IF;

    SET daily_sessions = FLOOR(RAND()*101)+50;  -- 50..150
    SET j = 1;
    WHILE j <= daily_sessions DO
      -- Generate unique session_id within INT range: day_counter * 1000 + session_within_day
      SET session_id = day_counter * 1000 + j;
      SET plate_number = random_plate();

      SET rnd = RAND();
      IF rnd < 0.6 THEN SET policy_id = 'CS_XEMAY_4H';
      ELSEIF rnd < 0.85 THEN SET policy_id = 'CS_OTO_4H';
      ELSEIF rnd < 0.95 THEN SET policy_id = 'CS_XE_69CHO_1N';
      ELSE SET policy_id = 'CS_OT_7N';
      END IF;

      SET parking_spot = CONCAT('A', LPAD(FLOOR(RAND()*100)+1,3,'0'));
      SET entry_gate = CONCAT('GATE_', FLOOR(RAND()*4)+1);
      SET exit_gate  = entry_gate;

      SET entry_hour = FLOOR(RAND()*16)+6; -- 06..22h
      SET entry_time = TIMESTAMP(curr_date, SEC_TO_TIME(entry_hour*3600 + FLOOR(RAND()*3600)));
      SET parking_minutes = FLOOR(RAND()*465)+15; -- 15'..8h
      SET exit_time = DATE_ADD(entry_time, INTERVAL parking_minutes MINUTE);

      CASE policy_id
        WHEN 'CS_XEMAY_4H' THEN
          IF parking_minutes <= 240 THEN SET fee = 5000;
          ELSE SET fee = 5000 + CEIL((parking_minutes-240)/60)*5000; END IF;
        WHEN 'CS_OTO_4H' THEN
          IF parking_minutes <= 240 THEN SET fee = 15000;
          ELSE SET fee = 15000 + CEIL((parking_minutes-240)/60)*5000; END IF;
        WHEN 'CS_XE_69CHO_1N' THEN
          SET fee = CEIL(parking_minutes/120)*30;
        WHEN 'CS_OT_7N' THEN
          IF parking_minutes <= 240 THEN SET fee = 5000;
          ELSE SET fee = 5000 + CEIL((parking_minutes-240)/60)*2000; END IF;
        ELSE SET fee = 10000;
      END CASE;

      IF RAND() < 0.1 THEN
        SET discount = FLOOR(fee * (RAND()*0.3 + 0.1)); -- 10-40%
      ELSE
        SET discount = 0;
      END IF;

      SET rnd = RAND();
      IF rnd < 0.7 THEN SET payment_method = 'TIEN_MAT';
      ELSEIF rnd < 0.85 THEN SET payment_method = 'QR_CODE';
      ELSEIF rnd < 0.95 THEN SET payment_method = 'THE';
      ELSE SET payment_method = 'CHUYEN_KHOAN';
      END IF;

      SET @sql := CONCAT(
        'INSERT INTO ', table_name, ' (',
          'lv001, lv002, lv003, lv004, lv005, lv006, lv007, ',
          'lv008, lv009, lv010, lv011, lv012, lv013, lv014, ',
          'lv015, lv016, mienGiam, phuongThucTT, congVao, congRa',
        ') VALUES (',
          session_id, ", 'RFID_", LPAD(j,8,'0'), "', '", plate_number, "', ",
          "'", parking_spot, "', '", policy_id, "', '", entry_gate, "', '", exit_gate, "', ",
          "'", DATE_FORMAT(entry_time,'%Y-%m-%d %H:%i:%s'), "', ",
          "'", DATE_FORMAT(exit_time, '%Y-%m-%d %H:%i:%s'), "', ",
          parking_minutes, ", ",
          "'entry_", j, ".jpg', 'exit_", j, ".jpg', ",
          (fee - discount), ", 'DA_RA', ",
          "'face_entry_", j, ".jpg', 'face_exit_", j, ".jpg', ",
          discount, ", '", payment_method, "', '", entry_gate, "', '", exit_gate, "'",
        ')'
      );
      PREPARE s FROM @sql; EXECUTE s; DEALLOCATE PREPARE s;

      SET j = j + 1;
    END WHILE;

    SET curr_date = DATE_ADD(curr_date, INTERVAL 1 DAY);
    SET day_counter = day_counter + 1;
  END WHILE;
END$$
DELIMITER ;

-- chạy
CALL generate_parking_data();

-- dọn (tùy chọn)
DROP PROCEDURE IF EXISTS generate_parking_data;
-- DROP FUNCTION IF EXISTS random_plate;

-- kiểm tra nhanh
SELECT COUNT(*) AS records_today FROM pm_nc0009 WHERE lv014='DA_RA';
SELECT COUNT(*) AS records_01012025 FROM pm_nc0009_01012025 WHERE lv014='DA_RA';
SELECT COUNT(*) AS records_15062025 FROM pm_nc0009_15062025 WHERE lv014='DA_RA';
