<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blogDocuments = [
            [
                'title' => 'How To Talk To Kids About Online Safety', 'slugblog' => 'how-to-talk-to-kids-about-online-safety', 'description' => 'It’s a different world for kids today. The age of the internet and the advance of smartphones have created dangers that kids who grew up with Commodore 64s and rotary phones never had to worry about. So how do you talk to your kids about online safety when you are still learning the ins-and-outs yourself? A good way is to start with an extension of the “stranger danger” conversation. If you wouldn’t talk to a stranger on the street, don’t talk to a stranger online. Similarly, hacking is not unlike someone breaking into your house. You don’t keep valuable things out in the open in your house, so why would you leave your computer open to hackers? There’s a false sense of security when you are sitting in front of a computer screen, but it can be deceiving.', 
                'image_path' => '',
                'idUser' => '60e2f401d67e0000400038ad'
            ]
        ];
        Blog::insert($blogDocuments);
    }
}
