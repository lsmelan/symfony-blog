<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\TextContent;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $post = new Post();
        $categoryRepository = $manager->getRepository(Category::class);
        $category = $categoryRepository->findAll();
        $post->setCategory($category[0]);
        $post->setTitle('Any title');
        $post->setIntroText('Any text');
        $post->setPublishDate(new \DateTime());
        $post->setPublished(true);
        $manager->persist($post);

        $textContent1 = new TextContent();
        $textContent1->setTitle('Content title 1');
        $textContent1->setText('Content text 1');
        $textContent1->setPost($post);
        $manager->persist($textContent1);

        $textContent2 = new TextContent();
        $textContent2->setTitle('Content title 2');
        $textContent2->setText('Content text 2');
        $textContent2->setPost($post);
        $manager->persist($textContent2);

        $manager->flush();
    }
}
