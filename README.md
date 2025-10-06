# mod_security
จงสร้างระบบที่มีสถาปัตยกรรม ตามรูป โดยใช้ OWASP/modsecurity-crs และ Web server หลังบ้าน  (เว็บที่ นศ แต่ละท่านมีอยู่)   ทั้งนี้แนบไฟล์ตัวอย่างมาให้ดังนี้

|-- Example-Project
    |-- docker-compose.yaml
    |-- waf-nginx-crs
        |-- Dockerfile
    |-- web-server
        |-- Dockerfile
            |-- .. web codes ..

สิ่งที่ส่ง   1) ลิ้ง repo ใน Github ของระบบที่สร้างขึ้น พร้อมที่จะ clone มา run 
        2) ไฟล์ pdf ที่แสดงการทดสอบเบื้องต้นว่า waf สามารถดักการโจมตี เช่น sql injection ได้