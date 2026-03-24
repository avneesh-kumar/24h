<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'name' => 'John Smith',
                'position' => 'CEO',
                'company' => 'Tech Solutions Inc.',
                'content' => 'The security team at Ready 24H Security has been exceptional. Their proactive approach and quick response times have given us peace of mind. The integration of their security systems with our existing infrastructure was seamless.',
                'rating' => 5,
                'order' => 1
            ],
            [
                'name' => 'Sarah Johnson',
                'position' => 'Operations Manager',
                'company' => 'Global Logistics Ltd.',
                'content' => 'We\'ve been working with Ready 24H Security for over two years now. Their attention to detail and commitment to excellence is unmatched. The security personnel are professional and well-trained.',
                'rating' => 5,
                'order' => 2
            ],
            [
                'name' => 'Michael Chen',
                'position' => 'Facility Director',
                'company' => 'Metro Hospital',
                'content' => 'The security solutions provided have significantly improved our facility\'s safety. Their team understands the unique challenges of healthcare security and has implemented effective measures.',
                'rating' => 5,
                'order' => 3
            ],
            [
                'name' => 'Emily Rodriguez',
                'position' => 'Property Manager',
                'company' => 'Skyline Properties',
                'content' => 'Ready 24H Security has transformed our building\'s security. Their advanced surveillance systems and professional guards have created a safer environment for our tenants.',
                'rating' => 5,
                'order' => 4
            ],
            [
                'name' => 'David Wilson',
                'position' => 'School Principal',
                'company' => 'Lincoln High School',
                'content' => 'The security team has been instrumental in maintaining a safe learning environment. Their presence is reassuring to both staff and students, and their response to incidents is always prompt and professional.',
                'rating' => 5,
                'order' => 5
            ],
            [
                'name' => 'Lisa Thompson',
                'position' => 'Event Coordinator',
                'company' => 'Grand Events',
                'content' => 'We rely on Ready 24H Security for all our major events. Their crowd management and security protocols are top-notch. They\'ve never let us down.',
                'rating' => 5,
                'order' => 6
            ],
            [
                'name' => 'Robert Kim',
                'position' => 'IT Director',
                'company' => 'Digital Innovations',
                'content' => 'The integration of their security systems with our IT infrastructure was flawless. Their technical expertise and attention to detail are impressive.',
                'rating' => 5,
                'order' => 7
            ],
            [
                'name' => 'Patricia Martinez',
                'position' => 'Retail Manager',
                'company' => 'Mega Mall',
                'content' => 'The security team has helped reduce incidents significantly. Their presence is professional and reassuring to our customers and staff.',
                'rating' => 5,
                'order' => 8
            ],
            [
                'name' => 'James Anderson',
                'position' => 'Construction Site Manager',
                'company' => 'BuildRight Construction',
                'content' => 'Their security services have been crucial in protecting our construction sites. The team is reliable and understands the unique security needs of construction projects.',
                'rating' => 5,
                'order' => 9
            ],
            [
                'name' => 'Maria Garcia',
                'position' => 'Hotel Manager',
                'company' => 'Grand Plaza Hotel',
                'content' => 'Ready 24H Security has been an invaluable partner in ensuring our guests\' safety. Their discreet yet effective security measures have enhanced our hotel\'s reputation.',
                'rating' => 5,
                'order' => 10
            ],
            [
                'name' => 'Thomas Brown',
                'position' => 'Warehouse Supervisor',
                'company' => 'Global Distribution',
                'content' => 'The security team has helped us maintain a secure and efficient operation. Their understanding of logistics security is impressive.',
                'rating' => 5,
                'order' => 11
            ],
            [
                'name' => 'Jennifer Lee',
                'position' => 'Museum Director',
                'company' => 'City Art Museum',
                'content' => 'Their security solutions have been perfect for our museum. They understand the balance between security and visitor experience.',
                'rating' => 5,
                'order' => 12
            ],
            [
                'name' => 'William Taylor',
                'position' => 'Sports Complex Manager',
                'company' => 'Olympic Sports Center',
                'content' => 'The security team handles our large crowds with professionalism. Their presence is reassuring to our visitors and staff.',
                'rating' => 5,
                'order' => 13
            ],
            [
                'name' => 'Rachel White',
                'position' => 'Restaurant Owner',
                'company' => 'Gourmet Dining',
                'content' => 'Their security services have created a safe environment for our customers. The team is professional and unobtrusive.',
                'rating' => 5,
                'order' => 14
            ],
            [
                'name' => 'Daniel Clark',
                'position' => 'Office Park Manager',
                'company' => 'Business Plaza',
                'content' => 'Ready 24H Security has been instrumental in maintaining a secure environment for our tenants. Their service is reliable and professional.',
                'rating' => 5,
                'order' => 15
            ],
            [
                'name' => 'Sophia Adams',
                'position' => 'Shopping Center Director',
                'company' => 'Metro Mall',
                'content' => 'Their security team has helped create a safe shopping environment. The integration of their systems with our existing security measures was seamless.',
                'rating' => 5,
                'order' => 16
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
} 