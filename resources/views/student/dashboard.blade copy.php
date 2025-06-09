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
    <link rel="stylesheet" href="{{asset('assets/css/tailwind.output.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/Chart.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('assets/dflip/css/dflip.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/dflip/css/themify-icons.min.css') }}"/>
    {{-- favicon --}}
    <link rel="icon" sizes="180x180" href="https://sts.institute/wp-content/uploads/2024/08/Logo-Fav.-Icon-02.png">
    <style>
    .df-flipbook {
        width: 100%;
        height: 600px;
        margin: 0 auto;
    }
    </style>
</head>
<body>
<div
        class="flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen }"
>
    <div class="flex flex-col flex-1 w-full">
<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
    <div
            class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
    >

        <!-- Search input -->
        <div class="flex justify-center flex-1 lg:mr-32">
           
        </div>
        <ul class="flex items-center flex-shrink-0 space-x-6">
            <!-- Theme toggler -->
            <li class="flex">
                <button
                        class="rounded-md focus:outline-none focus:shadow-outline-purple"
                        @click="toggleTheme"
                        aria-label="Toggle color mode"
                >
                    <template x-if="!dark">
                        <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                        >
                            <path
                                    d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                            ></path>
                        </svg>
                    </template>
                    <template x-if="dark">
                        <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                        >
                            <path
                                    fill-rule="evenodd"
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    clip-rule="evenodd"
                            ></path>
                        </svg>
                    </template>
                </button>
            </li>
            <!-- Notifications menu -->
            <li class="relative">
                <button
                        class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                        @click="toggleNotificationsMenu"
                        @keydown.escape="closeNotificationsMenu"
                        aria-label="Notifications"
                        aria-haspopup="true"
                >
                    <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                    >
                        <path
                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
                        ></path>
                    </svg>
                    <!-- Notification badge -->
                    <span
                            aria-hidden="true"
                            class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"
                    ></span>
                </button>
                <template x-if="isNotificationsMenuOpen">
                    <ul
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            @click.away="closeNotificationsMenu"
                            @keydown.escape="closeNotificationsMenu"
                            class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700"
                    >
                        <li class="flex">
                            <a
                                    class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="#"
                            >
                                <span>Messages</span>
                                <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                                >
                          13
                        </span>
                            </a>
                        </li>
                        <li class="flex">
                            <a
                                    class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="#"
                            >
                                <span>Sales</span>
                                <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                                >
                          2
                        </span>
                            </a>
                        </li>
                        <li class="flex">
                            <a
                                    class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="#"
                            >
                                <span>Alerts</span>
                            </a>
                        </li>
                    </ul>
                </template>
            </li>
            <!-- Profile menu -->
            <li class="relative">
                <button
                        class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                        @click="toggleProfileMenu"
                        @keydown.escape="closeProfileMenu"
                        aria-label="Account"
                        aria-haspopup="true"
                >
                    <img
                            class="object-cover w-8 h-8 rounded-full"
                            src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
                            alt=""
                            aria-hidden="true"
                    />
                </button>
                <template x-if="isProfileMenuOpen">
                    <ul
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            @click.away="closeProfileMenu"
                            @keydown.escape="closeProfileMenu"
                            class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                            aria-label="submenu"
                    >
                        <li class="flex">
                            <a
                                    class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="#"
                            >
                                <svg
                                        class="w-4 h-4 mr-3"
                                        aria-hidden="true"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                >
                                    <path
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    ></path>
                                </svg>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="flex">
                            <a
                                    class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="#"
                            >
                                <svg
                                        class="w-4 h-4 mr-3"
                                        aria-hidden="true"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                >
                                    <path
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                    ></path>
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Settings</span>
                            </a>
                        </li>
                        <li class="flex">
                            <a
                                    class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="#"
                            >
                                <svg
                                        class="w-4 h-4 mr-3"
                                        aria-hidden="true"
                                        fill="none"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                >
                                    <path
                                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                                    ></path>
                                </svg>
                                <span onclick="document.getElementById('logout-form').submit()">Log out</span>
                                <!-- Authentication -->
                                <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                    @csrf

                                </form>
                            </a>
                        </li>
                    </ul>
                </template>
            </li>
        </ul>
    </div>
</header>        
           <style>
.ti-download,.ti-sharethis {
    display: none !important;
}

  /* Optional: Hide default scrollbar for cleaner look */
  .hide-scrollbar::-webkit-scrollbar {
    display: none;
  }
  .hide-scrollbar {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
  }
</style>    
@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white dark:bg-gray-800 shadow-lg rounded-2xl border border-gray-200 dark:border-gray-700">
    <h2 class="text-3xl font-bold text-purple-700 dark:text-purple-400 mb-6">Welcome, {{ $student->std_name }}!</h2>

  <!-- Ebooks Section -->
<h3 class="text-2xl font-bold text-purple-700 dark:text-purple-400 mb-6">Available E-books</h3>

<div class="flex gap-6 overflow-x-auto pb-4 hide-scrollbar">
    @forelse ($ebooks as $ebook)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex-shrink-0 w-52 p-4 flex flex-col items-center">
            <div class="w-full h-64 mb-4 overflow-hidden rounded">
                @if($ebook->ebook_file)
                    <div class="_df_thumb w-full h-full bg-cover bg-center rounded"
                        source="{{ route('admin.ebooks.secure-pdf', $ebook->id) }}"
                        thumb="{{ asset($ebook->ebook_cover) }}"></div>
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gray-300 text-gray-500 rounded">
                        <span class="text-xs">No File</span>
                    </div>
                @endif
            </div>
            <h4 class="text-base font-semibold text-gray-800 dark:text-gray-200 text-center">{{ $ebook->ebook_name }}</h4>
        </div>
    @empty
        <p class="text-gray-500 dark:text-gray-400">No E-books found.</p>
    @endforelse
</div>

    <!-- Student Details -->
    <div class="space-y-4 text-gray-700 dark:text-gray-300 mb-8">
        <div class="flex items-center gap-2">
            <span class="font-medium">Student ID:</span>
            <span class="text-gray-900 dark:text-gray-100">{{ $student->std_id }}</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="font-medium">Email:</span>
            <span class="text-gray-900 dark:text-gray-100">{{ $student->std_email }}</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="font-medium">Subscription Start:</span>
            <span class="text-gray-900 dark:text-gray-100">{{ $student->sub_start_date }}</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="font-medium">Subscription End:</span>
            <span class="text-gray-900 dark:text-gray-100">{{ $student->sub_end_date }}</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="font-medium">Subscription Fee:</span>
            <span class="text-gray-900 dark:text-gray-100">{{ $student->sub_fee }}</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="font-medium">Status:</span>
            @if ($student->status === 'on')
                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 dark:bg-green-800 dark:text-green-300 rounded">
                    Active
                </span>
            @else
                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 dark:bg-red-800 dark:text-red-300 rounded">
                    Inactive
                </span>
            @endif
        </div>
    </div>

 

    <!-- Logout Button -->
    <form action="{{ route('student.logout') }}" method="POST" class="mt-8">
        @csrf
        <button type="submit"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 transition duration-150 ease-in-out">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Logout
        </button>
    </form>
</div>

        </main>
    </div>
</div>
<script>
document.addEventListener('keydown', function(e) {
    // Detect Ctrl+P or Command+P
    if ((e.ctrlKey || e.metaKey) && e.keyCode === 80) {
        e.preventDefault();
        alert('Printing is disabled on this page.');
    }
});
</script>
<!-- jQuery  -->
<script src="{{ asset("assets/dflip/js/libs/jquery.min.js") }}" defer></script>
<!-- Flipbook main Js file -->
<script src="{{ asset("assets/dflip/js/dflip.min.js") }}" defer></script>
<script src="{{ asset("assets/js/alpine.min.js") }}" defer></script>
<script src="{{ asset("assets/js/Chart.min.js") }}" defer></script>
<script src="{{ asset("assets/js/init-alpine.js") }}"></script>
<script src="{{ asset("assets/js/charts-lines.js") }}" defer></script>
<script src="{{ asset("assets/js/charts-pie.js") }}" defer></script>
</body>
</html>



