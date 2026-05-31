<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('faqs')->truncate();

        DB::table('faqs')->insert([
            /*
            |--------------------------------------------------------------------------
            | Danh mục: Vận chuyển
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Vận chuyển',
                'question' => 'Làm thế nào để tôi tra cứu lộ trình đơn hàng của mình?',
                'answer' => 'Bạn có thể tra cứu lộ trình đơn hàng bằng cách vào mục "Tra cứu" trên thanh menu, sau đó nhập mã vận đơn. Hệ thống sẽ hiển thị trạng thái hiện tại của đơn hàng như chờ xử lý, đã phân công, đang giao hoặc đã giao thành công.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Vận chuyển',
                'question' => 'CourierXpress mất bao lâu để giao một đơn hàng nội thành Hà Nội?',
                'answer' => 'Đối với đơn hàng nội tỉnh, thời gian giao hàng thường từ 4 - 12 giờ làm việc kể từ khi shipper lấy hàng thành công. Thời gian thực tế có thể thay đổi tùy theo khu vực, thời tiết, giao thông và thời điểm đặt đơn.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Vận chuyển',
                'question' => 'CourierXpress có giao hàng vào cuối tuần không?',
                'answer' => 'CourierXpress hỗ trợ giao hàng vào cuối tuần tại một số khu vực. Tuy nhiên, thời gian xử lý có thể chậm hơn ngày làm việc thông thường tùy theo lịch hoạt động của kho và đội ngũ giao nhận.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Vận chuyển',
                'question' => 'Nếu người nhận không có mặt thì đơn hàng sẽ được xử lý như thế nào?',
                'answer' => 'Nếu người nhận không có mặt, shipper có thể liên hệ lại để hẹn thời gian giao phù hợp. Trong trường hợp không liên hệ được hoặc giao nhiều lần không thành công, đơn hàng có thể được chuyển sang trạng thái giao thất bại.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Vận chuyển',
                'question' => 'Tôi có thể hẹn giờ giao hàng cụ thể không?',
                'answer' => 'Bạn có thể ghi chú thời gian mong muốn khi tạo đơn hàng. CourierXpress sẽ cố gắng hỗ trợ theo yêu cầu, tuy nhiên thời gian giao thực tế còn phụ thuộc vào tuyến giao, lịch trình shipper và tình hình vận chuyển.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Vận chuyển',
                'question' => 'Tại sao trạng thái đơn hàng không cập nhật ngay lập tức?',
                'answer' => 'Trạng thái đơn hàng có thể cần một khoảng thời gian để đồng bộ sau khi shipper hoặc nhân viên kho cập nhật. Nếu trạng thái không thay đổi trong thời gian dài, bạn nên liên hệ bộ phận hỗ trợ và cung cấp mã vận đơn để được kiểm tra.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Danh mục: Đơn hàng
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Đơn hàng',
                'question' => 'Tôi có thể tạo đơn hàng mới ở đâu?',
                'answer' => 'Sau khi đăng nhập, bạn chọn mục "Tạo đơn mới" hoặc vào trang đặt đơn để nhập thông tin người gửi, người nhận, loại hàng hóa, khối lượng, địa chỉ và phương thức thanh toán.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Đơn hàng',
                'question' => 'Tôi có thể xem lại các đơn hàng đã tạo ở đâu?',
                'answer' => 'Bạn có thể vào mục "Đơn hàng của tôi" để xem toàn bộ danh sách đơn hàng đã tạo. Tại đây, bạn có thể xem mã vận đơn, trạng thái giao hàng, thông tin thanh toán, in bill và xem chi tiết từng đơn.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Đơn hàng',
                'question' => 'Tôi có thể in bill đơn hàng không?',
                'answer' => 'Có. Trong mục "Đơn hàng của tôi", bạn chọn nút "In bill" tương ứng với đơn hàng cần in. Hệ thống sẽ hiển thị hóa đơn hoặc phiếu gửi hàng để bạn in ra và dán lên kiện hàng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Đơn hàng',
                'question' => 'Tôi có thể sao chép mã vận đơn không?',
                'answer' => 'Có. Tại danh sách đơn hàng, bạn có thể bấm nút "Sao chép" để sao chép nhanh mã vận đơn. Mã này dùng để tra cứu lộ trình, kiểm tra trạng thái hoặc gửi cho người nhận theo dõi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Đơn hàng',
                'question' => 'Khi nào đơn hàng được chuyển sang trạng thái đã giao?',
                'answer' => 'Đơn hàng được chuyển sang trạng thái đã giao khi shipper hoàn tất việc giao hàng cho người nhận và hệ thống ghi nhận giao hàng thành công.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Đơn hàng',
                'question' => 'Tôi có thể hủy đơn hàng sau khi đã tạo không?',
                'answer' => 'Bạn có thể yêu cầu hủy đơn nếu đơn hàng chưa được shipper nhận hoặc chưa chuyển sang trạng thái đang giao. Nếu đơn đã được xử lý hoặc đang vận chuyển, việc hủy đơn có thể không được hỗ trợ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Danh mục: Tài khoản
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Tài khoản',
                'question' => 'Tôi phải làm sao nếu nhập sai mật khẩu quá nhiều lần và bị khóa?',
                'answer' => 'Nếu tài khoản bị khóa do nhập sai mật khẩu nhiều lần, bạn vui lòng chờ một khoảng thời gian rồi thử lại hoặc sử dụng chức năng quên mật khẩu để đặt lại mật khẩu mới.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Tài khoản',
                'question' => 'Tôi có thể cập nhật thông tin cá nhân ở đâu?',
                'answer' => 'Bạn có thể cập nhật thông tin cá nhân tại mục "Hồ sơ của tôi" sau khi đăng nhập. Các thông tin có thể chỉnh sửa bao gồm họ tên, số điện thoại, email và địa chỉ liên hệ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Tài khoản',
                'question' => 'Tôi quên mật khẩu thì phải làm thế nào?',
                'answer' => 'Bạn có thể sử dụng chức năng quên mật khẩu trên trang đăng nhập. Hệ thống sẽ hướng dẫn bạn đặt lại mật khẩu thông qua email hoặc thông tin xác thực đã đăng ký.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Tài khoản',
                'question' => 'Tại sao tôi không đăng nhập được vào hệ thống?',
                'answer' => 'Nguyên nhân có thể do sai email, sai mật khẩu, tài khoản bị khóa hoặc chưa được kích hoạt. Bạn nên kiểm tra lại thông tin đăng nhập hoặc liên hệ bộ phận hỗ trợ để được kiểm tra tài khoản.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Tài khoản',
                'question' => 'Thông tin tài khoản của tôi có được bảo mật không?',
                'answer' => 'CourierXpress luôn chú trọng bảo mật dữ liệu người dùng. Thông tin tài khoản, đơn hàng và lịch sử giao dịch được quản lý trong hệ thống và chỉ sử dụng cho mục đích vận hành dịch vụ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Danh mục: Thanh toán
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Thanh toán',
                'question' => 'COD là gì?',
                'answer' => 'COD là hình thức thanh toán khi nhận hàng. Người nhận sẽ thanh toán số tiền cần thu cho shipper tại thời điểm nhận hàng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Thanh toán',
                'question' => 'Khi nào đơn hàng được xem là đã thanh toán?',
                'answer' => 'Đơn hàng được xem là đã thanh toán khi khách hàng hoàn tất thanh toán hoặc khi đơn COD được giao thành công và shipper đã thu tiền từ người nhận.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Thanh toán',
                'question' => 'Vì sao đơn đã giao lại hiển thị là đã thanh toán?',
                'answer' => 'Với đơn hàng COD, khi đơn được giao thành công đồng nghĩa shipper đã thu tiền từ người nhận. Vì vậy hệ thống có thể tự động hiển thị trạng thái thanh toán là đã thanh toán để người dùng dễ theo dõi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Thanh toán',
                'question' => 'Tôi có thể xem phí vận chuyển ở đâu?',
                'answer' => 'Phí vận chuyển được hiển thị khi tạo đơn hàng, trong danh sách đơn hàng, trang chi tiết đơn hàng và hóa đơn in bill. Phí có thể phụ thuộc vào khối lượng, khoảng cách và loại dịch vụ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Thanh toán',
                'question' => 'Phí vận chuyển được tính như thế nào?',
                'answer' => 'Phí vận chuyển thường được tính dựa trên cân nặng, loại hàng hóa, khoảng cách giao hàng, khu vực giao nhận và dịch vụ vận chuyển được chọn. Một số trường hợp có thể phát sinh phụ phí nếu hàng cồng kềnh hoặc giao khu vực xa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Thanh toán',
                'question' => 'Tôi có thể thanh toán trước không?',
                'answer' => 'Tuỳ vào tình trạng và cam kết giữa người gửi và người nhận, mà phần thanh toán có thể được thanh toán trước ngay tại quầy.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Danh mục: Hàng hóa
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Hàng hóa',
                'question' => 'CourierXpress nhận vận chuyển những loại hàng hóa nào?',
                'answer' => 'CourierXpress hỗ trợ vận chuyển nhiều loại hàng hóa phổ biến như quần áo, mỹ phẩm, thực phẩm khô, hàng gia dụng, tài liệu, phụ kiện và các sản phẩm thương mại điện tử thông thường.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Hàng hóa',
                'question' => 'Những loại hàng hóa nào không được vận chuyển?',
                'answer' => 'Các mặt hàng bị cấm hoặc hạn chế gồm hàng dễ cháy nổ, chất cấm, vũ khí, hàng vi phạm pháp luật, động vật sống, hàng có mùi mạnh hoặc hàng không đảm bảo an toàn trong quá trình vận chuyển.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Hàng hóa',
                'question' => 'Tôi cần đóng gói hàng hóa như thế nào?',
                'answer' => 'Bạn nên đóng gói hàng chắc chắn, sử dụng thùng carton, túi chống sốc hoặc vật liệu bảo vệ phù hợp. Với hàng dễ vỡ, nên chèn thêm xốp, giấy hoặc bong bóng khí và ghi chú rõ là hàng dễ vỡ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Hàng hóa',
                'question' => 'Hàng dễ vỡ có được vận chuyển không?',
                'answer' => 'CourierXpress có thể hỗ trợ vận chuyển hàng dễ vỡ nếu hàng được đóng gói cẩn thận và khai báo đúng loại hàng khi tạo đơn. Người gửi nên ghi chú rõ để shipper và bộ phận xử lý lưu ý trong quá trình vận chuyển.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Hàng hóa',
                'question' => 'Nếu tôi nhập sai khối lượng hàng thì sao?',
                'answer' => 'Nếu khối lượng thực tế khác với thông tin đã khai báo, phí vận chuyển có thể được điều chỉnh lại. Bạn nên nhập đúng khối lượng để hệ thống tính phí chính xác và tránh phát sinh khi giao nhận.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Danh mục: Hỗ trợ
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Hỗ trợ',
                'question' => 'Làm thế nào để thay đổi thông tin lấy hàng sau khi đã đặt đơn?',
                'answer' => 'Nếu đơn hàng chưa được shipper nhận, bạn có thể liên hệ bộ phận hỗ trợ để yêu cầu thay đổi thông tin lấy hàng. Khi liên hệ, vui lòng cung cấp mã vận đơn, thông tin cũ và thông tin mới cần thay đổi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Hỗ trợ',
                'question' => 'Tôi cần làm gì nếu đơn hàng bị giao thất bại?',
                'answer' => 'Nếu đơn hàng giao thất bại, bạn nên kiểm tra lý do trong phần chi tiết đơn hàng. Các nguyên nhân phổ biến gồm người nhận không nghe máy, sai địa chỉ, hẹn giao lại hoặc người nhận từ chối nhận hàng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Hỗ trợ',
                'question' => 'Tôi liên hệ CourierXpress bằng cách nào?',
                'answer' => 'Bạn có thể liên hệ CourierXpress qua hotline 1900 123 456, email support@courierxpress.vn hoặc địa chỉ 13 Phan Tây Nhạc, Xuân Phương, Hà Nội.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Hỗ trợ',
                'question' => 'Tôi có thể yêu cầu giao lại đơn hàng không?',
                'answer' => 'Bạn có thể yêu cầu giao lại nếu đơn hàng còn đủ điều kiện xử lý và chưa bị hoàn về người gửi. Vui lòng liên hệ bộ phận hỗ trợ sớm để được kiểm tra tình trạng đơn hàng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Hỗ trợ',
                'question' => 'Tôi cần cung cấp thông tin gì khi liên hệ hỗ trợ?',
                'answer' => 'Khi liên hệ hỗ trợ, bạn nên cung cấp mã vận đơn, số điện thoại người gửi hoặc người nhận, nội dung cần hỗ trợ và hình ảnh liên quan nếu có. Việc cung cấp đầy đủ thông tin giúp quá trình xử lý nhanh hơn.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Danh mục: Khiếu nại & bồi thường
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Khiếu nại & bồi thường',
                'question' => 'Tôi phải làm gì nếu hàng bị hư hỏng khi nhận?',
                'answer' => 'Bạn nên chụp ảnh tình trạng kiện hàng, sản phẩm và giữ lại bao bì đóng gói. Sau đó liên hệ bộ phận hỗ trợ và cung cấp mã vận đơn để được tiếp nhận khiếu nại.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Khiếu nại & bồi thường',
                'question' => 'Tôi có thể khiếu nại trong bao lâu sau khi nhận hàng?',
                'answer' => 'Bạn nên gửi khiếu nại sớm nhất có thể sau khi phát hiện vấn đề. Việc khiếu nại càng sớm sẽ giúp CourierXpress kiểm tra thông tin vận chuyển và xử lý chính xác hơn.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Khiếu nại & bồi thường',
                'question' => 'CourierXpress xử lý khiếu nại trong bao lâu?',
                'answer' => 'Thời gian xử lý khiếu nại phụ thuộc vào mức độ phức tạp của vụ việc. Thông thường, bộ phận hỗ trợ sẽ tiếp nhận, kiểm tra thông tin đơn hàng và phản hồi trong thời gian sớm nhất.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Khiếu nại & bồi thường',
                'question' => 'Tôi cần giấy tờ gì để yêu cầu bồi thường?',
                'answer' => 'Bạn nên chuẩn bị mã vận đơn, hình ảnh hàng hóa, hình ảnh bao bì, hóa đơn hoặc chứng từ giá trị hàng hóa nếu có. Các thông tin này giúp quá trình xem xét bồi thường minh bạch hơn.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
