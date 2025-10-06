@extends('layouts.app')
@section('style')
@endsection
@section('content')
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Setting Reference</h2>
        <p>เพิ่ม ลบ แก้ไข รายการอ้างอิง</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-5">

            <div class="info-wrap" id="ref">

              {{-- <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <div>
                  <h3>[1]</h3>
                  <p>
                    <span>J. Dean and S. Ghemawat, “MapReduce: Simplified data processing on large clusters,” OSDI’04: Sixth Symposium on Operating System Design and Implementation, 2004, pp. 137–150. [Online].</span> <br>
                    <button type="button" class="btn btn-link">Edit</button> 
                    <button type="button" class="btn btn-link text-danger">Delete</button>
                  </p>
                </div>
              </div><!-- End Info Item --> --}}

            </div>
          </div>

          <div class="col-lg-7">
            <form id="formData" class="php-email-form" action="javascript:void(0);" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-12">
                  <label for="email-field" class="pb-2">Number of Reference</label>
                  <input type="number" class="form-control" name="paper_id" id="paper_id" required="">
                </div>

                <div class="col-md-12">
                  <label for="subject-field" class="pb-2">Link to PDF</label>
                  <input type="text" class="form-control" name="link" id="link" required="">
                </div>

                <div class="col-md-12">
                  <label for="message-field" class="pb-2">Description</label>
                  <textarea class="form-control" name="ref" rows="10" id="refs" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit" id="submitBtn">Submit</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section>
@endsection
@section('scripts')
    <script>
      let trs_edit = null;
      let dataset = null;

      function contentLoaded() {
        fetch('api/ref')
          .then(response => response.json())
          .then(data => {
            dataset = data; // เก็บข้อมูลไว้ในตัวแปร dataset
            let html = '';
            data.forEach(ref => {
              html += `
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                  <div>
                    <p>
                      <span>[${ref.paper_id}] ${ref.ref}</span> <br>
                      <button type="button" onclick="editForm(${ref.id})" class="btn btn-link">Edit</button> 
                      <button type="button" onclick="deleteData(${ref.id})" class="btn btn-link text-danger">Delete</button>
                    </p>
                  </div>
                </div>
              `;
            });
            document.getElementById('ref').innerHTML = html;
          })
          .catch(error => console.error('Error fetching references:', error));
      }

      document.getElementById('formData').addEventListener('submit', function(event) {
        event.preventDefault(); // ป้องกันการส่งฟอร์มแบบปกติ

        newCreate(); // เรียกใช้ฟังก์ชัน newCreate เมื่อฟอร์มถูกส่ง
      });

      function newCreate() {
        // ตรวจสอบความถูกต้องของข้อมูล
        let form = document.getElementById('formData');
        let formData = new FormData(form);

        let paper_id = document.getElementById('paper_id').value;
        let link = document.getElementById('link').value;
        let ref = formData.get('ref');
        
        // ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
        if (!paper_id || !link || !ref) {
          document.querySelector('.error-message').textContent = 'กรุณากรอกข้อมูลให้ครบทุกช่อง';
          document.querySelector('.error-message').style.display = 'block';
          return;
        }

        // แสดงสถานะกำลังโหลด
        document.querySelector('.loading').style.display = 'block';
        document.querySelector('.error-message').style.display = 'none';
        document.querySelector('.sent-message').style.display = 'none';
        
        const method = trs_edit ? 'PUT' : 'POST';
        const url = trs_edit ? `/api/ref/${trs_edit}` : '/api/ref';

        // ส่งข้อมูลไปยัง API
        fetch(url, {
          method: method,
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({
            paper_id: paper_id,
            link: link,
            ref: ref
          })
        })
        .then(response => {
          // ตรวจสอบว่า response สำเร็จหรือไม่
          if (!response.ok) {
            throw new Error('เกิดข้อผิดพลาดในการส่งข้อมูล');
          }
          return response.json();
        })
        .then(data => {
          // ซ่อนสถานะกำลังโหลด
          document.querySelector('.loading').style.display = 'none';
          // แสดงข้อความสำเร็จ
          document.querySelector('.sent-message').style.display = 'block';
          // ล้างข้อมูลในฟอร์ม
          form.reset();
          // รีเซ็ตสถานะการแก้ไข
          if (trs_edit) {
            document.getElementById('submitBtn').textContent = 'Submit';
            trs_edit = null;
          }
          // โหลดข้อมูลใหม่
          contentLoaded();
        })
        .catch(error => {
          // ซ่อนสถานะกำลังโหลด
          document.querySelector('.loading').style.display = 'none';
          // แสดงข้อความผิดพลาด
          document.querySelector('.error-message').textContent = error.message || 'เกิดข้อผิดพลาด โปรดลองอีกครั้ง';
          document.querySelector('.error-message').style.display = 'block';
        });
      }

      function editForm(id) {
        // ค้นหาข้อมูลจาก dataset โดยใช้ ID
        const ref = dataset.find(item => item.id === id);
        
        if (ref) {
          // กรอกข้อมูลลงในฟอร์ม
          document.getElementById('paper_id').value = ref.paper_id;
          document.getElementById('link').value = ref.link;
          document.getElementById('refs').value = ref.ref;

          // เปลี่ยนปุ่ม Submit เป็น Update
          document.getElementById('submitBtn').textContent = 'Update';
          trs_edit = id; // เก็บ ID ของรายการที่กำลังแก้ไข
        } else {
          alert('ไม่พบข้อมูลที่ต้องการแก้ไข');
        }
      }

      function deleteData(id) {
        if (!confirm('คุณแน่ใจหรือไม่ว่าต้องการลบรายการนี้?')) {
          return;
        }

        fetch(`/api/ref/${id}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('เกิดข้อผิดพลาดในการลบข้อมูล');
          }
          return response.json();
        })
        .then(data => {
          alert('ลบรายการสำเร็จ');
          contentLoaded();
          // window.location.reload();
        })
        .catch(error => {
          alert('เกิดข้อผิดพลาด: ' + error.message);
        });
      }

      document.addEventListener('DOMContentLoaded', contentLoaded);
    </script>
@endsection