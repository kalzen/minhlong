# Website Doanh Nghiệp — Requirements Document

Đây là tài liệu yêu cầu từng bước cho sản phẩm **Website Doanh Nghiệp**. Tài liệu dùng ngôn ngữ đơn giản để bất kỳ ai cũng hiểu ứng dụng cần làm gì và nên xây dựng theo thứ tự nào.

Mục đích của tài liệu:
1. Dễ hiểu cho người code.
2. Dùng ngôn ngữ rõ ràng, tránh thuật ngữ kỹ thuật thừa.
3. Đánh số từng mục để dễ tham chiếu khi yêu cầu triển khai trong Cursor.

---

## 1. Tổng Quan Sản Phẩm

**Website Doanh Nghiệp** là website giới thiệu công ty, dịch vụ/sản phẩm, tin tức/blog, và kênh liên hệ. Hệ thống có **khu vực quản trị (admin)** để quản lý nội dung và cấu hình website.

- **Chủ thể website / Brand owner:** **MinhLong Group** (thống nhất dùng tên này trong nội dung giao diện và tài liệu).

Các ý chính:
- Website có **trang giới thiệu**, **trang dịch vụ/sản phẩm**, **trang blog/tin tức**, **trang liên hệ**, và các trang tĩnh khác (ví dụ: Tuyển dụng, Chính sách… nếu cần).
- Admin có thể **đăng nhập**, **quản lý bài viết blog**, **quản lý khách hàng gửi liên hệ**, **cấu hình settings website** như logo, thông tin liên hệ, SEO cơ bản.
- Hệ thống có **dashboard** để xem số lượt truy cập, số liên hệ mới, số bài viết, và một số log hành động quan trọng (đăng bài, chỉnh sửa settings…).

### 1.1 Đối tượng sử dụng

- **Admin (doanh nghiệp)**:
  - Đăng nhập vào trang quản trị.
  - Quản lý bài viết blog/tin tức.
  - Quản lý trang nội dung chính (giới thiệu, dịch vụ chính…).
  - Quản lý khách hàng gửi form liên hệ.
  - Cấu hình settings website: logo, thông tin liên hệ (phone, email, address), tiêu đề & mô tả website, favicon, social links cơ bản.
  - Xem thống kê tổng quan trong dashboard.
- **Khách truy cập (visitor)**:
  - Xem thông tin công ty, dịch vụ/sản phẩm, tin tức.
  - Gửi form liên hệ (tên, email, điện thoại, nội dung).

### 1.2 Luồng chính

1. Admin đăng nhập vào trang quản trị.
2. Admin cấu hình các **settings website** ban đầu: logo, tên website, tiêu đề/mô tả SEO, thông tin liên hệ.
3. Admin tạo các **bài viết blog** (danh mục, bài viết) và nội dung các trang chính (giới thiệu, dịch vụ…).
4. Khách truy cập vào website, xem nội dung, đọc blog.
5. Khách gửi form liên hệ → hệ thống lưu thông tin vào bảng khách hàng/liên hệ, đồng thời có thể gửi email thông báo cho admin (optional).
6. Admin vào dashboard xem số liệu: lượt truy cập (pageview), số liên hệ mới, số bài viết, log hành động gần đây.

---

## 2. Mục Tiêu Chính

1. Có **trang quản trị với chức năng đăng nhập bảo mật** cho admin.
2. Admin có thể **quản lý bài viết blog/tin tức**: danh mục, bài viết, trạng thái hiển thị.
3. Admin có thể **quản lý settings website**:
   - Logo, favicon.
   - Tên website, tiêu đề & mô tả SEO mặc định.
   - Thông tin liên hệ: số điện thoại, email, địa chỉ, link bản đồ (optional).
   - Social links: Facebook, YouTube, Zalo, v.v. (optional).
4. Hệ thống **lưu lại thông tin khách hàng** khi gửi form liên hệ (tên, email, điện thoại, nội dung, thời gian).
5. Có **dashboard** hiển thị thống kê cơ bản: số lượt truy cập (có thể đơn giản là tổng view), số liên hệ mới, số bài viết, số trang, và log hành động chính (tạo bài viết, chỉnh sửa settings…).
6. Website frontend hiển thị đẹp, responsive, phù hợp cho 1 trang web doanh nghiệp cơ bản.
7. Có thể mở rộng thêm các module: dịch vụ/sản phẩm, thư viện hình ảnh, FAQ… nhưng không bắt buộc giai đoạn đầu.

---

## 3. User Stories

| ID   | Story |
|------|--------|
| **US-001** | Là admin, tôi muốn đăng nhập bằng email/mật khẩu để truy cập trang quản trị. |
| **US-002** | Là admin, tôi muốn đổi mật khẩu của mình để tăng bảo mật. |
| **US-003** | Là admin, tôi muốn cấu hình logo, favicon, tên website, tiêu đề và mô tả SEO mặc định cho toàn site. |
| **US-004** | Là admin, tôi muốn cấu hình thông tin liên hệ (số điện thoại, email, địa chỉ) để hiển thị trên header/footer và trang liên hệ. |
| **US-005** | Là admin, tôi muốn tạo, chỉnh sửa, xóa bài viết blog và gán chúng vào danh mục để quản lý tin tức. |
| **US-006** | Là admin, tôi muốn bật/tắt trạng thái hiển thị của bài viết (draft/published) để chuẩn bị nội dung trước khi public. |
| **US-007** | Là admin, tôi muốn xem danh sách khách hàng đã gửi form liên hệ kèm thông tin chi tiết (tên, email, SĐT, nội dung, thời gian). |
| **US-008** | Là admin, tôi muốn lọc, tìm kiếm danh sách liên hệ theo thời gian hoặc từ khóa để dễ xử lý. |
| **US-009** | Là admin, tôi muốn xem dashboard tổng quan gồm số lượt truy cập, số liên hệ mới, số bài viết, và log hành động gần đây. |
| **US-010** | Là khách truy cập, tôi muốn xem thông tin giới thiệu công ty, dịch vụ/sản phẩm, tin tức, và có form liên hệ rõ ràng. |
| **US-011** | Là khách truy cập, tôi muốn gửi form liên hệ đơn giản (tên, email, SĐT, nội dung) và nhận thông báo gửi thành công. |
| **US-012** | (Đề xuất) Là admin, tôi muốn export danh sách liên hệ ra file Excel để lưu trữ hoặc xử lý offline. |
| **US-013** | (Đề xuất) Là admin, tôi muốn cấu hình SEO riêng cho từng bài viết (meta title, meta description, slug). |

---

## 4. Features

| ID   | Feature | Mô tả ngắn | Khi nào xuất hiện | Khi lỗi |
|------|---------|------------|--------------------|---------|
| **F-001** | Đăng nhập admin | Form email/mật khẩu; validate cơ bản; lưu session; middleware bảo vệ trang admin. | Trang `/admin/login`. | Hiển thị thông báo lỗi rõ ràng nếu sai thông tin; không tiết lộ quá chi tiết. |
| **F-002** | Quản lý tài khoản admin | Admin có thể đổi mật khẩu, cập nhật tên hiển thị. | Trang "Tài khoản của tôi" trong admin. | Giữ dữ liệu form, thông báo lỗi cụ thể. |
| **F-003** | Cấu hình website (General Settings) | Form nhập: tên website, slogan (optional), logo upload, favicon upload, meta title/description mặc định. | Menu "Cài đặt" → "Chung". | Nếu upload file lỗi hoặc định dạng không hợp lệ, thông báo rõ ràng. |
| **F-004** | Cấu hình thông tin liên hệ | Form nhập: phone, email, address, link bản đồ (Google Maps embed link), social links (Facebook, YouTube, Zalo…). | Menu "Cài đặt" → "Liên hệ". | Validate dữ liệu (email hợp lệ, URL hợp lệ); báo lỗi nếu không lưu được. |
| **F-005** | Danh mục blog | CRUD danh mục bài viết (tên, slug, mô tả ngắn, trạng thái). | Menu "Blog" → "Danh mục". | Nếu xóa danh mục đang có bài viết, cần cảnh báo hoặc không cho xóa. |
| **F-006** | Quản lý bài viết blog | CRUD bài viết: tiêu đề, slug, danh mục, nội dung (editor), ảnh đại diện, trạng thái (draft/published), ngày hiển thị, meta title/description. | Menu "Blog" → "Bài viết". | Validate bắt buộc tiêu đề, slug duy nhất; báo lỗi nếu trùng slug. |
| **F-007** | Hiển thị blog ở frontend | Danh sách bài viết, chi tiết bài viết, phân trang, sidebar bài viết mới nhất (optional). | Trang `/blog` và trang chi tiết `/blog/{slug}`. | Nếu bài viết không tồn tại hoặc đã tắt hiển thị, trả về 404. |
| **F-008** | Trang liên hệ & form liên hệ | Form nhập: tên, email, SĐT, nội dung; captcha đơn giản (optional); sau khi submit hiển thị thông báo gửi thành công. | Trang `/lien-he` hoặc `/contact`. | Hiển thị lỗi validate trên form; không reload trắng dữ liệu nếu có lỗi. |
| **F-009** | Lưu thông tin liên hệ | Mỗi lần gửi form, hệ thống lưu vào bảng liên hệ: tên, email, SĐT, nội dung, IP, user-agent, thời gian; trạng thái (mới/xử lý). | Sau khi submit form liên hệ. | Nếu lưu thất bại, hiển thị thông báo "Có lỗi xảy ra, vui lòng thử lại sau". |
| **F-010** | Quản lý liên hệ trong admin | Danh sách liên hệ với bộ lọc theo trạng thái/thời gian; xem chi tiết; đổi trạng thái (ví dụ: đã liên hệ lại). | Menu "Khách hàng" hoặc "Liên hệ". | Nếu load thất bại, cho phép bấm "Tải lại". |
| **F-011** | Dashboard thống kê | Hiển thị: tổng lượt truy cập (đơn giản), số liên hệ mới (theo ngày/tuần/tháng), số bài viết, log hành động gần đây (tạo/sửa/xóa bài, đổi settings…). | Trang đầu tiên sau khi đăng nhập admin. | Nếu một phần thống kê lỗi, không làm sập toàn bộ dashboard; hiển thị thông báo nhẹ ở khu vực đó. |
| **F-012** | Ghi log truy cập | Lưu truy cập đơn giản: đường dẫn, IP, user-agent, thời gian; có thể gộp để đếm pageview. | Tự động ở frontend (middleware). | Có thể bỏ qua lỗi ghi log để không ảnh hưởng người dùng. |
| **F-013** | Export liên hệ ra Excel (đề xuất) | Nút "Xuất Excel" trên màn danh sách liên hệ: xuất file Excel chứa các cột cơ bản. | Trong admin → "Khách hàng/Liên hệ". | Nếu xuất lỗi, hiển thị thông báo và không download file rỗng. |

---

## 5. Màn Hình / Trang

| ID   | Màn hình | Nội dung | Điều hướng |
|------|----------|----------|------------|
| **S-001** | Đăng nhập admin | Form email, mật khẩu; link "Quên mật khẩu" (optional). | Khi vào `/admin` mà chưa đăng nhập sẽ redirect về `/admin/login`. |
| **S-002** | Dashboard admin | Thống kê cơ bản (F-011), danh sách log hành động gần đây. | Sau khi đăng nhập thành công. |
| **S-003** | Danh sách bài viết | Bảng: tiêu đề, danh mục, trạng thái, ngày tạo, thao tác edit/delete; có tìm kiếm theo tiêu đề. | Menu "Blog" → "Bài viết". |
| **S-004** | Form tạo/sửa bài viết | Form: tiêu đề, slug, chọn danh mục, nội dung (editor), upload ảnh, meta title/description, trạng thái. | Từ S-003 bấm "Thêm mới" hoặc "Chỉnh sửa". |
| **S-005** | Danh sách danh mục blog | Bảng: tên, slug, số bài viết, trạng thái, thao tác. | Menu "Blog" → "Danh mục". |
| **S-006** | Cài đặt chung | Form settings chung: tên website, slogan, logo, favicon, meta title/description mặc định. | Menu "Cài đặt" → "Chung". |
| **S-007** | Cài đặt liên hệ | Form: phone, email, address, map link, social links. | Menu "Cài đặt" → "Liên hệ". |
| **S-008** | Danh sách liên hệ | Bảng: tên, email, SĐT, trạng thái, thời gian gửi; filter theo trạng thái/thời gian; nút export Excel (nếu làm). | Menu "Khách hàng" hoặc "Liên hệ". |
| **S-009** | Chi tiết liên hệ | Thông tin đầy đủ của 1 liên hệ + chú thích nội bộ (optional). | Click 1 dòng từ S-008. |
| **S-010** | Trang chủ (frontend) | Banner, giới thiệu ngắn, các dịch vụ chính, một số bài blog mới, block thông tin liên hệ. | `/`. |
| **S-011** | Trang giới thiệu | Nội dung giới thiệu chi tiết công ty (có thể quản lý bằng page builder đơn giản hoặc static). | `/gioi-thieu`. |
| **S-012** | Trang blog | Danh sách bài blog với phân trang. | `/blog`. |
| **S-013** | Trang chi tiết blog | Nội dung bài viết, bài liên quan. | `/blog/{slug}`. |
| **S-014** | Trang liên hệ | Thông tin liên hệ + form liên hệ (F-008). | `/lien-he`. |

---

## 6. Dữ Liệu (Data)

| ID   | Data | Mô tả |
|------|------|--------|
| **D-001** | User (admin) | Email, tên, mật khẩu (hash), vai trò (admin), last_login_at. |
| **D-002** | Settings chung | key, value, group (ví dụ: `site_name`, `site_logo`, `default_meta_title`, `contact_phone`, `contact_email`, `contact_address`…), kiểu dữ liệu (string/text/json). |
| **D-003** | Danh mục blog | id, name, slug, description, status, created_at, updated_at. |
| **D-004** | Bài viết blog | id, category_id, title, slug, excerpt, content, thumbnail_path, status (draft/published), published_at, meta_title, meta_description, created_at, updated_at, created_by. |
| **D-005** | Liên hệ khách hàng | id, name, email, phone, message, status (new/processing/done), ip, user_agent, created_at, updated_at. |
| **D-006** | Log truy cập | id, path, ip, user_agent, referrer (optional), created_at. |
| **D-007** | Log hành động admin | id, user_id, action (ví dụ: `create_post`, `update_settings`), payload (json), created_at. |

---

## 7. Build Steps (Gợi Ý Thứ Tự)

| ID   | Bước | Nội dung |
|------|------|----------|
| **B-001** | Auth admin | Tạo model User (admin), seed 1 admin mặc định; tạo routes và view cho đăng nhập, middleware `auth:admin` cho khu vực `/admin`. |
| **B-002** | Settings cơ bản | Tạo bảng settings (D-002), màn hình S-006 và S-007; load settings ra frontend (header/footer). |
| **B-003** | Blog backend | Tạo bảng danh mục (D-003) và bài viết (D-004); màn hình S-003, S-004, S-005; routes và controller cho CRUD. |
| **B-004** | Blog frontend | Hiển thị trang blog (S-012, S-013) với phân trang; hiển thị 3–5 bài mới nhất ở trang chủ. |
| **B-005** | Trang tĩnh & layout | Xây dựng layout frontend chung (header, footer, breadcrumb, responsive); tạo trang chủ (S-010), giới thiệu (S-011), liên hệ (S-014). |
| **B-006** | Form liên hệ & lưu liên hệ | Tạo form liên hệ (F-008), validate, lưu D-005 (F-009), trang admin S-008, S-009. |
| **B-007** | Dashboard & logs | Tạo bảng log truy cập (D-006) và log hành động admin (D-007); middleware ghi log truy cập; màn hình S-002. |
| **B-008** | Export Excel (nếu làm) | Thêm chức năng export danh sách liên hệ ra Excel (F-013). |
| **B-009** | Chuyển HTML sang Frontend | Có sẵn thư mục HTML (template/mockup); cần chuyển thành giao diện frontend của website, tích hợp HTML và đường dẫn resource hợp lý, tách layout/header/footer; phần nội dung đã có backend thì lấy dữ liệu thật (kèm seeder); phần chưa có backend giữ nội dung demo. Xem **Rule: Chuyển thư mục HTML sang Frontend** (mục 9). |

---

## 8. Chi Tiết Bổ Sung

- **Công nghệ gợi ý**: Laravel cho backend, Blade/Livewire cho admin, frontend có thể dùng Blade + Tailwind/Bootstrap tùy ý.
- **Bảo mật**: Hash mật khẩu (bcrypt), CSRF token cho form, rate limit form liên hệ (đề xuất), phân quyền rõ ràng cho admin.
- **Hiệu năng**: Cache settings, cache danh mục/bài viết phổ biến nếu traffic cao (có thể làm sau).
- **SEO & UX**: URL thân thiện (slug), thẻ meta cơ bản, Open Graph cho bài viết, sitemap (optional).
- **Đa ngôn ngữ**: Website hỗ trợ đa ngôn ngữ (i18n); **ngôn ngữ mặc định là tiếng Anh (English)**. Khi triển khai mới hoặc chỉnh sửa giao diện/nội dung, ưu tiên nội dung và nhãn mặc định bằng tiếng Anh; chuẩn bị cấu trúc (locale, file dịch, URL) để mở rộng thêm ngôn ngữ sau. Xem **Rule: Đa ngôn ngữ** (mục 10).

---

## 9. Rule: Chuyển thư mục HTML sang Frontend

Khi thực hiện **B-009** (hoặc khi có yêu cầu chuyển một folder HTML thành giao diện frontend), tuân thủ các bước sau:

1. **Tích hợp HTML và đường dẫn resource**
   - Đảm bảo tích hợp được toàn bộ file HTML vào cấu trúc frontend (Vite/Blade/Inertia tùy dự án).
   - Chỉnh lại đường dẫn CSS, JS, hình ảnh, font… cho đúng với cấu trúc public/build (ví dụ: `asset()`, `Vite::`, hoặc import trong bundle) để không bị lỗi 404.
   - **KHÔNG** dùng `file_get_contents()` + `str_replace()` trong Blade để render HTML mỗi request; thay vào đó, copy HTML cần dùng vào Blade và chỉnh sửa trực tiếp trong view (hoặc tách thành partials).

2. **Bóc tách và chia layout**
   - Tự bóc tách HTML thành các phần dùng chung:
     - **Layout** chính (wrapper, grid, container chung).
     - **Header** (logo, menu, hotline…).
     - **Footer** (thông tin liên hệ, link, copyright…).
   - Các trang con dùng chung layout/header/footer, chỉ thay đổi phần nội dung (content) giữa header và footer.

3. **Nội dung đã có chức năng backend**
   - Kiểm tra từng khối nội dung: nếu đã có API/model/trang quản trị tương ứng (blog, liên hệ, settings, dịch vụ…) thì:
     - Đưa dữ liệu thật ra frontend (qua controller, props, hoặc API).
     - Viết **seeder** cho backend để có dữ liệu mẫu đủ dùng ngoài frontend (bài viết, danh mục, settings, v.v.).
   - Đảm bảo frontend hiển thị đúng dữ liệu từ backend, không hard-code nội dung thật trong HTML.

4. **Nội dung chưa có backend**
   - Khối nào chưa có model/API/trang quản trị thì **giữ nguyên nội dung demo** (placeholder) trong HTML/frontend.
   - Có thể đánh dấu (comment hoặc TODO) để sau này thay bằng dữ liệu thật khi backend đã có.

5. **Thứ tự ưu tiên**
   - Có thể thực hiện B-009 sau khi đã có layout và một số backend cơ bản (B-001, B-002, B-005…) để dễ map dữ liệu; hoặc làm B-009 trước rồi từ từ nối backend vào từng khối.

---

## 10. Rule: Đa ngôn ngữ (i18n)

Website sử dụng **đa ngôn ngữ**. Khi triển khai hoặc chỉnh sửa, tuân thủ:

1. **Ngôn ngữ mặc định**
   - **Tiếng Anh (English)** là ngôn ngữ mặc định của website.
   - Nội dung tĩnh (label, placeholder, thông báo), nội dung mẫu/seed, và giao diện mặc định nên dùng tiếng Anh.

2. **Khi viết code / giao diện**
   - Ưu tiên chuỗi hiển thị mặc định bằng tiếng Anh (ví dụ: "Contact Us", "Read More", "Send Message").
   - Chuẩn bị sẵn cấu trúc hỗ trợ đa ngôn ngữ: dùng key dịch (lang file, `__()`, `@lang`) thay vì hard-code chuỗi khi có thể; hoặc ghi chú TODO i18n cho các chuỗi sẽ dịch sau.

3. **Khi mở rộng thêm ngôn ngữ**
   - Xác định danh sách locale (ví dụ: `en`, `vi`); lưu preference ngôn ngữ (session, cookie, hoặc URL prefix).
   - Nội dung từ backend (bài viết, danh mục, settings) có thể có bản dịch theo locale (bảng/field riêng hoặc file dịch tương ứng).

4. **Tham chiếu**
   - Có thể nói "làm theo Rule đa ngôn ngữ mục 10" hoặc "ngôn ngữ mặc định tiếng Anh" khi yêu cầu Cursor triển khai tính năng hoặc sửa giao diện.

---

## 11. Tài liệu nội dung — Hero & Brand (Minh Long Group)

Tài liệu tham chiếu để tạo/cập nhật nội dung hero và thương hiệu. Website mặc định dùng **bản tiếng Anh** (xem mục 10).

### 11.1 Branding

- **Tên thương hiệu:** Minh Long Group  
- **Logo:** "Group" (chữ script, màu đen) + "MINH LONG" (chữ in hoa, sans-serif, màu nâu đỏ).  
- **Phong cách:** Thanh lịch, chuyên nghiệp; đường kẻ ngang tách header và nội dung.

### 11.2 Hero section — Nội dung gốc (Tiếng Việt)

- **Tiêu đề chính:** Định hình khối lớn  
- **Tiêu đề phụ:** HÀNH TRÌNH KIM TỰ THÁP  
- **Đoạn mô tả:**  
  Năm 2026, Minh Long Group bước vào giai đoạn phát triển mới với chủ đề "Định hình khối lớn" trong "Hành trình Kim tự tháp". Điều này đánh dấu quá trình hoàn thiện của một tập đoàn đa lĩnh vực vận hành trên nền tảng hệ thống đồng bộ và tầm nhìn dài hạn. Minh Long Group hướng tới sự phát triển theo cấu trúc thống nhất, nâng cao năng lực quản trị, mở rộng quy mô hoạt động và gia tăng giá trị hợp tác đối tác trong và ngoài nước. "Định hình khối lớn" thể hiện cam kết xây dựng nền tảng bền vững, sẵn sàng cho các bước tiến lớn về quy mô, chất lượng và vị thế trên thị trường trong giai đoạn tiếp theo.

### 11.3 Hero section — Content for website (English, default)

- **Hero tagline / eyebrow (small):** THE PYRAMID JOURNEY  
- **Hero title (main):** Shaping a Great Mass  
- **Hero description:**  
  In 2026, Minh Long Group enters a new phase of development under the theme "Shaping a Great Mass" as part of the "Pyramid Journey." This marks the maturation of a multi-sector corporation operating on a synchronized system with a long-term vision. Minh Long Group aims for development under a unified structure, enhancing management capacity, expanding operational scale, and increasing the value of domestic and international partnerships. "Shaping a Great Mass" represents a commitment to building a sustainable foundation, ready for significant leaps in scale, quality, and market position in the upcoming period.

### 11.4 Gợi ý giao diện hero

- **Bố trí:** Tagline (nhỏ, trên) → Title (lớn, nổi bật) → Description (đoạn văn). Có thể thêm nút CTA (e.g. Contact Us / Get in touch) và/hoặc video.  
- **Màu:** Nâu đỏ (accent/logo), đen (chữ chính); nền off-white/beige nhạt.  
- **Font:** Script hoặc serif cho title; sans-serif cho tagline và body.

### 11.5 Company introduction content (About Us source)

- **Section title:** XAY DUNG MINH LONG  
- **Sub-title:** MINH LONG CONSTRUCTION / 明龙建设 或 明龙建筑

- **Vietnamese source text:**  
  Cong ty Co phan Xay dung va Cong nghiep Minh Long la tong thau EPC hang dau chuyen thi cong tron goi cong trinh cong nghiep. Voi doi ngu chuyen gia, quy trinh quan tri tien tien va cam ket tien do - chat luong - an toan, Minh Long mang den giai phap thi cong toi uu, tiet kiem chi phi va gia tri ben vung cho chu dau tu.

- **English website version (default):**  
  Minh Long Construction and Industry Joint Stock Company is a leading EPC general contractor specializing in turnkey industrial projects. With a team of experts, advanced management processes, and strong commitments to schedule, quality, and safety, Minh Long delivers optimized construction solutions that reduce costs and create sustainable value for investors.

- **Chinese reference text (optional for later i18n):**  
  明龙建设与工业股份公司是领先的EPC总承包商，专注于工业工程的交钥匙施工。凭借专家团队、先进的管理流程以及对进度、品质与安全的承诺，明龙为业主提供优化的施工解决方案，降低成本并创造可持续价值。

- **Content intent for About Us on homepage:**  
  Nhan manh vai tro tong thau EPC, nang luc quan tri, cam ket tien do/quality/safety, va gia tri ben vung cho doi tac - nha dau tu.

### 11.6 Services content source (Homepage services section)

- **Service 01 (VI):** TU VAN THIET KE  
  Minh Long Constructions cung cap dich vu tu van va thiet ke cho cac cong trinh dan dung, cong nghiep va ha tang, voi giai phap toi uu ve cong nang, tham my, chi phi va tinh ben vung.

- **Service 01 (EN - website default):** Design Consulting  
  Minh Long Constructions provides consulting and design services for civil, industrial, and infrastructure projects, delivering optimal solutions in functionality, aesthetics, cost efficiency, and sustainability.

- **Service 02 (VI):** NHA THAU THI CONG  
  Minh Long Constructions thi cong cac cong trinh xay dung tren pham vi ca nuoc, cam ket chat luong, tien do va an toan lao dong.

- **Service 02 (EN - website default):** Construction Contractor  
  Minh Long Constructions executes construction projects nationwide with strong commitments to quality, schedule, and safety.

- **Service 03 (VI):** NHA MAY SAN XUAT THEP  
  San xuat va cung cap thep xay dung, thep ket cau dap ung cac tieu chuan ky thuat cua cong trinh.

- **Service 03 (EN - website default):** Steel Manufacturing Plant  
  Manufacturing and supplying construction and structural steel products that meet technical standards.

- **Service 04 (VI):** TONG THAU CO DIEN & PCCC  
  Cung cap dich vu tong thau co dien va phong chay chua chay, tu thiet ke den thi cong.

- **Service 04 (EN - website default):** MEP & Fire Protection General Contractor  
  Providing general contracting services for MEP and fire protection systems, from design to installation.

- **Content intent for Services on homepage:**  
  Truyen tai ro 4 nhom nang luc cot loi cua MinhLong Group: tu van thiet ke, thi cong, san xuat thep, va tong thau co dien - PCCC.

### 11.7 What We Do content source (Homepage what-we-do section)

- **Section title (VI):** TONG THAU THI CONG XAY DUNG  
- **Section description (VI):**  
  XAY DUNG MINH LONG se la to chuc mang toi cac trai nghiem dich vu "Tu van thiet ke, thi cong xay dung, hoan thien cong trinh" tuyet voi nhat o cac du an Dan dung & Cong nghiep.

- **Section title (EN - website default):** Main Contractor for Construction  
- **Section description (EN - website default):**  
  Hai Phong Electromechanical Company, a member of Minh Long Group, specializes in electrical infrastructure and M&E systems for industrial and civil projects. With skilled engineers, strict construction processes, and commitments to schedule, quality, and safety, the company delivers integrated, cost-optimized solutions for investors.

- **Chinese reference (optional for i18n):**  
  建築總承包商  
  海防机电公司，明龙集团成员，专注于工业与民用工程的电力基础设施及机电（M&E）系统施工。凭借高技能工程师、严格的施工流程以及对进度、质量与安全的承诺，公司为业主提供集成化、成本优化的解决方案。

- **Content intent for What We Do on homepage:**  
  Nhan manh vai tro tong thau thi cong, nang luc M&E, va cam ket thi cong: dung tien do - dung chat luong - dung an toan.

### 11.8 Minh Long Land — Services & projects

#### 11.8.1 Minh Long Land introduction

- **Section title:** MINH LONG LAND  
- **Vietnamese paragraph:**  
  *Minh Long Land là bộ phận phát triển bất động sản của Minh Long Group, chuyên đầu tư và triển khai các dự án đô thị, bất động sản công nghiệp và nhà ở xã hội. Với tầm nhìn bền vững, đội ngũ chuyên môn và quy trình quản trị chuyên nghiệp, Minh Long Land tạo ra các khu đô thị hiện đại, khu công nghiệp hiệu quả và giải pháp nhà ở an toàn, giá cả hợp lý cho cộng đồng.*  
- **English paragraph (default for website):**  
  *Minh Long Land is the real estate development arm of Minh Long Group, specializing in investment and delivery of urban projects, industrial real estate, and social housing. With a sustainable vision, professional expertise, and robust governance processes, Minh Long Land creates modern townships, efficient industrial clusters, and affordable, safe housing solutions for communities.*  
- **Chinese paragraph (reference):**  
  明龙置地是明龙集团的地产开发部门，专注于投资与实施城镇项目、工业地产和保障性住房。凭借可持续的发展愿景、专业团队和完善的治理流程，明龙置地打造现代化城镇、高效的工业园区以及安全、价格合理的住房解决方案。  
- **Tagline (VI):** "Nền tảng cho phát triển bền vững"  
- **Tagline (EN):** "Foundation for sustainable development"

#### 11.8.2 Minh Long Land – Real estate segments

**Segment 1 — Bất động sản đô thị / Urban real estate / 城市房地產**

- Khu đô thị, khu dân cư  
  - Residential community / 城市新區  
- Chung cư thương mại  
  - Commercial apartment / 商業公寓  
- Khách sạn, nhà thương mại  
  - Hotel, commercial building / 商業大樓  

**Segment 2 — Bất động sản công nghiệp / Industrial real estate / 工業房地產**

- Khu công nghiệp  
  - Industrial park / 工業園區  
- Cụm công nghiệp  
  - Industrial cluster / 工業集群  
- Kho bãi, nhà xưởng cho thuê  
  - Warehouses and factory / 倉儲與租賃型製造廠房  

**Segment 3 — Nhà ở xã hội / Social housing / 社會住宅**

- Nhà ở xã hội thấp tầng  
  - Low-rise social housing / 低層社會住宅  
- Nhà ở xã hội cao tầng  
  - High-rise social housing / 高層社會住宅  

#### 11.8.3 Minh Long Land – Key projects

- **Dự án nhà ở xã hội LHP – Hải Phòng**  
  - LHP Social Housing Project – Hai Phong / LHP 保障性住房項目 – 海防  
- **Cụm công nghiệp Bần Thiện**  
  - Ban Thien Industrial Cluster / 板善工業集群  
- **Tổ hợp nhà xưởng cho thuê – KCN Nam Cầu Kiền, Hải Phòng**  
  - Factory Complex for Lease – Nam Cau Kien Industrial Zone, Hai Phong / 租賃型廠房綜合體 – 南Cầu Kiền工業區, 海防  

#### 11.8.4 Minh Long Land – Industrial focus message

- **Vietnamese:**  
  *Tập trung đầu tư mạnh vào khu công nghiệp và thúc đẩy phát triển dự án công nghiệp quy mô, tối ưu hạ tầng để thu hút nhà đầu tư chiến lược.*  
- **English (default):**  
  *Focus on heavy investment in industrial parks and robust development of industrial projects, optimizing infrastructure to attract strategic investors.*  
- **Chinese (reference):**  
  重点投资工业园区，致力推动工业项目发展，优化基础设施以吸引战略投资者。  

---

## Style & Clarity

- Giữ câu ngắn, rõ.
- Tránh thuật ngữ kiến trúc nặng trong tài liệu.
- Có thể tham chiếu số mục (ví dụ: "Implement F-006 và B-003") khi yêu cầu Cursor triển khai.