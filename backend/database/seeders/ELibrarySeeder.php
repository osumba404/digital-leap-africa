<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ELibraryItem;

class ELibrarySeeder extends Seeder
{
    public function run(): void
    {
        ELibraryItem::create([
            'title' => 'The Pragmatic Programmer',
            'type' => 'eBook',
            'file_path' => '/media/ebooks/pragmatic-programmer.pdf',
        ]);
        ELibraryItem::create([
            'title' => 'Laravel REST API Best Practices',
            'type' => 'Video',
            'file_path' => 'https://youtube.com/watch?v=example123',
        ]);
    }
}