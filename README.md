<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
    </a>
</p>

## Latar Belakang

Pada pelaksanaan program Virtual Internship Experience ini, peserta diberikan gambaran tentang bagaimana seorang Fullstack Developer bekerja di Investree. Peserta juga akan belajar bagaimana memecahkan masalah dan mengerjakan project yang sesuai dengan kegiatan perusahaan investree. Di awal, peserta dipaparkan terhadap beberapa materi reading dan video learning yang diharapkan bisa membantu peserta dalam memahami kembali kompetensi yang dibutuhkan oleh seorang Fullstack Deveoper sekaligus memahami bagaimana Investree menerapkan keilmuan tersebut. Kemudian peserta ditantang untuk menyelesaikan beberapa test untuk mereview pemahaman peserta dalam bidang fullstack. Terakhir, peserta akan dihadapkan kepada project akhir dimana peserta akan ditantang untuk mengimplementasikan segala keilmuan terkait development yang telah peserta kuasai sebelumnya. Nantinya pekerjaan peserta semua akan dinilai dan diberikan feedback oleh tim kami. 

## Instalation

### Prepare dependencies
    - composer install
    - cp .env.example .env
    - cp .env.testing.example .env.testing

### Change Database Config
    Change Database configuration in .env and .env.testing 

### Generate and Migration
    - php artisan key:generate
    - php artisan migrate --seed
    - php artisan passport:install

### Prepare FrontEnd
    - npm install
    - npm run dev

### Run Test and Development Server
    - php artisan test
    - php artisan serve
