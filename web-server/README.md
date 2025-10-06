# CT519 Final Exam Project

โปรเจค Paper Reference Management สำหรับบันทึกและจัดการรายการอ้างอิงงานวิจัย

## เทคโนโลยีที่ใช้

- **Backend**: Laravel Framework
- **Frontend**: Bootstrap, JavaScript
- **Database**: MariaDB
- **Container**: Docker

## วิธีติดตั้งและใช้งาน

### ขั้นตอนการติดตั้ง

1. **Clone repository**
   ```bash
   git clone https://github.com/jackson-1go/ct519-final-exam.git
   cd ct519-final-exam
   ```

2. **สร้างไฟล์ .env**
   ```bash
   cp .env.example .env
   ```
   และปรับแต่งค่าต่างๆ โดยเฉพาะในส่วนของการเชื่อมต่อฐานข้อมูล:
   ```
   DB_CONNECTION=mysql
   DB_HOST=ct519_final_db
   DB_PORT=3306
   DB_DATABASE=ct519_final
   DB_USERNAME=root
   DB_PASSWORD=dev101
   ```

3. **เริ่มต้น Docker containers**
   ```bash
   docker-compose up -d
   ```

4. **เข้าสู่ container app และติดตั้ง dependencies**
   ```bash
   docker exec -it ct519_final_app composer install
   ```

5. **สร้าง Application key**
   ```bash
   docker exec -it ct519_final_app php artisan key:generate
   ```

6. **สร้างตารางในฐานข้อมูล**
   ```bash
   docker exec -it ct519_final_app php artisan migrate
   ```

### การเข้าถึงแอปพลิเคชัน

- **หน้าเว็บไซต์**: http://localhost:2041
- **หน้า Reference Management**: http://localhost:2041/reference
- **phpMyAdmin**: http://localhost:2040
  - Username: root
  - Password: dev101

### API Endpoints

API สำหรับจัดการข้อมูล Reference มีดังนี้:

- **GET /api/ref**: ดึงข้อมูล Reference ทั้งหมด
- **POST /api/ref**: สร้าง Reference ใหม่
  - ต้องส่งข้อมูล: paper_id (เลขอ้างอิง), link (URL), ref (รายละเอียด)
- **PUT /api/ref/{id}**: แก้ไข Reference
- **DELETE /api/ref/{id}**: ลบ Reference

## โครงสร้างฐานข้อมูล

ฐานข้อมูลประกอบด้วยตาราง `paper_ref` ที่มีโครงสร้างดังนี้:

| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| paper_id | integer | หมายเลขอ้างอิง |
| ref | string | รายละเอียดอ้างอิง |
| link | string | ลิงก์ไปยังเอกสาร |
| created_at | timestamp | เวลาที่สร้าง |
| updated_at | timestamp | เวลาที่อัพเดต |
| deleted_at | timestamp | เวลาที่ลบ (soft delete) |

## หน้าที่และการทำงานของแอปพลิเคชัน

แอปพลิเคชันนี้ถูกสร้างขึ้นเพื่อจัดการรายการอ้างอิงงานวิจัย โดยมีหน้าที่หลักๆ ดังนี้:

1. **แสดงรายการอ้างอิง**: แสดงรายการอ้างอิงที่ได้บันทึกไว้ทั้งหมด
2. **เพิ่มรายการอ้างอิง**: สามารถเพิ่มรายการอ้างอิงใหม่ได้ โดยระบุหมายเลข, ลิงก์, และรายละเอียด
3. **แก้ไขรายการอ้างอิง**: สามารถแก้ไขรายการอ้างอิงที่มีอยู่แล้วได้
4. **ลบรายการอ้างอิง**: สามารถลบรายการอ้างอิงได้ (Soft Delete)

## การดาวน์โหลดและแก้ไขโค้ด

1. Fork repository นี้
2. ทำการแก้ไขตามที่ต้องการ
3. สร้าง Pull Request เพื่อรวมโค้ดเข้ากับ repository หลัก

## License

[MIT](https://opensource.org/licenses/MIT)
