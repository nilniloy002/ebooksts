<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
   <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="STS IELTS  Academic - Comprehensive preparation materials and practice tests for IELTS Academic module">
    <meta name="keywords" content="IELTS, IELTS Reading, Academic IELTS, IELTS preparation, IELTS practice tests, STS IELTS">
    <meta name="author" content="STS Institute">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="STS IELTS Academic Platform">
    <meta property="og:description" content="Premium IELTS Academic preparation materials and practice tests">
    <meta property="og:type" content="website">
    <title>STS IELTS Academic | Target & Practice Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}"/>
    <link rel="icon" sizes="180x180" href="https://sts.institute/wp-content/uploads/2024/08/Logo-Fav.-Icon-02.png">
</head>
<body>
<div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    @yield('content')
</div>


<script src="{{ asset('assets/js/alpine.min.js') }}" defer></script>
<script src="{{ asset('assets/js/init-alpine.js') }}"></script>
</body>
</html>
