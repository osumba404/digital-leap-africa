@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    @php
        $hero = \App\Models\AboutSection::where('section_type', 'hero')->active()->first();
    @endphp
    @if($hero)
    <section class="py-12 bg-gradient-to-r from-primary to-primary-dark text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                @if($hero->mini_title)
                    <span class="text-yellow-400 font-semibold text-lg mb-2 block">{{ $hero->mini_title }}</span>
                @endif
                <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $hero->title }}</h1>
                <p class="text-xl text-gray-100 mb-8">{{ $hero->content }}</p>
            </div>
        </div>
    </section>
    @endif

    <!-- About Section -->
    @php
        $about = \App\Models\AboutSection::where('section_type', 'about')->active()->first();
    @endphp
    @if($about)
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                    @if($about->image_path)
                        <img src="{{ asset('storage/' . $about->image_path) }}" alt="{{ $about->title }}" class="rounded-lg shadow-lg w-full h-auto">
                    @endif
                </div>
                <div class="md:w-1/2">
                    @if($about->mini_title)
                        <span class="text-primary font-semibold text-lg mb-2 block">{{ $about->mini_title }}</span>
                    @endif
                    <h2 class="text-3xl font-bold mb-6">{{ $about->title }}</h2>
                    <div class="prose max-w-none">
                        {!! nl2br(e($about->content)) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Mission & Vision -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8">
                @php
                    $mission = \App\Models\AboutSection::where('section_type', 'mission')->active()->first();
                    $vision = \App\Models\AboutSection::where('section_type', 'vision')->active()->first();
                @endphp
                
                @if($mission)
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">{{ $mission->title }}</h3>
                    <p class="text-gray-700">{{ $mission->content }}</p>
                </div>
                @endif

                @if($vision)
                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">{{ $vision->title }}</h3>
                    <p class="text-gray-700">{{ $vision->content }}</p>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Meet Our Team</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Our dedicated team of professionals is committed to driving digital transformation across Africa.</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $teamMembers = \App\Models\TeamMember::active()->ordered()->get();
                @endphp
                
                @forelse($teamMembers as $member)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                        @if($member->image_path)
                            <img src="{{ asset('storage/' . $member->image_path) }}" alt="{{ $member->name }}" class="w-full h-64 object-cover">
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-1">{{ $member->name }}</h3>
                            <p class="text-primary font-medium mb-4">{{ $member->role }}</p>
                            <p class="text-gray-600 mb-4">{{ Str::limit($member->bio, 100) }}</p>
                            <div class="flex space-x-3">
                                @if($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" class="text-gray-500 hover:text-blue-600 transition-colors duration-300">
                                        <span class="sr-only">LinkedIn</span>
                                        <i class="fab fa-linkedin-in text-lg"></i>
                                    </a>
                                @endif
                                @if($member->twitter_url)
                                    <a href="{{ $member->twitter_url }}" target="_blank" class="text-gray-500 hover:text-blue-400 transition-colors duration-300">
                                        <span class="sr-only">Twitter</span>
                                        <i class="fab fa-twitter text-lg"></i>
                                    </a>
                                @endif
                                @if($member->instagram_url)
                                    <a href="{{ $member->instagram_url }}" target="_blank" class="text-gray-500 hover:text-pink-600 transition-colors duration-300">
                                        <span class="sr-only">Instagram</span>
                                        <i class="fab fa-instagram text-lg"></i>
                                    </a>
                                @endif
                                @if($member->github_url)
                                    <a href="{{ $member->github_url }}" target="_blank" class="text-gray-500 hover:text-gray-800 transition-colors duration-300">
                                        <span class="sr-only">GitHub</span>
                                        <i class="fab fa-github text-lg"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-8">
                        <p class="text-gray-500">No team members found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Our Partners</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">We're proud to collaborate with these amazing organizations to make a greater impact.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 items-center">
                @php
                    $partners = \App\Models\Partner::active()->ordered()->get();
                @endphp
                
                @forelse($partners as $partner)
                    <a href="{{ $partner->website_url }}" target="_blank" class="block bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 h-full flex items-center justify-center">
                        @if($partner->logo_path)
                            <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-16 w-auto object-contain">
                        @else
                            <span class="text-gray-700 font-medium">{{ $partner->name }}</span>
                        @endif
                    </a>
                @empty
                    <div class="col-span-5 text-center py-8">
                        <p class="text-gray-500">No partners found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to join our mission?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Become a partner, volunteer, or support our initiatives to drive digital transformation in Africa.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('contact') }}" class="bg-white text-primary font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                    Contact Us
                </a>
                <a href="{{ route('donate') }}" class="bg-transparent border-2 border-white text-white font-semibold px-6 py-3 rounded-lg hover:bg-white hover:bg-opacity-10 transition-colors duration-300">
                    Donate Now
                </a>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .prose {
            line-height: 1.75;
        }
        .prose p:not(:last-child) {
            margin-bottom: 1.25em;
        }
    </style>
@endpush
