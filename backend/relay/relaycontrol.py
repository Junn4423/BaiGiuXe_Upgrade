import time
import hid

def control_relay_correct(device, relay_num, state):
    """
    Điều khiển relay với format đã tìm ra
    relay_num: 1-4
    state: True=ON, False=OFF
    """
    try:
        if state:
            feature_data = [0x00, 0xFF, relay_num, 0x01, 0x00, 0x00, 0x00, 0x00, 0x00]
            action = "BẬT"
            color = "🔴"
        else:
            feature_data = [0x00, 0xFD, relay_num, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00]
            action = "TẮT"
            color = "⚫"
        
        result = device.send_feature_report(feature_data)
        print(f"{color} {action} Relay {relay_num} - Result: {result} bytes")
        return result > 0
        
    except Exception as e:
        print(f"Lỗi: {e}")
        return False

def turn_off_all_relays(device):
    """Tắt tất cả relay bằng lệnh đặc biệt"""
    try:
        feature_data = [0x00, 0xFC, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00]
        result = device.send_feature_report(feature_data)
        print(f"TẮT TẤT CẢ relay - Result: {result} bytes")
        return result > 0
    except Exception as e:
        print(f"Lỗi tắt tất cả: {e}")
        return False

def control_relay_bitmask(device, bitmask):
    """
    Điều khiển relay bằng bitmask
    bitmask: bit 0=relay1, bit 1=relay2, bit 2=relay3, bit 3=relay4
    Ví dụ: 0x05 = 0101 = relay 1 và 3 bật
    """
    try:
        feature_data = [0x00, 0xFF, bitmask, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00]
        result = device.send_feature_report(feature_data)
        print(f"Set bitmask 0x{bitmask:02X} - Result: {result} bytes")
        return result > 0
    except Exception as e:
        print(f"Lỗi bitmask: {e}")
        return False

def test_working_loop():
    """Test loop với format đã hoạt động"""
    print("Kết nối USB Relay...")
    
    try:
        device = hid.device()
        device.open(0x16C0, 0x05DF)
        print("Đã kết nối với USBRelay4")
        
        print("\n TEST LOOP VỚI FORMAT ĐÚNG")
        print("=" * 60)
        print("Header bật: 0xFF, Header tắt: 0xFD")
        print("Nhấn Ctrl+C để dừng...")
        
        cycle = 0
        while True:
            cycle += 1
            print(f"\nCycle {cycle}:")
            
            for relay_num in range(1, 5):
                print(f"--- Relay {relay_num} ---")
                
                control_relay_correct(device, relay_num, True)
                time.sleep(1)
                
                control_relay_correct(device, relay_num, False)
                time.sleep(1)
            
            print(f"\nNghỉ 2 giây...")
            time.sleep(2)
            
    except KeyboardInterrupt:
        print(f"\nDừng test bởi người dùng sau {cycle} cycles")
    except Exception as e:
        print(f"\nLỗi: {e}")
    finally:
        print(f"\nTắt tất cả relay...")
        turn_off_all_relays(device)
        
        device.close()
        print("Đã ngắt kết nối")

def test_bitmask_patterns():
    """Test các pattern bằng bitmask"""
    print("Kết nối USB Relay...")

    try:
        device = hid.device()
        device.open(0x16C0, 0x05DF)
        print("Đã kết nối với USBRelay4")

        print("\nTEST BITMASK PATTERNS")
        print("=" * 60)
        print("Nhấn Ctrl+C để dừng...")
        
        patterns = [
            (0x01, "Chỉ Relay 1"),      # 0001
            (0x02, "Chỉ Relay 2"),      # 0010  
            (0x04, "Chỉ Relay 3"),      # 0100
            (0x08, "Chỉ Relay 4"),      # 1000
            (0x03, "Relay 1+2"),        # 0011
            (0x0C, "Relay 3+4"),        # 1100
            (0x05, "Relay 1+3"),        # 0101
            (0x0A, "Relay 2+4"),        # 1010
            (0x0F, "Tất cả relay"),     # 1111
            (0x00, "Tắt tất cả"),       # 0000
        ]
        
        cycle = 0
        while True:
            cycle += 1
            print(f"\nPattern Cycle {cycle}:")

            for bitmask, description in patterns:
                print(f"\n{description} (0x{bitmask:02X}):")
                control_relay_bitmask(device, bitmask)
                time.sleep(1.5)

            print(f"\nNghỉ 3 giây...")
            time.sleep(3)
            
    except KeyboardInterrupt:
        print(f"\nDừng test bởi người dùng sau {cycle} cycles")
    except Exception as e:
        print(f"\nLỗi: {e}")
    finally:
        print(f"\nTắt tất cả relay...")
        turn_off_all_relays(device)
        
        device.close()
        print("Đã ngắt kết nối")

def test_individual_control():
    """Test điều khiển từng relay riêng biệt"""
    print("Kết nối USB Relay...")

    try:
        device = hid.device()
        device.open(0x16C0, 0x05DF)
        print("Đã kết nối với USBRelay4")

        print("\nTEST ĐIỀU KHIỂN TỪNG RELAY")
        print("=" * 60)
        print("Format: Bật=0xFF, Tắt=0xFD")
        
        while True:
            print("\nCHỌN RELAY:")
            print("1-4: Bật relay 1-4")
            print("5-8: Tắt relay 1-4")
            print("9: Tắt tất cả")
            print("0: Thoát")
            
            choice = input("Chọn (0-9): ").strip()
            
            if choice == "0":
                break
            elif choice in ["1", "2", "3", "4"]:
                relay_num = int(choice)
                print(f"Bật Relay {relay_num}...")
                control_relay_correct(device, relay_num, True)
            elif choice in ["5", "6", "7", "8"]:
                relay_num = int(choice) - 4
                print(f"Tắt Relay {relay_num}...")
                control_relay_correct(device, relay_num, False)
            elif choice == "9":
                print("Tắt tất cả relay...")
                turn_off_all_relays(device)
            else:
                print("Lựa chọn không hợp lệ!")
                
    except Exception as e:
        print(f"Lỗi: {e}")
    finally:
        print(f"\nTắt tất cả relay...")
        turn_off_all_relays(device)
        
        device.close()
        print("Đã ngắt kết nối")

def main():
    """Menu chính"""
    print("USB RELAY FINAL WORKING VERSION")
    print("=" * 60)
    print("Đã tìm ra format đúng:")
    print("   • Bật relay: Header 0xFF")
    print("   • Tắt relay: Header 0xFD")
    print("   • Tắt tất cả: Header 0xFC")
    print("   • Bitmask: Header 0xFF với bitmask")
    print()
    print("CHỌN TEST:")
    print("1. Loop test (bật/tắt tuần tự)")
    print("2. Bitmask patterns (nhiều relay cùng lúc)")
    print("3. Điều khiển thủ công")
    print("4. Thoát")
    
    try:
        choice = input("\nChọn (1-4): ").strip()
        if choice == "1":
            test_working_loop()
        elif choice == "2":
            test_bitmask_patterns()
        elif choice == "3":
            test_individual_control()
        elif choice == "4":
            print("Tạm biệt!")
        else:
            print("Lựa chọn không hợp lệ!")

    except KeyboardInterrupt:
        print("\nThoát chương trình")

if __name__ == "__main__":
    main()
