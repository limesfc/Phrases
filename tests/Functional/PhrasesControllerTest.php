<?php

namespace App\Tests\Functional;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PhrasesControllerTest extends WebTestCase
{
    private EntityManager $entityManager;

    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();

        $this->entityManager = $this->client->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testRenderSignUpLandingPage(): void
    {
        $this->client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Sign Up for learn English phrases');
    }

    public function testSignUpForm()
    {
        $countOfUsers = $this->entityManager
            ->getRepository(User::class)
            ->count([]);

        $this->client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $this->client->submitForm('sign_up_submit', [
            'sign_up[email]' => 'test@form.com',
        ]);

        $this->assertResponseRedirects();
        $this->client->followRedirect();
        $this->assertSelectorTextContains('h1', 'Sign Up for learn English phrases');
        $this->assertSelectorNotExists('li:contains("This value is already used.")');
        $this->assertEquals($countOfUsers + 1, $this->entityManager->getRepository(User::class)->count([]));
    }

    public function testSignUpWhenEmailExistInDataBase()
    {
        $countOfUsers = $this->entityManager
            ->getRepository(User::class)
            ->count([]);

        $this->client->request('GET', '/');

        $this->assertResponseIsSuccessful();

        $this->client->submitForm('sign_up_submit', [
            'sign_up[email]' => 'user@test.com',
        ]);

        $this->assertResponseStatusCodeSame(422);
        $this->assertSelectorTextContains('h1', 'Sign Up for learn English phrases');
        $this->assertSelectorExists('li:contains("This value is already used.")');
        $this->assertEquals($countOfUsers, $this->entityManager->getRepository(User::class)->count([]));
    }
}
