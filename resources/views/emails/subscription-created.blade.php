<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Subscription Created</title>
</head>
<body class="bg-gray-100 font-sans">
    <div class="max-w-2xl mx-auto my-8 bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-purple-600 p-6 text-white text-center">
            <h1 class="text-2xl font-bold">Your Free IELTS Reading (Academic) E-book Access</h1>
        </div>
        <div class="p-6">
            <p class="text-gray-800 mb-4">Dear <strong>{{ $subscription->std_name }}</strong>,</p>
        
            <p class="text-gray-700 mb-4">
               Your subscription to the <strong>IELTS Reading (Academic) E-book</strong> has been successfully activated by <strong>STS Institute</strong>. You now have <strong>6 months of full access</strong> to high-quality reading practice materials, carefully designed to help you strengthen your IELTS Reading performance.
            </p>

            <div class="bg-gray-100 p-4 rounded-lg mb-4">
                <p class="mb-2"><strong class="text-gray-800">Website:</strong> <a href="{{ url('/') }}" class="text-purple-600 underline">{{ url('https://ebook.stsinstitute.site/public/student/login') }}</a></p>
                <p class="mb-2"><strong class="text-gray-800">Student ID:</strong> {{ $subscription->std_id }}</p>
                <p class="mb-2"><strong class="text-gray-800">Password:</strong> {{ $subscription->password }}</p>
                <p class="mb-2"><strong class="text-gray-800">Access Start Date:</strong> {{ \Carbon\Carbon::parse($subscription->sub_start_date)->format('F j, Y') }}</p>
                <p><strong class="text-gray-800">Access End Date:</strong> {{ \Carbon\Carbon::parse($subscription->sub_end_date)->format('F j, Y') }}</p>
            </div>
            <p class="text-gray-700 mb-4">
                If you have any questions or need assistance, feel free to contact us: <a href="tel:01939606850" class="text-purple-600 underline">01939-606850</a>
            </p>
            <p class="text-gray-700">Warm regards,</p>
            <p class="text-gray-800 font-semibold"><strong>STS Institute</strong></p>
        </div>
    </div>
</body>
</html>
