@extends('layouts.app')

@section('content')






        
<style>
  /* Courses overlay card styles (scoped) */
  #courses-section .cards-grid{display:grid;grid-template-columns:1fr;gap:2rem}
  @media (min-width:640px){#courses-section .cards-grid{grid-template-columns:repeat(2,1fr)}}
  @media (min-width:1024px){#courses-section .cards-grid{grid-template-columns:repeat(3,1fr)}}
  #courses-section .card{background-color:#112240;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(2,12,27,0.7);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);height:100%;display:flex;flex-direction:column;padding:0}
  #courses-section .card:hover{transform:translateY(-8px);box-shadow:0 20px 40px rgba(2,12,27,0.9)}
  #courses-section .card-image-container{position:relative;overflow:hidden;margin:0;padding:0;line-height:0;border-top-left-radius:12px;border-top-right-radius:12px}
  #courses-section .card-image{width:100%;height:200px;object-fit:cover;display:block;margin:0;transition:transform .5s ease}
  #courses-section .card:hover .card-image{transform:scale(1.05)}
  #courses-section .card-title{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent, rgba(10,25,47,0.95));padding:1.25rem 1.25rem .6rem;margin:0;font-size:1.1rem;font-weight:700;line-height:1.35;text-shadow:0 2px 4px rgba(0,0,0,0.5)}
  #courses-section .card-content{padding:1.25rem;flex-grow:1;display:flex;flex-direction:column}
  #courses-section .card-body{color:#8892b0;line-height:1.6;margin-bottom:1rem;flex-grow:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
  #courses-section .card-meta{display:flex;justify-content:space-between;color:#8892b0;font-size:.85rem;margin-bottom:.85rem;border-bottom:1px solid rgba(136,146,176,0.2);padding-bottom:.6rem}
  #courses-section .card-button{display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.6rem 1.2rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:600;transition:all .3s ease;cursor:pointer;gap:.5rem}
  #courses-section .card-button:hover{background-color:rgba(59,130,246,.1);transform:translateY(-2px);box-shadow:0 4px 12px rgba(59,130,246,.2)}
  .btn-wide{width: 100%;}
  @media (max-width:768px){#courses-section .cards-grid{grid-template-columns:repeat(auto-fill, minmax(280px,1fr));gap:1.5rem}#courses-section .card-title{font-size:1rem;padding:1rem 1rem .45rem}}

  /* Light Mode Courses */
  [data-theme="light"] #courses-section .card {
      background-color: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }
  [data-theme="light"] #courses-section .card:hover {
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
  }
  [data-theme="light"] #courses-section .card-title {
      background: linear-gradient(transparent, rgba(230, 242, 255, 0.95));
      color: var(--diamond-white);
  }
  [data-theme="light"] #courses-section .card-body,
  [data-theme="light"] #courses-section .card-meta {
      color: var(--cool-gray);
  }
  [data-theme="light"] #courses-section .card-button {
      color: var(--primary-blue);
      border-color: var(--primary-blue);
  }
  [data-theme="light"] #courses-section .card-button:hover {
      background-color: rgba(46, 120, 197, 0.1);
      box-shadow: 0 4px 12px rgba(46, 120, 197, 0.2);
  }
</style>




<!-- Latest Courses -->
<section id="courses-section" style="padding:2rem 0;">
  @php
    try {
      $courses = isset($courses) ? $courses : \App\Models\Course::query()->latest()->paginate(9);
    } catch (\Throwable $e) {
      $courses = collect();
    }
    $pickCourseImage = function($course) {
      return $course->image_url
          ?? $course->thumbnail
          ?? $course->cover_image
          ?? $course->banner_image
          ?? null;
    };
  @endphp

  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h2 class="m-0">Available Courses</h2>
    </div>

    @if($courses->count())
      <div class="cards-grid">
        @foreach($courses as $course)
          @php
            $courseImage   = $pickCourseImage($course);
            $courseTitle   = $course->title ?? 'Untitled';
            $courseExcerpt = \Illuminate\Support\Str::limit(strip_tags($course->short_description ?? $course->description ?? $course->summary ?? ''), 140);
            $showUrl       = \Illuminate\Support\Facades\Route::has('courses.show') ? route('courses.show', $course) : url('/courses/'.$course->id);
            // Lessons count (relation preferred, fallback to *_count fields)
            $lessonsCount = 0;
            if (method_exists($course, 'lessons')) {
              $lessonsCount = $course->relationLoaded('lessons') ? $course->lessons->count() : $course->lessons()->count();
            } else {
              $lessonsCount = $course->lessons_count ?? $course->lectures_count ?? 0;
            }
          @endphp

          <div class="card">
            <div class="card-image-container">
              @if($courseImage)
                <img src="{{ $courseImage }}" alt="{{ $courseTitle }}" class="card-image">
              @else
                <img src="https://via.placeholder.com/1000x600.png?text=Course" alt="{{ $courseTitle }}" class="card-image">
              @endif
              <h3 class="card-title">{{ $courseTitle }}</h3>
            </div>
            <div class="card-content">
              <div class="card-meta">
                <span><i class="fas fa-play-circle"></i> {{ $lessonsCount }} lessons</span>
                @if(!empty($course->created_at))
                  <span><i class="far fa-calendar"></i> {{ $course->created_at->format('M j, Y') }}</span>
                @endif
              </div>
              <p class="card-body">{{ $courseExcerpt }}</p>
              <a class="card-button" href="{{ $showUrl }}">
                View Course <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Courses Available</h3>
            <p style="color: var(--cool-gray);">Check back soon for new courses!</p>
    @endif
   
  </div>
</section>



        

       

</div>
@endsection