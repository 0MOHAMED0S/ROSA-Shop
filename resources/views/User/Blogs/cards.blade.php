<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('CSS/about_rosa.css') }}">
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blogs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-gray-50 py-12 px-6 text-right" dir="rtl">
                    <div class="max-w-7xl mx-auto text-center mb-10">
                        <h2 class="text-3xl font-bold text-pink-600">✨ آخر المقالات من مدونة روزا ✨</h2>
                        <p class="text-gray-500 mt-2 text-sm">نصائح، إلهام، وقصص من عالم الجمال اليدوي.</p>
                    </div>

                    <!-- الصف الأول: 3 بطاقات -->
                    <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 mb-8">
                        <!-- زهور -->
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition overflow-hidden">
                            <img src="{{ asset('files/main_images/blogs/f4.jpg') }}" class="w-full h-48 object-cover"
                                alt="تنسيقات الزهور">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-pink-600">سحر الزهور</h3>
                                <p class="text-sm text-gray-600 mt-1 line-clamp-3">
                                    كيف يمكن لتنسيقات الزهور أن تحسّن المزاج، وتُجمّل المكان، وتكون الهدية المثالية في كل الأوقات.
                                </p>
                                <a href="{{ route('blogs.flowers') }}"
                                    class="block mt-3 text-pink-500 hover:underline text-sm font-medium">اقرأ المزيد →</a>
                            </div>
                        </div>

                        <!-- مكياج -->
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition overflow-hidden">
                            <img src="{{ asset('files/main_images/blogs/m1.jpg') }}" class="w-full h-48 object-cover"
                                alt="مكياج يومي">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-pink-600">مكياج يومي ساحر</h3>
                                <p class="text-sm text-gray-600 mt-1 line-clamp-3">
                                    نصائح جمالية أساسية للحصول على إطلالة ناعمة ومضيئة باستخدام منتجات عالية الجودة.
                                </p>
                                <a href="{{ route('blogs.makeup') }}"
                                    class="block mt-3 text-pink-500 hover:underline text-sm font-medium">اقرأ المزيد →</a>
                            </div>
                        </div>

                        <!-- شنط اللولي -->
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition overflow-hidden">
                            <img src="{{ asset('files/main_images/blogs/b2.jpg') }}" class="w-full h-48 object-cover"
                                alt="شنط لولي">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-pink-600">أناقة شنط اللولي</h3>
                                <p class="text-sm text-gray-600 mt-1 line-clamp-3">
                                    لماذا أصبحت الشنط اليدوية المصنوعة من اللولي حديث الموضة وكيف يمكن تنسيقها بذكاء؟
                                </p>
                                <a href="{{route('blogs.bags')}}"
                                    class="block mt-3 text-pink-500 hover:underline text-sm font-medium">اقرأ المزيد →</a>
                            </div>
                        </div>
                    </div>

                    <!-- الصف الثاني: 2 بطاقات -->
                    <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-2">
                        <!-- هدايا يدوية -->
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition overflow-hidden">
                            <img src="{{ asset('files/main_images/blogs/c.png') }}" class="w-full h-48 object-cover"
                                alt="هدايا يدوية">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-pink-600">لمسة أنوثة وفخامة من روزه</h3>
                                <p class="text-sm text-gray-600 mt-1 line-clamp-3">
                                    الأنوثة الحقيقية تنبع من التفاصيل... اكتشفي كيف تضيف روزه لمسات ناعمة من الجمال والرقي لحياتك اليومية من خلال المكياج، الورد، والإكسسوارات.
                                </p>
                                <a href="{{route('blogs.gifts')}}"
                                    class="block mt-3 text-pink-500 hover:underline text-sm font-medium">اقرأ المزيد →</a>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition overflow-hidden">
                            <img src="{{ asset('files/main_images/blogs/f3.webp') }}" class="w-full h-48 object-cover"
                                alt="الأناقة تبدأ من التفاصيل">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-pink-600">الأناقة تبدأ من التفاصيل</h3>
                                <p class="text-sm text-gray-600 mt-1 line-clamp-3">
                                    اكتشفي ميكب روزه الأصلي، شنط اللولي الفخمة، وورد الستان اللي يزين يومك ويكمل جمالك بكل لحظة.
                                </p>
                                <a href="{{ route('blogs.care') }}" class="block mt-3 text-pink-500 hover:underline text-sm font-medium">اقرأ المزيد →</a>
                            </div>
                        </div>                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
