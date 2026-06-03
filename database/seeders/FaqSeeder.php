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
            | Category: Shipping & Delivery
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Shipping & Delivery',
                'question' => 'How can I track my order journey?',
                'answer' => 'You can track your order by navigating to the "Track Order" section on the menu bar and entering your tracking number. The system will display the current status of your order, such as pending, assigned, out for delivery, or successfully delivered.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Shipping & Delivery',
                'question' => 'How long does CourierXpress take to deliver an order within Hanoi?',
                'answer' => 'For intra-provincial orders, the delivery time is usually between 4 to 12 working hours from the time the shipper successfully picks up the package. Actual delivery times may vary depending on the area, weather condition, traffic, and order placement time.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Shipping & Delivery',
                'question' => 'Does CourierXpress deliver on weekends?',
                'answer' => 'CourierXpress supports weekend delivery in certain areas. However, processing times may be slower than regular working days depending on the operating schedules of the warehouse and the delivery team.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Shipping & Delivery',
                'question' => 'What happens to the package if the recipient is not present?',
                'answer' => 'If the recipient is unavailable, the shipper may contact them again to reschedule a suitable delivery time. If the recipient cannot be reached or delivery fails multiple times, the order status may be updated to delivery failed.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Shipping & Delivery',
                'question' => 'Can I schedule a specific delivery time?',
                'answer' => 'You can add your preferred time note when creating the order. CourierXpress will try its best to accommodate your request; however, the actual delivery time still depends on the delivery route, the shipper\'s schedule, and real-time transit conditions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Shipping & Delivery',
                'question' => 'Why is my order status not updated immediately?',
                'answer' => 'The order status may take some time to synchronize after the shipper or warehouse staff updates it. If the status remains unchanged for a long time, please contact support and provide your tracking number for verification.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Category: Orders
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Orders',
                'question' => 'Where can I create a new order?',
                'answer' => 'After logging in, select "Create New Order" or go to the order placement page to enter information regarding the sender, recipient, item type, weight, address, and payment method.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Orders',
                'question' => 'Where can I review my created orders?',
                'answer' => 'You can access the "My Orders" section to view the entire list of your created orders. Here, you can check tracking numbers, delivery statuses, payment information, print bills, and view specific order details.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Orders',
                'question' => 'Can I print the shipping bill for my order?',
                'answer' => 'Yes. In the "My Orders" section, click the "Print Bill" button next to the respective order. The system will display the invoice or shipping label for you to print out and attach to the package.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Orders',
                'question' => 'Can I copy the tracking number?',
                'answer' => 'Yes. From the order list, you can click the "Copy" button to quickly copy the tracking number. This number is used to track the shipping route, check statuses, or send to the recipient for tracking purposes.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Orders',
                'question' => 'When is an order status changed to delivered?',
                'answer' => 'An order status is changed to delivered when the shipper completes the delivery handover to the recipient and the system successfully logs the delivery completion.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Orders',
                'question' => 'Can I cancel an order after it has been created?',
                'answer' => 'You can request to cancel your order if it has not yet been picked up by a shipper or hasn\'t transitioned to the out for delivery status. If the order is already processed or in transit, cancellation may no longer be supported.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Category: Account
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Account',
                'question' => 'What should I do if my account is locked due to too many incorrect password attempts?',
                'answer' => 'If your account is locked due to multiple incorrect password attempts, please wait for a short period before trying again, or use the forgot password feature to reset a new password.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Account',
                'question' => 'Where can I update my personal information?',
                'answer' => 'You can update your personal details in the "My Profile" section after logging in. Adjustable fields include full name, phone number, email, and contact address.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Account',
                'question' => 'What should I do if I forget my password?',
                'answer' => 'You can use the forgot password feature on the login page. The system will guide you through resetting your password via email or your registered authentication details.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Account',
                'question' => 'Why can\'t I log into the system?',
                'answer' => 'This issue could be due to an incorrect email, wrong password, or because your account is locked or not yet activated. Please re-verify your login credentials or reach out to support to check your account status.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Account',
                'question' => 'Is my account information secure?',
                'answer' => 'CourierXpress always prioritizes user data security. Your account information, order records, and transaction histories are securely managed within our system and used solely for service operations.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Category: Payment
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Payment',
                'question' => 'What is COD?',
                'answer' => 'COD stands for Cash on Delivery. The recipient will pay the required collectable amount directly to the shipper at the moment of package delivery.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Payment',
                'question' => 'When is an order considered paid?',
                'answer' => 'An order is considered paid when the customer successfully completes the prepayment method, or when a COD order is successfully delivered and the shipper collects the payment from the recipient.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Payment',
                'question' => 'Why does a delivered order show as paid?',
                'answer' => 'For COD orders, a successful delivery implies that the shipper has collected the payment from the recipient. Therefore, the system may automatically update the payment status to paid for convenient user tracking.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Payment',
                'question' => 'Where can I check the shipping fee?',
                'answer' => 'The shipping fee is displayed during order creation, in the order list, on the order details page, and on the printed shipping bill. The fee may depend on package weight, distance, and selected service type.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Payment',
                'question' => 'How is the shipping fee calculated?',
                'answer' => 'Shipping fees are typically calculated based on package weight, package type, delivery distance, pickup/delivery region, and the chosen shipping service. Surcharges may apply for oversized goods or remote area deliveries.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Payment',
                'question' => 'Can I make a prepayment?',
                'answer' => 'Depending on the preference and agreement between the sender and recipient, prepayment can be handled directly at the counter upon dispatch.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Category: Goods & Packages
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Goods & Packages',
                'question' => 'What types of goods does CourierXpress accept for shipping?',
                'answer' => 'CourierXpress supports shipping for various common goods such as clothing, cosmetics, dry food, household items, documents, accessories, and standard e-commerce products.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Goods & Packages',
                'question' => 'What types of goods are prohibited from shipping?',
                'answer' => 'Prohibited or restricted items include flammable materials, explosives, illegal substances, weapons, contraband, live animals, strong-odor goods, or items that do not guarantee safety during transit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Goods & Packages',
                'question' => 'How should I pack my goods?',
                'answer' => 'You should pack your items securely using cardboard boxes, bubble wrap, or appropriate protective materials. For fragile items, please insert foam, paper, or air cushions, and clearly label the package as fragile.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Goods & Packages',
                'question' => 'Are fragile items accepted for shipping?',
                'answer' => 'CourierXpress can assist in shipping fragile items provided they are packed carefully and declared correctly under the appropriate category during order creation. Senders should label it clearly so shippers and sorting facilities can take note.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Goods & Packages',
                'question' => 'What happens if I enter the wrong weight for my package?',
                'answer' => 'If the actual weight differs from your declared information, the shipping fee may be adjusted accordingly. Please enter accurate weights to help the system calculate correct fees and prevent pickup discrepancies.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Category: Support
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Support',
                'question' => 'How can I change the pickup information after placing an order?',
                'answer' => 'If the order has not been picked up by the shipper, you can contact our support team to request a pickup info change. When reaching out, please provide your tracking number, old information, and the new details to be updated.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Support',
                'question' => 'What should I do if an order delivery fails?',
                'answer' => 'If a delivery fails, please check the failure reason in the order details section. Common reasons include the recipient not answering calls, incorrect address, delivery rescheduling, or the recipient refusing the package.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Support',
                'question' => 'How can I contact CourierXpress?',
                'answer' => 'You can contact CourierXpress via hotline 1900 123 456, email support@courierxpress.vn, or visit our office at 13 Phan Tay Nhac, Xuan Phuong, Hanoi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Support',
                'question' => 'Can I request a redelivery for my order?',
                'answer' => 'You can request a redelivery if the order is still eligible for processing and has not been returned to the sender. Please contact support as soon as possible to check your order\'s current condition.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Support',
                'question' => 'What information do I need to provide when contacting support?',
                'answer' => 'When contacting support, you should provide the tracking number, sender or recipient phone numbers, the specific issue details, and relevant images if available. Providing complete info helps accelerate the resolution process.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            /*
            |--------------------------------------------------------------------------
            | Category: Complaints & Compensation
            |--------------------------------------------------------------------------
            */
            [
                'category' => 'Complaints & Compensation',
                'question' => 'What should I do if the package arrives damaged?',
                'answer' => 'You should take photos of the package condition, the damaged products, and retain all original packaging. Then, contact our support team and provide the tracking number to file a complaint.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Complaints & Compensation',
                'question' => 'How long after receiving my package can I file a complaint?',
                'answer' => 'You should submit your complaint as soon as possible after discovering the issue. Filing early allows CourierXpress to verify shipping logs and process your case with higher accuracy.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Complaints & Compensation',
                'question' => 'How long does CourierXpress take to resolve a complaint?',
                'answer' => 'Complaint resolution times depend on the complexity of the specific case. Typically, our support department will acknowledge the ticket, verify the order data, and provide feedback at the earliest opportunity.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Complaints & Compensation',
                'question' => 'What documents do I need to request a compensation claim?',
                'answer' => 'You should prepare the tracking number, product images, packaging images, and invoice or product valuation documents if available. This information helps make the compensation review process more transparent.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
