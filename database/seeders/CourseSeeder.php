<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // College of Education Courses
        Course::create([
            'college_id' => '1',
            'short_name' => 'BEEd',
            'full_name' => 'Bachelor in Elementary Education',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BECEd',
            'full_name' => 'Bachelor in Early Childhood Education',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BSNEd',
            'full_name' => 'Bachelor in Special Need Education',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BSEd - Math',
            'full_name' => 'Bachelor in Secondary Education Major in Mathematics',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BSEd - Science',
            'full_name' => 'Bachelor in Secondary Education Major in Science',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BSEd - Values Ed',
            'full_name' => 'Bachelor in Secondary Education Major in Values Education',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BSEd - English',
            'full_name' => 'Bachelor in Secondary Education Major in English',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BSEd - Filipino',
            'full_name' => 'Bachelor in Secondary Education Major in Filipino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BTLEd-IA',
            'full_name' => 'Bachelor in Technology and Livelihood Education Major in Industrial Arts',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BTLEd-HE',
            'full_name' => 'Bachelor in Technology and Livelihood Education Major in Home Economics',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BTLEd-ICT',
            'full_name' => 'Bachelor in Technology and Livelihood Education Major in Information and Communication Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BTVTEd-Draft',
            'full_name' => 'Bachelor in Technical and Vocational Teacher Education Major in Architectural Drafting ',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BTVTEd-Auto',
            'full_name' => 'Bachelor in Technical and Vocational Teacher Education Major in Automotive Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BTVTEd-Food',
            'full_name' => 'Bachelor in Technical and Vocational Teacher Education Major in Food Services Management Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BTVTEd-Elec',
            'full_name' => 'Bachelor in Technical and Vocational Teacher Education Major in Electrical Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BTVTEd-Elex',
            'full_name' => 'Bachelor in Technical and Vocational Teacher Education Major in Electrical Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BTVTEd-GFD',
            'full_name' => 'Bachelor in Technical and Vocational Teacher Education Major in Garments, Fashion and Design Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '1',
            'short_name' => 'BTVTEd-WF',
            'full_name' => 'Bachelor in Technical and Vocational Teacher Education Major in Welding and Fabrication Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // End of College of Education

        // Start of College of Engineering
        Course::create([
            'college_id' => '2',
            'short_name' => 'BSCE',
            'full_name' => 'Bachelor of Science in Civil Engineering',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '2',
            'short_name' => 'BSCompEng',
            'full_name' => 'Bachelor of Science in Computer Engineering',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '2',
            'short_name' => 'BSECE',
            'full_name' => 'Bachelor of Science in Electronics Engineeringg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '2',
            'short_name' => 'BSEE',
            'full_name' => 'Bachelor of Science in Electrical Engineering',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '2',
            'short_name' => 'BSIE',
            'full_name' => 'Bachelor of Science in Industrial Engineering',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '2',
            'short_name' => 'BSME',
            'full_name' => 'Bachelor of Science in Mechanical Engineering',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // End of College of Engineering

        // Start of College of Technology
        Course::create([
            'college_id' => '3',
            'short_name' => 'BSMx',
            'full_name' => 'Bachelor of Science in Industrial Engineering',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BSIE',
            'full_name' => 'Bachelor of Science in Mechatronics',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BSGD',
            'full_name' => 'Bachelor of Science in Graphics and Design',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BSTechM',
            'full_name' => 'Bachelor of Science in Technology Management',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Automotive Technology',
            'full_name' => 'Bachelor of Industrial Technology Major in Automotive Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Civil Technology',
            'full_name' => 'Bachelor of Industrial Technology Major in Civil Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Cosmetology',
            'full_name' => 'Bachelor of Industrial Technology Major in Cosmetology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Drafting Technology',
            'full_name' => 'Bachelor of Industrial Technology Major in Drafting Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Electrical Technology',
            'full_name' => 'Bachelor of Industrial Technology Major in Electrical Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Electronics Technology',
            'full_name' => 'Bachelor of Industrial Technology Major in Electronics Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - FoodTech',
            'full_name' => 'Bachelor of Industrial Technology Major in Food Preparation and Services Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Furniture and Cabinet Making',
            'full_name' => 'Bachelor of Industrial Technology Major in Furniture and Cabinet Making',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Garments Technology',
            'full_name' => 'Bachelor of Industrial Technology Major in Garments Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Interior Design Technology',
            'full_name' => 'Bachelor of Industrial Technology Major in Interior Design Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Machine Shop Technology',
            'full_name' => 'Bachelor of Industrial Technology Major in Machine Shop Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Power Plant Technology',
            'full_name' => 'chelor of Industrial Technology Major in Power Plant Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Refrigeration and Air-conditioning Technology',
            'full_name' => 'Bachelor of Industrial Technology Major in Refrigeration and Air-conditioning Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '3',
            'short_name' => 'BIT - Welding and Fabrication Technology',
            'full_name' => 'Bachelor of Industrial Technology major in Welding and Fabrication Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // End of College of Technology

        // Start of College of Management and Entrepreneurship
        Course::create([
            'college_id' => '4',
            'short_name' => 'BPA',
            'full_name' => 'Bachelor of Public Administration',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        Course::create([
            'college_id' => '4',
            'short_name' => 'BSHM',
            'full_name' => 'Bachelor of Science in Hospitality Management',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '4',
            'short_name' => 'BSBA- MM',
            'full_name' => 'Bachelor of Science in Business Administration Major in Marketing Management',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '4',
            'short_name' => 'BSTM',
            'full_name' => 'Bachelor of Science in Tourism Management',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // End of College of Management and Entrepreneurship

        // Start of College of Information and Communications Technology
        Course::create([
            'college_id' => '5',
            'short_name' => 'BSIT',
            'full_name' => 'Bachelor of Science in Information Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '5',
            'short_name' => 'BSIS',
            'full_name' => 'Bachelor of Science in Information Systems',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '5',
            'short_name' => 'BIT-CT',
            'full_name' => 'Bachelor in Industrial Technology - Computer Technology',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // End of College of Information and Communications Technology

        // Start of College of Arts and Science
        Course::create([
            'college_id' => '6',
            'short_name' => 'BAEL-ECP',
            'full_name' => 'Bachelor of Arts in English Language Major in English Across the Professions',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '6',
            'short_name' => 'BAEL-ELSD',
            'full_name' => 'Bachelor of Arts in English Language Major in English Language Studies as Discipline ',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '6',
            'short_name' => 'BAL–LCS',
            'full_name' => 'Bachelor of Arts in Literature Major in Literature And Cultural Studies',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '6',
            'short_name' => 'BAL–LA',
            'full_name' => 'Bachelor of Arts in Literature Major in Literature Across The Professions',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '6',
            'short_name' => 'BS MATH',
            'full_name' => 'Bachelor of Science in Mathematics',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '6',
            'short_name' => 'BS STAT',
            'full_name' => 'Bachelor of Science in Statistics',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '6',
            'short_name' => 'BSDevCom',
            'full_name' => 'Bachelor of Science in Development Communication',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '6',
            'short_name' => 'BAF',
            'full_name' => 'Batsilyer ng Sining sa Filipino',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        Course::create([
            'college_id' => '6',
            'short_name' => 'BS PSYCH',
            'full_name' => 'Bachelor of Science in Psychology',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Course::create([
            'college_id' => '6',
            'short_name' => 'BSN',
            'full_name' => 'Bachelor of Science in Nursing',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
