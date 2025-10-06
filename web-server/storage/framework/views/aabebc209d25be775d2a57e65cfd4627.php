<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section id="resume" class="resume section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>My Research</h2>
        <p>
          งานวิจัยนี้มุ่งเน้นการออกแบบสถาปัตยกรรมระบบที่สามารถดึงและวิเคราะห์ข้อมูลผู้ใช้งานจากหลายแพลตฟอร์มสื่อสังคมออนไลน์อย่างมีประสิทธิภาพ โดยผสาน MCP Server เพื่อประมวลผลแบบกระจาย (Distributed Processing) กับ Large Language Models (LLMs) สำหรับการวิเคราะห์เชิงความหมายของข้อมูลที่ไม่เป็นโครงสร้าง (Unstructured Data) แนวทางวิจัยแบ่งออกเป็น 4 ส่วนหลัก ดังนี้
        </p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3 class="resume-title">System Architecture Design</h3>

            <div class="resume-item pb-0">
              <h6>ออกแบบสถาปัตยกรรมระบบ (System Architecture Design)</h6>
              <ul>
                <li>ใช้ MCP Server เป็นแกนกลางในการจัดการ Task Scheduling และ Data Pipeline สำหรับการ scraping และประมวลผลข้อมูลแบบขนาน (Parallel Processing)</li>
                <li>พัฒนา โมดูล scraping เพื่อดึงข้อมูลโปรไฟล์ผู้ใช้งานจากหลายแพลตฟอร์ม (เช่น Twitter/X, Facebook, Instagram, LinkedIn) ผ่านทั้ง API และ Web Scraping</li>
              </ul>
            </div><!-- Edn Resume Item -->

            <h3 class="resume-title">LLM-based Semantic Analysis</h3>
            <div class="resume-item pb-0">
              <h6>ผสาน LLM สำหรับการวิเคราะห์ข้อมูลเชิงความหมาย (LLM-based Semantic Analysis)</h6>
              <ul>
                <li>ใช้ LLM (เช่น GPT, LLaMA) วิเคราะห์ข้อความที่ไม่เป็นโครงสร้าง เพื่อสกัดข้อมูลเชิงบริบท เช่น ความสนใจ ทัศนคติ และพฤติกรรมของผู้ใช้งาน</li>
                <li>พัฒนาโมดูล Semantic Analysis สำหรับ Named Entity Recognition (NER), Sentiment Analysis และ Interest Classification</li>
              </ul>
            </div><!-- Edn Resume Item -->
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <h3 class="resume-title">Automated User Profiling</h3>
            <div class="resume-item">
              <h6>พัฒนากระบวนการสร้างโปรไฟล์ผู้ใช้งานแบบอัตโนมัติ (Automated User Profiling)</h6>
              <ul>
                <li>รวมข้อมูลจากหลายแพลตฟอร์มเพื่อสร้างโปรไฟล์ผู้ใช้งานที่สมบูรณ์ ลดข้อมูลซ้ำ และเชื่อมโยงข้อมูลที่กระจัดกระจาย</li>
                <li>จัดเก็บข้อมูลในฐานข้อมูลที่สืบค้นได้ง่าย และสามารถต่อยอดไปใช้ในระบบวิเคราะห์อื่นได้</li>
              </ul>
            </div><!-- Edn Resume Item -->


            <h3 class="resume-title">System Evaluation</h3>
            <div class="resume-item">
              <h6>ประเมินประสิทธิภาพของระบบ (System Evaluation)</h6>
              <p>ทดสอบระบบที่พัฒนาขึ้นกับชุดข้อมูลจากหลายแพลตฟอร์ม และเปรียบเทียบกับวิธีการ scraping และการวิเคราะห์แบบดั้งเดิม ใช้ตัวชี้วัดสำคัญ ได้แก่</p>
              <ul>
                <li>ความเร็วในการประมวลผล (Processing Time / Throughput)</li>
                <li>ความถูกต้องและความครบถ้วนของข้อมูล (Data Accuracy & Completeness)</li>
                <li>คุณภาพของการตีความข้อมูลเชิงบริบท (Contextual Understanding Quality)</li>
              </ul>
            </div><!-- Edn Resume Item -->
          </div>

        </div>

      </div>

    </section>

    <!-- Reference -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Reference</h2>
        
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4" id="ref">

          <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="icon flex-shrink-0"><i class="bi bi-file-pdf-fill"></i></div>
            <div>
              <h4 class="title"><a href="service-details.html" class="stretched-link">Read PDF</a></h4>
              <p class="description">[1] J. Dean and S. Ghemawat, “MapReduce: Simplified data processing on large clusters,” OSDI’04: Sixth Symposium on Operating System Design and Implementation, 2004, pp. 137–150. [Online].</p>
            </div>
          </div>
          <!-- End Service Item -->

        </div>

      </div>

    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
      function contentLoaded() {
        fetch('api/ref')
          .then(response => response.json())
          .then(data => {
            let html = '';
            data.forEach(ref => {
              html += `
                <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
                  <div class="icon flex-shrink-0"><i class="bi bi-file-pdf-fill"></i></div>
                  <div>
                    <h4 class="title"><a href="${ref.link}" target="_blank" class="stretched-link">Read PDF</a></h4>
                    <p class="description">[${ref.paper_id}] ${ref.ref}</p>
                  </div>
                </div>
              `;
            });
            document.getElementById('ref').innerHTML = html;
          })
          .catch(error => console.error('Error fetching references:', error));
      }

      // Call function
      document.addEventListener('DOMContentLoaded', contentLoaded);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/myresearch.blade.php ENDPATH**/ ?>