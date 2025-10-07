@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-primary text-white py-12">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-4xl mx-auto">
            @if(isset($aboutSections['hero']) && $aboutSections['hero']->isNotEmpty())
                @php $hero = $aboutSections['hero']->first(); @endphp
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $hero->title }}</h1>
                <p class="text-xl text-gray-200 mb-8">{{ $hero->content }}</p>
            @else
                <h1 class="text-4xl md:text-5xl font-bold mb-4">About Digital Leap Africa</h1>
                <p class="text-xl text-gray-200 mb-8">Empowering the next generation of African digital professionals</p>
            @endif
        </div>
    </div>
</section>

<!-- About Section -->
@if(isset($aboutSections['about']) && $aboutSections['about']->isNotEmpty())
    @php $about = $aboutSections['about']->first(); @endphp
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                    @if($about->image_path)
                        <img src="{{ $about->image_url }}" alt="{{ $about->title }}" class="rounded-lg shadow-lg w-full h-auto">
                    @else
                        <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center text-gray-400">
                            <span>Image coming soon</span>
                        </div>
                    @endif
                </div>
                <div class="md:w-1/2">
                    @if($about->mini_title)
                        <span class="text-primary font-semibold text-lg block mb-2">{{ $about->mini_title }}</span>
                    @endif
                    <h2 class="text-3xl font-bold mb-4">{{ $about->title }}</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($about->content)) !!}
                    </div>
                    @if($about->read_more_url)
                        <a href="{{ $about->read_more_url }}" class="inline-block mt-6 px-6 py-2 bg-primary text-white rounded-md hover:bg-primary-dark transition">
                            Read More
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Mission & Vision -->
<div class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Mission -->
            @if(isset($aboutSections['mission']) && $aboutSections['mission']->isNotEmpty())
                @php $mission = $aboutSections['mission']->first(); @endphp
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="text-primary mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">{{ $mission->title ?? 'Our Mission' }}</h3>
                    <p class="text-gray-600">{{ $mission->content ?? 'To empower individuals and organizations in Africa with digital skills and knowledge to drive innovation and economic growth.' }}</p>
                </div>
            @endif

            <!-- Vision -->
            @if(isset($aboutSections['vision']) && $aboutSections['vision']->isNotEmpty())
                @php $vision = $aboutSections['vision']->first(); @endphp
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="text-primary mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">{{ $vision->title ?? 'Our Vision' }}</h3>
                    <p class="text-gray-600">{{ $vision->content ?? 'To be the leading platform for digital skills development and innovation in Africa.' }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Team Section -->
@if($teamMembers->isNotEmpty())
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Meet Our Team</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Our team of dedicated professionals is committed to making a difference in the digital landscape of Africa.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($teamMembers as $member)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        <div class="h-64 overflow-hidden">
                            <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-1">{{ $member->name }}</h3>
                            <p class="text-primary font-medium mb-4">{{ $member->role }}</p>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ $member->bio }}</p>
                            <div class="flex space-x-4">
                                @if($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" class="text-gray-500 hover:text-primary transition">
                                        <span class="sr-only">LinkedIn</span>
                                        <i class="fab fa-linkedin-in text-xl"></i>
                                    </a>
                                @endif
                                @if($member->twitter_url)
                                    <a href="{{ $member->twitter_url }}" target="_blank" class="text-gray-500 hover:text-primary transition">
                                        <span class="sr-only">Twitter</span>
                                        <i class="fab fa-twitter text-xl"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Partners Section -->
@if($partners->isNotEmpty())
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Our Partners</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">We are proud to collaborate with these amazing organizations to drive digital transformation in Africa.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 items-center">
                @foreach($partners as $partner)
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center justify-center h-32">
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank" class="block w-full h-full flex items-center justify-center">
                                <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-16 max-w-full object-contain">
                            </a>
                        @else
                            <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-16 max-w-full object-contain">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- CTA Section -->
<section class="bg-primary text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to start your digital journey?</h2>
        <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">Join thousands of learners across Africa and acquire the skills needed for the digital economy.</p>
        <a href="{{ route('register') }}" class="inline-block bg-white text-primary font-semibold px-8 py-3 rounded-md hover:bg-gray-100 transition">
            Get Started Now
        </a>
    </div>
</section>
@endsection
